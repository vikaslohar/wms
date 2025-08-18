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
		$pid=trim($_POST['pid']);
		echo "<script>window.location='add_ivt_preview.php?p_id=$pid'</script>";
	}	
	
	
$sql_code="SELECT MAX(mergerm_tcode) FROM tbl_mergermain  where mergerm_yearid='$yearid_id' AND plantcode='$plantcode' ORDER BY mergerm_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="TLM".$code."/".$yearid_id."/".$lgnid;
			}
			else
			{
				$code=1;
				$code1="TLM".$code."/".$yearid_id."/".$lgnid;
			}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant -Transaction - IVT</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="ivt.js"></script>
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

function openslocpop()
{
if(document.frmaddDept.txtclass.value=="")
{
 alert("Please Select Crop");
 return false;
}
else if(document.frmaddDept.txtitem.value=="")
{
 alert("Please Select Production Variety");
 return false;
}
else if(document.frmaddDept.txtfritem.value=="")
{
 alert("Please Select Transfer From Variety");
 return false;
}
else if(document.frmaddDept.txttoitem.value=="")
{
 alert("Please Select Transfer To Variety");
 return false;
}
else
{
document.getElementById('maindiv').innerHTML="";
var crop=document.frmaddDept.txtclass.value;
var variety=document.frmaddDept.txtitem.value;
var frvariety=document.frmaddDept.txtfritem.value;
var nolots=document.frmaddDept.txttoitem.value;
var tid=document.frmaddDept.maintrid.value;

winHandle=window.open('getuser_ivt_lotno.php?crop='+crop+'&frvariety='+frvariety+'&tp='+tid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}





var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDept.reset();
	 popUpCalendar(document.frmaddDept.date,dt,document.frmaddDept.date, "dd-mmm-yyyy", xind, yind);
	}  


/*function isNumberKey(evt)
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
      }	  */
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
		if(document.frmaddDept.totalmqty.value!="")
		{
			document.frmaddDept.totalmqty.value=parseFloat(document.frmaddDept.totalmqty.value)+parseFloat(document.getElementById(y).value);
		}
		else
		{
			document.frmaddDept.totalmqty.value=parseFloat(document.getElementById(y).value);
		}
	}
	else
	{
	//alert(document.frmaddDept.totalmnob.value);
		var x="upsavl_"+chkval;
		var y="qtyavl_"+chkval;
		document.frmaddDept.totalmnob.value=parseFloat(document.frmaddDept.totalmnob.value)-parseFloat(document.getElementById(x).value);
		document.frmaddDept.totalmqty.value=parseFloat(document.frmaddDept.totalmqty.value)-parseFloat(document.getElementById(y).value);
		//alert(document.frmaddDept.totalmnob.value);
		if(document.frmaddDept.totalmnob.value<=0)
		document.frmaddDept.totalmnob.value="";
		if(document.frmaddDept.totalmqty.value<=0)
		document.frmaddDept.totalmqty.value="";
	}

}
function pcksel(selval)
{
	//alert(selval);
	document.frmaddDept.chkbox.value=selval;
	if(document.frmaddDept.srflg.value>0 && document.frmaddDept.srfet.checked==false)
	{
		alert("You have not selected SR status to new IVT Batch. \nPlease select the checkbox if you want SR status to be updated on IVT Batch.")
	}
	if(selval=="P")
	{
		document.getElementById("txttrnob1").value="";
		document.getElementById("txttrqty1").value="";
		document.getElementById("txttrnob1").readOnly=false;
		document.getElementById("txttrqty1").readOnly=false;
		document.getElementById("txttrnob1").style="background-color:#FFFFFF";
		document.getElementById("txttrqty1").style="background-color:#FFFFFF";
		document.getElementById("txtbalnob1").value="";
		document.getElementById("txtbalnob1").readOnly=false;
		document.getElementById("txtbalnob1").style="background-color:#FFFFFF";
		document.getElementById("txtbalqty1").value="";
		if (document.frmaddDept.srno2.value==2)
		{

			document.getElementById("txttrnob2").value="";
			document.getElementById("txttrqty2").value="";
			document.getElementById("txttrnob2").readOnly=false;
			document.getElementById("txttrqty2").readOnly=false;
			document.getElementById("txttrnob2").style="background-color:#FFFFFF";
			document.getElementById("txttrqty2").style="background-color:#FFFFFF";
			document.getElementById("txtbalnob2").value="";
			document.getElementById("txtbalnob2").readOnly=false;
			document.getElementById("txtbalnob2").style="background-color:#FFFFFF";
			document.getElementById("txtbalqty2").value="";
		}
	}
	else
	{
		document.getElementById("txttrnob1").value=parseInt(document.getElementById("txtavlnob1").value);
		document.getElementById("txttrqty1").value=parseFloat(document.getElementById("txtavlqty1").value);
		document.getElementById("txttrnob1").readOnly=true;
		document.getElementById("txttrqty1").readOnly=true;
		document.getElementById("txttrnob1").style="background-color:#CCCCCC";
		document.getElementById("txttrqty1").style="background-color:#CCCCCC";
		document.getElementById("txtbalnob1").value="0";
		document.getElementById("txtbalnob1").readOnly=true;
		document.getElementById("txtbalnob1").style="background-color:#CCCCCC";
		document.getElementById("txtbalqty1").value="0";
		if (document.frmaddDept.srno2.value==2)
		{
			document.getElementById("txttrnob2").value=parseInt(document.getElementById("txtavlnob2").value);
			document.getElementById("txttrqty2").value=parseFloat(document.getElementById("txtavlqty2").value);
			document.getElementById("txttrnob2").readOnly=true;
			document.getElementById("txttrqty2").readOnly=true;
			document.getElementById("txttrnob2").style="background-color:#CCCCCC";
			document.getElementById("txttrqty2").style="background-color:#CCCCCC";
			document.getElementById("txtbalnob2").value="0";
			document.getElementById("txtbalnob2").readOnly=true;
			document.getElementById("txtbalnob2").style="background-color:#CCCCCC";
			document.getElementById("txtbalqty2").value="0";
		}
	}
}
function nobchk(fval, fid)
{
	if(document.frmaddDept.chkbox.value=="")
	{
		alert("Please Select Entire / Partial");
		document.getElementById("txttrnob"+fid).value="";
		document.getElementById("txttrqty"+fid).value="";
		document.getElementById("txttrnob"+fid).readOnly=true;
		document.getElementById("txttrqty"+fid).readOnly=true;
		document.getElementById("txttrnob"+fid).style="background-color:#CCCCCC";
		document.getElementById("txttrqty"+fid).style="background-color:#CCCCCC";
		document.getElementById("txtbalnob"+fid).value="";
		document.getElementById("txtbalqty"+fid).value="";
		return false;
	}
	else if(fval=="")
	{
		alert('Please enter valid Transfered NoB');
		document.getElementById("txttrnob"+fid).value="";
		document.getElementById("txtbalnob"+fid).value="";
		return false;
	}
	else
	{
		if(parseInt(document.getElementById("txttrnob"+fid).value)>parseInt(document.getElementById("txtavlnob"+fid).value))
		{
			alert('Transfered NoB cannot be more than the Available NoB');
			document.getElementById("txttrnob"+fid).value="";
			document.getElementById("txtbalnob"+fid).value="";
			return false;
		}
		else
		{	
			document.getElementById("txtbalnob"+fid).value=parseInt(document.getElementById("txtavlnob"+fid).value)-parseInt(document.getElementById("txttrnob"+fid).value);
		}
	}
}
function upschk(fid,fval)
{
var a="upsavl_"+fval;
var b="balups_"+fval;
document.getElementById(b).value=parseInt(document.getElementById(a).value)-parseInt(fid);
}

