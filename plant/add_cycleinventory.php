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
		$trid=trim($_POST['maintrid']);
		echo "<script>window.location='add_spci_preview.php?p_id=$trid'</script>";	
	}
		
	
	$a="TCI";
	$sql_code="SELECT MAX(ci_tcode) FROM tbl_ci  where ci_yearcode='$yearid_id' AND plantcode='".$plantcode."' ORDER BY ci_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1=$a.$code."/".$yearid_id."/".$lgnid;
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant Manager -Transaction  - Cycle Inventory</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
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

<script src="spciup.js"></script>
<script language="javascript" type="text/javascript">
var x = 0;

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
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}
function isNumberKey1(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}

function clks(val)
{
	document.frmaddDepartment.txt14.value=val;
}

function mySubmit()
{ 
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	/*if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		return false;
	} */
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	return true;	 
}

function modetchk(classval) 
{
	document.frmaddDepartment.txtlot1.value=""
	document.frmaddDepartment.maintrid.value=0;
	document.getElementById('postingsubtable').style.display="none";
	showUser(classval,'vitem','item','','','','','');
}

function modetchk1(val)
{
	document.frmaddDepartment.txtlot1.value=""
	document.frmaddDepartment.maintrid.value=0;
	document.getElementById('postingsubtable').style.display="none";
}

function chktp(val)
{
	//document.frmaddDepartment.txtmtype.value=val;
	document.getElementById('subdiv').style.display="block";
	setTimeout('chktyp()',200);

}
function chktyp()
{ 
	if(document.frmaddDepartment.txtlot1.value!="")
	{
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		var trid=document.frmaddDepartment.maintrid.value;
			
		if(opttyp !="")
		{
			document.getElementById("maindiv").style.display="block";
			document.getElementById("subsubdiv").style.display="none";
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,trid,'');
		}
		else
		{
			alert("please select LOT Number");
		}
	}
	else
	{
		alert("please select LOT Number");
	}
}

function wh1(wh1val)
{ 
	if(document.frmaddDepartment.txtnewqty.value=="")
	{
		alert("Please enter Qty");
		document.frmaddDepartment.txtslwhg1.value="";
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
	else
	{
		showUser(wh1val,'bing1','wh','bing1','1','','','');
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtconslqty1.value=="")
	{
		alert("Please enter Qty in first Bin");
		document.frmaddDepartment.txtslwhg2.value="";
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}
	else
	{
		showUser(wh2val,'bing2','wh','bing2','2','','','');
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
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		if((w1==w2))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var nopv1="";
		var Bagsv1="";
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid,nopv1);
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
		if((w2==w1))
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var nopv2="";
		var Bagsv2="";
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid,nopv2);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function Bagschk1(nops1val)
{
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtconslnob1.value="";
	}
}

function Bagschk2(nops2val)
{
	if(document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtconslnob2.value="";
	}
}

function qtychk1(Bags1val)
{	
	if(document.frmaddDepartment.txtconslnob1.value=="")
	{
		alert("Please enter NoB");
		document.frmaddDepartment.txtconslqty1.value="";
	}
}

function qtychk2(Bags2val)
{
	if(document.frmaddDepartment.txtconslnob2.value=="")
	{
		alert("Please enter NoB");
		document.frmaddDepartment.txtconslqty2.value="";
	}
}

