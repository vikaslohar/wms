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
			
		//if(isset($_POST['txtremarks'])) { $txtremarks= $_POST['txtremarks']; }
			
		if(isset($_POST['maintrid'])) { $maintrid= $_POST['maintrid']; }
		if(isset($_POST['maintrid'])) { $maintrid= $_POST['maintrid']; }
		if(isset($_POST['sno3'])) { $sno3= $_POST['sno3']; }
		if(isset($_POST['loosepouches'])) { $loosepouches= $_POST['loosepouches']; }
		if(isset($_POST['pckloss'])) { $pckloss= $_POST['pckloss']; }
		if(isset($_POST['ccloss'])) { $ccloss= $_POST['ccloss']; }
		if(isset($_POST['totpckqtyp'])) { $totpckqtyp= $_POST['totpckqtyp']; }
		if(isset($_POST['totnop'])) { $totnop= $_POST['totnop']; }
		
		
			
		$z1=$maintrid;
				
		if($z1>0)
		{
		  	/*$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_id='".$maintrid."'") or die(mysqli_error($link));
			$row_tbl=mysqli_fetch_array($sql_tbl);*/
			$mainid=$maintrid;
			
			$sql_tblsub=mysqli_query($link,"select * from tbl_rpspackaging_sub where packaging_id='".$mainid."'") or die(mysqli_error($link));
			$row_tblsub=mysqli_fetch_array($sql_tblsub);
			$suid=$row_tblsub['packagingsub_id'];
			$upss=$row_tblsub['packagingsub_upssize'];
			$lotno=$row_tblsub['packagingsub_lotno'];
			
			$sql_psub="update tbl_rpspackaging_sub set packagingsub_ccqty='$ccloss', packagingsub_lossqty='$pckloss' where packagingsub_id ='$suid'";
			 $a123456=mysqli_query($link,$sql_psub) or die(mysqli_error($link));

			// $sql_psub="update tbl_pnpslipsub set pnpslipsub_packloss='$ccloss', pnpslipsub_packloss='$pckloss', pnpslipsub_packqty='$totpckqtyp', pnpslipsub_nop='$totnop'  where pnpslipsub_id ='$suid'";
			// $a123456=mysqli_query($link,$sql_psub) or die(mysqli_error($link));
			$sql_tblsubsub=mysqli_query($link,"DELETE from tbl_rpspackagingsub_sub where packaging_id='".$mainid."' and packagingsub_id='".$suid."'") or die(mysqli_error($link));
			//$row_tblsubsub=mysqli_fetch_array($sql_tblsubsub);
			
			$lotno=$row_tblsub['packaging_lotno'];
			$upss=$row_tblsub['packaging_upssize'];
			for($j=1; $j<=$sno3; $j++)
			{
				
				$txtwhgx="txtwhg".$j;
				$txtbingx="txtbing".$j;
				$txtsubbgx="txtsubbg".$j;
				$existviewx="existview".$j;
				$nopmpcsx="nopmpcs_".$j;
				$loosewbx="loosewb_".$j;
				$noppchsx="noppchs_".$j;
				$noptpchsx="noptpchs_".$j;
				$noptqtysx="noptqtys_".$j;
				if(isset($_POST[$txtwhgx])) { $txtwhg=$_POST[$txtwhgx]; }
				if(isset($_POST[$txtbingx])) { $txtbing=$_POST[$txtbingx]; }
				if(isset($_POST[$txtsubbgx])) { $txtsubbg=$_POST[$txtsubbgx]; }
				if(isset($_POST[$existviewx])) { $existview=$_POST[$existviewx]; }
				if(isset($_POST[$nopmpcsx])) { $nopmpcs=$_POST[$nopmpcsx]; }
				if(isset($_POST[$loosewbx])) { $loosewb=$_POST[$loosewbx]; }
				if(isset($_POST[$noppchsx])) { $noppchs=$_POST[$noppchsx]; }
				if(isset($_POST[$noptpchsx])) { $noptpchs=$_POST[$noptpchsx]; }
				if(isset($_POST[$noptqtysx])) { $noptqtys=$_POST[$noptqtysx]; }
				//echo $noptqtys;
				if($noptqtys!="" && $noptqtys>0)
				{
					$sql_subsub4="insert into tbl_rpspackagingsub_sub (packagingsub_id, packaging_id, packagingsubsub_wh, packagingsubsub_bin, packagingsubsub_subbin, packagingsubsub_lotno, packagingsubsub_upssize, packagingsubsub_nomp, packagingsubsub_nopch, packagingsubsub_totpch, packagingsubsub_totqty, plantcode, packagingsubsub_loosewb, packagingsubsub_loosenop) values ('$suid', '$mainid', '$txtwhg', '$txtbing', '$txtsubbg', '$lotno', '$upss', '$nopmpcs', '$noppchs', '$noptpchs', '$noptqtys', '$plantcode', '$loosewb', '$loosepouches')";
					mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
				}
			}
			
		
	 
		 $z1=$mainid;
		}
		//exit;
		
		$p_id=$z1;
		echo "<script>window.location='add_rpspackaginsloc_preview.php?p_id=$p_id'</script>";	
	}

	$sql_code="SELECT MAX(packaging_code) FROM tbl_rpspackaging where packaging_yearid='$yearid_id'  ORDER BY packaging_code DESC";
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
<title>Packaging - Transaction - Packing slip</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="packingslipwb.js"></script>
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
		document.getElementById(sbin).value=Math.round((parseFloat(document.getElementById(nob).value)-parseFloat(qtyval1))*100)/100;
		
		var q1="";
		var q2="";
		q1=document.frmaddDepartment.recqtyp1.value;
		if(document.frmaddDepartment.srno2.value>=2)
		{
			q2=document.frmaddDepartment.recqtyp2.value;
		}
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		
		document.getElementById('picqtyp').value=qtyg;
		document.getElementById('balpck').value=qtyg;
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
		alert("Please enter Packing Slip number.");
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
	if(document.frmaddDepartment.pcktype.value=="P")
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
	}
	
	if(f==1)
	{
		return false;
	}
	else
	{	
		/*var zzz=document.frmaddDepartment.sno.value;
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
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
				f=1;
				return false;
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
		//showUser(a,'postingtable','mform','','','','','');
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
		alert("Please enter Slip number.");
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
	if(document.frmaddDepartment.pcktype.value=="P")
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
		//var d=document.frmaddDepartment.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;if(g2=="")g2=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		var qtyd=parseFloat(g)+parseFloat(g2);
		
		if(parseFloat(qtyd)<parseFloat(qtyg))
		{
		alert("Please check. Total Quantity Picked for Packing is not matching with Total Quantity Available for Packing");
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
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
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
		showUser(a,'postingtable','mformsubedt','','','','','');
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
else if(document.frmaddDepartment.txtpacktype.value=="")
{
 alert("Please Select Pack Type");
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
winHandle=window.open('getuser_packslipwb_lotno.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid+'&dop='+dop,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
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
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
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
		var txtpacktype=document.frmaddDepartment.txtpacktype.value;
		//alert(tid);
		//alert(lotid);
		
		//document.getElementById("postingsubtable").style.display="block";
		showUser(get,'postingsubsubtable','get',crop,variety,tid,lotid,dsrn,stage,txtpacktype);
				//showUser(get,'postingsubtable','get',crop,variety,stage,'','');
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
	dt1=getDateObject(document.frmaddDepartment.date.value,"-");
	dt2=getDateObject(document.frmaddDepartment.dopc.value,"-");
	if(document.frmaddDepartment.gwupdflg.value=="" || document.frmaddDepartment.gwupdflg.value == 0) 
	{
		alert("Please update Master Pack Barcode Gross Weight.");
		f=1;
		return false;
	}
	if(f==1)
	{
		return false;
	}
	else
	{	
		
		
		var x=document.frmaddDepartment.sno3.value; var y=0; var zx=0;
		for(var j=1; j<=x; j++)
		{
			var a="noptqtys_"+j;
			//alert(document.getElementById(a).value);
			if(document.getElementById(a).value=="")
			{y++;}
			else
			{zx=parseFloat(zx)+parseFloat(document.getElementById(a).value)}
		}
		//alert(y);alert(x);
		if(y==x)
		{
			alert("Please select SLOC for Pack Seed");
			f=1;
			return false;
		}
		else
		{
			zx=parseFloat(zx).toFixed(3);
			document.frmaddDepartment.balpck.value=parseFloat(document.frmaddDepartment.balpck.value).toFixed(3);	
					
			if(parseFloat(zx)!=parseFloat(document.frmaddDepartment.balpck.value))
			{
				alert("Please check. Quantity in Pack Seed is not matching with Quantity distributed in Bins");
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
		return true;
		//showUser(a,'postingtable','mform','','','','','');
		//showUser(a,'postingsubtable','mform','','','','','');
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
		/*
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
		}*/
		/*document.getElementById('slsync').innerHTML="";*/
		/*document.getElementById('txtwhg1').value="";
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
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
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
		/*for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			//var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			//document.getElementById(det).innerHTML="Fill";
		}*/
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
			document.getElementById(c).value="";
			document.getElementById(d).value="";
			document.getElementById(e).value="";
			document.getElementById(f).value="";
			document.getElementById(g).checked=false;
			document.getElementById(h).value="";
			document.getElementById(i).value="";
			//document.getElementById(det).innerHTML="Fill";
			
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
		/*document.getElementById('slsync').innerHTML="";*/
		/*document.getElementById('txtwhg1').value="";
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
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
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
			document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
			document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
			//document.getElementById('dtail_'+[val12]).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Fill</a>";
			
			/*document.getElementById('slsync').innerHTML="";*/
			/*document.getElementById('txtwhg1').value="";
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
			document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
		}
		else
		{
			document.getElementById('nomp_'+[val12]).readOnly=true;
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('noofpacks_'+[val12]).value="";
			//document.getElementById('dtail_'+[val12]).innerHTML="Fill";
			document.frmaddDepartment.detmpbno.value="";
			
			/*document.getElementById('slsync').innerHTML="";*/
			/*document.getElementById('txtwhg1').value="";
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
			document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
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
			for (var i=2; i<=document.frmaddDepartment.srno2.value;i++)
			{
				document.getElementById('txtbalnobp'+[i]).value="";
				document.getElementById('recqtyp'+[i]).value="";
				document.getElementById('recqtyp'+[i]).readOnly=false;
				document.getElementById('recqtyp'+[i]).style.backgroundColor="#FFFFFF";
				document.getElementById('txtbalqtyp'+[i]).value="";
			}
			document.getElementById('picqtyp').value="";
			document.getElementById('balpck').value="";
			var sltn=document.frmaddDepartment.txtlot1.value;
			showUser(sltn,'pltno','pltnonew','','','','','');
		}
		else
		{
			var sltn=document.frmaddDepartment.txtlot1.value.split("");
			var cltn=sltn[0]+sltn[1]+sltn[2]+sltn[3]+sltn[4]+sltn[5]+sltn[6]+sltn[7]+sltn[8]+sltn[9]+sltn[10]+sltn[11]+sltn[12]+sltn[13]+sltn[14]+sltn[15]+"P";
			document.frmaddDepartment.txtplotno.value=cltn;
			document.getElementById('txtbalnobp1').value=0;
			document.getElementById('recqtyp1').value=document.getElementById('txtextqty1').value;
			document.getElementById('recqtyp1').readOnly=true;
			document.getElementById('recqtyp1').style.backgroundColor="#CCCCCC";
			document.getElementById('txtbalqtyp1').value=0;
			var val2=0.00;
			for (var i=2; i<=document.frmaddDepartment.srno2.value;i++)
			{
				document.getElementById('txtbalnobp'+[i]).value=0;
				document.getElementById('recqtyp'+[i]).value=document.getElementById('txtextqty'+[i]).value;
				document.getElementById('recqtyp'+[i]).readOnly=true;
				document.getElementById('recqtyp'+[i]).style.backgroundColor="#CCCCCC";
				document.getElementById('txtbalqtyp'+[i]).value=0;
				val2=parseFloat(val2)+parseFloat(document.getElementById('txtextqty'+[i]).value);
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
		/*for(var i=1; i<=sno; i++)
		{
			var fet="fetchk_"+i;
			//var det="dtail_"+i;
			document.getElementById(fet).checked=false;
			//document.getElementById(det).innerHTML="Fill";
		}*/
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
		/*document.getElementById('slsync').innerHTML="";*/
		/*document.getElementById('txtwhg1').value="";
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
		document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
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
	var nopc="nopc_"+val2;
	var domcs="domcs_"+val2;
	if(document.getElementById(nopc).value=="" || document.getElementById(nopc).value==0)
	{
		alert("No. of Pouches cannot be Blank");
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
	/*for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		//var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		//document.getElementById(det).innerHTML="Fill";
	}*/
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
		document.getElementById(c).value="";
		document.getElementById(d).value="";
		document.getElementById(e).value="";
		document.getElementById(f).value="";
		document.getElementById(g).checked=false;
		document.getElementById(h).value="";
		document.getElementById(i).value="";
		//document.getElementById(det).innerHTML="Fill";
		
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
	/*document.getElementById('slsync').innerHTML="";*/
	/*document.getElementById('txtwhg1').value="";
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
	document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
}


function pfpchk12(pfpval)
{
	if(document.getElementById('picqtyp').value=="" || document.getElementById('picqtyp').value==0)
	{
		alert("Quantity Picked for Packing cannot be blank or Zero");
		document.getElementById('loosepouches').value="";
		return false;
	}
	else
	{
		var sltn=document.frmaddDepartment.upss.value.split(" ");
		var pchqty=parseFloat(sltn[0])*parseFloat(pfpval);
		var balpck=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('ccloss').value)+parseFloat(document.getElementById('pckloss').value));
		if(parseFloat(balpck)>parseFloat(document.getElementById('picqtyp').value))
		{
			alert("Balance Packing Quantity cannot be more than Picked for Packing Qty");
			document.getElementById('loosepouches').value="";
			return false;
		}
		else
		{
			document.getElementById('balpck').value=parseFloat(balpck);
			document.getElementById('balpck').value=parseFloat(document.getElementById('balpck').value).toFixed(3);
		}
	}
	var sno=document.frmaddDepartment.sno.value;
	/*for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		//var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		//document.getElementById(det).innerHTML="Fill";
	}*/
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
		var sltn=document.frmaddDepartment.upss.value.split(" ");
		var pchqty=parseFloat(sltn[0])*parseFloat(document.getElementById('loosepouches').value);
		var balpck=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('ccloss').value)+parseFloat(pfpval));
		
	//	document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(document.getElementById('ccloss').value)+parseFloat(document.getElementById('pckloss').value)+parseFloat(pfpval));
		//document.getElementById('balpck').value=parseFloat(document.getElementById('balpck').value).toFixed(3);
		if(parseFloat(balpck)>parseFloat(document.getElementById('picqtyp').value))
		{
			alert("Balance Packing Quantity cannot be more than Picked for Packing Qty");
			document.getElementById('pckloss').value="";
			return false;
		}
		else
		{
			document.getElementById('balpck').value=parseFloat(balpck);
			document.getElementById('balpck').value=parseFloat(document.getElementById('balpck').value).toFixed(3);
		}
		
	}
	var sno=document.frmaddDepartment.sno.value;
	/*for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		//var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		//document.getElementById(det).innerHTML="Fill";
	}*/
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
		document.getElementById('balpck').value=parseFloat(document.getElementById('balpck').value).toFixed(3);
	}
	var sno=document.frmaddDepartment.sno.value;
	/*for(var i=1; i<=sno; i++)
	{
		var fet="fetchk_"+i;
		//var det="dtail_"+i;
		document.getElementById(fet).checked=false;
		//document.getElementById(det).innerHTML="Fill";
	}*/
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
	
	/*document.getElementById('slsync').innerHTML="";*/
	/*document.getElementById('txtwhg1').value="";
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
	document.getElementById('noptqtys_8').style.backgroundColor="#cccccc";*/
}
function clk(snoval,upsid)
{
	//alert(snoval);
	var sno=document.frmaddDepartment.sno.value;
	//alert(sno);
	if(document.frmaddDepartment.picqtyp.value=="")
	{
		alert("Picked for packing Qty cannot be blank.");
		document.getElementById(upsval).value="";
		//document.frmaddDepartment.ccloss.focus();
		return false;
	}
	else if(document.frmaddDepartment.pchccqty.value=="")
	{
		alert("Pouch Captive Consumption Qty cannot be blank.");
		document.getElementById(upsval).value="";
		//document.frmaddDepartment.ccloss.focus();
		return false;
	}
	else
	{
		if(snoval>0)
		{
			var upsname="upsname_"+snoval;
			document.frmaddDepartment.upssize.value=snoval;
			document.frmaddDepartment.upsidno.value=upsid;
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
		//var fet="fetchk_"+i;
		//if(document.getElementById(fet).checked==true)
		dval=i;
	}
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
			var mpck="mpck_"+dval;
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
			}
		}
	}
}

