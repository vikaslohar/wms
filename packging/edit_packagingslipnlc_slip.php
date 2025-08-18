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
	
	if(isset($_REQUEST['pid']))
	{
   		$pid = $_REQUEST['pid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
				
		$txtid=trim($_POST['txtid']);
		$plantcodes=trim($_POST['plantcodes']);
		$yearcodes=trim($_POST['yearcodes']);
		$cdate=trim($_POST['cdate']);
		$date=trim($_POST['date']);
		$dopc=trim($_POST['dopc']);
		$txtpsrn=trim($_POST['txtpsrn']);
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$txtups=trim($_POST['txtups']);
		$barcode=trim($_POST['barcode']);
		$bardupchk=trim($_POST['bardupchk']);
		$weight=trim($_POST['weight']);
		$txtstage=trim($_POST['txtstage']);
		$txtlot2=trim($_POST['txtlot2']);
		$txtlot1=trim($_POST['txtlot1']);
		$maintrid=trim($_POST['maintrid']);
		$subtrid=trim($_POST['subtrid']);
		$lotno_1=trim($_POST['lotno_1']);
		$softstatus=trim($_POST['softstatus']);
		$upssize=trim($_POST['upssize']);
		$wtnopkg_1=trim($_POST['wtnopkg_1']);
		$upsname_1=trim($_POST['upsname_1']);
		$txtonob=trim($_POST['txtonob']);
		$txtoqty=trim($_POST['txtoqty']);
		$nomp_1=trim($_POST['nomp_1']);
		$wtmp_1=trim($_POST['wtmp_1']);
		$wtnop_1=trim($_POST['wtnop_1']);
		$noofpacks_1=trim($_POST['noofpacks_1']);
		$nowb_1=trim($_POST['nowb_1']);
		$exwh1_1=trim($_POST['exwh1_1']);
		$exbin1_1=trim($_POST['exbin1_1']);
		$exsubbin1_1=trim($_POST['exsubbin1_1']);
		$extnomphs1_1=trim($_POST['extnomphs1_1']);
		$extnophs1_1=trim($_POST['extnophs1_1']);
		$nophs1_1=trim($_POST['nophs1_1']);
		$balnophs1_1=trim($_POST['balnophs1_1']);
		$sno33_1=trim($_POST['sno33_1']);
		$lotno_2=trim($_POST['lotno_2']);
		$softstatus=trim($_POST['softstatus']);
		$upssize=trim($_POST['upssize']);
		$wtnopkg_2=trim($_POST['wtnopkg_2']);
		$upsname_2=trim($_POST['upsname_2']);
		$txtonob=trim($_POST['txtonob']);
		$txtoqty=trim($_POST['txtoqty']);
		$nomp_2=trim($_POST['nomp_2']);
		$wtmp_2=trim($_POST['wtmp_2']);
		$wtnop_2=trim($_POST['wtnop_2']);
		$noofpacks_2=trim($_POST['noofpacks_2']);
		$nowb_2=trim($_POST['nowb_2']);
		$exwh2_1=trim($_POST['exwh2_1']);
		$exbin2_1=trim($_POST['exbin2_1']);
		$exsubbin2_1=trim($_POST['exsubbin2_1']);
		$extnomphs2_1=trim($_POST['extnomphs2_1']);
		$extnophs2_1=trim($_POST['extnophs2_1']);
		$nophs2_1=trim($_POST['nophs2_1']);
		$balnophs2_1=trim($_POST['balnophs2_1']);
		$sno33_2=trim($_POST['sno33_2']);
		$sno=trim($_POST['sno']);
		$detmpbno=trim($_POST['detmpbno']);
		$upsidno=trim($_POST['upsidno']);
		$nopks=trim($_POST['nopks']);
		$extwh=trim($_POST['extwh']);
		$extbin=trim($_POST['extbin']);
		$extsubbin=trim($_POST['extsubbin']);
		$sno3=trim($_POST['sno3']);
		$tsno=trim($_POST['tsno']);
		$txtwhg1=trim($_POST['txtwhg1']);
		$txtbing1=trim($_POST['txtbing1']);
		$txtsubbg1=trim($_POST['txtsubbg1']);
		$existview1=trim($_POST['existview1']);
		$trflg1=trim($_POST['trflg1']);
		$tpflg1=trim($_POST['tpflg1']);
		$tflg1=trim($_POST['tflg1']);
		$tpmflg1=trim($_POST['tpmflg1']);
		$nopmpcs_1=trim($_POST['nopmpcs_1']);
		$noppchs_1=trim($_POST['noppchs_1']);
		$noptpchs_1=trim($_POST['noptpchs_1']);
		$noptqtys_1=trim($_POST['noptqtys_1']);
		$txtremarks=trim($_POST['txtremarks']);
		$mptyp=trim($_POST['mptyp']);
		
		$ttype="NLC";
		
		$zz=str_split($txtlot1);
		$orlot=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
		
		$tdate11=explode("-",$date);
		$tdate1=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
			
		$tdate12=explode("-",$dopc);
		$tdate2=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];
		
   		$sql_main="update tbl_packaging set packaging_type='$ttype', packaging_tdate='$tdate1', packaging_code='$txtid',  packaging_date='$tdate2', packaging_slipno='$txtpsrn', packaging_remarks='$txtremarks', packaging_yearid='$yearid_id', packaging_logid='$logid', packaging_mptype='$mptyp' where packaging_id='$pid'";
		if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
		{
			$mainid=$pid;
			$sqlsub="delete from tbl_packaging_sub where packaging_id='$pid'";
			$ssub=mysqli_query($link,$sqlsub) or die(mysqli_error($link));
			$sqlsubsub="delete from tbl_packagingsub_sub where packaging_id='$pid'";
			$ssub1=mysqli_query($link,$sqlsubsub) or die(mysqli_error($link));
			$sqlsubsub2="delete from tbl_packagingsub_sub2 where packaging_id='$pid'";
			$ssub2=mysqli_query($link,$sqlsubsub2) or die(mysqli_error($link));
			
			$sql_sub="insert into tbl_packaging_sub (packaging_id, packagingsub_crop, packagingsub_variety, plantcode) values ('$mainid', '$txtcrop', '$txtvariety', '$plantcode')";
			if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
			{
				$suid=mysqli_insert_id($link);
				$lotnno="";
				for($i=1; $i<=$sno; $i++)
				{
					$ltno24=""; 
					$ltno24=trim($_POST["lotno_".$i]);
					$ssno33=trim($_POST["sno33_".$i]);
					
					if($lotnno!="")
					$lotnno=$lotnno.",".$ltno24;
					else
					$lotnno=$ltno24;
					
					for($x=1; $x<=$ssno33; $x++)
					{
						$exwh=""; $exbin=""; $exsubbin=""; $extnomphs=""; $extnophs=""; $nophs=""; $balnophs=""; $detmpbno24=0; 
						$txtremarks24="";
						$exwh24=trim($_POST["exwh".$i."_".$x]);
						$exbin24=trim($_POST["exbin".$i."_".$x]);
						$exsubbin24=trim($_POST["exsubbin".$i."_".$x]);
						$extnomphs24=trim($_POST["extnomphs".$i."_".$x]);
						$extnophs24=trim($_POST["extnophs".$i."_".$x]);
						$nophs24=trim($_POST["nophs".$i."_".$x]);
						$balnophs24=trim($_POST["balnophs".$i."_".$x]);
						if($nophs24!="")
						{
							$detmpbno24=1; 
							$txtremarks24=$txtremarks;
						}
				
						$sql_subsub="insert into tbl_packagingsub_sub (packagingsub_id, packaging_id, packagingsubsub_lotno, packagingsubsub_upssize, extwh, extbin, extsubbin, packagingsubsub_extnop, packagingsubsub_extqty, packagingsubsub_nop, packagingsubsub_balpch, packagingsubsub_barcodes, packagingsubsub_remarks, packagingsubsub_wtmp, packagingsubsub_wtnop, plantcode) values ('$suid', '$mainid', '$ltno24', '$upssize', '$exwh24', '$exbin24', '$exsubbin24', '$extnophs24', '$txtoqty', '$nophs24', '$balnophs24', '$detmpbno24', '$txtremarks24', '$wtmp_1', '$wtnop_1', '$plantcode')";
						mysqli_query($link,$sql_subsub) or die(mysqli_error($link));
						
						$sqlsubsub3="delete from tbl_barcodestmp where bar_tid='$pid' and bar_logid='$logid'";
						$ssub3=mysqli_query($link,$sqlsubsub3) or die(mysqli_error($link));
						
						$sql_barcode="insert into tbl_barcodestmp (bar_tid, bar_subid, bar_barcodes, bar_lotno, bar_logid, bar_psrn, bar_grosswt, bar_wtdate, plantcode) values ('$mainid', '$suid', '$barcode', '$ltno24', '$logid', '$txtpsrn', '$weight', '$tdate2', '$plantcode')";
						mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
					}
				}
				for($j=1; $j<=1; $j++)
				{
					$txtwhgx="txtwhg".$j;
					$txtbingx="txtbing".$j;
					$txtsubbgx="txtsubbg".$j;
					$existviewx="existview".$j;
					$nopmpcsx="nopmpcs_".$j;
					$noppchsx="noppchs_".$j;
					$noptpchsx="noptpchs_".$j;
					$noptqtysx="noptqtys_".$j;
					if(isset($_POST[$txtwhgx])) { $txtwhg= $_POST[$txtwhgx]; }
					if(isset($_POST[$txtbingx])) { $txtbing= $_POST[$txtbingx]; }
					if(isset($_POST[$txtsubbgx])) { $txtsubbg= $_POST[$txtsubbgx]; }
					if(isset($_POST[$existviewx])) { $existview= $_POST[$existviewx]; }
					if(isset($_POST[$nopmpcsx])) { $nopmpcs= $_POST[$nopmpcsx]; }
					if(isset($_POST[$noppchsx])) { $noppchs= $_POST[$noppchsx]; }
					if(isset($_POST[$noptpchsx])) { $noptpchs= $_POST[$noptpchsx]; }
					if(isset($_POST[$noptqtysx])) { $noptqtys= $_POST[$noptqtysx]; }
					
					if($noptqtys!="" || $noptqtys>0)
					{
						$sql_subsub4="insert into tbl_packagingsub_sub2 (packagingsub_id, packaging_id, packagingsubsub_lotno, packagingsubsub_upssize, packagingsubsub_wh, packagingsubsub_bin, packagingsubsub_subbin, packagingsubsub_nomp, packagingsubsub_nopch, packagingsubsub_totpch, packagingsubsub_totqty, plantcode) values ('$suid', '$mainid', '$lotnno', '$upssize', '$txtwhg', '$txtbing', '$txtsubbg', '$nopmpcs', '$noppchs', '$noptpchs', '$noptqtys', '$plantcode')";
						mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
					}
				}
			}	
		
			
		//frm_action=submit&txtid=2&plantcodes=D&yearcodes=A%2CD%2CK%2CN%2CS&cdate=14-09-2013&date=14-09-2013&dopc=14-09-2013&txtpsrn=hgjfjhg&txtcrop=28&txtvariety=15&txtups=10.000%20Gms&barcode=DA1234566&bardupchk=0&weight=6.2&txtstage=Pack&txtlot2=DA02912%2F00000%2F01P%0ADA02911%2F00000%2F01P&txtlot1=DA02912%2F00000%2F01P%2CDA02911%2F00000%2F01P&maintrid=0&subtrid=0&lotno_1=DA02912%2F00000%2F01P&softstatus=&upssize=10.000%20Gms&wtnopkg_1=0.010&upsname_1=10.000%20Gms&txtonob=55000&txtoqty=550&nomp_1=300&wtmp_1=6&wtnop_1=600&noofpacks_1=54700&nowb_1=&exwh1_1=1&exbin1_1=21&exsubbin1_1=418&extnophs1_1=55000&nophs1_1=300&balnophs1_1=54700&sno33_1=1&lotno_2=DA02911%2F00000%2F01P&softstatus=&upssize=10.000%20Gms&wtnopkg_2=0.010&upsname_2=10.000%20Gms&txtonob=59800&txtoqty=610&nomp_2=300&wtmp_2=6&wtnop_2=600&noofpacks_2=59500&nowb_2=&exwh2_1=1&exbin2_1=22&exsubbin2_1=439&extnophs2_1=59800&nophs2_1=300&balnophs2_1=59500&sno33_2=1&sno=2&detmpbno=1&upsidno=&nopks=&extwh=1%2C1&extbin=21%2C22&extsubbin=418%2C439&sno3=0&tsno=0&txtwhg1=1&txtbing1=21&txtsubbg1=418&existview1=Bitter%20Gourd%2C%20Improved%20Katahi%2C%20Pack%2C%20%3Ca%20href%3D'Javascript%3Avoid(0)'%20onclick%3D'openprintsubbin(418%2C21%2C1%2C28)'%3EDetails%3C%2Fa%3E&trflg1=0&tpflg1=0&tflg1=0&tpmflg1=0&nopmpcs_1=1&noppchs_1=&noptpchs_1=600&noptqtys_1=6
		
		//exit;
		//$p_id=trim($_POST['maintrid']);
		echo "<script>window.location='add_packagingslipnlc_preview.php?p_id=$pid'</script>";	
		}
	}

	/*$sql_code="SELECT MAX(packaging_code) FROM tbl_packaging where packaging_yearid='$yearid_id'  ORDER BY packaging_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1="TPS".$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1="TPS".$code."/".$yearid_id."/".$lgnid;
	}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packaging slip</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="packagingslip.js"></script>
<script src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

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
//for Only Number allowed---
function isNumberKey(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && charCode != 8 && charCode != 9 && (charCode < 48 || charCode > 57) && charCode != 127 && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}

//for Only Number with Decimal . allowed---
function isNumberKey1(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 127 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}
function isNumberKey24(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 127 && (charCode < 47 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}
function isChar_o(Char) // This function accepts only alphabetic characters with no space, no special chars.
{
		var CharToChk = new String(Char);
		var LengthOfChar = CharToChk.length;
		var flag = true;
		for(var i=0;i<LengthOfChar;i++)
		{
			if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122)) {
			flag = false;
			break;
			}	
		}
		return flag;
}
	  
function qtychk1(qtyval1,srno)
{
		var sbin="txtbalnobp"+srno;
		var nob="txtextnob"+srno;
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}	
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("NoB entered for Packing can be Equal to or Less than Existing NoB in Bin");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1);
	}
}

function Bagschk1(qtyval1,srno)
{
	var actnob="txtbalnobp"+srno;
	var sbin="txtbalqtyp"+srno;
	var nob="txtextqty"+srno;
	/*if(document.getElementById(actnob).value=="")
	{
		alert("Please enter NoB");
		var actqty="recqtyp"+srno;
		document.getElementById(actqty).value="";
		return false;
	}
	else*/ 
	if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("Qty entered for Packing can be Equal to or Less than Existing Qty in Bin");
		var actnob="recqtyp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1);
		document.getElementById('picqtyp').value=qtyval1
		document.getElementById(actnob).value="";
		document.getElementById(actnob).readOnly=false;
		document.getElementById(actnob).style.backgroundColor="#FFFFFF";
	}
}

