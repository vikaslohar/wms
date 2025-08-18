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
		$code=trim($_POST['code']);
		$chkbox=trim($_POST['chkbox']);
		$srno=trim($_POST['srno1']);
		$txtnlottom=trim($_POST['txtnlottom']);
		$txtclass=trim($_POST['txtclass']);
		$txtdate=trim($_POST['txtdate']);
		$txtitem=trim($_POST['txtitem']);
		$txtstage=trim($_POST['txtstage']);
		$txtlot1=trim($_POST['txtlot1']);
		$txtlotnumber=trim($_POST['txtlotnumber']);
		$totmnob=trim($_POST['totmnob']);
		$totmqty=trim($_POST['totmqty']);
		$remarks=trim($_POST['txtremarks']);
		$remarks=str_replace("&","and",$remarks);
		$orlot=trim($_POST['orlot']);
		
		$wh1=trim($_POST['txtslwhg1']);
		$bin1=trim($_POST['txtslbing1']);
		$subbin1=trim($_POST['txtslsubbg1']);
		$nnob1=trim($_POST['txtconslnob1']);
		$nqty1=trim($_POST['txtconslqty1']);
		
		$wh2=trim($_POST['txtslwhg2']);
		$bin2=trim($_POST['txtslbing2']);
		$subbin2=trim($_POST['txtslsubbg2']);
		$nnob2=trim($_POST['txtconslnob2']);
		$nqty2=trim($_POST['txtconslqty2']);
		
		$ccnt=0;
		if($nqty1!="" && $nqty1!=0) $ccnt++;
		if($nqty2!="" && $nqty2!=0) $ccnt++;
		
		$tdate=$txtdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;	
		
		$p1_array=explode(",",$chkbox);	
		$p1_array1=explode(",",$srno);
		//print_r($p1_array1);
		$numrec=count($p1_array);
		
		$sql_ins="Insert into tbl_mergermain (mergerm_tcode, mergerm_date, mergerm_crop, mergerm_variety, mergerm_newlot, mergerm_stage, mergerm_nob, mergerm_qty, mergerm_orlot, mergerm_oldlot, mergerm_remarks, mergerm_logid, mergerm_yearid, plantcode) values('$code', '$tdate', '$txtclass', '$txtitem', '$txtlotnumber', '$txtstage', '$totmnob', '$totmqty', '$orlot', '$txtnlottom', '$remarks', '$logid', '$yearid_id', '$plantcode')";
		//exit;
		if(mysqli_query($link,$sql_ins) or die(mysqli_error($link)))
		{
			$mainid=mysqli_insert_id($link);
			for($num=1; $num<=$srno; $num++)
			{
				//$p1_array[$num];
				//$p1_array1[$num];
				//$ups="upsavl_".$num;
				//$qty="qtyavl_".$num;
				$lot="lotno_".$num;
				//$qc="qcst_".$num;
				//$got="gotst_".$num;
				//$srsts="srst_".$num;
				
				/*if(isset($_POST[$ups]))
				{
				$ups1 = $_POST[$ups];	 
				}	
				if(isset($_POST[$qty]))
				{
				$qty1 = $_POST[$qty];	 
				}	*/
				if(isset($_POST[$lot]))
				{
				$lot1 = $_POST[$lot];	 
				}
				/*if(isset($_POST[$qc]))
				{
				$qc1 = $_POST[$qc];	 
				}
				if(isset($_POST[$got]))
				{
				$got1 = $_POST[$got];	 
				}
				if(isset($_POST[$srsts]))
				{
				$srsts1 = $_POST[$srsts];	 
				}*/
				
				$sql_sub_sub="insert into tbl_mergersub(mergerm_id, mergers_lotno, plantcode) values('$mainid', '$lot1', '$plantcode')";
	
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			}
				
			if($nqty1!="" && $nqty1 > 0)
			{
				$sql_sub="insert into tbl_mergersubsub(mergerm_id, mergerss_whid, mergerss_binid, mergerss_subbinid, mergerss_nob, mergerss_qty, plantcode)values('$mainid','$wh1','$bin1','$subbin1','$nnob1','$nqty1', '$plantcode')";
				mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			}
			if($nqty2!="" && $nqty2 > 0)
			{
				$sql_sub="insert into tbl_mergersubsub(mergerm_id, mergerss_whid, mergerss_binid, mergerss_subbinid, mergerss_nob, mergerss_qty, plantcode)values('$mainid','$wh2','$bin2','$subbin2','$nnob2','$nqty2', '$plantcode')";
				mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			}
			
			//exit;
			echo "<script>window.location='add_merger_preview1.php?p_id=$mainid'</script>";
		}
		
	}	
	
	
	$sql_code="SELECT MAX(mergerm_tcode) FROM tbl_mergermain  where mergerm_yearid='$yearid_id' and plantcode='$plantcode' ORDER BY mergerm_tcode DESC";
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
<title>Plant -Transaction - Lot Merger</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="lotmerger1.js"></script>
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
else if(document.frmaddDept.txtnlottom.value=="")
{
 alert("Please enter No. of Lot(s) to be Merged");
 return false;
}
else
{
document.getElementById('maindiv').innerHTML="";
//document.getElementById("postingsubsubtable").innerHTML="";
document.frmaddDept.txtlot1.value="";
//document.frmaddDept.txtlotnumber.value="";
var crop=document.frmaddDept.txtclass.value;
var variety=document.frmaddDept.txtitem.value;
var stage=document.frmaddDept.txtstage.value;
var nolots=document.frmaddDept.txtnlottom.value;
var tid="Lot Merger";

winHandle=window.open('getuser_merger_lotno.php?crop='+crop+'&variety='+variety+'&tp='+tid+'&stage='+stage+'&nolots='+nolots,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function mySubmit()
{ 
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Select Crop");
		document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDept.txtitem.focus();
		return false;
	}
	if(document.frmaddDept.txtstage.value=="")
	{
		alert("Please Select Stage.");
		document.frmaddDept.txtstage.focus();
		return false;
	}
	/*if(document.frmaddDept.txtlotnumber.value=="")
	{
		alert("Please Select Lot Number.");
		//document.frmaddDept.txtlotnumber.focus();
		return false;
	}*/
	 if(document.frmaddDept.txtnlottom.value=="")
	{
	 alert("Please enter No. of Lot(s) to be Merged");
	 return false;
	}
	/*if(document.frmaddDept.chkbox.value=="")
	{
		alert("Please Select Lot Number(s) to Merge.");
		//document.frmaddDept.chkbox.focus();
		return false;
	}*/
	var w=0;
	var sno=document.frmaddDept.srno.value;
	for (var i=1; i<sno; i++)
	{
		var ltno="lotno_"+i;
		//alert(document.getElementById(ltno).value);
		if(document.getElementById(ltno).value!="")w++;
	}
	//alert(w);
	//alert(document.frmaddDept.txtnlottom.value);
	if(document.frmaddDept.txtnlottom.value!=w)
	{
		alert("Please enter Lot Number(s) to Merge.");
		//document.frmaddDept.chkbox.focus();
		return false;
	}	
	var qty1=document.frmaddDept.txtconslqty1.value;
	var qty2=document.frmaddDept.txtconslqty2.value;
	if(qty1=="")qty1=0; if(qty2=="")qty2=0;
	var totqty=parseFloat(qty1)+parseFloat(qty2);
	if(parseFloat(document.frmaddDept.totmqty.value)!=parseFloat(totqty))
	{
		alert("Please check.\nTotal Quantity of Merged Lots is not matching with Quantity distributed into SLOC Sub-Bin(s)");
		//document.frmaddDept.chkbox.focus();
		return false;
	}
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
		if(document.frmaddDept.totmnob.value!="")
		{
			document.frmaddDept.totmnob.value=parseFloat(document.frmaddDept.totmnob.value)+parseFloat(document.getElementById(x).value);
		}
		else
		{
			document.frmaddDept.totmnob.value=parseFloat(document.getElementById(x).value);
		}
		if(document.frmaddDept.totmqty.value!="")
		{
			document.frmaddDept.totmqty.value=parseFloat(document.frmaddDept.totmqty.value)+parseFloat(document.getElementById(y).value);
		}
		else
		{
			document.frmaddDept.totmqty.value=parseFloat(document.getElementById(y).value);
		}
	}
	else
	{
	//alert(document.frmaddDept.totmnob.value);
		var x="upsavl_"+chkval;
		var y="qtyavl_"+chkval;
		document.frmaddDept.totmnob.value=parseFloat(document.frmaddDept.totmnob.value)-parseFloat(document.getElementById(x).value);
		document.frmaddDept.totmqty.value=parseFloat(document.frmaddDept.totmqty.value)-parseFloat(document.getElementById(y).value);
		//alert(document.frmaddDept.totmnob.value);
		if(document.frmaddDept.totmnob.value<=0)
		document.frmaddDept.totmnob.value="";
		if(document.frmaddDept.totmqty.value<=0)
		document.frmaddDept.totmqty.value="";
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
	document.getElementById('maindiv').innerHTML="";
	document.frmaddDept.txtlot1.value="";
	if(document.frmaddDept.txtstage.value=="")
	{
		alert("Please select Stage first");
		document.frmaddDept.txtstage.focus();
	}
	else if(document.frmaddDept.totmqty.value=="")
	{
		alert("Please enter Qty first");
		document.frmaddDept.totmqty.focus();
	}
	else if(numval<=1)
	{
		alert("No. of Lot(s) to be Merged can be TWO or more");
		document.frmaddDept.txtnlottom.value="";
		document.frmaddDept.txtlot1.value="";
		document.frmaddDept.txtnlottom.focus();
	}
	else
	{
		var crop=document.frmaddDept.txtclass.value;
        var variety=document.frmaddDept.txtitem.value;					
		var stage=document.frmaddDept.txtstage.value;
		var lotid=document.frmaddDept.txtnlottom.value;
		showUser(crop,'maindiv','get',variety,stage,lotid,'','','');
	}
}


function getdetails()
{
		var crop=document.frmaddDept.txtclass.value;
        var variety=document.frmaddDept.txtitem.value;					
		var stage=document.frmaddDept.txtstage.value;
		var lotid=document.frmaddDept.txtnlottom.value;
		showUser(crop,'maindiv','get',variety,stage,lotid,'','','');
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


function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDept.totmqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
	else
	{
		alert("Please select Lots to Merger");
		document.frmaddDept.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDept.totmqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
	}
	else
	{
		alert("Please select Lots to Merger");
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

function plcchk(snoval)
{
	var sn=snoval-1;
	var txtlot2="txtlot2_"+snoval;
	var txtlot="txtlot2_"+sn;
	var stcode="stcode_"+snoval;
	var pcode="pcode_"+snoval;
	
	if(snoval>1 && document.getElementById(txtlot).value=="")
	{
		alert("Enter Previous Lot Number First");
		document.getElementById(pcode).value="";
		document.getElementById(pcode).selectedIndex=0;
		document.getElementById(txtlot).focus();
		return false;
	}
	document.getElementById(txtlot2).value="";
	document.getElementById(stcode).value="00000";
}
function ycodchk(snoval)
{
		var txtlot2="txtlot2_"+snoval;
		var stcode="stcode_"+snoval;
		var pcode="pcode_"+snoval;
		var ycodee="ycodee_"+snoval;
		if(document.getElementById(pcode).value=="")
		{
			alert("Invalid Lot Number");
			document.getElementById(ycodee).value="";
			document.getElementById(ycodee).selectedIndex=0;
			document.getElementById(pcode).focus();
			return false;
		}
		document.getElementById(txtlot2).value="";
		document.getElementById(stcode).value="00000";
}

function lot2chk(snoval)
{
	var txtlot2="txtlot2_"+snoval;
	var stcode="stcode_"+snoval;
	var ycodee="ycodee_"+snoval;
	if(document.getElementById(ycodee).value=="")
	{
		alert("Invalid Lot Number");
		document.getElementById(txtlot2).value="";
		document.getElementById(stcode).value="00000";
		return false;
	}
	if(document.getElementById(txtlot2).value=="00000")
	{
		alert("Invalid Lot Number");
		document.getElementById(txtlot2).value="";
		document.getElementById(stcode).value="00000";
		return false;
	}
	else
	{
		document.getElementById(stcode).value="00000";
		var lotn="lotno_"+snoval;
		var txtlot2="txtlot2_"+snoval;
		var stcode="stcode_"+snoval;
		var ycodee="ycodee_"+snoval;
		var pcode="pcode_"+snoval;
		var stcode2="stcode2_"+snoval;
		document.getElementById(lotn).value=="";
		val2=document.getElementById(ycodee).value;
		val5=document.getElementById(txtlot2).value;
		val6=document.getElementById(stcode).value;
		val7=document.getElementById(pcode).value;
		val8=document.getElementById(stcode2).value;
		var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
		document.getElementById(lotn).value=txtlot1;
	}
}

function slocshow(snoval)
{
	var txtlot2="txtlot2_"+snoval;
	var stcode="stcode_"+snoval;
	if(document.from1.txtlot2.value=="")
	{
		alert("Invalid Lot Number");
		document.getElementById(stcode).value="00000";
		return false;
	}
	else if(document.getElementById(txtlot2).value=="00000")
	{
		alert("Invalid Lot Number");
		document.getElementById(txtlot2).value="";
		document.getElementById(stcode).value="00000";
		return false;
	}
	else
	{
		var lotn="lotno_"+snoval;
		var txtlot2="txtlot2_"+snoval;
		var stcode="stcode_"+snoval;
		var ycodee="ycodee_"+snoval;
		var pcode="pcode_"+snoval;
		var stcode2="stcode2_"+snoval;
		document.getElementById(lotn).value=="";
		val2=document.getElementById(ycodee).value;
		val5=document.getElementById(txtlot2).value;
		val6=document.getElementById(stcode).value;
		val7=document.getElementById(pcode).value;
		val8=document.getElementById(stcode2).value;
		var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
		document.getElementById(lotn).value=txtlot1;
	}
}
function slocshow(snoval)
{
	var txtlot2="txtlot2_"+snoval;
	var stcode="stcode_"+snoval;
	if(document.from1.txtlot2.value=="")
	{
		alert("Invalid Lot Number");
		document.getElementById(stcode).value="00000";
		return false;
	}
	else if(document.getElementById(txtlot2).value=="00000")
	{
		alert("Invalid Lot Number");
		document.getElementById(txtlot2).value="";
		document.getElementById(stcode).value="00000";
		return false;
	}
	else
	{
		var lotn="lotno_"+snoval;
		var txtlot2="txtlot2_"+snoval;
		var stcode="stcode_"+snoval;
		var ycodee="ycodee_"+snoval;
		var pcode="pcode_"+snoval;
		var stcode2="stcode2_"+snoval;
		document.getElementById(lotn).value=="";
		val2=document.getElementById(ycodee).value;
		val5=document.getElementById(txtlot2).value;
		val6=document.getElementById(stcode).value;
		val7=document.getElementById(pcode).value;
		val8=document.getElementById(stcode2).value;
		var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
		document.getElementById(lotn).value=txtlot1;
	}
}
function lotchk(snoval)
{	
	var txtlot2="txtlot2_"+snoval;
	var stcode="stcode_"+snoval;
	var ycodee="ycodee_"+snoval;
	var pcode="pcode_"+snoval;
	var stcode2="stcode2_"+snoval;
	var lotn="lotno_"+snoval;
	
	document.getElementById(lotn).value=="";
	val2=document.getElementById(ycodee).value;
	val5=document.getElementById(txtlot2).value;
	val6=document.getElementById(stcode).value;
	val7=document.getElementById(pcode).value;
	val8=document.getElementById(stcode2).value;
	var f=0;
	if(val7=="")
	{
		alert("Please Select Plant code");
		f=1;
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code");
		f=1;
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	} 
	if(val8=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val8.length < 2)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	} 
	if(f==1)
	{
		return false;
	}
	else
	{
		var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
		document.getElementById(lotn).value=txtlot1;
		return true;	
	}
}
function chklot()
{
	if(document.frmaddDept.txtstage.value=="")
	{
		alert("Please select Stage first");
		document.frmaddDept.txtstage.focus();
	}
	if(document.frmaddDept.txtlotnumber.value=="")
	{
		alert("New Lot Number cannot be blank.");
		document.frmaddDept.totmnob.value="";
		document.frmaddDept.txtlotnumber.focus();
		return false;
	}
}
function chknob()
{
	if(document.frmaddDept.totmnob.value=="")
	{
		alert("Please enter NoB.");
		document.frmaddDept.totmnob.value="";
		document.frmaddDept.totmqty.focus();
		return false;
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Lot Merger - ADD</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
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
	    <td align="center" colspan="4" >
		<form id="mainform"  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="hidden" name="code" value="<?php echo $code?>" />
	 <input type="hidden" name="logid" value="<?php echo $logid?>" />
	 <input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	 <input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" />
</br>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Lot Merger</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysqli_query($link,"SELECT DISTINCT perticulars,whid FROM tbl_warehouse WHERE plantcode='$plantcode' order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
           <td width="159" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID&nbsp;</td>
           <td width="214"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
		   
		   <td width="142" height="24"  align="right"  valign="middle" class="tblheading">Merger&nbsp;Date&nbsp;</td>
           <td width="225" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" /></td>
</tr>
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop order by cropname") or die(mysqli_error($link));
?>
<tr class="Dark" height="25">
   <td width="159"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia_class = mysqli_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['cropid'];?>" />   
		<?php echo $noticia_class['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>
	</td>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where actstatus='Active'") or die(mysqli_error($link));
?>            
<td align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  id="vitem" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:170px;" onchange="modetchk24(this.value);" >
<option value="" selected>---Select Variety---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
	<td align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  >&nbsp;<select class="tbltext" name="txtstage" id="sstage" style="width:100px;" onchange="modetchk6(this.value);" >
<option value="" selected>-Select Stage-</option>
<!--<option value="Raw" >Raw</option>-->
<option value="Condition" >Condition</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="lotnshow">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" >&nbsp;<input type="hidden" name="orlot" value="" /></td>

</tr>		
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">NoB&nbsp;</td>
<td align="left" valign="middle" class="tblheading">&nbsp;<input name="totmnob" id="totmnob" class="tbltext" value=""  size="9" onchange="chklot();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" valign="middle" class="tblheading">&nbsp;<input name="totmqty" id="totmqty" class="tbltext" value=""  size="9" onchange="chknob();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">No. of Lots to Merge&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input type="text" name="txtnlottom" class="tbltext" size="1" maxlength="2" value="" onchange="chkstate(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;<input name="txtlot1" type="hidden" class="tbltext" tabindex="" value=""  >&nbsp;</td>
</tr>


</table>
<br />

<div id="maindiv" style="display:block"></div>	
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr></table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
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
