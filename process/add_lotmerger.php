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
		echo "<script>window.location='add_blending_preview.php?p_id=$pid'</script>";	
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Manager - Transction - Lot Blending - Preview</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
</head>
<script src="lotmerger.js"></script>
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

function openslocpopprint()
{

var pid=document.frmaddDept.pid.value;
winHandle=window.open('issue_merger_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}



var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDept.reset();
	 popUpCalendar(document.frmaddDept.date,dt,document.frmaddDept.date, "dd-mmm-yyyy", xind, yind);
	}  


function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
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
function onloadfocus()
	{
	//document.frmaddDept.txt12.focus();
	}

function checkchk(chkval)
{

var sloc="slocissue"+chkval;
//alert(document.getElementById(sloc).checked);
	if(document.getElementById(sloc).checked == true)
	{  	
		var x="upsavl_"+chkval;
		var y="qtyavl_"+chkval;
		if(document.frmaddDept.totalmnob.value!="")
		{
			document.frmaddDept.totalmnob.value=parseFloat(document.frmaddDept.totalmnob.value)+parseFloat(document.getElementById(x).value);
		}
		else
		{
			document.frmaddDept.totalmnob.value=parseFloat(document.getElementById(x).value);
		}
		if(document.frmaddDept.eqty.value!="")
		{
			document.frmaddDept.eqty.value=parseFloat(document.frmaddDept.eqty.value)+parseFloat(document.getElementById(y).value);
		}
		else
		{
			document.frmaddDept.eqty.value=parseFloat(document.getElementById(y).value);
		}
	}
	else
	{
	//alert(document.frmaddDept.totalmnob.value);
		var x="upsavl_"+chkval;
		var y="qtyavl_"+chkval;
		document.frmaddDept.totalmnob.value=parseFloat(document.frmaddDept.totalmnob.value)-parseFloat(document.getElementById(x).value);
		document.frmaddDept.eqty.value=parseFloat(document.frmaddDept.eqty.value)-parseFloat(document.getElementById(y).value);
		//alert(document.frmaddDept.totalmnob.value);
		if(document.frmaddDept.totalmnob.value<=0)
		document.frmaddDept.totalmnob.value="";
		if(document.frmaddDept.eqty.value<=0)
		document.frmaddDept.eqty.value="";
	}

}
function upschk(fid,fval)
{
var a="upsavl_"+fval;
var b="balups_"+fval;
document.getElementById(b).value=parseInt(document.getElementById(a).value)-parseInt(fid);
}

function qtychk(qid,qval)
{
			var z2="upsavl_"+qval;
			var z3="qtyavl_"+qval;
			var z4="issueups_"+qval;
			var z5="issueqty_"+qval;
			var z="balups_"+qval;
			var z1="balqty_"+qval;
			
			if(parseFloat(document.getElementById(z5).value) > parseFloat(document.getElementById(z3).value))
			{
			alert('Discard Quantity cannot be more than the Existing Quantity');
			document.getElementById(z1).value="";
			document.getElementById(z5).value="";
			return false;
			}
			if(parseFloat(document.getElementById(z1).value) == 0 )
			{
			document.getElementById(z).value=0;
			}
			if(parseFloat(document.getElementById(z1).value) != 0 && parseInt(document.getElementById(z).value) == 0)
			{
			document.getElementById(z).value=1;
			}
			if(parseFloat(document.getElementById(z5).value) == "")
			{
			alert('Discard Quantity cannot be blank');
			document.getElementById(z1).value=parseFloat(document.getElementById(z3).value);
			document.getElementById(z5).value=0;
			return false;
			}
			else
			{
			/*var c="qtyavl_"+qval;
			var d="balqty_"+qval;*/
			document.getElementById(z1).value=parseFloat(document.getElementById(z3).value)-parseFloat(document.getElementById(z5).value);
			}
}
function clks(val)
{
//alert(val);
document.frmaddDept.txt15.value=val;
}
function clk1(val)
{
//alert(val);
document.frmaddDept.txt14.value=val;
}

function modetchk(classval)
{
showUser(classval,'vitem','item','','','','','');
document.getElementById('maindiv').innerHTML="";
document.frmaddDept.txtstage.value="";
document.frmaddDept.txtnlottom.value="";
document.frmaddDept.txtlot1.value="";
document.frmaddDept.txtlotnumber.value="";
}

function modetchk24(classval24)
{
document.getElementById('maindiv').innerHTML="";
document.frmaddDept.txtstage.value="";
document.frmaddDept.txtnlottom.value="";
document.frmaddDept.txtlot1.value="";
document.frmaddDept.txtlotnumber.value="";
}
function modetchk6(classval24)
{
if(document.frmaddDept.txtvariety.value=="")
{
	alert("Please select Variety first");
	document.frmaddDept.txtvariety.focus();
}
document.getElementById('maindiv').innerHTML="";
document.frmaddDept.txtlot1.value="";
document.frmaddDept.txtlotnumber.value="";
showUser(classval24,'lotnshow','lotshow','','','','','');
}

function chkstate(numval)
{
	if(document.frmaddDept.txtstage.value=="")
	{
		alert("Please select Stage first");
		document.frmaddDept.txtstage.focus();
	}
	else if(numval<=1)
	{
		alert("No. of Lot(s) to be Blending can be TWO or more");
		document.frmaddDept.txtnlottom.value="";
		document.frmaddDept.txtlot1.value="";
		document.frmaddDept.txtnlottom.focus();
	}
	document.getElementById('maindiv').innerHTML="";
	document.frmaddDept.txtlot1.value="";
}
function piupschk()
{
	if(document.frmaddDept.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDept.txtvariety.focus();
	}
}
function piqtychk(edtid)
{
	if(document.frmaddDept.txtups.value=="")
	{
		alert("Please enter Bags first");
		document.frmaddDept.txtups.focus();
	}
	
}	
/*
function classchk(itval)
{
if(document.frmaddDept.txtcrop.value!="")
	{	
		if(document.frmaddDept.txtvariety.value!="")
		{
			if(document.frmaddDept.itmdchk.value!="")
			{ 
				var flg=0;
				var itmchk=document.frmaddDept.itmdchk.value;
				var itm=itmchk.split(",");
				for(var i=0; i < itm.length; i++)
				{
					if(document.frmaddDept.txtvariety.value==itm[i])
					{
						flg=1;
					}
				}
				if(flg==1)
				{
					alert("Please Check, this Variety is already posted in this transaction");
					document.frmaddDept.txtvariety.selectedIndex=0;
					return false;
				}
				
			}
		}
		showUser(itval,'uom','itemuom','','','','','');
		setTimeout('chktyp()',200);
	}
	else
	{
		alert("Please Select Crop")
		//document.frmaddDept.txtvariety.
		document.frmaddDept.txtvariety.selectedIndex=0;
		document.frmaddDept.txtcrop.focus();
	}
}
function editrecord(edtid)
{
//alert(edtid);
showUser(edtid,'subsubdiv','subformedt','','','','','');
}

function deleterec(v1,v2,v3)
{
if(confirm('Do You wish to delete this Variety?')==true)
{
showUser(v1,'maindiv','dddelete',v2,v3,'','','');
}
else
{
return false;
}
}*/



function getdetails()
{
		var crop=document.frmaddDept.txtcrop.value;
        var variety=document.frmaddDept.txtvariety.value;					
		var stage=document.frmaddDept.txtstage.value;
		var lotid=document.frmaddDept.txtlot1.value;
		showUser(crop,'maindiv','get',variety,stage,lotid,'','','');
}

function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDept.eqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
	else
	{
		alert("Please select Lots to Blending");
		document.frmaddDept.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDept.eqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
	}
	else
	{
		alert("Please select Lots to Blending");
		document.frmaddDept.txtslwhg2.selectedIndex=0;
	}
}


