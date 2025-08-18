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
	   // exit;
		$pid=trim($_POST['pid']);
		$tcode=trim($_POST['tcode']);
		$crop=trim($_POST['txtcrop']);
		$variety=trim($_POST['txtvariety']);
		$ups=trim($_POST['txtupsdc']);
		$lotno=trim($_POST['txtlot1']);
		$orlot=trim($_POST['orlot']);
		$txtnewlot=trim($_POST['txtnewlot']);
		$ptptype=trim($_POST['ptptype']);
		$sno=trim($_POST['sno']);
		
		
		$dt=date("Y-m-d");
		
		$sql="update tbl_pspunpp2c set unp_date='$dt', unp_tcode='$tcode', unp_p2ctype='$ptptype', unp_crop='$crop', unp_variety='$variety', unp_lotno='$lotno', unp_orlot='$orlot', unp_newlotno='$txtnewlot', unp_ups='$ups', unp_logid='$logid', unp_yearcode='$yearid_id' where unp_id='$pid'";
		
		if(mysqli_query($link,$sql) or die(mysqli_error($link)))
		{
			$p_id=$pid;
			$s_del="delete from tbl_pspunpp2c_sub where unp_id='$p_id'";
			$xsw=mysqli_query($link,$s_del) or die(mysqli_error($link));
			
			for($i=1; $i<=$sno; $i++)
			{
				$wh="ewh".$i;
				$bin="ebin".$i;
				$sbin="esbin".$i;
				$onob="enop".$i;
				$onomb="enomp".$i;
				$oqty="eqty".$i;
				$rnob="nop".$i;
				$rnomb="nomp".$i;
				$rqty="qty".$i;
				$balnob="bnop".$i;
				$balnomb="bnomp".$i;
				$balqty="bqty".$i;
				
				$wh2=trim($_POST[$wh]);
				$bin2=trim($_POST[$bin]);
				$sbin2=trim($_POST[$sbin]);
				$onob2=trim($_POST[$onob]);
				$onomb2=trim($_POST[$onomb]);
				$oqty2=trim($_POST[$oqty]);
				$rnob2=trim($_POST[$rnob]);
				$rnomb2=trim($_POST[$rnomb]);
				$rqty2=trim($_POST[$rqty]);
				$balnob2=trim($_POST[$balnob]);
				$balnomb2=trim($_POST[$balnomb]);
				$balqty2=trim($_POST[$balqty]);
				
				$sql_sub="insert into tbl_pspunpp2c_sub (unp_id, unp_wh, unp_bin, unp_sbin, unp_onop, unp_oqty, unp_nop, unp_qty, unp_bnop, unp_bqty, unp_nomp, plantcode)values('$p_id','$wh2', '$bin2', '$sbin2', '$onob2', '$oqty2', '$rnob2', '$rqty2', '$balnob2', '$balqty2', '$onomb2', '$plantcode')";
				mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			}
			$s_del2="delete from tbl_pspunpp2c_sub2 where unp_id='$p_id'";
			$xsw2=mysqli_query($link,$s_del2) or die(mysqli_error($link));
			
			$wh1=trim($_POST['txtslwhg1']);
			$bin1=trim($_POST['txtslbing1']);
			$sbin1=trim($_POST['txtslsubbg1']);
			$nob1=trim($_POST['txtslBagsg1']);
			$qty1=trim($_POST['txtslqtyg1']);
			
			$sql_sub2="insert into tbl_pspunpp2c_sub2 (unp_id, unp_wh, unp_bin, unp_sbin, unp_nop, unp_qty, plantcode)values('$p_id','$wh1', '$bin1', '$sbin1', '$nob1', '$qty1', '$plantcode')";
			mysqli_query($link,$sql_sub2) or die(mysqli_error($link));
					
			$wh21=trim($_POST['txtslwhg2']);
			$bin21=trim($_POST['txtslbing2']);
			$sbin21=trim($_POST['txtslsubbg2']);
			$nob21=trim($_POST['txtslBagsg2']);
			$qty21=trim($_POST['txtslqtyg2']);
			if($qty21!="" && $qty21>0)
			{
				$sql_sub21="insert into tbl_pspunpp2c_sub2 (unp_id, unp_wh, unp_bin, unp_sbin, unp_nop, unp_qty, plantcode)values('$p_id','$wh21', '$bin21', '$sbin21', '$nob21', '$qty21', '$plantcode')";
				mysqli_query($link,$sql_sub21) or die(mysqli_error($link));
			}
			//exit;
			echo "<script>window.location='add_p2c_preview.php?pid=$p_id'</script>";	
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PSW - Transaction - Unpacking - P2C</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
<script src="unpp2c.js"></script>
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
		if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122)) 
		{
			flag = false;
			break;
		}	
	}
	return flag;
}