function qtychk(qval, fid)
{
	if(document.frmaddDept.chkbox.value=="")
	{
		alert("Please Select Entire / Partial");
		document.getElementById("txttrnob"+fid).value="";
		document.getElementById("txttrqty"+fid).value="";
		document.getElementById("txttrnob"+fid).readOnly=true;
		document.getElementById("txttrqty"+fid).readOnly=true;
		document.getElementById("txttrnob"+fid).style="background-color:#CCCCCC";
		document.getElementById("txttrqty"+fid).style="background-color:#CCCCCC";
		document.getElementById("txtbalnob"+fid).value="";
		document.getElementById("txtbalqty"+fid).value="";
		return false;
	}
	else if(document.getElementById("txttrnob"+fid).value=="")
	{
		alert('Transfered NoB cannot be blank');
		document.getElementById("txttrqty"+fid).value="";
		document.getElementById("txtbalqty"+fid).value="";
		document.getElementById("txttrnob"+fid).focus();
		return false;
	}
	else if(qval=="")
	{
		alert('Please enter valid Transfered Qty');
		document.getElementById("txttrqty"+fid).value="";
		document.getElementById("txtbalqty"+fid).value="";
		return false;
	}
	else
	{
		if(parseFloat(document.getElementById("txttrqty"+fid).value)>parseFloat(document.getElementById("txtbalqty"+fid).value))
		{
			alert('Transfered Quantity cannot be more than the Available Quantity');
			document.getElementById("txttrqty"+fid).value="";
			document.getElementById("txtbalqty"+fid).value="";
			document.getElementById("txttrqty"+fid).focus();
			return false;
		}
		else
		{	
			document.getElementById("txtbalqty"+fid).value=parseFloat(document.getElementById("txtavlqty"+fid).value)-parseFloat(document.getElementById("txttrqty"+fid).value);
			document.getElementById("txtbalqty"+fid).value=parseFloat(document.getElementById("txtbalqty"+fid).value).toFixed(3);
		}
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
document.frmaddDept.txtitem.value="";
document.frmaddDept.txtfritem.value="";
document.frmaddDept.txtlot1.value="";
//document.frmaddDept.txtlotnumber.value="";
}

function modetchk24(classval24)
{
showUser(classval24,'frvitem','fritem','','','','','');
document.getElementById('maindiv').innerHTML="";
}
function modetchk6(classval24)
{
if(document.frmaddDept.txtitem.value=="")
{
	alert("Please select Variety first");
	document.frmaddDept.txtitem.focus();
}
document.getElementById('maindiv').innerHTML="";
var txtitem=document.frmaddDept.txtitem.value;
showUser(classval24,'tovitem','toitem',txtitem,'','','','');
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
		alert("No. of Lot(s) to be Merged can be TWO or more");
		document.frmaddDept.txtnlottom.value="";
		document.frmaddDept.txtlot1.value="";
		document.frmaddDept.txtnlottom.focus();
	}
	document.getElementById('maindiv').innerHTML="";
	document.frmaddDept.txtlot1.value="";
}
function piupschk()
{
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDept.txtitem.focus();
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

function getdetails()
{
	if(document.frmaddDept.txtlot1.value=="")
	{
	alert("Please Select Lot No.");
	document.frmaddDept.txtlot1.focus();
	return false;
	}
	var crop=document.frmaddDept.txtclass.value;
    var variety=document.frmaddDept.txtfritem.value;					
	var stage=document.frmaddDept.txtitem.value;
	var lotid=document.frmaddDept.txtlot1.value;
	var maintrid=document.frmaddDept.maintrid.value;
	var subtrid=document.frmaddDept.subtrid.value;
	showUser(crop,'maindiv','get',variety,stage,lotid,maintrid,subtrid,'');
}

function wh1(wh1val)
{ //alert(wh1val);
	var srno2=document.frmaddDept.srno2.value;
	//alert(srno2);
	var totqty=0;
	for(var i=1; i<=srno2; i++)
	{
	totqty=parseFloat(totqty)+parseFloat(document.getElementById("txttrqty"+i).value);
	}
	//alert(totqty);
	if(parseFloat(totqty) > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
	else
	{
		alert("Please enter Transfered Qty");
		document.frmaddDept.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDept.txtconslqty1.value=="" || document.frmaddDept.txtconslqty1.value==0)
	{
		alert("Please select Warehouse in first SLOC");
		document.frmaddDept.txtslwhg2.selectedIndex=0;
	}
	else
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
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
	var itemv=document.frmaddDept.txttoitem.value;
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
	var itemv=document.frmaddDept.txttoitem.value;
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
	if(sval==1)
	var nobb2="txtconslqty"+sval+1;
	else
	var nobb2="txtconslqty"+sval-1;
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
		var srno2=document.frmaddDept.srno2.value;
		var totqty=0;
		for(var i=1; i<=srno2; i++)
		{
			totqty=parseFloat(totqty)+parseFloat(document.getElementById("txttrqty"+i).value);
		}
		if(srno2==2)
		var totnob=parseFloat(document.getElementById(nobb).value)+parseFloat(document.getElementById(nobb2).value);
		else
		var totnob=parseFloat(document.getElementById(nobb).value);
		if(parseFloat(totnob)>parseFloat(totqty))
		{
			alert("Total Qty distributed in SLOC can not be more than Transfered Qty");
			document.getElementById(nobb).value="";
		}
	}
}
function Bagsf1(Bags1val, sval)
{
	var sbbin="txtslsubbg"+sval;
	var nobb="txtconslnob"+sval;
	if(sval==1)
	var nobb2="txtconslnob"+sval+1;
	else
	var nobb2="txtconslnob"+sval-1;
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
		var srno2=document.frmaddDept.srno2.value;
		var totqty=0;
		for(var i=1; i<=srno2; i++)
		{
			totqty=parseFloat(totqty)+parseFloat(document.getElementById("txttrnob"+i).value);
		}
		if(srno2==2)
		var totnob=parseInt(document.getElementById(nobb).value)+parseInt(document.getElementById(nobb2).value);
		else
		var totnob=parseInt(document.getElementById(nobb).value);
		if(parseInt(totnob)>parseInt(totqty))
		{
			alert("Total NoB distributed in SLOC can not be more than Transfered NoB");
			document.getElementById(nobb).value="";
		}
	}
}