function pform()
{
	var srn=document.frmaddDepartment.srn.value;
	var f=0;
	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		f=1;
		return false;
	} 
	if((document.frmaddDepartment.txtconslqty1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");
		f=1;	
		return false;
	} 
	if((document.frmaddDepartment.txtconslqty1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		f=1;
		return false;
	} 
	if((document.frmaddDepartment.txtconslqty1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		f=1;
		return false;		
	}
	if(srn>=2)
	{
		if((document.frmaddDepartment.txtconslqty2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
		{
			alert("Warehouse Not selected");
			f=1;	
			return false;
		} 
		if((document.frmaddDepartment.txtconslqty2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
		{
			alert("Bin Not selected");	
			f=1;
			return false;
		} 
		if((document.frmaddDepartment.txtconslqty2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
		{
			alert("Sub Bin Not selected");	
			f=1;
			return false;		
		}
	}
	if(document.frmaddDepartment.txtlot1.value!="")
	{
		var q1=0; var q2=0;	var n1=0; var n2=0;	var d=0;
			
		var q1=document.frmaddDepartment.txtconslqty1.value;
		var n1=document.frmaddDepartment.txtconslnob1.value;
		if(srn>=2)
		{
			var q2=document.frmaddDepartment.txtconslqty2.value;
			var n2=document.frmaddDepartment.txtconslnob2.value;
		}
		var d=document.frmaddDepartment.txtnewqty.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(n1=="")n1=0;if(n2=="")n2=0;
		
		if(d=="")d=0;
		
		var qtyd=parseFloat(q1)+parseFloat(q2);
		var nopsd=parseInt(n1)+parseInt(n2);
		
		//alert(qtyd);
		/*if(parseInt(n) != parseInt(nopsd))
		{
			alert("Please check. NoP distributed in Bins not matching with Total NoP");
			return false;
			f=1;
		}
		if(parseInt(u) != parseInt(Bagsd))
		{
			alert("Please check. NoMP distributed in Bins not matching with Total NoMP");
			return false;
			f=1;
		}*/
		if(parseFloat(d) != parseFloat(qtyd))
		{
			alert("Please check. Balance Quantity distributed in Bins not matching with Total Quantity");
			return false;
			f=1;
		}
		if(qtyd==0)
		{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			return false;
			f=1;
		}
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'postingtable','mformci','','','','','');
		}
	}
	else
	{
		alert("Please select Lot No.");
		return false;
	}
}	

function pformupdate()
{
	var srn=document.frmaddDepartment.srn.value;
	var f=0;
	
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		f=1;
		return false;
	} 
	if((document.frmaddDepartment.txtconslqty1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");
		f=1;	
		return false;
	} 
	if((document.frmaddDepartment.txtconslqty1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		f=1;
		return false;
	} 
	if((document.frmaddDepartment.txtconslqty1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		f=1;
		return false;		
	}
	if(srn>=2)
	{
		if((document.frmaddDepartment.txtconslqty2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
		{
			alert("Warehouse Not selected");
			f=1;	
			return false;
		} 
		if((document.frmaddDepartment.txtconslqty2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
		{
			alert("Bin Not selected");	
			f=1;
			return false;
		} 
		if((document.frmaddDepartment.txtconslqty2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
		{
			alert("Sub Bin Not selected");	
			f=1;
			return false;		
		}
	}
	if(document.frmaddDepartment.txtlot1.value!="")
	{
		var q1=0; var q2=0;	var n1=0; var n2=0;	var d=0;
			
		var q1=document.frmaddDepartment.txtconslqty1.value;
		var n1=document.frmaddDepartment.txtconslnob1.value;
		if(srn>=2)
		{
			var q2=document.frmaddDepartment.txtconslqty2.value;
			var n2=document.frmaddDepartment.txtconslnob2.value;
		}
		var d=document.frmaddDepartment.txtnewqty.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;
		if(n1=="")n1=0;if(n2=="")n2=0;
		
		if(d=="")d=0;
		
		var qtyd=parseFloat(q1)+parseFloat(q2);
		var nopsd=parseInt(n1)+parseInt(n2);
		
		//alert(qtyd);
		/*if(parseInt(n) != parseInt(nopsd))
		{
			alert("Please check. NoP distributed in Bins not matching with Total NoP");
			return false;
			f=1;
		}
		if(parseInt(u) != parseInt(Bagsd))
		{
			alert("Please check. NoMP distributed in Bins not matching with Total NoMP");
			return false;
			f=1;
		}*/
		if(parseFloat(d) != parseFloat(qtyd))
		{
			alert("Please check. Balance Quantity distributed in Bins not matching with Total Quantity");
			return false;
			f=1;
		}
		if(qtyd==0)
		{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			return false;
			f=1;
		}
		if(f==1)
		{
			return false;
		}
		else
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'postingtable','mformciupdate','','','','','');
		}
	}
	else
	{
		alert("Please select Lot No.");
		return false;
	}
}


function editrec(v1,v2,v3,v4)
{
	showUser(v1,'postingtable','etdreci',v2,v3,v4,'','');
}

function deleterec(v1,v2,v3)
{
	if(confirm('Do You wish to delete this Variety?')==true)
	{
		showUser(v1,'postingtable','cidelete',v2,v3,'','','');
	}
	else
	{
		return false;
	}
}

function varchk()
{

}

function ycodchk()
{
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="00000";
}

function lot2chk()
{
	if(document.frmaddDepartment.ycodee.value=="")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="00000";
		return false;
	}
	else
	{
		//document.frmaddDepartment.stcode.value="00000";
	}
}
function lotchk()
{	
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	val8=document.frmaddDepartment.stcode2.value;
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
	val3=document.frmaddDepartment.crop.value;
	val4=document.frmaddDepartment.variety.value;
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	val8=document.frmaddDepartment.stcode2.value;
	var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
	document.frmaddDepartment.txtlot1.value=txtlot1;
	document.getElementById('postingsubtable').style.display="none";
	}
}	

function slocshow()
{
	if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Invalid Lot Number");
		//document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="00000";
		return false;
	}
	else
	{
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	val8=document.frmaddDepartment.stcode2.value;
	var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
	document.frmaddDepartment.txtlot1.value=txtlot1;
	}
}

function slocshow2()
{
	if(document.frmaddDepartment.stcode.value=="")
	{
		alert("Invalid Lot Number");
		//document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode2.value="00";
		return false;
	}
	else
	{
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	val8=document.frmaddDepartment.stcode2.value;
	var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
	document.frmaddDepartment.txtlot1.value=txtlot1;
	}
}

function getdetails()
{
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	val8=document.frmaddDepartment.stcode2.value;
	var txtlot1=val7+val2+val5+"/"+val6+"/"+val8;
	document.frmaddDepartment.txtlot1.value=txtlot1;
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select or enter Lot No.");
	}
	else
	{
		var get=document.frmaddDepartment.txtlot1.value;
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
		if(document.frmaddDepartment.txtlot1.value.length<16)
		{
			alert("Lot No cannot be less than 16 digits alphanumaric.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
		//alert(document.frmaddDepartment.txtcrop.value);
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
		//alert(tid);
		//alert(lotid);
		
		document.getElementById('postingsubtable').style.display="block";
		showUser(get,'postingsubtable','showlist',crop,variety,tid,lotid,'','');
	}
}
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#2e81c1"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SP Cycle Inventory</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>

	  
	    <td align="center" colspan="4" >
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="code" value="<?php echo $code;?>" type="hidden">

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<div id="postingtable">
<?php
	$trid=0;
	$subtrid=0;
?> 
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SP Cycle Inventory</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
           <td width="200" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
            <td width="415"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
		   
		   <td width="64" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="161" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" /></td>
		   </tr>
<?php 
$sql_cicrp=mysqli_query($link,"Select * from tbl_ci_crpver WHERE plantcode='".$plantcode."'") or die(mysqli_error($link));
$row_cicrp=mysqli_fetch_array($sql_cicrp);

$classqry=mysqli_query($link,"select * from tblcrop where cropid='".$row_cicrp['ci_crop']."' order by cropname") or die(mysqli_error($link));
?>
<tr class="Light" height="25">
   <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td width="268" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
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
         
<td width="102" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="317" align="left" valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;" onchange="modetchk1(this.value);" >
<option value="" selected>--Select Variety--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="" />

<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
 <tr class="Light" height="25">
            <td width="153" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
    <!--<option value="" >--Select--</option>-->
	<option value="<?php echo $a;?>" selected ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00"  onchange="slocshow2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  <td align="left"valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After entry of lot no. click on 'Get Details')<input type="hidden" name="getdet" value="0" /><input type="hidden" name="txtlot1" value="" /></td>	 
         </tr>	
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">SP Cycle Inventory Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Old Lot No.</td>
	<td width="143" align="center" class="smalltblheading">New Lot No.</td>
	<td width="88" align="center" class="smalltblheading">Stage</td>
	<td width="73" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<td width="73" align="center" class="smalltblheading">Edit</td>
	<td width="72" align="center" class="smalltblheading">Delete</td>
</tr>
</table>
<br />

<div id="postingsubtable">

<input type="hidden" name="maintrid" value="<?php echo $trid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtrid;?>" />
</div>
</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_spci.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
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