function mySubmit()
{
	//return false;
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtupsdc.value=="")
	{
		alert("Please Select UPS");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot Number");
		f=1;
		return false;
	}
	if(document.frmaddDepartment.getdet.value==0)
	{
		alert("Please click on Get Details");
		f=1;
		return false;
	}
	var v_1=0;
	var qtyd=0;
	var qtyo=0;
	var qtyb=0;
	var nop=0;
	var val=document.frmaddDepartment.sno.value;
	if(val!="")
	{	
		
		//var nomp=0;
		for(var i=1; i<=val; i++)
		{ 
			var dc="eqty_"+i;
			var rem="qty_"+i;
			var bal="bqty_"+i;
			var nop="nop_"+i;
			//var nomp="txtrecnomp_"+i;
			nop=parseInt(nop)+parseInt(document.getElementById(nop).value);
			//nomp=parseInt(nomp)+parseInt(document.getElementById(nomp).value);
			if(document.getElementById(rem).value=="")
			{
				v_1++;
			}
			var q=document.getElementById(dc).value;
			var rq=document.getElementById(rem).value;
			var bq=document.getElementById(bal).value;
				
			if(rq=="")rq=0;
				
			var qtyd=parseFloat(qtyd)+parseFloat(rq);
			var qtyo=parseFloat(qtyo)+parseFloat(q);
			var qtyb=parseFloat(qtyb)+parseFloat(bq);
		}
		if(nop==0)
		{
			alert("Please Enter NoP for P2C");
			f=1;
			return false;
		}
		if(v_1>=val)
		{
			alert("Please Enter NoP for P2C");
			f=1;
			return false;
		}					
		if(parseFloat(qtyd) > parseFloat(qtyo))
		{
			alert("Please check. Total Quantity for P2C not matching with Total Quantity in Stock");
			return false;
			f=1;
		}		
	}
	
	if(document.frmaddDepartment.txtslsubbg1.value==""&& document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please Select SLOC for Condition Seed");
		f=1;
		return false;
	}
	//alert(qtyd);
	var qt=parseFloat(qtyd);
	var q1=document.frmaddDepartment.txtslqtyg1.value;
	var q2=document.frmaddDepartment.txtslqtyg2.value;
	if(q2=="")q2=0;
	var slqt=parseFloat(q1)+parseFloat(q2);
	
	if(parseFloat(qt)!=parseFloat(slqt))
	{
		alert("Please check. Quantity is not matching with Quantity distributed in Bins");
		f=1;
		return false;
	}
	
	if(f==1)
		return false; 
	else
		return true;
}