function bin1(bin1val)
{
	if(document.frmaddDept.txtslwhg1.value!="")
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
	if(document.frmaddDept.txtslwhg2.value!="")
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
	var itemv=document.frmaddDept.txtvariety.value;
	if(document.frmaddDept.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood=document.frmaddDept.txtstage.value;
		var trid="";
		//var slocnodamage=document.frmaddDept.tblslocnod.value;
		if(document.frmaddDept.txtconslnob1.value!="")
		var Bagsv1=document.frmaddDept.txtconslnob1.value;
		else
		var Bagsv1="";
		if(document.frmaddDept.txtconslqty1.value!="")
		var qtyv1=document.frmaddDept.txtconslqty1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDept.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDept.txtvariety.value;
	if(document.frmaddDept.txtslbing2.value!="")
	{	
		var w1=document.frmaddDept.txtslwhg1.value+document.frmaddDept.txtslbing1.value+document.frmaddDept.txtslsubbg1.value;
		var w2=document.frmaddDept.txtslwhg2.value+document.frmaddDept.txtslbing2.value+document.frmaddDept.txtslsubbg2.value;
		if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb2').selectedIndex=0;
		document.frmaddDept.txtslbing2.focus();
		}
		
		if(document.frmaddDept.txtslsubbg1.value!="")
		
		var slocnogood=document.frmaddDept.txtstage.value;
		var trid="";
		if(document.frmaddDept.txtconslnob2.value!="")
		var Bagsv2=document.frmaddDept.txtconslnob2.value;
		else
		var Bagsv2="";
		if(document.frmaddDept.txtconslqty2.value!="")
		var qtyv2=document.frmaddDept.txtconslqty2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDept.txtslbing2.focus();
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


function mySubmit()
{ 	
	if(document.frmaddDept.gflg.value!="0")
	{
		alert("Please update SLOC first");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	else
	{
		return true;
	}
}

function updatesloc(slval,slnob,slqty,tpval)
{
	var crop=document.frmaddDept.txtcrop.value;
	var variety=document.frmaddDept.txtvariety.value;
	var sstage=document.frmaddDept.txtstage.value;
	showUser(slval,'subdiv','slocupdate',slnob,slqty,sstage,tpval,'');
}	

function pformedtup()
{
	var f=0;
	if(document.frmaddDept.txtcrop.value=="")
	{
		alert("Select Crop");
		document.frmaddDept.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDept.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDept.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDept.txtstage.value=="")
	{
		alert("Please Select Stage.");
		document.frmaddDept.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDept.txtnlotno.value=="")
	{
		alert("Please Select Lot Number.");
		//document.frmaddDept.txtnlotno.focus();
		f=1;
		return false;
	}
	if(document.frmaddDept.txtslsubbg1.value=="" && document.frmaddDept.txtslsubbg2.value=="")
	{
		alert("Please select SLOC");
		//document.frmaddDepartment.txtconpl.focus();
		f=1;
		return false;
	}	
	var qty1=document.frmaddDept.txtconslqty1.value;
	var qty2=document.frmaddDept.txtconslqty2.value;
	if(qty1=="")qty1=0; if(qty2=="")qty2=0;
	var totqty=parseFloat(qty1)+parseFloat(qty2);
	if(parseFloat(document.frmaddDept.eqty.value)!=parseFloat(totqty))
	{
		alert("Please check.\nTotal Quantity of Blended Lot is not matching with Quantity distributed into SLOC Sub-Bin(s)");
		//document.frmaddDept.chkbox.focus();
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
		showUser(a,'postingtable','blendsubedt','','','','','');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction - Lot Blending - SLOC Updation</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
<?php
	$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id=$pid and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; 
	$drole=$row['blendm_logid'];
	$tdate=$row['blendm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	$subtrid=0;
?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input name="code" type="hidden" value="<?php echo $code;?>" />
	<input name="tid" type="hidden" value="<?php echo $tid;?>" />
	<input name="pid" type="hidden" value="<?php echo $pid;?>" />
	<input name="txtdate" type="hidden" value="<?php echo $tdate;?>" />
	<input name="txtcrop" type="hidden" value="<?php echo $row['blendm_crop'];?>" />
	<input name="txtvariety" type="hidden" value="<?php echo $row['blendm_variety'];?>" />
	<input name="txtstage" type="hidden" value="<?php echo $row['blendm_stage'];?>" />
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
<!--<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">New Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['blendm_newlot'];?></td>
</tr>-->

</table>
</br>
<div id="postingtable">
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
		<td width="26" rowspan="2"  align="center" valign="middle" class="smalltblheading"></td>
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
}


$sql_sub=mysqli_query($link,"select distinct blends_delflg from tbl_blends where blendm_id='$trid' and blends_delflg>0 and plantcode='$plantcode' group by blends_delflg order by blends_delflg asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$drs=$row_sub['blends_delflg'];	
}

$sql_sub23=mysqli_query($link,"select distinct blends_sstatus from tbl_blends where blendm_id='$trid' and blends_sstatus=0 and blends_delflg=0 and plantcode='$plantcode' order by blends_sstatus asc") or die(mysqli_error($link));
while($row_sub23=mysqli_fetch_array($sql_sub23))
{
	$gflg++;
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
		<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="updatesloc('<?php echo $nlotno;?>', '<?php echo $tnob?>', '<?php echo $tqty?>','<?php if($slocss2=="") echo "new"; else "upd";?>');" /></td>
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
		<td align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="updatesloc('<?php echo $nlotno;?>', '<?php echo $tnob?>', '<?php echo $tqty?>','<?php if($slocss2=="") echo "new"; else "upd";?>');" /></td>
</tr>
<?php 
}
$sr=$sr+1;	
//}
}
}
//echo $gflg;
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
<td valign="top" align="right"><a href="home_merger.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;</td>
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
