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
	
	$maintrid=trim($_REQUEST['maintrid']);
	
	if(isset($_REQUEST['frm_action'])=='submit')
	{
		$p_id=trim($_REQUEST['maintrid']);
		$btntypval=trim($_REQUEST['btntypval']);
		//frm_action=submit&txtid=&date=10-10-2024&dopc=10-10-2024&txtpsrn=test&txtcrop=24&txtvariety=468&txtstage=2111&txtpromech=7&txtoprname=4&txtlot1=DL10251%2F00000%2F00R&maintrid=48157&subtrid=52305&protype=&softstatus=&txtonob=5&txtoqty=166.36&qcstatus=OK&qcdot1=20-09-2024&qcdot2=&qctestdate=20-09-2024&dp1=19-12-2024&dp2=19-03-2025&dp3=19-06-2025&dp4=&dp5=&dp6=&qcdttype=DoT&txtclotno=DL10251%2F00000%2F00C&protype=&extslwhg1=14&extslbing1=530&extslsubbg1=10594&txtextnob1=5&txtextqty1=166.360&recnobp1=5&recqtyp1=166.360&txtbalnobp1=0&txtbalqtyp1=0.000&srno2=1&validityperiod=9&validityupto=19-06-2025&valdays=252&paceptyp=E&txtplotno=DL10251%2F00000%2F00P&pcktype=E&avlnobpck=5&avlqtypck=166.360&picqtyp=166.360&pckloss=0&ccloss=0&balpck=166.36&balcnob=0&balcqty=0&fet=9&wtnopkg_1=1.000&upsname_1=1.000%20Kgs&nopc_1=166&mpck_1=Yes&nomp_1=5&wtmp_1=30&wtnop_1=30&nowb_1=&wtnopkg_2=3.000&upsname_2=3.000%20Kgs&nomp_2=&wtmp_2=30&wtnop_2=10&nowb_2=&sno=2&detmpbno=&upsidno=9&upssize=1&nopks=16&singlebar=&rangebar=&mobar=&extbpch=16&linkpch=0&bpch=16&txtremarks=testetetetst&btntypval=0
		
		
		$dt=date("Y-m-d");
		if(isset($_REQUEST['dopc'])) { $dopc = $_REQUEST['dopc']; }
		if(isset($_REQUEST['txtpsrn'])) { $txtpsrn= $_REQUEST['txtpsrn']; }
		if(isset($_REQUEST['txtpromech'])) { $txtpromech = $_REQUEST['txtpromech']; }
		if(isset($_REQUEST['txtoprname'])) { $txtoprname= $_REQUEST['txtoprname']; }
		if(isset($_REQUEST['txttreattyp'])) { $txttreattyp = $_REQUEST['txttreattyp']; }
		
		if(isset($_REQUEST['softstatus'])) { $softstatus = $_REQUEST['softstatus']; }
		
		if(isset($_REQUEST['txtclotno'])) { $txtclotno = $_REQUEST['txtclotno']; }
		if(isset($_REQUEST['txtplotno'])) { $txtplotno = $_REQUEST['txtplotno']; }
		
		if(isset($_REQUEST['srno2'])) { $srno2 = $_REQUEST['srno2']; }
		
		
		if(isset($_REQUEST['paceptyp'])) { $paceptyp= $_REQUEST['paceptyp']; }
		if(isset($_REQUEST['pcktype'])) { $pcktype= $_REQUEST['pcktype']; }
		if(isset($_REQUEST['avlnobpck'])) { $avlnobpck= $_REQUEST['avlnobpck']; }
		if(isset($_REQUEST['avlqtypck'])) { $avlqtypck= $_REQUEST['avlqtypck']; }
		if(isset($_REQUEST['picqtyp'])) { $picqtyp= $_REQUEST['picqtyp']; }
		if(isset($_REQUEST['pckloss'])) { $pckloss= $_REQUEST['pckloss']; }
		if(isset($_REQUEST['ccloss'])) { $ccloss= $_REQUEST['ccloss']; }
		if(isset($_REQUEST['balpck'])) { $balpck= $_REQUEST['balpck']; }
		if(isset($_REQUEST['balcnob'])) { $balcnob= $_REQUEST['balcnob']; }
		if(isset($_REQUEST['balcqty'])) { $balcqty= $_REQUEST['balcqty']; }
		if(isset($_REQUEST['qcstatus'])) { $qcstatus= $_REQUEST['qcstatus']; }
		if(isset($_REQUEST['qctestdate'])) { $qctestdate= $_REQUEST['qctestdate']; }
		if(isset($_REQUEST['validityperiod'])) { $validityperiod= $_REQUEST['validityperiod']; }
		if(isset($_REQUEST['validityupto'])) { $validityupto= $_REQUEST['validityupto']; }
		if(isset($_REQUEST['qcdttype'])) { $qcdttype= $_REQUEST['qcdttype']; }
		
		if(isset($_REQUEST['fet'])) { $fet= $_REQUEST['fet']; }
		if(isset($_REQUEST['upsidno'])) { $upsidno= $_REQUEST['upsidno']; }
		if(isset($_REQUEST['upssize'])) { $upssize= $_REQUEST['upssize']; }
		if(isset($_REQUEST['sno'])) { $sno= $_REQUEST['sno']; }
		if(isset($_REQUEST['nopks'])) { $nopks= $_REQUEST['nopks']; }
		if(isset($_REQUEST['sno3'])) { $sno3= $_REQUEST['sno3']; }
		
		if(isset($_REQUEST['mrpups'])) { $mrpups= $_REQUEST['mrpups']; }
		if(isset($_REQUEST['mrpgms'])) { $mrpgms= $_REQUEST['mrpgms']; }
		
		if(isset($_REQUEST['upswisepackqty'])) { $upswisepackqty= $_REQUEST['upswisepackqty']; }
		if(isset($_REQUEST['upswisemaxnomp'])) { $upswisemaxnomp= $_REQUEST['upswisemaxnomp']; }
		
		
		for ($i=1; $i<=$sno; $i++)
		{
			if($upssize==$i)
			{
				$wtnopkgx="wtnopkg_".$i;
				if(isset($_REQUEST[$wtnopkgx])) {  $wtnopkg=$_REQUEST[$wtnopkgx];}// echo " = 1<br />";}
			 	$packqtyx="packqty_".$i;
				if(isset($_REQUEST[$packqtyx])) {  $packqty=$_REQUEST[$packqtyx]; }// echo " = 2<br />";} else  { echo $packqty=$_REQUEST[$packqtyx];  echo " = 2x<br />";}
				$nopcx="nopc_".$i;
				if(isset($_REQUEST[$nopcx])) {  $nopc=$_REQUEST[$nopcx]; }// echo " = 3<br />";}
				
				$mpckx="mpck_".$i;
				if(isset($_REQUEST[$mpckx])) {  $mpck=$_REQUEST[$mpckx]; }// echo " = 4<br />";}
				$nompx="nomp_".$i;
				if(isset($_REQUEST[$nompx])) {  $nomp=$_REQUEST[$nompx]; }// echo " = 5<br />";}
				$wtmpx="wtmp_".$i;
				if(isset($_REQUEST[$wtmpx])) {  $wtmp=$_REQUEST[$wtmpx]; }// echo " = 6<br />";}
				$wtnopx="wtnop_".$i;
				if(isset($_REQUEST[$wtnopx])) {  $wtnop=$_REQUEST[$wtnopx]; }// echo " = 7<br />";}
				$nowbx="nowb_".$i;
				if(isset($_REQUEST[$nowbx])) {  $nowb=$_REQUEST[$nowbx]; }// echo " = 8<br />";}
				$noofpacksx="noofpacks_".$i;
				if(isset($_REQUEST[$noofpacksx])) {  $noofpcks=$_REQUEST[$noofpacksx]; }// echo " = 9<br />";}
				
				$upsnamex="upsname_".$i;
				if(isset($_REQUEST[$upsnamex])) {  $upsname=$_REQUEST[$upsnamex]; }// echo " = 10<br />";}
			}
		}	
		
		$noofpcks=$nopks;
		
		
		if(isset($_REQUEST['txtremarks'])) { $txtremarks= $_REQUEST['txtremarks']; }
			
		if(isset($_REQUEST['maintrid'])) { $maintrid= $_REQUEST['maintrid']; }
		if(isset($_REQUEST['subtrid'])) { $subtrid= $_REQUEST['subtrid']; }
		
		
		
		
		$ttype="Online Processing and Packing Slip";	
		
		$zz=str_split($txtplotno);
		$orlot=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
			
		$z1=$maintrid;
			
		
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
		
		if($btntypval==0)
		{
 			$sql_main="Update tbl_pnpslipmain SET  pnpslipmain_indentsrn='$txtpsrn', pnpslipmain_doindent='$tdate2', pnpslipsetup_date='$dt', pnpslipmain_promachcode='$txtpromech', pnpslipmain_proopr='$txtoprname', pnpslipmain_macopr='$txtoprname' where pnpslipmain_id='$p_id'";
			mysqli_query($link,$sql_main) or die(mysqli_error($link));
			
 			$sql_sub="Update tbl_pnpslipsub SET pnpslipsub_packtype='$pcktype', pnpslipsub_availpnob='$avlnobpck', pnpslipsub_availpqty='$avlqtypck', pnpslipsub_pickpqty='$picqtyp', pnpslipsub_packloss='$pckloss', pnpslipsub_packcc='$ccloss', pnpslipsub_packqty='$balpck', pnpslipsub_balcnob='$balcnob', pnpslipsub_balcqty='$balcqty', pnpslipsub_ups='$upss', pnpslipsub_upsid='$upsidno', pnpslipsub_qty='$upswisepackqty', pnpslipsub_nop='$nopc', pnpslipsub_convtomp='$mpck', pnpslipsub_nomp='$upswisemaxnomp', pnpslipsub_balpouch='$noofpcks', pnpslipsub_packremarks='$txtremarks' , pnpslipsub_orlot='$orlot', pnpslipsub_valperiod='$validityperiod', pnpslipsub_valupto='$tdate3', pnpslipsub_qc='$qcstatus', pnpslipsub_qcdot='$tdate4', pnpslipsub_qcdttype='$qcdttype', pnpslipsub_plotno='$txtplotno', pnpslipsub_wtmp='$wtmp', pnpslipsub_mptnop='$wtnop', plantcode='$plantcode',  pnpslipsub_sstatus='$softstatus', pnpslipsub_upsmrp='$mrpups', pnpslipsub_gmsmrp='$mrpgms', pnpslipsub_pouchmrp='$mrpups', pnpslipsub_gmmrp='$mrpgms' where pnpslipmain_id='$p_id'";
			mysqli_query($link,$sql_sub) or die(mysqli_error($link));
		
			//exit;
		
			echo "<script>window.location='add_pronpslip_preview_fc.php?p_id=$maintrid'</script>";	
		}
		else
		{	
			exit;																																																																																																																																																																																																																																																																																						
			if($p_id>0)
			{
				$s_sub="UPDATE tbl_pnpslipmain SET pnpslipmain_tflag=2 where logid='".$logid."' and pnpslipmain_id='$p_id'";
				mysqli_query($link,$s_sub) or die(mysqli_error($link));	
			}
			echo "<script>window.location='home_pronpslip_fc.php'</script>";
		}
	}

	/*$sql_code="SELECT MAX(pnpslipmain_code) FROM tbl_pnpslipmain where pnpslipmain_ttype='Processing and Packing Slip' and yearid='$yearid_id'  ORDER BY pnpslipmain_code DESC";
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
<title>Packaging- Transaction - Processing and Packing slip</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="pronpslip_fc.js"></script>
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
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
						//var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						//qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
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
         var charCode = (evt.which) ? evt.which : evt.keyCode
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
	else if(parseFloat(qtyval1)<=0)
	{
		alert("NoB entered for Processing can not be Zero");
		var actnob="recnobp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}	
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("NoB entered for Processing can be Equal to or Less than Existing NoB in Bin");
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
	var actnob="recnobp"+srno;
	var sbin="txtbalqtyp"+srno;
	var nob="txtextqty"+srno;
	if(document.getElementById(actnob).value=="")
	{
		alert("Please enter NoB");
		var actqty="recqtyp"+srno;
		document.getElementById(actqty).value="";
		return false;
	}
	else if(parseFloat(qtyval1)>parseFloat(document.getElementById(nob).value))
	{
		alert("Qty entered for Processing can be Equal to or Less than Existing Qty in Bin");
		var actnob="recqtyp"+srno;
		document.getElementById(actnob).value="";
		return false;
	}
	else
	{
		document.getElementById(sbin).value=Math.round((parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1))*100)/100;
	}
}

function pform()
{	
	var f=0;
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(dt2 > dt1)
	{
		alert("Date of Processing and Packing cannot be more than Transaction Date.");
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
	if(document.frmaddDepartment.txtpromech.value=="")
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
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="P")
	{
		if(document.frmaddDepartment.srno2.value==2)
		{
			if(document.frmaddDepartment.recqtyp1.value=="" && document.frmaddDepartment.recqtyp2.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.recqtyp1.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
	}
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Please enter Condition Seed NoB");
		document.frmaddDepartment.txtconnob.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Please enter Condition Seed Qty");
		document.frmaddDepartment.txtconqty.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Please enter Remnant (RM)");
		document.frmaddDepartment.txtconrem.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Please enter Inert Material (IM)");
		document.frmaddDepartment.txtconim.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Please enter Processing Loss (PL)");
		document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.validityperiod.value=="")
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
	}
	if(document.frmaddDepartment.pcktype.value=="P")
	{ 	if(document.frmaddDepartment.txtslsubbg1.value=="" && document.frmaddDepartment.txtslsubbg2.value=="")
		{
			alert("Please select SLOC for Condition Seed");
			//document.frmaddDepartment.txtconpl.focus();
			f=1;
			return false;
		}
		var q1="";
		var q2="";
		var g="";
		q1=document.frmaddDepartment.txtconslqty1.value;
		q2=document.frmaddDepartment.txtconslqty2.value;
		g=document.frmaddDepartment.balcqty.value;
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in Condition Seed is not matching with Quantity distributed in Bins");
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
		var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="packqty_"+l;
			if(document.getElementById(acc).value!="")
			{ycc++;}
			else
			{ 
				if(document.getElementById('mpck_'+[l]).checked == true)
				{
					xcc++;
				} 
			}
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		
		if(f==1)
		{
			return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mform','','','','','');
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
		alert("Date of Processing and Packing cannot be more than Transaction Date.");
		f=1;
		return false;
	}
	/*if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Processing and Packing Slip number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	*/
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
	if(document.frmaddDepartment.txtpromech.value=="")
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
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please Select Entire/Partial to Process");
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="P")
	{
		if(document.frmaddDepartment.srno2.value==2)
		{
			if(document.frmaddDepartment.recqtyp1.value=="" && document.frmaddDepartment.recqtyp2.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.recqtyp1.value=="")
			{
				alert("Please enter Qty to Process");
				//document.frmaddDepartment.protype.focus();
				f=1;
				return false;
			}
		}
	}
	if(document.frmaddDepartment.txtconnob.value=="")
	{
		alert("Please enter Condition Seed NoB");
		document.frmaddDepartment.txtconnob.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Please enter Condition Seed Qty");
		document.frmaddDepartment.txtconqty.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Please enter Remnant (RM)");
		document.frmaddDepartment.txtconrem.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Please enter Inert Material (IM)");
		document.frmaddDepartment.txtconim.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtconpl.value=="")
	{
		alert("Please enter Processing Loss (PL)");
		document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.validityperiod.value=="")
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
	}
	if(document.frmaddDepartment.pcktype.value=="P")
	{ 	if(document.frmaddDepartment.txtslsubbg1.value=="" && document.frmaddDepartment.txtslsubbg2.value=="")
		{
			alert("Please select SLOC for Condition Seed");
			//document.frmaddDepartment.txtconpl.focus();
			f=1;
			return false;
		}
		var q1="";
		var q2="";
		var g="";
		q1=document.frmaddDepartment.txtconslqty1.value;
		q2=document.frmaddDepartment.txtconslqty2.value;
		g=document.frmaddDepartment.balcqty.value;
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
			alert("Please check. Quantity in Condition Seed is not matching with Quantity distributed in Bins");
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
		var zzz=document.frmaddDepartment.sno.value;
		var ycc=0; var xcc=0;
		for(var l=1; l<=zzz; l++)
		{
			var acc="packqty_"+l;
			if(document.getElementById(acc).value!="")
			{ycc++;}
			else
			{ 
				if(document.getElementById('mpck_'+[l]).checked == true)
				{
					xcc++;
				} 
			}
		}
		if(ycc==0)
		{
			alert("Please select UPS for Pack Seed");
			f=1;
			return false;
		}
		/*if(xcc > 0 && (document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0))
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
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
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
		}*/
		
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'postingtable','mformsubedt','','','','','');
		}
	}
}