function mySubmit()
{ 
	/*if(document.frmaddDept.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDept.txtcrop.focus();
		return false;
	}		
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Production Variety.");
		document.frmaddDept.txtitem.focus();
		return false;
	}		
	if(document.frmaddDept.txtfritem.value=="")
	{
		alert("Please Select Transfer from Variety.");
		document.frmaddDept.txtfritem.focus();
		return false;
	}	
	if(document.frmaddDept.txttoitem.value=="")
	{
		alert("Please Select Transfer to Variety.");
		document.frmaddDept.txttoitem.focus();
		return false;
	}	*/	
	if(document.frmaddDept.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	return true;	 
}

function pform()
{	
	var f=0;
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDept.txtclass.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Production Variety.");
		document.frmaddDept.txtitem.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDept.txtfritem.value=="")
	{
		alert("Please Select Transfer from Variety.");
		document.frmaddDept.txtfritem.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDept.txttoitem.value=="")
	{
		alert("Please Select Transfer to Variety.");
		document.frmaddDept.txttoitem.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDept.chkbox.value=="")
	{
		alert("Please Select Entire / Partial");
		document.frmaddDept.chkbox.focus();
		f=1;
		return false;
	}
	if(document.frmaddDept.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDept.txtlot1.focus();
		f=1;
		return false;
	}	
	//if(document.frmaddDept.chkbox.value=="P")
	{
		if(document.frmaddDept.srno2.value==2)
		{
			if(document.frmaddDept.txttrqty1.value=="" && document.frmaddDept.txttrqty2.value=="")
			{
				alert("Please enter Qty to Transfer");
				//document.frmaddDept.protype.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDept.txttrqty1.value=="")
			{
				alert("Please enter Qty to Transfer");
				//document.frmaddDept.protype.focus();
				f=1;
				return false;
			}
		}
	}
	if(document.frmaddDept.txttrqty1.value==0 && document.frmaddDept.txttrqty2.value==0)
	{
		alert("Please enter Qty to Transfer");
		//document.frmaddDept.txtconpl.focus();
		f=1;
		return false;
	}
	if(document.frmaddDept.txtslsubbg1.value=="" && document.frmaddDept.txtslsubbg2.value=="")
	{
		alert("Please SLOC for Condition Seed");
		//document.frmaddDept.txtconpl.focus();
		f=1;
		return false;
	}	
	else
	{	
		var q1="";
		var q2="";
		var g="";
		q1=document.frmaddDept.txtconslqty1.value;
		q2=document.frmaddDept.txtconslqty2.value;
		
		g=document.frmaddDept.txttrqty1.value;
		if(document.frmaddDept.srno2.value==2)
		{
		g=parseFloat(g)+parseFloat(document.frmaddDept.txttrqty2.value);
		}
		//var d=document.frmaddDept.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Transfered Quantity is not matching with Quantity distributed in Bins");
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
		//showUser(a,'postingsub','mform','','','','','');
		return true;
		}  
		//return false;
	}
	//return false;
}

