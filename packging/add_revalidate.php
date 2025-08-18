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
		//exit;
		$pid=trim($_POST['txtitem']);
		$date=trim($_POST['date']);
		$tcode=trim($_POST['tcode']);
		$sstage=trim($_POST['sstage']);
		$crop=trim($_POST['crop']);
		$variety=trim($_POST['variety']);
		$lotno=trim($_POST['lotno']);
		$txtnewlot=trim($_POST['txtnewlot']);
		$upssize=trim($_POST['upssize']);
		$enop=trim($_POST['enop']);
		$eqty=trim($_POST['eqty']);
		$qcsts=trim($_POST['qcsts']);
		$dot=trim($_POST['dot']);
		$got=trim($_POST['got']);
		$go=explode(" ",$got);
		$got1=$go[1];
		$dogt=trim($_POST['dogt']);
		$txtenop=trim($_POST['txtenop']);
		$txteqty=trim($_POST['txteqty']);
		$bnop=trim($_POST['bnop']);
		$bqty=trim($_POST['bqty']);
		$txtpsrno=trim($_POST['txtpsrno']);
		$dcdate=trim($_POST['dcdate']);
		$txtnopqc=trim($_POST['txtnopqc']);
		$txtbnop=trim($_POST['txtbnop']);
		$txtbqty=trim($_POST['txtbqty']);
		$validityperiod=trim($_POST['validityperiod']);
		$validityupto=trim($_POST['validityupto']);
		$valdays=trim($_POST['valdays']);
		$domcs_1=trim($_POST['domcs_1']);
		$lbls_1=trim($_POST['lbls_1']);
		$domce_1=trim($_POST['domce_1']);
		$lble_1=trim($_POST['lble_1']);
		$slable=$domcs_1.$lbls_1;
		$elable=$domce_1.$lble_1;
		$lablerange=$slable."-".$elable;
		$ptptype=trim($_POST['ptptype']);
		
		$txtnoppl=trim($_POST['txtnoppl']);
		$pkgtype=trim($_POST['pkgtype']);
		$nomp_1=trim($_POST['nomp_1']);
		$noofpacks_1=trim($_POST['noofpacks_1']);
		$nopks=trim($_POST['nopks']);
		$wtmp_1=trim($_POST['wtmp_1']);
		$wtnop_1=trim($_POST['wtnop_1']);
		$sno3=trim($_POST['sno3']);
		$extbpch=trim($_POST['extbpch']);
		$linkpch=trim($_POST['linkpch']);
		$bpch=trim($_POST['bpch']);
		
		$srno2=trim($_POST['srno2']);
		
		
		$zzz=implode(",", str_split($txtnewlot));
		$orlot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
		
		$ddate1=explode("-",$date);
		$date=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
			
		$edate1=explode("-",$dot);
		$dot=$edate1[2]."-".$edate1[1]."-".$edate1[0];
		
		$edate12=explode("-",$dogt);
		$dogt=$edate12[2]."-".$edate12[1]."-".$edate12[0];
		
		$edate2=explode("-",$dcdate);
		$dcdate=$edate2[2]."-".$edate2[1]."-".$edate2[0];
		
		$edate2=explode("-",$validityupto);
		$validityupto=$edate2[2]."-".$edate2[1]."-".$edate2[0];
		
		
		$sql_sub="insert into tbl_revalidatetemp (rv_date, rv_crop, rv_variety, rv_lotno, rv_newlot, rv_orlot, rv_ups, rv_enop, rv_eqty, rv_qc, rv_dot, rv_got, rv_got1, rv_dogt, rv_rvpsrn, rv_dorvp, rv_qcnop, rv_bnop, rv_bqty, rv_valperiod, rv_valupto, rv_valdays, rv_slable, rv_elable, rv_tcode, rv_logid, rv_yearcode, rv_pid, rv_rvtyp, rv_mptyp, rv_pl, rv_pnomp, rv_bpch, plantcode) values('$date', '$crop', '$variety', '$lotno', '$txtnewlot', '$orlot', '$upssize', '$enop', '$eqty', '$qcsts', '$dot', '$got', '$got1', '$dogt', '$txtpsrno', '$dcdate', '$txtnopqc', '$txtbnop', '$txtbqty', '$validityperiod', '$validityupto', '$valdays', '$slable', '$elable', '$tcode', '$logid', '$yearid_id', '$pid', '$ptptype', '$pkgtype', '$txtnoppl', '$nomp_1', '$noofpacks_1', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=mysqli_insert_id($link);
			for($j=1; $j<=$sno3; $j++)
			{
				$txtwhgx="txtwhg".$j;
				$txtbingx="txtbing".$j;
				$txtsubbgx="txtsubbg".$j;
				$existviewx="existview".$j;
				$nopmpcsx="nopmpcs_".$j;
				$noppchsx="noppchs_".$j;
				$noptpchsx="noptpchs_".$j;
				$noptqtysx="noptqtys_".$j;
				$txtwhg=trim($_POST[$txtwhgx]);
				$txtbing=trim($_POST[$txtbingx]);
				$txtsubbg=trim($_POST[$txtsubbgx]);
				$existview=trim($_POST[$existviewx]);
				$nopmpcs=trim($_POST[$nopmpcsx]);
				$noppchs=trim($_POST[$noppchsx]);
				$noptpchs=trim($_POST[$noptpchsx]);
				$noptqtys=trim($_POST[$noptqtysx]);
				if($noptqtys!="" || $noptqtys>0)
				{
					$sql_sub_sub="insert into tbl_revalidatetmp_sub (rv_id, rvs_whid, rvs_binid, rvs_sbinid, rvs_nop, rvs_nomp, rvs_qty, plantcode) values('$subid', '$txtwhg', '$txtbing', '$txtsubbg', '$noppchs', '$nopmpcs', '$noptqtys', '$plantcode')";
					mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				}
			}
			
			for($j=1; $j<=$srno2; $j++)
			{
				$txtwhgx="extslwhg_".$j;
				$txtbingx="extslbing_".$j;
				$txtsubbgx="extslsubbg_".$j;
				$noptpchsx="recnobp_".$j;
				$noptqtysx="recqtyp_".$j;
				$txtwhg=trim($_POST[$txtwhgx]);
				$txtbing=trim($_POST[$txtbingx]);
				$txtsubbg=trim($_POST[$txtsubbgx]);
				$noptpchs=trim($_POST[$noptpchsx]);
				$noptqtys=trim($_POST[$noptqtysx]);
				if($noptqtys!="" || $noptqtys>0)
				{
					$sql_sub_sub="insert into tbl_revalidatetmp_sub2 (rv_id, rvs_whid, rvs_binid, rvs_sbinid, rvs_nop, rvs_qty, plantcode) values('$subid', '$txtwhg', '$txtbing', '$txtsubbg', '$noptpchs', '$noptqtys', '$plantcode')";
					mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				}
			}
		}		
		//exit;
		echo "<script>window.location='add_revalidate_preview.php?p_id=$pid&sid=$subid'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging -Transaction - Pack Seed - Re-Printing</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

</head>
<script src="rv.js"></script>
<script src="../include/validation.js"></script>
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

function psrnchk(qval)
{
	dt1=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.date.value,"-");
	dt3=getDateObject(document.frmaddDepartment.dot.value,"-");
	
	if(document.frmaddDepartment.txtpsrno.value=="")
	{
		alert("Re-Printing/Packing Slip Reference number cannot be blank");
		document.frmaddDepartment.txtpsrno.focus();
		return false;
	}
	if(dt1<dt3)
	{
		alert("Date of Re-Printing/Packing cannot be prior to Date of Test");
		return false;
	}
	if(dt1>dt2)
	{
		alert("Date of Re-Printing/Packing cannot be later than transaction Date");
		return false;
	}
	
	if(parseInt(qval)<0)
	{
		alert("Invalid Nop - QC Sample");
		return false;
	}
	
	if(parseInt(qval) > 0)
	{
		var bnop=parseInt(document.frmaddDepartment.txtenop.value)-(parseInt(qval)+parseInt(document.frmaddDepartment.txtnoppl.value));
		document.frmaddDepartment.txtbnop.value=parseInt(bnop);
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(parseFloat(ups[0])/1000);
		}
		else
		{
			pt=ups[0];
		}
		document.frmaddDepartment.txtbqty.value=((parseFloat(bnop)*parseFloat(pt))*100)/100;
		document.frmaddDepartment.txtbqty.value=parseFloat(document.frmaddDepartment.txtbqty.value).toFixed(3);
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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
		document.frmaddDepartment.txtbnop.value=parseInt(document.frmaddDepartment.txtenop.value);
		document.frmaddDepartment.txtbqty.value=((parseFloat(document.frmaddDepartment.txteqty.value))*100)/100;
		document.frmaddDepartment.txtbqty.value=parseFloat(document.frmaddDepartment.txtbqty.value).toFixed(3);
		
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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

function psrnchk1(qval)
{
	dt1=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.date.value,"-");
	dt3=getDateObject(document.frmaddDepartment.dot.value,"-");
	
	if(document.frmaddDepartment.txtpsrno.value=="")
	{
		alert("Re-Printing/Packing Slip Reference number cannot be blank");
		document.frmaddDepartment.txtpsrno.focus();
		return false;
	}
	if(dt1<dt3)
	{
		alert("Date of Re-Printing/Packing cannot be prior to Date of Test");
		return false;
	}
	if(dt1>dt2)
	{
		alert("Date of Re-Printing/Packing cannot be later than transaction Date");
		return false;
	}
	if(parseInt(document.frmaddDepartment.txtnopqc.value)<0)
	{
		alert("Invalid Nop - QC Sample");
		return false;
	}
	if(parseInt(qval)<0)
	{
		alert("Invalid Nop - Re-Printing Packing Loss");
		return false;
	}
	if(parseInt(qval) > 0)
	{
		var bnop=parseInt(document.frmaddDepartment.txtenop.value)-(parseInt(qval)+parseInt(document.frmaddDepartment.txtnopqc.value));
		//var bnop=parseInt(document.frmaddDepartment.txtenop.value)-parseInt(qval);
		document.frmaddDepartment.txtbnop.value=parseInt(bnop);
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(parseFloat(ups[0])/1000);
		}
		else
		{
			pt=ups[0];
		}
		
		document.frmaddDepartment.txtbqty.value=((parseFloat(bnop)*parseFloat(pt))*100)/100;
		document.frmaddDepartment.txtbqty.value=parseFloat(document.frmaddDepartment.txtbqty.value).toFixed(3);
		
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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
		document.frmaddDepartment.txtbnop.value=parseInt(document.frmaddDepartment.txtenop.value);
		document.frmaddDepartment.txtbqty.value=((parseFloat(document.frmaddDepartment.txteqty.value))*100)/100;
		document.frmaddDepartment.txtbqty.value=parseFloat(document.frmaddDepartment.txtbqty.value).toFixed(3);
		
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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