function uploadgw()
{
	var tid=document.frmaddDepartment.maintrid.value;
	var subtid=document.frmaddDepartment.subtrid.value;
	
	winHandle=window.open('getuser_pronpslip_barcode_gwupdrps.php?tid='+tid+'&subtid='+subtid,'WelCome','top=170,left=180,width=450,height=450,scrollbars=yes');
				if(winHandle==null){
				alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}


function wh(wh1val, whno)
{ 	//alert(wh1val);
	//alert(whno);
	if(document.frmaddDepartment.gwupdflg.value=="" || document.frmaddDepartment.gwupdflg.value == 0) 
	{
		alert("Please update Master Pack Barcode Gross Weight.");
		return false;
	}
	if(whno>1)
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
	document.getElementById('nopmpcs_'+[whno]).value='';
	document.getElementById('loosewb_'+[whno]).value='';
	document.getElementById('noppchs_'+[whno]).value='';
	document.getElementById('noptpchs_'+[whno]).value='';
	document.getElementById('noptqtys_'+[whno]).value='';
	
	document.getElementById('txtbing'+[whno]).value='';
	document.getElementById('txtbing'+[whno]).selectedIndex =0;
	document.getElementById('txtsubbg'+[whno]).value='';
	document.getElementById('txtsubbg'+[whno]).selectedIndex =0;	

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
		document.getElementById('nopmpcs_'+[binno]).value='';
		document.getElementById('loosewb_'+[binno]).value='';
		document.getElementById('noppchs_'+[binno]).value='';
		document.getElementById('noptpchs_'+[binno]).value='';
		document.getElementById('noptqtys_'+[binno]).value='';
		
		document.getElementById('txtsubbg'+[binno]).value='';
		document.getElementById('txtsubbg'+[binno]).selectedIndex =0;
		
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
		document.getElementById('nopmpcs_'+[subbinno]).value='';
		document.getElementById('loosewb_'+[subbinno]).value='';
		document.getElementById('noppchs_'+[subbinno]).value='';
		document.getElementById('noptpchs_'+[subbinno]).value='';
		document.getElementById('noptqtys_'+[subbinno]).value='';
		
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
		setTimeout(function() { sloccomment(rval); },800);
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
	//alert(mpval); alert(mpno);
	if(document.getElementById('txtsubbg'+[mpno]).value=="")
	{
		alert("Please Select Subbin first");
		document.getElementById('nopmpcs_'+[mpno]).value='';
		document.getElementById('loosewb_'+[mpno]).value='';
		document.getElementById('noppchs_'+[mpno]).value='';
		document.getElementById('noptpchs_'+[mpno]).value='';
		document.getElementById('noptqtys_'+[mpno]).value='';
		return false;
	}
	else 
	{
		var wbwt=document.frmaddDepartment.wbwt.value;
		var loosewbval=document.getElementById('loosewb_'+[mpno]).value;
//alert(parseInt(loosewbval));
		if(loosewbval=="" || loosewbval=="NAN" || loosewbval=="NaN"){loosewbval=0;}
		if(parseInt(loosewbval)>0)
		{
			var wbqty=parseFloat(wbwt)*parseFloat(loosewbval);
		}
		else
		{
			var wbqty=0;
		}
		var sno=document.frmaddDepartment.sno.value;
		for(var i=1; i<=sno; i++)
		{;
			//alert(parseInt(document.getElementById('wbnop_'+[i]).value));	alert(parseInt(mpval));	alert(parseInt(document.getElementById('wbnop_'+[i]).value));	alert(parseInt(loosewbval));			
			var d=(parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval))+(parseInt(document.getElementById('wbnop_'+[i]).value)*parseInt(loosewbval));
			var dd=document.getElementById('wtmp_'+[i]).value;
			var npwt=document.getElementById('wtnopkg_'+[i]).value;
		}
		//alert(mpno);alert(mpval);alert(d);alert(dd);alert(npwt);
		if(document.getElementById('noppchs_'+[mpno]).value!="" && parseInt(document.getElementById('noppchs_'+[mpno]).value)>0)
		{
			document.getElementById('noptpchs_'+[mpno]).value=parseInt(d)+parseInt(document.getElementById('noppchs_'+[mpno]).value);
			document.getElementById('noptqtys_'+[mpno]).value=(parseFloat(npwt)*parseFloat(document.getElementById('noppchs_'+[mpno]).value))+(parseFloat(mpval)*parseFloat(dd))+parseFloat(wbqty);
			document.getElementById('noptqtys_'+[mpno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		}
		else
		{
			document.getElementById('noptpchs_'+[mpno]).value=parseInt(d);
			document.getElementById('noptqtys_'+[mpno]).value=parseFloat(mpval)*parseFloat(dd)+parseFloat(wbqty);
			document.getElementById('noptqtys_'+[mpno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[mpno]).value)*1000)/1000;
		}
	}
}

function pacpchchk(pchval, pchno)
{	//alert(pchno);
	if(document.getElementById('txtsubbg'+[pchno]).value=="")
	{
		alert("Please Select Subbin first");
		document.getElementById('nopmpcs_'+[pchno]).value='';
		document.getElementById('loosewb_'+[pchno]).value='';
		document.getElementById('noppchs_'+[pchno]).value='';
		document.getElementById('noptpchs_'+[pchno]).value='';
		document.getElementById('noptqtys_'+[pchno]).value='';
		return false;
	}
	else
	{
		var wbwt=document.frmaddDepartment.wbwt.value;
		var loosewbval=document.getElementById('loosewb_'+[pchno]).value;
		if(loosewbval=="" || loosewbval=="NAN" || loosewbval=="NaN"){loosewbval=0;}
		if(parseInt(loosewbval)>0)
		{
			var wbqty=parseFloat(wbwt)*parseFloat(loosewbval);
		}
		else
		{
			var wbqty=0;
		}
		var sno=document.frmaddDepartment.sno.value;
		var mpval=document.getElementById('nopmpcs_'+[pchno]).value;
		for(var i=1; i<=sno; i++)
		{
				var d=(parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval))+(parseInt(document.getElementById('wbnop_'+[i]).value)*parseInt(loosewbval));
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
		}
		//alert(pchval);alert(mpval);alert(d);alert(dd);alert(npwt);
		if(mpval!="")
		{
			document.getElementById('noptpchs_'+[pchno]).value=parseInt(d)+parseInt(pchval);
			document.getElementById('noptqtys_'+[pchno]).value=(parseFloat(npwt)*parseFloat(pchval))+(parseFloat(mpval)*parseFloat(dd))+parseFloat(wbqty);
			document.getElementById('noptqtys_'+[pchno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
		}
		else
		{
			document.getElementById('noptpchs_'+[pchno]).value=parseInt(pchval);
			document.getElementById('noptqtys_'+[pchno]).value=parseFloat(npwt)*parseFloat(pchval)+parseFloat(wbqty);
			document.getElementById('noptqtys_'+[pchno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[pchno]).value)*1000)/1000;
		}
		//document.frmaddDepartment.linkpch.value=parseInt(document.frmaddDepartment.linkpch.value)+parseInt(pchval);
		
		//document.frmaddDepartment.bpch.value=parseInt(document.frmaddDepartment.extbpch.value)-parseInt(document.frmaddDepartment.linkpch.value);
		//if(parseInt(document.frmaddDepartment.linkpch.value) > parseInt(document.frmaddDepartment.extbpch.value))document.frmaddDepartment.linkpch.value=0;
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
		var lotno=document.frmaddDepartment.txtplotno.value;
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
	var lotno=document.frmaddDepartment.txtplotno.value;
	var txtpsrn=document.frmaddDepartment.txtpsrn.value;
	var slocssyncs=document.frmaddDepartment.slocssyncs24.value;
	
	winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety+'&slocssyncs='+slocssyncs,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function cnonzchk(nobval, snval)
{
	var txtbalnobp="txtbalnobp"+snval;
	var txtbalqtyp="txtbalqtyp"+snval;
	if(parseFloat(document.getElementById(txtbalqtyp).value) > 0 && parseInt(document.getElementById(txtbalnobp).value)==0)
	{
		alert("NoB cannot be Zero");
		document.getElementById(txtbalnobp).value="";
		document.getElementById(txtbalnobp).focus();
		return false;
	}
}

function qctpchk(qtval)
{
	document.frmaddDepartment.qcdttype.value=qtval;
	document.frmaddDepartment.validityupto.value="";
	document.frmaddDepartment.valdays.value="";
	document.frmaddDepartment.validityperiod.value="";
	document.frmaddDepartment.validityperiod.selectedIndex=0;
	
	if(qtval=="")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot1.value;
	else if(qtval=="")
		document.frmaddDepartment.qctestdate.value=document.frmaddDepartment.qcdot2.value;
	else
		document.frmaddDepartment.qctestdate.value="";
}

function ptselect(ptval)
{
	document.frmaddDepartment.txtpacktype.value=ptval;
}




function upck(upval, snoval)
{
	var upsval="upsval_"+snoval;
	if(document.frmaddDepartment.picqtyp.value=="")
	{
		alert("Picked for packing Qty cannot be blank.");
		document.getElementById(upsval).value="";
		//document.frmaddDepartment.ccloss.focus();
		return false;
	}
	else if(document.frmaddDepartment.pchccqty.value=="")
	{
		alert("Pouch Captive Consumption Qty cannot be blank.");
		document.getElementById(upsval).value="";
		//document.frmaddDepartment.ccloss.focus();
		return false;
	}
	else
	{
		
		var upssizetyp="upssizetyp_"+snoval;
		var upsname="upsname_"+snoval;
		var packqty="packqty_"+snoval;
		var nopc="nopc_"+snoval;
		var nopinwb="nopinwb_"+snoval;
		var wbwts="wbwts_"+snoval;
		var mpwts="mpwts_"+snoval;
		var nomp="nomp_"+snoval;
		var nowbinmp="nowbinmp_"+snoval;
		
		
		document.getElementById(nopinwb).value="";
		document.getElementById(wbwts).value="";
		document.getElementById(mpwts).value="";
		document.getElementById(nomp).value="";
		document.getElementById(nowbinmp).value="";
		
		var wtnopkg="wtnopkg_"+snoval;
		if(document.getElementById(upsval).value=="")
		{
			alert("Please enter UPS");
			document.getElementById(upssizetyp).value="";
			document.getElementById(upsname).value="";
			document.getElementById(nopc).value="";
			document.getElementById(nopinwb).value="";
			document.getElementById(wbwts).value="";
			//document.getElementById(mpck).checked=false;
			document.getElementById(mpwts).value="";
			document.getElementById(nomp).value="";
			document.getElementById(wtnopkg).value="";
			document.getElementById(nowbinmp).value="";
			//document.frmaddDepartment.extbpch.value=0;
			document.getElementById(upsval).focus();
			return false;
		}
		else if(parseFloat(document.getElementById(upsval).value)<1)
		{
			alert("UPS cannot be Zero(0) or less i.e. 0.1 not allowed");
			document.getElementById(upssizetyp).value="";
			document.getElementById(upsname).value="";
			document.getElementById(nopc).value="";
			document.getElementById(nopinwb).value="";
			document.getElementById(wbwts).value="";
			//document.getElementById(mpck).checked=false;
			document.getElementById(mpwts).value="";
			document.getElementById(nomp).value="";
			document.getElementById(wtnopkg).value="";
			document.getElementById(nowbinmp).value="";
			//document.frmaddDepartment.extbpch.value=0;
			document.getElementById(upsval).focus();
			return false;
		}
		else
		{
			var z="000";
			var val=upval.split(".");
			//alert(val.length);
			//alert(val);
			if(val.length>1)
			{
			if(val[1]<=0 || val[1]=="undefined")
				z="000";
			else
				z=val[1];
			}
			
			//alert(z);
			var d=val[0]+"."+z;
			d=parseFloat(d).toFixed(3);
			//alert(d);
			document.getElementById(upsval).value=d;
			
			
			if(document.getElementById(upssizetyp).value!="")
			{
				document.getElementById(upsval).value=parseFloat(document.getElementById(upsval).value).toFixed(3);
				document.getElementById(upsname).value=document.getElementById(upsval).value+" "+document.getElementById(upssizetyp).value;
				
				var needle=document.getElementById(upsname).value;
				var haystack=document.frmaddDepartment.polup.value.split(",");
				var length = haystack.length;
				var r=0;
				for(var i = 0; i < length; i++) 
				{
					if(haystack[i] == needle) r++;
				}
				
				document.getElementById(packqty).value=parseFloat(document.getElementById('balpck').value);
				
				var pt="";
				if(upval=="Gms")
				{
					pt=(1000/parseFloat(document.getElementById(upsval).value));
					document.getElementById(nopc).value=parseFloat(document.getElementById(packqty).value)*parseFloat(pt);
					document.getElementById(wtnopkg).value=document.getElementById(upsval).value/1000;
					//document.frmaddDepartment.extbpch.value=document.getElementById(nopc).value;
				}
				else
				{
					pt=document.getElementById(upsval).value;
					document.getElementById(nopc).value=parseFloat(document.getElementById(packqty).value)/parseFloat(pt);
					document.getElementById(wtnopkg).value=document.getElementById(upsval).value;
					//document.frmaddDepartment.extbpch.value=document.getElementById(nopc).value;
				}
				
				var nps=document.getElementById(nopc).value.split(".");
				if(parseFloat(nps[1]) > 0)
				{
					alert("Check Qty. entered. Quantity entered is not convertible into whole number of pouches, as per given UPS.");
					document.getElementById(upssizetyp).value="";
					document.getElementById(upsname).value="";
					document.getElementById(nopc).value="";
					document.getElementById(nopinwb).value="";
					document.getElementById(wbwts).value="";
					document.getElementById(mpck).checked=false;
					document.getElementById(mpwts).value="";
					document.getElementById(nomp).value="";
					document.getElementById(wtnopkg).value="";
					document.getElementById(nowbinmp).value="";
					//document.frmaddDepartment.extbpch.value=0;
					document.getElementById(upsval).focus();
					return false;
				}
				
				
			}
		}
	}
}
function updmerg(upval, snoval)
{
	var upsval="upsval_"+snoval;
	var upssizetyp="upssizetyp_"+snoval;
	var upsname="upsname_"+snoval;
	var packqty="packqty_"+snoval;
	var nopc="nopc_"+snoval;
	var nopinwb="nopinwb_"+snoval;
	var wbwts="wbwts_"+snoval;
	var mpwts="mpwts_"+snoval;
	var nomp="nomp_"+snoval;
	var nowbinmp="nowbinmp_"+snoval;
	
	
	document.getElementById(nopinwb).value="";
	document.getElementById(wbwts).value="";
	document.getElementById(mpwts).value="";
	document.getElementById(nomp).value="";
	//document.getElementById(wtnopkg).value="";
	document.getElementById(nowbinmp).value="";
	
	var wtnopkg="wtnopkg_"+snoval;
	if(document.getElementById(upsval).value=="")
	{
		alert("Please enter UPS");
		document.getElementById(upssizetyp).value="";
		document.getElementById(upsname).value="";
		document.getElementById(nopc).value="";
		document.getElementById(nopinwb).value="";
		document.getElementById(wbwts).value="";
		document.getElementById(mpck).checked=false;
		document.getElementById(mpwts).value="";
		document.getElementById(nomp).value="";
		document.getElementById(wtnopkg).value="";
		document.getElementById(nowbinmp).value="";
		document.getElementById(upsval).focus();
		return false;
	}
	else
	{
		document.getElementById(upsval).value=parseFloat(document.getElementById(upsval).value).toFixed(3);
		document.getElementById(upsname).value=document.getElementById(upsval).value+" "+document.getElementById(upssizetyp).value;
				
		var needle=document.getElementById(upsname).value;
		var haystack=document.frmaddDepartment.polup.value.split(",");
		var length = haystack.length;
		
		var r=0;
		for(var i = 0; i < length; i++) 
		{
			if(haystack[i] == needle) r++;
		}
			
		document.getElementById(packqty).value=parseFloat(document.getElementById('balpck').value);
		var pt="";
		if(upval=="Gms")
		{
			pt=(1000/parseFloat(document.getElementById(upsval).value));
			document.getElementById(nopc).value=parseFloat(document.getElementById(packqty).value)*parseFloat(pt);
			document.getElementById(wtnopkg).value=document.getElementById(upsval).value/1000;
			//document.frmaddDepartment.extbpch.value=document.getElementById(nopc).value;
		}
		else
		{
			pt=document.getElementById(upsval).value;
			document.getElementById(nopc).value=parseFloat(document.getElementById(packqty).value)/parseFloat(pt);
			document.getElementById(wtnopkg).value=document.getElementById(upsval).value;
			//document.frmaddDepartment.extbpch.value=document.getElementById(nopc).value;
		}
		document.getElementById(nopc).value=parseFloat(document.getElementById(nopc).value).toFixed(3);
		var nps=document.getElementById(nopc).value.split(".");
		document.getElementById(nopc).value=parseInt(document.getElementById(nopc).value);
		if(parseFloat(nps[1]) > 0)
		{
			alert("Check Qty. entered. Quantity entered is not convertible into whole number of pouches, as per given UPS.");
			document.getElementById(upssizetyp).value="";
			document.getElementById(upsname).value="";
			document.getElementById(nopc).value="";
			document.getElementById(nopinwb).value="";
			document.getElementById(wbwts).value="";
			document.getElementById(mpck).checked=false;
			document.getElementById(mpwts).value="";
			document.getElementById(nomp).value="";
			document.getElementById(wtnopkg).value="";
			document.getElementById(nowbinmp).value="";
			document.getElementById(upsval).focus();
			return false;
		}
		
		
	}
}

function calnopinwb(nopwbval)
{
	//alert(nopwbval);
	var snoval=1;
	var upsval="upsval_"+snoval;
	var upssizetyp="upssizetyp_"+snoval;
	var upsname="upsname_"+snoval;
	var packqty="packqty_"+snoval;
	var nopc="nopc_"+snoval;
	var nopinwb="nopinwb_"+snoval;
	var wbwts="wbwts_"+snoval;
	var mpwts="mpwts_"+snoval;
	var nomp="nomp_"+snoval;
	var nowbinmp="nowbinmp_"+snoval;
	
	//alert(document.getElementById(upsval).value);
	//alert(document.getElementById(upssizetyp).value);
	//alert(document.getElementById(packqty).value);
	
	if(document.getElementById(upssizetyp).value=="Gms")
	{
		document.getElementById(wbwts).value=parseFloat(document.getElementById(upsval).value)*parseFloat(nopwbval);
		document.getElementById(wbwts).value=parseFloat(document.getElementById(wbwts).value)/1000;
	}
	else
	{
		document.getElementById(wbwts).value=parseFloat(document.getElementById(upsval).value)*parseFloat(nopwbval);
	}
	if(document.getElementById(mpwts).value!="")
	{
		document.getElementById(nowbinmp).value=parseFloat(document.getElementById(mpwts).value)/parseFloat(document.getElementById(wbwts).value);
		//document.getElementById(wbwts).value=parseFloat(document.getElementById(wbwts).value)/1000;
	}
	
}

function bnpchk(val1, val12)
{
	document.getElementById('nowbinmp_'+[val12]).value='';
	document.getElementById('nomp_'+[val12]).value='';
	if(document.getElementById('mpwts_'+[val12]).value != "")
	{
		document.getElementById('mpwts_'+[val12]).readOnly=false;
		document.getElementById('mpwts_'+[val12]).style.backgroundColor="#ffffff";
			
		var upsval="upsval_"+val12;
		var upssizetyp="upssizetyp_"+val12;
		var mpwts="mpwts_"+val12;
		if(document.getElementById(upssizetyp).value=="Gms")
		{
			var n=document.getElementById(upsval).value;
			var cx=document.getElementById(upsval).value/1000;
		}
		else
		{
			var n=document.getElementById(upsval).value*1000;
			var cx=document.getElementById(upsval).value;
		}
		var needle=document.getElementById(mpwts).value;
		var haystack=document.frmaddDepartment.polwtmp.value.split(",");
		var needle1=document.getElementById(upsval).value+' '+document.getElementById(upssizetyp).value;
		var haystack1=document.frmaddDepartment.polup.value.split(",");
		var length = haystack.length;
		var r=0;
		for(var i = 0; i < length; i++) 
		{
			if(haystack1[i] == needle1)
			{
			if(haystack[i] == needle) r++;
			}
		}
		
		if(r > 0)
		{
			alert("Standard Master Pack Size is available for the entered UPS");
			document.getElementById('mpwts_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nowbinmp_'+[val12]).value="";
			//document.getElementById('dtail_'+[val12]).innerHTML="Fill";
			//document.frmaddDepartment.detmpbno.value="";
			return false;
		}	
		
		var nop=parseFloat(val1)*parseFloat(1000/n);
		var wtm=parseFloat(cx)*parseFloat(nop);
		var nzzz=Math.round(nop*100)/100;
		var zz=nzzz+'';
		var zzz=zz.split(".");
		if(zzz[1] > 0)
		{
			alert("Enter Valid Wt. in Master Pack.\nPouch can not be fractional")
			document.getElementById('mpwts_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nowbinmp_'+[val12]).value="";
			//document.getElementById('dtail_'+[val12]).innerHTML="Fill";
			//document.frmaddDepartment.detmpbno.value="";
			return false;
		}
		else
		{
			document.getElementById('wtnop_'+[val12]).value=nop;
			document.getElementById('wtmp_'+[val12]).value=wtm;
			document.getElementById('wtnopkg_'+[val12]).value=cx;
		}
		
		document.getElementById('nomp_'+[val12]).value=Math.floor(parseFloat(document.getElementById('packqty_'+[val12]).value)/parseFloat(document.getElementById('wtmp_'+[val12]).value));
		
		document.getElementById('nowbinmp_'+[val12]).value=parseFloat(document.getElementById('mpwts_'+[val12]).value)/parseFloat(document.getElementById('wbwts_'+[val12]).value);
		
		var val=document.getElementById('nowbinmp_'+[val12]).value.split(".");
		//alert(val.length);
		//alert(val);
		if(val.length>1)
		{
			alert("Total Window Box in 1 Master Pack cannot be in decimals");
			document.getElementById('mpwts_'+[val12]).value="";
			document.getElementById('nomp_'+[val12]).value="";
			document.getElementById('nowbinmp_'+[val12]).value="";
		}
		//var balnop=parseInt(document.getElementById('nomp_'+[val12]).value)*parseInt(document.getElementById('wtnop_'+[val12]).value);
		
		//document.getElementById('noofpacks_'+[val12]).value=parseInt(document.getElementById('nopc_'+[val12]).value)-parseInt(balnop);
		//document.frmaddDepartment.nopks.value=document.getElementById('noofpacks_'+[val12]).value;
		//document.frmaddDepartment.extbpch.value=document.getElementById('noofpacks_'+[val12]).value;
		//document.frmaddDepartment.bpch.value=document.getElementById('noofpacks_'+[val12]).value;
		//document.getElementById('dtail_'+[val12]).innerHTML="<a href='Javascript:void(0)' onclick='detailspop()'>Fill</a>";
	}
	else
	{
		//document.getElementById('nomp_'+[val12]).readOnly=true;
		//document.getElementById('nomp_'+[val12]).value="";
		//document.getElementById('nomp_'+[val12]).style.backgroundColor="#cccccc";
		document.getElementById('nomp_'+[val12]).value="";
		document.getElementById('nowbinmp_'+[val12]).value="";
		//document.getElementById('dtail_'+[val12]).innerHTML="Fill";
		//document.frmaddDepartment.detmpbno.value="";
	}
}
function loosewbchk(loosewbval, srno)
{
	//alert(srno);
	var wbwt=document.frmaddDepartment.wbwt.value;
	if(loosewbval=="" || loosewbval=="NAN" || loosewbval=="NaN"){loosewbval=0;}
	if(parseInt(loosewbval)>0)
	{
		var wbqty=parseFloat(wbwt)*parseFloat(loosewbval);
	}
	else
	{
		var wbqty=0;
	}
	if(document.getElementById('txtsubbg'+[srno]).value=="")
	{
		alert("Please Select Subbin first");
		document.getElementById('nopmpcs_'+[srno]).value='';
		document.getElementById('loosewb_'+[srno]).value='';
		document.getElementById('noppchs_'+[srno]).value='';
		document.getElementById('noptpchs_'+[srno]).value='';
		document.getElementById('noptqtys_'+[srno]).value='';
		return false;
	}
	else
	{
		var sno=document.frmaddDepartment.sno.value;
		var mpval=document.getElementById('nopmpcs_'+[srno]).value;
		var pchval=document.getElementById('noppchs_'+[srno]).value;
		if(mpval==""){mpval=0;}
		if(pchval==""){pchval=0;}
		
		for(var i=1; i<=sno; i++)
		{
				var d=(parseInt(document.getElementById('wtnop_'+[i]).value)*parseInt(mpval))+(parseInt(document.getElementById('wbnop_'+[i]).value)*parseInt(loosewbval));
				var dd=document.getElementById('wtmp_'+[i]).value;
				var npwt=document.getElementById('wtnopkg_'+[i]).value;
		}
		//alert(pchval);alert(mpval);alert(d);alert(dd);alert(npwt);
		if(mpval!="")
		{
			document.getElementById('noptpchs_'+[srno]).value=parseInt(d)+parseInt(pchval);
			document.getElementById('noptqtys_'+[srno]).value=(parseFloat(npwt)*parseFloat(pchval))+(parseFloat(mpval)*parseFloat(dd))+parseFloat(wbqty);
			document.getElementById('noptqtys_'+[srno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[srno]).value)*1000)/1000;
		}
		else
		{
			document.getElementById('noptpchs_'+[srno]).value=parseInt(pchval);
			document.getElementById('noptqtys_'+[srno]).value=parseFloat(npwt)*parseFloat(pchval)+parseFloat(wbqty);
			document.getElementById('noptqtys_'+[srno]).value=Math.round(parseFloat(document.getElementById('noptqtys_'+[srno]).value)*1000)/1000;
		}
		//document.frmaddDepartment.linkpch.value=parseInt(document.frmaddDepartment.linkpch.value)+parseInt(pchval);
		
		//document.frmaddDepartment.bpch.value=parseInt(document.frmaddDepartment.extbpch.value)-parseInt(document.frmaddDepartment.linkpch.value);
		//if(parseInt(document.frmaddDepartment.linkpch.value) > parseInt(document.frmaddDepartment.extbpch.value))document.frmaddDepartment.linkpch.value=0;
	}
	//document.getElementById('loosewb_'+[srno]).value=(loosewbval*wbwt);
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Re-Printing Packaging slip - SLOC&nbsp;<input type="hidden" name="logid" value="<?php echo $logid?>" /></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="maintrid" value="<?php echo $pid?>" />
	<input type="hidden" name="subtrid" value="0" />	 
		

<?php
$tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_rpspackaging where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
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
	
	$sql_tblsub=mysqli_query($link,"select * from tbl_rpspackaging_sub where plantcode='$plantcode' and packaging_id='".$tid."'") or die(mysqli_error($link));
	$row_tblsub=mysqli_fetch_array($sql_tblsub);
	
	
	if($row_tbl['packaging_dop']!=NULL)
	{ $tdate2=$row_tbl['packaging_dop']; }
	else{ $tdate2=$row_tblsub['packagingsub_dop']; }
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
	
	if($tdate2=="0000-00-0000" || $tdate2=="0000-00-00") {$tdate2=$tdate;}

$subtid=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Re-Printing Packaging slip - SLOC</td>
</tr>
<tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="25%"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['packaging_code']."/".$row_tbl['packaging_yearid']."/".$row_tbl['packaging_logid'];?></td>

<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="25%" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Packaging&nbsp;</td>
<td width="25%" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="25%" align="right"  valign="middle" class="smalltblheading">Packaging Slip Ref. No.&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['packaging_slipno'];?>" maxlength="15" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['packaging_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td width="25%" align="right"  valign="middle" class="smalltblheading">Crop&nbsp;</td>
<td width="25%" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input type="text" class="smalltbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['packaging_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td width="25%" align="right"  valign="middle" class="smalltblheading" >Variety&nbsp;</td>
    <td width="25%" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
</tr>	
<input type="hidden" name="txtstage" value="Pack" />
</table><br />
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_rpspackaging_sub where packaging_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="1%"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading"> Lot No.</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">Pouches</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">NoWB</td>
	<td width="5%" colspan="1" align="center" valign="middle" class="smalltblheading">NoMP</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Loose Pouches</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Loose WB</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">Total Packed Qty</td>
	</tr>
<?php
 
$srno=1; $pchccqty=0; $packqty=0; $totnomp=0; $totwb=0; $totnop=0; $wbqty=0; $totpckqty=0; $balpckqty=0; $loosepouches=0; $totalpckqty=0; $loosewb=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$lotno=""; $exqty=""; $expch=""; $upss=""; $nomps=""; $nopchs=""; $blpch=""; $nobarc="";

$lotno=$row_tbl_sub['packagingsub_lotno']; 
$exqty=$row_tbl_sub['packagingsub_extqty']; 
$expch=$row_tbl_sub['packagingsub_extnop']; 
$upss=$row_tbl_sub['packagingsub_upssize']; 
$nomps=$row_tbl_sub['packagingsub_nomp']; 
$remarks=$row_tbl['packaging_remarks']; 
$blpch=$row_tbl_sub['packagingsub_balpch']; 
$nobarc=$row_tbl_sub['packagingsub_barcodes']; 

$rpsswbnop=$row_tbl_sub['packagingsub_wbnop']; 
$rpsswbwt=$row_tbl_sub['packagingsub_wbwt']; 
$rpsswbinmp=$row_tbl_sub['packagingsub_wbinmp']; 
$rpsswtmp=$row_tbl_sub['packagingsub_wtmp']; 
$rpsswtnop=$row_tbl_sub['packagingsub_wtnop']; 


//$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1=""; $sloc=""; $sloc1=""; $cnt++; 
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_rpspackagingsub_sub where plantcode='$plantcode' and packagingsub_id='".$row_tbl_sub['packagingsub_id']."' and packaging_id='".$arrival_id."' order by packagingsubsub_id asc") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
	$nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_tbl_subsub['packagingsubsub_wh']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars']."/";
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname']."/";
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_tbl_subsub['packagingsubsub_subbin']."' and binid='".$row_tbl_subsub['packagingsubsub_bin']."' and whid='".$row_tbl_subsub['packagingsubsub_wh']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	$nb1=$row_tbl_subsub['packagingsubsub_totpch']; 
	
	$diq=explode(".",$row_tbl_subsub['packagingsubsub_totqty']);
	if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['packagingsubsub_totqty'];}
	
	if($sloc!=""){
	$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}
	else{
	$sloc=$wareh.$binn.$subbinn." | ".$nb1." | ".$qt1;}

}	

$pchccqty=0;
$packqty=$row_tbl_sub['packagingsub_extqty'];


$grwtflg=0;

$sql_wbm=mysqli_query($link,"select distinct wb_mpbarcode from tbl_wbqrcode where wb_rpstrid='".$arrival_id."' and wb_mpbarcode!='' and wb_mpbarcode IS NOT NULL ") or die(mysqli_error($link));
while($row_wbm=mysqli_fetch_array($sql_wbm))
{
	$totnomp=$totnomp+1;
}

$sql_wbm=mysqli_query($link,"select distinct wb_extqrcode from tbl_wbqrcode where wb_rpstrid='".$arrival_id."' and wb_mpqlinkflg=0 and wb_mpblinkflg=0  ") or die(mysqli_error($link));
while($row_wbm=mysqli_fetch_array($sql_wbm))
{
	$loosewb=$loosewb+1;
}


$sql_wbs=mysqli_query($link,"select wb_nop, wb_qty, wb_mpgrosswt, wb_mpbarcode from tbl_wbqrcode where wb_rpstrid='".$arrival_id."' ") or die(mysqli_error($link));
while($row_wbs=mysqli_fetch_array($sql_wbs))
{
	$totwb=$totwb+1;
	$wbqty=$wbqty+$row_wbs['wb_qty'];
	$totnop=$totnop+$row_wbs['wb_nop'];
	
	if($totnomp>0)
	{
		if($row_wbs['wb_mpbarcode']!="" && $row_wbs['wb_mpgrosswt']==0)
		{$grwtflg++;}
	}
	//if($row_wbs['wb_mpbarcode']!="" && $row_wbs['wb_mpgrosswt']==0)
	//{$grwtflg++;}
}
//echo $grwtflg;
//if($row_tbl['pnpslipmain_trtype']!='wb'){$totnomp=$row_tbl_sub['packagingsub_nomp'];}

$labelnos='';

if($row_tbl_sub['packagingsub_slabelno']!='' && $row_tbl_sub['packagingsub_elabelno']!=NULL){$labelnos=$row_tbl_sub['packagingsub_slabelno']." -- ".$row_tbl_sub['packagingsub_elabelno'];}

$loosepouches=$row_tbl_sub['packagingsub_loosepouches']; 


$upsize=explode(" ", $row_tbl_sub['packagingsub_upssize']);
	
if($upsize[1]=="Gms")
{ 
	$ptp=(1000/$upsize[0]);
	$ptp1=($upsize[0]/1000);
}
else
{
	$ptp=$upsize[0];
	$ptp1=$upsize[0];
}
//echo $ptp."  =>  ".$ptp1."  -  ";
if($upsize[1]=="Gms")
{
	$mmmpt=$ptp*$row_tbl_sub['packagingsub_wtmp'];
}
else
{
	$mmmpt=$row_tbl_sub['packagingsub_wtmp']/$ptp;
}
//echo $mmmpt;

$pcklossqty=0; $wbwt=0;
$pckccqty=0; $pickpqty=0;
/*if($row_tbl_sub['pnpslipsub_pouchccqty']>0)
{
	$pckccqty=(($totnop+$loosepouches)*$row_tbl_sub['pnpslipsub_pouchccqty']/1000);
}*/

if($loosepouches==0)
{$totpckqty=$wbqty;}
else
{
	$pcqt=$loosepouches*$ptp1;
	$totpckqty=$wbqty+$pcqt;
	
	if($totpckqty<$exqty)
	{
	$looseqty=$exqty-$wbqty;
	$loosepouches=$looseqty*$ptp;
	
	$pcqt=$loosepouches*$ptp1;
	$totpckqty=$wbqty+$pcqt;
	}
}
$loosepouches=round($loosepouches);

$rpsswbnop=$row_tbl_sub['packagingsub_wbnop']; 
$rpsswbwt=$row_tbl_sub['packagingsub_wbwt']; 
$rpsswbinmp=$row_tbl_sub['packagingsub_wbinmp']; 
$rpsswtmp=$row_tbl_sub['packagingsub_wtmp']; 
$rpsswtnop=$row_tbl_sub['packagingsub_wtnop']; 

$wbwt=$row_tbl_sub['packagingsub_wbwt'];
$pickpqty=$row_tbl_sub['packagingsub_extqty'];
$pcklossqty=$row_tbl_sub['packagingsub_extqty']-($totpckqty+$pckccqty);

$wtmp=$row_tbl_sub['packagingsub_wtmp'];
$wtnop=$row_tbl_sub['packagingsub_wtnop'];
$wtnopkg=$ptp1;

$wbnop=$row_tbl_sub['packagingsub_wbnop'];
$remarks=$row_tbl['packaging_remarks'];

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upss;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totwb;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loosepouches;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loosewb;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpckqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $expch;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $exqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $upss;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totwb;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loosepouches;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loosewb;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['pnpslipsub_nop'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $row_tbl_sub['pnpslipsub_id']?>,<?php echo $arrival_id;?>)">View</a></td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpckqty;?></td>
</tr>
<?php
}
$srno++;
}
}
?>
<input type="hidden" name="totpckqty" value="<?php echo $totpckqty;?>" /><input type="hidden" name="totnop" value="<?php echo $totnop; ?>"  />
<input type="hidden" name="wtnop_1" id="wtnop_1" value="<?php echo $wtnop;?>" /><input type="hidden" name="wtmp_1" id="wtmp_1" value="<?php echo $wtmp;?>" /><input type="hidden" name="wtnopkg_1" id="wtnopkg_1" value="<?php echo $wtnopkg;?>" /><input type="hidden" name="sno" value="1" /><input type="hidden" name="wbwt" id="wbwt" value="<?php echo $wbwt;?>" /><input type="hidden" name="wbnop_1" id="wbnop_1" value="<?php echo $wbnop;?>" /> <input type="hidden" name="upss" id="upss" value="<?php echo $upss;?>" />
</table>
<br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
	<td width="123" align="center" valign="middle" class="smalltblheading">Picked for Packing Qty</td>
	<td width="114" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
	<td width="114" align="center" valign="middle" class="smalltblheading">Loose Pouches</td>
	<td width="124" align="center" valign="middle" class="smalltblheading">Pouch CC Qty (Gms.)</td>
	<td width="124" align="center" valign="middle" class="smalltblheading">QC Sample/Packing Loss Qty</td>
	<td width="153" align="center" valign="middle" class="smalltblheading">Captive Consumption Qty</td>
	<td width="128" align="center" valign="middle" class="smalltblheading">Balance Packing Qty</td>
	<td width="72" align="center" valign="middle" class="smalltblheading">Gross Weight</td>
