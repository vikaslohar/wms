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
		$trid=trim($_POST['trid']);
		$sr=trim($_POST['sr']);
		$sid=trim($_POST['sid']);
		$sid2=trim($_POST['sid2']);
		$sid3=trim($_POST['sid3']);
		$remarks=trim($_POST['txtremarks']);
		$remarks=str_replace("&","and",$remarks);
		
		$sx=""; $g=0;
		$sd2=explode(",",$sid3);
		$sd3=explode(",",$sid2);
		for($i=0; $i<count($sd2);$i++)
		{
			$val2=$sd2[$i];
			$val=$sd3[$i];
			$asd=explode(" ",$val);
			$vl=$asd[1];
			//echo $asd;
			if($asd[0]=="Group")
				$sq2="update tbl_blends set blends_group='$vl', blends_delflg=0 where blendm_id='$trid' and blends_id='$val2'";
			else if($asd[0]=="Deleted")
				$sq2="update tbl_blends set blends_group=0, blends_delflg=1 where blendm_id='$trid' and blends_id='$val2'";
			else if($asd[0]=="Open")
				$sq2="update tbl_blends set blends_group=0, blends_delflg=0 where blendm_id='$trid' and blends_id='$val2'";
			else
				$sq2="update tbl_blends set blendm_id='$trid' where blendm_id='$trid' and blends_id='$val2'";
			$cx2=mysqli_query($link,$sq2) or die(mysqli_error($link));
			if($sx!="")
				$sx=$sx.",".$val2;
			else
				$sx=$val2;
		}
		
		$gflg=0;
		$sql_sub=mysqli_query($link,"select distinct blends_group from tbl_blends where blendm_id='$trid' and blends_group>0 group by blends_group order by blends_group asc") or die(mysqli_error($link));
		while($row_sub=mysqli_fetch_array($sql_sub))
		{
			$sql_sub23=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and blends_group='".$row_sub['blends_group']."' order by blends_group asc") or die(mysqli_error($link));	
			if($tot_sub23=mysqli_num_rows($sql_sub23) == 1)$gflg++;
		}
		echo $gflg;
		$sq="update tbl_blendm set blendm_qcremarks='$remarks' where blendm_id='$trid'";
		$cx=mysqli_query($link,$sq) or die(mysqli_error($link));
		
		if($gflg > 0)
		{
			echo "<script>alert('Cannot Authorise the transaction. Reason: Cannot create new Group/Re-group with single lot. Select 2 or more lots to create new Group/Re-group.');window.location='edit_lotmerger.php?p_id=$trid;'</script>";
		}
		else
		{
			echo "<script>window.location='add_merger_preview.php?p_id=$trid'</script>";
		}
	}	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Manager -Transaction - Lot Blending</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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

