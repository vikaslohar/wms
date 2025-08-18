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
	
	$pid = $_REQUEST['txtitem'];
	//exit;
	
	 $sql_main="update tbl_pnpslipmain set pnpslipmain_setupflg=1  where pnpslipmain_id ='$pid'";
	 $a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	 //exit;
	echo "<script>window.location='home_pronpslip_fc.php'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging -Transaction - Online Processing and Packing Slip- Preview</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>

<script src="pronpslip.js"></script>
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


function openslocpopprint()
{
//alert(txtcrop);
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('pronpslip_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Crop first.");
document.frmaddDepartment.txtcrop.focus();
}
}

function mySubmit()
{ 
	
	var srno=document.frmaddDepartment.srno.value;
	var totnomp=0;
	var totbarc=0;
	for(var i=1; i<srno; i++)
	{
		var totlotnomp="totlotnomp_"+i;
		var totlotbar="totlotbar_"+i;
		totnomp=parseInt(totnomp)+parseInt(document.getElementById(totlotnomp).value);
		totbarc=parseInt(totbarc)+parseInt(document.getElementById(totlotbar).value);
	}
	if(parseInt(totnomp)!=parseInt(totbarc))
	{
		alert("Total Barcodes and Total NoMP not matching.");
		return false;
	}
	else
	{
		if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
		{
			return true;	 
		}
		else
		{
			return false;
		}
	} 
}
function openpackdetails(subtid,tid)
{
winHandle=window.open('packdetails_pnpslip_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
function openbarcodedetails(subtid,tid)
{
winHandle=window.open('barcodedetails_pnpslip_trn.php?subid='+subtid+'&itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
function updatelossnqty(edtrecid,tid)
{
	if(parseInt(document.frmaddDepartment.totlotnomp1.value)!=parseInt(document.frmaddDepartment.totlotbar1.value))
	{
		alert("NoMP is not matching with number of Scanned Barcodes");
		//document.frmaddDepartment.totlotbar1.value=parseInt(maxnomp);
		return false;
	}
	else
	{
		//alert(edtrecid);
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformupdate','','','','','');
		//showUser(edtrecid,'postingsubtable','subformprvedt',tid,'','','','');
	}
}



function updateform()
{
	//alert(a);
	var a=formPost(document.getElementById('mainform'));
	showUser(a,'postingtable','mformupdate','','','','','');
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









// 			Code for processing Loss, Packing Loss and calculating the total balance packing Qty and pouches. 		//

/*
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
		document.getElementById('picqtyp').value=qtyval;
		document.getElementById('picqtyp').readOnly=true;
		document.getElementById('picqtyp').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').readOnly=true;
		document.getElementById('balcnob').style.backgroundColor="#cccccc";
		document.getElementById('balcnob').value="";
		document.getElementById('balcqty').value="";
		document.getElementById('conditionsloc').style.display="none";
		//document.getElementById('pcktype').value="";
		var pckloss=document.getElementById('pckloss').value;
		var ccloss=document.getElementById('ccloss').value;
		if(pckloss=="")pckloss=0;
		if(ccloss=="")ccloss=0;
		document.getElementById('balpck').value=parseFloat(document.getElementById('picqtyp').value)-(parseFloat(pckloss)+parseFloat(ccloss));
		document.getElementById('packqty_1').value=parseFloat(document.getElementById('balpck').value);
		
		var snoval=1;
		
			
		var a="packqty_"+snoval;
		var wtnop="wtnopkg_"+snoval;
		var wtmp="wtmp_"+snoval;
		var z="nopc_"+snoval;
		var lodednomp="lodednomp_"+snoval;
		
		var pouches="pouches_"+snoval;
		var balpouches="noofpacks_"+snoval;
		//document.getElementById(a).disabled=false;
		
		var nompqty=parseFloat(document.getElementById(lodednomp).value)*parseFloat(document.getElementById(wtmp).value);
		var zx=(parseFloat(document.getElementById(a).value)/parseFloat(document.getElementById(wtnop).value));
		
		var xc=parseFloat(parseFloat(document.getElementById(wtnop).value)*parseInt(zx));
		//alert(xc); alert(document.getElementById(a).value);
		document.getElementById(z).value=parseInt(zx);
		if(parseFloat(xc)!=parseFloat(document.getElementById(a).value))
		{
			alert("Qty in NoP is not matching with Qty for Packing");
			document.getElementById(z).value="";
			return false;
		}
		document.getElementById(a).disabled=true;
		
		if(parseFloat(nompqty)>parseFloat(document.getElementById(a).value))
		{
			alert("Qty in No of MP is not matching with Qty for Packing");
			document.getElementById(z).value="";
			return false;
		}	
		var bqt=parseFloat(document.getElementById(a).value)-parseFloat(nompqty);
		document.getElementById(pouches).value=(parseFloat(bqt)/parseFloat(document.getElementById(wtnop).value));
		var mppch=parseFloat(nompqty)/parseFloat(document.getElementById(wtnop).value);
		var bpch=parseInt(document.getElementById(z).value)-parseInt(mppch)-parseInt(document.getElementById(pouches).value);
		if(bpch<=0)bpch=0;
		document.getElementById(balpouches).value=parseInt(bpch);
	}
}
*/




function chkconqty()
{
	var abc=0; var f=0;

	var tpl=parseFloat(document.frmaddDepartment.procrm1.value)+parseFloat(document.frmaddDepartment.procim1.value)+parseFloat(document.frmaddDepartment.procpl1.value);
	var plper=parseFloat(document.frmaddDepartment.extqty.value);
	document.frmaddDepartment.proconqty1.value=parseFloat(document.frmaddDepartment.extqty.value)-parseFloat(tpl);
	//alert(tpl);	//alert(document.frmaddDepartment.txtconqty.value);	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.proconqty1.value);
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not equal to sum total of Condition Seed & Total Condition Loss");
		//document.frmaddDepartment.txtconpl.value="";
		//document.frmaddDepartment.txtconpl.focus();
		//document.frmaddDepartment.txtconloss.value="";
		//document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.proctplqt1.value=tpl;
		var vaal=parseFloat(document.frmaddDepartment.proctplqt1.value)/parseFloat(plper)*100;
		document.frmaddDepartment.proctplper1.value=Math.round((vaal)*100)/100;
		
		var pckloss=document.frmaddDepartment.packloss1.value;
		var ccloss=document.frmaddDepartment.packcc1.value;
		if(pckloss=="")pckloss=0;
		if(ccloss=="")ccloss=0;
		document.frmaddDepartment.packqty1.value=parseFloat(document.frmaddDepartment.proconqty1.value)-(parseFloat(pckloss)+parseFloat(ccloss));

		//document.getElementById('packqty_1').value=parseFloat(document.getElementById('balpck').value);
		
		var maxnomp=Math.floor(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpwtmp.value));
		
		
		
		var nompqty=parseFloat(document.frmaddDepartment.totlotbar1.value)*parseFloat(document.frmaddDepartment.pnpwtmp.value);
		
		var zx=(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpuom.value));
		
		var xc=parseFloat(parseFloat(document.frmaddDepartment.pnpuom.value)*parseInt(zx));
		//alert(xc); alert(document.getElementById(a).value);
		//document.getElementById(z).value=parseInt(zx);
		if(parseFloat(xc)!=parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in NoP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		//document.getElementById(a).disabled=true;
		
		else if(parseFloat(nompqty)>parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in No of MP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		
		else if(parseInt(maxnomp)!=parseInt(document.frmaddDepartment.totlotbar1.value))
		{
			alert("NoMP is not matching with number of Scanned Barcodes");
			//return false;
		}	
		else{}	
		document.frmaddDepartment.totlotnomp1.value=parseInt(maxnomp);
		var bqt=parseFloat(document.frmaddDepartment.packqty1.value)-parseFloat(nompqty);
		document.frmaddDepartment.totbalpch1.value=(parseFloat(bqt)/parseFloat(document.frmaddDepartment.pnpuom.value));
		if(parseInt(document.frmaddDepartment.totbalpch1.value)<=0)document.frmaddDepartment.totbalpch1.value=0;
		/*var mppch=parseFloat(nompqty)/parseFloat(document.getElementById(wtnop).value);
		var bpch=parseInt(document.getElementById(z).value)-parseInt(mppch)-parseInt(document.getElementById(pouches).value);
		if(bpch<=0)bpch=0;
		document.getElementById(balpouches).value=parseInt(bpch);*/
	
	}
		
		
	
}
function chkrm()
{
	var abc=0; var f=0;

	var tpl=parseFloat(document.frmaddDepartment.procrm1.value)+parseFloat(document.frmaddDepartment.procim1.value)+parseFloat(document.frmaddDepartment.procpl1.value);
	var plper=parseFloat(document.frmaddDepartment.extqty.value);
	document.frmaddDepartment.proconqty1.value=parseFloat(document.frmaddDepartment.extqty.value)-parseFloat(tpl);
	//alert(tpl);	//alert(document.frmaddDepartment.txtconqty.value);	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.proconqty1.value);
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not equal to sum total of Condition Seed & Total Condition Loss");
		//document.frmaddDepartment.txtconpl.value="";
		//document.frmaddDepartment.txtconpl.focus();
		//document.frmaddDepartment.txtconloss.value="";
		//document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.proctplqt1.value=tpl;
		var vaal=parseFloat(document.frmaddDepartment.proctplqt1.value)/parseFloat(plper)*100;
		document.frmaddDepartment.proctplper1.value=Math.round((vaal)*100)/100;
		
		var pckloss=document.frmaddDepartment.packloss1.value;
		var ccloss=document.frmaddDepartment.packcc1.value;
		if(pckloss=="")pckloss=0;
		if(ccloss=="")ccloss=0;
		document.frmaddDepartment.packqty1.value=parseFloat(document.frmaddDepartment.proconqty1.value)-(parseFloat(pckloss)+parseFloat(ccloss));

		//document.getElementById('packqty_1').value=parseFloat(document.getElementById('balpck').value);
		
		var maxnomp=Math.floor(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpwtmp.value));
		
		
		
		var nompqty=parseFloat(document.frmaddDepartment.totlotbar1.value)*parseFloat(document.frmaddDepartment.pnpwtmp.value);
		
		var zx=(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpuom.value));
		
		var xc=parseFloat(parseFloat(document.frmaddDepartment.pnpuom.value)*parseInt(zx));
		//alert(xc); alert(document.getElementById(a).value);
		//document.getElementById(z).value=parseInt(zx);
		if(parseFloat(xc)!=parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in NoP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		//document.getElementById(a).disabled=true;
		
		else if(parseFloat(nompqty)>parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in No of MP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		
		else if(parseInt(maxnomp)!=parseInt(document.frmaddDepartment.totlotbar1.value))
		{
			alert("NoMP is not matching with number of Scanned Barcodes");
			//return false;
		}	
		else{}	
		document.frmaddDepartment.totlotnomp1.value=parseInt(maxnomp);
		var bqt=parseFloat(document.frmaddDepartment.packqty1.value)-parseFloat(nompqty);
		document.frmaddDepartment.totbalpch1.value=(parseFloat(bqt)/parseFloat(document.frmaddDepartment.pnpuom.value));
		if(parseInt(document.frmaddDepartment.totbalpch1.value)<=0)document.frmaddDepartment.totbalpch1.value=0;
		/*var mppch=parseFloat(nompqty)/parseFloat(document.getElementById(wtnop).value);
		var bpch=parseInt(document.getElementById(z).value)-parseInt(mppch)-parseInt(document.getElementById(pouches).value);
		if(bpch<=0)bpch=0;
		document.getElementById(balpouches).value=parseInt(bpch);*/
	
	}
}

function chkim(plval)
{
	var abc=0; var f=0;

	var tpl=parseFloat(document.frmaddDepartment.procrm1.value)+parseFloat(document.frmaddDepartment.procim1.value)+parseFloat(document.frmaddDepartment.procpl1.value);
	var plper=parseFloat(document.frmaddDepartment.extqty.value);
	document.frmaddDepartment.proconqty1.value=parseFloat(document.frmaddDepartment.extqty.value)-parseFloat(tpl);
	//alert(tpl);	//alert(document.frmaddDepartment.txtconqty.value);	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.proconqty1.value);
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not equal to sum total of Condition Seed & Total Condition Loss");
		//document.frmaddDepartment.txtconpl.value="";
		//document.frmaddDepartment.txtconpl.focus();
		//document.frmaddDepartment.txtconloss.value="";
		//document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.proctplqt1.value=tpl;
		var vaal=parseFloat(document.frmaddDepartment.proctplqt1.value)/parseFloat(plper)*100;
		document.frmaddDepartment.proctplper1.value=Math.round((vaal)*100)/100;
		
		var pckloss=document.frmaddDepartment.packloss1.value;
		var ccloss=document.frmaddDepartment.packcc1.value;
		if(pckloss=="")pckloss=0;
		if(ccloss=="")ccloss=0;
		document.frmaddDepartment.packqty1.value=parseFloat(document.frmaddDepartment.proconqty1.value)-(parseFloat(pckloss)+parseFloat(ccloss));

		//document.getElementById('packqty_1').value=parseFloat(document.getElementById('balpck').value);
		
		var maxnomp=Math.floor(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpwtmp.value));
		
		
		
		var nompqty=parseFloat(document.frmaddDepartment.totlotbar1.value)*parseFloat(document.frmaddDepartment.pnpwtmp.value);
		
		var zx=(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpuom.value));
		
		var xc=parseFloat(parseFloat(document.frmaddDepartment.pnpuom.value)*parseInt(zx));
		//alert(xc); alert(document.getElementById(a).value);
		//document.getElementById(z).value=parseInt(zx);
		if(parseFloat(xc)!=parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in NoP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		//document.getElementById(a).disabled=true;
		
		else if(parseFloat(nompqty)>parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in No of MP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		
		else if(parseInt(maxnomp)!=parseInt(document.frmaddDepartment.totlotbar1.value))
		{
			alert("NoMP is not matching with number of Scanned Barcodes");
			//return false;
		}	
		else{}
		document.frmaddDepartment.totlotnomp1.value=parseInt(maxnomp);
		var bqt=parseFloat(document.frmaddDepartment.packqty1.value)-parseFloat(nompqty);
		document.frmaddDepartment.totbalpch1.value=(parseFloat(bqt)/parseFloat(document.frmaddDepartment.pnpuom.value));
		if(parseInt(document.frmaddDepartment.totbalpch1.value)<=0)document.frmaddDepartment.totbalpch1.value=0;
		/*var mppch=parseFloat(nompqty)/parseFloat(document.getElementById(wtnop).value);
		var bpch=parseInt(document.getElementById(z).value)-parseInt(mppch)-parseInt(document.getElementById(pouches).value);
		if(bpch<=0)bpch=0;
		document.getElementById(balpouches).value=parseInt(bpch);*/
	
	}
}

function pfpchk1(pfpval)
{
	var abc=0; var f=0;

	var tpl=parseFloat(document.frmaddDepartment.procrm1.value)+parseFloat(document.frmaddDepartment.procim1.value)+parseFloat(document.frmaddDepartment.procpl1.value);
	var plper=parseFloat(document.frmaddDepartment.extqty.value);
	document.frmaddDepartment.proconqty1.value=parseFloat(document.frmaddDepartment.extqty.value)-parseFloat(tpl);
	//alert(tpl);	//alert(document.frmaddDepartment.txtconqty.value);	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.proconqty1.value);
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not equal to sum total of Condition Seed & Total Condition Loss");
		//document.frmaddDepartment.txtconpl.value="";
		//document.frmaddDepartment.txtconpl.focus();
		//document.frmaddDepartment.txtconloss.value="";
		//document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.proctplqt1.value=tpl;
		var vaal=parseFloat(document.frmaddDepartment.proctplqt1.value)/parseFloat(plper)*100;
		document.frmaddDepartment.proctplper1.value=Math.round((vaal)*100)/100;
		
		var pckloss=document.frmaddDepartment.packloss1.value;
		var ccloss=document.frmaddDepartment.packcc1.value;
		if(pckloss=="")pckloss=0;
		if(ccloss=="")ccloss=0;
		document.frmaddDepartment.packqty1.value=parseFloat(document.frmaddDepartment.proconqty1.value)-(parseFloat(pckloss)+parseFloat(ccloss));

		//document.getElementById('packqty_1').value=parseFloat(document.getElementById('balpck').value);
		
		var maxnomp=Math.floor(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpwtmp.value));
		
		
		
		var nompqty=parseFloat(document.frmaddDepartment.totlotbar1.value)*parseFloat(document.frmaddDepartment.pnpwtmp.value);
		
		var zx=(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpuom.value));
		
		var xc=parseFloat(parseFloat(document.frmaddDepartment.pnpuom.value)*parseInt(zx));
		//alert(xc); alert(document.getElementById(a).value);
		//document.getElementById(z).value=parseInt(zx);
		if(parseFloat(xc)!=parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in NoP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		//document.getElementById(a).disabled=true;
		
		else if(parseFloat(nompqty)>parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in No of MP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		
		else if(parseInt(maxnomp)!=parseInt(document.frmaddDepartment.totlotbar1.value))
		{
			alert("NoMP is not matching with number of Scanned Barcodes");
			//return false;
		}	
		else{}	
		var nmp=parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpwtmp.value);
		//alert(nmp); alert(maxnomp);
		document.frmaddDepartment.totlotnomp1.value=parseInt(maxnomp);
		var bqt=parseFloat(document.frmaddDepartment.packqty1.value)-parseFloat(nompqty);
		document.frmaddDepartment.totbalpch1.value=(parseFloat(bqt)/parseFloat(document.frmaddDepartment.pnpuom.value));
		if(parseInt(document.frmaddDepartment.totbalpch1.value)<=0)document.frmaddDepartment.totbalpch1.value=0;
		/*var mppch=parseFloat(nompqty)/parseFloat(document.getElementById(wtnop).value);
		var bpch=parseInt(document.getElementById(z).value)-parseInt(mppch)-parseInt(document.getElementById(pouches).value);
		if(bpch<=0)bpch=0;
		document.getElementById(balpouches).value=parseInt(bpch);*/
	
	}
	
}