function chkvalidity(valval)
{
	if(document.frmaddDepartment.txtpsrno.value=="")
	{
		alert("Enter Re-Printing/Packing Slip Reference number");
		document.frmaddDepartment.txtpsrno.focus();
		return false;
	}
	else if(parseInt(document.frmaddDepartment.txtnopqc.value) < 0)
	{
		alert("NoP - QC Sample cannot be less than ZERO(0)");
		document.frmaddDepartment.txtnopqc.focus();
		return false;
	}
	else if(parseInt(document.frmaddDepartment.txtnoppl.value) < 0)
	{
		alert("NoP - Re-Printing Packing Loss cannot be less than ZERO(0)");
		document.frmaddDepartment.txtnopqc.focus();
		return false;
	}
	else if(parseInt(document.frmaddDepartment.txtbnop.value) <= 0)
	{
		alert("NoP cannot be ZERO(0)");
		document.frmaddDepartment.txtnopqc.focus();
		return false;
	}
	else
	{
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
					var ddiff=dateDiff(document.frmaddDepartment.dcdate.value, document.frmaddDepartment.dp1.value);
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
					var ddiff=dateDiff(document.frmaddDepartment.dcdate.value, document.frmaddDepartment.dp2.value);
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
					var ddiff=dateDiff(document.frmaddDepartment.dcdate.value, document.frmaddDepartment.dp3.value);
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
	}
}


function domcchk(val1, val2)
{
	var x="domce_"+val2;
	//var nopc="nopc_"+val2;
	var domcs="domcs_"+val2;
	if(document.frmaddDepartment.txtbnop.value=="" || document.frmaddDepartment.txtbnop.value==0)
	{
		alert("No. of Pouches cannot be Blank/ZERO");
		document.getElementById(domcs).value="";
		document.getElementById(domcs).selectedIndex=0;
		document.getElementById(x).value="";
		return false
	}
	else
	{
		if(val1!="")
		{
			document.getElementById(x).value=val1;
		}
		else
		{
			document.getElementById(x).value="";
		}
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
	else if(parseInt(document.getElementById(tx).value)<parseInt(document.getElementById(x).value))
	{
		alert("Please enter valid Label number");
		document.getElementById(tx).focus();
		return false;
	}
	else
	{
		//var z="nopc_"+dval;
		var xx="lble_"+dval;
		if(parseInt(document.frmaddDepartment.txtbnop.value)>1 && (parseInt(lbval)-parseInt(document.getElementById(x).value))>0)
		{
			if(parseInt(lbval)-parseInt(document.getElementById(x).value)<parseInt(document.frmaddDepartment.txtbnop.value))
			{
				alert("Total Label nos. are not matching with No. of Pouches");
				document.getElementById(xx).value="";
				return false;
			}
		}
	}
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

function mySubmit()
{ 
	var fl=0;	
	dt1=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.date.value,"-");
	dt3=getDateObject(document.frmaddDepartment.dot.value,"-");
	if(document.frmaddDepartment.ptptype.value=="")
	{
		alert("Please select Re-Printing Type Entire/Partial.");
		fl=1;
		return false;
	}
	/*if(document.frmaddDepartment.ptptype.value=="partial" && parseInt(document.frmaddDepartment.bnop.value)<=0)
	{
		alert("Please choose Entire if you want to pick all the NoP for Re-Printing");
		fl=1;
		return false;
	}*/
	var nop=0;
	for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var nob="recnobp"+i;
		if(document.getElementById(nob).value!="")
		{
			nop=parseInt(nop)+parseInt(document.getElementById(nob).value);
		}
	}
	if(parseInt(document.frmaddDepartment.txtenop.value)!=parseInt(nop))
	{
		alert("Nop Picked for Re-Printing not matching with Total NoP picked from Existing bins");
		document.frmaddDepartment.txtpsrno.value="";
		fl=1;
		return false;
	}
	
	if(document.frmaddDepartment.txtpsrno.value=="")
	{
		alert("Re-Printing/Packing Slip Reference number cannot be blank");
		fl=1;
		return false;
	}
	if(dt1<dt3)
	{
		alert("Date of Re-Printing/Packing cannot be prior to Date of Test");
		fl=1;
		return false;
	}
	if(dt1>dt2)
	{
		alert("Date of Re-Printing/Packing cannot be later than transaction Date");
		fl=1;
		return false;
	}
	
	if(parseInt(document.frmaddDepartment.txtenop.value) != (parseInt(document.frmaddDepartment.txtnopqc.value)+parseInt(document.frmaddDepartment.txtnoppl.value)+parseInt(document.frmaddDepartment.txtbnop.value)))
	{
		alert("NoP picked for Re-Printing not matching with total of NoP in QC, Nop in Re-Printing Packing Loss and Balance Pouches");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.txtnopqc.value) < 0)
	{
		alert("NoP - QC Sample cannot be less than ZERO(0)");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.txtnoppl.value) < 0)
	{
		alert("NoP - Re-Printing Packing Loss cannot be less than ZERO(0)");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.txtbnop.value) <= 0)
	{
		alert("Balance Pouches cannot be ZERO(0)");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.valdays.value=="")
	{
		alert("Please Select Validity Period");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.valdays.value) <= 0)
	{
		alert("Validity Days cannot be ZERO(0)");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.domcs_1.value=="")
	{
		alert("Please select Label No.");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.lbls_1.value) <= 0)
	{
		alert("Label No. cannot be ZERO(0)");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.lble_1.value) <= 0)
	{
		alert("Label No. cannot be ZERO(0)");
		fl=1;
		return false;
	}
	
	var zzz=document.frmaddDepartment.sno.value;
	
	if(document.frmaddDepartment.pkgtype.value=="Yes" > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
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
	if(y==x)
	{
		alert("Please select SLOC for Pack Seed");
		f=1;
		return false;
	}
	else
	{
		if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.txtbqty.value))
		{
			alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
			return false;
			f=1;
		}
		if(document.frmaddDepartment.bpch.value>0)
		{
			alert("Balance Pouches not Linked");
			f=1;
			return false;
		}
	}
	
	if(fl==1)
	{
		return false;
	}
	else
	{
		return true;	 
	} 
}

/*function wh(wh1val, whno)
{ 
	var whi="txtslwhg"+whno;
	if(whno>1)
	{
		var qtys="txtslqtyg"+whno-1;
		if(document.getElementsByName(qtys)[0].value=="")
		{
			alert("Please enter Qty in previous Bin")
			document.getElementsByName(whi)[0].selectedIndex=0;
			return false;
		}
		else
		{
			var bing="bing"+whno;
			showUser(wh1val,bing,'wh',bing,'','','','');
		}
	}
	else
	{
		var bing="bing"+whno;
		showUser(wh1val,bing,'wh',bing,'','','','');
	}
}

function bin(bin1val, binno)
{
	var whi="txtslwhg"+binno;
	var txtslbing="txtslbing"+binno;
	if(document.getElementsByName(whi)[0].value!="")
	{
		var sbing="sbing"+binno;
		var txtslsubbg="txtslsubbg"+binno;
		showUser(bin1val,sbing,'bin',txtslsubbg,'','','','');
	}
	else
	{
		alert("Please select Warehouse");
		getElementsByName(txtslbing)[0].selectedIndex=0;
		getElementsByName(whi)[0].focus();
		return false;
	}
}

function subbin(subbin1val,subbinno)
{	
	var itemv=document.frmaddDepartment.variety.value;
	var txtslbing="txtslbing"+subbinno;
	if(document.getElementsByName(txtslbing)[0].value!="")
	{	
		var cnt=0; 
		var w=[];
		for (var i=1; i<=subbinno; i++)
		{
			var txtslwhg="txtslwhg"+i;
			var txtslbing="txtslbing"+i;
			var txtslsubbg="txtslsubbg"+i;
			w[i]=document.getElementsByName(txtslwhg)[0].value+document.getElementsByName(txtslbing)[0].value+document.getElementsByName(txtslsubbg)[0].value;
			cnt++;
		}
		if(cnt > 1)
		{
			var ct=0;
			for (var i=1; i<=cnt; i++)
			{
				for (var j=i+1; j<=cnt; j++)
				{
					if(w[i]==w[j])
					{
						ct++;
					}
				}
			}
			if(ct>0)
			{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb'+[subbinno]).selectedIndex=0;
				document.getElementById('sb'+[subbinno]).focus();
				return false;
			}
		}
		var slocnogood=document.frmaddDepartment.sstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var Bagsv1=document.frmaddDepartment.txtsrtyp.value;
		var qtyv1="";
		var txtslsubbg="txtslsubbg"+subbinno;
		var slocrow="slocrow"+subbinno;
		showUser(subbin1val,slocrow,'subbin',itemv,txtslsubbg,slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		var txtslsubbg="txtslsubbg"+subbinno;
		alert("Please select Bin");
		document.getElementsByName(txtslsubbg)[0].selectedIndex=0;
		document.getElementsByName(txtslbing)[0].focus();
		return false;
	}
}*/


function Bagsf(Bags1val, bagno)
{
	var txtslsubbg="txtslsubbg"+bagno;
	var txtslBagsg="txtslBagsg"+bagno;
	var txtslqtyg="txtslqtyg"+bagno;
	if(document.getElementsByName(txtslsubbg)[0].value=="")
	{
		alert("Please select Sub Bin");
		document.getElementsByName(txtslsubbg)[0].focus();
		document.getElementsByName(txtslBagsg)[0].value="";
		return false;
	}
	if(document.getElementsByName(txtslBagsg)[0].value!="")
	{
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(parseFloat(ups[0])/1000);
		}
		else
		{
			pt=ups[0];
		}
		document.getElementsByName(txtslqtyg)[0].value=((parseFloat(Bags1val)*parseFloat(pt))*100)/100;
		document.getElementsByName(txtslqtyg)[0].value=parseFloat(document.getElementsByName(txtslqtyg)[0].value).toFixed(3);
		
	}
}