function pform()
{	
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Packaging Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	/*if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}*/	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	/*if(document.frmaddDepartment.validityperiod.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		return false;
		f=1;
	}
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		return false;
		f=1;
	}*/
	/*if(document.frmaddDepartment.pcktype.value=="P")
	{ 	
		var q1="";
		var q2="";
		var g="";
		var g2="";
		q1=document.frmaddDepartment.recqtyp1.value;
		g=document.frmaddDepartment.txtextqty1.value;
		if(document.frmaddDepartment.srno2.value>=2)
		{
			q2=document.frmaddDepartment.recqtyp2.value;
			g2=document.frmaddDepartment.txtextqty2.value;
		}
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;if(g2=="")g2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		var qtyd=parseFloat(g)+parseFloat(g2);
		
		if(parseFloat(qtyd)<parseFloat(qtyg))
		{
		alert("Please check. Total Quantity Picked for Packing is not matching with Total Quantity Available for Packing");
		return false;
		f=1;
		}	
	}*/
	
	if(f==1)
	{
		return false;
	}
	else
	{	
		var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0; var tqty=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="packqty_"+l;
			var nomp="nomp_"+l;
			//alert(acc);
			//alert(document.getElementById(acc).value);
			if(document.getElementById(acc).value!="")
			{
				ycc++;
			}
			else
			{ 
				if(document.getElementById(nomp).value!="")
				{
					xcc++;
				} 
			}
			tqty=parseFloat(tqty)+parseFloat(document.getElementById(acc).value);
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		if(xcc > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
		{
			alert("Please select Barcode(s) for Pack Seed");
			f=1;
			return false;		
		}
		
		var x=document.frmaddDepartment.sno3.value; var y=0; var zx=0;
		for(var j=1; j<=x; j++)
		{
			var a="noptqtys_"+j;
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		}
		if(y==0)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			if(parseFloat(zx)!=parseFloat(tqty))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				return false;
				f=1;
			}
		}
		
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		alert(a);
		//showUser(a,'postingtable','mformnlc','','','','','');
		//showUser(a,'postingsubtable','mform','','','','','');
		}  
	}
}

function pformedtup()
{	
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Packaging Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	/*if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		document.frmaddDepartment.txttreattyp.focus();
		f=1;
		return false;
	}*/	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	/*if(document.frmaddDepartment.validityperiod.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		return false;
		f=1;
	}
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		return false;
		f=1;
	}*/
	/*if(document.frmaddDepartment.pcktype.value=="P")
	{ 	
		var q1="";
		var q2="";
		var g="";
		var g2="";
		q1=document.frmaddDepartment.recqtyp1.value;
		g=document.frmaddDepartment.txtextqty1.value;
		if(document.frmaddDepartment.srno2.value>=2)
		{
			q2=document.frmaddDepartment.recqtyp2.value;
			g2=document.frmaddDepartment.txtextqty2.value;
		}
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;if(g2=="")g2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		var qtyd=parseFloat(g)+parseFloat(g2);
		
		if(parseFloat(qtyd)<parseFloat(qtyg))
		{
		alert("Please check. Total Quantity Picked for Packing is not matching with Total Quantity Available for Packing");
		return false;
		f=1;
		}	
	}*/
	
	if(f==1)
	{
		return false;
	}
	else
	{	
		var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0; var tqty=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="packqty_"+l;
			var nomp="nomp_"+l;
			//alert(acc);
			//alert(document.getElementById(acc).value);
			if(document.getElementById(acc).value!="")
			{
				ycc++;
			}
			else
			{ 
				if(document.getElementById(nomp).value!="")
				{
					xcc++;
				} 
			}
			tqty=parseFloat(tqty)+parseFloat(document.getElementById(acc).value);
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		if(xcc > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
		{
			alert("Please select Barcode(s) for Pack Seed");
			f=1;
			return false;		
		}
		
		var x=document.frmaddDepartment.sno3.value; var y=0; var zx=0;
		for(var j=1; j<=x; j++)
		{
			var a="noptqtys_"+j;
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		}
		if(y==0)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			if(parseFloat(zx)!=parseFloat(tqty))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				return false;
				f=1;
			}
		}
		
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformsubedtnlc','','','','','');
		}
	}
}

function modetchk(classval)
{
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		 alert("Please Select Packing Slip Reference Number");
		 document.frmaddDepartment.txtpsrn.focus();
		  document.frmaddDepartment.txtcrop.selectedIndex=0;
		 return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		showUser(classval,'vitem','item','','','','','');
	}
}

function modetchk1(classval)
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		 alert("Please Select Crop");
		 document.frmaddDepartment.txtvariety.selectedIndex=0;
		 document.frmaddDepartment.txtcrop.focus();
		 return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		var crp=document.frmaddDepartment.txtcrop.value;
		showUser(classval,'upstp','uspslnlc',crp,'','','','');
	}
}

function modetchk2(classval)
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		 alert("Please Select Variety");
		 document.frmaddDepartment.txtups.selectedIndex=0;
		 document.frmaddDepartment.txtvariety.focus();
		 return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		document.frmaddDepartment.nlcweight.value="";
		document.frmaddDepartment.weight.value="";
		//var variety=document.frmaddDepartment.txtvariety.value;
		//showUser(classval,'tnopinmp','tnopinmp1',variety,'','','','');
	}
}

function barcheck(mltval)
{
	if(document.frmaddDepartment.nlcweight.value=="")
	{
		alert("Please enter Master Pack Weight.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.nlcweight.focus();
		return false;
	}
	else
	{
		mltval=mltval.toUpperCase();
		document.frmaddDepartment.barcode.value=mltval;
		if(mltval.length >= 11)
		{
			if(document.frmaddDepartment.bardupchk.value>0)
			{
				alert("Invalid / Duplicate Barcode.");
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.barcode.focus();
				return false;
			}
		}
	}
	/*else
	{
		var f=0;
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.barcode.focus();
				f=1;
				return false;
			}
		}
		
		var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			return false;
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(y==0)
		{
			alert("Invalid Barcode");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			return false;
		}
		if(f==0)
		{
			
			document.frmaddDepartment.weight.focus();
		}
	}*/
}
function searchbarcode(searchval)
{
	if(document.frmaddDepartment.nlcweight.value=="")
	{
		alert("Please enter Master Pack Weight.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.nlcweight.focus();
		return false;
	}
	else
	{
		searchval=searchval.toUpperCase();
		document.frmaddDepartment.barcode.value=searchval;
	//alert(searchval.length);
		if(searchval.length >= 11)
		{//alert(searchval.length);
			var f=0;
			var z=searchval.split("");
			var a=z[0];
			var b=z[1];
			if(isChar_o(a)==false)
			{
				alert("Invalid Barcode");
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.barcode.focus();
				f=1;
				return false;
			}
			if(isChar_o(b)==false)
			{

				alert("Invalid Barcode");
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.barcode.focus();
				f=1;
				return false;
			}
			for(var i=2; i<z.length; i++)
			{
				if(isChar_o(z[i])==true)
				{
					alert("Invalid Barcode");
					document.frmaddDepartment.barcode.value="";
					document.frmaddDepartment.barcode.focus();
					f=1;
					return false;
				}
			}
			
			var pcode=document.frmaddDepartment.plantcodes.value.split(",");
			var ycode=document.frmaddDepartment.yearcodes.value.split(",");
			var x=0
			var y=0;
			for(var i=0; i<pcode.length; i++)
			{
				if(pcode[i]==a)
				{
					x++;
				}
			}
			if(x==0)
			{
				alert("Invalid Barcode");
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.barcode.focus();
				f=1;
				return false;
			}
			for(var i=0; i<ycode.length; i++)
			{
				if(ycode[i]==b)
				{
					y++;
				}
			}
			if(y==0)
			{
				alert("Invalid Barcode");
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.barcode.focus();
				f=1;
				return false;
			}
			//alert(f);
			if(f==0)
			{
				//alert("HI");
				showUser(searchval,"barserch","barsearch",'','','','');
				//searchUser1(searchval,"barserch","barsearch",tno,finar,dupnos,xz);
				document.frmaddDepartment.weight.focus();
			}
		}
	}
}
function chkmlt1(mltval)
{
	if(document.frmaddDepartment.barcode.value=="")
	{
		alert("Please enter Barcode first.");
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		return false;
	}
	if(document.frmaddDepartment.barcode.value.length<11)
	{
		alert("Invalid Barcode. Please enter Barcode first.");
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		return false;
	}
	if(document.frmaddDepartment.bardupchk.value>0)
	{
		alert("Invalid / Duplicate Barcode.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.bardupchk.value=0;
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		return false;
	}
}
function chkgrwt2()
{
	if(document.frmaddDepartment.weight.value!="")
	{
		alert("Please enter Weight first");
		document.frmaddDepartment.weight.focus();
		return false;
	}
}

function openslocpop()
{
if(document.frmaddDepartment.mptyp.value!="")
{
	document.getElementById("postingsubsubtable").innerHTML="";
	document.frmaddDepartment.txtlot1.value="";
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	var stage=document.frmaddDepartment.txtstage.value;
	var tid=document.frmaddDepartment.maintrid.value;
	var dop=document.frmaddDepartment.dopc.value;
	var ups=document.frmaddDepartment.txtups.value;
	//alert(variety);
	winHandle=window.open('getuser_packagingslipnlc_lotno.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid+'&dop='+dop+'&ups='+ups,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
	alert("Please select MP Type first");
	document.getElementById("postingsubsubtable").innerHTML="";
	document.frmaddDepartment.txtlot1.value="";
	document.frmaddDepartment.mptyp.focus();
}
}

function openslocpop1()
{
if(document.frmaddDepartment.qc.value=="")
{
 alert("Please Select QC.");
 //document.frmaddDepartment.txt1.focus();
}
else
{
var itm=document.frmaddDepartment.sstatus.value;
winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

}

function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtconqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
	}
	else
	{
		alert("Please enter Condition Seed Quantity");
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}
}

function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','1','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin2(bin2val)
{
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2','2','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtconslnob1.value!="")
		var Bagsv1=document.frmaddDepartment.txtconslnob1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.txtconslqty1.value!="")
		var qtyv1=document.frmaddDepartment.txtconslqty1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb2').selectedIndex=0;
		document.frmaddDepartment.txtslbing2.focus();
		}
		
		if(document.frmaddDepartment.txtslsubbg1.value!="")
		
		var slocnogood="Condition";
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtconslnob2.value!="")
		var Bagsv2=document.frmaddDepartment.txtconslnob2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtconslqty2.value!="")
		var qtyv2=document.frmaddDepartment.txtconslqty2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function qtyf1(qtyval, sval)
{
	var sbbin="txtconslnob"+sval;
	var nobb="txtconslqty"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please Enter NoB");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("Qty can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}
function Bagsf1(Bags1val, sval)
{
	var sbbin="sb"+sval;
	var nobb="txtconslnob"+sval;
	if(document.getElementById(sbbin).value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById(nobb).value="";
		document.getElementById(sbbin).focus();
	}
	if(document.getElementById(nobb).value!="")
	{
		if(parseInt(document.getElementById(nobb).value)==0 || document.getElementById(nobb).value=="")
		{
			alert("NoB can not be ZERO");
			document.getElementById(nobb).value="";
		}
	}
}

function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedtnlc','','','','','');
}
function getdetails(stage)
{
	var get=document.frmaddDepartment.txtlot1.value;
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	var stage=document.frmaddDepartment.txtstage.value;
	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot No.");
		//document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;					
	var tid=document.frmaddDepartment.maintrid.value;
	var lotid=document.frmaddDepartment.subtrid.value;
	var dsrn=document.frmaddDepartment.nlcweight.value;
	var stage=document.frmaddDepartment.txtstage.value;
	//alert(tid);
	//alert(lotid);
			
	//document.getElementById("postingsubtable").style.display="block";
	showUser(get,'postingsubsubtable','getnlc',crop,variety,tid,lotid,dsrn,stage);
	//showUser(get,'postingsubtable','get',crop,variety,stage,'','');
}
function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','deletenlc',v2,'','','','');
	}
	else
	{
		return false;
	}
}


function mySubmit()
{ 
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Packaging Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please Select UPS");
		document.frmaddDepartment.txtups.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.barcode.value=="")
	{
		alert("Please enter Barcode Number");
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.barcode.value.length<11)
	{
		alert("Invalid Barcode. Please enter Barcode first.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.barcode.focus();
		return false;
	}
	if(document.frmaddDepartment.bardupchk.value>0)
	{
		alert("Invalid / Duplicate Barcode.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.bardupchk.value=0;
		document.frmaddDepartment.barcode.focus();
		return false;
	}
	if(document.frmaddDepartment.weight.value=="")
	{
		alert("Please enter Gross Weight of Master Pack");
		document.frmaddDepartment.weight.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(f==1)
	{
		return false;
	}
	else
	{	
		var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0; var tqty=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="wtmp_"+l;
			var nomp="nomp_"+l;
			if(document.getElementById(nomp).value!="")
			{
				ycc++;
			}
			tqty=parseFloat(document.getElementById(acc).value);
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		var x=1; var y=0; var zx=0;
			var a="noptqtys_1";
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		if(y>0)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			if(parseFloat(zx)!=parseFloat(tqty))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				return false;
				f=1;
			}
		}
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			return true;	 
		}
	}
}

function prochktyp(protypval)
{
	dt1=getDateObject(document.frmaddDepartment.dopc.value,"-");
	dt2=getDateObject(document.frmaddDepartment.qctestdate.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of QC Test (DoT) cannot be more than Date of Packing.");
		for( var i=0; i<document.frmaddDepartment.protyp.length; i++)
		{
			document.getElementById('protyp').checked=false;
		}
		document.frmaddDepartment.protype.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.protype.value=protypval;
		if(protypval!="")
		{
			if(protypval=="E")
			{
				document.getElementById('recnobp1').value=document.frmaddDepartment.txtextnob1.value;
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value=0;
				document.getElementById('recqtyp1').value=document.frmaddDepartment.txtextqty1.value;
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value=0;
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value=document.frmaddDepartment.txtextnob2.value;
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value=0;
					document.getElementById('recqtyp2').value=document.frmaddDepartment.txtextqty2.value;
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value=0;
				}
				
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="";
				document.frmaddDepartment.txtconim.value="";
				document.frmaddDepartment.txtconpl.value="";
				document.frmaddDepartment.txtconloss.value="";
				document.frmaddDepartment.txtconper.value="";
			}
			else if(protypval=="P")
			{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=false;
				document.getElementById('recnobp1').style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=false;
				document.getElementById('recqtyp1').style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=false;
					document.getElementById('recnobp2').style.backgroundColor="#FFFFFF";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=false;
					document.getElementById('recqtyp2').style.backgroundColor="#FFFFFF";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="";
				document.frmaddDepartment.txtconim.value="";
				document.frmaddDepartment.txtconpl.value="";
				document.frmaddDepartment.txtconloss.value="";
				document.frmaddDepartment.txtconper.value="";
			}
			else
			{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="";
				document.frmaddDepartment.txtconim.value="";
				document.frmaddDepartment.txtconpl.value="";
				document.frmaddDepartment.txtconloss.value="";
				document.frmaddDepartment.txtconper.value="";
			}
		}
		else
		{
				document.getElementById('recnobp1').value="";
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value="";
				document.getElementById('recqtyp1').value="";
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value="";
				if (document.frmaddDepartment.srno2.value==2)
				{
					document.getElementById('recnobp2').value="";
					document.getElementById('recnobp2').readOnly=true;
					document.getElementById('recnobp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalnobp2').value="";
					document.getElementById('recqtyp2').value="";
					document.getElementById('recqtyp2').readOnly=true;
					document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
					document.getElementById('txtbalqtyp2').value="";
				}
				document.frmaddDepartment.txtconnob.value="";
				document.frmaddDepartment.txtconqty.value="";
				document.frmaddDepartment.txtconrem.value="";
				document.frmaddDepartment.txtconim.value="";
				document.frmaddDepartment.txtconpl.value="";
				document.frmaddDepartment.txtconloss.value="";
				document.frmaddDepartment.txtconper.value="";
		}
		document.getElementById('avlqtypck').value="";
		//alert(document.frmaddDepartment.paceptyp.length);
		for(q=1; q<=document.frmaddDepartment.paceptyp.length; q++)
		{
			//var fet="paceptyp"+q;
			document.getElementById("paceptyp").checked=false;
		}
			
		document.getElementById('picqtyp').value="";
		document.getElementById('picqtyp').readOnly=true;
		document.getElementById('picqtyp').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').readOnly=true;
		document.getElementById('balcnob').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').value="";
		document.getElementById('balcqty').value="";
		document.getElementById('conditionsloc').style.display="none";
		document.getElementById('pcktype').value="";
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			document.getElementById(det).innerHTML="Fill";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
		document.getElementById('txtwhg1').value="";
		document.getElementById('txtbing1').value="";
		document.getElementById('txtsubbg1').value="";
		document.getElementById('txtwhg2').value="";
		document.getElementById('txtbing2').value="";
		document.getElementById('txtsubbg2').value="";
		document.getElementById('txtwhg3').value="";
		document.getElementById('txtbing3').value="";
		document.getElementById('txtsubbg3').value="";
		document.getElementById('txtwhg4').value="";
		document.getElementById('txtbing4').value="";
		document.getElementById('txtsubbg4').value="";
		document.getElementById('txtwhg5').value="";
		document.getElementById('txtbing5').value="";
		document.getElementById('txtsubbg5').value="";
		document.getElementById('txtwhg6').value="";
		document.getElementById('txtbing6').value="";
		document.getElementById('txtsubbg6').value="";
		document.getElementById('txtwhg7').value="";
		document.getElementById('txtbing7').value="";
		document.getElementById('txtsubbg7').value="";
		document.getElementById('txtwhg8').value="";
		document.getElementById('txtbing8').value="";
		document.getElementById('txtsubbg8').value="";
		
		document.getElementById('nopmpcs_1').readOnly=true;
		document.getElementById('nopmpcs_1').value="";
		document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_2').readOnly=true;
		document.getElementById('nopmpcs_2').value="";
		document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_3').readOnly=true;
		document.getElementById('nopmpcs_3').value="";
		document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_4').readOnly=true;
		document.getElementById('nopmpcs_4').value="";
		document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_5').readOnly=true;
		document.getElementById('nopmpcs_5').value="";
		document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_6').readOnly=true;
		document.getElementById('nopmpcs_6').value="";
		document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_7').readOnly=true;
		document.getElementById('nopmpcs_7').value="";
		document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_8').readOnly=true;
		document.getElementById('nopmpcs_8').value="";
		document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noppchs_1').readOnly=true;
		document.getElementById('noppchs_1').value="";
		document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_2').readOnly=true;
		document.getElementById('noppchs_2').value="";
		document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_3').readOnly=true;
		document.getElementById('noppchs_3').value="";
		document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_4').readOnly=true;
		document.getElementById('noppchs_4').value="";
		document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_5').readOnly=true;
		document.getElementById('noppchs_5').value="";
		document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_6').readOnly=true;
		document.getElementById('noppchs_6').value="";
		document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_7').readOnly=true;
		document.getElementById('noppchs_7').value="";
		document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_8').readOnly=true;
		document.getElementById('noppchs_8').value="";
		document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptpchs_1').readOnly=true;
		document.getElementById('noptpchs_1').value="";
		document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_2').readOnly=true;
		document.getElementById('noptpchs_2').value="";
		document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_3').readOnly=true;
		document.getElementById('noptpchs_3').value="";
		document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_4').readOnly=true;
		document.getElementById('noptpchs_4').value="";
		document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_5').readOnly=true;
		document.getElementById('noptpchs_5').value="";
		document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_6').readOnly=true;
		document.getElementById('noptpchs_6').value="";
		document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_7').readOnly=true;
		document.getElementById('noptpchs_7').value="";
		document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_8').readOnly=true;
		document.getElementById('noptpchs_8').value="";
		document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptqtys_1').readOnly=true;
		document.getElementById('noptqtys_1').value="";
		document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_2').readOnly=true;
		document.getElementById('noptqtys_2').value="";
		document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_3').readOnly=true;
		document.getElementById('noptqtys_3').value="";
		document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_4').readOnly=true;
		document.getElementById('noptqtys_4').value="";
		document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_5').readOnly=true;
		document.getElementById('noptqtys_5').value="";
		document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_6').readOnly=true;
		document.getElementById('noptqtys_6').value="";
		document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_7').readOnly=true;
		document.getElementById('noptqtys_7').value="";
		document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_8').readOnly=true;
		document.getElementById('noptqtys_8').value="";
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";
	}
}