</tr>
<tr class="Light" height="25">  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="picqtyp" id="picqtyp" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" readonly="true"  style="background-color:#CCCCCC"  value="<?php echo $exqty;?>" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  <td  align="center"  valign="middle" class="smalltbltext"><input name="totpckqtyp" id="totpckqtyp" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10"  onkeypress="return isNumberKey(event)" readonly="true"  style="background-color:#CCCCCC"  value="<?php echo $exqty;?>" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>  
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="loosepouches" id="loosepouches" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)"  onchange="pfpchk12(this.value);"  value="<?php echo $loosepouches;?>" />&nbsp;</td>
  
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pchccqty" id="pchccqty" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" value="0" readonly="true"  style="background-color:#CCCCCC"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
  <td  align="center"  valign="middle" class="smalltbltext" ><input name="pckloss" id="pckloss" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey(event)" onchange="pfpchk1(this.value);" value="0"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  
  <td  align="center"  valign="middle" class="smalltbltext"><input name="ccloss" id="ccloss" type="text" size="8" class="smalltbltext" tabindex="" maxlength="10" onchange="plchk1(this.value);"  onkeypress="return isNumberKey(event)" value="0" readonly="true"  style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
 <td  align="center"  valign="middle" class="smalltbltext" ><input name="balpck" id="balpck" type="text" size="7" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" readonly="true"   value="<?php echo $exqty;?>"  style="background-color:#CCCCCC"   />&nbsp;</td>
 
 <td width="72" align="center" valign="middle" class="tbltext" id="gwupdate" ><?php if($grwtflg>0){?><a href="Javascript:void(0);" onclick="uploadgw();">Upload</a> <?php } else{ ?>Updated<?php } ?> </td>