function modetchk(classval)
{
	/*if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please Select Processing Slip Reference Number");
		document.frmaddDepartment.txtpsrn.focus();
		document.frmaddDepartment.txtcrop.selectedIndex=0;
		return false;
	}
	else*/
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		showUser(classval,'vitem','item','','','','','');
	}
}

function modetchk1()
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
	}
}

function openslocpop()
{
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		return false;
	}
	else if(document.frmaddDepartment.txttreattyp.value=="")
	{
		alert("Please Select Treatment Schema");
		return false;
	}
	else
	{
		document.getElementById("postingsubsubtable").innerHTML="";
		document.frmaddDepartment.txtlot1.value="";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var stage=document.frmaddDepartment.txtstage.value;
		var tid=document.frmaddDepartment.maintrid.value;
		var dop=document.frmaddDepartment.dopc.value;
		//alert(variety);
		winHandle=window.open('getuser_pronpslip_lotno.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid+'&dop='+dop,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
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
{ 
	//alert(wh1val);
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
	showUser(edtrecid,'postingtable','subformedt','','','','','');
}
function getdetails(stage)
{
	var get=document.frmaddDepartment.txtlot1.value;
	/*var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	var stage=document.frmaddDepartment.txtstage.value;*/
	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value.charCodeAt() == 32)
	{
		alert("Lot No cannot start with space.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
	{
		alert("Lot No cannot start with Numaric value.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value.length<6)
	{
	alert("Lot No cannot be less than 6 digits alphanumaric.");
	document.frmaddDepartment.txtlot1.focus();
	return false;
	}
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;					
	var tid=document.frmaddDepartment.maintrid.value;
	var lotid=document.frmaddDepartment.subtrid.value;
	var dsrn="";
	var stage=document.frmaddDepartment.txtstage.value;
	//alert(tid);
	//alert(lotid);
	
	//document.getElementById("postingsubtable").style.display="block";
	showUser(get,'postingsubsubtable','get',crop,variety,tid,lotid,dsrn,stage);
}
function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','','');
	}
	else
	{
		return false;
	}
}


function mySubmit()
{ 
	var f=0;
	
	dt1=getDateObject(document.frmaddDepartment.dopc.value,"-");
	dt2=getDateObject(document.frmaddDepartment.crdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.mtndate.value,"-");
	//alert(dt1); alert(dt2); alert(dt3);
	if(dt2<dt1)
	{
		alert("Date of Indent cannot be more than Todays date");
		document.frmaddDepartment.txtpsrn.value="";
		f=1;
		return false;
	}
	if(dt3>dt1)
	{
		alert("Date of Indent cannot be less than MTN Date.");
		document.frmaddDepartment.txtpsrn.value="";
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtpsrn.value=="")
	{
		alert("Please enter Indent number.");
		document.frmaddDepartment.txtpsrn.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtpromech.value=="")
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
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.validityperiod.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.validityupto.value=="")
	{
		alert("Select Validity Period");
		document.frmaddDepartment.validityperiod.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.pcktype.value=="")
	{
		alert("Please Select Pack Entire or Partial");
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtplotno.value=="")
	{
		alert("Pack Lot number can not be enpty");
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.picqtyp.value=="" || parseFloat(document.frmaddDepartment.picqtyp.value)<=0)
	{
		alert("Please SValid Picked for Packing Qty");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.upssize.value=="")
	{
		alert("Please select UPS for Packing");
		f=1;
		return false;
	}		
	if(document.frmaddDepartment.mrpups.value=="")
	{
		alert("Please enter MRP per UPS");
		document.frmaddDepartment.mrpups.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.pcktype.value=="P")
	{ 	
		var q1="";
		var q2="";
		var g="";
		var g2="";
		q1=document.frmaddDepartment.recqtyp1.value;
		g=document.frmaddDepartment.picqtyp.value;
		if(document.frmaddDepartment.srno2.value>=2)
		{
			q2=document.frmaddDepartment.recqtyp2.value;
		}
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;if(g2=="")g2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		var qtyd=parseFloat(g)+parseFloat(g2);
		//alert(qtyg+"<"+qtyd);
		if(parseFloat(qtyd)>parseFloat(qtyg))
		{
			alert("Please check. Total Quantity Picked for Packing is not matching with Total Quantity Available for Packing");
			return false;
			f=1;
		}	
	}
	else
	{
		if(document.frmaddDepartment.recqtyp1.value=="")
		{
			alert("Please check. Total Quantity Picked for Packing cannot be Blank");
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
		if(document.frmaddDepartment.maintrid.value==0)
		{
			alert("You have not Posted any Item. Please post & then click Preview");
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			document.frmaddDepartment.submit();	
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
		alert("Date of QC Test (DoT) cannot be more than Date of Processing and Packing.");
		for( var i=0; i<document.frmaddDepartment.protyp.length; i++)
		{
			document.getElementById('protyp').checked=false;
		}
		document.frmaddDepartment.protype.value="";
		return false;
	}
	else if(document.frmaddDepartment.qcdtyp.value=="")
	{
		alert("QC Date Type cannot be blank.");
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
				var sltn=document.frmaddDepartment.txtlot1.value.split("");
				var newtnob=0;
				var newtqty=0;
				var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13]+sltn[14]+sltn[15]+"C";
				document.getElementById('recnobp1').value=document.frmaddDepartment.txtextnob1.value;
				document.getElementById('recnobp1').readOnly=true;
				document.getElementById('recnobp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalnobp1').value=0;
				document.getElementById('recqtyp1').value=document.frmaddDepartment.txtextqty1.value;
				document.getElementById('recqtyp1').readOnly=true;
				document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp1').value=0;
				newtnob=parseInt(newtnob)+parseInt(document.frmaddDepartment.txtextnob1.value);
				newtqty=parseFloat(newtqty)+parseFloat(document.frmaddDepartment.txtextqty1.value);
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
					newtnob=parseInt(newtnob)+parseInt(document.frmaddDepartment.txtextnob2.value);
					newtqty=parseFloat(newtqty)+parseFloat(document.frmaddDepartment.txtextqty2.value);
				}
				
				document.frmaddDepartment.txtconnob.value=newtnob;
				document.frmaddDepartment.txtconqty.value=newtqty;
				document.frmaddDepartment.txtconrem.value="0";
				document.frmaddDepartment.txtconim.value="0";
				document.frmaddDepartment.txtconpl.value="0";
				document.frmaddDepartment.txtconloss.value="0";
				document.frmaddDepartment.txtconper.value="0.000";
				document.frmaddDepartment.txtclotno.value=cltn;
				document.getElementById('avlnobpck').value=newtnob;
				document.getElementById('avlqtypck').value=newtqty;
				
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
				document.frmaddDepartment.txtconrem.value="0";
				document.frmaddDepartment.txtconim.value="0";
				document.frmaddDepartment.txtconpl.value="0";
				document.frmaddDepartment.txtconloss.value="0";
				document.frmaddDepartment.txtconper.value="0";
				var sltn=document.frmaddDepartment.txtlot1.value;
				showUser(sltn,'cltno','cltnonew','','','','','');
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
				document.frmaddDepartment.txtconrem.value="0";
				document.frmaddDepartment.txtconim.value="0";
				document.frmaddDepartment.txtconpl.value="0";
				document.frmaddDepartment.txtconloss.value="0";
				document.frmaddDepartment.txtconper.value="0";
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
				document.frmaddDepartment.txtconrem.value="0";
				document.frmaddDepartment.txtconim.value="0";
				document.frmaddDepartment.txtconpl.value="0";
				document.frmaddDepartment.txtconloss.value="0";
				document.frmaddDepartment.txtconper.value="0";
		}
		//document.getElementById('avlqtypck').value="";
		//alert(document.frmaddDepartment.paceptyp.length);
		for(q=1; q<=document.frmaddDepartment.paceptyp.length; q++)
		{
			var fet="paceptyp"+q;
			document.getElementById(paceptyp).checked=false;
		}
			
		//document.getElementById('picqtyp').value="";
		document.getElementById('picqtyp').readOnly=true;
		document.getElementById('picqtyp').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').readOnly=true;
		document.getElementById('balcnob').style.backgroundColor="#cccccc";
		//document.getElementById('balcnob').value="";
		//document.getElementById('balcqty').value="";
		document.getElementById('conditionsloc').style.display="none";
		//document.getElementById('pcktype').value="";
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			document.getElementById(fet).checked=false;
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
			
			//document.getElementById(c).value="";
			//document.getElementById(d).value="";
			//document.getElementById(e).value="";
			//document.getElementById(f).value="";
			//document.getElementById(g).checked=false;
			
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			
			//document.getElementById(c).disabled=true;
			//document.getElementById(d).disabled=true;
			//document.getElementById(e).disabled=true;
			//document.getElementById(f).disabled=true;
			//document.getElementById(g).disabled=true;
			
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
	}
}

function chkpronob(nobval)
{
	if(parseInt(document.frmaddDepartment.srno2.value==2))
	{
		if(document.getElementById('recqtyp1').value=="" && document.getElementById('recqtyp2').value=="")
		{
			alert("Enter Processing Qty");
			return false;
		}
	}
	else
	{
		if(document.getElementById('recqtyp1').value=="")
		{
			alert("Enter Processing Qty");
			return false;
		}
	}
	if(nobval<=0)
	{
		alert("NoB cannot be Zero")
		document.frmaddDepartment.txtconnob.value="";
		document.frmaddDepartment.txtconnob.focus();
		return false
	}
	else
	{
		if(nobval!="")
		document.getElementById('avlnobpck').value=nobval;
		else
		document.getElementById('avlnobpck').value="";
	}
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
		var fet="paceptyp"+q;
		document.getElementById(paceptyp).checked=false;
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
			document.getElementById(fet).checked=false;
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
			/*document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;*/
			document.getElementById(h).value="";
			document.getElementById(i).value="";
		
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			/*document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;*/
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
	}
}
function chkconqty()
{
	var abc=0;
	if(document.frmaddDepartment.txtconqty.value=="")
	{
		alert("Enter Condition Seed Qty");
		document.frmaddDepartment.txtconrem.value="0";
		document.frmaddDepartment.txtconloss.value="0";
		document.frmaddDepartment.txtconper.value="0";
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
		alert("Condition Seed Qty cannot be more than Total Quantity picked for Processing");
		document.frmaddDepartment.txtconrem.value="";
		return false;
	}
}
function chkrm()
{
	if(document.frmaddDepartment.txtconrem.value=="")
	{
		alert("Enter Remnant (RM)");
		document.frmaddDepartment.txtconim.value="0";
		document.frmaddDepartment.txtconloss.value="0";
		document.frmaddDepartment.txtconper.value="0";
		return false;
	}
}