function chkpronob(nobval)
{
	if(document.frmaddDepartment.srno2.value==2)
	{
		if(document.getElementById('recqtyp1').value=="" && document.getElementById('recqtyp2').value=="")
		{
			alert("Enter Packing Qty");
			return false;
		}
	}
	else
	{
		if(document.getElementById('recqtyp1').value=="")
		{
			alert("Enter Packing Qty");
			return false;
		}
	}
	if(nobval!="")
	document.getElementById('avlnobpck').value=nobval;
	else
	document.getElementById('avlnobpck').value="";
}

function chkproqty(qtyval)
{
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Enter Condition Seed NoB");
		document.frmaddDepartment.txtconqty.value="";
		return false;
	}
	else
	{
		document.getElementById('avlqtypck').value=qtyval;
		for(q=1; q<=document.frmaddDepartment.paceptyp.length; q++)
		{
		//var fet="paceptyp"+q;
		document.getElementById("paceptyp").checked=false;
		}
		
		document.getElementById('picqtyp').value="";
		document.getElementById('picqtyp').readOnly=true;
		document.getElementById('picqtyp').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').readOnly=true;
		document.getElementById('balcnob').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').value="";
		document.getElementById('balcqty').value="";
		document.getElementById('conditionsloc').style.display="none";
		document.getElementById('pcktype').value="";
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			document.getElementById(det).innerHTML="Fill";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
		document.getElementById('txtwhg1').value="";
		document.getElementById('txtbing1').value="";
		document.getElementById('txtsubbg1').value="";
		document.getElementById('txtwhg2').value="";
		document.getElementById('txtbing2').value="";
		document.getElementById('txtsubbg2').value="";
		document.getElementById('txtwhg3').value="";
		document.getElementById('txtbing3').value="";
		document.getElementById('txtsubbg3').value="";
		document.getElementById('txtwhg4').value="";
		document.getElementById('txtbing4').value="";
		document.getElementById('txtsubbg4').value="";
		document.getElementById('txtwhg5').value="";
		document.getElementById('txtbing5').value="";
		document.getElementById('txtsubbg5').value="";
		document.getElementById('txtwhg6').value="";
		document.getElementById('txtbing6').value="";
		document.getElementById('txtsubbg6').value="";
		document.getElementById('txtwhg7').value="";
		document.getElementById('txtbing7').value="";
		document.getElementById('txtsubbg7').value="";
		document.getElementById('txtwhg8').value="";
		document.getElementById('txtbing8').value="";
		document.getElementById('txtsubbg8').value="";
		
		document.getElementById('nopmpcs_1').readOnly=true;
		document.getElementById('nopmpcs_1').value="";
		document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_2').readOnly=true;
		document.getElementById('nopmpcs_2').value="";
		document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_3').readOnly=true;
		document.getElementById('nopmpcs_3').value="";
		document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_4').readOnly=true;
		document.getElementById('nopmpcs_4').value="";
		document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_5').readOnly=true;
		document.getElementById('nopmpcs_5').value="";
		document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_6').readOnly=true;
		document.getElementById('nopmpcs_6').value="";
		document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_7').readOnly=true;
		document.getElementById('nopmpcs_7').value="";
		document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_8').readOnly=true;
		document.getElementById('nopmpcs_8').value="";
		document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noppchs_1').readOnly=true;
		document.getElementById('noppchs_1').value="";
		document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_2').readOnly=true;
		document.getElementById('noppchs_2').value="";
		document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_3').readOnly=true;
		document.getElementById('noppchs_3').value="";
		document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_4').readOnly=true;
		document.getElementById('noppchs_4').value="";
		document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_5').readOnly=true;
		document.getElementById('noppchs_5').value="";
		document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_6').readOnly=true;
		document.getElementById('noppchs_6').value="";
		document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_7').readOnly=true;
		document.getElementById('noppchs_7').value="";
		document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_8').readOnly=true;
		document.getElementById('noppchs_8').value="";
		document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptpchs_1').readOnly=true;
		document.getElementById('noptpchs_1').value="";
		document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_2').readOnly=true;
		document.getElementById('noptpchs_2').value="";
		document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_3').readOnly=true;
		document.getElementById('noptpchs_3').value="";
		document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_4').readOnly=true;
		document.getElementById('noptpchs_4').value="";
		document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_5').readOnly=true;
		document.getElementById('noptpchs_5').value="";
		document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_6').readOnly=true;
		document.getElementById('noptpchs_6').value="";
		document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_7').readOnly=true;
		document.getElementById('noptpchs_7').value="";
		document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_8').readOnly=true;
		document.getElementById('noptpchs_8').value="";
		document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptqtys_1').readOnly=true;
		document.getElementById('noptqtys_1').value="";
		document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_2').readOnly=true;
		document.getElementById('noptqtys_2').value="";
		document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_3').readOnly=true;
		document.getElementById('noptqtys_3').value="";
		document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_4').readOnly=true;
		document.getElementById('noptqtys_4').value="";
		document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_5').readOnly=true;
		document.getElementById('noptqtys_5').value="";
		document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_6').readOnly=true;
		document.getElementById('noptqtys_6').value="";
		document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_7').readOnly=true;
		document.getElementById('noptqtys_7').value="";
		document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_8').readOnly=true;
		document.getElementById('noptqtys_8').value="";
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";
	}
}
function chkconqty()
{
	var abc=0;
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Enter Condition Seed Qty");
		document.frmaddDepartment.txtconrem.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	if(document.frmaddDepartment.srno2.value==2)
	{
		abc=parseFloat(document.getElementById('recqtyp1').value)+ parseFloat(document.getElementById('recqtyp2').value);
	}
	else
	{
		abc=parseFloat(document.getElementById('recqtyp1').value);
	}	
	if(parseFloat(document.frmaddDepartment.txtconqty.value)> abc)
	{
		alert("Condition Seed Qty cannot be more than Total Quantity picked for Packing");
		document.frmaddDepartment.txtconrem.value="";
		return false;
	}
}
function chkrm()
{
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Enter Remnant (RM)");
		document.frmaddDepartment.txtconim.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
}

function chkim(plval)
{
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Enter Inert Material (IM)");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
	var tpl=parseFloat(document.frmaddDepartment.txtconrem.value)+parseFloat(document.frmaddDepartment.txtconim.value)+parseFloat(plval);
	var plper=parseFloat(document.getElementById('recqtyp1').value);
	if(document.frmaddDepartment.srno2.value==2)
	{
		plper=parseFloat(plper)+parseFloat(document.getElementById('recqtyp2').value);
	}
	
	//alert(tpl);
	//alert(document.frmaddDepartment.txtconqty.value);
	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.txtconqty.value);
	//alert((Math.round(totalval*1000)/1000));
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Packing is not eual to sum total of Condition Seed & Total Condition Loss");
		document.frmaddDepartment.txtconpl.value="";
		document.frmaddDepartment.txtconpl.focus();
		document.frmaddDepartment.txtconloss.value="";
		document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
	document.frmaddDepartment.txtconloss.value=tpl;
	var vaal=parseFloat(document.frmaddDepartment.txtconloss.value)/parseFloat(plper)*100;
	document.frmaddDepartment.txtconper.value=Math.round((vaal)*100)/100;
	}
	}
}

function sschk1()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtstage.selectedIndex=0;
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
	}
}

function sschk2()
{
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Select Stage");
		document.frmaddDepartment.txtpromech.selectedIndex=0;
		document.frmaddDepartment.txtstage.focus();
		return false;
	}
}

function sschk3()
{
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Select Processing Machine Code");
		document.frmaddDepartment.txtoprname.selectedIndex=0;
		document.frmaddDepartment.txtpromech.focus();
		return false;
	}
}

function sschk4()
{
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Select Operator");
		document.frmaddDepartment.txttreattyp.selectedIndex=0;
		document.frmaddDepartment.txtoprname.focus();
		return false;
	}
}

function mpchk(val1, val12)
{
	if(document.getElementById('lble_'+[val12]).value=="")
	{
		alert("Please enter Label No.");
		document.getElementById('mpck_'+[val12]).checked=false
		document.getElementById('lble_'+[val12]).focus()
		return false;
	}
	else
	{
		if(document.getElementById('mpck_'+[val12]).checked == true)
		{
			document.getElementById('nomp_'+[val12]).readOnly=false;
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#ffffff";
			//alert(document.getElementById('packqty_'+[val12]).value);
			//alert(document.getElementById('wtmp_'+[val12]).value);
			document.getElementById('nomp_'+[val12]).value=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
			
			var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
			//alert(document.getElementById('nopc_'+[val12]).value);
			//alert(balnop);
			document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
			document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
			document.getElementById('dtail_'+[val12]).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Fill</a>";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtbing1').value="";
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtwhg8').value="";
			document.getElementById('txtbing8').value="";
			document.getElementById('txtsubbg8').value="";
			
			document.getElementById('nopmpcs_1').readOnly=true;
			document.getElementById('nopmpcs_1').value="";
			document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_2').readOnly=true;
			document.getElementById('nopmpcs_2').value="";
			document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_3').readOnly=true;
			document.getElementById('nopmpcs_3').value="";
			document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_4').readOnly=true;
			document.getElementById('nopmpcs_4').value="";
			document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_5').readOnly=true;
			document.getElementById('nopmpcs_5').value="";
			document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_6').readOnly=true;
			document.getElementById('nopmpcs_6').value="";
			document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_7').readOnly=true;
			document.getElementById('nopmpcs_7').value="";
			document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_8').readOnly=true;
			document.getElementById('nopmpcs_8').value="";
			document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noppchs_1').readOnly=true;
			document.getElementById('noppchs_1').value="";
			document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_2').readOnly=true;
			document.getElementById('noppchs_2').value="";
			document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_3').readOnly=true;
			document.getElementById('noppchs_3').value="";
			document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_4').readOnly=true;
			document.getElementById('noppchs_4').value="";
			document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_5').readOnly=true;
			document.getElementById('noppchs_5').value="";
			document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_6').readOnly=true;
			document.getElementById('noppchs_6').value="";
			document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_7').readOnly=true;
			document.getElementById('noppchs_7').value="";
			document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_8').readOnly=true;
			document.getElementById('noppchs_8').value="";
			document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noptpchs_1').readOnly=true;
			document.getElementById('noptpchs_1').value="";
			document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_2').readOnly=true;
			document.getElementById('noptpchs_2').value="";
			document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_3').readOnly=true;
			document.getElementById('noptpchs_3').value="";
			document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_4').readOnly=true;
			document.getElementById('noptpchs_4').value="";
			document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_5').readOnly=true;
			document.getElementById('noptpchs_5').value="";
			document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_6').readOnly=true;
			document.getElementById('noptpchs_6').value="";
			document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_7').readOnly=true;
			document.getElementById('noptpchs_7').value="";
			document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_8').readOnly=true;
			document.getElementById('noptpchs_8').value="";
			document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noptqtys_1').readOnly=true;
			document.getElementById('noptqtys_1').value="";
			document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_2').readOnly=true;
			document.getElementById('noptqtys_2').value="";
			document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_3').readOnly=true;
			document.getElementById('noptqtys_3').value="";
			document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_4').readOnly=true;
			document.getElementById('noptqtys_4').value="";
			document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_5').readOnly=true;
			document.getElementById('noptqtys_5').value="";
			document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_6').readOnly=true;
			document.getElementById('noptqtys_6').value="";
			document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_7').readOnly=true;
			document.getElementById('noptqtys_7').value="";
			document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_8').readOnly=true;
			document.getElementById('noptqtys_8').value="";
			document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";
		}
		else
		{
			document.getElementById('nomp_'+[val12]).readOnly=true;
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			document.getElementById('dtail_'+[val12]).innerHTML="Fill";
			document.frmaddDepartment.detmpbno.value="";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtbing1').value="";
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtwhg8').value="";
			document.getElementById('txtbing8').value="";
			document.getElementById('txtsubbg8').value="";
			
			document.getElementById('nopmpcs_1').readOnly=true;
			document.getElementById('nopmpcs_1').value="";
			document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_2').readOnly=true;
			document.getElementById('nopmpcs_2').value="";
			document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_3').readOnly=true;
			document.getElementById('nopmpcs_3').value="";
			document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_4').readOnly=true;
			document.getElementById('nopmpcs_4').value="";
			document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_5').readOnly=true;
			document.getElementById('nopmpcs_5').value="";
			document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_6').readOnly=true;
			document.getElementById('nopmpcs_6').value="";
			document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_7').readOnly=true;
			document.getElementById('nopmpcs_7').value="";
			document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
			document.getElementById('nopmpcs_8').readOnly=true;
			document.getElementById('nopmpcs_8').value="";
			document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noppchs_1').readOnly=true;
			document.getElementById('noppchs_1').value="";
			document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_2').readOnly=true;
			document.getElementById('noppchs_2').value="";
			document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_3').readOnly=true;
			document.getElementById('noppchs_3').value="";
			document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_4').readOnly=true;
			document.getElementById('noppchs_4').value="";
			document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_5').readOnly=true;
			document.getElementById('noppchs_5').value="";
			document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_6').readOnly=true;
			document.getElementById('noppchs_6').value="";
			document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_7').readOnly=true;
			document.getElementById('noppchs_7').value="";
			document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
			document.getElementById('noppchs_8').readOnly=true;
			document.getElementById('noppchs_8').value="";
			document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noptpchs_1').readOnly=true;
			document.getElementById('noptpchs_1').value="";
			document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_2').readOnly=true;
			document.getElementById('noptpchs_2').value="";
			document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_3').readOnly=true;
			document.getElementById('noptpchs_3').value="";
			document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_4').readOnly=true;
			document.getElementById('noptpchs_4').value="";
			document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_5').readOnly=true;
			document.getElementById('noptpchs_5').value="";
			document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_6').readOnly=true;
			document.getElementById('noptpchs_6').value="";
			document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_7').readOnly=true;
			document.getElementById('noptpchs_7').value="";
			document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
			document.getElementById('noptpchs_8').readOnly=true;
			document.getElementById('noptpchs_8').value="";
			document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
			
			document.getElementById('noptqtys_1').readOnly=true;
			document.getElementById('noptqtys_1').value="";
			document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_2').readOnly=true;
			document.getElementById('noptqtys_2').value="";
			document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_3').readOnly=true;
			document.getElementById('noptqtys_3').value="";
			document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_4').readOnly=true;
			document.getElementById('noptqtys_4').value="";
			document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_5').readOnly=true;
			document.getElementById('noptqtys_5').value="";
			document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_6').readOnly=true;
			document.getElementById('noptqtys_6').value="";
			document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_7').readOnly=true;
			document.getElementById('noptqtys_7').value="";
			document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
			document.getElementById('noptqtys_8').readOnly=true;
			document.getElementById('noptqtys_8').value="";
			document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";
		}
	}
}