function editrec(sid, trid)
{
	showUser(sid,'postingsub','subformedt',trid,'','','','');
}
function deleterec(sid, trid)
{
	if(confirm("Do you want to Delete this Record?")==true)
	showUser(sid,'postingtable','delete',trid,'','','','');
	else
	return false;
}
function pformedtup()
{	
	var f=0;
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDept.txtclass.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Production Variety.");
		document.frmaddDept.txtitem.focus();
		f=1;
		return false;
	}		
	if(document.frmaddDept.txtfritem.value=="")
	{
		alert("Please Select Transfer from Variety.");
		document.frmaddDept.txtfritem.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDept.txttoitem.value=="")
	{
		alert("Please Select Transfer to Variety.");
		document.frmaddDept.txttoitem.focus();
		f=1;
		return false;
	}	
	if(document.frmaddDept.chkbox.value=="")
	{
		alert("Please Select Entire / Partial");
		document.frmaddDept.chkbox.focus();
		f=1;
		return false;
	}
	if(document.frmaddDept.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDept.txtlot1.focus();
		f=1;
		return false;
	}	
	//if(document.frmaddDept.chkbox.value=="P")
	{
		if(document.frmaddDept.srno2.value==2)
		{
			if(document.frmaddDept.txttrqty1.value=="" && document.frmaddDept.txttrqty2.value=="")
			{
				alert("Please enter Qty to Transfer");
				//document.frmaddDept.protype.focus();
				f=1;
				return false;
			}
		}
		else
		{
			if(document.frmaddDept.txttrqty1.value=="")
			{
				alert("Please enter Qty to Transfer");
				//document.frmaddDept.protype.focus();
				f=1;
				return false;
			}
		}
	}
	if(document.frmaddDept.txttrqty1.value==0 && document.frmaddDept.txttrqty2.value==0)
	{
		alert("Please enter Qty to Transfer");
		//document.frmaddDept.txtconpl.focus();
		f=1;
		return false;
	}
	if(document.frmaddDept.txtslsubbg1.value=="" && document.frmaddDept.txtslsubbg2.value=="")
	{
		alert("Please SLOC for Condition Seed");
		//document.frmaddDept.txtconpl.focus();
		f=1;
		return false;
	}	
	else
	{	
		var q1="";
		var q2="";
		var g="";
		q1=document.frmaddDept.txtconslqty1.value;
		q2=document.frmaddDept.txtconslqty2.value;
		
		g=document.frmaddDept.txttrqty1.value;
		if(document.frmaddDept.srno2.value==2)
		{
		g=parseFloat(g)+parseFloat(document.frmaddDept.txttrqty2.value);
		}
		//var d=document.frmaddDept.txtdcnob.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2);
		//var qtyd=parseFloat(q4)+parseFloat(q5);
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Transfered Quantity is not matching with Quantity distributed in Bins");
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
		showUser(a,'postingtable','mformddupdate','','','','','');
		return true;
		}
	}
}