function chkim(plval)
{
	if(document.frmaddDepartment.txtconim.value=="")
	{
		alert("Enter Inert Material (IM)");
		document.frmaddDepartment.txtconpl.value="0";
		document.frmaddDepartment.txtconloss.value="0";
		document.frmaddDepartment.txtconper.value="0";
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
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not eual to sum total of Condition Seed & Total Condition Loss");
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
	/*if(document.getElementById('lble_'+[val12]).value=="")
	{
		alert("Please enter Label No.");
		document.getElementById('mpck_'+[val12]).checked=false
		document.getElementById('lble_'+[val12]).focus()
		return false;
	}
	else*/
	{
		if(document.getElementById('mpck_'+[val12]).checked == true)
		{
			document.getElementById('nomp_'+[val12]).readOnly=true;
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
			//alert(document.getElementById('packqty_'+[val12]).value);
			//alert(document.getElementById('wtmp_'+[val12]).value);
			document.getElementById('nomp_'+[val12]).value=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
			document.frmaddDepartment.upswisemaxnomp.value=document.getElementById('nomp_'+[val12]).value;
			var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
			//alert(document.getElementById('nopc_'+[val12]).value);
			//alert(balnop);
			document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
			document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
			document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
			document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
			
			//document.getElementById('dtail_'+[val12]).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Attach</a>";
			
		}
		else
		{
			document.getElementById('nomp_'+[val12]).readOnly=true;
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			//document.getElementById('dtail_'+[val12]).innerHTML="Attach";
		}
	}
}

function balnopcheck(balval, val12)
{
	var bv=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
	//alert(bv);
	//alert(balval);
	if(parseInt(balval) > parseInt(bv))
	{
		alert("No. of Master Pack cannot be greater than "+bv);
		document.getElementById('nomp_'+[val12]).focus();
		document.getElementById('noofpacks_'+[val12]).value="";
		return false;
	}
	else if(parseInt(document.getElementById('lodednomp_'+[val12]).value) > parseInt(balval))
	{
		alert("Max No. of Master Pack cannot be less than No of MP attached");
		document.getElementById('nomp_'+[val12]).focus();
		document.getElementById('noofpacks_'+[val12]).value="";
		return false;
	}
	else
	{
		var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
		document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
		document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
		document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
		document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
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
			var paceptyp="paceptyp"+i;
			document.getElementById(paceptyp).checked=false;
		}
		document.frmaddDepartment.pcktype.value="";
		return false;
	}
	else
	{
		if(pkselval=="P")
		{
			document.getElementById('picqtyp').value="";
			document.getElementById('picqtyp').readOnly=false;
			document.getElementById('picqtyp').style.backgroundColor="#ffffff";
			document.getElementById('balcnob').readOnly=false;
			document.getElementById('balcnob').style.backgroundColor="#ffffff";
			document.getElementById('balcnob').value="";
			document.getElementById('balcqty').value="";
			
			var sltn=document.frmaddDepartment.txtclotno.value.split("");
			var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13];
			var cl=sltn[14]+sltn[15];
			var c2=sprintf("%02d",(parseInt(cl)+1));
			cltn=cltn+c2+"P";
			document.frmaddDepartment.txtplotno.value=cltn;
		}
		else
		{
			document.getElementById('picqtyp').value=document.getElementById('avlqtypck').value;
			document.getElementById('picqtyp').readOnly=true;
			document.getElementById('picqtyp').style.backgroundColor="#cccccc";
			document.getElementById('balcnob').readOnly=true;
			document.getElementById('balcnob').style.backgroundColor="#cccccc";
			document.getElementById('balcnob').value=0;
			document.getElementById('balcqty').value=0;
			
			var pckloss=document.getElementById('pckloss').value;
			var ccloss=document.getElementById('ccloss').value;
			if(pckloss=="")pckloss=0;
			if(ccloss=="")ccloss=0;
			document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(pckloss)+parseFloat(ccloss))
			var sltn=document.frmaddDepartment.txtclotno.value.split("");
			var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13]+sltn[14]+sltn[15]+"P";
			document.frmaddDepartment.txtplotno.value=cltn;
		}
		document.getElementById('pcktype').value=pkselval;
		
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			document.getElementById(fet).checked=false;
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
		//	var det="dtail_"+j;
			//alert(det);
			document.getElementById(a).value="";
			document.getElementById(b).value="";
			/*document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;*/
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			
			document.getElementById(a).disabled=true;
			document.getElementById(b).disabled=true;
			/*document.getElementById(c).disabled=true;
			document.getElementById(d).disabled=true;
			document.getElementById(e).disabled=true;
			document.getElementById(f).disabled=true;
			document.getElementById(g).disabled=true;*/
			document.getElementById(h).disabled=true;
			document.getElementById(i).disabled=true;
		}
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
		/*document.getElementById(domcs).value="";
		document.getElementById(lbls).value="";
		document.getElementById(domce).value="";
		document.getElementById(lble).value="";
		document.getElementById(mpck).value="";*/
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
	var nopc="nopc_"+val2;
	var domcs="domcs_"+val2;
	
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
		var z="nopc_1";
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
	document.getElementById('balcqty').value=Math.round((parseFloat(document.getElementById('avlqtypck').value)-parseFloat(pfpval))*100)/100;
	document.getElementById('balpck').value=Math.round((parseFloat(document.getElementById('avlqtypck').value)-parseFloat(pfpval))*100)/100;
	if(document.getElementById('balcqty').value<=0)
	{
		document.getElementById('balcqty').value=0;
		document.getElementById('balcnob').value=0;
	}
	var sno=document.frmaddDepartment.sno.value;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		document.getElementById(fet).checked=false;
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
		/*document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;*/
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		/*document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;*/
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
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
		document.getElementById(fet).checked=false;
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
		/*document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;*/
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		/*document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;*/
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
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
		document.getElementById(fet).checked=false;
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
		/*document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;*/
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		
		document.getElementById(a).disabled=true;
		document.getElementById(b).disabled=true;
		/*document.getElementById(c).disabled=true;
		document.getElementById(d).disabled=true;
		document.getElementById(e).disabled=true;
		document.getElementById(f).disabled=true;
		document.getElementById(g).disabled=true;*/
		document.getElementById(h).disabled=true;
		document.getElementById(i).disabled=true;
	}
}