function balnopcheck(balval, val12)
{
	if(parseInt(balval) > 0)
	{
		var pty=document.getElementById("upsname_"+[val12]).value.split(" ");
		var wtmp="wtmp_"+val12;
		if(pty[1]=="Gms")
		{ 
			var ppt=(1000/parseFloat(pty[0]));
			var ppt1=(parseFloat(pty[0])/1000);
		}
		else
		{
			var ppt=pty[0];
			var ppt1=pty[0];
		}
		/*{
			var ppt=(parseFloat(pty[0])/1000);
		}
		else
		{
			var ppt=pty[0];
		}*/
		
		if(pty[1]=="Gms")
		var nop=(parseFloat(balval)*parseFloat(ppt));
		else
		var nop=(parseFloat(balval)*parseFloat(ppt));
		nop=nop.toFixed(3);
		//alert(nop);
		if(parseInt(nop) >= parseInt(document.getElementById('wtmp_'+[val12]).value))
		{
			alert("Qty cannot be greater than Master Pack Size");
			document.getElementById('pqty_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).focus();
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			document.getElementById('bqty_'+[val12]).value="";
			return false;
		}
		else if(parseInt(balval) > parseInt(document.getElementById('wtnop_'+[val12]).value))
		{
			alert("No. of Pouches cannot be greater than Master Pack Size");
			document.getElementById('pqty_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).focus();
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			document.getElementById('bqty_'+[val12]).value="";
			return false;
		}
		else
		{
			document.getElementById('pqty_'+[val12]).value=parseFloat(nop);
			document.getElementById('pqty_'+[val12]).value=document.getElementById('pqty_'+[val12]).value.toFixed(3);
			document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balval);
			document.getElementById('bqty_'+[val12]).value=parseFloat(document.getElementById('packoqty_'+[val12]).value)-parseFloat(nop);
			document.getElementById('bqty_'+[val12]).value=parseFloat(document.getElementById('bqty_'+[val12]).value).toFixed(3);
		}
	}
	else
	{
		alert("No. of Pouches cannot be Zero");
		document.getElementById('nomp_'+[val12]).focus();
		document.getElementById('noofpacks_'+[val12]).value="";
		return false;
	}
}

function balqtcheck(balval, val12)
{
	if(parseFloat(balval) > 0)
	{
		var pty=document.getElementById("upsname_"+[val12]).value.split(" ");
		var wtmp="wtmp_"+val12;
		if(pty[1]=="Gms")
		{ 
			var ppt=(1000/parseFloat(pty[0]));
			var ppt1=(parseFloat(pty[0])/1000);
		}
		else
		{
			var ppt=pty[0];
			var ppt1=pty[0];
		}
		//alert(ppt);alert(balval);
		if(pty[1]=="Gms")
		var nop=(parseFloat(balval)*parseFloat(ppt));
		else
		var nop=(parseFloat(balval)*parseFloat(ppt));
		nop=nop.toFixed(0);
		//alert(nop);
		if(parseInt(balval) >= parseInt(document.getElementById('wtmp_'+[val12]).value))
		{
			alert("Qty cannot be greater than Master Pack Size");
			document.getElementById('pqty_'+[val12]).value="";
			document.getElementById('pqty_'+[val12]).focus();
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			document.getElementById('bqty_'+[val12]).value="";
			return false;
		}
		else if(parseInt(nop) > parseInt(document.getElementById('wtnop_'+[val12]).value))
		{
			alert("No. of Pouches cannot be greater than Master Pack Size");
			document.getElementById('pqty_'+[val12]).value="";
			document.getElementById('pqty_'+[val12]).focus();
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			document.getElementById('bqty_'+[val12]).value="";
			return false;
		}
		else
		{
			document.getElementById('nomp_'+[val12]).value=parseInt(nop);
			document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(document.getElementById('nomp_'+[val12]).value);
			document.getElementById('bqty_'+[val12]).value=parseFloat(document.getElementById('packoqty_'+[val12]).value)-parseFloat(balval);
			document.getElementById('bqty_'+[val12]).value=parseFloat(document.getElementById('bqty_'+[val12]).value).toFixed(3);
		}
	}
	else
	{
		alert("No. of Pouches cannot be Zero");
		document.getElementById('pqty_'+[val12]).value="";
		document.getElementById('pqty_'+[val12]).focus();
		document.getElementById('nomp_'+[val12]).value="";
		document.getElementById('noofpacks_'+[val12]).value="";
		document.getElementById('bqty_'+[val12]).value="";
		return false;
	}
}
function pacpchk(pacpcval, snoval, sno33val)
{
	var nomp="nomp_"+snoval;
	var nophs="nophs"+snoval+"_"+sno33val;
	var qtyphs="qtyphs"+snoval+"_"+sno33val;
	var balnophs="balnophs"+snoval+"_"+sno33val;
	var extnophs="extnophs"+snoval+"_"+sno33val;
	var extqtyhs="extqtyhs"+snoval+"_"+sno33val;
	var sno33="sno33_"+snoval;
	var tonop=0;
	var f=0;
	var pty=document.getElementById("upsname_"+[snoval]).value.split(" ");
	var wtmp="wtmp_"+snoval;
	if(pty[1]=="Gms")
	{ 
		var ppt=(1000/parseFloat(pty[0]));
		var ppt1=(parseFloat(pty[0])/1000);
	}
	else
	{
		var ppt=pty[0];
		var ppt1=pty[0];
	}
	if(pty[1]=="Gms")
	var nop=(parseFloat(pacpcval)*parseFloat(ppt));
	else
	var nop=(parseFloat(pacpcval)/parseFloat(ppt));
	
	document.getElementById(qtyphs).value=parseInt(nop);
	document.getElementById(qtyphs).value=parseFloat(document.getElementById(qtyphs).value).toFixed(3);
	if(parseInt(document.getElementById(nophs).value)>parseInt(document.getElementById(nomp).value))
	{
		alert("NoP from SLOC cannot be more than NoP");
		document.getElementById(nophs).value="";
		document.getElementById(balnophs).value="";
		document.getElementById(nophs).focus();
		f=1;
		return false;
	}
	for (var i=1; i<=document.getElementById(sno33).value; i++)
	{
		tonop=parseInt(tonop)+parseInt(document.getElementById(nophs).value);
	}
	if(parseInt(tonop)==0)
	{
		alert("Please enter NoP");
		document.getElementById(nophs).value="";
		document.getElementById(balnophs).value="";
		document.getElementById(nophs).focus();
		f=1;
		return false;
	}
	if(parseInt(tonop)>parseInt(document.getElementById(nomp).value))
	{
		alert("Total of NoP from SLOC cannot be more than NoP");
		document.getElementById(nophs).value="";
		document.getElementById(balnophs).value="";
		document.getElementById(nophs).focus();
		f=1;
		return false;
	}
	if(f==0)
	{
		document.getElementById(balnophs).value=parseInt(document.getElementById(extnophs).value)-parseInt(document.getElementById(nophs).value);
		if(parseInt(document.getElementById(balnophs).value)<0)document.getElementById(balnophs).value=0;
		return true;
	}
	else
	{
		return false;
	}
}
function pacqtychk(pacpcval, snoval, sno33val)
{
	var nomp="nomp_"+snoval;
	var nophs="nophs"+snoval+"_"+sno33val;
	var qtyphs="qtyphs"+snoval+"_"+sno33val;
	var balnophs="balnophs"+snoval+"_"+sno33val;
	var extnophs="extnophs"+snoval+"_"+sno33val;
	var extqtyhs="extqtyhs"+snoval+"_"+sno33val;
	var sno33="sno33_"+snoval;
	var tonop=0;
	var f=0;
	var pty=document.getElementById("upsname_"+[snoval]).value.split(" ");
	var wtmp="wtmp_"+snoval;
	if(pty[1]=="Gms")
	{ 
		var ppt=(1000/parseFloat(pty[0]));
		var ppt1=(parseFloat(pty[0])/1000);
	}
	else
	{
		var ppt=pty[0];
		var ppt1=pty[0];
	}
	if(pty[1]=="Gms")
	var nop=(parseFloat(pacpcval)*parseFloat(ppt));
	else
	var nop=(parseFloat(pacpcval)/parseFloat(ppt));
	//var nop=(parseFloat(pacpcval)*parseFloat(ppt));
	nop=nop.toFixed(0);
	document.getElementById(nophs).value=parseInt(nop);
	
	if(parseInt(document.getElementById(nophs).value)>parseInt(document.getElementById(nomp).value))
	{
		alert("NoP from SLOC cannot be more than NoP");
		document.getElementById(nophs).value="";
		document.getElementById(balnophs).value="";
		document.getElementById(nophs).focus();
		f=1;
		return false;
	}
	for (var i=1; i<=document.getElementById(sno33).value; i++)
	{
		tonop=parseInt(tonop)+parseInt(document.getElementById(nophs).value);
	}
	if(parseInt(tonop)==0)
	{
		alert("Please enter NoP");
		document.getElementById(nophs).value="";
		document.getElementById(balnophs).value="";
		document.getElementById(nophs).focus();
		f=1;
		return false;
	}
	if(parseInt(tonop)>parseInt(document.getElementById(nomp).value))
	{
		alert("Total of NoP from SLOC cannot be more than NoP");
		document.getElementById(nophs).value="";
		document.getElementById(balnophs).value="";
		document.getElementById(nophs).focus();
		f=1;
		return false;
	}
	if(f==0)
	{
		document.getElementById(balnophs).value=parseInt(document.getElementById(extnophs).value)-parseInt(document.getElementById(nophs).value);
		if(parseInt(document.getElementById(balnophs).value)<0)document.getElementById(balnophs).value=0;
		return true;
	}
	else
	{
		return false;
	}
}
function pcksel(pkselval)
{ //alert(pkselval);
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		for( var i=0; i<document.frmaddDepartment.paceptyp.length; i++)
		{
			document.getElementById('paceptyp').checked=false;
		}
		document.frmaddDepartment.pcktype.value="";
		return false;
	}
	else
	{
		if(pkselval=="P")
		{
			document.getElementById('txtbalnobp1').value="";
			document.getElementById('recqtyp1').value="";
			document.getElementById('recqtyp1').readOnly=false;
			document.getElementById('recqtyp1').style.backgroundColor="#FFFFFF";
			document.getElementById('txtbalqtyp1').value="";
			if (document.frmaddDepartment.srno2.value==2)
			{
				document.getElementById('txtbalnobp2').value="";
				document.getElementById('recqtyp2').value="";
				document.getElementById('recqtyp2').readOnly=false;
				document.getElementById('recqtyp2').style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalqtyp2').value="";
			}
			document.getElementById('picqtyp').value="";
			document.getElementById('balpck').value="";
		}
		else
		{
			document.getElementById('txtbalnobp1').value=0;
			document.getElementById('recqtyp1').value=document.getElementById('txtextqty1').value;
			document.getElementById('recqtyp1').readOnly=true;
			document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp1').value=0;
			var val2=0.00;
			if (document.frmaddDepartment.srno2.value==2)
			{
				document.getElementById('txtbalnobp2').value=0;
				document.getElementById('recqtyp2').value=document.getElementById('txtextqty2').value;
				document.getElementById('recqtyp2').readOnly=true;
				document.getElementById('recqtyp2').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp2').value=0;
				val2=parseFloat(document.getElementById('txtextqty2').value);
			}
			document.getElementById('picqtyp').value=parseFloat(document.getElementById('txtextqty1').value)+parseFloat(val2);
			document.getElementById('picqtyp').readOnly=true;
			document.getElementById('picqtyp').style.backgroundColor="#cccccc";
			var pckloss=document.getElementById('pckloss').value;
			var ccloss=document.getElementById('ccloss').value;
			if(pckloss=="")pckloss=0;
			if(ccloss=="")ccloss=0;
			document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(pckloss)+parseFloat(ccloss))
		}
		document.getElementById('pcktype').value=pkselval;
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			//alert(j);
			var a="packqty_"+j;
			var b="nopc_"+j;
			var c="domcs_"+j;
			var d="lbls_"+j;
			var e="domce_"+j;
			var f="lble_"+j;
			var g="mpck_"+j;
			var h="nomp_"+j;
			var i="noofpacks_"+j;
			var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			document.getElementById(det).innerHTML="Fill";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
		document.getElementById('txtwhg1').value="";
		document.getElementById('txtbing1').value="";
		document.getElementById('txtsubbg1').value="";
		document.getElementById('txtwhg2').value="";
		document.getElementById('txtbing2').value="";
		document.getElementById('txtsubbg2').value="";
		document.getElementById('txtwhg3').value="";
		document.getElementById('txtbing3').value="";
		document.getElementById('txtsubbg3').value="";
		document.getElementById('txtwhg4').value="";
		document.getElementById('txtbing4').value="";
		document.getElementById('txtsubbg4').value="";
		document.getElementById('txtwhg5').value="";
		document.getElementById('txtbing5').value="";
		document.getElementById('txtsubbg5').value="";
		document.getElementById('txtwhg6').value="";
		document.getElementById('txtbing6').value="";
		document.getElementById('txtsubbg6').value="";
		document.getElementById('txtwhg7').value="";
		document.getElementById('txtbing7').value="";
		document.getElementById('txtsubbg7').value="";
		document.getElementById('txtwhg8').value="";
		document.getElementById('txtbing8').value="";
		document.getElementById('txtsubbg8').value="";
		
		document.getElementById('nopmpcs_1').readOnly=true;
		document.getElementById('nopmpcs_1').value="";
		document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_2').readOnly=true;
		document.getElementById('nopmpcs_2').value="";
		document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_3').readOnly=true;
		document.getElementById('nopmpcs_3').value="";
		document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_4').readOnly=true;
		document.getElementById('nopmpcs_4').value="";
		document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_5').readOnly=true;
		document.getElementById('nopmpcs_5').value="";
		document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_6').readOnly=true;
		document.getElementById('nopmpcs_6').value="";
		document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_7').readOnly=true;
		document.getElementById('nopmpcs_7').value="";
		document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
		document.getElementById('nopmpcs_8').readOnly=true;
		document.getElementById('nopmpcs_8').value="";
		document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noppchs_1').readOnly=true;
		document.getElementById('noppchs_1').value="";
		document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_2').readOnly=true;
		document.getElementById('noppchs_2').value="";
		document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_3').readOnly=true;
		document.getElementById('noppchs_3').value="";
		document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_4').readOnly=true;
		document.getElementById('noppchs_4').value="";
		document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_5').readOnly=true;
		document.getElementById('noppchs_5').value="";
		document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_6').readOnly=true;
		document.getElementById('noppchs_6').value="";
		document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_7').readOnly=true;
		document.getElementById('noppchs_7').value="";

		document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noppchs_8').readOnly=true;
		document.getElementById('noppchs_8').value="";
		document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptpchs_1').readOnly=true;
		document.getElementById('noptpchs_1').value="";
		document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_2').readOnly=true;
		document.getElementById('noptpchs_2').value="";
		document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_3').readOnly=true;
		document.getElementById('noptpchs_3').value="";
		document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_4').readOnly=true;
		document.getElementById('noptpchs_4').value="";
		document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_5').readOnly=true;
		document.getElementById('noptpchs_5').value="";
		document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_6').readOnly=true;
		document.getElementById('noptpchs_6').value="";
		document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_7').readOnly=true;
		document.getElementById('noptpchs_7').value="";
		document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
		document.getElementById('noptpchs_8').readOnly=true;
		document.getElementById('noptpchs_8').value="";
		document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
		
		document.getElementById('noptqtys_1').readOnly=true;
		document.getElementById('noptqtys_1').value="";
		document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_2').readOnly=true;
		document.getElementById('noptqtys_2').value="";
		document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_3').readOnly=true;
		document.getElementById('noptqtys_3').value="";
		document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_4').readOnly=true;
		document.getElementById('noptqtys_4').value="";
		document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_5').readOnly=true;
		document.getElementById('noptqtys_5').value="";
		document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_6').readOnly=true;
		document.getElementById('noptqtys_6').value="";
		document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_7').readOnly=true;
		document.getElementById('noptqtys_7').value="";
		document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
		document.getElementById('noptqtys_8').readOnly=true;
		document.getElementById('noptqtys_8').value="";
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";
	}
}