function wh(wh1val, whno)
{ 
	var whi="txtslwhg"+whno;
	if(whno>1)
	{
		var qtys="txtslqtyg"+whno-1;
		if(document.getElementsByName(qtys[0]).value=="")
		{
			alert("Please enter Qty in previous Bin")
			document.getElementsByName(whi[0]).selectedIndex=0;
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
	var itemv=document.frmaddDepartment.txtvariety.value;
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
		var slocnogood='Condition';
		var trid=0;
		var Bagsv1='P2C';
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
}


function Bagsf(Bags1val, bagno)
{
	var txtslsubbg="txtslsubbg"+bagno;
	var txtslBagsg="txtslBagsg"+bagno;
	if(document.getElementsByName(txtslsubbg)[0].value=="")
	{
		alert("Please select Sub Bin");
		document.getElementsByName(txtslsubbg)[0].focus();
		document.getElementsByName(txtslBagsg)[0].value="";
		return false;
	}
	if(document.getElementsByName(txtslBagsg)[0].value!="")
	{
	
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
		
	}
}

function modetchk(classval)
{
	document.frmaddDepartment.txtvariety.selectedIndex=0;
	document.frmaddDepartment.txtvariety.value="";
	document.frmaddDepartment.txtupsdc.selectedIndex=0;
	document.frmaddDepartment.txtupsdc.value="";
	document.frmaddDepartment.txtlot1.value="";
	document.getElementById('postmainform').innerHTML="";
	document.frmaddDepartment.getdet.value=0;
	showUser(classval,'vitem','item','','','','','');
}

function modetchk1()
{
	if(document.getElementById('txtcrop').value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtvariety.selectedIndex=0;
		document.frmaddDepartment.txtwhg.selectedIndex=0;
		document.frmaddDepartment.txtbin.selectedIndex=0;
		document.frmaddDepartment.txtsubb.selectedIndex=0;
		document.getElementById('txtcrop').focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtwhg.selectedIndex=0;
		document.frmaddDepartment.txtbin.selectedIndex=0;
		document.frmaddDepartment.txtsubb.selectedIndex=0;
	}
}

function onloadfocus()
{
	//document.getElementById("txtbarcod").focus();
}


function openslocpop()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	else
	{
		//var itm="Pack Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var ups=document.frmaddDepartment.txtupsdc.value;
		document.getElementById('postmainform').innerHTML="";
		document.frmaddDepartment.getdet.value=0;

		winHandle=window.open('getuser_p2c_lotno.php?crop='+crop+'&variety='+variety+'&ups='+ups,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function upschk(verval)
{
	var crop=document.frmaddDepartment.txtcrop.value;
	document.frmaddDepartment.txtupsdc.selectedIndex=0;
	document.frmaddDepartment.txtupsdc.value="";
	document.frmaddDepartment.txtlot1.value="";
	document.getElementById('postmainform').innerHTML="";
	document.frmaddDepartment.getdet.value=0;
	showUser(verval,'upschd','upsch',crop,'','','');
}

function getdetails()
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
	 alert("Please Select or enter Lot No.");
	}
	else
	{
		var get=document.frmaddDepartment.txtlot1.value;
		document.frmaddDepartment.getdet.value=0;
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var upss=document.frmaddDepartment.txtupsdc.value;
		//var lotid=document.frmaddDepartment.subtrid.value;
		document.frmaddDepartment.getdet.value=1;	
		showUser(get,'postmainform','get',crop,variety,upss,'','','');
		//document.frmaddDepartment.getdetflg.value=1;
	}
}

function verchk()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety");
		document.frmaddDepartment.txtupsdc.value="";
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtlot1.value="";
		document.getElementById('postmainform').innerHTML="";
		document.frmaddDepartment.getdet.value=0;
	}
}