</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Inter Variety Transfer - Edit</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
<?php
	$sql1=mysqli_query($link,"select * from tbl_ivtmain where ivt_id=$pid AND plantcode='$plantcode'")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql1);
$tid=$pid;
$subtid=0;
 
$tdate=$row['ivt_date'];
$tyear=substr($tdate,0,4);
$tmonth=substr($tdate,5,2);
$tday=substr($tdate,8,2);
$tdate=$tday."-".$tmonth."-".$tyear;

$code="TVT".$row['ivt_tcode']."/".$row['ivt_yearid']."/".$row['ivt_logid'];	
	
?>	  
	    <td align="center" colspan="4" >
		<form id="mainform"  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="hidden" name="code" value="<?php echo $row['mergerm_tcode']?>" />
	 <input type="hidden" name="logid" value="<?php echo $logid?>" />
	 <input type="hidden" name="pid" value="<?php echo $pid;?>" />
	 <input type="hidden" name="txtstage" value="Condition" />
</br>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">

<td>
<div id="postingtable">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Add Inter Variety Transfer</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
           <td width="202" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID&nbsp;</td>
           <td width="268"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
		   
		   <td width="183" height="24"  align="right"  valign="middle" class="tblheading">IVT&nbsp;Date&nbsp;</td>
           <td width="287" align="left"  valign="middle">&nbsp;<?php echo $tdate;?><input name="txtdate" type="hidden" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $tdate;?>" /></td>