function chktotpouches(qtyval, qtyno)
{
	if(parseFloat(document.frmaddDepartment.balpck.value)!=parseFloat(qtyval))
	{
		alert("Please check. Quantity selected for packing and Quantity entered in Pack Seed is not matching");
		var packqty="packqty_"+qtyno;
		var nopc="nopc_"+qtyno;
		var domcs="domcs_"+qtyno;
		var lbls="lbls_"+qtyno;
		var domce="domce_"+qtyno;
		var lble="lble_"+qtyno;
		var mpck="mpck_"+qtyno;
		var nomp="nomp_"+qtyno;
		var noofpacks="noofpacks_"+qtyno;
		var detmpbno="detmpbno";
		
		document.getElementById(packqty).value="";
		document.getElementById(nopc).value="";
		document.getElementById(domcs).value="";
		document.getElementById(lbls).value="";
		document.getElementById(domce).value="";
		document.getElementById(lble).value="";
		document.getElementById(mpck).value="";
		document.getElementById(nomp).value="";
		document.getElementById(noofpacks).value="";
		document.getElementById(detmpbno).value="";
		return false;
	}
	else
	{
	var wtnop="wtnopkg_"+qtyno;
	var z="nopc_"+qtyno;
	var ds="noofpacks_"+qtyno;
	var zx=(parseFloat(qtyval)/parseFloat(document.getElementById(wtnop).value));
	document.getElementById(z).value=parseInt(zx);
	document.getElementById(ds).value=parseInt(zx);
	}
}

function domcchk(val1, val2)
{
var x="domce_"+val2;
if(val1!="")
{
document.getElementById(x).value=val1;
}
else
{
document.getElementById(x).value="";
}
}

function domchk(dval)
{
	var x="domcs_"+dval;
	if(document.getElementById(x).value=="")
	{
		alert("Please select Label character");
		return false;
	}
}

function domchk1(lbval, dval)
{
	var x="lbls_"+dval;
	var tx="lble_"+dval;
	if(document.getElementById(x).value=="")
	{
		alert("Please enter Label number");
		document.getElementById(tx).focus();
		return false;
	}
	else
	{
		var z="nopc_"+dval;
		var xx="lble_"+dval;
		if(parseInt(lbval)-parseInt(document.getElementById(x).value)<parseInt(document.getElementById(z).value))
		{
			alert("Total Label nos. are not matching with No. of Pouches");
			document.getElementById(xx).value="";
			return false;
		}
	}
}

function pfpchk(pfpval)
{
	document.getElementById('balcqty').value=parseFloat(document.getElementById('avlqtypck').value)-parseFloat(pfpval);
	if(document.getElementById('balcqty').value<=0)
	{
		document.getElementById('balcqty').value=0;
		document.getElementById('balcnob').value=0;
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		document.getElementById(det).innerHTML="Fill";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
	document.getElementById('txtwhg1').value="";
	document.getElementById('txtbing1').value="";
	document.getElementById('txtsubbg1').value="";
	document.getElementById('txtwhg2').value="";
	document.getElementById('txtbing2').value="";
	document.getElementById('txtsubbg2').value="";
	document.getElementById('txtwhg3').value="";
	document.getElementById('txtbing3').value="";
	document.getElementById('txtsubbg3').value="";
	document.getElementById('txtwhg4').value="";
	document.getElementById('txtbing4').value="";
	document.getElementById('txtsubbg4').value="";
	document.getElementById('txtwhg5').value="";
	document.getElementById('txtbing5').value="";
	document.getElementById('txtsubbg5').value="";
	document.getElementById('txtwhg6').value="";
	document.getElementById('txtbing6').value="";
	document.getElementById('txtsubbg6').value="";
	document.getElementById('txtwhg7').value="";
	document.getElementById('txtbing7').value="";
	document.getElementById('txtsubbg7').value="";
	document.getElementById('txtwhg8').value="";
	document.getElementById('txtbing8').value="";
	document.getElementById('txtsubbg8').value="";
	
	document.getElementById('nopmpcs_1').readOnly=true;
	document.getElementById('nopmpcs_1').value="";
	document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_2').readOnly=true;
	document.getElementById('nopmpcs_2').value="";
	document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_3').readOnly=true;
	document.getElementById('nopmpcs_3').value="";
	document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_4').readOnly=true;
	document.getElementById('nopmpcs_4').value="";
	document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_5').readOnly=true;
	document.getElementById('nopmpcs_5').value="";
	document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_6').readOnly=true;
	document.getElementById('nopmpcs_6').value="";
	document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_7').readOnly=true;
	document.getElementById('nopmpcs_7').value="";
	document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_8').readOnly=true;
	document.getElementById('nopmpcs_8').value="";
	document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noppchs_1').readOnly=true;
	document.getElementById('noppchs_1').value="";
	document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_2').readOnly=true;
	document.getElementById('noppchs_2').value="";
	document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_3').readOnly=true;
	document.getElementById('noppchs_3').value="";
	document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_4').readOnly=true;
	document.getElementById('noppchs_4').value="";
	document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_5').readOnly=true;
	document.getElementById('noppchs_5').value="";
	document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_6').readOnly=true;
	document.getElementById('noppchs_6').value="";
	document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_7').readOnly=true;
	document.getElementById('noppchs_7').value="";
	document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_8').readOnly=true;
	document.getElementById('noppchs_8').value="";
	document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptpchs_1').readOnly=true;
	document.getElementById('noptpchs_1').value="";
	document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_2').readOnly=true;
	document.getElementById('noptpchs_2').value="";
	document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_3').readOnly=true;
	document.getElementById('noptpchs_3').value="";
	document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_4').readOnly=true;
	document.getElementById('noptpchs_4').value="";
	document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_5').readOnly=true;
	document.getElementById('noptpchs_5').value="";
	document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_6').readOnly=true;
	document.getElementById('noptpchs_6').value="";
	document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_7').readOnly=true;
	document.getElementById('noptpchs_7').value="";
	document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_8').readOnly=true;
	document.getElementById('noptpchs_8').value="";
	document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptqtys_1').readOnly=true;
	document.getElementById('noptqtys_1').value="";
	document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_2').readOnly=true;
	document.getElementById('noptqtys_2').value="";
	document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_3').readOnly=true;
	document.getElementById('noptqtys_3').value="";
	document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_4').readOnly=true;
	document.getElementById('noptqtys_4').value="";
	document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_5').readOnly=true;
	document.getElementById('noptqtys_5').value="";
	document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_6').readOnly=true;
	document.getElementById('noptqtys_6').value="";
	document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_7').readOnly=true;
	document.getElementById('noptqtys_7').value="";
	document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_8').readOnly=true;
	document.getElementById('noptqtys_8').value="";
	document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";
}
function pfpchk1(pfpval)
{
	if(document.getElementById('picqtyp').value=="" || document.getElementById('picqtyp').value==0)
	{
		alert("Quantity Picked for Packing cannot be blank or Zero");
		document.getElementById('pckloss').value="";
		return false;
	}
	else
	{
		document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('ccloss').value)+parseFloat(pfpval));
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		document.getElementById(det).innerHTML="Fill";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
	document.getElementById('txtwhg1').value="";
	document.getElementById('txtbing1').value="";
	document.getElementById('txtsubbg1').value="";
	document.getElementById('txtwhg2').value="";
	document.getElementById('txtbing2').value="";
	document.getElementById('txtsubbg2').value="";
	document.getElementById('txtwhg3').value="";
	document.getElementById('txtbing3').value="";
	document.getElementById('txtsubbg3').value="";
	document.getElementById('txtwhg4').value="";
	document.getElementById('txtbing4').value="";
	document.getElementById('txtsubbg4').value="";
	document.getElementById('txtwhg5').value="";
	document.getElementById('txtbing5').value="";
	document.getElementById('txtsubbg5').value="";
	document.getElementById('txtwhg6').value="";
	document.getElementById('txtbing6').value="";
	document.getElementById('txtsubbg6').value="";
	document.getElementById('txtwhg7').value="";
	document.getElementById('txtbing7').value="";
	document.getElementById('txtsubbg7').value="";
	document.getElementById('txtwhg8').value="";
	document.getElementById('txtbing8').value="";
	document.getElementById('txtsubbg8').value="";
	
	document.getElementById('nopmpcs_1').readOnly=true;
	document.getElementById('nopmpcs_1').value="";
	document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_2').readOnly=true;
	document.getElementById('nopmpcs_2').value="";
	document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_3').readOnly=true;
	document.getElementById('nopmpcs_3').value="";
	document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_4').readOnly=true;
	document.getElementById('nopmpcs_4').value="";
	document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_5').readOnly=true;
	document.getElementById('nopmpcs_5').value="";
	document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_6').readOnly=true;
	document.getElementById('nopmpcs_6').value="";
	document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_7').readOnly=true;
	document.getElementById('nopmpcs_7').value="";
	document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_8').readOnly=true;
	document.getElementById('nopmpcs_8').value="";
	document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noppchs_1').readOnly=true;
	document.getElementById('noppchs_1').value="";
	document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_2').readOnly=true;
	document.getElementById('noppchs_2').value="";
	document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_3').readOnly=true;
	document.getElementById('noppchs_3').value="";
	document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_4').readOnly=true;
	document.getElementById('noppchs_4').value="";
	document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_5').readOnly=true;
	document.getElementById('noppchs_5').value="";
	document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_6').readOnly=true;
	document.getElementById('noppchs_6').value="";
	document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_7').readOnly=true;
	document.getElementById('noppchs_7').value="";
	document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_8').readOnly=true;
	document.getElementById('noppchs_8').value="";
	document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptpchs_1').readOnly=true;
	document.getElementById('noptpchs_1').value="";
	document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_2').readOnly=true;
	document.getElementById('noptpchs_2').value="";
	document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_3').readOnly=true;
	document.getElementById('noptpchs_3').value="";
	document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_4').readOnly=true;
	document.getElementById('noptpchs_4').value="";
	document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_5').readOnly=true;
	document.getElementById('noptpchs_5').value="";
	document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_6').readOnly=true;
	document.getElementById('noptpchs_6').value="";
	document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_7').readOnly=true;
	document.getElementById('noptpchs_7').value="";
	document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_8').readOnly=true;
	document.getElementById('noptpchs_8').value="";
	document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptqtys_1').readOnly=true;
	document.getElementById('noptqtys_1').value="";
	document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_2').readOnly=true;
	document.getElementById('noptqtys_2').value="";
	document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_3').readOnly=true;
	document.getElementById('noptqtys_3').value="";
	document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_4').readOnly=true;
	document.getElementById('noptqtys_4').value="";
	document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_5').readOnly=true;
	document.getElementById('noptqtys_5').value="";
	document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_6').readOnly=true;
	document.getElementById('noptqtys_6').value="";
	document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_7').readOnly=true;
	document.getElementById('noptqtys_7').value="";
	document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_8').readOnly=true;
	document.getElementById('noptqtys_8').value="";
	document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";
}
function plchk1(pfpval)
{
	if(document.getElementById('pckloss').value=="")
	{
		alert("Packing Loss cannot be blank");
		document.getElementById('ccloss').value="";
		return false;
	}
	else
	{
		document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('pckloss').value)+parseFloat(pfpval));
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		//alert(j);
		var a="packqty_"+j;
		var b="nopc_"+j;
		var c="domcs_"+j;
		var d="lbls_"+j;
		var e="domce_"+j;
		var f="lble_"+j;
		var g="mpck_"+j;
		var h="nomp_"+j;
		var i="noofpacks_"+j;
		var det="dtail_"+j;
		//alert(det);
		document.getElementById(a).value="";
		document.getElementById(b).value="";
		document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		document.getElementById(det).innerHTML="Fill";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
	document.getElementById('txtwhg1').value="";
	document.getElementById('txtbing1').value="";
	document.getElementById('txtsubbg1').value="";
	document.getElementById('txtwhg2').value="";
	document.getElementById('txtbing2').value="";
	document.getElementById('txtsubbg2').value="";
	document.getElementById('txtwhg3').value="";
	document.getElementById('txtbing3').value="";
	document.getElementById('txtsubbg3').value="";
	document.getElementById('txtwhg4').value="";
	document.getElementById('txtbing4').value="";
	document.getElementById('txtsubbg4').value="";
	document.getElementById('txtwhg5').value="";
	document.getElementById('txtbing5').value="";
	document.getElementById('txtsubbg5').value="";
	document.getElementById('txtwhg6').value="";
	document.getElementById('txtbing6').value="";
	document.getElementById('txtsubbg6').value="";
	document.getElementById('txtwhg7').value="";
	document.getElementById('txtbing7').value="";
	document.getElementById('txtsubbg7').value="";
	document.getElementById('txtwhg8').value="";
	document.getElementById('txtbing8').value="";
	document.getElementById('txtsubbg8').value="";
	
	document.getElementById('nopmpcs_1').readOnly=true;
	document.getElementById('nopmpcs_1').value="";
	document.getElementById('nopmpcs_1').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_2').readOnly=true;
	document.getElementById('nopmpcs_2').value="";
	document.getElementById('nopmpcs_2').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_3').readOnly=true;
	document.getElementById('nopmpcs_3').value="";
	document.getElementById('nopmpcs_3').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_4').readOnly=true;
	document.getElementById('nopmpcs_4').value="";
	document.getElementById('nopmpcs_4').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_5').readOnly=true;
	document.getElementById('nopmpcs_5').value="";
	document.getElementById('nopmpcs_5').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_6').readOnly=true;
	document.getElementById('nopmpcs_6').value="";
	document.getElementById('nopmpcs_6').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_7').readOnly=true;
	document.getElementById('nopmpcs_7').value="";
	document.getElementById('nopmpcs_7').style.backgroundColor="#cccccc";
	document.getElementById('nopmpcs_8').readOnly=true;
	document.getElementById('nopmpcs_8').value="";
	document.getElementById('nopmpcs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noppchs_1').readOnly=true;
	document.getElementById('noppchs_1').value="";
	document.getElementById('noppchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_2').readOnly=true;
	document.getElementById('noppchs_2').value="";
	document.getElementById('noppchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_3').readOnly=true;
	document.getElementById('noppchs_3').value="";
	document.getElementById('noppchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_4').readOnly=true;
	document.getElementById('noppchs_4').value="";
	document.getElementById('noppchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_5').readOnly=true;
	document.getElementById('noppchs_5').value="";
	document.getElementById('noppchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_6').readOnly=true;
	document.getElementById('noppchs_6').value="";
	document.getElementById('noppchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_7').readOnly=true;
	document.getElementById('noppchs_7').value="";
	document.getElementById('noppchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noppchs_8').readOnly=true;
	document.getElementById('noppchs_8').value="";
	document.getElementById('noppchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptpchs_1').readOnly=true;
	document.getElementById('noptpchs_1').value="";
	document.getElementById('noptpchs_1').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_2').readOnly=true;
	document.getElementById('noptpchs_2').value="";
	document.getElementById('noptpchs_2').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_3').readOnly=true;
	document.getElementById('noptpchs_3').value="";
	document.getElementById('noptpchs_3').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_4').readOnly=true;
	document.getElementById('noptpchs_4').value="";
	document.getElementById('noptpchs_4').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_5').readOnly=true;
	document.getElementById('noptpchs_5').value="";
	document.getElementById('noptpchs_5').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_6').readOnly=true;
	document.getElementById('noptpchs_6').value="";
	document.getElementById('noptpchs_6').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_7').readOnly=true;
	document.getElementById('noptpchs_7').value="";
	document.getElementById('noptpchs_7').style.backgroundColor="#cccccc";
	document.getElementById('noptpchs_8').readOnly=true;
	document.getElementById('noptpchs_8').value="";
	document.getElementById('noptpchs_8').style.backgroundColor="#cccccc";
	
	document.getElementById('noptqtys_1').readOnly=true;
	document.getElementById('noptqtys_1').value="";
	document.getElementById('noptqtys_1').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_2').readOnly=true;
	document.getElementById('noptqtys_2').value="";
	document.getElementById('noptqtys_2').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_3').readOnly=true;
	document.getElementById('noptqtys_3').value="";
	document.getElementById('noptqtys_3').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_4').readOnly=true;
	document.getElementById('noptqtys_4').value="";
	document.getElementById('noptqtys_4').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_5').readOnly=true;
	document.getElementById('noptqtys_5').value="";
	document.getElementById('noptqtys_5').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_6').readOnly=true;
	document.getElementById('noptqtys_6').value="";
	document.getElementById('noptqtys_6').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_7').readOnly=true;
	document.getElementById('noptqtys_7').value="";
	document.getElementById('noptqtys_7').style.backgroundColor="#cccccc";
	document.getElementById('noptqtys_8').readOnly=true;
	document.getElementById('noptqtys_8').value="";
	document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";
}
function clk(snoval,upsid)
{
	//alert(snoval);
	var sno=document.frmaddDepartment.sno.value;
	//alert(sno);
	if(document.getElementById('ccloss').value=="")
	{
		alert("Captive Consumption cannot be blank");
		//document.getElementById('ccloss').value="";
		for(var i=1; i<=sno; i++)
		{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Fill";
		}
		return false;
	}
	else
	{
		if(snoval>0)
		{
			var upsname="upsname_"+snoval;
			document.frmaddDepartment.upssize.value=snoval;
			document.frmaddDepartment.upsidno.value=upsid;
			
			for(var j=1; j<=sno; j++)
			{
				//alert(j);
				var a="packqty_"+j;
				var b="nopc_"+j;
				var c="domcs_"+j;
				var d="lbls_"+j;
				var e="domce_"+j;
				var f="lble_"+j;
				var g="mpck_"+j;
				var h="nomp_"+j;
				var i="noofpacks_"+j;
				var det="dtail_"+j;
				//alert(det);
				document.getElementById(a).value="";
				document.getElementById(b).value="";
				document.getElementById(c).value="";
				document.getElementById(d).value="";
				document.getElementById(e).value="";
				document.getElementById(f).value="";
				document.getElementById(g).checked=false;
				document.getElementById(h).value="";
				document.getElementById(i).value="";
				document.getElementById(det).innerHTML="Fill";
				
				document.getElementById(a).disabled=true;
				document.getElementById(b).disabled=true;
				document.getElementById(c).disabled=true;
				document.getElementById(d).disabled=true;
				document.getElementById(e).disabled=true;
				document.getElementById(f).disabled=true;
				document.getElementById(g).disabled=true;
				document.getElementById(h).disabled=true;
				document.getElementById(i).disabled=true;
			}
			
			var a="packqty_"+snoval;
			var b="nopc_"+snoval;
			var c="domcs_"+snoval;
			var d="lbls_"+snoval;
			var e="domce_"+snoval;
			var f="lble_"+snoval;
			var g="mpck_"+snoval;
			var h="nomp_"+snoval;
			var i="noofpacks_"+snoval;
			var det2="dtail_"+snoval;
			document.getElementById(a).disabled=false;
			document.getElementById(b).disabled=false;
			document.getElementById(c).disabled=false;
			document.getElementById(d).disabled=false;
			document.getElementById(e).disabled=false;
			document.getElementById(f).disabled=false;
			document.getElementById(g).disabled=false;
			document.getElementById(h).disabled=false;
			//document.getElementById(i).disabled=false;
			document.getElementById(det2).innerHTML="Fill";
			//alert(document.getElementById('pcktype').value);
			//if(document.getElementById('pcktype').value=="E")
			//{
				document.getElementById(a).value=document.getElementById('balpck').value;
				document.getElementById(a).readOnly=true;
				document.getElementById(a).style.backgroundColor="#cccccc";
				var wtnop="wtnopkg_"+snoval;
				var z="nopc_"+snoval;
				var zx=(parseFloat(document.getElementById(a).value)/parseFloat(document.getElementById(wtnop).value));
				document.getElementById(z).value=parseInt(zx);
				document.getElementById(a).disabled=true;
			//}
		}
	}
}