function qtyf(qty1val, qtyno)
{	
	var txtslBagsg="txtslBagsg"+qtyno;
	var txtslqtyg="txtslqtyg"+qtyno;
	if(document.getElementsByName(txtslBagsg)[0].value=="")
	{
		alert("Please enter Bags");
		document.getElementsByName(txtslBagsg)[0].focus();
		document.getElementsByName(txtslqtyg)[0].value="";
		return false;
	}
	if(document.getElementsByName(txtslqtyg)[0].value!="")
	{
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(1000/parseFloat(ups[0]));
			document.getElementsByName(txtslBagsg)[0].value=parseFloat(qty1val)*parseInt(pt);
		}
		else
		{
			pt=ups[0];
			document.getElementsByName(txtslBagsg)[0].value=parseFloat(qty1val)/parseInt(pt);
		}
		var x=document.getElementsByName(txtslBagsg)[0].value.split(".");
		if(parseInt(x[1]) > 0)
		{
			alert("Invalid NoP");
			document.getElementsByName(txtslBagsg)[0].value="";
			return false;
		}
	}
}
function chklot(lotval)
{
	if(document.frmaddDepartment.lotno.value=="")
	{
		alert("Lot No. selected for Re-Printing");
		return false;
	}
	else
	{
		if(lotval=="entire")
		{
			document.frmaddDepartment.txtnewlot.value=document.frmaddDepartment.lotnmo.value;
			document.frmaddDepartment.ptptype.value=lotval;
			document.getElementById('batchchk').innerHTML="&nbsp;Batch No. Generated - <font color=red>YES</font>";
			document.frmaddDepartment.txtenop.value=document.frmaddDepartment.enop.value;
			document.frmaddDepartment.txteqty.value=document.frmaddDepartment.eqty.value;
			document.frmaddDepartment.txtenop.style.background="#CCCCCC";
			document.frmaddDepartment.txtenop.readOnly=true;
			document.frmaddDepartment.txteqty.style.background="#CCCCCC";
			document.frmaddDepartment.txteqty.readOnly=true;
			
			document.frmaddDepartment.bnop.value=0;
			document.frmaddDepartment.bqty.value=0;
			for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
			{
				var exqty="txtextqty"+i;
				var exnob="txtextnob"+i;
				var bnob="txtbalnobp"+i;
				var bqty="txtbalqtyp"+i;
				var nob="recnobp"+i;
				var qty="recqtyp"+i;
				
				document.getElementById(nob).value=document.getElementById(exnob).value;
				document.getElementById(qty).value=document.getElementById(exqty).value;
				document.getElementById(nob).readOnly=true;
				document.getElementById(nob).style.backgroundColor="#CCCCCC";
				document.getElementById(qty).readOnly=true;
				document.getElementById(qty).style.backgroundColor="#CCCCCC";
				document.getElementById(bnob).value=0;
				document.getElementById(bqty).value=0;
			}
			
			
			document.frmaddDepartment.txtnopqc.value=0;
			document.frmaddDepartment.txtnoppl.value=0;
			document.frmaddDepartment.txtbnop.value=document.frmaddDepartment.txtenop.value;
			document.frmaddDepartment.txtbqty.value=document.frmaddDepartment.txteqty.value;
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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
		else if(lotval=="partial")
		{
			document.frmaddDepartment.txtnewlot.value=document.frmaddDepartment.lotnmb.value;
			document.frmaddDepartment.ptptype.value=lotval;
			document.getElementById('batchchk').innerHTML="&nbsp;Batch No. Generated - <font color=red>YES</font>";
			document.frmaddDepartment.txtenop.value=document.frmaddDepartment.enop.value;
			document.frmaddDepartment.txteqty.value=document.frmaddDepartment.eqty.value;
			document.frmaddDepartment.txtenop.style.background="#FFFFFF";
			document.frmaddDepartment.txtenop.readOnly=false;
			document.frmaddDepartment.txteqty.style.background="#FFFFFF";
			document.frmaddDepartment.txteqty.readOnly=false;
			
			document.frmaddDepartment.bnop.value=0;
			document.frmaddDepartment.bqty.value=0;
			
			for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
			{
				var exqty="txtextqty"+i;
				var exnob="txtextnob"+i;
				var bnob="txtbalnobp"+i;
				var bqty="txtbalqtyp"+i;
				var nob="recnobp"+i;
				var qty="recqtyp"+i;
				
				document.getElementById(nob).value="";
				document.getElementById(nob).readOnly=false;
				document.getElementById(nob).style.backgroundColor="#FFFFFF";
				document.getElementById(qty).value="";
				document.getElementById(qty).readOnly=false;
				document.getElementById(qty).style.backgroundColor="#FFFFFF";
				document.getElementById(bnob).value="";
				document.getElementById(bqty).value="";
			}
			
			document.frmaddDepartment.txtnopqc.value=0;
			document.frmaddDepartment.txtnoppl.value=0;
			document.frmaddDepartment.txtbnop.value=document.frmaddDepartment.txtenop.value;
			document.frmaddDepartment.txtbqty.value=document.frmaddDepartment.txteqty.value;
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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
			document.frmaddDepartment.txtnewlot.value="";
			document.frmaddDepartment.ptptype.value="";
			document.getElementById('batchchk').innerHTML="";
			document.frmaddDepartment.txtenop.value=document.frmaddDepartment.enop.value;
			document.frmaddDepartment.txteqty.value=document.frmaddDepartment.eqty.value;
			document.frmaddDepartment.txtenop.style.background="#CCCCCC";
			document.frmaddDepartment.txtenop.readOnly=true;
			document.frmaddDepartment.txteqty.style.background="#CCCCCC";
			document.frmaddDepartment.txteqty.readOnly=true;
			
			document.frmaddDepartment.bnop.value=0;
			document.frmaddDepartment.bqty.value=0;
			
			for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
			{
				var exqty="txtextqty"+i;
				var exnob="txtextnob"+i;
				var bnob="txtbalnobp"+i;
				var bqty="txtbalqtyp"+i;
				var nob="recnobp"+i;
				var qty="recqtyp"+i;
				
				document.getElementById(nob).value="";
				document.getElementById(nob).readOnly=true;
				document.getElementById(nob).style.backgroundColor="#CCCCCC";
				document.getElementById(qty).value="";
				document.getElementById(qty).readOnly=true;
				document.getElementById(qty).style.backgroundColor="#CCCCCC";
				document.getElementById(bnob).value="";
				document.getElementById(bqty).value="";
			}
			document.frmaddDepartment.txtnopqc.value=0;
			document.frmaddDepartment.txtnoppl.value=0;
			document.frmaddDepartment.txtbnop.value=document.frmaddDepartment.txtenop.value;
			document.frmaddDepartment.txtbqty.value=document.frmaddDepartment.txteqty.value;
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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

function chknop(nopval, sno)
{
	if(parseInt(nopval) > 0)
	{
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(parseFloat(ups[0])/1000);
		}
		else
		{
			pt=ups[0];
		}
		document.frmaddDepartment.txteqty.value=((parseFloat(nopval)*parseFloat(pt))*100)/100;
		document.frmaddDepartment.txteqty.value=parseFloat(document.frmaddDepartment.txteqty.value).toFixed(3);
		document.frmaddDepartment.bqty.value=parseFloat(document.frmaddDepartment.eqty.value)-parseFloat(document.frmaddDepartment.txteqty.value);
		document.frmaddDepartment.bnop.value=parseInt(document.frmaddDepartment.enop.value)-parseInt(document.frmaddDepartment.txtenop.value);
		document.frmaddDepartment.bqty.value=parseFloat(document.frmaddDepartment.bqty.value).toFixed(3);
		
		if(parseInt(document.frmaddDepartment.bnop.value)<0)
		{
			alert("Invalid NoP");
			document.frmaddDepartment.txteqty.value="";
			document.frmaddDepartment.txtenop.value="";
			document.frmaddDepartment.bqty.value="0";
			document.frmaddDepartment.bnop.value="0";
			document.frmaddDepartment.txtenop.focus();
		}
		document.frmaddDepartment.txtbnop.value=document.frmaddDepartment.txtenop.value;
		document.frmaddDepartment.txtbqty.value=document.frmaddDepartment.txteqty.value;
		
			document.frmaddDepartment.txtnopqc.value=0;
			document.frmaddDepartment.txtnoppl.value=0;
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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
		document.frmaddDepartment.txteqty.value="";
		document.frmaddDepartment.txtenop.value="";
		document.frmaddDepartment.bqty.value=0;
		document.frmaddDepartment.bnop.value=0;
		document.frmaddDepartment.txtbnop.value=document.frmaddDepartment.enop.value;
		document.frmaddDepartment.txtbqty.value=document.frmaddDepartment.eqty.value;
			
			document.frmaddDepartment.txtnopqc.value=0;
			document.frmaddDepartment.txtnoppl.value=0;
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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

function chkqty(qtyval, sno)
{
	if(parseFloat(qtyval) > 0)
	{
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(1000/parseFloat(ups[0]));
			document.frmaddDepartment.txtenop.value=parseFloat(qtyval)*parseInt(pt);
		}
		else
		{
			pt=ups[0];
			document.frmaddDepartment.txtenop.value=parseFloat(qtyval)/parseInt(pt);
		}
		document.frmaddDepartment.bqty.value=parseFloat(document.frmaddDepartment.eqty.value)-parseFloat(document.frmaddDepartment.txteqty.value);
		document.frmaddDepartment.bnop.value=parseInt(document.frmaddDepartment.enop.value)-parseInt(document.frmaddDepartment.txtenop.value);
		document.frmaddDepartment.bqty.value=parseFloat(document.frmaddDepartment.bqty.value).toFixed(3);
		if(parseFloat(document.frmaddDepartment.bqty.value)<0)
		{
			alert("Invalid Qty");
			document.frmaddDepartment.eqty.value="";
			document.frmaddDepartment.txtenop.value="";
			document.frmaddDepartment.bqty.value="";
			document.frmaddDepartment.bnop.value="";
			document.frmaddDepartment.eqty.focus();
		}
		var x=document.frmaddDepartment.txtenop.value.split(".");
		if(parseInt(x[1]) > 0)
		{
			alert("Invalid NoP");
			document.frmaddDepartment.eqty.value="";
			document.frmaddDepartment.txtenop.value="";
			document.frmaddDepartment.bqty.value="";
			document.frmaddDepartment.bnop.value="";
			return false;
		}
		document.frmaddDepartment.txtbnop.value=document.frmaddDepartment.txtenop.value;
		document.frmaddDepartment.txtbqty.value=document.frmaddDepartment.txteqty.value;
		
			document.frmaddDepartment.txtnopqc.value=0;
			document.frmaddDepartment.txtnoppl.value=0;
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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
		document.frmaddDepartment.eqty.value="";
		document.frmaddDepartment.txtenop.value="";
		document.frmaddDepartment.bqty.value="";
		document.frmaddDepartment.bnop.value="";
		document.frmaddDepartment.txtbnop.value=document.frmaddDepartment.enop.value;
		document.frmaddDepartment.txtbqty.value=document.frmaddDepartment.eqty.value;
		
			document.frmaddDepartment.txtnopqc.value=0;
			document.frmaddDepartment.txtnoppl.value=0;
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			
			document.frmaddDepartment.pkgtype.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').InnerHTML="Fill";
			
			document.getElementById('txtwhg1').value="";
			document.getElementById('txtwhg2').value="";
			document.getElementById('txtwhg3').value="";
			document.getElementById('txtwhg4').value="";
			document.getElementById('txtwhg5').value="";
			document.getElementById('txtwhg6').value="";
			document.getElementById('txtwhg7').value="";
			document.getElementById('txtwhg8').value="";
				
			document.getElementById('txtbing1').value="";
			document.getElementById('txtbing2').value="";
			document.getElementById('txtbing3').value="";
			document.getElementById('txtbing4').value="";
			document.getElementById('txtbing5').value="";
			document.getElementById('txtbing6').value="";
			document.getElementById('txtbing7').value="";
			document.getElementById('txtbing8').value="";
				
			document.getElementById('txtsubbg1').value="";
			document.getElementById('txtsubbg2').value="";
			document.getElementById('txtsubbg3').value="";
			document.getElementById('txtsubbg4').value="";
			document.getElementById('txtsubbg5').value="";
			document.getElementById('txtsubbg6').value="";
			document.getElementById('txtsubbg7').value="";
			document.getElementById('txtsubbg8').value="";
				
			document.getElementById('txtwhg1').selectedIndex=0;
			document.getElementById('txtwhg2').selectedIndex=0;
			document.getElementById('txtwhg3').selectedIndex=0;
			document.getElementById('txtwhg4').selectedIndex=0;
			document.getElementById('txtwhg5').selectedIndex=0;
			document.getElementById('txtwhg6').selectedIndex=0;
			document.getElementById('txtwhg7').selectedIndex=0;
			document.getElementById('txtwhg8').selectedIndex=0;
				
			document.getElementById('txtbing1').selectedIndex=0;
			document.getElementById('txtbing2').selectedIndex=0;
			document.getElementById('txtbing3').selectedIndex=0;
			document.getElementById('txtbing4').selectedIndex=0;
			document.getElementById('txtbing5').selectedIndex=0;
			document.getElementById('txtbing6').selectedIndex=0;
			document.getElementById('txtbing7').selectedIndex=0;
			document.getElementById('txtbing8').selectedIndex=0;
			
			document.getElementById('txtsubbg1').selectedIndex=0;
			document.getElementById('txtsubbg2').selectedIndex=0;
			document.getElementById('txtsubbg3').selectedIndex=0;
			document.getElementById('txtsubbg4').selectedIndex=0;
			document.getElementById('txtsubbg5').selectedIndex=0;
			document.getElementById('txtsubbg6').selectedIndex=0;
			document.getElementById('txtsubbg7').selectedIndex=0;
			document.getElementById('txtsubbg8').selectedIndex=0;
				
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

function pcksel(pckval)
{
	document.frmaddDepartment.pkgtype.value=pckval;
	document.getElementById('dtail_1').InnerHTML="Fill";
	if(pckval=="Yes")
	{
		document.frmaddDepartment.nomp_1.value="";
		document.frmaddDepartment.nomp_1.readOnly=false;
		document.frmaddDepartment.nomp_1.style.backgroundColor="#ffffff";
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt=""; var pt1="";
		if(ups[1]=="Gms")
		{
			//pt=(parseFloat(ups[0])/1000);
			pt=(1000/parseFloat(ups[0]));
		}
		else
		{
			//pt=ups[0];
			pt=ups[0];
		}
		if(ups[1]=="Gms")
		pt1=pt*parseFloat(document.frmaddDepartment.wtmp_1.value);
		else
		pt1=parseFloat(document.frmaddDepartment.wtmp_1.value)/pt;
		//alert(document.frmaddDepartment.txtbqty.value);
		//alert(document.frmaddDepartment.wtmp_1.value);	
		document.frmaddDepartment.nomp_1.value=Math.floor(parseFloat(document.frmaddDepartment.txtbqty.value)/parseFloat(document.frmaddDepartment.wtmp_1.value));
		//alert(document.frmaddDepartment.nomp_1.value);
		//alert(document.frmaddDepartment.wtnop_1.value);	
		var balnop=parseInt(document.frmaddDepartment.nomp_1.value)*parseInt(pt1);
		//alert(document.getElementById('nopc_'+[val12]).value);
		//alert(balnop);
		//alert(document.frmaddDepartment.txtbnop.value);
		var nps=parseInt(document.frmaddDepartment.txtbnop.value)-parseInt(balnop);
		//alert(nps);
		if(parseInt(nps)<0)
		{
			alert("Cannot convert to MP.\n\nReason: Pouches/Qty not sufficient to create MP");
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=true;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.noofpacks_1.readOnly=true;
			document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
			document.getElementById('dtail_1').innerHTML="Fill";
			for(var i=0; i<document.frmaddDepartment.pckgtyp.length; i++)
			{
				document.frmaddDepartment.pckgtyp[i].checked=false;
			}
			document.frmaddDepartment.pkgtype.value="";
			return false;
		}
		else
		{ 
			//document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.readOnly=false;
			document.frmaddDepartment.nomp_1.style.backgroundColor="#ffffff";
			document.frmaddDepartment.noofpacks_1.value=parseInt(document.frmaddDepartment.txtbnop.value)-parseInt(balnop);
			document.frmaddDepartment.nopks.value=document.frmaddDepartment.noofpacks_1.value;
			document.frmaddDepartment.extbpch.value=document.frmaddDepartment.noofpacks_1.value;
			document.frmaddDepartment.bpch.value=document.frmaddDepartment.noofpacks_1.value;
			document.frmaddDepartment.pkgtype.value=pckval;
			document.getElementById('dtail_1').innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Fill</a>";
		}
	}
	else
	{	//alert(document.frmaddDepartment.txtbnop.value);
		//alert(document.getElementById('dtail_1').InnerHTML);
		document.frmaddDepartment.nomp_1.value="";
		document.frmaddDepartment.nomp_1.readOnly=true;
		document.frmaddDepartment.nomp_1.style.backgroundColor="#cccccc";
		document.frmaddDepartment.noofpacks_1.value="";
		document.frmaddDepartment.noofpacks_1.readOnly=true;
		document.frmaddDepartment.noofpacks_1.style.backgroundColor="#cccccc";
		document.getElementById('dtail_1').innerHTML="Fill";
		//alert(document.getElementById('dtail_1').InnerHTML);
		document.frmaddDepartment.nopks.value=document.frmaddDepartment.txtbnop.value;
		document.frmaddDepartment.extbpch.value=document.frmaddDepartment.txtbnop.value;
		document.frmaddDepartment.bpch.value=document.frmaddDepartment.txtbnop.value;
	}
	
	document.getElementById('txtwhg1').value="";
	document.getElementById('txtwhg2').value="";
	document.getElementById('txtwhg3').value="";
	document.getElementById('txtwhg4').value="";
	document.getElementById('txtwhg5').value="";
	document.getElementById('txtwhg6').value="";
	document.getElementById('txtwhg7').value="";
	document.getElementById('txtwhg8').value="";
		
	document.getElementById('txtbing1').value="";
	document.getElementById('txtbing2').value="";
	document.getElementById('txtbing3').value="";
	document.getElementById('txtbing4').value="";
	document.getElementById('txtbing5').value="";
	document.getElementById('txtbing6').value="";
	document.getElementById('txtbing7').value="";
	document.getElementById('txtbing8').value="";
		
	document.getElementById('txtsubbg1').value="";
	document.getElementById('txtsubbg2').value="";
	document.getElementById('txtsubbg3').value="";
	document.getElementById('txtsubbg4').value="";
	document.getElementById('txtsubbg5').value="";
	document.getElementById('txtsubbg6').value="";
	document.getElementById('txtsubbg7').value="";
	document.getElementById('txtsubbg8').value="";
		
	document.getElementById('txtwhg1').selectedIndex=0;
	document.getElementById('txtwhg2').selectedIndex=0;
	document.getElementById('txtwhg3').selectedIndex=0;
	document.getElementById('txtwhg4').selectedIndex=0;
	document.getElementById('txtwhg5').selectedIndex=0;
	document.getElementById('txtwhg6').selectedIndex=0;
	document.getElementById('txtwhg7').selectedIndex=0;
	document.getElementById('txtwhg8').selectedIndex=0;
		
	document.getElementById('txtbing1').selectedIndex=0;
	document.getElementById('txtbing2').selectedIndex=0;
	document.getElementById('txtbing3').selectedIndex=0;
	document.getElementById('txtbing4').selectedIndex=0;
	document.getElementById('txtbing5').selectedIndex=0;
	document.getElementById('txtbing6').selectedIndex=0;
	document.getElementById('txtbing7').selectedIndex=0;
	document.getElementById('txtbing8').selectedIndex=0;
	
	document.getElementById('txtsubbg1').selectedIndex=0;
	document.getElementById('txtsubbg2').selectedIndex=0;
	document.getElementById('txtsubbg3').selectedIndex=0;
	document.getElementById('txtsubbg4').selectedIndex=0;
	document.getElementById('txtsubbg5').selectedIndex=0;
	document.getElementById('txtsubbg6').selectedIndex=0;
	document.getElementById('txtsubbg7').selectedIndex=0;
	document.getElementById('txtsubbg8').selectedIndex=0;
		
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

function balnopcheck(balval, val12)
{
	var bv=Math.floor(parseFloat(document.frmaddDepartment.txtbqty.value)/parseFloat(document.frmaddDepartment.wtmp_1.value));
	//alert(bv);
	//alert(balval);
	if(parseInt(balval) > parseInt(bv))
	{
		alert("No. of Master Pack cannot be greater than "+bv);
		document.frmaddDepartment.noofpacks_1.value="";
		document.frmaddDepartment.nomp_1.value="";
		document.frmaddDepartment.nomp_1.focus();
		return false;
	}
	else
	{
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt=""; var pt1="";
		if(ups[1]=="Gms")
		{
			//pt=(parseFloat(ups[0])/1000);
			pt=(1000/parseFloat(ups[0]));
		}
		else
		{
			//pt=ups[0];
			pt=ups[0];
		}
		pt1=pt*parseFloat(document.frmaddDepartment.wtmp_1.value);
		var balnop=parseInt(document.frmaddDepartment.nomp_1.value)*parseInt(pt1);
		var nps=parseInt(document.frmaddDepartment.txtbnop.value)-parseInt(balnop);
		//alert(nps);
		if(parseInt(nps)<0)
		{
			alert("Invelid No. of MP");
			document.frmaddDepartment.noofpacks_1.value="";
			document.frmaddDepartment.nomp_1.value="";
			document.frmaddDepartment.nomp_1.focus();
			document.frmaddDepartment.nopks.value=document.frmaddDepartment.txtbnop.value;
			document.frmaddDepartment.extbpch.value=document.frmaddDepartment.txtbnop.value;
			document.frmaddDepartment.bpch.value=document.frmaddDepartment.txtbnop.value;
			document.getElementById('dtail_1').InnerHTML="Fill";
			return false;
		}
		else
		{
			document.frmaddDepartment.noofpacks_1.value=parseInt(document.frmaddDepartment.txtbnop.value)-parseInt(balnop);
			document.frmaddDepartment.nopks.value=document.frmaddDepartment.noofpacks_1.value;
			document.frmaddDepartment.extbpch.value=document.frmaddDepartment.noofpacks_1.value;
			document.frmaddDepartment.bpch.value=document.frmaddDepartment.noofpacks_1.value;
			document.getElementById('dtail_1').InnerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Fill</a>";
		}
	}
	
	document.getElementById('txtwhg1').value="";
	document.getElementById('txtwhg2').value="";
	document.getElementById('txtwhg3').value="";
	document.getElementById('txtwhg4').value="";
	document.getElementById('txtwhg5').value="";
	document.getElementById('txtwhg6').value="";
	document.getElementById('txtwhg7').value="";
	document.getElementById('txtwhg8').value="";
		
	document.getElementById('txtbing1').value="";
	document.getElementById('txtbing2').value="";
	document.getElementById('txtbing3').value="";
	document.getElementById('txtbing4').value="";
	document.getElementById('txtbing5').value="";
	document.getElementById('txtbing6').value="";
	document.getElementById('txtbing7').value="";
	document.getElementById('txtbing8').value="";
		
	document.getElementById('txtsubbg1').value="";
	document.getElementById('txtsubbg2').value="";
	document.getElementById('txtsubbg3').value="";
	document.getElementById('txtsubbg4').value="";
	document.getElementById('txtsubbg5').value="";
	document.getElementById('txtsubbg6').value="";
	document.getElementById('txtsubbg7').value="";
	document.getElementById('txtsubbg8').value="";
		
	document.getElementById('txtwhg1').selectedIndex=0;
	document.getElementById('txtwhg2').selectedIndex=0;
	document.getElementById('txtwhg3').selectedIndex=0;
	document.getElementById('txtwhg4').selectedIndex=0;
	document.getElementById('txtwhg5').selectedIndex=0;
	document.getElementById('txtwhg6').selectedIndex=0;
	document.getElementById('txtwhg7').selectedIndex=0;
	document.getElementById('txtwhg8').selectedIndex=0;
		
	document.getElementById('txtbing1').selectedIndex=0;
	document.getElementById('txtbing2').selectedIndex=0;
	document.getElementById('txtbing3').selectedIndex=0;
	document.getElementById('txtbing4').selectedIndex=0;
	document.getElementById('txtbing5').selectedIndex=0;
	document.getElementById('txtbing6').selectedIndex=0;
	document.getElementById('txtbing7').selectedIndex=0;
	document.getElementById('txtbing8').selectedIndex=0;
	
	document.getElementById('txtsubbg1').selectedIndex=0;
	document.getElementById('txtsubbg2').selectedIndex=0;
	document.getElementById('txtsubbg3').selectedIndex=0;
	document.getElementById('txtsubbg4').selectedIndex=0;
	document.getElementById('txtsubbg5').selectedIndex=0;
	document.getElementById('txtsubbg6').selectedIndex=0;
	document.getElementById('txtsubbg7').selectedIndex=0;
	document.getElementById('txtsubbg8').selectedIndex=0;
		
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

function detailspop(dval2)
{
//alert(dval2);
	var sno=document.frmaddDepartment.sno.value;
	var dval=1;
	//alert(dval);
	if(dval>0)
	{
		var tx="lble_"+dval;
		if(document.getElementById(tx).value=="")
		{
			alert("Please enter Label number");
			document.getElementById(tx).focus();
			return false;
		}
		else
		{
			var nomp="nomp_"+dval;
			var totnomp=document.getElementById(nomp).value;
			var tid=document.frmaddDepartment.maintrid.value;
			var subtid='0';
			var lotno=document.frmaddDepartment.txtnewlot.value;
			var txtpsrn=document.frmaddDepartment.txtpsrno.value;
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
}

function bcsyncchk()
{

}




function wh(wh1val, whno)
{ 	//alert(wh1val);
	//alert(whno);
	if(whno==1)
	{
		var z=0; var xs=0;
		var sno=document.frmaddDepartment.sno.value;
		/*for(var i=1; i<=sno; i++)
		{
			var fet="nopc_"+i;
			if(document.getElementById(fet).value=="")
			{z++;}
			else
			{xs=i;}
		}*/
		
		if(document.frmaddDepartment.pkgtype.value=="")
		{
			alert("Please select Convert to MP option");
			return false;
			xs=0;
		}
		if(document.frmaddDepartment.pkgtype.value=="Yes")
		{
			xs=1;
		}
		if(xs!=0)
		{ //alert(xs);
			var fet="nomp_"+xs;
			//alert(document.getElementById(fet).value);
			//alert(document.frmaddDepartment.detmpbno.value);
			if(document.getElementById(fet).value!="")
			{
				if(document.getElementById(fet).value!=document.frmaddDepartment.detmpbno.value)
				{
					alert("Barcode Labels are not matching with No. of Master Pack");
					return false;
				}
			}
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
	var bin="bingn"+whno;
	showUser(wh1val,bin,'whnew',bin,whno,'','','');
}

function bin(bin2val, binno)
{
	var whc="txtwhg"+binno;
	var sbin="sbingn"+binno;
	var binc="txtsubbg"+binno;
	if(document.getElementById(whc).value=="")
	{
		alert("Please select Warehouse");
		return false;
	}
	else
	{
		showUser(bin2val,sbin,'binnew',binc,binno,'','','');
	}
}

function subbin(subbin2val, subbinno)
{	
	var binc="txtbing"+subbinno;
	var existview="existview"+subbinno;
	var trflg="trflg"+subbinno;
	var tpflg="tpflg"+subbinno;
	var tflg="tflg"+subbinno;
	var tpmflg="tpmflg"+subbinno;
	var mp="nopmpcs_"+subbinno;
	var p="noppchs_"+subbinno;
	var tp="noptpchs_"+subbinno;
	var tq="noptqtys_"+subbinno;
	
	document.getElementById(existview).value=""; 
	document.getElementById(trflg).value=""; 
	document.getElementById(tpflg).value="";
	document.getElementById(tflg).value="";
	document.getElementById(tpmflg).value="";
	document.getElementById(mp).value="";
	document.getElementById(mp).readOnly=true;
	document.getElementById(mp).style.backgroundColor="#cccccc";
	document.getElementById(p).value="";
	document.getElementById(p).readOnly=true;
	document.getElementById(p).style.backgroundColor="#cccccc";
	document.getElementById(tp).value="";
	document.getElementById(tq).value="";
		
	if(document.getElementById(binc).value=="")
	{	
		alert("Please select Bin");
		return false;
	}
	else
	{
		var itemv=document.frmaddDepartment.variety.value;
		var slocnogood="Pack";
		var trid=document.frmaddDepartment.maintrid.value;
		var Bagsv1="";
		var qtyv1="";
		var ssbin="slocr"+subbinno;
		var bins="txtsubbg"+subbinno;
		showUser(subbin2val,ssbin,'subbinnew',itemv,bins,slocnogood,subbinno,subbinno,trid);
		setTimeout(function() { sloccomment(subbinno); },400);
	}
}


function sloccomment(rval)
{
	//alert(rval);
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
		setTimeout(function() { sloccomment(rval); },400);
	}
	else if((document.getElementById(trflg).value!="" && document.getElementById(tpflg).value!="" && document.getElementById(tflg).value!="" && document.getElementById(tpmflg).value!="") && (document.getElementById(trflg).value==0 && document.getElementById(tpflg).value==0 && document.getElementById(tflg).value==0 && document.getElementById(tpmflg).value==0))
	{
		if(document.frmaddDepartment.detmpbno.value!="" || document.frmaddDepartment.detmpbno.value > 0)
		{
			document.getElementById(mp).value="";
			document.getElementById(mp).readOnly=false;
			document.getElementById(mp).style.backgroundColor="#ffffff";
		}
		document.getElementById(p).value="";
		document.getElementById(p).readOnly=false;
		document.getElementById(p).style.backgroundColor="#ffffff";
		document.getElementById(tp).value="";
		document.getElementById(tq).value="";
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
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt=""; var pt1="";
		if(ups[1]=="Gms")
		{
			//pt=(parseFloat(ups[0])/1000);
			pt=(1000/parseFloat(ups[0]));
		}
		else
		{
			//pt=ups[0];
			pt=ups[0];
		}
		pt1=pt*parseFloat(document.frmaddDepartment.wtmp_1.value);
		
		//for(var i=1; i<=sno; i++)
		{
			//if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(pt1)*parseInt(mpval);
				var dd=document.getElementById('wtmp_1').value;
				var npwt=document.getElementById('wtnopkg_1').value;
			}
		}
		
		if(document.getElementById('noppchs_'+[mpno]).value!="")
		{
		document.getElementById('noptpchs_'+[mpno]).value=parseInt(d)+parseInt(document.getElementById('noppchs_'+[mpno]).value);
		document.getElementById('noptqtys_'+[mpno]).value=(parseFloat(npwt)*parseFloat(document.getElementById('noppchs_'+[mpno]).value))+(parseFloat(mpval)*parseFloat(dd));
		document.getElementById('noptqtys_'+[mpno]).value=(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		document.getElementById('noptqtys_'+[mpno]).value=parseFloat(document.getElementById('noptqtys_'+[mpno]).value).toFixed(3);
		}
		else
		{
		document.getElementById('noptpchs_'+[mpno]).value=parseInt(d);
		document.getElementById('noptqtys_'+[mpno]).value=parseFloat(mpval)*parseFloat(dd);
		document.getElementById('noptqtys_'+[mpno]).value=(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		document.getElementById('noptqtys_'+[mpno]).value=parseFloat(document.getElementById('noptqtys_'+[mpno]).value).toFixed(3);
		}
		//alert(d);
		//alert(dd);
		//alert(npwt);
		//alert(document.getElementById('noptpchs_'+[mpno]).value);
		//alert(document.getElementById('noptqtys_'+[mpno]).value);
		//alert(document.getElementById('noptqtys_'+[mpno]).value);
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
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt=""; var pt1="";
		if(ups[1]=="Gms")
		{
			//pt=(parseFloat(ups[0])/1000);
			pt=(1000/parseFloat(ups[0]));
		}
		else
		{
			//pt=ups[0];
			pt=ups[0];
		}
		pt1=pt*parseFloat(document.frmaddDepartment.wtmp_1.value);
		if(mpval=="")mpval=0;
		//for(var i=1; i<=sno; i++)
		{
			//if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(pt1)*parseInt(mpval);
				var dd=document.getElementById('wtmp_1').value;
				var npwt=document.getElementById('wtnopkg_1').value;
			}
		}
		//alert(npwt);alert(pchval);alert(mpval);alert(dd);alert(d);
		if(mpval!="")
		{
			document.getElementById('noptpchs_'+[pchno]).value=parseInt(d)+parseInt(pchval);
			document.getElementById('noptqtys_'+[pchno]).value=(parseFloat(npwt)*parseFloat(pchval))+(parseFloat(mpval)*parseFloat(dd));
			document.getElementById('noptqtys_'+[pchno]).value=(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
			document.getElementById('noptqtys_'+[pchno]).value=parseFloat(document.getElementById('noptqtys_'+[pchno]).value).toFixed(3);
		}
		else
		{
			document.getElementById('noptpchs_'+[pchno]).value=parseInt(pchval);
			document.getElementById('noptqtys_'+[pchno]).value=parseFloat(npwt)*parseFloat(pchval);
			document.getElementById('noptqtys_'+[pchno]).value=(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
			document.getElementById('noptqtys_'+[pchno]).value=parseFloat(document.getElementById('noptqtys_'+[pchno]).value).toFixed(3);
		}
		//alert(d);
		//alert(dd);
		//alert(npwt);
		//alert(document.getElementById('noptpchs_'+[pchno]).value);
		//alert(document.getElementById('noptqtys_'+[pchno]).value);
		//alert(document.getElementById('noptqtys_'+[pchno]).value);
		document.frmaddDepartment.linkpch.value=parseInt(document.frmaddDepartment.linkpch.value)+parseInt(pchval);
		
		document.frmaddDepartment.bpch.value=parseInt(document.frmaddDepartment.extbpch.value)-parseInt(document.frmaddDepartment.linkpch.value);
		//if(parseInt(document.frmaddDepartment.linkpch.value) > parseInt(document.frmaddDepartment.extbpch.value))document.frmaddDepartment.linkpch.value=0;
	}
}

function qtychk1(qtyval1,srno)
{
		var sbin="txtbalnobp"+srno;
		var nob="txtextnob"+srno;
	if(document.frmaddDepartment.ptptype.value=="")
	{
		alert("Please Select Entire/Partial to Re-Printing");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}	
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("NoP entered for Re-Printing can be Equal to or Less than Existing NoP in Bin");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		var exqty="txtextqty"+srno;
		var exnob="txtextnob"+srno;
		var bnob="txtbalnobp"+srno;
		var bqty="txtbalqtyp"+srno;
		var nob="recnobp"+srno;
		var qty="recqtyp"+srno;
		
		document.getElementById(bnob).value=parseInt(document.getElementById(exnob).value)-parseInt(document.getElementById(nob).value);
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(parseFloat(ups[0])/1000);
		}
		else
		{
			pt=ups[0];
		}
		document.getElementById(qty).value=((parseFloat(document.getElementById(nob).value)*parseFloat(pt))*100)/100;
		document.getElementById(qty).value=parseFloat(document.getElementById(qty).value).toFixed(3);
		document.getElementById(bqty).value=(parseFloat(document.getElementById(exqty).value)-parseFloat(document.getElementById(qty).value));
	}
}

function Bagschk1(qtyval1,srno)
{
	var actnob="txtbalnobp"+srno;
	var sbin="txtbalqtyp"+srno;
	var nob="txtextqty"+srno;
	/*if(document.getElementById(actnob).value=="")
	{
		alert("Please enter NoP");
		var actqty="recqtyp"+srno;
		document.getElementById(actqty).value="";
		return false;
	}
	else */
	if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("Qty entered for Re-Printing can be Equal to or Less than Existing Qty in Bin");
		var actnob="recqtyp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		
		var exqty="txtextqty"+srno;
		var exnob="txtextnob"+srno;
		var bnob="txtbalnobp"+srno;
		var bqty="txtbalqtyp"+srno;
		var nob="recnobp"+srno;
		var qty="recqtyp"+srno;
		document.getElementById(bqty).value=(parseFloat(document.getElementById(exqty).value)-parseFloat(document.getElementById(qty).value));
		
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(1000/parseFloat(ups[0]));
			document.getElementById(nob).value=parseFloat(qtyval1)*parseInt(pt);
		}
		else
		{
			pt=ups[0];
			document.getElementById(nob).value=parseFloat(qtyval1)/parseInt(pt);
		}
		document.getElementById(bnob).value=parseInt(document.getElementById(exnob).value)-parseInt(document.getElementById(nob).value);
		var nps=document.getElementById(nob).value.split(".");
		if(parseFloat(nps[1]) > 0)
		{
			alert("Check Qty. entered. Quantity entered is not convertible into whole number of pouches, as per given UPS.");
			document.getElementById(nob).value="";
			document.getElementById(qty).value="";
			document.getElementById(bnob).value="";
			document.getElementById(bqty).value="";
			document.getElementById(qty).focus();
		}
	}
}

function chktotnop()
{
	var nop=0;
	for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var nob="recnobp"+i;
		if(document.getElementById(nob).value!="")
		{
			nop=parseInt(nop)+parseInt(document.getElementById(nob).value);
		}
	}
	if(parseInt(document.frmaddDepartment.txtenop.value)!=parseInt(nop))
	{
		alert("Nop Picked for Re-Printing not matching with Total NoP picked from Existing bins");
		document.frmaddDepartment.txtpsrno.value="";
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
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Pack Seed Re-Printing</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_revalidate where plantcode='$plantcode' and rv_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['rv_id'];

	$tdate=$row_tbl['rv_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['rv_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['rv_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);
	
?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="sstage" value="Pack" />
	<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
	<input type="hidden" name="date" value="<?php echo date("d-m-Y")?>" />
	<input type="hidden" name="tcode" value="<?php echo $code;?>" />
	<input type="hidden" name="maintrid" value="<?php echo $tid?>" />
	<input type="hidden" name="txtsrtyp" value="" />
	</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Re-Printing</td>
</tr>

 <tr class="Dark" height="30">
<td width="213" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="267"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "RV".$row_tbl['rv_code']."/".$row_tbl['rv_yearcode']."/".$row_tbl['rv_logid'];?></td>

<td width="229" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="251" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td width="213" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['cropname'];?><input type="hidden" name="crop" value="<?php echo $row_tbl['rv_crop'];?>" /></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" name="variety" value="<?php echo $row_tbl['rv_variety'];?>" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_lotno'];?><input type="hidden" name="lotno" value="<?php echo $row_tbl['rv_lotno'];?>" /></td>
<td width="229" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="251" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['rv_ups'];?><input type="hidden" name="upssize" value="<?php echo $row_tbl['rv_ups'];?>" /></td>
</tr>
<?php

$nop=$row_tbl['rv_enop'];
$nomp=$row_tbl['rv_enomp'];
$qty=$row_tbl['rv_eqty'];
$qc=$row_tbl['rv_qc'];
$got=$row_tbl['rv_got'];
$lotno=$row_tbl['rv_lotno'];

$dot="";
if($row_tbl['rv_dot']!="" && $row_tbl['rv_dot']!="0000-00-00")
{
$dt=explode("-",$row_tbl['rv_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where lotno='".$lotno."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
	
if($dot=="" && ($qc=="OK" || $qc=="Fail"))
{
	$dt=explode("-",$row_issuetbl['lotldg_qctestdate']);
	$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
	
$dgt=explode("-",$row_tbl['rv_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];
if($dot=="00-00-0000" || $dot=="--" || $dot=="- -")$dot="";
if($dogt=="00-00-0000" || $dogt=="--" || $dogt=="- -")$dogt="";

if($dot!="")
{
	$trdate2=explode("-",$dot);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	/*if($ode>1)
	{
		$de=$ode-1;
	}
	else
	{
		$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
		$trdate2=explode("-",$trdt3);
		$m=$trdate2[1];
		$de=$trdate2[2];
		$y=$trdate2[0];*/
	//}
	$de=$de-1;
	$dt=3;
	if($dt!="" && $dt==3)
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];	} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="" && $dt==6)
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="" && $dt==9)
	{	
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}


$zzz=implode(",", str_split($lotno));
$abc=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];

$baselot=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
$baselot1=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26]."00";
//echo $xxcc="select * from tbl_lot_ldg_pack WHERE SUBSTRING(orlot, 15, 2 ) != '00' and SUBSTRING( orlot, 1, 13 ) = '$baselot'";

//echo $a; DF01269/00000/00
$sql_month=mysqli_query($link,"SELECT max(SUBSTRING(lotldg_lotno,15,2)) FROM tbl_lot_ldg where plantcode='$plantcode' and SUBSTRING(lotldg_lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);

$sql_month23=mysqli_query($link,"SELECT max(SUBSTRING(lotno,15,2)) FROM tbl_lot_ldg_pack where plantcode='$plantcode' and SUBSTRING(lotno,1,13)='$abc'")or die("Error:".mysqli_error($link));
$row_month23=mysqli_fetch_array($sql_month23);

$abc2=0;
if($row_month[0]>$row_month23[0])
$abc2=$row_month[0];
else if($row_month[0]<$row_month23[0])
$abc2=$row_month23[0];
else
$abc2=$row_month[0];
//echo $abc2;
$tflg=0;
$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['rv_crop']."' and lotldg_variety='".$row_tbl['rv_variety']."' and packtype='".$row_tbl['rv_ups']."' and lotno='".$lotno."' and trtype='Qty-Rem'") or die(mysqli_error($link)); 
$tot_istbl=mysqli_num_rows($sql_istbl);

$sql_istbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['rv_crop']."' and lotldg_variety='".$row_tbl['rv_variety']."' and packtype='".$row_tbl['rv_ups']."' and lotno='".$lotno."' and trtype='Dispatch'") or die(mysqli_error($link)); 
$tot_istbl2=mysqli_num_rows($sql_istbl2);

if($tot_istbl > 0 || $tot_istbl2 > 0)$tflg++;

$tflg++;
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."P";
if($tflg>0)
$abc23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."P";
else
$abc23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."P";
if($nomp > 0)$tflg++;

if($nop==1)$tflg++;

?>
<tr class="Light" height="30" >
<td align="right" width="213"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="267" valign="middle" class="tbltext">&nbsp;<?php echo $nop;?><input type="hidden" name="enop" value="<?php echo $nop;?>" /></td>	
<td align="right" width="229" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="251" valign="middle" class="tbltext">&nbsp;<?php echo $qty;?><input type="hidden" name="eqty" value="<?php echo $qty;?>" /></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $qc;?><input type="hidden" name="qcsts" value="<?php echo $qc;?>" /></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dot;?><input type="hidden" name="dot" value="<?php echo $dot;?>" /><input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $got;?><input type="hidden" name="got" value="<?php echo $got;?>" /></td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dogt;?><input type="hidden" name="dogt" value="<?php echo $dogt;?>" /></td>
<input type="hidden" name="orlot" value="<?php echo $row_tbl['rv_lotno'];?>" />
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 

<tr class="Light" height="30">
<td align="right" width="105"  valign="middle" class="tblheading">Re-Printing&nbsp;</td>
<td align="left" width="191" valign="middle" class="tblheading"   >&nbsp;<input type="radio" name="ptptyp" class="tbltext" value="entire" onclick="chklot(this.value);"  />Entire&nbsp;&nbsp;<input type="radio" name="ptptyp" class="tbltext" value="partial" onclick="chklot(this.value);"    />Partial&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="ptptype" value="" /></td>
<td align="left"  valign="middle" class="tblheading" colspan="2" id="batchchk">&nbsp;<?php if($tflg>0) echo "Batch No. Generated - <font color=red>YES</font>"; else echo ""; ?></td>
<td align="right" width="113"  valign="middle" class="tblheading">Lot number&nbsp;</td>
<td align="left" width="221"  valign="middle" class="tblheading">&nbsp;<input name="txtnewlot" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" value="<?php if($tflg>0) echo $abc23; else echo "";?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="105"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext">&nbsp;<input name="txtenop" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $nop;?>" style="background-color:#CCCCCC" readonly="true" onkeypress="return isNumberKey(event)" onchange="chknop(this.value);" /></td>	
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right" width="113" valign="middle" class="tblheading">Balance NoP&nbsp;</td>
<td align="left" width="221" valign="middle" class="tbltext">&nbsp;<input name="bnop" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="0" style="background-color:#CCCCCC" readonly="true" onkeypress="return isNumberKey(event)" /></td>	
</tr>
<tr class="Light" height="30" >
<td align="right" width="105"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext">&nbsp;<input name="txteqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $qty;?>" style="background-color:#CCCCCC" readonly="true" onkeypress="return isNumberKey1(event)" onchange="chkqty(this.value);" /></td>	
<td align="left"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right" width="113" valign="middle" class="tblheading">Balance Qty&nbsp;</td>
<td align="left" width="221" valign="middle" class="tbltext">&nbsp;<input name="bqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="0" style="background-color:#CCCCCC" readonly="true" onkeypress="return isNumberKey1(event)" /></td>	
</tr>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
<input type="hidden" name="lotnmo" value="<?php echo $abc23; ?>" /><input type="hidden" name="lotnmb" value="<?php echo $abc24; ?>" />
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Re-Printing</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Re-Printing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoP</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoP</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoP</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0; 
//echo "select distinct whid, subbinid, binid from tbl_lot_ldg_pack where lotno='".$lotno."' ";
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."' ") or die(mysqli_error($link));
//echo $tottttt=mysqli_num_rows($sql_issue);
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++;

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
	if($packtp[0]<1)
	{
		$ptp=(1000/$packtp[0])/1000;
		$ptp1=($packtp[0]/1000)*1000;
	}
	else
	{
		$ptp=$packtp[0];
		$ptp1=$packtp[0];
	}
	//$ptp=$packtp[0];
	//$ptp1=$packtp[0];
}
if($row_issuetbl['balnomp']>0)
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
else
$penqty=$row_issuetbl['balqty'];
//echo $packtp[0];
if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp*$penqty);
	}
	else
	{
	if($packtp[0]<1)
		$nop1=($penqty*$ptp);
	else
		$nop1=($penqty/$ptp);
	}	
	//$nop1=($ptp*$penqty);
}
//echo $nop1;
$nop=$nop1; 
//$nomp=$nomp+$row_issuetbl['balnomp'];
$qty=$row_issuetbl['balqty'];

$tqty=$qty;
$tnob=$nop; 
$totqty=$totqty+$tqty; 
$totnob=$totnob+$tnob; 


$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;

$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;
?>
  <tr class="Light" height="30">
    <td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg_<?php echo $srno2?>" id="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['whid'];?>" /><input type="hidden" name="extslbing_<?php echo $srno2?>" id="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['binid'];?>" /><input type="hidden" name="extslsubbg_<?php echo $srno2?>" id="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['subbinid'];?>" /></td>

    <td width="97"  align="center" valign="middle" class="smalltbltext"><?php echo $tnob;?><input name="txtextnob_<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty_<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="recnobp_<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)"  style="background-color:#CCCCCC"  readonly="true"  onchange="qtychk1(this.value,<?php echo $srno2?>);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="recqtyp_<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  style="background-color:#CCCCCC"  readonly="true" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey1(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalnobp_<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="text" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true"  /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtbalqtyp_<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="text" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" /></td>
  </tr>
 <?php
  }
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Re-Printing Details</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Re-Printing/Packing Slip Ref. No.&nbsp;</td>
<td align="left" valign="middle" class="tblheading" colspan="2">&nbsp;<input type="text" name="txtpsrno" id="txtpsrtno" class="smalltbltext" value="" size="15" onchange="chktotnop();"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td align="right" valign="middle" class="tblheading" colspan="2">Date of Re-Printing/Packing&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading" id="pltno">&nbsp;<input name="dcdate" id="dcdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;<font color="#FF0000" >* </font>&nbsp;<script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> </td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">NoP - QC Sample&nbsp;</td>
<td align="left" valign="middle" class="tblheading" colspan="2">&nbsp;<input type="text" name="txtnopqc" id="txtnopqc" class="smalltbltext" value="0" size="2" onchange="psrnchk(this.value);" onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td align="right" valign="middle" class="tblheading" colspan="2">NoP - Re-Printing Packing Loss&nbsp;</td>
<td align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="txtnoppl" id="txtnoppl" class="smalltbltext" value="0" size="2" onchange="psrnchk1(this.value);" onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Balance Pouches&nbsp;</td>
<td align="left" valign="middle" class="tblheading" colspan="2">&nbsp;<input type="text" name="txtbnop" id="txtbnop" class="smalltbltext" value="<?php echo $nop;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="right" valign="middle" class="tblheading" colspan="2">Balance Quantity&nbsp;</td>
<td align="left" valign="middle" class="tblheading" id="pltno">&nbsp;<input type="text" name="txtbqty" id="txtbqty" class="smalltbltext" value="<?php echo $qty;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="Light" height="25">
<td width="191" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="147" align="left" valign="middle" class="tblheading">&nbsp;<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="9" >9</option>
<option value="6" >6</option>
<option value="3" >3</option>
</select>&nbsp;Months&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="87" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="112" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" class="tbltext" name="validityupto" id="validityupto" value="" size="12" readonly="true" style="background-color:#ECECEC"  /></td>
<td width="151" align="right" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;Days From DoT</td>
</tr>
<tr class="Light" height="25">  
<td align="right" valign="middle" class="tblheading">Label No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="5"><?php $quer3=mysqli_query($link,"SELECT dom_mcode FROM tbl_rm_dommac where plantcode='$plantcode' order by dom_mcode Asc"); $sno=1; ?>&nbsp;<select class="smalltbltext" name="domcs_1" id="domcs_1" style="width:40px;" onchange="domcchk(this.value, '1')"> <option value="" selected>Select</option> <?php while($noticia = mysqli_fetch_array($quer3)) { ?> <option value="<?php echo $noticia['dom_mcode'];?>" /><?php echo $noticia['dom_mcode'];?><?php } ?></select>&nbsp;<font color="#FF0000" >* </font>&nbsp;<input type="text" name="lbls_1" id="lbls_1" size="5" maxlength="7" class="tbltext" value="" onkeypress="return isNumberKey(event)" onchange="domchk('1');"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;&nbsp;<input type="text" name="domce_1" id="domce_1" class="tbltext" size="1" maxlength="1" readonly="true" style="background-color:#CCCCCC" value="" />&nbsp;<input type="text" name="lble_1" id="lble_1" size="5"  maxlength="7" class="tbltext" value=""  onkeypress="return isNumberKey(event)" onchange="domchk1(this.value, '1')" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

</tr>
<!--<tr class="Light" height="25">
<td width="103" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="154" align="left" valign="middle" class="tbltext"></td>
<td width="81" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="368" align="left" valign="middle" class="tbltext"> &nbsp;&nbsp;<b>Validity Days</b> </td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Partial</td>
</tr>-->
<input type="hidden" name="pcktype" id="pcktype" value="" />
</table><br />
<div id="pkgshow">
<?php 
$sno=1;  //echo $row_tbl['rv_variety'];
$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_tbl['rv_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$sno=0; $srnonew=0; $wtmp=0; $mptnop=0; $wtnopkg=0;
//echo $rowvariety['wtmp'];
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
$p1=array($p1_array2);
//print_r($p1_array);
foreach($p1_array as $val1)
{
	if($val1<>"")
	{
		$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
		$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
		$row12=mysqli_fetch_array($res);
		$upsid=$row12['ups']." ".$row12['wt'];
		//echo $row12['ups']; echo "  -  ";
		//echo $row12['wt']; echo "<br/>";
		if($upsid==$row_tbl['rv_ups'])
		{
			$wtmp=$p1_array2[$srnonew];
			$mptnop=$p1_array3[$srnonew];
			$wtnopkg=$row12['uom'];
		}
	}
	$srnonew++;
}
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="8">Packaging Details</td>
</tr>

<tr class="Light">
<td width="116" align="right" valign="middle" class="tblheading">Convert to MP&nbsp;</td>
<td width="144" align="left" valign="middle" class="tbltext"><input type="radio" name="pckgtyp" id="pckgtyp" value="Yes" onclick="pcksel(this.value);" />&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="pckgtyp" id="pckgtyp" value="No" onclick="pcksel(this.value);" />&nbsp;No<input type="hidden" name="pkgtype" value="" /></td>
<td width="76" align="center" valign="middle" class="tblheading">No. of MP</td>

<td width="83" align="center" valign="middle" class="tbltext"><input type="text" name="nomp_1" id="nomp_1" size="7" maxlength="7" class="tbltext" value=""  readonly="true" style="background-color:#CCCCCC" onchange="balnopcheck(this.value, 1)"/><input type="hidden" name="wtmp_1" id="wtmp_1" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_1" id="wtnop_1" value="<?php echo $mptnop?>" /><input type="hidden" name="wtnopkg_1" id="wtnopkg_1" value="<?php echo $wtnopkg;?>" /> <input type="hidden" name="upsname_1" id="upsname_1" value="<?php echo $row_tbl['rv_ups'];?>" /></td>
<td width="140" align="center" valign="middle" class="tblheading">Balance Pouches</td>

<td width="82" align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_1" id="noofpacks_1" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_1" id="nowb_1" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="130" align="center" valign="middle" class="tblheading">Barcode Labels</td>
<td width="61" align="center" valign="middle" class="tbltext" id="dtail_1">Fill</td>
</tr>
</table>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="" /><input type="hidden" name="nopks" value="" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="" />
</div><br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="11">SLOC Details</td>
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
<tr class="light" height="25">
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg1" name="txtwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><select class="smalltbltext" name="txtbing1" id="txtbing1" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><select class="smalltbltext" name="txtsubbg1" id="txtsubbg1" style="width:60px;" onchange="subbin(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocr1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview1" id="existview1" class="tbltext" value="" /><input type="hidden" name="trflg1" id="trflg1" value="" /><input type="hidden" name="tpflg1" id="tpflg1" value="" /><input type="hidden" name="tflg1" id="tflg1" value="" /><input type="hidden" name="tpmflg1" id="tpmflg1" value="" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_1" id="nopmpcs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_1" id="noppchs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_1" id="noptpchs_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_1" id="noptqtys_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg2" name="txtwhg2" style="width:70px;" onchange="wh(this.value,2);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd2 = mysqli_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn2"><select class="smalltbltext" name="txtbing2" id="txtbing2" style="width:60px;" onchange="bin(this.value,2);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn2"><select class="smalltbltext" name="txtsubbg2" id="txtsubbg2" style="width:60px;" onchange="subbin(this.value,2);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr2">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview2" id="existview2" class="tbltext" value="" /><input type="hidden" name="trflg2" id="trflg2" value="" /><input type="hidden" name="tpflg2" id="tpflg2" value="" /><input type="hidden" name="tflg2" id="tflg2" value="" /><input type="hidden" name="tpmflg2" id="tpmflg2" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg3" name="txtwhg3" style="width:70px;" onchange="wh(this.value,3);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd3 = mysqli_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn3"><select class="smalltbltext" name="txtbing3" id="txtbing3" style="width:60px;" onchange="bin(this.value,3);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn3"><select class="smalltbltext" name="txtsubbg3" id="txtsubbg3" style="width:60px;" onchange="subbin(this.value,3);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr3">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /><input type="hidden" name="trflg3" id="trflg3" value="" /><input type="hidden" name="tpflg3" id="tpflg3" value="" /><input type="hidden" name="tflg3" id="tflg3" value="" /><input type="hidden" name="tpmflg3" id="tpmflg3" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg4" name="txtwhg4" style="width:70px;" onchange="wh(this.value,4);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd4 = mysqli_fetch_array($whd4_query)) { ?>
		<option value="<?php echo $noticia_whd4['whid'];?>" />   
		<?php echo $noticia_whd4['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn4"><select class="smalltbltext" name="txtbing4" id="txtbing4" style="width:60px;" onchange="bin(this.value,4);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn4"><select class="smalltbltext" name="txtsubbg4" id="txtsubbg4" style="width:60px;" onchange="subbin(this.value,4);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr4">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /><input type="hidden" name="trflg4" id="trflg4" value="" /><input type="hidden" name="tpflg4" id="tpflg4" value="" /><input type="hidden" name="tflg4" id="tflg4" value="" /><input type="hidden" name="tpmflg4" id="tpmflg4" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg5" name="txtwhg5" style="width:70px;" onchange="wh(this.value,5);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd5 = mysqli_fetch_array($whd5_query)) { ?>
		<option value="<?php echo $noticia_whd5['whid'];?>" />   
		<?php echo $noticia_whd5['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn5"><select class="smalltbltext" name="txtbing5" id="txtbing5" style="width:60px;" onchange="bin(this.value,5);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn5"><select class="smalltbltext" name="txtsubbg5" id="txtsubbg5" style="width:60px;" onchange="subbin(this.value,5);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr5">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /><input type="hidden" name="trflg5" id="trflg5" value="" /><input type="hidden" name="tpflg5" id="tpflg5" value="" /><input type="hidden" name="tflg5" id="tflg5" value="" /><input type="hidden" name="tpmflg5" id="tpmflg5" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg6" name="txtwhg6" style="width:70px;" onchange="wh(this.value,6);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd6 = mysqli_fetch_array($whd6_query)) { ?>
		<option value="<?php echo $noticia_whd6['whid'];?>" />   
		<?php echo $noticia_whd6['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn6"><select class="smalltbltext" name="txtbing6" id="txtbing6" style="width:60px;" onchange="bin(this.value,6);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn6"><select class="smalltbltext" name="txtsubbg6" id="txtsubbg6" style="width:60px;" onchange="subbin(this.value,6);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr6">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /><input type="hidden" name="trflg6" id="trflg6" value="" /><input type="hidden" name="tpflg6" id="tpflg6" value="" /><input type="hidden" name="tflg6" id="tflg6" value="" /><input type="hidden" name="tpmflg6" id="tpmflg6" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg7" name="txtwhg7" style="width:70px;" onchange="wh(this.value,7);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd7 = mysqli_fetch_array($whd7_query)) { ?>
		<option value="<?php echo $noticia_whd7['whid'];?>" />   
		<?php echo $noticia_whd7['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn7"><select class="smalltbltext" name="txtbing7" id="txtbing7" style="width:60px;" onchange="bin(this.value,7);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn7"><select class="smalltbltext" name="txtsubbg7" id="txtsubbg7" style="width:60px;" onchange="subbin(this.value,7);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr7">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /><input type="hidden" name="trflg7" id="trflg7" value="" /><input type="hidden" name="tpflg7" id="tpflg7" value="" /><input type="hidden" name="tflg7" id="tflg7" value="" /><input type="hidden" name="tpmflg7" id="tpmflg7" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg8" name="txtwhg8" style="width:70px;" onchange="wh(this.value,8);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd8 = mysqli_fetch_array($whd8_query)) { ?>
		<option value="<?php echo $noticia_whd8['whid'];?>" />   
		<?php echo $noticia_whd8['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="bingn8"><select class="smalltbltext" name="txtbing8" id="txtbing8" style="width:60px;" onchange="bin(this.value,8);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td align="center"  valign="middle" class="smalltbltext" id="sbingn8"><select class="smalltbltext" name="txtsubbg8" id="txtsubbg8" style="width:60px;" onchange="subbin(this.value,8);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td valign="middle">
<div id="slocr8">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
<tr>
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /><input type="hidden" name="trflg8" id="trflg8" value="" /><input type="hidden" name="tpflg8" id="tpflg8" value="" /><input type="hidden" name="tflg8" id="tflg8" value="" /><input type="hidden" name="tpmflg8" id="tpmflg8" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<input type="hidden" name="sno3" value="8" /><input type="hidden" name="slocseldet" value="" />
</table>
<div id="balps" align="right" style="padding-right:32px;">
<table align="right" border="1" width="380" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td width="196" align="center" valign="middle" class="tblheading">Pouches as per Transaction</td>
<td width="79" align="center" valign="middle" class="tblheading">Linked</td>
<td width="97" align="center" valign="middle" class="tblheading">Balance</td>
</tr>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><input type="text" class="smalltblheading" size="7" name="extbpch" value="<?php echo $bpch?>" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" class="smalltblheading" size="7" name="linkpch" value="0" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" class="smalltblheading" size="7" name="bpch" value="<?php echo $bpch?>" readonly="true" style="background-color:#CCCCCC; color:#FF0000" /></td>
</tr>
</table>

</div>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_revalidate.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="verflg" value="<?php echo $verflg;?>" /></td>
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

  