function chklot(lotval)
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select or enter Lot No.");
		return false;
	}
	else
	{
		if(lotval=="entire")
		{
			document.frmaddDepartment.txtnewlot.value=document.frmaddDepartment.lotnmo.value;
			document.frmaddDepartment.ptptype.value=lotval;
			document.getElementById('batchchk').innerHTML="&nbsp;Batch No. Generated - <font color=red>NO</font>";
			for (var i=1; i<=document.frmaddDepartment.sno.value; i++)
			{
			var eqtys="eqty_"+i;
			var enops="enop_"+i;
			var qtys="qty_"+i;
			var nops="nop_"+i;
			var bqtys="bqty_"+i;
			var bnops="bnop_"+i;
			document.getElementById(qtys).value=document.getElementById(eqtys).value;
			document.getElementById(nops).value=document.getElementById(enops).value;
			document.getElementById(qtys).readOnly=true;
			document.getElementById(qtys).style.backgroundColor="#cccccc";
			document.getElementById(nops).readOnly=true;
			document.getElementById(nops).style.backgroundColor="#cccccc";
			document.getElementById(bqtys).value=0;
			document.getElementById(bnops).value=0;
			
			}
		}
		else if(lotval=="partial")
		{
			document.frmaddDepartment.txtnewlot.value=document.frmaddDepartment.lotnmb.value;
			document.frmaddDepartment.ptptype.value=lotval;
			document.getElementById('batchchk').innerHTML="&nbsp;Batch No. Generated - <font color=red>YES</font>";
			for (var i=1; i<=document.frmaddDepartment.sno.value; i++)
			{
			var eqtys="eqty_"+i;
			var enops="enop_"+i;
			var qtys="qty_"+i;
			var nops="nop_"+i;
			var bqtys="bqty_"+i;
			var bnops="bnop_"+i;
			document.getElementById(qtys).value="";
			document.getElementById(nops).value="";
			document.getElementById(bqtys).value="";
			document.getElementById(bnops).value="";
			document.getElementById(qtys).readOnly=false;
			document.getElementById(qtys).style.backgroundColor="#ffffff";
			document.getElementById(nops).readOnly=false;
			document.getElementById(nops).style.backgroundColor="#ffffff";
			}
		}
		else
		{
			document.frmaddDepartment.txtnewlot.value="";
			document.frmaddDepartment.ptptype.value="";
			document.getElementById('batchchk').innerHTML="";
			for (var i=1; i<=document.frmaddDepartment.sno.value; i++)
			{
			var eqtys="eqty_"+i;
			var enops="enop_"+i;
			var qtys="qty_"+i;
			var nops="nop_"+i;
			var bqtys="bqty_"+i;
			var bnops="bnop_"+i;
			document.getElementById(qtys).value="";
			document.getElementById(nops).value="";
			document.getElementById(bqtys).value="";
			document.getElementById(bnops).value="";
			document.getElementById(qtys).readOnly=false;
			document.getElementById(qtys).style.backgroundColor="#ffffff";
			document.getElementById(nops).readOnly=false;
			document.getElementById(nops).style.backgroundColor="#ffffff";
			}
		}
	}
}

function chknop(nopval, sno)
{
	var eqtys="eqty_"+sno;
	var enops="enop_"+sno;
	var qtys="qty_"+sno;
	var nops="nop_"+sno;
	var bqtys="bqty_"+sno;
	var bnops="bnop_"+sno;
	if(parseInt(nopval) > 0)
	{
		var ups=document.frmaddDepartment.txtupsdc.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(parseFloat(ups[0])/1000);
		}
		else
		{
			pt=ups[0];
		}
		document.getElementById(qtys).value=Math.round((parseFloat(nopval)*parseFloat(pt))*100)/100;
		document.getElementById(bqtys).value=parseFloat(document.getElementById(eqtys).value)-parseFloat(document.getElementById(qtys).value);
		document.getElementById(bnops).value=parseInt(document.getElementById(enops).value)-parseInt(document.getElementById(nops).value);
		document.getElementById(bqtys).value=parseFloat(document.getElementById(bqtys).value).toFixed(3);
		if(parseInt(document.getElementById(bnops).value)<0)
		{
			alert("Invalid NoP");
			document.getElementById(qtys).value="";
			document.getElementById(nops).value="";
			document.getElementById(bqtys).value="";
			document.getElementById(bnops).value="";
			document.getElementById(nops).focus();
		}
	}
	else
	{
		document.getElementById(qtys).value="";
		document.getElementById(nops).value="";
		document.getElementById(bqtys).value="";
		document.getElementById(bnops).value="";
	}	
}

function chkqty(qtyval, sno)
{
	var eqtys="eqty_"+sno;
	var enops="enop_"+sno;
	var qtys="qty_"+sno;
	var nops="nop_"+sno;
	var bqtys="bqty_"+sno;
	var bnops="bnop_"+sno;
	if(parseInt(qtyval) > 0)
	{
		var ups=document.frmaddDepartment.txtupsdc.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(1000/parseFloat(ups[0]));
			document.getElementById(nops).value=parseFloat(qtyval)*parseInt(pt);
		}
		else
		{
			pt=ups[0];
			document.getElementById(nops).value=parseFloat(qtyval)/parseInt(pt);
		}
		document.getElementById(bqtys).value=parseFloat(document.getElementById(eqtys).value)-parseFloat(document.getElementById(qtys).value);
		document.getElementById(bnops).value=parseInt(document.getElementById(enops).value)-parseInt(document.getElementById(nops).value);
		document.getElementById(bqtys).value=parseFloat(document.getElementById(bqtys).value).toFixed(3);
		if(parseFloat(document.getElementById(bqtys).value)<0)
		{
			alert("Invalid Qty");
			document.getElementById(qtys).value="";
			document.getElementById(nops).value="";
			document.getElementById(bqtys).value="";
			document.getElementById(bnops).value="";
			document.getElementById(qtys).focus();
		}
		var x=document.getElementById(nops).value.split(".");
		if(parseInt(x[1]) > 0)
		{
			alert("Invalid NoP");
			document.getElementById(qtys).value="";
			document.getElementById(nops).value="";
			document.getElementById(bqtys).value="";
			document.getElementById(bnops).value="";
			return false;
		}
	}
	else
	{
		document.getElementById(qtys).value="";
		document.getElementById(nops).value="";
		document.getElementById(bqtys).value="";
		document.getElementById(bnops).value="";
	}	
}