function detailspop(dval2)
{
	var dval=1;
	if(dval>0)
	{
		var nomp="nomp_"+dval;
		var totnomp=document.getElementById(nomp).value;
		var tid=document.frmaddDepartment.maintrid.value;
		var subtid=document.frmaddDepartment.subtrid.value;
		var lotno=document.frmaddDepartment.txtlot1.value;
		var txtpsrn=document.frmaddDepartment.txtpsrn.value;
		//alert(variety);
		if(dval2=="edit")
		{ 
			winHandle=window.open('getuser_pronpslip_barcode3_new.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
			if(winHandle==null){
			alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
		}
		else
		{
			if(document.frmaddDepartment.detmpbno.value!="" && document.frmaddDepartment.detmpbno.value > 0)
			{
				winHandle=window.open('getuser_pronpslip_barcode3_new.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
				if(winHandle==null){
				alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
			}
			else
			{
				winHandle=window.open('getuser_pronpslip_barcode_sel.php?totnomp='+totnomp+'&tid='+tid+'&lotno='+lotno+'&txtpsrn='+txtpsrn+'&subtid='+subtid+'&dval='+dval,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
				if(winHandle==null){
				alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
			}
		}
	}
}

function wh(wh1val, whno)
{ 	
	if(whno==1)
	{
		var z=0; var xs=0; var tnop=0;
		var tqty1="txtwhg"+whno;
		var sno=document.frmaddDepartment.sno.value;
		for(var j=1; j<=sno; j++)
		{
			var fet="nomp_"+j;
			tnop=(parseInt(tnop)+parseInt(document.getElementById(fet).value));
		}
		if(tnop==0)
		{
			alert("Please enter NoP");
			document.getElementById(tqty1).SelectedIndex=0;
			document.getElementById(tqty1).value="";
			return false;
		}
		//alert(document.getElementById("wtnop_1").value);alert(tnop);
		if(parseInt(document.getElementById("wtnop_1").value)!=parseInt(tnop))
		{
			alert("Invalid NoP. Total Nop not matching with the Master Pack Total NoP");
			document.getElementById(tqty1).SelectedIndex=0;
			document.getElementById(tqty1).value="";
			document.getElementById("nomp_"+[sno]).focus();
			return false;

		}
		for(var i=1; i<=sno; i++)
		{
			var fet="nopc_"+i;
			if(document.getElementById(fet).value=="")
			{z++;}
			else
			{xs=i;}
		}
		
		if(z==sno)
		{
			alert("Please select UPS");
			document.getElementById(tqty1).SelectedIndex=0;
			document.getElementById(tqty1).value="";
			return false;
		}
		
		var nomp="nomp_"+sno;
		var tonop=0;
		var f=0;
		for (var i=1; i<=sno; i++)
		{
			var sno33="sno33_"+i;
			var sno33val=document.getElementById(sno33).value;
			for (var j=1; j<=sno33val; j++)
			{
				var nophs="nophs"+i+"_"+j;
				tonop=parseInt(tonop)+parseInt(document.getElementById(nophs).value);
			}
		}
		if(parseInt(tonop)==0)
		{
			alert("Please enter NoP");
			document.getElementById(tqty1).SelectedIndex=0;
			document.getElementById(tqty1).value="";
			return false;
		}
		if(parseInt(tonop)!=parseInt(tnop))
		{
			alert("Total of NoP from SLOC not matching with NoP");
			document.getElementById(tqty1).SelectedIndex=0;
			document.getElementById(tqty1).value="";
			return false;
		}
	}
	else
	{
		var whn=whno-1;
		var tqty="noptqtys_"+whn;
		var tqty1="txtwhg"+whno;
		if(document.getElementById(tqty).value=="")
		{
			alert("Please enter Master Pack/Pouches details in previous Bin");
			document.getElementById(tqty1).SelectedIndex=0;
			document.getElementById(tqty1).value="";
			return false;
		}
	}
	
	var bin="txtbing"+whno;
	var extbin=document.frmaddDepartment.extbin.value;
	showUser(wh1val,bin,'whnlc',bin,whno,extbin,extbin,extbin);
}

function bin(bin2val, binno)
{
	var whc="txtwhg"+binno;
	var sbin="sbingn"+binno;
	var binc="txtsubbg"+binno;
	var extsubbin=document.frmaddDepartment.extsubbin.value;
	if(document.getElementById(whc).value=="")
	{
		alert("Please select Warehouse");
		return false;
	}
	else
	{
		showUser(bin2val,sbin,'binnlc',binc,binno,extsubbin,'','');
	}
}

function subbin(subbin2val, subbinno)
{	
	var existview="slocr"+subbinno;
	document.getElementById(existview).innerHTML="<table align='center' height='30' width='100%'  border='1' cellspacing='0' cellpadding='0' bordercolor='#1dbe03' style='border-collapse:collapse' ><tr><td align='center'  valign='middle' class='smalltbltext' >&nbsp;Loading.....<input type='hidden' name='existview1' id='existview1' class='tbltext' value='' /></td></tr></table><input type='hidden' name='trflg1' value='' /><input type='hidden' name='tpflg1' value='' /><input type='hidden' name='tflg1' value='' /><input type='hidden' name='tpmflg1' value='' />";
	var binc="txtbing"+subbinno;
	if(document.getElementById(binc).value=="")
	{	
		alert("Please select Bin");
		return false;
	}
	else
	{
		var itemv=document.frmaddDepartment.txtvariety.value;
		var slocnogood="Pack";
		var trid=document.frmaddDepartment.maintrid.value;
		var Bagsv1="";
		var qtyv1="";
		var ssbin="slocr"+subbinno;
		var bins="txtsubbg"+subbinno;
		showUser(subbin2val,ssbin,'subbinnew',itemv,bins,slocnogood,subbinno,subbinno,trid);
		setTimeout(function() { sloccomment(subbinno); },800);
	}
}

function sloccomment(rval)
{
	var mp="nopmpcs_"+rval;
	var p="noppchs_"+rval;
	var tp="noptpchs_"+rval;
	var tq="noptqtys_"+rval;
	var existview="existview"+rval;
	var trflg="trflg"+rval;
	var tpflg="tpflg"+rval;
	var tflg="tflg"+rval;
	var tpmflg="tpmflg"+rval;
	if(document.getElementById(existview).value=="")
	{
		setTimeout(function() { sloccomment(rval); },500);
	}
	else if((document.getElementById(trflg).value!="" && document.getElementById(tpflg).value!="" && document.getElementById(tflg).value!="" && document.getElementById(tpmflg).value!="") && (document.getElementById(trflg).value==0 && document.getElementById(tpflg).value==0 && document.getElementById(tflg).value==0 && document.getElementById(tpmflg).value==0))
	{
		if(document.frmaddDepartment.detmpbno.value!="" || document.frmaddDepartment.detmpbno.value > 0)
		{
			document.getElementById(mp).value="";
			document.getElementById(mp).readOnly=true;
			document.getElementById(mp).style.backgroundColor="#cccccc";
		}
		document.getElementById(p).value="";
		document.getElementById(p).readOnly=true;
		document.getElementById(p).style.backgroundColor="#cccccc";
		document.getElementById(tp).value="";
		document.getElementById(tq).value="";
		document.getElementById('nopmpcs_1').value=1;
		document.getElementById('noptpchs_1').value=parseInt(document.getElementById("wtnop_1").value);
		document.getElementById('noptqtys_1').value=parseFloat(document.getElementById("wtmp_1").value);
	}
	else
	{
		document.getElementById(mp).value="";
		document.getElementById(mp).readOnly=true;
		document.getElementById(mp).style.backgroundColor="#cccccc";
		document.getElementById(p).value="";
		document.getElementById(p).readOnly=true;
		document.getElementById(p).style.backgroundColor="#cccccc";
		document.getElementById(tp).value="";
		document.getElementById(tq).value="";
		alert("Please select different Sub Bin");
		return false;
	}
}
function pacsbinchk(mpval, mpno)
{
	if(document.getElementById('txtsubbg'+[mpno]).value=="")
	{
		alert("Please Select Subbin first");
		return false;
	}
	else
	{
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			//if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval);
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
			}
		}
		if(document.getElementById('noppchs_'+[mpno]).value!="")
		{
			document.getElementById('noptpchs_'+[mpno]).value=parseInt(d)+parseInt(document.getElementById('noppchs_'+[mpno]).value);
			document.getElementById('noptqtys_'+[mpno]).value=(parseFloat(npwt)*parseFloat(document.getElementById('noppchs_'+[mpno]).value))+(parseFloat(mpval)*parseFloat(dd));
			document.getElementById('noptqtys_'+[mpno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		}
		else
		{
			document.getElementById('noptpchs_'+[mpno]).value=parseInt(d);
			document.getElementById('noptqtys_'+[mpno]).value=parseFloat(mpval)*parseFloat(dd);
			document.getElementById('noptqtys_'+[mpno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		}
	}
}

function pacpchchk(pchval, pchno)
{
	if(document.getElementById('txtsubbg'+[pchno]).value=="")
	{
		alert("Please Select Subbin first");
		return false;
	}
	else
	{
		var sno=document.frmaddDepartment.sno.value;
		var mpval=document.getElementById('nopmpcs_'+[pchno]).value;
		for(var i=1; i<=sno; i++)
		{
			//if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval);
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
			}
		}
		if(mpval!="")
		{
			document.getElementById('noptpchs_'+[pchno]).value=parseInt(d)+parseInt(pchval);
			document.getElementById('noptqtys_'+[pchno]).value=(parseFloat(npwt)*parseFloat(pchval))+(parseFloat(mpval)*parseFloat(dd));
			document.getElementById('noptqtys_'+[pchno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
		}
		else
		{
			document.getElementById('noptpchs_'+[pchno]).value=parseInt(pchval);
			document.getElementById('noptqtys_'+[pchno]).value=parseFloat(npwt)*parseFloat(pchval);
			document.getElementById('noptqtys_'+[pchno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
		}
	}
}
function openpackdetails(subtid,tid)
{
winHandle=window.open('packdetails_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

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

function dateDiff(dateEarlier, dateLater) 
{
	var x=dateEarlier.split("-");
	var y=dateLater.split("-");
	dateEarlier=new Date(x[2],x[1]-1,x[0]);
	dateLater=new Date(y[2],y[1]-1,y[0]);
	var one_day=1000*60*60*24
    return (  Math.round((dateLater.getTime()-dateEarlier.getTime())/one_day)  );
}


function chkvalidity(valval)
{
	/*if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Enter Processing Loss");
		document.frmaddDepartment.txtconpl.focus();
		return false;
	}
	else
	{*/
	if(valval!="")
	{
		dt1=getDateObject(document.frmaddDepartment.date.value,"-");
		dt2=getDateObject(document.frmaddDepartment.dp1.value,"-");
		dt3=getDateObject(document.frmaddDepartment.dp2.value,"-");
		dt4=getDateObject(document.frmaddDepartment.dp3.value,"-");
		if(valval==3)
		{
			if(dt2 <= dt1)
			{
				alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
				document.frmaddDepartment.validityperiod.value="";
				document.frmaddDepartment.validityupto.value="";
				document.frmaddDepartment.valdays.value="";
				return false;
			}
			else
			{
				var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp1.value);
				alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
				document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp1.value;
				document.frmaddDepartment.valdays.value=ddiff;
			}
		}
		if(valval==6)
		{	
			if(dt3 <= dt1)
			{
				alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
				document.frmaddDepartment.validityperiod.value="";
				document.frmaddDepartment.validityupto.value="";
				document.frmaddDepartment.valdays.value="";
				return false;
			}
			else
			{
				var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp2.value);
				alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
				document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp2.value;
				document.frmaddDepartment.valdays.value=ddiff;
			}
		}
		if(valval==9)
		{
			if(dt4 <= dt1)
			{
				alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
				document.frmaddDepartment.validityperiod.value="";
				document.frmaddDepartment.validityupto.value="";
				document.frmaddDepartment.valdays.value="";
				return false;
			}
			else
			{
				var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp3.value);
				alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
				document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp3.value;
				document.frmaddDepartment.valdays.value=ddiff;
			}
		}
	}
	else
	{
		document.frmaddDepartment.validityupto.value="";
		document.frmaddDepartment.valdays.value="";
	}
	//}
}

function datesel(dopc)
{
	document.getElementById("postingsubsubtable").innerHTML="";
	document.frmaddDepartment.txtlot1.value="";
	showCalendar(dopc);
}

function openprintsubbin(subid, bid, wid, lid)
{
var itm="";
var tp="";
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

function packagingdetails(lotno, ups)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	winHandle=window.open('lotpackaging_details.php?lotno='+lotno+'&ups='+ups+'&crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function chkups()
{
	if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please Select UPS");
		document.frmaddDepartment.nlcweight.value="";
		document.frmaddDepartment.txtups.focus();
		return false;
	}
}
</script>

<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/pack_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Packaging slip - NLC&nbsp;<input type="hidden" name="logid" value="<?php echo $logid?>" /></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >

<?php
$sql_pdt=mysqli_query($link,"Select max(proslipmain_date) from tbl_proslipmain where plantcode='$plantcode' order by proslipmain_date desc") or die(mysqli_error($link));
$tot_pdt=mysqli_num_rows($sql_pdt);
$row_pdt=mysqli_fetch_array($sql_pdt);
?>
<?php

$plantcodes=""; $yearcodes="";
		$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
		while($noticia = mysqli_fetch_array($quer4)) 
		{
			if($yearcodes!="")
			$yearcodes=$yearcodes.",".$noticia['ycode'];
			else
			$yearcodes=$noticia['ycode'];
		}
	   	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	   	$row_month=mysqli_fetch_array($quer6);
	  	$plantcodes=$row_month['code'];
		$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
		 while($noticia2 = mysqli_fetch_array($quer5)) 
		 {
		 	if($plantcodes!="")
			$plantcodes=$plantcodes.",".$noticia2['stcode'];
			else
			$plantcodes=$noticia2['stcode'];
		 }
		 
?>
  <?php
$tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_packaging where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['packaging_id'];

	$tdate=$row_tbl['packaging_tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['packaging_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
	$sql_tblsub=mysqli_query($link,"select * from tbl_packaging_sub where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tblsub=mysqli_fetch_array($sql_tblsub);
	
$subtid=0;
?>   
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $row_tbl['packaging_code']?>" />
	<input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	<input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" />	 
	<input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	
<?php
$tid=0; $subtid=0;
?>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Add Packaging Slip </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="smalltblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Light" height="30">
<td width="240" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID&nbsp;</td>
<td width="240"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['packaging_code']."/".$row_tbl['packaging_yearid']."/".$row_tbl['packaging_logid'];?></td>

<td width="240" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction Date&nbsp;</td>
<td width="240" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="240" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packaging&nbsp;</td>
<td width="240" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="datesel('dopc')" tabindex="6"><img src="../images/cal.gif" border="0" align="absmiddle" /></a>&nbsp;<font color="#FF0000">*</font></td>
<td width="240" align="right"  valign="middle" class="smalltblheading">Packaging Slip Ref. No.&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['packaging_slipno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

  <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="240" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="240" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if ($row_tblsub['packagingsub_crop']==$noticia['cropid']) echo "selected";?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tblsub['packagingsub_crop']."' and actstatus='Active' order by popularname Asc"); 
//$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="240" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1(this.value);" >
<option value="" selected>--Select Variety-</option>
<?php while($noticia_item = mysqli_fetch_array($quer4)) { ?>
		<option <?php if ($row_tblsub['packagingsub_variety']==$noticia_item['varietyid']) echo "selected";?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		<!--<td width="157" align="right" valign="middle" class="smalltblheading">Seed Stage&nbsp;</td>
<td width="165"  align="left" valign="middle" class="smalltbltext"  >&nbsp;Pack </td>-->
           </tr>
<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tblsub['packagingsub_variety']."' and actstatus='Active' order by varietyid Asc")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$parray=explode(",", $row_month['gm']);
$parray1=explode(",", $row_month['mptnop']);
$parray2=explode(",", $row_month['wtmp']);
$nopmp=""; $wtimp="";

$sql_tbl_sub24=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tblsub['packagingsub_id']."' and packaging_id='".$arrival_id."'") or die(mysqli_error($link));
while($subtbltot24=mysqli_fetch_array($sql_tbl_sub24))
{
$upsize=$subtbltot24['packagingsubsub_upssize'];
$tonops=$tonops+$subtbltot24['packagingsubsub_nop'];
$nopmp=$subtbltot24['packagingsubsub_wtnop'];
$wtimp=$subtbltot24['packagingsubsub_wtmp'];
$uups=$upsize;
}

$sql_month=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tblsub['packagingsub_crop']."' and lotldg_variety='".$row_tblsub['packagingsub_variety']."' and trtype='NSTPNPSLIP' order by packtype")or die(mysqli_error($link));
?>		   
  <tr class="Light" height="30">
<td width="240" align="right"  valign="middle" class="smalltblheading">UPS&nbsp;</td>
<td width="240" align="left"  valign="middle" class="smalltbltext" id="upstp" >&nbsp;<select class="smalltbltext" name="txtups" style="width:120px;" onchange="modetchk2(this.value)">
<option value="" selected>--Select--</option>
<?php  while($row_var=mysqli_fetch_array($sql_month)) {	?>
		<option <?php if($upsize==$row_var['packtype']) echo "Selected"; ?>  value="<?php echo $row_var['packtype'];?>" />   
		<?php echo $row_var['packtype'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="240" align="right" valign="middle" class="smalltblheading">NLC Weight&nbsp;</td>
<td width="240"  align="left" valign="middle" class="smalltbltext" id="tnopinmp">&nbsp;<input type="text" name="nlcweight" id="nlcwt" class="tbltext" size="6" maxlength="6" onchange="chkups(this.value);" onkeypress="return isNumberKey1(event)" value="<?php echo $wtimp;?>"  />&nbsp;Kgs.</td>

</tr>
<?php
$sql_bar=mysqli_query($link,"select  * from tbl_barcodestmp where plantcode='$plantcode' and bar_tid='".$arrival_id."' and bar_subid='".$row_tblsub['packagingsub_id']."' and bar_logid='".$row_tbl['packaging_logid']."' and bar_psrn='".$row_tbl['packaging_slipno']."'") or die(mysqli_error($link));
$row_bar=mysqli_fetch_array($sql_bar);
?>
<tr class="Light" height="30">
	<td width="240" align="right"  valign="middle" class="smalltblheading" >Barcode&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltblheading" id="barserch">&nbsp;<input type="text" name="barcode" class="smalltbltext" size="11" maxlength="11" value="<?php echo $row_bar['bar_barcodes'];?>" onchange="barcheck(this.value)" onkeyup="searchbarcode(this.value)" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="bardupchk" value="0" /></td>
	<td width="240" align="right"  valign="middle" class="smalltblheading" >Gross NLC Weight&nbsp;</td>
    <td width="240" align="left"  valign="middle" class="smalltblheading">&nbsp;<input type="text" name="weight" id="w" class="tbltext" size="6" maxlength="6" onchange="chkmlt1(this.value);" onkeypress="return isNumberKey1(event)" value="<?php echo $row_bar['bar_grosswt'];?>"  />&nbsp;Kgs.&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
  <td align="right" class="tblheading">MP Type&nbsp;</td>
   <td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<select name="mptyp" class="tbltext" style="size:60px;" onchange="chkgrwt2();">
   <option value="Carton" <?php if($row_bar['packaging_mptype']=="") {echo "Carton";}?> >Carton</option>
   <option value="Bag" <?php if($row_bar['packaging_mptype']=="") {echo "Bag";}?> >Bag</option>
   </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>		
</tr>    			   
<input type="hidden" name="txtstage" value="Pack" />
</table>
<br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<?php
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_packagingsub_sub2 where plantcode='$plantcode' and packagingsub_id='".$row_tblsub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_upssize='$upsize' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
$row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub);

$lnt=explode(",",$row_tbl_subsub['packagingsubsub_lotno']);
$llnntt=""; $ccnt=0;
foreach($lnt as $lntno)
{
	if($lntno<>"")
	{
		$ccnt++;
		if($llnntt!="")
		$llnntt=$llnntt."\n".$lntno;
		else
		$llnntt=$lntno;
	}
}

?>
<tr class="Light" height="30">
<td align="right" width="239" valign="middle" class="smalltblheading">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="241" valign="middle" class="smalltbltext">&nbsp;<textarea name="txtlot2" class="smalltbltext" cols="25" rows="3" readonly="readonly" style="background-color:#CCCCCC"><?php echo $llnntt;?></textarea><input name="txtlot1" type="hidden" value="<?php echo $row_tbl_subsub['packagingsubsub_lotno'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="482" valign="middle" class="smalltblheading">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<div id="postingsubsubtable" style="display:block"><br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Post Item Form</td>
  </tr>
</table>
<table width="968" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
 
<?php	
$sno=0; 
$zz=explode(",", $row_tbl_subsub['packagingsubsub_lotno']);
$as=count($row_tbl_subsub['packagingsubsub_lotno']);
foreach($zz as $a)
{
if($a <> "")
{
  $extwh=""; $extbin=""; $extsubbin=""; $extnob=0; $extqty=0;
  
$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$a."'  and balqty > 0") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype=""; $ups="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$a."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nop1=0; $ptp1=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$wtimp;
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
	$ptp1=($packtp[0]/1000);
}
else
{
	$ptp=$packtp[0];
	$ptp1=$packtp[0];
}
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
if($penqty > 0)
{
	if($packtp[1]=="Gms")
		$nop1=($ptp*$penqty);
	else
		$nop1=($penqty/$ptp);
	//$nop1=($ptp*$penqty);
}
//if($nop1<$row_issuetbl['balnop'])
//$nop1=$row_issuetbl['balnop'];
//$nob=$nop1;
$nob=$nob+$nop1; 
$extqty=$extqty+$row_issuetbl['balqty'];
if($packtp[1]=="Gms")
$extnob=$extqty*$ptp;
else
$extnob=$extqty/$ptp;
$qty=$nob*$ptp1;

$uom=$ptp1;
$wtmp=$wtimp;
if($packtp[1]=="Gms")
$mptnop=$wtmp*$wtmp;
else
$mptnop=$wtmp/$ptp;

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_tblsub['packagingsub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$srnonew=0; $uom="";
//echo $rowvariety['varietyid'];
/*$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
foreach($p1_array as $val1)
{
	if($val1<>"")
	{
		$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
		$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
		if($row1234=mysqli_num_rows($res)>0)
		{
			$row12=mysqli_fetch_array($res);
			$uom=$row12['uom'];
			$wtmp=$p1_array2[$srnonew];
			$mptnop=$p1_array3[$srnonew];
		}
	}
	$srnonew++;
}*/	


$qc=$row_issuetbl['lotldg_qc'];
if($qc=="OK")
{
$trdate=$row_issuetbl['lotldg_qctestdate'];
$trdate=explode("-",$trdate);
$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
$qcdttype="DOT";
}
else
{
	$zz=str_split($a);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
		$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
		//echo $row_softr_sub[0];
		$sql_softr=mysqli_query($link,"Select * from tbl_softr where  softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
		$tot_softr=mysqli_num_rows($sql_softr);
		$row_softr=mysqli_fetch_array($sql_softr);
		if($tot_softr > 0)
		{
		$trdate=$row_softr['softr_date'];
		$trdate=explode("-",$trdate);
		$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
		}
		
		$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where  softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
		if($tot_softr_sub2 > 0)
		{
		$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
		//echo $row_softr_sub2[0];
		$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where  softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
		$tot_softr2=mysqli_num_rows($sql_softr2);
		$row_softr2=mysqli_fetch_array($sql_softr2);
		if($tot_softr2 > 0)
		{
		$trdate=$row_softr2['softr_date'];
		$trdate=explode("-",$trdate);
		$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
		}
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
$dp1="";$dp2="";$dp3="";
if($qcdot!="")
{
	$trdate2=explode("-",$qcdot);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
$mpno=floor($qty/$wtmp);
$sno++;
$avlqty=$nob*$ptp1;



$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;   $nopns=0; $qtyns=0; $nopnl=0; $qtynl=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=$row_mps['mpmain_crop'];
		$verarr=$row_mps['mpmain_variety'];
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=$row_mps['mpmain_upssize'];
		$noparr=explode(",", $row_mps['mpmain_mptnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr)
			{
				$nops=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; 
			}
		}
		
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=$row_mpl['mpmain_crop'];
		$verarr=$row_mpl['mpmain_variety'];
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=$row_mpl['mpmain_upssize'];
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr)
			{
				$nopl=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyl=$ptp*$noparr[$i]; $nompl=$nompl+$ct; 
			}
		}
		
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
if($tot_mpm > 0)
{
	while($row_mpm=mysqli_fetch_array($sql_mpm))
	{
		$crparr=explode(",", $row_mpm['mpmain_crop']);
		$verarr=explode(",", $row_mpm['mpmain_variety']);
		$lotarr=explode(",", $row_mpm['mpmain_lotno']);
		$upsarr=explode(",", $row_mpm['mpmain_upssize']);
		$noparr=explode(",", $row_mpm['mpmain_lotnop']);
		
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopm=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtym=$ptp*$noparr[$i]; $nompm=$nompm+$ct; 
			}
		}
		
	}
}
$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$a' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=$row_mpns['mpmain_crop'];
		$verarr=$row_mpns['mpmain_variety'];
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=$row_mpns['mpmain_upssize'];
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr)
			{
				$nopns=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyns=$ptp*$noparr[$i]; $nompns=$nompns+$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=$row_mpnl['mpmain_crop'];
		$verarr=$row_mpnl['mpmain_variety'];
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=$row_mpnl['mpmain_upssize'];
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr)
			{
				$nopnl=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtynl=$ptp*$noparr[$i]; $nompnl=$nompnl+$ct; 
			}
		}
		
	}
}
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;	
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+qtynl;	
$qty=$extqty-$totextqtys;
$nob=$extnob-$totextpouches;


$nops=""; $blch="";
$sql_tbl_subsub2=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tblsub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_lotno='$a' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub2);
while($row_tbl_subsub2=mysqli_fetch_array($sql_tbl_subsub2))
{
$nops=$nops+$row_tbl_subsub2['packagingsubsub_nop']; 
$blch=$blch+$row_tbl_subsub2['packagingsubsub_balpch']; 
}
//echo $nops."  =  ".$ptp1;
$qqtys=$nops*$ptp1;
$bqtys=$avlqty-$qqtys;
if($bqtys<=0)$bqtys=0;
if($bqtys<=0)$blch=0;
}
?>

<tr class="tblsubtitle" height="25">
    <td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="168" rowspan="2" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="99" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="112" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total NoP</td>
	<td width="112" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total Qty</td>
    <td width="112" rowspan="2" align="center" valign="middle" class="smalltblheading" >Packaged</td>
    <td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packaging</td>
	<td width="105" rowspan="2" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="92" rowspan="2" align="center" valign="middle" class="tblheading">NoP</td>
	<td colspan="2" align="center" valign="middle" class="tblheading">Balance for Packaging</td>
  </tr>
 <tr class="tblsubtitle" height="25">
   <td width="80" align="center" valign="middle" class="smalltblheading">NoP</td>
   <td width="84" align="center" valign="middle" class="smalltblheading">Qty</td>
   <td width="94" align="center" valign="middle" class="tblheading">NoP</td>
   <td width="99" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>

  <tr class="Light" height="25">
  <td align="center" valign="middle" class="smalltbltext"><?php echo $sno?></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $a;?><input type="hidden" name="lotno_<?php echo $sno?>" id="lotno_<?php echo $sno?>" value="<?php echo $a?>" /> <input type="hidden" name="softstatus" value="<?php echo $softstatus;?>" /></td>
    <td align="center" valign="middle" class="smalltblheading"><?php echo $ups;?><input type="hidden" name="upssize" value="<?php echo $ups;?>" /><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $uom;?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $ups;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $extnob;?><input type="hidden" name="txtextnob" id="txtextnop_<?php echo $sno;?>" value="<?php echo $extnob;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $extqty;?><input type="hidden" name="txtextqty" id="packqty_<?php echo $sno?>" value="<?php echo $extqty;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="packagingdetails('<?php echo $a;?>','<?php echo $ups?>')">Details</a></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $nob;?><input type="hidden" name="txtonob" id="nopc_<?php echo $sno;?>" value="<?php echo $nob;?>" /></td>
    
	<td align="center" valign="middle" class="smalltblheading"><?php echo $qty;?><input type="hidden" name="txtoqty" id="packoqty_<?php echo $sno?>" value="<?php echo $qty;?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtqty" id="pqty_<?php echo $sno?>" value="<?php echo $qqtys;?>" onkeypress="return isNumberKey1(event)" size="7" maxlength="7" onchange="balqtcheck(this.value, <?php echo $sno?>)" /></td>
	<td align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php echo $nops;?>" title="Maximum - <?php echo $mptnop?>" onkeypress="return isNumberKey(event)" onchange="balnopcheck(this.value, <?php echo $sno?>)"/><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="<?php echo $blch;?>" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="smalltblheading"><input type="text" name="txtbqty" size="7" maxlength="7" id="bqty_<?php echo $sno?>" value="<?php echo $bqtys;?>" readonly="true" style="background-color:#CCCCCC" /></td>
</tr> 

<tr class="Light" height="25">
<td align="center" valign="middle" colspan="12">
<table align="center" border="1" width="968" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td width="76" rowspan="2" align="center" valign="middle" class="tblheading">WH</td>
<td width="108" rowspan="2" align="center" valign="middle" class="tblheading">Bin</td>
<td width="99" rowspan="2" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="111" rowspan="2" align="center" valign="middle" class="tblheading">Master Packs</td>
<td colspan="2" align="center" valign="middle" class="tblheading">Available</td>
<td width="105" rowspan="2" align="center" valign="middle" class="tblheading">Qty</td>
<td width="92" rowspan="2" align="center" valign="middle" class="tblheading">NoP</td>
<td width="192" rowspan="2" align="center" valign="middle" class="tblheading">Balance NoP</td>
</tr>
<tr class="tblsubtitle" height="25">
  <td width="81" align="center" valign="middle" class="tblheading">NoP</td>
  <td width="84" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$sno33=0;
$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$a."'") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
$nob=0; $qty=0; $qty1=0;
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_tbl_subsub3['subbinid']."' and binid='".$row_tbl_subsub3['binid']."' and whid='".$row_tbl_subsub3['whid']."' and lotno='".$a."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
	$sno33=$sno33+1; $nop1=0;
	$ups=$row_issuetbl['packtype'];
	$wtinmp=$row_issuetbl['wtinmp'];
	$upspacktype=$row_issuetbl['packtype'];
	$packtp=explode(" ",$upspacktype);
	$packtyp=$packtp[0]; 
	if($packtp[1]=="Gms")
	{ 
		$ptp=(1000/$packtp[0]);
		$ptp1=($packtp[0]/1000);
	}
	else
	{
		$ptp=$packtp[0];
		$ptp1=$packtp[0];
	}
	$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
	if($penqty > 0)
	{
		if($packtp[1]=="Gms")
			$nop1=($ptp*$penqty);
		else
			$nop1=($penqty/$ptp);
		//$nop1=($ptp*$penqty);
	}
	//if($nop1<$row_issuetbl['balnop'])
	//$nop1=$row_issuetbl['balnop'];
	//$nob=$nop1;
	$nob=$nob+$nop1; 
	$extqty=$extqty+$row_issuetbl['balqty'];
	if($packtp[1]=="Gms")
	$extnob=$extqty*$ptp;
	else
	$extnob=$extqty/$ptp;
	//$qty=$nob*$ptp1;
	/*if($penqty > 0)
	{
	*/	
	//$nop1=$row_issuetbl['balnop'];
	//}
	
	//if($nop1<$row_issuetbl['balnop'])$nop1=$row_issuetbl['balnop'];
	$nob=$nop1; 
	$qty=$row_issuetbl['balnomp'];
	//$qty1=$row_issuetbl['balqty'];
	$avlqty=$nob*$ptp1;
	//}

//}
$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;   $nopns=0; $qtyns=0; $nopnl=0; $qtynl=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$a' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=$row_mps['mpmain_crop'];
		$verarr=$row_mps['mpmain_variety'];
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=$row_mps['mpmain_upssize'];
		$noparr=explode(",", $row_mps['mpmain_mptnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr)
			{
				$nops=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; 
			}
		}
		
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=$row_mpl['mpmain_crop'];
		$verarr=$row_mpl['mpmain_variety'];
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=$row_mpl['mpmain_upssize'];
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr)
			{
				$nopl=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyl=$ptp*$noparr[$i]; $nompl=$nompl+$ct; 
			}
		}
		
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
if($tot_mpm > 0)
{
	while($row_mpm=mysqli_fetch_array($sql_mpm))
	{
		$crparr=explode(",", $row_mpm['mpmain_crop']);
		$verarr=explode(",", $row_mpm['mpmain_variety']);
		$lotarr=explode(",", $row_mpm['mpmain_lotno']);
		$upsarr=explode(",", $row_mpm['mpmain_upssize']);
		$noparr=explode(",", $row_mpm['mpmain_lotnop']);
		
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopm=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtym=$ptp*$noparr[$i]; $nompm=$nompm+$ct; 
			}
		}
		
	}
}
$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$ltno' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=$row_mpns['mpmain_crop'];
		$verarr=$row_mpns['mpmain_variety'];
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=$row_mpns['mpmain_upssize'];
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr)
			{
				$nopns=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyns=$ptp*$noparr[$i]; $nompns=$nompns+$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$c' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=$row_mpnl['mpmain_crop'];
		$verarr=$row_mpnl['mpmain_variety'];
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=$row_mpnl['mpmain_upssize'];
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr)
			{
				$nopnl=$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtynl=$ptp*$noparr[$i]; $nompnl=$nompnl+$ct; 
			}
		}
		
	}
}
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;	
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+qtynl;	
/*$avlqty=$qty1-$totextqtys;
if($qty>0)
$nob=$nob-$totextpouches;
$avlqty=$nob*$ptp1;*/
	
	if($extwh!="")
	$extwh=$extwh.",".$row_tbl_subsub3['whid'];
	else
	$extwh=$row_tbl_subsub3['whid'];
	
	if($extbin!="")
	$extbin=$extbin.",".$row_tbl_subsub3['binid'];
	else
	$extbin=$row_tbl_subsub3['binid'];
	
	if($extsubbin!="")
	$extsubbin=$extsubbin.",".$row_tbl_subsub3['subbinid'];
	else
	$extsubbin=$row_tbl_subsub3['subbinid'];
	
	
	$sql_tbl_subsub22=mysqli_query($link,"select * from tbl_packagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tblsub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_lotno='$a' and extwh='".$row_tbl_subsub3['whid']."' and extbin='".$row_tbl_subsub3['binid']."' and extsubbin='".$row_tbl_subsub3['subbinid']."' order by packagingsubsub_id asc") or die(mysqli_error($link));
	$subsubtbltot22=mysqli_num_rows($sql_tbl_subsub22);
	$row_tbl_subsub22=mysqli_fetch_array($sql_tbl_subsub22);
	
	$nops22=$row_tbl_subsub22['packagingsubsub_nop']; 
	$blpch22=$row_tbl_subsub22['packagingsubsub_balpch']; 
	$txtremarks=$row_tbl_subsub22['packagingsubsub_remarks'];
	
	$qqtys22=$nops22*$ptp;