<input type="hidden" name="gwupdflg" value="<?php if($grwtflg>0){ echo "0"; }else{echo "1";}?>" />
</tr>  
</table>
<br />
<input type="hidden" name="detmpbno" value="<?php echo $totnomp;?>" /><input type="hidden" name="nopks" value="<?php echo $loosepouches;?>" />

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
<td width="162" align="center" valign="middle" class="tblheading">Loose Window Box</td>
<td width="162" align="center" valign="middle" class="tblheading">Loose Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>
</tr>
<?php
$sno3=0; $a=$row['packagingsub_id'];  $totnompbarlink=0; $aval1=array();  $bpch=0; $tbpch=0;
$sql_tbl_subsub3=mysqli_query($link,"select * from tbl_pnpslipsubsub3 where plantcode='$plantcode' and pnpslipsub_id='".$row['pnpslipsub_id']."' and pnpslipmain_id='".$tid."' order by pnpslipsubsub_id asc") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
$sno3=$sno3+1;
$nobcd="";
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_btslmain where plantcode='$plantcode' and btsl_subbin='".$row_tbl_subsub3['pnpslipsubsub_subbin']."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_btslsub where plantcode='$plantcode' and btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_barcode IN ($abc)") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$brcod=$rowbarcsub['btslsub_barcode'];
			if($nobcd!="")
			$nobcd=$nobcd.",".$brcod;
			else
			$nobcd=$brcod;
			array_push($aval1,$brcod);
		}
	$totnompbar=$totnompbar+$subtbltotbar;
	}
	$totnompbar=$row_tbl_subsub3['pnpslipsubsub_nomp'];
	//$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	$tbpch=$tbpch+$row_tbl_subsub3['pnpslipsubsub_pouches'];
	
	

	
	
	