</script>

<body onload="onloadfocus();" >

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Pack Seed Unpacking - Pack to Condition (P2C)</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >
<?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_pspunpp2c where plantcode='$plantcode' and unp_logid='".$logid."' and unp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['unp_id'];

	$tdate=$row_tbl['unp_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['unp_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl['unp_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);

?> 	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	<input name="frm_action" value="submit" type="hidden">
	<input type="hidden" name="pid" value="<?php echo $tid;?>" />
	<input type="hidden" name="tcode" value="<?php echo $row_tbl['unp_tcode'];?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse">	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading" colspan="4" >Pack Seed Unpacking - Pack to Condition (P2C)</td>
</tr>
<tr class="Light" height="20">
  	<td width="160" align="right" valign="middle" class="smalltblheading">Transaction ID&nbsp;</td>
	<td width="260" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TPC".$row_tbl['unp_tcode']."/".$row_tbl['unp_yearcode']."/".$row_tbl['unp_logid'];?></td>
	<td width="94" align="right" valign="middle" class="smalltblheading">Date&nbsp;</td>
	<td width="326" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname IN ('Paddy Seed','Bajra Seed','Maize Seed') order by cropname Asc"); 
?>
<tr class="Light" height="20">
  	<td width="160" align="right" valign="middle" class="smalltblheading">Crop&nbsp;</td>
	<td width="260" align="left" valign="middle" class="smalltbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($row_tbl['unp_crop']==$noticia['cropid']) echo "selected"; ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where cropname='".$row_tbl['unp_crop']."' and actstatus='Active' order by popularname Asc");  
?>
	<td width="94" align="right" valign="middle" class="smalltblheading">Variety&nbsp;</td>
	<td width="326" align="left" valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onchange="upschk(this.value);" >
<option value="" selected>--Select Variety-</option>
<?php while($noticia_item = mysqli_fetch_array($quer4)) { ?>
		<option <?php if($row_tbl['unp_variety']==$noticia_item['varietyid']) echo "selected"; ?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
$sql_month=mysqli_query($link,"select distinct packtype from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."'  order by packtype")or die(mysqli_error($link));
?>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
	<td align="left" valign="middle" class="tbltext" colspan="3" id="upschd" >&nbsp;<select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onchange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
<?php  while($row_var=mysqli_fetch_array($sql_month)) {	?>
		<option <?php if($row_tbl['unp_ups']==$row_var['packtype']) echo "selected"; ?> value="<?php echo $row_var['packtype'];?>" />   
		<?php echo $row_var['packtype'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
	<td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row_tbl['unp_lotno'];?>" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left"valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')<input type="hidden" name="getdet" value="1" /></td>	 
</tr>
</table><br />

<div id="postmainform"> 
<?php

$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);

$nop=0; $qty=0; $qc=""; $dot=""; $got=""; $dogt=""; 
while($row_issue=mysqli_fetch_array($lotqry))
{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nop1=0; $ptp1=0;
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
if($row_issuetbl['balnomp']>0)
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
else
$penqty=$row_issuetbl['balqty'];
if($penqty > 0)
{
	if($packtp[1]=="Gms")
	$nop1=($ptp*$penqty);
	else
	$nop1=($penqty/$ptp);
}

$nop=$nop+$nop1; 
$nomp=$nomp+$row_issuetbl['balnomp'];
$qty=$qty+$row_issuetbl['balqty'];

$qc=$row_issuetbl['lotldg_qc'];
$orlot=$row_issuetbl['orlot'];

$dt=explode("-",$row_issuetbl['lotldg_qctestdate']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];

$dgt=explode("-",$row_issuetbl['lotldg_gottestdate']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$gt=explode(" ",$row_issuetbl['lotldg_got1']);
$got=$gt[0]." ".$row_issuetbl['lotldg_got'];

if($dot=="0000-00-00" || $dot=="--" || $dot=="- -")$dot="";
if($dogt=="0000-00-00" || $dogt=="--" || $dogt=="- -")$dogt="";
}
}

$zzz=implode(",", str_split($row_tbl['unp_lotno']));
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
$abc2=sprintf("%02d",($abc2+1));
$abc24=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$abc2."C";
$abc23=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30]."C";

$tflg=0;
$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' and trtype='Qty-Rem'") or die(mysqli_error($link)); 
$tot_istbl=mysqli_num_rows($sql_istbl);

$sql_istbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' and trtype='Dispatch'") or die(mysqli_error($link)); 
$tot_istbl2=mysqli_num_rows($sql_istbl2);

if($tot_istbl > 0 || $tot_istbl2 > 0)$tflg++;
if($nomp > 0)$tflg++;

?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Lot Details</td>
</tr>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tblheading">&nbsp;<input name="txtenop" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $nop;?>" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right" width="236" valign="middle" class="tblheading">NoMP&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<input name="txteqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $nomp;?>" style="background-color:#CCCCCC" readonly="true" />&nbsp;</td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tblheading">&nbsp;<input name="txteqty" type="text" size="9" class="tbltext" tabindex="0" maxlength="9" value="<?php echo $qty;?>" style="background-color:#CCCCCC" readonly="true" />&nbsp;</td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txteqc" type="text" size="5" class="tbltext" tabindex="0" maxlength="5" value="<?php echo $qc;?>" style="background-color:#CCCCCC" readonly="true" /></td>	
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtedot" type="text" size="12" class="tbltext" tabindex=""   maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $dot;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<input name="txtegot" type="text" size="15" class="tbltext" tabindex=""   maxlength="15" onkeypress="return isNumberKey1(event)" value="<?php echo $got;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" colspan="2">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtedogt" type="text" size="12" class="tbltext" tabindex=""   maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $dogt;?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">P2C&nbsp;</td>
<td align="left"  valign="middle" class="tblheading"   >&nbsp;<?php echo $row_tbl['unp_p2ctype'];?>&nbsp;<input type="hidden" name="ptptype" value="<?php echo $row_tbl['unp_p2ctype'];?>" /></td>
<td align="left"  valign="middle" class="tblheading" colspan="2" id="batchchk">&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">P2C Lot number&nbsp;</td>
<td align="left"  valign="middle" class="tblheading">&nbsp;<input name="txtnewlot" type="text" size="20" class="tbltext" tabindex=""   maxlength="20" value="<?php echo $row_tbl['unp_newlotno'];?>"  style="background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<input type="hidden" name="orlot" value="<?php echo $orlot;?>" />
<input type="hidden" name="lotnmo" value="<?php echo $abc23; ?>" /><input type="hidden" name="lotnmb" value="<?php echo $abc24; ?>" />
</table>
<br />
<div id="showlotsloc">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="13" align="center" valign="middle" class="tblheading">Existing SLOC Details</td>
</tr>
<tr class="tblsubtitle" height="20">
    <td width="24" align="center" valign="middle" class="tblheading">#</td>
	<td width="94" align="center" valign="middle" class="tblheading">WH</td>
    <td width="87" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="107" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing NoP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing NoMP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Existing Qty</td>
	<td width="107" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="107" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance NoP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance NoMP</td>
	<td width="107" align="center" valign="middle" class="tblheading">Balance Qty</td>
</tr>
<?php
$sno=0;
//if($tflg > 0)
{
$lotqry2=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."'") or die(mysqli_error($link));
$tot_row2=mysqli_num_rows($lotqry2);

$enop=0; $eqty=0;
while($row_issue2=mysqli_fetch_array($lotqry2))
{ 
$sql_issue12=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue2['subbinid']."' and binid='".$row_issue2['binid']."' and whid='".$row_issue2['whid']."' and lotldg_crop='".$row_tbl['unp_crop']."' and lotldg_variety='".$row_tbl['unp_variety']."' and packtype='".$row_tbl['unp_ups']."' and lotno='".$row_tbl['unp_lotno']."' ") or die(mysqli_error($link));
$row_issue12=mysqli_fetch_array($sql_issue12); 

$sql_issuetbl2=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue12[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl2=mysqli_fetch_array($sql_issuetbl2))
{
$nop12=0; $ptp12=0;
$ups2=$row_issuetbl2['packtype'];
$wtinmp2=$row_issuetbl2['wtinmp'];
$upspacktype2=$row_issuetbl2['packtype'];
$packtp2=explode(" ",$upspacktype2);
$packtyp2=$packtp2[0]; 
if($packtp2[1]=="Gms")
{ 
	$ptp2=(1000/$packtp2[0]);
	$ptp12=($packtp2[0]/1000);
}
else
{
	$ptp2=$packtp2[0];
	$ptp12=$packtp2[0];
}
if($row_issuetbl2['balnomp']>0)
$penqty2=(($row_issuetbl2['balqty'])-($wtinmp2*$row_issuetbl2['balnomp']));
else
$penqty2=$row_issuetbl2['balqty'];
if($penqty2 > 0)
{
	$nop12=($ptp2*$penqty2);
}
if($row_issuetbl2['balnomp']>0 && $penqty2<=0)
$penqty2=$row_issuetbl2['balqty'];

$enop=$nop12; 
$enomp=$row_issuetbl2['balnomp'];
$eqty=$penqty2;

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl2['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl2['binid']."' and whid='".$row_issuetbl2['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl2['subbinid']."' and binid='".$row_issuetbl2['binid']."' and whid='".$row_issuetbl2['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$sno++;

$sql_sub=mysqli_query($link,"Select * from tbl_pspunpp2c_sub where plantcode='$plantcode' and unp_id='$tid' and unp_wh='".$row_issuetbl2['whid']."' and unp_bin='".$row_issuetbl2['binid']."' and unp_sbin='".$row_issuetbl2['subbinid']."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
$row_sub=mysqli_fetch_array($sql_sub);

$nop=$row_sub['unp_nop']; 
$nomp=$enomp; 
$qty=$row_sub['unp_qty'];
$bnop=$row_sub['unp_bnop']; 
$bnomp=0; 
$bqty=$row_sub['unp_bqty'];
?>
<tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $sno;?></td>
	<td width="94" align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="ewh<?php echo $sno;?>" id="ewh_<?php echo $sno;?>" value="<?php echo $row_issuetbl2['whid'];?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="87" align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="ebin<?php echo $sno;?>" id="ebin_<?php echo $sno;?>" value="<?php echo $row_issuetbl2['binid'];?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
    <td width="107" align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="esbin<?php echo $sno;?>" id="esbin_<?php echo $sno;?>" value="<?php echo $row_issuetbl2['subbinid'];?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $enop;?><input type="hidden" name="enop<?php echo $sno;?>" id="enop_<?php echo $sno;?>" value="<?php echo $enop;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $enomp;?><input type="hidden" name="enomp<?php echo $sno;?>" id="enomp_<?php echo $sno;?>" value="<?php echo $enomp;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><?php echo $eqty;?><input type="hidden" name="eqty<?php echo $sno;?>" id="eqty_<?php echo $sno;?>" value="<?php echo $eqty;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="nop<?php echo $sno;?>" id="nop_<?php echo $sno;?>" value="<?php echo $nop;?>" size="6" maxlength="6" onchange="chknop(this.value,'<?php echo $sno;?>')"  readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="nomp<?php echo $sno;?>" id="nomp_<?php echo $sno;?>" value="<?php echo $nomp;?>" size="6" maxlength="6" onchange="chknop(this.value,'<?php echo $sno;?>')"  readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="qty<?php echo $sno;?>" id="qty_<?php echo $sno;?>" value="<?php echo $qty;?>" size="6" maxlength="6" onchange="chkqty(this.value,'<?php echo $sno;?>')"   readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="bnop<?php echo $sno;?>" id="bnop_<?php echo $sno;?>" value="<?php echo $bnop;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="bnomp<?php echo $sno;?>" id="bnomp_<?php echo $sno;?>" value="<?php echo $bnomp;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
	<td width="107" align="center" valign="middle" class="tblheading"><input type="text" name="bqty<?php echo $sno;?>" id="bqty_<?php echo $sno;?>" value="<?php echo $bqty;?>" size="6" maxlength="6" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<?php
}
}
}
?>
<input type="hidden" name="sno" value="<?php echo $sno;?>" />
</table>
<br />

</div>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">Condition Seed - SLOC Details</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="279" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="271" rowspan="2" align="center" valign="middle" class="tblheading">SR Condition Seed</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="94" align="center" valign="middle" class="tblheading">WH</td>
    <td width="87" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="107" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
<?php
$sno1=1;
$cnt=0;
$sql_sub2=mysqli_query($link,"Select * from tbl_pspunpp2c_sub2 where plantcode='$plantcode' and unp_id='$tid'") or die(mysqli_error($link));
$tot_sub2=mysqli_num_rows($sql_sub2);
if($tot_sub2 > 0)
{
while($row_sub2=mysqli_fetch_array($sql_sub2))
{
$existview="";
$cnt++;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="94" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg<?php echo $sno1;?>" style="width:70px;" onchange="wh(this.value,'<?php echo $sno1;?>');"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_sub2['unp_wh']==$noticia_whg1['whid']) echo "selected"; ?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' and whid='".$row_sub2['unp_wh']."' order by binname") or die(mysqli_error($link));
?>
    <td width="87" align="center"  valign="middle" class="tbltext" id="bing<?php echo $sno1;?>">&nbsp;<select class="tbltext" name="txtslbing<?php echo $sno1;?>" style="width:60px;" onchange="bin(this.value,'<?php echo $sno1;?>');" >
    <option value="" selected>--Bin--</option>
	<?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
		<option <?php if($row_sub2['unp_bin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and binid='".$row_sub2['unp_bin']."' order by sid") or die(mysqli_error($link));
?>
    <td width="107" align="center"  valign="middle" class="tbltext" id="sbing<?php echo $sno1;?>">&nbsp;<select class="tbltext" name="txtslsubbg<?php echo $sno1;?>" style="width:80px;" onchange="subbin(this.value,'<?php echo $sno1;?>');"  >
    <option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
		<option <?php if($row_sub2['unp_sbin']==$noticia_subbing1['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $sno1;?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
        <tr>
		<td width="275"  valign="middle">&nbsp;<?php echo $existview;?></td>
          <td align="right" width="44"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $sno1;?>" id="Bags<?php echo $sno1;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf(this.value,'<?php echo $sno1;?>');" value="<?php echo $row_sub2['unp_nop'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="40"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="98" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $sno1;?>" id="qty<?php echo $sno1;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf(this.value,'<?php echo $sno1;?>');" value="<?php echo $row_sub2['unp_qty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
<?php
$sno1++;
}
}
?>	
<?php
if($cnt==0)
{
?>  
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="94" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh(this.value,'1');"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="87" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin(this.value,'1');" >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="107" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin(this.value,'1');"  >
          <option value="" selected>--Sub Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
        <tr>
		<td width="275"  valign="middle">&nbsp;</td>
          <td align="right" width="44"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf(this.value,'1');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="40"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="98" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf(this.value,'1');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
 <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="94" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,'2');" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="87" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,'2');"  >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="107" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,'2');" >
          <option value="" selected>--Sub Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
        <tr>
		<td width="275"  valign="middle">&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td width="83" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf(this.value,'2');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="40" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="98"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf(this.value,'2');" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
<?php
}
else if($cnt==1)
{
?>
 <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="94" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,'2');" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="87" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,'2');"  >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode'") or die(mysqli_error($link));
?>
    <td width="107" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,'2');" >
          <option value="" selected>--Sub Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >
        <tr>
		<td width="275"  valign="middle">&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;NoB&nbsp;</td>
          <td width="83" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf(this.value,'2');" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="40" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="98"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf(this.value,'2');" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
<?php
}
else
{
}
?>  
</table>
</div>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_p2c.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  