?>
<tr class="light" height="25">
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) {  if($row_tbl_subsub3['whid']==$noticia_whd1['whid']) echo $noticia_whd1['perticulars']; } ?>
</td>
<?php

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub3['whid']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) {  if($row_tbl_subsub3['binid']==$noticia_bing1['binid']) echo $noticia_bing1['binname']; } ?>
</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub3['binid']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext">&nbsp;<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) {  if($row_tbl_subsub3['subbinid']==$noticia_subbing1['sid']) echo $noticia_subbing1['sname']; } ?><input type="hidden" name="exwh<?php echo $sno;?>_<?php echo $sno33;?>" id="exwh<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['whid'];?>" /><input type="hidden" name="exbin<?php echo $sno;?>_<?php echo $sno33;?>" id="exbin<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['binid']?>" /><input type="hidden" name="exsubbin<?php echo $sno;?>_<?php echo $sno33;?>" id="exsubbin<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $row_tbl_subsub3['subbinid']?>" /></td>

<td align="center" valign="middle" class="tbltext"><?php echo $qty;?><input type="hidden" name="extnomphs<?php echo $sno;?>_<?php echo $sno33;?>" id="extnomphs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $qty;?>" /></td> 
<td align="center" valign="middle" class="tbltext"><?php echo $nob;?><input type="hidden" name="extnophs<?php echo $sno;?>_<?php echo $sno33;?>" id="extnophs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $nob;?>" /></td>
<td align="center" valign="middle" class="tbltext"><?php echo $avlqty;?><input type="hidden" name="extqtyhs<?php echo $sno;?>_<?php echo $sno33;?>" id="extqtyhs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $avlqty;?>" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="qtyphs<?php echo $sno;?>_<?php echo $sno33;?>" id="qtyphs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $qqtys22;?>" size="7"  onchange="pacqtychk(this.value,<?php echo $sno;?>,<?php echo $sno33;?>)" onkeypress="return isNumberKey1(event)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nophs<?php echo $sno;?>_<?php echo $sno33;?>" id="nophs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $nops22;?>" size="7"  onchange="pacpchk(this.value,<?php echo $sno;?>,<?php echo $sno33;?>)" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="balnophs<?php echo $sno;?>_<?php echo $sno33;?>" id="balnophs<?php echo $sno;?>_<?php echo $sno33;?>" value="<?php echo $blpch22;?>" size="7" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
<?php
}
}
?>
<input type="hidden" name="sno33_<?php echo $sno;?>" id="sno33_<?php echo $sno;?>" value="<?php echo $sno33;?>" />
 </table>
 </td>
 </tr>
 <tr height="25">