function plchk1(pfpval)
{
	var abc=0; var f=0;

	var tpl=parseFloat(document.frmaddDepartment.procrm1.value)+parseFloat(document.frmaddDepartment.procim1.value)+parseFloat(document.frmaddDepartment.procpl1.value);
	var plper=parseFloat(document.frmaddDepartment.extqty.value);
	document.frmaddDepartment.proconqty1.value=parseFloat(document.frmaddDepartment.extqty.value)-parseFloat(tpl);
	//alert(tpl);	//alert(document.frmaddDepartment.txtconqty.value);	//alert(plper);
	var totalval=parseFloat(tpl)+parseFloat(document.frmaddDepartment.proconqty1.value);
	totalval=Math.round(totalval*1000)/1000;
	if((parseFloat(totalval))!=parseFloat(plper))
	{
		alert("Quantity Mismatch. Please check\nTotal Quantity picked for Processing is not equal to sum total of Condition Seed & Total Condition Loss");
		//document.frmaddDepartment.txtconpl.value="";
		//document.frmaddDepartment.txtconpl.focus();
		//document.frmaddDepartment.txtconloss.value="";
		//document.frmaddDepartment.txtconper.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.proctplqt1.value=tpl;
		var vaal=parseFloat(document.frmaddDepartment.proctplqt1.value)/parseFloat(plper)*100;
		document.frmaddDepartment.proctplper1.value=Math.round((vaal)*100)/100;
		
		var pckloss=document.frmaddDepartment.packloss1.value;
		var ccloss=document.frmaddDepartment.packcc1.value;
		if(pckloss=="")pckloss=0;
		if(ccloss=="")ccloss=0;
		document.frmaddDepartment.packqty1.value=parseFloat(document.frmaddDepartment.proconqty1.value)-(parseFloat(pckloss)+parseFloat(ccloss));

		//document.getElementById('packqty_1').value=parseFloat(document.getElementById('balpck').value);
		
		var maxnomp=Math.floor(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpwtmp.value));
		
		
		
		var nompqty=parseFloat(document.frmaddDepartment.totlotbar1.value)*parseFloat(document.frmaddDepartment.pnpwtmp.value);
		
		var zx=(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpuom.value));
		
		var xc=parseFloat(parseFloat(document.frmaddDepartment.pnpuom.value)*parseInt(zx));
		//alert(xc); alert(document.getElementById(a).value);
		//document.getElementById(z).value=parseInt(zx);
		if(parseFloat(xc)!=parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in NoP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		//document.getElementById(a).disabled=true;
		
		else if(parseFloat(nompqty)>parseFloat(document.frmaddDepartment.packqty1.value))
		{
			alert("Qty in No of MP is not matching with Qty for Packing");
			//document.getElementById(z).value="";
			//return false;
		}
		
		else if(parseInt(maxnomp)!=parseInt(document.frmaddDepartment.totlotbar1.value))
		{
			alert("NoMP is not matching with number of Scanned Barcodes");
			//return false;
		}	
		else{}
		var nmp=parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpwtmp.value);
		document.frmaddDepartment.totlotnomp1.value=parseInt(maxnomp);
		var bqt=parseFloat(document.frmaddDepartment.packqty1.value)-parseFloat(nompqty);
		document.frmaddDepartment.totbalpch1.value=(parseFloat(bqt)/parseFloat(document.frmaddDepartment.pnpuom.value));
		if(parseInt(document.frmaddDepartment.totbalpch1.value)<=0)document.frmaddDepartment.totbalpch1.value=0;
		/*var mppch=parseFloat(nompqty)/parseFloat(document.getElementById(wtnop).value);
		var bpch=parseInt(document.getElementById(z).value)-parseInt(mppch)-parseInt(document.getElementById(pouches).value);
		if(bpch<=0)bpch=0;
		document.getElementById(balpouches).value=parseInt(bpch);*/
	
	}
}
function chknomp(nompval)
{
	var maxnomp=Math.floor(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpwtmp.value));
	var nompqty=parseFloat(nompval)*parseFloat(document.frmaddDepartment.pnpwtmp.value);
	var zx=(parseFloat(document.frmaddDepartment.packqty1.value)/parseFloat(document.frmaddDepartment.pnpuom.value));
	var xc=parseFloat(parseFloat(document.frmaddDepartment.pnpuom.value)*parseInt(zx));

	if(parseInt(nompval)!=parseInt(document.frmaddDepartment.totlotbar1.value))
	{
		alert("NoMP is not matching with number of Scanned Barcodes");
		document.frmaddDepartment.totlotbar1.value=parseInt(maxnomp);
		return false;
	}	
	else
	{
		var bqt=parseFloat(document.frmaddDepartment.packqty1.value)-parseFloat(nompqty);
		document.frmaddDepartment.totbalpch1.value=(parseFloat(bqt)/parseFloat(document.frmaddDepartment.pnpuom.value));
		if(parseInt(document.frmaddDepartment.totbalpch1.value)<=0)document.frmaddDepartment.totbalpch1.value=0;
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
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
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
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Processing and Packing slip FC - Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
   <?php
   $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where plantcode='$plantcode' and pnpslipmain_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pnpslipmain_id'];

	$tdate=$row_tbl['pnpslipmain_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate3=$row_tbl['pnpslipmain_mtndate'];
	$tyear3=substr($tdate3,0,4);
	$tmonth3=substr($tdate3,5,2);
	$tday3=substr($tdate3,8,2);
	$tdate3=$tday3."-".$tmonth3."-".$tyear3;
	
	$tdate2=$row_tbl['pnpslipmain_doindent'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;
?>
 	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="970"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Processing Slip FC - Indent Preview</td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Transaction ID &nbsp;</td>
<td width="319"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPS".$row_tbl['pnpslipmain_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="157" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="165" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;MTN Date&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $tdate3;?><input name="mtndate" id="mtndate" type="hidden" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate3;?>" maxlength="10"/>&nbsp;</td>
<td width="157" align="right"  valign="middle" class="smalltblheading">MTN No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['pnpslipmain_mtnno'];?><input name="mtnno" type="hidden" size="15" class="smalltbltext" tabindex=""    maxlength="8" onkeypress="return isNumberKey1(event)" value="<?php echo $row_tbl['pnpslipmain_mtnno'];?>" />&nbsp;</td>
</tr>
 <tr class="Light" height="30">
<td width="319" align="right" valign="middle" class="smalltblheading">&nbsp;Date of Indent&nbsp;</td>
<td width="319" align="left" valign="middle" class="smalltbltext">&nbsp;<input name="dopc" id="dopc" type="text" size="10" class="smalltbltext" tabindex="0" value="<?php echo $tdate2;?>" maxlength="10" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font></td>

<td width="157" align="right"  valign="middle" class="smalltblheading">Indent No.&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtpsrno" type="text" size="15" class="smalltbltext" tabindex="" value="<?php echo $row_tbl['pnpslipmain_indentsrn'];?>" maxlength="15" readonly="true"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
    <td width="209" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<input type="text" class="smalltbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
	<td width="157" align="right"  valign="middle" class="smalltblheading" >Seed Stage&nbsp;</td>
    <td width="165" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" class="smalltbltext" name="txtstage" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row_tbl['pnpslipmain_stage'];?>" size="20" />   <input type="hidden" class="smalltbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
	
  </tr>
    <?php
$sql_sel1="select * from tbl_rm_promac where plantcode='$plantcode' and promac_id='".$row_tbl['pnpslipmain_promachcode']."' order by promac_type";
$res1=mysqli_query($link,$sql_sel1) or die (mysqli_error($link));
$total1=mysqli_num_rows($res1);
$noticia_item1 = mysqli_fetch_array($res1);  $num=$noticia_item1['promac_mac'].$noticia_item1['promac_macid'];

$query_popr=mysqli_query($link,"SELECT * FROM tbl_rm_proopr where plantcode='$plantcode' and proopr_id='".$row_tbl['pnpslipmain_proopr']."'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query_popr);
$row_popr=mysqli_fetch_array($query_popr);
?> 
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="smalltblheading">Proc. Mach. Code&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $num?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Operator&nbsp;Name&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_popr['proopr_fname']?> <?php echo $row_popr['proopr_lname']?>" /></td>
	<td align="right"  valign="middle" class="smalltblheading">Treatment Schema&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtdrefno" type="text" size="20" class="smalltbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['pnpslipmain_treattype']?>" /></td>
	</tr>

</table>
<?php
$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
//echo "Select * from tbl_pnpslipsub where pnpslipmain_id='$arrival_id' ";
$sql_trdetails_sub=mysqli_query($link,"Select * from tbl_pnpslipsub where pnpslipmain_id='$arrival_id' ") or die(mysqli_error($link));
$row_trdetails_sub=mysqli_fetch_array($sql_trdetails_sub);
$subtid=0;
//echo $row_trdetails_sub['pnpslipsub_lotno'];
?>
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
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_trdetails_sub['pnpslipsub_qcdttype']; ?></td>
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
 { $srno2++;
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
}
?>
 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="1%"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Pack E/P</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">Qty for Packing</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">Total Pouches</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">Max NoMP</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">MPWT</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">Remarks</td>
	</tr>
  <?php
 
$srno=1;  $slcnt=0;
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++; 
$tot_barcnomp=0;

$pnplotno=$row_tbl_sub['pnpslipsub_plotno'];
$pnpnob=$row_tbl_sub['pnpslipsub_availpnob'];
$pnpqty=$row_tbl_sub['pnpslipsub_availpqty'];
$pnpprocesstype=$row_tbl_sub['pnpslipsub_packtype'];
$pickpqty=$row_tbl_sub['pnpslipsub_pickpqty'];

$pnpnomp=$row_tbl_sub['pnpslipsub_nomp'];
$pnpwtmp=$row_tbl_sub['pnpslipsub_wtmp'];
$pnpups=$row_tbl_sub['pnpslipsub_ups'];
$pnppackloss=$row_tbl_sub['pnpslipsub_packloss'];
$pnpcc=$row_tbl_sub['pnpslipsub_packcc'];
//echo "select * from tblups where CONCAT(ups,' ',wt)='".$pnpups."'";
$sql_ups=mysqli_query($link,"select * from tblups where CONCAT(ups,' ',wt)='".$pnpups."'") or die(mysqli_error($link));
$row_ups=mysqli_fetch_array($sql_ups);
$pnpuom=$row_ups['uom'];


$diq=explode(".",$pnpconqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnpconqty;}
$pnpconqty=$difq;
$diq=explode(".",$pnprm);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnprm;}
$pnprm=$difq;
$diq=explode(".",$pnpim);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnpim;}
$pnpim=$difq;
$diq=explode(".",$pnppl);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnppl;}
$pnppl=$difq;
$diq=explode(".",$pnptlqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnptlqty;}
$pnptlqty=$difq;
$diq=explode(".",$pnppackloss);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnppackloss;}
$pnppackloss=$difq;
$diq=explode(".",$pnpcc);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$pnpcc;}
$pnpcc=$difq;