</tr>
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['ivt_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Dark" height="25">
   <td width="202"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden"  class="tbltext" name="txtclass" value="<?php echo $noticia_class['cropid'];?>"  /></td>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_pvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver = mysqli_fetch_array($itemqry);
?>            
<td align="right" valign="middle" class="tblheading">Production Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="vitem" >&nbsp;<?php echo $noticia_ver['popularname'];?><input type="hidden"  class="tbltext" name="txtitem" id="itm" value="<?php echo $noticia_ver['varietyid'];?>"  /></td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
  <?php 
$itemqry2=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_trfromvariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver2 = mysqli_fetch_array($itemqry2);

$itemqry3=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ivt_trtovariety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_ver3 = mysqli_fetch_array($itemqry3);
?>            
	<td align="right" valign="middle" class="tblheading">Transfer From - Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="frvitem">&nbsp;<?php echo $noticia_ver2['popularname'];?><input type="hidden"  class="tbltext" name="txtfritem" id="fritm" value="<?php echo $noticia_ver2['varietyid'];?>"  /></td>
<td align="right" valign="middle" class="tblheading">Transfer To - Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="tovitem">&nbsp;<?php echo $noticia_ver3['popularname'];?><input type="hidden"  class="tbltext" name="txttoitem" id="toitm" value="<?php echo $noticia_ver3['varietyid'];?>"  /></td>
</tr>		
</table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
<td width="1%" align="center" valign="middle" class="tblheading">Inter Variety Transfer Lots(N)</td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
	<td width="1%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="12%" align="center" valign="middle" class="smalltblheading">Original Lot No.</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading">Entire/Partial</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading">New Lot No.</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="9%" align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="3%" align="center" valign="middle" class="smalltblheading">Edit</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading">Delete</td>
</tr>

<?php
$sr=1;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_ivtsub where ivt_id=$tid AND plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

$stage='Condition';
$olotn=$row_eindent_sub['ivts_olotno'];
$lotn=$row_eindent_sub['ivts_nlotno'];
$onob=$row_eindent_sub['ivts_onob'];
$oqty=$row_eindent_sub['ivts_oqty'];
$ttntyp=$row_eindent_sub['ivts_trnall'];
if($ttntyp=="E")$ttntyp="Entire";
if($ttntyp=="P")$ttntyp="Partial";
$slups=0; $slqty=0; $sloc=""; 
$sql_tblissue=mysqli_query($link,"select * from tbl_ivtsub_sub2 where ivt_id='".$tid."' and ivts_id='".$row_eindent_sub['ivts_id']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{
$slups=$slups+$row_tblissue['ivtss2_nob'];
$slqty=$slqty+$row_tblissue['ivtss2_qty'];

$wareh=""; $binn=""; $subbinn="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tblissue['ivtss2_wh']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tblissue['ivtss2_bin']."' and whid='".$row_tblissue['ivtss2_wh']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tblissue['ivtss2_subbin']."' and binid='".$row_tblissue['ivtss2_bin']."' and whid='".$row_tblissue['ivtss2_wh']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($sloc!="")
$sloc=$sloc."<br />".$wareh."/".$binn."/".$subbinn."|".$row_tblissue['ivtss2_nob']."|".$row_tblissue['ivtss2_qty'];
else
$sloc=$wareh."/".$binn."/".$subbinn."|".$row_tblissue['ivtss2_nob']."|".$row_tblissue['ivtss2_qty'];
}

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $onob;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $oqty;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $ttntyp;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $sloc;?></td>
	<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $onob;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $oqty;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $ttntyp;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $sloc;?></td>
	<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ivts_id'];?>,<?php echo $row_eindent_sub['ivt_id'];?>);" /></td>
</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
</table>
<br />
<div id="postingsub">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Select Lot No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="smalltbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<a href="Javascript:void(0);" onclick="getdetails();">Get Details</a>&nbsp;(After selection of lot, click on 'Get Details')</td>
</tr>
</table>
<br />

<div id="maindiv" style="display:block"></div>	
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>	
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_ivt.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;</td>
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