function clk(snoval,upsid)
{
	//alert(snoval);
	var sno=document.frmaddDepartment.sno.value;
	document.frmaddDepartment.mrpups.value='';
	document.frmaddDepartment.mrpgms.value='';
	//alert(sno);
	if(document.getElementById('picqtyp').value=="")
	{
		alert("Picked for Packing Qty cannot be blank");
		//document.getElementById('ccloss').value="";
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			document.getElementById(fet).checked=false;
		}
		return false;
	}
	else
	{
		if(snoval>0)
		{
			var upsname="upsname_"+snoval;
			document.frmaddDepartment.upsize.value=document.getElementById(upsname).value;
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
				//var det="dtail_"+j;
				//alert(det);
				document.getElementById(a).value="";
				document.getElementById(b).value="";
				/*document.getElementById(c).value="";
				document.getElementById(d).value="";
				document.getElementById(e).value="";
				document.getElementById(f).value="";*/
				//document.getElementById(g).checked=false;
				document.getElementById(h).value="";
				document.getElementById(i).value="";
				
				document.getElementById(a).readonly=true;
				document.getElementById(a).style.backgroundColor="#CCCCCC";
				document.getElementById(b).disabled=true;
				/*document.getElementById(c).disabled=true;
				document.getElementById(d).disabled=true;
				document.getElementById(e).disabled=true;
				document.getElementById(f).disabled=true;*/
				//document.getElementById(g).disabled=true;
				document.getElementById(h).readonly=true;
				document.getElementById(h).style.backgroundColor="#CCCCCC";
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
			//var det2="dtail_"+snoval;
			document.getElementById(a).readonly=true;
			document.getElementById(a).style.backgroundColor="#CCCCCC";
			document.getElementById(b).disabled=false;
			/*document.getElementById(c).disabled=false;
			document.getElementById(d).disabled=false;
			document.getElementById(e).disabled=false;
			document.getElementById(f).disabled=false;*/
			//document.getElementById(g).disabled=false;
			document.getElementById(h).readonly=true;
			document.getElementById(h).style.backgroundColor="#CCCCCC";
			//document.getElementById(i).disabled=false;
			//document.getElementById(det2).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Attach</a>";
		//	document.getElementById(det2).innerHTML="Attach";
			//alert(document.getElementById('pcktype').value);
			//if(document.getElementById('pcktype').value=="E")
			{
				document.getElementById(a).value=document.getElementById('picqtyp').value;
				document.frmaddDepartment.upswisepackqty.value=document.getElementById('picqtyp').value;
				
				var wtnop="wtnopkg_"+snoval;
				var z="nopc_"+snoval;
				var zx=(parseFloat(document.getElementById(a).value)/parseFloat(document.getElementById(wtnop).value));
				
				var xc=parseFloat(parseFloat(document.getElementById(wtnop).value)*parseInt(zx));
				//alert(xc); alert(document.getElementById(a).value);
				document.getElementById(z).value=parseInt(zx);
				
				if(parseFloat(document.getElementById(z).value)<=0)
				{
					alert("NoP cannot be zero");
					document.getElementById(z).value="";
					return false;
				}
				document.getElementById(a).disabled=true;
				
				
				var val12=snoval;
				document.getElementById('nomp_'+[val12]).readOnly=true;
				document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
				document.getElementById('nomp_'+[val12]).value=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
				document.frmaddDepartment.upswisemaxnomp.value=document.getElementById('nomp_'+[val12]).value;
				var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
				document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
				document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
				document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
				document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
					
			}
		}
	}
}

function detailspop(dval2)
{
//alert(dval2);
	var sno=document.frmaddDepartment.sno.value;
	var dval=0;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		if(document.getElementById(fet).checked==true)
		dval=i;
	}
	if(dval>0)
	{
		pform();
		/*var tx="lble_"+dval;
		if(document.getElementById(tx).value=="")
		{
			alert("Please enter Label number");
			document.getElementById(tx).focus();
			return false;
		}
		else
		{*/
		
		// Barcode code
		
		
		
			/*var mpck="mpck_"+dval;
			var nomp="nomp_"+dval;
			if(document.getElementById(mpck).checked==true)
			{
				var totnomp=document.getElementById(nomp).value;
				var tid=document.frmaddDepartment.maintrid.value;
				var subtid=document.frmaddDepartment.subtrid.value;
				var lotno=document.frmaddDepartment.txtplotno.value;
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
			}*/
		//}
	}
}

function wh(wh1val, whno)
{ 	//alert(wh1val);
	//alert(whno);
	/*if(whno==1)
	{
		var z=0; var xs=0;
		var sno=document.frmaddDepartment.sno.value;
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
			return false;
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
	}*/
	var bin1 = 'bin'+whno;
	//alert(bin1);
	showUser(wh1val,bin1,'wh',whno,'','','','');
	//var bin="bingn"+whno;
	//showUser(wh1val,bin,'wh',bin,whno,'','','');
}

function bin(bin2val, binno)
{
	var whc="txtwhg_"+binno;
	var sbin="subbin"+binno;
	var binc="vbin_"+binno;
	if(document.getElementById(whc).value=="")
	{
		alert("Please select Warehouse");
		return false;
	}
	else
	{
		var subbin = 'subbin'+binno;
		//alert(subbin);
		showUser(bin2val,subbin,'bin',binno,'','','','');
		//showUser(bin2val,sbin,'binnew',binc,binno,'','','');
	}
}