<?php
}
}
//}
?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="1" /><input type="hidden" name="upsidno" value="" /><input type="hidden" name="nopks" value="" />
<input type="hidden" name="extwh" value="<?php echo $extwh;?>" />
<input type="hidden" name="extbin" value="<?php echo $extbin?>" />
<input type="hidden" name="extsubbin" value="<?php echo $extsubbin?>" />

</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="11">SLOC</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="160" align="center" valign="middle" class="tblheading">WH</td>
<td width="106" align="center" valign="middle" class="tblheading">Bin</td>
<td width="205" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="205" align="center" valign="middle" class="tblheading">Comments</td>
<td width="162" align="center" valign="middle" class="tblheading">Master Packs</td>
<td width="162" align="center" valign="middle" class="tblheading">Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>
</tr>
<?php
$tsno=0;
$sno3=0;
?>
<input type="hidden" name="sno3" value="<?php echo $sno3;?>" />
<input type="hidden" name="tsno" value="<?php echo $tsno;?>" />
<?php
if($sno3==0)
{

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_packagingsub_sub2 where plantcode='$plantcode' and packagingsub_id='".$row_tblsub['packagingsub_id']."' and packaging_id='".$arrival_id."' and packagingsubsub_upssize='$ups' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
$row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub);

 $nb1=0; $qt1=0; $nb2=0; $qt2=0; 

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['packagingsubsub_subbin']."' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nomp=$row_tbl_subsub['packagingsubsub_nomp']; 
$nop=$row_tbl_subsub['packagingsubsub_nopch']; 
$totp=$row_tbl_subsub['packagingsubsub_totpch']; 
$totqty=$row_tbl_subsub['packagingsubsub_totqty'];

$diq=explode(".",$row_tbl_subsub['packagingsubsub_totqty']);
if($diq[1]==000){$totqty=$diq[0];}else{$totqty=$row_tbl_subsub['packagingsubsub_totqty'];}

?>
<tr class="light" height="25">
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid IN($extwh) order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg1" name="txtwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_tbl_subsub['packagingsubsub_wh']==$noticia_whd1['whid']) echo "Selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php

if($extbin!="")
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub['packagingsubsub_wh']."' and binid IN ($extbin) order by binname")or die("Error:".mysqli_error($link));
else
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub['packagingsubsub_wh']."' order by binname")or die("Error:".mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><select class="smalltbltext" name="txtbing1" id="txtbing1" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_tbl_subsub['packagingsubsub_bin']==$noticia_bing1['binid']) echo "Selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php

$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and sid IN ($extsubbin) order by sname")or die("Error:".mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><select class="smalltbltext" name="txtsubbg1" id="txtsubbg1" style="width:60px;" onchange="subbin(this.value,1);"  >
<option value="" selected>Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
<option <?php if($row_tbl_subsub['packagingsubsub_subbin']==$noticia_subbing1['sid']) echo "Selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
<?php echo $noticia_subbing1['sname'];?>
<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocr1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview1" id="existview1" class="tbltext" value="" /></td>
 	</tr>
</table><input type="hidden" name="trflg1" value="" /><input type="hidden" name="tpflg1" value="" /><input type="hidden" name="tflg1" value="" /><input type="hidden" name="tpmflg1" value="" />
</div> 
</td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_1" id="nopmpcs_1" value="<?php echo $nomp;?>" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_1" id="noppchs_1" value="<?php echo $nop;?>" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_1" id="noptpchs_1" value="<?php echo $totp;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_1" id="noptqtys_1" value="<?php echo $totqty;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>

<?php
}

?>

</table>
<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="100" maxlength="100" value="<?php echo $txtremarks;?>" ></td>
</tr>
</table>
<br />
<input name="protype" value="" type="hidden"> </div>
</div></div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_packaging_nlc.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>


</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
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

  