?>
<tr class="light" height="25">
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sno3;?>" name="txtwhg<?php echo $sno3;?>" style="width:70px;" onchange="wh(this.value,<?php echo $sno3;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($row_tbl_subsub3['pnpslipsubsub_wh']==$noticia_whd1['whid']) echo "selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_tbl_subsub3['pnpslipsubsub_wh']."' order by binname") or die(mysqli_error($link));
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><select class="smalltbltext" name="txtbing<?php echo $sno3;?>" id="txtbing<?php echo $sno3;?>" style="width:60px;" onchange="bin(this.value,<?php echo $sno3;?>);" >
<option value="" >Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($row_tbl_subsub3['pnpslipsubsub_bin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_tbl_subsub3['pnpslipsubsub_bin']."' order by sname") or die(mysqli_error($link));
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><select class="smalltbltext" name="txtsubbg<?php echo $sno3;?>" id="txtsubbg<?php echo $sno3;?>" style="width:60px;" onchange="subbin(this.value,<?php echo $sno3;?>);"  >
<option value="" >Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($row_tbl_subsub3['pnpslipsubsub_subbin']==$noticia_subbing1['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<td valign="middle">
<div id="slocr<?php echo $sno3;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview<?php echo $sno3?>" id="existview<?php echo $sno3?>" class="tbltext" value="" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php echo $totnomp;?><input type="text" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $totnomp;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)"   /></td>

<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_<?php echo $sno3;?>" id="loosewb_<?php echo $sno3;?>" value="<?php echo $row_tbl_subsub3['pnpslipsubsub_pouches'];?>" size="9"  onchange="loosewbchk(this.value,<?php echo $sno3;?>)"  /></td>

<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="<?php echo $row_tbl_subsub3['pnpslipsubsub_pouches'];?>" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_<?php echo $sno3;?>" id="noptpchs_<?php echo $sno3;?>" value="<?php echo $row_tbl_subsub3['pnpslipsubsub_totpouches'];?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_<?php echo $sno3;?>" id="noptqtys_<?php echo $sno3;?>" value="<?php echo $row_tbl_subsub3['pnpslipsubsub_totqty'];?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>

<?php
}
if($row['pnpslipsub_convtomp']=="Yes")
$obpch=$row['pnpslipsub_balpouch'];
else
$obpch=$row['pnpslipsub_nop'];
$bpch=$obpch-$tbpch;
?>
<?php
if(($conts-$totnompbarlink)>0) { if($ardiff=="") $ardiff=$abcdef; }

//if(($conts-$totnompbarlink)==0 && $bpch > 0) 
{
?>
<?php
if($sno3==0)
{
?>
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
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview1" id="existview1" class="tbltext" value="" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_1" id="nopmpcs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_1" id="loosewb_1" value="" size="9"  onchange="loosewbchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_1" id="noppchs_1" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_1" id="noptpchs_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_1" id="noptqtys_1" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>

<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_2" id="loosewb_2" value="" size="9"  onchange="loosewbchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_3" id="loosewb_3" value="" size="9"  onchange="loosewbchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_4" id="loosewb_4" value="" size="9"  onchange="loosewbchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_5" id="loosewb_5" value="" size="9"  onchange="loosewbchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_6" id="loosewb_6" value="" size="9"  onchange="loosewbchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_7" id="loosewb_7" value="" size="9"  onchange="loosewbchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_8" id="loosewb_8" value="" size="9"  onchange="loosewbchk(this.value,8)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==1)
{
?>
<tr class="light" height="25">
   <?php
$whd2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_2" id="nopmpcs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_2" id="loosewb_2" value="" size="9"  onchange="loosewbchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_2" id="noppchs_2" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,2)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_2" id="noptpchs_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_2" id="noptqtys_2" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_3" id="loosewb_3" value="" size="9"  onchange="loosewbchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_4" id="loosewb_4" value="" size="9"  onchange="loosewbchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_5" id="loosewb_5" value="" size="9"  onchange="loosewbchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_6" id="loosewb_6" value="" size="9"  onchange="loosewbchk(this.value,1)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_7" id="loosewb_7" value="" size="9"  onchange="loosewbchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_8" id="loosewb_8" value="" size="9"  onchange="loosewbchk(this.value,8)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==2)
{
?>
<tr class="light" height="25">
   <?php
$whd3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_3" id="nopmpcs_3" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_3" id="loosewb_3" value="" size="9"  onchange="loosewbchk(this.value,3)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_3" id="noppchs_3" value="" size="9"   readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,3)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_3" id="noptpchs_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_3" id="noptqtys_3" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_4" id="loosewb_4" value="" size="9"  onchange="loosewbchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_5" id="loosewb_5" value="" size="9"  onchange="loosewbchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_6" id="loosewb_6" value="" size="9"  onchange="loosewbchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_7" id="loosewb_7" value="" size="9"  onchange="loosewbchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_8" id="loosewb_8" value="" size="9"  onchange="loosewbchk(this.value,8)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==3)
{
?>
<tr class="light" height="25">
   <?php
$whd4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_4" id="nopmpcs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_4" id="loosewb_4" value="" size="9"  onchange="loosewbchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_4" id="noppchs_4" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,4)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_4" id="noptpchs_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_4" id="noptqtys_4" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_5" id="loosewb_5" value="" size="9"  onchange="loosewbchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_6" id="loosewb_6" value="" size="9"  onchange="loosewbchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_7" id="loosewb_7" value="" size="9"  onchange="loosewbchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_8" id="loosewb_8" value="" size="9"  onchange="loosewbchk(this.value,8)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==4)
{
?>
<tr class="light" height="25">
   <?php
$whd5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_5" id="nopmpcs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_5" id="loosewb_5" value="" size="9"  onchange="loosewbchk(this.value,5)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_5" id="noppchs_5" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,5)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_5" id="noptpchs_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_5" id="noptqtys_5" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_6" id="loosewb_6" value="" size="9"  onchange="loosewbchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_7" id="loosewb_7" value="" size="9"  onchange="loosewbchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_8" id="loosewb_8" value="" size="9"  onchange="loosewbchk(this.value,8)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==5)
{
?>
<tr class="light" height="25">
   <?php
$whd6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_6" id="nopmpcs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_6" id="loosewb_6" value="" size="9"  onchange="loosewbchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_6" id="noppchs_6" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,6)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_6" id="noptpchs_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_6" id="noptqtys_6" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_7" id="loosewb_7" value="" size="9"  onchange="loosewbchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_8" id="loosewb_8" value="" size="9"  onchange="loosewbchk(this.value,8)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==6)
{
?>
<tr class="light" height="25">
   <?php
$whd7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_7" id="nopmpcs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacsbinchk(this.value,7)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_7" id="loosewb_7" value="" size="9"  onchange="loosewbchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_7" id="noppchs_7" value="" size="9"  readonly="true" style="background-color:#CCCCCC" onchange="pacpchchk(this.value,7)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_7" id="noptpchs_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_7" id="noptqtys_7" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_8" id="loosewb_8" value="" size="9"  onchange="loosewbchk(this.value,8)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
if($sno3==7)
{
?>
<tr class="light" height="25">
   <?php
$whd8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode'  order by perticulars") or die(mysqli_error($link));
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
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="nopmpcs_8" id="nopmpcs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" onchange="pacsbinchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="loosewb_8" id="loosewb_8" value="" size="9"  onchange="loosewbchk(this.value,8)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_8" id="noppchs_8" value="" size="9"  readonly="true" style="background-color:#CCCCCC"  onchange="pacpchchk(this.value,8)" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_8" id="noptpchs_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_8" id="noptqtys_8" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
?>
<?php
}

if($sno3==0){$sno3=8;}
?>
<input type="hidden" name="sno3" value="<?php echo $sno3;?>" /><input type="hidden" name="slocseldet" value="" />
</table>


























 </div>
</div></div><br />
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="smalltblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $remarks;?><input type="hidden" name="txtremarks" class="smalltbltext" size="130" maxlength="130" value="<?php echo $remarks;?>" ></td>
</tr>
</table>
<br />
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

  