/*function openslocpop1()
{
	
	if(document.frmaddDept.txtitem.value!="")
	{
		
		var itm=document.frmaddDept.txtitem.value;
		winHandle=window.open('item_sloc_details.php?itmid='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
	}
	else
	{
		alert("Please Select Variety");
		document.frmaddDept.txtitem.focus();
	}
}*/
function openslocpop()
{
if(document.frmaddDept.txtclass.value=="")
{
 alert("Please Select Crop");
 return false;
}
else if(document.frmaddDept.txtitem.value=="")
{
 alert("Please Select Variety");
 return false;
}
else if(document.frmaddDept.txtstage.value=="")
{
 alert("Please Select Stage");
 return false;
}
/*else if(document.frmaddDept.txtnlottom.value=="")
{
 alert("Please enter No. of Lot(s) to be Blending");
 return false;
}*/
else
{
document.getElementById('maindiv').innerHTML="";
//document.getElementById("postingsubsubtable").innerHTML="";
document.frmaddDept.txtlot1.value="";
document.frmaddDept.txtnlottom.value="";
var crop=document.frmaddDept.txtclass.value;
var variety=document.frmaddDept.txtitem.value;
var stage=document.frmaddDept.txtstage.value;
var nolots=document.frmaddDept.txtnlottom.value;
var tid="Lot Blending";

winHandle=window.open('getuser_merger_lotno.php?crop='+crop+'&variety='+variety+'&tp='+tid+'&stage='+stage+'&nolots='+nolots,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function mySubmit()
{ 
	if(document.frmaddDept.itmdchk.value > 0)
	{
		alert("Please Select Lot Number(s) to create Group.");
		return false;
	}	
	if(document.frmaddDept.gflg.value!=0)
	{
		alert("Cannot create new Group/Re-group with single lot. Select 2 or more lots to create new Group/Re-group");
		return false;
	}
	var sr=document.frmaddDept.sr.value;
	var s=0; var sid=""; var sid2=""; var sid3="";
	for (var i=1; i<sr; i++)
	{ 
		var gprs="grps_"+i;
		var gpr="ddval_"+i;
		var ddval="ddsid_"+i;
		if(document.getElementById(gprs).checked==true)
		{
			if(sid!="")
				sid=sid+","+document.getElementById(gprs).value;
			else
				sid=document.getElementById(gprs).value;
			s++;
		}
		
		if(document.getElementById(gpr).value!="")
		{
			if(sid2!="")
				sid2=sid2+","+document.getElementById(gpr).value;
			else
				sid2=document.getElementById(gpr).value;
			if(sid3!="")
				sid3=sid3+","+document.getElementById(ddval).value;
			else
				sid3=document.getElementById(ddval).value;
			//s++;		
		}
	}
	document.frmaddDept.sid.value=sid;
	document.frmaddDept.sid2.value=sid2;
	document.frmaddDept.sid3.value=sid3;
	return true;	 
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
if(document.frmaddDept.txtitem.value=="")
{
	alert("Please select Variety first");
	document.frmaddDept.txtitem.focus();
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
/*
function classchk(itval)
{
if(document.frmaddDept.txtclass.value!="")
	{	
		if(document.frmaddDept.txtitem.value!="")
		{
			if(document.frmaddDept.itmdchk.value!="")
			{ 
				var flg=0;
				var itmchk=document.frmaddDept.itmdchk.value;
				var itm=itmchk.split(",");
				for(var i=0; i < itm.length; i++)
				{
					if(document.frmaddDept.txtitem.value==itm[i])
					{
						flg=1;
					}
				}
				if(flg==1)
				{
					alert("Please Check, this Variety is already posted in this transaction");
					document.frmaddDept.txtitem.selectedIndex=0;
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
		//document.frmaddDept.txtitem.
		document.frmaddDept.txtitem.selectedIndex=0;
		document.frmaddDept.txtclass.focus();
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
		var crop=document.frmaddDept.txtclass.value;
        var variety=document.frmaddDept.txtitem.value;					
		var stage=document.frmaddDept.txtstage.value;
		var lotid=document.frmaddDept.txtlot1.value;
		//showUser(crop,'maindiv','get',variety,stage,lotid,'','','');
}

function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDept.totalmqty.value > 0)
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
	if(document.frmaddDept.totalmqty.value > 0)
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
	var itemv=document.frmaddDept.txtitem.value;
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
	var itemv=document.frmaddDept.txtitem.value;
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

function chkall()
{
	var sr=document.frmaddDept.sr.value;
	for (var i=1; i<sr; i++)
	{
		var gprs="grps_"+i;
		document.getElementById(gprs).checked=true;
	}
}
function clall()
{
	var sr=document.frmaddDept.sr.value;
	for (var i=1; i<sr; i++)
	{
		var gprs="grps_"+i;
		document.getElementById(gprs).checked=false;
	}
}

function groupchk()
{
	var sr=document.frmaddDept.sr.value;
	var s=0; var sid=""; var sid2=""; var sid3="";
	for (var i=1; i<sr; i++)
	{ 
		var gprs="grps_"+i;
		var gpr="ddval_"+i;
		var ddval="ddsid_"+i;
		if(document.getElementById(gprs).checked==true)
		{
			if(sid!="")
				sid=sid+","+document.getElementById(gprs).value;
			else
				sid=document.getElementById(gprs).value;
			s++;
		}
		
		if(document.getElementById(gpr).value!="")
		{
			if(sid2!="")
				sid2=sid2+","+document.getElementById(gpr).value;
			else
				sid2=document.getElementById(gpr).value;
			if(sid3!="")
				sid3=sid3+","+document.getElementById(ddval).value;
			else
				sid3=document.getElementById(ddval).value;
			//s++;		
		}
	}
	/*alert(sid);
	alert(sid2);
	alert(sid3);*/
	/*if(document.frmaddDept.gflg.value!=0)
	{
		alert("Cannot create new Group/Re-group with single lot. Select 2 or more lots to create new Group/Re-group");
		return false;
	}
	else*/ 
	if(s!=0 && s==1)
	{
		alert("Cannot create new Group/Re-group with single lot. Select 2 or more lots to create new Group/Re-group");
		return false;
	}
	else
	{
		var trid=document.frmaddDept.trid.value;
		showUser(sid,'maindiv','get',trid,sid2,sid3,'group','','');
	}
}

function recdele()
{
	var sr=document.frmaddDept.sr.value;
	var s=0; var sid=""; var sid2=""; var sid3="";
	for (var i=1; i<sr; i++)
	{ 
		var gprs="grps_"+i;
		var gpr="ddval_"+i;
		var ddval="ddsid_"+i;
		if(document.getElementById(gprs).checked==true)
		{
			if(sid!="")
				sid=sid+","+document.getElementById(gprs).value;
			else
				sid=document.getElementById(gprs).value;
			s++;
		}
		
		if(document.getElementById(gpr).value!="")
		{
			if(sid2!="")
				sid2=sid2+","+document.getElementById(gpr).value;
			else
				sid2=document.getElementById(gpr).value;
			if(sid3!="")
				sid3=sid3+","+document.getElementById(ddval).value;
			else
				sid3=document.getElementById(ddval).value;
			s++;		
		}
	}
	var trid=document.frmaddDept.trid.value;
	showUser(sid,'maindiv','get',trid,sid2,sid3,'delete','','');
}

function ddvalchk(val, sid, subid)
{
	var ddval="ddval_"+sid;
	var ddsid="ddsid_"+sid;
	document.getElementById(ddval).value=val;
	document.getElementById(ddsid).value=subid;
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Lot Blending</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
<?php
	$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id=$pid")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; 
	$drole=$row['blendm_logid'];
	$tdate=$row['blendm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>	  
	    <td align="center" colspan="4" >
		<form id="mainform"  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="hidden" name="code" value="<?php echo $row['blendm_tcode']?>" />
	 <input type="hidden" name="code" value="<?php echo $row['blendm_tcode']?>" />
	 <input type="hidden" name="logid" value="<?php echo $logid?>" />
	 <input type="hidden" name="sid" value="<?php echo $sid?>" />
	 <input type="hidden" name="sid2" value="<?php echo $sid2?>" />
	 <input type="hidden" name="sid3" value="<?php echo $sid3?>" />
</br>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Lot Blending</td>
</tr>
<tr class="Dark" height="20">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "LB".$row['blendm_code']."/".$row['blendm_yearid']."/".$drole;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Blending Request Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['blendm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);

$explotno='';
$sql_indent_sub6=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid'") or die(mysqli_error($link));
$row_indent_sub6=mysqli_fetch_array($sql_indent_sub6);
$explotno=$row_indent_sub6['blends_newlot'];
?>
<tr class="Light" height="20">
<td width="174"  align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $noticia_class['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>

<tr class="Light" height="20">
<td width="174"  align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['blendm_stage'];?></td>
<td align="right"  valign="middle" class="tblheading">No. of Lots to be Blended&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['blendm_nolots'];?></td>
</tr>
<!--<tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">New Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['blendm_newlot'];?></td>
</tr>-->	
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Lot Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['blendm_lottype'];?><input type="hidden" name="lottype" value="<?php echo $row['blendm_lottype'];?>" /></td>

<td align="right" valign="middle" class="tblheading">Export Lot&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="lotnshow" >&nbsp;<?php if($row['blendm_lottype']=="Export"){echo $explotno;}?></td>

</tr>	
</table>
<br />

<div id="maindiv" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <td  align="center" valign="middle" class="tblheading" >Blending Lots</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="17" rowspan="2"  align="center" valign="middle" class="smalltblheading">#</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
		<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
        <td width="64" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
		<td width="83" rowspan="2"  align="center" valign="middle" class="smalltblheading">SLOC</td>
		<td colspan="6"  align="center" valign="middle" class="smalltblheading">Quality Status</td>
		<td width="73" rowspan="2"  align="center" valign="middle" class="smalltblheading">Arrival Type</td>
		<td width="111" rowspan="2"  align="center" valign="middle" class="smalltblheading">Production Location</td>
		<td width="73" rowspan="2"  align="center" valign="middle" class="smalltblheading">Date of Harvest</td>
		<td width="73" rowspan="2"  align="center" valign="middle" class="smalltblheading">LE Duration &amp; Date</td>
		<td width="92" rowspan="2"  align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="chkall();">CA</a>/<a href="Javascript:void(0);" onclick="clall();">CL</a></td>
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
$grs=""; $drs=""; $grpflg=0; $delflg=0; $gflg=0;
$sql_sub=mysqli_query($link,"select distinct blends_group from tbl_blends where blendm_id='$trid' and blends_group>0 group by blends_group order by blends_group asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	if($grs!="")
		$grs=$grs.",".$row_sub['blends_group'];
	else
		$grs=$row_sub['blends_group'];	
	$sql_sub23=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and blends_group='".$row_sub['blends_group']."' order by blends_group asc") or die(mysqli_error($link));	
	if($tot_sub23=mysqli_num_rows($sql_sub23) == 1)$gflg++;
}
$sql_sub=mysqli_query($link,"select distinct blends_delflg from tbl_blends where blendm_id='$trid' and blends_delflg>0 group by blends_delflg order by blends_delflg asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$drs=$row_sub['blends_delflg'];	
}

//echo $gflg;
$sr=1; $itmdchk=0;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' order by blends_group asc, blends_lotno asc") or die(mysqli_error($link));
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
$sql_rr=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$noticia_class['cropname']."' and lotvariety='".$noticia_item['popularname']."' and SUBSTRING(orlot,1,13)='$olot2' order by orlot asc") or die(mysqli_error($link));
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

$sql_is3=mysqli_query($link,"select lotldg_trtype from tbl_lot_ldg where  lotldg_crop='".$row['blendm_crop']."' and SUBSTRING(lotldg_lotno, 1,13)='".$olot2."' and lotldg_variety='".$row['blendm_variety']."' order by lotldg_id asc") or die(mysqli_error($link));
$row_is3=mysqli_fetch_array($sql_is3);
$trtype=$row_is3['lotldg_trtype'];

$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $dogt="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row['blendm_variety']."'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$row['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row['blendm_variety']."'  order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
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

			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
					
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
						
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
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

$leupto=''; $dt='';	$dp1='';		

$sql_spc=mysqli_query($link,"select * from tbl_lemain where le_lotno='".$row_eindent_sub['blends_lotno']."'") or die(mysqli_error($link));
$row_spc=mysqli_fetch_array($sql_spc);
$xx=mysqli_num_rows($sql_spc);

if($xx == 0)
{	
	
	$dt=$noticia_item['leduration'];

	if($pdate!="")
	{
		$trdate2=explode("-",$pdate);
		$m=$trdate2[1];
		$de=$trdate2[0];
		$y=$trdate2[2];
		
		if($dt!="" && $dt>0)
		{
			for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
		}
		else
		{$dp1="";}
	}
	else
	{$dp1="";}
}
else
{
	$dt=$row_spc['le_duration'];
	$dp2=$row_spc['le_upto'];
	$dp1=$dp[2]."-".$dp[1]."-".$dp[0];
}	
$leupto=$dp1;


$gotgrade='';
$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$row_eindent_sub['lotldg_lotno']."'") or die(mysqli_error($link));
$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
$gotgrade=$row_tbl_gotgrade['gotgrade_finalgrade'];

$qry_tbl_gottest=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$row_eindent_sub['lotldg_lotno']."'") or die(mysqli_error($link));
$tot_tbl_gottest=mysqli_num_rows($qry_tbl_gottest);	
$row_tbl_gottest=mysqli_fetch_array($qry_tbl_gottest);	
if($row_tbl_gottest['grade']!='' && $row_tbl_gottest['grade']!=NULL && $row_tbl_gottest['grade']!='NULL')
{$gotgrade=$row_tbl_gottest['grade'];}
			
if($sr%2!=0)
{
?>		  
	<tr <? $zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") {echo "bgcolor='#EE9A4D'";} else if($mlot>=90000 && $llot!="00000") {if($trtype=="Merger")$trtype="SR Merger";echo "bgcolor='#FFE5B4'"; }else ""?> height="20" class="smalltbltext">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $germ?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dogt?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotgrade?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $trtype?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $pdate?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $leupto;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) {?><input type="checkbox" class="smalltbltext" name="grps" id="grps_<?php echo $sr;?>" value="<?php echo $subid;?>" /><?php } else { ?><select name="grp" id="grp_<?php echo $sr;?>" class="smalltbltext" style="size:70px;" onchange="ddvalchk(this.value,'<?php echo $sr;?>','<?php echo $subid;?>')" >
		<option <?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Selected";?> value="Open">Open</option>
		<?php $gs=explode(",",$grs); foreach($gs as $val){ if($val<>""){ ?>
		<option <?php if($row_eindent_sub['blends_group']==$val) echo "Selected";?> value="Group <?php echo $val?>">Group <?php echo $val?></option>
		<?php } }?>
		<option <?php if($row_eindent_sub['blends_delflg']>0) echo "Selected";?> value="Deleted <?php echo $val?>">Deleted</option>
		</select><input type="hidden" class="smalltbltext" name="grps" id="grps_<?php echo $sr;?>" value="" /><?php }?><input type="hidden" name="ddval" id="ddval_<?php echo $sr;?>" value="<?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Open"; else if($row_eindent_sub['blends_group']>0 && $row_eindent_sub['blends_delflg']==0) echo "Group ".$row_eindent_sub['blends_group']; else if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']>0) echo "Deleted ".$row_eindent_sub['blends_delflg']; else echo "";?>" /><input type="hidden" name="ddsid" id="ddsid_<?php echo $sr;?>" value="<?php echo $subid;?>" /></td>
	</tr>

<?php
}
else
{
?>
	<tr <? $zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") {echo "bgcolor='#EE9A4D'";} else if($mlot>=90000 && $llot!="00000"){if($trtype=="Merger")$trtype="SR Merger";echo "bgcolor='#FFE5B4'"; } else ""?> height="20" class="smalltbltext">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $germ?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dogt?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotgrade?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $trtype?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $pdate?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $leupto;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) {?><input type="checkbox" class="smalltbltext" name="grps" id="grps_<?php echo $sr;?>" value="<?php echo $subid;?>" /><?php } else { ?><select name="grp" id="grp_<?php echo $sr;?>" class="smalltbltext" style="size:70px;" onchange="ddvalchk(this.value,'<?php echo $sr;?>','<?php echo $subid;?>')" >
		<option <?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Selected";?> value="Open">Open</option>
		<?php $gs=explode(",",$grs); foreach($gs as $val){ if($val<>""){ ?>
		<option <?php if($row_eindent_sub['blends_group']==$val) echo "Selected";?> value="Group <?php echo $val?>">Group <?php echo $val?></option>
		<?php } }?>
		<option <?php if($row_eindent_sub['blends_delflg']>0) echo "Selected";?> value="Deleted <?php echo $val?>">Deleted</option>
		</select><input type="hidden" class="smalltbltext" name="grps" id="grps_<?php echo $sr;?>" value="" /><?php }?><input type="hidden" name="ddval" id="ddval_<?php echo $sr;?>" value="<?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Open"; else if($row_eindent_sub['blends_group']>0 && $row_eindent_sub['blends_delflg']==0) echo "Group ".$row_eindent_sub['blends_group']; else if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']>0) echo "Deleted ".$row_eindent_sub['blends_delflg']; else echo "";?>" /><input type="hidden" name="ddsid" id="ddsid_<?php echo $sr;?>" value="<?php echo $subid;?>" /></td>
	</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
<input type="hidden" name="sr" value="<?php echo $sr;?>" />	
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
<input type="hidden" name="gflg" value="<?php echo $gflg;?>" />
</table>


<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
  <tr height="10"><td></td></tr>
  <tr height="20">
    <td width="647"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#EE9A4D" class="tblheading" >&nbsp;</td>
    <td width="80"  align="left" valign="middle" class="tblheading" >&nbsp;Blended Lot</td>
    <td width="15"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#FFE5B4" class="tblheading" >&nbsp;</td>
    <td width="148"  align="left" valign="middle" class="tblheading" >&nbsp;Sales Return Blended Lot</td>
  </tr>
</table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right">&nbsp;<?php if($grpflg+$delflg!=$tot_rows){?><img src="../images/delete.gif" border="0"style="display:inline;cursor:pointer;" onclick="recdele()" /><?php }?>&nbsp;&nbsp;<img src="../images/group.gif" border="0"style="display:inline;cursor:pointer;" onclick="groupchk();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
	
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="119" align="right"  valign="middle" class="smalltblheading">&nbsp;Requester Remarks&nbsp;</td>
<td width="825" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row['blendm_remarks'];?></td>
</tr></table>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="119" align="right"  valign="middle" class="smalltblheading">&nbsp;QCM Remarks&nbsp;</td>
<td width="825" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="132" maxlength="150" value="<?php echo $row['blendm_qcremarks'];?>" ></td>
</tr></table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_merger.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;</td>
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
