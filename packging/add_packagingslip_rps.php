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
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		
		//frm_action=submit&txtid=1915&date=04-12-2023&dopc=04-12-2023&txtpsrn=fgdhfg&txtcrop=28&txtvariety=817&txtstage=Pack&itmdchk=0&txtlot1=DU91735%2F00000%2F03P&maintrid=0&subtrid=0&softstatus=&upssize=50.000%20Gms&wtnopkg_1=0.050&upsname_1=50.000%20Gms&txtextnob=663&txtextqty=33.15&txtonop=663&totextpouches=0&txtoqty=33.15&nomp_1=4&wtmp_1=7&wtnop_1=140&wbnop_1=10&wbinmp_1=14&noofpacks_1=0&nowb_1=&balqty_1=0.000&sno=1&detmpbno=&upsidno=&nopks=&singlebar=&rangebar=&mobar=&sno3=8&slocseldet=
		
		$txtid=trim($_POST['txtid']);
		$date=trim($_POST['date']);
		$dopc=trim($_POST['dopc']);
		$txtpsrn=trim($_POST['txtpsrn']);
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$txtstage=trim($_POST['txtstage']);
		$itmdchk=trim($_POST['itmdchk']);
		$txtlot1=trim($_POST['txtlot1']);
		$maintrid=trim($_POST['maintrid']);
		$subtrid=trim($_POST['subtrid']);
		$softstatus=trim($_POST['softstatus']);
		$upssize=trim($_POST['upssize']);
		$wtnopkg_1=trim($_POST['wtnopkg_1']);
		$upsname_1=trim($_POST['upsname_1']);
		$txtextnob=trim($_POST['txtextnob']);
		$txtextqty=trim($_POST['txtextqty']);
		$txtonop=trim($_POST['txtonop']);
		$totextpouches=trim($_POST['totextpouches']);
		$txtoqty=trim($_POST['txtoqty']);
		$nomp_1=trim($_POST['nomp_1']);
		$wtmp_1=trim($_POST['wtmp_1']);
		$wtnop_1=trim($_POST['wtnop_1']);
		$wbnop_1=trim($_POST['wbnop_1']);
		$wbwt_1=trim($_POST['wbwt_1']);
		$wbinmp_1=trim($_POST['wbinmp_1']);
		$noofpacks_1=trim($_POST['noofpacks_1']);
		$nowb_1=trim($_POST['nowb_1']);
		$balqty_1=trim($_POST['balqty_1']);
		$sno=trim($_POST['sno']);
		$detmpbno=trim($_POST['detmpbno']);
		$upsidno=trim($_POST['upsidno']);
		$nopks=trim($_POST['nopks']);
		$singlebar=trim($_POST['singlebar']);
		$rangebar=trim($_POST['rangebar']);
		$mobar=trim($_POST['mobar']);
		$sno3=trim($_POST['sno3']);
		$slocseldet=trim($_POST['slocseldet']);
		
		$p_id=trim($_POST['maintrid']);
		
		if(isset($_POST['mrpups'])) { $mrpups=$_POST['mrpups']; }
		if(isset($_POST['mrpgms'])) { $mrpgms=$_POST['mrpgms']; }	
		if(isset($_POST['txtremarks'])) { $txtremarks=$_POST['txtremarks']; }
		if(isset($_POST['txtoprname'])) { $txtoprname=$_POST['txtoprname']; }	
		if(isset($_POST['txtpromech'])) { $txtpromech=$_POST['txtpromech']; }	
		
			
		$ttype="SMC";
		$zz=str_split($txtlot1);
		$orlot=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
		
		$z1=$maintrid;
			
		$tdate11=explode("-",$date);
		$tdate1=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
			
		$tdate12=explode("-",$dopc);
		$tdate2=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];
		
		$dot=''; $dop=''; $valupto='';
		$sql_issue1=mysqli_query($link,"select lotdgp_id from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$txtlot1."' order by lotdgp_id DESC") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		
		$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1['lotdgp_id']."'") or die(mysqli_error($link)); 
		while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
		{
			/*$tdate11=explode("-",$row_issuetbl['lotldg_qctestdate']);
			$dot=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
			
			$tdate111=explode("-",$row_issuetbl['lotldg_dop']);
			$dop=$tdate111[2]."-".$tdate111[1]."-".$tdate111[0];
			
			$tdate112=explode("-",$row_issuetbl['lotldg_valupto']);
			$valupto=$tdate112[2]."-".$tdate112[1]."-".$tdate112[0];*/

			$dot=$row_issuetbl['lotldg_qctestdate'];
			$dop=$row_issuetbl['lotldg_dop'];
			$valupto=$row_issuetbl['lotldg_valupto'];
			
			$whid=$row_issuetbl['whid'];
			$binid=$row_issuetbl['binid'];
			$subbinid=$row_issuetbl['subbinid'];
			if($row_issuetbl['packlabels']!=NULL && $row_issuetbl['packlabels']!="")
			{
				$packlabels=explode("-",$row_issuetbl['packlabels']);
				$slabel=$packlabels[0];
				$elabel=$packlabels[1];
			}
			else
			{
				$slabel='';
				$elabel='';
			}
		}
				
		if($z1 == 0)
		{
			$sql_main="insert into tbl_rpspackaging (packaging_type, packaging_tdate, packaging_tcode,  packaging_indentdate, packaging_slipno, packaging_remarks, packaging_yearid, packaging_logid, plantcode, packaging_crop, packaging_variety, packaging_lotno, packaging_upssize, macoprname, proopr, promachcode) values ('$ttype', '$tdate1', '$txtid', '$tdate2', '$txtpsrn', '$txtremarks', '$yearid_id', '$logid', '$plantcode', '$txtcrop', '$txtvariety', '$txtlot1', '$upssize', '$txtoprname', '$txtoprname', '$txtpromech')";
			if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
			{
				$mainid=mysqli_insert_id($link);
				
				$sql_sub="insert into tbl_rpspackaging_sub (packaging_id, packagingsub_lotno, packagingsub_upssize, packagingsub_wtmp, packagingsub_wtnop, packagingsub_extwh, packagingsub_extbin, packagingsub_extsubbin, packagingsub_extnop, packagingsub_extqty, packagingsub_nop, packagingsub_wbnop, packagingsub_wbwt, packagingsub_wbinmp, packagingsub_qcdot, packagingsub_valupto, plantcode, packagingsub_pchmrp, packagingsub_grmmrp) values ('$mainid', '$txtlot1', '$upssize', '$wtmp_1', '$wtnop_1', '$whid', '$binid', '$subbinid', '$txtextnob', '$txtextqty', '$txtonop', '$wbnop_1', '$wbwt_1', '$wbinmp_1', '$dot', '$valupto', '$plantcode', '$mrpups', '$mrpgms')";
				if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
				{
					
				}
			}
		 $z1=$mainid;
		}
		//exit;
		echo "<script>window.location='add_packagingsliprps_preview.php?p_id=$z1'</script>";	
	}

	$sql_code="SELECT MAX(packaging_tcode) FROM tbl_rpspackaging where packaging_yearid='$yearid_id'  ORDER BY packaging_tcode DESC";
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
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Re-Printing Packaging slip</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="packagingsliprps.js"></script>
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
			if(document.getElementById(acc).value!="" && document.getElementById(acc).value!=0)
			{
				ycc++;
			}
			//else
			{ //alert(document.getElementById(nomp).value);
				if(document.getElementById(nomp).value!="" && document.getElementById(nomp).value!=0)
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
		if(xcc==0)
		{
			alert("No. of Master Pack cannot be ZERO");
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
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value);}
		} 
		//alert(y);
		if(y==x)
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
			if(document.frmaddDepartment.bpch.value>0)
			{
				alert("Balance Pouches not Linked");
				f=1;
				return false;
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
		showUser(a,'postingtable','mformsmc','','','','','');
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
			if(document.getElementById(acc).value!="" && document.getElementById(acc).value!=0)
			{
				ycc++;
			}
			//else
			{ //alert(document.getElementById(nomp).value);
				if(document.getElementById(nomp).value!="" && document.getElementById(nomp).value!=0)
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
		if(xcc==0)
		{
			alert("No. of Master Pack cannot be ZERO");
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
		if(y==x)
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
			if(document.frmaddDepartment.bpch.value>0)
			{
				alert("Balance Pouches not Linked");
				f=1;
				return false;
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
		showUser(a,'postingtable','mformsubedtsmc','','','','','');
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

document.getElementById("postingsubsubtable").innerHTML="<input name='protype' value='' type='hidden'>";
document.frmaddDepartment.txtlot1.value="";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var stage=document.frmaddDepartment.txtstage.value;
var tid=document.frmaddDepartment.maintrid.value;
var dop=document.frmaddDepartment.dopc.value;

winHandle=window.open('getuser_packagingsliprps_lotno.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid+'&dop='+dop,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function openslocpop1()
{
if(document.frmaddDepartment.qc.value=="")
{
 alert("Please Select QC.");
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
	{	
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

showUser(edtrecid,'postingsubtable','subformedtsmc','','','','','');
}
function getdetails(stage)
{
/*if(document.frmaddDepartment.txtlot2.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot2.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
if(document.frmaddDepartment.txt1.value=="")
	{
 alert("Please Select Mode Of Transit.");
 document.frmaddDepartment.txt1.focus();
}*/

var get=document.frmaddDepartment.txtlot1.value;
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var stage=document.frmaddDepartment.txtstage.value;

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
				/*else{
				alert(" Please Enter Corret Lot No.");
				}*/
		var crop=document.frmaddDepartment.txtcrop.value;
        var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
		var dsrn="";
		var stage=document.frmaddDepartment.txtstage.value;
		
		//document.getElementById("postingsubtable").style.display="block";
		showUser(get,'postingsubsubtable','getsmc',crop,variety,tid,lotid,dsrn,stage);
				//showUser(get,'postingsubtable','get',crop,variety,stage,'','');
}
function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','deletesmc',v2,'','','','');
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
	if(document.frmaddDepartment.txtpromech.value=="")
	{
		alert("Please Select Processing Machine Code");
		//document.frmaddDepartment.txtpromech.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtoprname.value=="")
	{
		alert("Please Select Operator Name");
		//document.frmaddDepartment.txtoprname.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		//document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDepartment.protype.value=="")
	{
		alert("Please click on Get Details");
		//document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}	
	
	//var a=formPost(document.getElementById('mainform'));
	//alert(a);
	//return false;
return true;	 
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
		
		var sno=document.frmaddDepartment.sno.value-1;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			
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
		
		var sno=document.frmaddDepartment.sno.value-1;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			
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
	
	
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.txtconqty.value);
	
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
			
			document.getElementById('nomp_'+[val12]).value=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
			
			var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
			
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
	var bv=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
	
	if(parseInt(balval) <= 0)
	{
		alert("No. of Master Pack cannot be ZERO");
		document.getElementById('nomp_'+[val12]).focus();
		document.getElementById('noofpacks_'+[val12]).value="";
		return false;
	}
	else if(parseInt(balval) > parseInt(bv))
	{
		alert("No. of Master Pack cannot be greater than "+bv);
		document.getElementById('nomp_'+[val12]).focus();
		document.getElementById('noofpacks_'+[val12]).value="";
		return false;
	}
	else
	{
		var upssize=document.frmaddDepartment.upssize.value.split(" ");
		var ptp=0;
		if(upssize[1]=="Gms")
		{
			ptp=parseFloat(upssize[0]/1000);
		}
		else
		{
			ptp=parseFloat(upssize[0]);
		}
		
		var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
		document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
		document.getElementById('balqty_'+[val12]).value=parseFloat(document.getElementById('noofpacks_'+[val12]).value)*parseFloat(ptp);
		document.getElementById('balqty_'+[val12]).value=parseFloat(document.getElementById('balqty_'+[val12]).value).toFixed(3);
		document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
		document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
		document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
		document.getElementById('dtail_'+[val12]).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Fill</a>";
	}
}
function pcksel(pkselval)
{ 
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
		
		var sno=document.frmaddDepartment.sno.value-1;
		for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			document.getElementById(det).innerHTML="Fill";
		}
		for(var j=1; j<=sno; j++)
		{
			
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
	var sno=document.frmaddDepartment.sno.value-1;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		
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
	var sno=document.frmaddDepartment.sno.value-1;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		
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
	var sno=document.frmaddDepartment.sno.value-1;
	for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		document.getElementById(det).innerHTML="Fill";
	}
	for(var j=1; j<=sno; j++)
	{
		
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
	
	var sno=document.frmaddDepartment.sno.value-1;
	
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
		var z=0; var xs=0;
		var sno=document.frmaddDepartment.sno.value-1;
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
		{ 
			var fet="nomp_"+xs;
			
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
		
		for(var i=1; i<=sno; i++)
		{
			//if(document.getElementById('fetchk_'+[i]).checked==true)
			{
				var d=parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval);
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
				var totextpouches=parseInt(document.getElementById('totextpouches_'+[i]).value);
				d=parseInt(d)+parseInt(totextpouches);
			}
		}
		
		if(document.getElementById('noppchs_'+[mpno]).value!="" && document.getElementById('noppchs_'+[mpno]).value > 0)
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
				var z=parseInt(document.getElementById('wtnop_'+[i]).value);
				var totextpouches=parseInt(document.getElementById('totextpouches_'+[i]).value);
				d=parseInt(d)+parseInt(totextpouches);
				
				//alert(mpval);alert(d);alert(dd);alert(npwt);alert(z);alert(totextpouches);
			}
		}
		if(mpval!="" && mpval > 0)
		{
		document.getElementById('noptpchs_'+[pchno]).value=parseInt(d)+parseInt(pchval);
		document.getElementById('noptqtys_'+[pchno]).value=(parseFloat(npwt)*parseFloat(pchval))+((parseFloat(d)/parseFloat(z))*parseFloat(dd));
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
		var lotno=document.frmaddDepartment.txtlot1.value;
		var txtpsrn=document.frmaddDepartment.txtpsrn.value;
		var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
		var ups=document.frmaddDepartment.upsidno.value;
		var sno=document.frmaddDepartment.sno.value;
		var bpch=0;
		for(var i=1; i<=sno; i++)
		{
			//if(document.getElementById('fetchk_'+[i]).checked==true)
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
	var lotno=document.frmaddDepartment.txtlot1.value;
	var txtpsrn=document.frmaddDepartment.txtpsrn.value;
	var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
	
	winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety+'&barcval='+barcval+'&slocssyncs='+slocssyncs,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mrpconv(mrpval)
{
	//var txtpktype=document.frmaddDepartment.txtpktype.value;
	//if(txtpktype=="Standard")
	//{
		var upssize=document.frmaddDepartment.upssize.value;
		//alert(upssize);
		var x=upssize.split(" ");
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
	/*}
	else
	{
		var upssize=document.frmaddDepartment.upsname_1.value;
		//alert(upssize);
		var x=upssize.split(" ");
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
	}*/
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Re-Printing Packaging slip&nbsp;<input type="hidden" name="logid" value="<?php echo $logid?>" /></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >

<?php
$sql_pdt=mysqli_query($link,"Select max(proslipmain_date) from tbl_proslipmain where plantcode='$plantcode' order by proslipmain_date desc") or die(mysqli_error($link));
$tot_pdt=mysqli_num_rows($sql_pdt);
$row_pdt=mysqli_fetch_array($sql_pdt);
?>	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
		 
		
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
  <td colspan="8" align="center" class="tblheading">Add Re-Printing Packaging slip</td>
</tr>
<tr height="15"><td colspan="8" align="right" class="smalltblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="25%"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $code1?></td>

<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction Date&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Indent&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="datesel('dopc')" tabindex="6"><img src="../images/cal.gif" border="0" align="absmiddle" /></a>&nbsp;<font color="#FF0000">*</font></td>
<td width="25%" align="right"  valign="middle" class="smalltblheading">Indent No / Packaging Slip Ref. No.&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrn" type="text" size="15" class="smalltbltext" tabindex=""    maxlength="15" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

  <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="152" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="166" align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>

	<td width="107" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="209" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1();" >
<option value="" selected>--Select Variety--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		<!--<td width="157" align="right" valign="middle" class="smalltblheading">Seed Stage&nbsp;</td>
<td width="165"  align="left" valign="middle" class="smalltbltext"  >&nbsp;Pack </td>-->
           </tr>
<?php
$sql_sel1="select * from tbl_rm_promac order by promac_type,promac_macid";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' and proopr_status='Active' order by proopr_fname") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
?>		   
<tr class="Light" height="30">
<td width="152" align="right" valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
<td  align="left" valign="middle" class="smalltbltext"  >&nbsp;<select class="smalltbltext" name="txtpromech" style="width:120px;" onChange="sschk2()">
    <option value="" selected>--Select--</option>
    <?php while($noticia_item1 = mysqli_fetch_array($res1)) { $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];?>
		<option value="<?php echo $noticia_item1['promac_id'];?>" />   
		<?php echo $num;?>
		<?php } ?>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
<td width="152" align="right" valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
<td width="209" align="left" valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtoprname" style="width:150px;" onChange="sschk3()">
    <option value="" selected>--Select--</option>
    <?php while($row_popr = mysqli_fetch_array($query_popr)) { ?>
		<option value="<?php echo $row_popr['proopr_id'];?>" />   
		<?php echo $row_popr['proopr_fname'];?> <?php echo $row_popr['proopr_lname']?>
		<?php } ?>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>

</tr>		   
<input type="hidden" name="txtstage" value="Pack" />
</table>
<br />

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="smalltbltext" style="border-color:#1dbe03">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="smalltblheading" style="border-color:#1dbe03">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>
</table>

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<div id="postingsubsubtable" style="display:block"> <input name="protype" value="" type="hidden"> </div>
</div></div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_packagingrps.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  