function subbin(subbin2val, subbinno)
{	
	var binc="vbin_"+subbinno;
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
		var Bagsv1=document.frmaddDepartment.slnomp_1.value;
		var qtyv1=document.frmaddDepartment.slqt_1.value;
		var ssbin="slocr"+subbinno;
		var bins="txtsubbg"+subbinno;
		showUser(subbin2val,ssbin,'subbin',itemv,bins,slocnogood,Bagsv1,qtyv1,trid);
		//setTimeout(function() { sloccomment(subbinno); },800);
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
	if(document.getElementById(existview).value=="")
	{
		setTimeout(function() { sloccomment(rval); },400);
	}
	else if(document.getElementById(existview).value=="Empty" || document.getElementById(existview).value=="Available")
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
		for(var i=1; i<=sno; i++)
		{
			if(document.getElementById('fetchk_'+[i]).checked==true)
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
			if(document.getElementById('fetchk_'+[i]).checked==true)
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
		document.frmaddDepartment.linkpch.value=parseInt(document.frmaddDepartment.linkpch.value)+parseInt(pchval);
		
		document.frmaddDepartment.bpch.value=parseInt(document.frmaddDepartment.extbpch.value)-parseInt(document.frmaddDepartment.linkpch.value);
	}
}
function openpackdetails(subtid,tid)
{
winHandle=window.open('packdetails_pnpslip_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
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
	else*/
	{
	if(valval!="")
	{
		dt1=getDateObject(document.frmaddDepartment.date.value,"-");
		dt2=getDateObject(document.frmaddDepartment.dp1.value,"-");
		dt3=getDateObject(document.frmaddDepartment.dp2.value,"-");
		dt4=getDateObject(document.frmaddDepartment.dp3.value,"-");
		dt5=getDateObject(document.frmaddDepartment.dp4.value,"-");
		dt6=getDateObject(document.frmaddDepartment.dp5.value,"-");
		dt7=getDateObject(document.frmaddDepartment.dp6.value,"-");
		if(document.frmaddDepartment.qcdtyp.value=="DoT")
		{
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
		else if(document.frmaddDepartment.qcdtyp.value=="DoSF")
		{
			if(valval==3)
			{
				if(dt5 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp4.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp4.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==6)
			{	
				if(dt6 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp5.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp5.value;
					document.frmaddDepartment.valdays.value=ddiff;
				}
			}
			if(valval==9)
			{
				if(dt7 <= dt1)
				{
					alert("Valid upto Date cannot be Less than or equal to Transaction Date.");
					document.frmaddDepartment.validityperiod.value="";
					document.frmaddDepartment.validityupto.value="";
					document.frmaddDepartment.valdays.value="";
					return false;
				}
				else
				{
					var ddiff=dateDiff(document.frmaddDepartment.dopc.value, document.frmaddDepartment.dp6.value);
					alert("Based on selected Validity period, this lot is valid for "+ddiff+" days");
					document.frmaddDepartment.validityupto.value=document.frmaddDepartment.dp6.value;
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
	else
	{
		document.frmaddDepartment.validityupto.value="";
		document.frmaddDepartment.valdays.value="";
	}
	}
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

function openslocsyn(tval)
{
	if(document.frmaddDepartment.detmpbno.value=="" || document.frmaddDepartment.detmpbno.value==0)
	{
		alert("Please attach Barcodes First");
		return false;
	}
	else
	{
		document.frmaddDepartment.slocssyncs24.value=tval;
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var lotno=document.frmaddDepartment.txtplotno.value;
		var txtpsrn=document.frmaddDepartment.txtpsrn.value;
		var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
		var ups=document.frmaddDepartment.upsidno.value;
		var sno=document.frmaddDepartment.sno.value;
		var bpch=0;
		for(var i=1; i<=sno; i++)
		{
			if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var noofpacks="noofpacks_"+i;
				bpch=document.getElementById(noofpacks).value;
			}
		}
		//alert(slocssyncs);
		showUser(lotno,'slocsync','slocsyncshow',txtpsrn,crop,variety,slocssyncs,ups,bpch);
		//alert("HI");
		/*winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }*/
	}
}
function bcsyncchk()
{
	if(document.frmaddDepartment.mobar.value!="" || document.frmaddDepartment.mobar.value > 0) 
	{
		document.getElementById("slsync").innerHTML="";
		var v1="synchn";
		var mobar=document.frmaddDepartment.mobar.value;
		showUser(v1,'slsync','slsynchk',mobar,'','','','');
	}
	else
	{
		document.getElementById("slsync").innerHTML="";
		var v1="nosynchn";
		var mobar=document.frmaddDepartment.mobar.value;
		showUser(v1,'slsync','slsynchk',mobar,'','','','');
	}
}
function showbarc(barcval)
{
	winHandle=window.open('lot_barcodes.php?barcval='+barcval,'WelCome','top=170,left=180,width=200,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function balbclink(barcval)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	var lotno=document.frmaddDepartment.txtplotno.value;
	var txtpsrn=document.frmaddDepartment.txtpsrn.value;
	var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
	
	winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety+'&barcval='+barcval+'&slocssyncs='+slocssyncs,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function sprintf () {
  // From: http://phpjs.org/functions
  // +   original by: Ash Searle (http://hexmen.com/blog/)
  // + namespaced by: Michael White (http://getsprink.com)
  // +    tweaked by: Jack
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Paulo Freitas
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Dj
  // +   improved by: Allidylls
  // *     example 1: sprintf("%01.2f", 123.1);
  // *     returns 1: 123.10
  // *     example 2: sprintf("[%10s]", 'monkey');
  // *     returns 2: '[    monkey]'
  // *     example 3: sprintf("[%'#10s]", 'monkey');
  // *     returns 3: '[####monkey]'
  // *     example 4: sprintf("%d", 123456789012345);
  // *     returns 4: '123456789012345'
  
  var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g;
  var a = arguments,
    i = 0,
    format = a[i++];

  // pad()
  var pad = function (str, len, chr, leftJustify) {
    if (!chr) {
      chr = ' ';
    }
    var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
    return leftJustify ? str + padding : padding + str;
  };

  // justify()
  var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
    var diff = minWidth - value.length;
    if (diff > 0) {
      if (leftJustify || !zeroPad) {
        value = pad(value, minWidth, customPadChar, leftJustify);
      } else {
        value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
      }
    }
    return value;
  };

  // formatBaseX()
  var formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
    // Note: casts negative numbers to positive ones
    var number = value >>> 0;
    prefix = prefix && number && {
      '2': '0b',
      '8': '0',
      '16': '0x'
    }[base] || '';
    value = prefix + pad(number.toString(base), precision || 0, '0', false);
    return justify(value, prefix, leftJustify, minWidth, zeroPad);
  };

  // formatString()
  var formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
    if (precision != null) {
      value = value.slice(0, precision);
    }
    return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
  };

  // doFormat()
  var doFormat = function (substring, valueIndex, flags, minWidth, _, precision, type) {
    var number;
    var prefix;
    var method;
    var textTransform;
    var value;

    if (substring === '%%') {
      return '%';
    }

    // parse flags
    var leftJustify = false,
      positivePrefix = '',
      zeroPad = false,
      prefixBaseX = false,
      customPadChar = ' ';
    var flagsl = flags.length;
    for (var j = 0; flags && j < flagsl; j++) {
      switch (flags.charAt(j)) {
      case ' ':
        positivePrefix = ' ';
        break;
      case '+':
        positivePrefix = '+';
        break;
      case '-':
        leftJustify = true;
        break;
      case "'":
        customPadChar = flags.charAt(j + 1);
        break;
      case '0':
        zeroPad = true;
        break;
      case '#':
        prefixBaseX = true;
        break;
      }
    }

    // parameters may be null, undefined, empty-string or real valued
    // we want to ignore null, undefined and empty-string values
    if (!minWidth) {
      minWidth = 0;
    } else if (minWidth === '*') {
      minWidth = +a[i++];
    } else if (minWidth.charAt(0) == '*') {
      minWidth = +a[minWidth.slice(1, -1)];
    } else {
      minWidth = +minWidth;
    }

    // Note: undocumented perl feature:
    if (minWidth < 0) {
      minWidth = -minWidth;
      leftJustify = true;
    }

    if (!isFinite(minWidth)) {
      throw new Error('sprintf: (minimum-)width must be finite');
    }

    if (!precision) {
      precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0 : undefined;
    } else if (precision === '*') {
      precision = +a[i++];
    } else if (precision.charAt(0) == '*') {
      precision = +a[precision.slice(1, -1)];
    } else {
      precision = +precision;
    }

    // grab value using valueIndex if required?
    value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

    switch (type) {
    case 's':
      return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
    case 'c':
      return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
    case 'b':
      return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'o':
      return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'x':
      return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'X':
      return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
    case 'u':
      return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
    case 'i':
    case 'd':
      number = +value || 0;
      number = Math.round(number - number % 1); // Plain Math.round doesn't just truncate
      prefix = number < 0 ? '-' : positivePrefix;
      value = prefix + pad(String(Math.abs(number)), precision, '0', false);
      return justify(value, prefix, leftJustify, minWidth, zeroPad);
    case 'e':
    case 'E':
    case 'f': // Should handle locales (as per setlocale)
    case 'F':
    case 'g':
    case 'G':
      number = +value;
      prefix = number < 0 ? '-' : positivePrefix;
      method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
      textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
      value = prefix + Math.abs(number)[method](precision);
      return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
    default:
      return substring;
    }
  };

  return format.replace(regex, doFormat);
}

function qctpchk(qtval)
{
	document.frmaddDepartment.qcdttype.value=qtval;
	document.frmaddDepartment.validityupto.value="";
	document.frmaddDepartment.valdays.value="";
	document.frmaddDepartment.validityperiod.value="";
	document.frmaddDepartment.validityperiod.selectedIndex=0;
	
	if(qtval=="DoT")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot1.value;
	else if(qtval=="DoSF")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot2.value;
	else
		document.frmaddDepartment.qctestdate.value="";
}

function poucheschk(pchval,sno)
{
	var balnop=parseInt(document.getElementById('nomp_'+[sno]).value)*parseInt(document.getElementById('wtnop_'+[sno]).value);
	//alert(balnop); alert(pchval);
	document.getElementById('noofpacks_'+[sno]).value=parseInt(document.getElementById('nopc_'+[sno]).value)-parseInt(balnop)-parseInt(pchval);
	document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[sno]).value;
	document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[sno]).value;
	document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[sno]).value;
}



function chkmlt(mltval, mltno)
{
	//alert(mltval);alert(mltno);
	var f=0;
	
	mltval=mltval.toUpperCase();
	var sno=document.frmaddDepartment.sno.value;
	document.getElementById('m'+[mltno]).value=mltval;
	if(parseInt(document.getElementById('lodednomp_'+[sno]).value)>=parseInt(document.getElementById('nomp_'+[sno]).value))
	{
		alert("Cannot upload Barcodes more than Max No. of MP. Total numbers of Barcodes has been uploaded.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.wtmaccode.value=="")
	{
		alert("Please select Weighing Machine");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.wtrangefr.value=="" || document.frmaddDepartment.wtrangeto.value=="")
	{
		alert("Invalid Gross Weight Range. Please enter Gross Weight Range");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.lbls_1.value=="")
	{
		alert("Invalid Label No. 1. Please enter Label No. 1");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(document.frmaddDepartment.vsubbin_1.value=="")
	{
		alert("Please select SLOC");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		return false;
	}
	else
	{
		/*var mltn=mltno-1;
		var mmll=mltno+1;
		if(mltno>=2)
		{
			if(document.getElementById('w'+[mltn]).value=="")
			{
				alert("Please enter Weight in "+mltn);
				document.getElementById('m'+[mltno]).value="";
				document.getElementById('m'+[mltn]).value="";
				document.getElementById('m'+[mltn]).focus();
				f=1;
				return false;
			}
		}*/
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode1");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode2");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode3");
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.weight.value="";
				document.frmaddDepartment.barcode.focus();
				f=1;
				return false;
			}
		}
		//mltn++;
		//var m='m'+mltn;
		//var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		//var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		/*for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltn]).focus();
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
			document.getElementById('m'+[mltno]).value="";
			document.getElementById('m'+[mltn]).focus();
			f=1;
			return false;
		}*/
		if(f==0)
		{
			//document.frmaddDepartment.barcode.disabled=true;
			chkbardup(mltval,mltno);
		}
		else
		{
			return false;
		}
	}
}

function enterbar(mltval,mltno)
{
	var a=formPost(document.getElementById('mainform'));
	var barcvaldchk="barcvaldchk"+mltno;
	if(document.frmaddDepartment.barcvaldchk.value=="ok")
	{
		callwtfile(mltno);
		var txtbarws="w"+(mltno);
		if(document.frmaddDepartment.weight.value=="")
		setTimeout(function(){callwtfile(mltno);}, 200);
	}
	else
	{
		if(document.frmaddDepartment.barcvaldchk.value=="fail")
		{
			alert("Invalid Barcode/Duplicate barcode. Please Scan Barcode again");
			document.frmaddDepartment.barcode.value="";
			var a=formPost(document.getElementById('mainform'));
			showUser(a,'postingtable','barcemtyform','','','','','');
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			
			return false;
		}
		if(document.frmaddDepartment.barcvaldchk.value=="")
		{
			//chkbardup(mltval,mltno);
			setTimeout(function(){chkbardup(mltval,mltno);}, 1000);
		}
	}
}

function chkbardup(mltval,mltno)
{
	var a=formPost(document.getElementById('mainform'));
	var barcvaldchk="barcvaldchk"+mltno;
	var wtbar="wtbar"+mltno;
	showUser(mltval,wtbar,'brchchk',mltno,'','','','','','','');
	setTimeout(function(){
	if(document.frmaddDepartment.barcvaldchk.value=="")
	{
		setTimeout(chkbardup(mltval,mltno), 200);
		//setTimeout(function(){showUser(mltval,wtbar,'brchchk',mltno,'','','','','','','');}, 1000);
	}
	else //if(document.getElementById(barcvaldchk).value!="")
	{
		//setTimeout(chkbardup(mltval,mltno), 500);
		enterbar(mltval,mltno);
	}}, 200);
}

function callwtfile(mltno)
{
	var ct=1;
	var a=formPost(document.getElementById('mainform'));
	var bardet="wtpdn"+mltno;
	var bardet1="wtws"+mltno;
	var bardet3="wtwsdelete"+mltno;
	var vname=document.frmaddDepartment.wtmaccode.value;
	var minwt=document.frmaddDepartment.wtrangefr.value;
	var maxwt=document.frmaddDepartment.wtrangeto.value;
	showUser(vname,bardet1,'bcwtpd',mltno,minwt,maxwt,'','','','','');
	
	setTimeout(function(){
		var txtbarws="w"+(mltno);
		if(document.frmaddDepartment.barcode.value!='' && document.frmaddDepartment.weight.value=="")
		{
			setTimeout(function(){showUser(vname,bardet1,'bcwtpd',mltno,minwt,maxwt,'','','','','');}, 200);
			ct++;
		}
		
		if(document.frmaddDepartment.weight.value!="")
		{ct=0; var f=0;
			if(document.frmaddDepartment.weight.value=="" || parseFloat(document.frmaddDepartment.weight.value)<=0)
			{
				alert("Invalid Weight. \n\nReasons:\n\n1. Barcode Already Present in system.\n\n2. Either Gross Weight not in Range.\n\n3. Weight file not generated.\n\n4. Wrong File name.");
				document.frmaddDepartment.barcode.value="";
				var a=formPost(document.getElementById('mainform'));
				showUser(a,'postingtable','barcemtyform','','','','','');
				document.frmaddDepartment.weight.value="";
				document.frmaddDepartment.barcode.focus();
				f=1;
				return false;
			}
			else
			{
				var txtbarws="w"+(mltno);
				var bardet3="wtwsdelete"+mltno;
				var txtbarws="w"+(mltno);
				var vname=document.frmaddDepartment.wtmaccode.value;
				var minwt=document.frmaddDepartment.wtrangefr.value;
				var maxwt=document.frmaddDepartment.wtrangeto.value;
				if(parseFloat(document.frmaddDepartment.weight.value)<=0 || (parseFloat(document.frmaddDepartment.weight.value)<parseFloat(document.frmaddDepartment.wtrangefr.value) || parseFloat(document.frmaddDepartment.weight.value)>parseFloat(document.frmaddDepartment.wtrangeto.value)))
				{
					alert("Invalid Weight. \n\nReasons:\n\n1. Barcode Already Present in system.\n\n2. Either Gross Weight not in Range.\n\n3. Weight file not generated.\n\n4. Wrong File name.");
					document.frmaddDepartment.barcode.value="";
					var a=formPost(document.getElementById('mainform'));
					showUser(a,'postingtable','barcemtyform','','','','','');
					document.frmaddDepartment.weight.value="";
					document.frmaddDepartment.barcode.focus();
					f=1;
					return false;
				}
				else
				{
					barcodepform(mltno);
				}
				//setTimeout(callwtfile(mltno), 1000);
				//setTimeout(function(){showUser(vname,bardet3,'bcwtpdelete',mltno,minwt,maxwt,'','','','','');}, 500);
			}
		}
		else
		{
			if(document.frmaddDepartment.barcode.value!='' && document.frmaddDepartment.weight.value=="")
			setTimeout(function(){callwtfile(mltno);}, 200);
		}
	}, 200);
}

function chkmlt1(mltval, mltno)
{
	/*if(document.getElementById('m'+[mltno]).value=="")
	{
		alert("Please enter Barcode first.");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		return false;
	}*/
}

function barcodepform(mltno)
{
	var f=0;
	var a=formPost(document.getElementById('mainform'));
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dobg.value,"-");
	/*if(dt2 > dt1)
	{
		alert("Date of Weighing cannot be more than Todays Date.");
		f=1;
		return false;
	}*/
	if(document.frmaddDepartment.operatorcode.value=="")
	{
		alert("Please select Weighing Machine Operator.");
		document.frmaddDepartment.operatorcode.focus();
		f=1;
		//return false;
	}	
	else if(document.frmaddDepartment.wtmaccode.value=="")
	{
		alert("Please Select Weighing Machine.");
		document.frmaddDepartment.wtmaccode.focus();
		f=1;
		//return false;
	}		
	else if(document.frmaddDepartment.wtrangefr.value=="")
	{
		alert("Please enter Gross Weight Range starts From.");
		document.frmaddDepartment.wtrangefr.focus();
		f=1;
		//return false;
	}		
	else if(document.frmaddDepartment.wtrangeto.value=="")
	{
		alert("Please enter Gross Weight Range up to");
		document.frmaddDepartment.wtrangeto.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.barcode.value=="")
	{
		alert("Please enter Barcode");
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.barcode.value.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.barcvaldchk.value!="" && document.frmaddDepartment.barcvaldchk.value=="fail")
	{
		alert("Invalid Barcode/Duplicate barcode. Please Scan Barcode again");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.weight.value=="")
	{
		alert("Gross weight cannot be blank");
		document.frmaddDepartment.barcode.value="";
		document.frmaddDepartment.weight.value="";
		document.frmaddDepartment.barcode.focus();
		f=1;
		//return false;
	}
	else if(document.frmaddDepartment.weight.value!="")
	{
		if(parseFloat(document.frmaddDepartment.weight.value)<=0 || (parseFloat(document.frmaddDepartment.weight.value)<parseFloat(document.frmaddDepartment.wtrangefr.value) || parseFloat(document.frmaddDepartment.weight.value)>parseFloat(document.frmaddDepartment.wtrangeto.value)))
		{
			alert("Invalid Weight. \n\nReasons:\n\n1. Barcode Already Present in system.\n\n2. Either Gross Weight not in Range.\n\n3. Weight file not generated.\n\n4. Wrong File name.");
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			f=1;
			//return false;
		}
	}
	if(f==1)
	{
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','barcemtyform','','','','','');//return false;
	}
	else
	{
		var lbcdwt=0; var ft=0;
		if(document.frmaddDepartment.weight.value!='' && document.frmaddDepartment.lastbarcodewt.value!='' && parseFloat(document.frmaddDepartment.weight.value)==parseFloat(document.frmaddDepartment.lastbarcodewt.value))
		{
			lbcdwt=1;
		}
		if(lbcdwt>0)
		{
			if(confirm("Previous Barcode Weight "+document.frmaddDepartment.lastbarcodewt.value+" and current Barcode Weight "+document.frmaddDepartment.weight.value+" is Same. Do you want proceed?")==false)
			{
				var vname=document.frmaddDepartment.wtmaccode.value;
				var minwt=document.frmaddDepartment.wtrangefr.value;
				var maxwt=document.frmaddDepartment.wtrangeto.value;
				showUser(vname,bardet3,'bcwtpdelete',mltno,minwt,maxwt,'','','','','');
				document.frmaddDepartment.barcode.value="";
				document.frmaddDepartment.weight.value="";
				document.frmaddDepartment.lastbarcodewt.value="";
				document.frmaddDepartment.barcode.focus();
				ft=1;
				return false;
			}
		}
		if(ft==1)
		{
			var a=formPost(document.getElementById('mainform'));
			showUser(a,'postingtable','barcemtyform','','','','','');//return false;
		}
		else
		{
		
			var txtbarws="w"+(mltno);
			var bardet3="wtwsdelete"+mltno;
			var txtbarws="w"+(mltno);
			var vname=document.frmaddDepartment.wtmaccode.value;
			var minwt=document.frmaddDepartment.wtrangefr.value;
			var maxwt=document.frmaddDepartment.wtrangeto.value;
			var a=formPost(document.getElementById('mainform'));
			showUser(a,'postingtable','barcform','','','','','');
			//alert(a);
			
			////showUser(a,'postingsubtable','mform','','','','','');
			//setTimeout(function(){document.frmaddDepartment.barcode.focus();}, 200);
			setTimeout(function(){showUser(vname,bardet3,'bcwtpdelete',mltno,minwt,maxwt,'','','','','');}, 200);
			setTimeout(function(){
			document.frmaddDepartment.barcode.focus();
			document.frmaddDepartment.barcode.value="";
			document.frmaddDepartment.weight.value="";
			document.frmaddDepartment.barcode.focus();
			}, 400);
		}
	}  
}
function mycancel()
{
	if(confirm('Do You wish to Cancel this Transaction?')==true)
	{
		document.frmaddDepartment.btntypval.value=1;
		document.frmaddDepartment.submit();	
	}
	else
	{
		return false;
	}
}

function nxtpform()
{
	return false;
}

function chkwtfileval(mltno)
{
	document.getElementById('w'+[mltno]).value="";
	document.getElementById('m'+[mltno]).value="";
}
function newsloc(srno)
{
	//alert("test");
	var newwh='wh'+srno;
	showUser(srno,newwh,'wh1','','','','','');
	srno="'"+srno+"'";
	setTimeout('newsloc1('+srno+')',200);
}

function newsloc1(srno)
{
	var bin='bin'+srno;
	showUser(srno,bin,'bin1','','','','','');
	srno="'"+srno+"'";
	setTimeout('newsloc2('+srno+')',200);
}
function newsloc2(srno)
{
	var subbin='subbin'+srno;
	showUser(srno,subbin,'sbin1','','','','','');
}
function openbarcodedetails(subtid,tid)
{
winHandle=window.open('barcodedetails_pnpslip_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
function mrpconv(mrpval)
{
	var upssize=document.frmaddDepartment.upsize.value;
	//alert(upssize);
	var x=upssize.split(" ");
//	alert(x[0]);
	if(x[1]=="Gms")
	{
		document.frmaddDepartment.mrpgms.value=parseFloat(mrpval)/parseFloat(x[0]);
		document.frmaddDepartment.mrpgms.value=parseFloat(document.frmaddDepartment.mrpgms.value).toFixed(2);
	}
	else
	{
		document.frmaddDepartment.mrpgms.value=parseFloat(mrpval)/parseFloat(x[0]);
		document.frmaddDepartment.mrpgms.value=parseFloat(document.frmaddDepartment.mrpgms.value).toFixed(2);
	}
}
function chkmtndate()
{
	dt1=getDateObject(document.frmaddDepartment.dopc.value,"-");
	dt2=getDateObject(document.frmaddDepartment.crdate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.mtndate.value,"-");
	//alert(dt1); alert(dt2); alert(dt3);
	if(dt2<dt1)
	{
		alert("Date of Indent cannot be more than Todays date");
		document.frmaddDepartment.txtpsrn.value="";
		return false;
	}
	if(dt3>dt1)
	{
		alert("Date of Indent cannot be less than MTN Date.");
		document.frmaddDepartment.txtpsrn.value="";
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Processing and Packing slip&nbsp;(FC)<input type="hidden" name="logid" value="<?php echo $logid?>" /></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >

<?php

$sql_trdetails=mysqli_query($link,"Select * from tbl_pnpslipmain where pnpslipmain_id='$maintrid' ") or die(mysqli_error($link));
$row_trdetails=mysqli_fetch_array($sql_trdetails);
$code1="TPS".$code."/".$yearid_id."/".$row_trdetails['pnpslipmain_code'];

$sql_trdetails_sub=mysqli_query($link,"Select * from tbl_pnpslipsub where pnpslipmain_id='$maintrid' ") or die(mysqli_error($link));
$row_trdetails_sub=mysqli_fetch_array($sql_trdetails_sub);

$enddate=date("d-m-Y");

	$trdatex=$row_trdetails['pnpslipmain_date'];
	$tryear=substr($trdatex,0,4);
	$trmonth=substr($trdatex,5,2);
	$trday=substr($trdatex,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate2=$row_trdetails['pnpslipmain_mtndate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;	
?>	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="crdate" value="<?php echo $enddate?>" />
		 
		</br>
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
  <td colspan="8" align="center" class="tblheading">Add Processing and Packing Slip FC - Indent </td>
</tr>
<tr height="15"><td colspan="8" align="right" class="smalltblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $code1?></td>

<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction Date&nbsp;</td>
<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate;?><input name="date" type="hidden" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $trdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;MTN Date&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $trdate2;?><input name="mtndate" id="mtndate" type="hidden" size="10" class="smalltbltext" tabindex="0" value="<?php echo $trdate2;?>" maxlength="10"/>&nbsp;</td>
<td width="157" align="right"  valign="middle" class="smalltblheading">MTN No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_trdetails['pnpslipmain_mtnno'];?><input name="mtnno" type="hidden" size="15" class="smalltbltext" tabindex=""    maxlength="8" onkeypress="return isNumberKey1(event)" value="<?php echo $row_trdetails['pnpslipmain_mtnno'];?>" />&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Indent Date&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dopc')" tabindex="6"><img src="../images/cal.gif" border="0" align="absmiddle" /></a>&nbsp;<font color="#FF0000">*</font></td>
<td width="157" align="right"  valign="middle" class="smalltblheading">Indent No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex=""    maxlength="8" onkeypress="return isNumberKey1(event)" onchange="chkmtndate();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>


<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 

  <tr class="Light" height="30">
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_trdetails['pnpslipmain_crop']."' order by cropname Asc");
$row_crop=mysqli_fetch_array($quer3);
$qry_variety=mysqli_query($link,"SELECT popularname FROM tblvariety where varietyid='".$row_trdetails['pnpslipmain_variety']."' ");
$row_variety=mysqli_fetch_array($qry_variety);
?>

<td align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="166" align="left"  valign="middle" class="smalltbltext" >&nbsp;<?php echo $row_crop['cropname'];?><input type="hidden" name="txtcrop" value="<?php echo $row_trdetails['pnpslipmain_crop'];?>" />
  <!--<select class="smalltbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
    <option value="" selected>--Select Crop--</option>
    <?php while($noticia = mysqli_fetch_array($quer3)) { ?>
    <option value="<?php echo $noticia['cropid'];?>" />  
    <?php echo $noticia['cropname'];?>
    <?php } ?>
  </select>
  <font color="#FF0000">*</font>-->&nbsp;</td>

	<td width="107" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="209" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<?php echo $row_variety['popularname'];?><input type="hidden" name="txtvariety" value="<?php echo $row_trdetails['pnpslipmain_variety'];?>" /><!--<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1();" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>-->&nbsp;</td>
		<td width="157" align="right" valign="middle" class="smalltblheading">Seed Stage&nbsp;</td>
<td width="165"  align="left" valign="middle" class="smalltbltext"  >&nbsp;<?php echo $row_trdetails['pnpslipmain_stage'];?><input type="hidden" name="txtstage" value="<?php echo $row_trdetails['pnpslipmain_stage'];?>" /><!--<select class="smalltbltext" name="txtstage" style="width:80px;" onChange="sschk1()">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <option value="Condition" >Condition</option>
	 <option value="Pack" >Pack</option>
  </select>&nbsp;<font color="#FF0000">*</font>--><?php echo $row_variety['pnpslipmain_stage'];?>	</td>
           </tr>
<?php
$sql_sel1="select * from tbl_rm_promac where plantcode='$plantcode' order by promac_type, promac_macid";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
?> 		   
<tr class="Light" height="30">
<td width="152" align="right" valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
<td  align="left" valign="middle" class="smalltbltext"  >&nbsp;
  <select class="smalltbltext" name="txtpromech" style="width:120px;" >
    <option value="" selected>--Select--</option>
    <?php while($noticia_item1 = mysqli_fetch_array($res1)) { $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];?>
    <option value="<?php echo $noticia_item1['promac_id'];?>" />  
    <?php echo $num;?>
    <?php } ?>
  </select>  &nbsp;<font color="#FF0000">*</font>	</td>
<?php
$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' order by proopr_fname") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
?>
<td width="107" align="right" valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
<td width="209" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtoprname" style="width:150px;" >
    <option value="" selected>--Select--</option>
    <?php while($row_popr = mysqli_fetch_array($query_popr)) { ?>
		<option value="<?php echo $row_popr['proopr_id'];?>" />   
		<?php echo $row_popr['proopr_fname'];?> <?php echo $row_popr['proopr_lname']?>
		<?php } ?>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
<?php
$sql_sel="select * from tbl_rm_treattype order by treatt_type";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$total=mysqli_num_rows($res);
?>  
<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext">&nbsp;
      <!--<select class="smalltbltext" name="txttreattyp" style="width:120px;" onchange="sschk4()">
        <option value="none" selected>None</option>
        <?php while($noticia_item = mysqli_fetch_array($res)) { ?>
        <option value="<?php echo $noticia_item['treatt_type'];?>" />      
        <?php echo $noticia_item['treatt_type'];?>
        <?php } ?>
      </select>     &nbsp;<font color="#FF0000">*</font>--> <?php echo $row_trdetails['pnpslipmain_treattype'];?>	</td>
</tr>
<!--<tr class="Light" height="30">
<td align="right"  valign="middle" class="smalltblheading">Processing Slip Ref. No.&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" colspan="5">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex=""    maxlength="15" onchange="vendorchk1();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>-->
</table>
<br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
	<tr class="Light" height="30">
	<td align="right" width="319" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
	<td align="left" width="645" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="<?php echo $row_trdetails_sub['pnpslipsub_clotno'];?>" readonly="true" style="background-color:#CCCCCC" />
	</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $maintrid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $row_trdetails_sub['pnpslipsub_id'];?>" />
<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"> 
<?php
	//echo "select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$a."'  ";
$lotqry=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$row_trdetails_sub['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
  $tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
 $nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype="";
 while($row_issue=mysqli_fetch_array($lotqry))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_trdetails_sub['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
	$nob=$nob+$row_issuetbl['lotldg_balbags']; 
	$qty=$qty+$row_issuetbl['lotldg_balqty'];
	$qc=$row_issuetbl['lotldg_qc'];
	if($qc=="OK")
	{
		$trdate=$row_issuetbl['lotldg_qctestdate'];
		$trdate=explode("-",$trdate);
				$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		$qcdttype="DOT";
	}
//else
{
	$zz=str_split($row_trdetails_sub['pnpslipsub_lotno']);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];

	//if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
			$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
			//echo $row_softr_sub[0];
			$sql_softr=mysqli_query($link,"Select * from tbl_softr where softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
			$tot_softr=mysqli_num_rows($sql_softr);
			$row_softr=mysqli_fetch_array($sql_softr);
			if($tot_softr > 0)
			{
				$trdate=$row_softr['softr_date'];
				$trdate=explode("-",$trdate);
				$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
			}
		}
		if($qcdot2=="")
		{
			$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
			$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
			if($tot_softr_sub2 > 0)
			{
				$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
				//echo $row_softr_sub2[0];

				$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
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
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";
if($qcdot1=="00-00-0000" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="00-00-0000" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

$tdt="";
$sql_qcs=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' and oldlot='$ltno' and qcstatus='OK' order by tid desc Limit 0,2") or die(mysqli_error($link));
if($tot_qcs=mysqli_num_rows($sql_qcs)>=2)
{
	while($row_qcs=mysqli_fetch_array($sql_qcs))
	{
		if($tdt!="")
		$tdt=$tdt.",".$row_qcs['testdate'];
		else
		$tdt=$row_qcs['testdate'];
	}
}
$tdt1=""; $tdt2="";

$tdt=explode(",",$tdt);
$tdt1=$tdt[0];
$tdt2=$tdt[1];

if($qcdot1!="")
{
	$crdate=date("d-m-Y");
	$now = strtotime($qcdot1); // or your date as well
	$your_date = strtotime($crdate);
	$datediff2 = (($your_date - $now)/(60*60*24));
}
else
$datediff2 = 0;
//echo $qcdot2;
if($datediff2>15)	
{
	$qcdot2="";
}
else
{
	if($tdt2!="")
	{
		if($qcdot2!="" && $qcdot1!="")
		{
			$tdte2=explode("-",$qcdot2);
			$m=$tdte2[1];
			$de=$tdte2[0];
			$y=$tdte2[2];
		  	$tdte2=$y."-".$m."-".$de;
			
			$start_ts = strtotime($tdt2);
			$end_ts = strtotime($tdt1);
			$user_ts = strtotime($tdte2);
			
			//if((($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			if((($user_ts <= $start_ts) || ($user_ts >= $end_ts)))
			//if(!(($user_ts >= $start_ts) && ($user_ts <= $end_ts)))
			{
				$qcdot2="";
			}
		}
	}
}
if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
$dp1="";$dp2="";$dp3="";$dp4="";$dp5="";$dp6="";
if($qcdot1!="")
{
	$trdate2=explode("-",$qcdot1);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	
	$de=$de-1;
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
if($qcdot2!="")
{
	$trdate2=explode("-",$qcdot2);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	/*$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];*/
	
	$de=$de-1;
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp4=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp4="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp5=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp5="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp6=$dp[2]."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp6="";}
}	
?>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Post Item Form</td>
  </tr>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td width="111" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="70" align="center" valign="middle" class="smalltblheading" >Total NoB</td>
    <td width="78" align="center" valign="middle" class="smalltblheading">Total Qty</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="81" align="center" valign="middle" class="smalltblheading">DoT</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">DoSF</td>
	<td width="84" align="center" valign="middle" class="smalltblheading">QC Date Type </td>
	<td width="139" align="center" valign="middle" class="smalltblheading">Process Entire/Partial</td>
   <td width="163" align="center" valign="middle" class="smalltblheading" >Processed Lot No.</td>
    <!--<td width="112" align="center" valign="middle" class="smalltblheading">Qty</td>-->
  </tr>

  <tr class="Light" height="25">
    <td width="111" align="center" valign="middle" class="smalltblheading"><?php echo $row_trdetails_sub['pnpslipsub_lotno'];?>
    <input type="hidden" name="softstatus" value="<?php echo $softstatus;?>" /></td>
    <td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $nob;?>
    <input type="hidden" name="txtonob" value="<?php echo $nob;?>" /></td>
    <td width="78" align="center" valign="middle" class="smalltblheading"><?php echo $qty;?>
    <input type="hidden" name="txtoqty" value="<?php echo $qty;?>" /></td>
	<td width="84" align="center" valign="middle" class="smalltblheading"><?php echo $qc;?>
    <input type="hidden" name="qcstatus" value="<?php echo $qc;?>" /></td>
	<td width="81" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot1;?><input type="hidden" name="qcdot1" value="<?php echo $qcdot1;?>" /></td>
	<td width="84" align="center" valign="middle" class="smalltblheading"><?php echo $qcdot2;?><input type="hidden" name="qcdot2" value="<?php echo $qcdot2;?>" />
    <input type="hidden" name="qctestdate" value="<?php if($qcdot1!="") echo $qcdot1; else if($qcdot1=="" && $qcdot2!="") echo $qcdot2; else echo "";?>" /><input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /><input type="hidden" name="dp4" value="<?php echo $dp4;?>" /><input type="hidden" name="dp5" value="<?php echo $dp5;?>" /><input type="hidden" name="dp6" value="<?php echo $dp6;?>" /><input type="hidden" name="qcdttype" value="<?php if($qcdot1!="") echo "DoT"; else if($qcdot1=="" && $qcdot2!="") echo "DoSF"; else ""; ?>" /></td>
	<td align="center" valign="middle" class="smalltblheading"><select name="qcdtyp" style="size:50px;" class="smalltbltext" <?php if(($qcdot1=="" && $qcdot2!="") || ($qcdot1!="" && $qcdot2=="") || ($qcdot1=="" && $qcdot2=="")) echo "disabled"; ?> onchange="qctpchk(this.value);" >
      <?php if($qcdot1=="" && $qcdot2==""){ ?>
      <option value="" <?php if(($qcdot1=="" && $qcdot2=="")) echo "selected"; ?> ></option>
      <?php }	?>
      <?php if($qcdot1!="" || $qcdot2!=""){ ?>
      <option value="DoT" <?php if($qcdot1!="") echo "selected"; ?> >DoT</option>
      <option value="DoSF" <?php if($qcdot1=="" && $qcdot2!="") echo "selected"; ?> >DoSF</option>
      <?php }	?>
    </select></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_trdetails_sub['pnpslipsub_processtype']; ?></td>
  <td width="163" align="center" valign="middle" class="smalltblheading" id="cltno" ><input type="text" name="txtclotno" id="txtclotno" class="smalltbltext" value="<?php echo $row_trdetails_sub['pnpslipsub_clotno']; ?>" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
    <!-- <td width="112" align="center" valign="middle" class="smalltblheading"><input type="text" name="txtqty" id="txtqty" class="smalltbltext" value="" size="8" /></td>-->
  </tr> <input name="protype" value="" type="hidden"> 
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Processing</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Picked for Processing </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="97" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="114" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="125" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="121" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_lotno='".$row_trdetails_sub['pnpslipsub_lotno']."' ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_trdetails_sub['pnpslipsub_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 	$srno2++;
 	
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;


$sql_pnpsubsub=mysqli_query($link,"select * from tbl_pnpslipsubsub where pnpslipsub_id='".$row_trdetails_sub['pnpslipsub_id']."' and pnpslipsubsub_subbin='".$row_issuetbl['lotldg_subbinid']."' and pnpslipsubsub_bin='".$row_issuetbl['lotldg_binid']."' and pnpslipsubsub_wh='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_pnpsubsub=mysqli_fetch_array($sql_pnpsubsub);




$diq=explode(".",$tnob);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$tnob;}
$tnob=$difq;
$diq=explode(".",$tqty);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$tqty;}
$tqty=$difq1;
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="97"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?><input name="txtextnob<?php echo $srno2?>" id="txtextnob<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="114" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?><input name="txtextqty<?php echo $srno2?>" id="txtextqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	
 <td  align="center"  valign="middle" class="smalltbltext" ><?php echo $row_pnpsubsub['pnpslipsubsub_pnob']; ?><input name="recnobp<?php echo $srno2?>" id="recnobp<?php echo $srno2?>" type="hidden" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true"  onchange="qtychk1(this.value,<?php echo $srno2?>);" value="<?php echo $row_pnpsubsub['pnpslipsubsub_pnob']; ?>"  />&nbsp;</td>

  <td  align="center"  valign="middle" class="smalltbltext"><?php echo $row_pnpsubsub['pnpslipsubsub_pqty']; ?><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)" value="<?php echo $row_pnpsubsub['pnpslipsubsub_pqty']; ?>" />&nbsp;</td>
  
      <td align="center"  valign="middle" class="smalltbltext"><?php echo $row_pnpsubsub['pnpslipsubsub_bnob']; ?><input name="txtbalnobp<?php echo $srno2?>" id="txtbalnobp<?php echo $srno2?>" type="hidden" size="7" class="smalltbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_pnpsubsub['pnpslipsubsub_bnob']; ?>" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><?php echo $row_pnpsubsub['pnpslipsubsub_bqty']; ?><input name="txtbalqtyp<?php echo $srno2?>" id="txtbalqtyp<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext" tabindex=""   maxlength="10" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_pnpsubsub['pnpslipsubsub_bqty']; ?>" /></td>
  </tr>
 <?php
  }
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Packing Details</td>
</tr>
<tr class="Light" height="25">
<td width="165" align="center" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="165" align="center" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="220" align="center" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire&nbsp;</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Partial&nbsp;</td>
<td width="156" align="center" valign="middle" class="tblheading">Packed Lot No.&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="165" align="center" valign="middle" class="tblheading">&nbsp;
  <select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="9" >9</option>
<option value="6" >6</option>
<option value="3" >3</option>
</select>&nbsp;Months</td>
<td width="165" align="center" valign="middle" class="tblheading">&nbsp;
  <input type="text" class="tbltext" name="validityupto" id="validityupto" value="" size="15" readonly="true" style="background-color:#ECECEC"  /></td>
<td width="220" align="center" valign="middle" class="tblheading">&nbsp;
  <input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT/DoSF</td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp0" value="E" onclick="pcksel(this.value);" /></td>
<td width="125" align="center" valign="middle" class="tblheading"><input type="radio" name="paceptyp" id="paceptyp1" value="P" onclick="pcksel(this.value);"   /></td>
<td width="156" align="center" valign="middle" class="tblheading" id="pltno"><input type="text" name="txtplotno" id="txtplotno" class="smalltbltext" value="" size="16" readonly="true" style="background-color:#CCCCCC" /></td>
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
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
    <td width="149" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>-->
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Available for Packing</td>
	<td align="center" valign="middle" class="smalltblheading">Picked for Packing </td>
	<td align="center" valign="middle" class="smalltblheading">Packing Loss</td>
	<td align="center" valign="middle" class="smalltblheading">Captive Consumption</td>
	<td align="center" valign="middle" class="smalltblheading">Balance Packing</td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Balance Condition</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="86" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="111" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="116" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="92" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="110" align="center" valign="middle" class="smalltblheading">Qty</td>
  </tr>
  <tr class="Light" height="25">  
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="avlnobpck" id="avlnobpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_trdetails_sub['pnpslipsub_pnob']; ?>"  />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="avlqtypck" id="avlqtypck" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC"  value="<?php echo $row_trdetails_sub['pnpslipsub_pqty']; ?>" />&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="picqtyp" id="picqtyp" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="pfpchk(this.value)"  />    &nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pckloss" id="pckloss" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);" value="0" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="ccloss" id="ccloss" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="plchk1(this.value);"  onkeypress="return isNumberKey(event)"  value="0" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="balpck" id="balpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true"   style="background-color:#CCCCCC"  />    &nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="balcnob" id="balcnob" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC"  /></td>
   <td  align="center"  valign="middle" class="smalltbltext"><input name="balcqty" id="balcqty" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>  
</table>

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="7">Packing Details</td>
</tr>
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading">Select</td>
<td align="center" valign="middle" class="tblheading">UPS</td>
<td align="center" valign="middle" class="tblheading">Total Quantity</td>
<td align="center" valign="middle" class="tblheading">Max No. of Pouches</td>
<td align="center" valign="middle" class="tblheading">MPWT</td>
<td align="center" valign="middle" class="tblheading">Max. No. of MP</td>
<!--<td align="center" valign="middle" class="tblheading">No. of MP</td>
<td align="center" valign="middle" class="tblheading">No. of Pouches</td>-->
<td align="center" valign="middle" class="tblheading">Balance Pouches</td>
<!--<td align="center" valign="middle" class="tblheading">Barcode Labels</td>-->
</tr>

<?php
$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_trdetails['pnpslipmain_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$sno=0; $srnonew=0;
//echo $rowvariety['varietyid'];
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
$p1=array();
foreach($p1_array as $val1)
{
if($val1<>"")
{
$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
$row12=mysqli_fetch_array($res);
//echo $row12['ups']; echo "  -  ";
//echo $row12['wt']; echo "<br/>";
$wtmp=$p1_array2[$srnonew];
$mptnop=$p1_array3[$srnonew];
$sno++;			
?>

<tr class="Light" height="25">
  <td width="49" align="center" valign="middle" class="tbltext"><input type="radio" name="fet" onclick="clk('<?php echo $sno?>',<?php echo $row12['uid'];?>);" id="fetchk_<?php echo $sno?>" value="<?php echo $row12['uid'];?>"/></td>
  <td width="79" align="center" valign="middle" class="tbltext">&nbsp;<?php echo $row12['ups']." ".$row12['wt'];?><input type="hidden" name="wtnopkg_<?php echo $sno?>" id="wtnopkg_<?php echo $sno?>" value="<?php echo $row12['uom'];?>" /> <input type="hidden" name="upsname_<?php echo $sno?>" id="upsname_<?php echo $sno?>" value="<?php echo $row12['ups']." ".$row12['wt'];?>" /></td>
<td width="81" align="center" valign="middle" class="tbltext"><input type="text" name="packqty_<?php echo $sno?>" id="packqty_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC"  />  &nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="96" align="center" valign="middle" class="tbltext"><input type="text" name="nopc_<?php echo $sno?>" id="nopc_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" disabled="disabled"  readonly="true" style="background-color:#CCCCCC"/></td>
<td width="53" align="center" valign="middle" class="tbltext"><!--<input type="checkbox" disabled="disabled" name="mpck_<?php echo $sno?>" id="mpck_<?php echo $sno?>" class="tbltext" value="Yes" onchange="mpchk(this.value, <?php echo $sno;?>)"  />--><?php echo $wtmp;?></td>
<td width="78" align="center" valign="middle" class="tbltext"><input type="text" name="nomp_<?php echo $sno?>" id="nomp_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value=""  readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="wtmp_<?php echo $sno?>" id="wtmp_<?php echo $sno?>" value="<?php echo $wtmp?>" /><input type="hidden" name="wtnop_<?php echo $sno?>" id="wtnop_<?php echo $sno?>" value="<?php echo $mptnop?>" /></td>

<!--<td width="135" align="center" valign="middle" class="tbltext"><input type="text" name="lodednomp_<?php echo $sno?>" id="lodednomp_<?php echo $sno?>" size="5" maxlength="7"  class="tbltext" value="" onkeypress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="114" align="center" valign="middle" class="tbltext"><input type="text" name="pouches_<?php echo $sno?>" id="pouches_<?php echo $sno?>" size="5"  maxlength="7" class="tbltext" value=""  onkeypress="return isNumberKey1(event)" onchange="poucheschk(this.value,<?php echo $sno?>);" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>-->

<td width="82" align="center" valign="middle" class="tbltext"><input type="text" name="noofpacks_<?php echo $sno?>" id="noofpacks_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nowb_<?php echo $sno?>" id="nowb_<?php echo $sno?>" size="7" maxlength="7" class="tbltext" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<!--<td width="61" align="center" valign="middle" class="tbltext" id="dtail_<?php echo $sno;?>">Attach</td>-->
</tr>
<?php	
}
$srnonew++;
}
?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" /><input type="hidden" name="detmpbno" value="" /><input type="hidden" name="upsidno" value="" /><input type="hidden" name="upssize" value="" /><input type="hidden" name="nopks" value="" /><input type="hidden" name="upsize" value="" /> <input type="hidden" name="upswisepackqty" value="" /> <input type="hidden" name="upswisemaxnomp" value="" />
<input type="hidden" name="singlebar" value="" />
<input type="hidden" name="rangebar" value="" />
<input type="hidden" name="mobar" value="" />
<input type="hidden" class="smalltblheading" size="7" name="extbpch" value="<?php echo $bpch?>" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" class="smalltblheading" size="7" name="linkpch" value="0" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" class="smalltblheading" size="7" name="bpch" value="<?php echo $bpch?>" readonly="true" style="background-color:#CCCCCC; color:#FF0000" />
</table>
<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
	<td width="20%" align="center" valign="middle" class="smalltblheading">MRP per UPS</td>
	<td width="20%" align="center" valign="middle" class="smalltblheading">MRP per Kgs.</td>
  </tr>
<tr class="Light" height="25">  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="mrpups" id="mrpups" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" onchange="mrpconv(this.value)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="mrpgms" id="mrpgms" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" readonly="true"  style="background-color:#CCCCCC" value=""   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr> 
</table><br />
<div id="slsync">
<?php /*$bpch=0;?>
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
<tr class="light" height="25">
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg1" name="txtwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><select class="smalltbltext" name="txtbing1" id="txtbing1" style="width:60px;" onchange="bin(this.value,1);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><select class="smalltbltext" name="txtsubbg1" id="txtsubbg1" style="width:60px;" onchange="subbin(this.value,1);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocr1">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview1" id="existview1" class="tbltext" value="" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_1" id="nopmpcs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_1" id="noppchs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_1" id="noptpchs_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_1" id="noptqtys_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
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
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview2" id="existview2" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
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
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview3" id="existview3" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
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
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview4" id="existview4" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
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
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview5" id="existview5" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
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
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview6" id="existview6" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
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
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview7" id="existview7" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div> </td> 
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
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
 <td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview8" id="existview8" class="tbltext" value="" /></td>
 </tr>
  </table>
   </div>
<td align="center" valign="middle" class="tbltext"><input type="hidden" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<input type="hidden" name="sno3" value="8" /><input type="hidden" name="slocseldet" value="" />
</table>
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
</table><br />
<div id="slocsync">
</div>
<?php
*/
?>
</div>
<br />

<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="smalltbltext" size="100" maxlength="100" ></td>
</tr>
</table>
<br />
<!--<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0" style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
<?php
}
else
{
?>

<?php
}
?>
</div>
</div></div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
	<tr >
	<td valign="top" align="right"><a href="home_pronpslip_fc.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<!--<img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return mycancel();" />--><img src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();"  />&nbsp;&nbsp;<input type="hidden" name="btntypval" value="0" /> </td>
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

  