$balpch=0;
$totpch=floor($pickpqty/$pnpuom);

$pnppackqty=$pnpconqty-($pnppackloss+$pnpcc);

$ltnomp=$pnppackqty/$pnpwtmp;
$ltnomp=intval($ltnomp);
$totnompqty=$ltnomp*$pnpwtmp;
$toblqty=$pnppackqty-$totnompqty;
$balpch=$toblqty*$pnpuom;

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnplotno;?><input type="hidden" name="pnplotno" id="pnplotno_<?php echo $srno;?>" value="<?php echo $pnplotno;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpprocesstype;?></td>
	<td width="47" align="center" valign="middle" class="smalltbltext"><?php echo $pickpqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pnpups;?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $totpch;?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $pnpnomp;?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $pnpwtmp;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_packremarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_packremarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_packremarks'];?>">Details</a><?php } ?></td>
</tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td width="18" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnplotno;?><input type="hidden" name="pnplotno" id="pnplotno_<?php echo $srno;?>" value="<?php echo $pnplotno;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpnob;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpqty;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $pnpprocesstype;?></td>
	<td width="47" align="center" valign="middle" class="smalltbltext"><?php echo $pickpqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pnpups;?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $totpch;?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $pnpnomp;?></td>
	<td width="37" align="center" valign="middle" class="smalltbltext"><?php echo $pnpwtmp;?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['pnpslipsub_packremarks']!=""){ ?><a href="Javascript:void(0)" title="<?php echo $row_tbl_sub['pnpslipsub_packremarks'];?>" onmouseover="<?php echo $row_tbl_sub['pnpslipsub_packremarks'];?>">Details</a><?php } ?></td>
</tr>
 <?php
}
$srno++;
}
}
?>
<input type="hidden" name="srno" value="<?php echo $srno; ?>" /><input type="hidden" name="slcnt" value="<?php echo $slcnt; ?>" />
</table>
<br />

<div id="postingsubtable" style="display:block">
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_pronpslip_fc.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<!--<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;--><input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  
