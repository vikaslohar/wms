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
		//exit;
		//$p_id=trim($_POST['maintrid']);
		echo "<script>window.location='add_sales_recallverfy_preview.php?pid=$pid'</script>";	
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Recall - Transaction - Sales Recall - Verification</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

</head>
<script src="srrecall1.js"></script>
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

function imgOnClick(dt, xind, yind)
{
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
}
	
function imgOnClick1(dt, xind, yind)
{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
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
function pacpchchk(pchval,pcno)
{
	/*var mpval=pchval;
	var noppchs="noppchs_"+pcno;
	var dd=document.getElementById('wtmp').value;
	var xc=(parseFloat(mpval)/parseFloat(dd));
	var xv=xc+"";
	var xs=xv.split(".");
	var zx=xs[1].split("");
	var zc=parseFloat(zx[0]);
	if(zc>0)
	{
		alert("Damage Quantity entered is not matching with Master Pack Weight");
		document.getElementById(noppchs).value=0;
		document.getElementById(noppchs).focus();
		return false;
	}*/	
}
function pform()
{	
	//return false;
	var f=0;
	var sno3=document.frmaddDepartment.sno3.value;
	var g=0;
	var q1=0;
	var d1=0;
	var d2=0;
	var ltdq=0;
	g=parseFloat(document.frmaddDepartment.otqty.value).toFixed(3);
	if(parseFloat(g) > 0)
	{
		for(var i=1; i<=document.frmaddDepartment.sno3.value; i++)
		{
			var noptqtys="noptqtys_"+i;
			var noppchs="noppchs_"+i;
			ltdq=parseFloat(ltdq)+parseFloat(document.getElementById(noppchs).value);
			q1=parseFloat(q1)+parseFloat(document.getElementById(noptqtys).value);
		}
	}
	
	if(q1=="")q1=0;
	if(g=="")g=0;
	var qtyg=(parseFloat(q1)).toFixed(3);
	
	d1=document.frmaddDepartment.txtslqtyd1.value;
	//d2=document.frmaddDepartment.txtslqtyd2.value;

	
	if(d1=="")d1=0;if(d2=="")d2=0;

	var qtyd=(parseFloat(d1)+parseFloat(d2)).toFixed(3);
	var qtd=(parseFloat(ltdq)).toFixed(3);
	if(parseFloat(qtd)!=parseFloat(qtyd))
	{
		alert("Please check. Damage Quantity is not matching with Damage Quantity distributed in Bins");
		return false;
		f=1;
	}
	if(parseFloat(g)<(parseFloat(qtyg)+parseFloat(qtyd)))
	{
		alert("Please check. Total Quantity is not matching with Quantity distributed in Bins");
		return false;
		f=1;
	}
	
	if(f==1)
	{
		return false;
	}
	else
	{	//alert("hi");
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDepartment.bbbb.value=a
		showUser(a,'postingtable','mform','','','','','');
	}
}

function pformedtup()
{	
  	var f=0;
	var sno3=document.frmaddDepartment.sno3.value;
	var g=0;
	var q1=0;
	var d1=0;
	var d2=0;
	var ltdq=0;
	g=parseFloat(document.frmaddDepartment.otqty.value).toFixed(3);
	if(parseFloat(g) > 0)
	{
		for(var i=1; i<=document.frmaddDepartment.sno3.value; i++)
		{
			var noptqtys="noptqtys_"+i;
			var noppchs="noppchs_"+i;
			ltdq=parseFloat(ltdq)+parseFloat(document.getElementById(noppchs).value);
			q1=parseFloat(q1)+parseFloat(document.getElementById(noptqtys).value);
		}
	}
	
	if(q1=="")q1=0;
	if(g=="")g=0;
	var qtyg=(parseFloat(q1)).toFixed(3);
	
	d1=document.frmaddDepartment.txtslqtyd1.value;
	//d2=document.frmaddDepartment.txtslqtyd2.value;

	
	if(d1=="")d1=0;if(d2=="")d2=0;

	var qtyd=(parseFloat(d1)+parseFloat(d2)).toFixed(3);
	var qtd=(parseFloat(ltdq)).toFixed(3);
	if(parseFloat(qtd)!=parseFloat(qtyd))
	{
		alert("Please check. Damage Quantity is not matching with Damage Quantity distributed in Bins");
		return false;
		f=1;
	}
	if(parseFloat(g)<(parseFloat(qtyg)+parseFloat(qtyd)))
	{
		alert("Please check. Total Quantity is not matching with Quantity distributed in Bins");
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
		showUser(a,'postingtable','mformsubedt','','','','');
	}
}

function clk(opt)
{
	if(document.frmaddDepartment.txtpackagetyp.value!="")
	{
		if(opt!="")
		{
			if(opt=="Transport")
			{
				document.getElementById('trans').style.display="block";
				document.getElementById('courier').style.display="none";
				document.getElementById('byhand').style.display="none";
				document.frmaddDepartment.txt11.value=opt;
			}
			else if(opt=="Courier")
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="block";
				document.getElementById('byhand').style.display="none";
				document.frmaddDepartment.txt11.value=opt;
			}	
			else
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="none";
				document.getElementById('byhand').style.display="block";
				document.frmaddDepartment.txt11.value=opt;
			}	
		}
		else
		{
			alert("Please Select Mode of Transport");
			document.frmaddDepartment.txt11.value="";
		}
	}
	else
	{
		alert("Please select Type of Packages");
		return false;
	}
}

function actq(Bagsval1)
{
	document.frmaddDepartment.txtdbag.value=parseInt(Bagsval1)+parseInt(document.frmaddDepartment.txtaqty.value)-parseInt(document.frmaddDepartment.txtraw.value);
}

function actb(Bagsval1)
{
	document.frmaddDepartment.txtdqty.value=parseFloat(Bagsval1)+parseFloat(document.frmaddDepartment.txtbag.value)-parseInt(document.frmaddDepartment.txtqty.value);
}

function clk1(val)
{
	document.frmaddDepartment.txt14.value=val;
}

function Bagschk(Bagsval)
{
	if(document.frmaddDepartment.txtqtydc.value > 0)
	{
		if(document.frmaddDepartment.txtBagsdc.value > 0)
		{
			if(document.frmaddDepartment.txtBagsd.value=="")
			document.frmaddDepartment.txtexshBags.value=parseInt(Bagsval)-parseInt(document.frmaddDepartment.txtBagsdc.value);
			else
			document.frmaddDepartment.txtexshBags.value=parseInt(Bagsval)+parseInt(document.frmaddDepartment.txtBagsd.value)-parseInt(document.frmaddDepartment.txtBagsdc.value);
		}
		else
		{
			alert("Please enter Bags as per DC first");
			document.frmaddDepartment.txtBagsg.value="";
			document.frmaddDepartment.txtBagsdc.focus();
		}
	}
	else
	{
		alert("Please enter Quantity as per DC first");
		document.frmaddDepartment.txtqtyg.value="";
		document.frmaddDepartment.txtexshqty.value="";
		document.frmaddDepartment.txtqtydc.focus();
	}

}

function Bagschk1(Bagsval1)
{
	document.frmaddDepartment.txtdbagp.value=parseFloat(document.frmaddDepartment.txtrawp.value)-parseFloat(Bagsval1);
}

function Bagschk(Bagsval1)
{
	document.frmaddDepartment.txtdisp.value=parseInt(Bagsval1)+parseInt(document.frmaddDepartment.recqtyp.value)-parseInt(document.frmaddDepartment.txtdqtyp.value);
}

function qtychk1(qtyval1)
{
	document.frmaddDepartment.txtdqtyp.value=parseFloat(document.frmaddDepartment.txtdisp.value)-parseFloat(qtyval1);
}

function showslocbins()
{
	var lotno=document.frmaddDepartment.pcodeo.value+document.frmaddDepartment.ycodeeo.value+document.frmaddDepartment.txtlot2o.value+"/"+document.frmaddDepartment.stcodeo.value+"/"+document.frmaddDepartment.stcode2o.value;
	
	var subid=document.frmaddDepartment.subtrid.value;
	var clasid=document.frmaddDepartment.ocrp.value;
	var itmid=document.frmaddDepartment.overty.value;
	var upsval=document.frmaddDepartment.oups.value;
	var goodqty=document.frmaddDepartment.txtqtydc.value;
	var stage="Pack";
	var subval=document.frmaddDepartment.rbcrefno.value;
	var trid=document.frmaddDepartment.maintrid.value;
	//showUser(stage,'subsubdivgood','slocshowsubgood',clasid,itmid,lotno,subid,dmgqty,goodqty);
	showUser(subval,'subsubdivgood','showbarlotsync',trid,clasid,itmid,upsval,lotno,goodqty,subid);	
	if(document.frmaddDepartment.txtqtydc2.value > 0)
	setTimeout('showslocdbins()',200);
}

function showslocdbins()
{
	var lotno=document.frmaddDepartment.pcodeo.value+document.frmaddDepartment.ycodeeo.value+document.frmaddDepartment.txtlot2o.value+"/"+document.frmaddDepartment.stcodeo.value+"/"+document.frmaddDepartment.stcode2o.value;
	
	var subid=document.frmaddDepartment.subtrid.value;
	var clasid=document.frmaddDepartment.ocrp.value;
	var itmid=document.frmaddDepartment.overty.value;
	var upsval=document.frmaddDepartment.oups.value;
	var goodqty=document.frmaddDepartment.txtqtydc2.value;
	var stage="Pack";
	var subval=document.frmaddDepartment.rbcrefno.value;
	var trid=document.frmaddDepartment.maintrid.value;
	//showUser(stage,'subsubdivgood','slocshowsubgood',clasid,itmid,lotno,subid,dmgqty,goodqty);
	showUser(subval,'subsubdivdamage','slocshowsubdamage',trid,clasid,itmid,upsval,lotno,goodqty,subid);	
}

function classchk(itval)
{
	if(document.frmaddDepartment.txtlotp.value=="")
	{
		alert("Please Fill ST Lot No. ");
		document.frmaddDepartment.txtqtystat.value="";
	}
	setTimeout('showslocbins()',200);
}

function itemcheck()
{
	if(document.frmaddDepartment.txtsttp.value=="")
	{
		alert("Please Fill Stock Transfer To Plant");
		document.frmaddDepartment.txtlotp.value="";
	}
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please Enter STN No.");
		document.frmaddDepartment.txtlotp.value="";
	}

	/*if(document.frmaddDepartment.txtlot.value!="" && (parseInt(document.frmaddDepartment.itmdchk.value)>=parseInt(document.frmaddDepartment.txtlot.value)))
	{
		alert("Can not enter Lot No.\nReason: Number of Lots has been reached to Maximum No. of Lots.");
		document.frmaddDepartment.txtlotp.value="";
		return false;
	}*/
}

function Bagsdcchk()
{
	if(document.frmaddDepartment.txtqtystat.value=="")
	{
		alert("Please Select Quality Status");
		document.frmaddDepartment.txtqtystat.value="";
	}
	if(document.frmaddDepartment.txtrecbagp.value!="")
	{	
		document.frmaddDepartment.txtdbagp.value=parseFloat(document.frmaddDepartment.txtrawp.value)-parseFloat(document.frmaddDepartment.txtrecbagp.value);
	}
	
}

function Bagsdcchk1()
{
	if(document.frmaddDepartment.recqtyp.value!="")
	{	
		document.frmaddDepartment.txtdqtyp.value=parseFloat(document.frmaddDepartment.txtdisp.value)-parseFloat(document.frmaddDepartment.recqtyp.value);
	}
}

function recqty()
{

}

function Bagsdcchk2()
{

}

function modetchk(classval)
{	
	showUser(classval,'vitem','vitem','','','','','');
}

function variety()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety");
		//document.frmaddDepartment.sstage.value="";
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	else
	{
		var variet=document.frmaddDepartment.txtvariety.value;
		var stage=document.frmaddDepartment.sstage.value;
		var crop=document.frmaddDepartment.txtcrop.value;
		showUser(stage,'postingsubtable','showpostform',crop,variet,'','','');
	}
}

function packqchk()
{
	if(document.frmaddDepartment.sn.value > 0)
	{
		var sn=document.frmaddDepartment.sn.value;
		var qt=0;
		var cnt=1;
		var q=0;
		while(cnt<=sn)
		{
			if(document.getElementById("txtp_"+cnt).value!="")
			{
				q=parseFloat(q)+(parseFloat(document.getElementById("txtp_"+cnt).value) * parseFloat(document.getElementById("txtqtinkgs_"+cnt).value));
				qt=parseFloat(qt)+(parseFloat(document.getElementById("txtp_"+cnt).value));
			}
			cnt++;
		}
		if(q > 0)
		{
			document.frmaddDepartment.recqtyp.value=q;
			document.frmaddDepartment.txtrecbagp.value=qt;
		}
		else
		{
			document.frmaddDepartment.recqtyp.value="";
			document.frmaddDepartment.txtrecbagp.value="";
		}
	}
	else
	{
		alert("Unit Pack Size hs not been defined");
	}
}

function vendorchk()
{
	if(document.frmaddDepartment.txtcla.value=="")
	{
		alert("Please select Stock Transfer from first");
		document.frmaddDepartment.txtdcno.value="";
	}
}

function dcnochk()
{
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter STN first");
		document.frmaddDepartment.txtporn.value="";
	}
}

function openslocpop()
{
	if(document.frmaddDepartment.txtvariety.value!="")
	{
		var itm=document.frmaddDepartment.txtvariety.value;
		winHandle=window.open('item_sloc_details.php?itmid='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
		alert("Please Select Item first.");
		document.frmaddDepartment.txtvariety.focus();
	}
}

function wh(wh1val, whno)
{ 
	var whi="txtslwhg"+whno;
	if(whno>1)
	{
		var qtys="txtslqtyg"+whno-1;
		if(document.getElementsByName(qtys)[0].value=="")
		{
			alert("Please enter Qty in previous Bin")
			document.getElementsByName(whi)[0].selectedIndex=0;
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
						$ct++;
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
		var slocnogood=document.frmaddDepartment.sstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var Bagsv1="";
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

function editrec(edtrecid, trid)
{
	showUser(edtrecid,'postingsubsubtable','subformedt',trid,'','','','');
}

function deleterec(v1,v2,v3)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,v3,'','','');
	}
	else
	{
		return false;
	}
}

function whd1(wh1val)
{ 
	showUser(wh1val,'bind1','whd','bind1','','','','');
}

function whd2(wh2val)
{   
	showUser(wh2val,'bind2','whd','bind2','','','','');
}

function bind1(bin1val)
{
	if(document.frmaddDepartment.txtslwhd1.value!="")
	{
		showUser(bin1val,'sbind1','bind','txtslsubbd1','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bind2(bin2val)
{
	if(document.frmaddDepartment.txtslwhd2.value!="")
	{
		showUser(bin2val,'sbind2','bind','txtslsubbd2','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function subbind1(subbin1val)
{	
	var itemv=document.frmaddDepartment.overty.value;
	if(document.frmaddDepartment.txtslbind1.value!="")
	{	
		var slocnogood=document.frmaddDepartment.sstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtslBagsd1.value!="")
			var Bagsv1=document.frmaddDepartment.txtslBagsd1.value;
		else
			var Bagsv1="";
		if(document.frmaddDepartment.txtslqtyd1.value!="")
			var qtyv1=document.frmaddDepartment.txtslqtyd1.value;
		else
			var qtyv1="";
		showUser(subbin1val,'slocrowd1','subbind',itemv,'txtslsubbd1',slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbind1.focus();
	}
}

function subbind2(subbin2val)
{	
	var itemv=document.frmaddDepartment.overty.value;
	if(document.frmaddDepartment.txtslbind2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhd1.value+document.frmaddDepartment.txtslbind1.value+document.frmaddDepartment.txtslsubbd1.value;
		var w2=document.frmaddDepartment.txtslwhd2.value+document.frmaddDepartment.txtslbind2.value+document.frmaddDepartment.txtslsubbd2.value;
		if(w1==w2)
		{
			alert("Please check, No two Bin information can be similar in a given transaction");
			document.getElementById('sbd2').selectedIndex=0;
			document.frmaddDepartment.txtslbind2.focus();
		}
		
		if(document.frmaddDepartment.txtslsubbd1.value!="")
		
		var slocnogood=document.frmaddDepartment.sstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		if(document.frmaddDepartment.txtslBagsd2.value!="")
			var Bagsv2=document.frmaddDepartment.txtslBagsd2.value;
		else
			var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyd2.value!="")
			var qtyv2=document.frmaddDepartment.txtslqtyd2.value;
		else
			var qtyv2="";
		showUser(subbin2val,'slocrowd2','subbind',itemv,'txtslsubbd2',slocnogood,Bagsv2,qtyv2,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbind2.focus();
	}
}

function Bagsfd1(Bags1val)
{
	if(document.frmaddDepartment.txtslsubbd1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsd1.value="";
	}
	if(document.frmaddDepartment.txtslBagsd1.value!="")
	{
		/*if(parseInt(document.frmaddDepartment.txtslBagsd1.value)==0 || document.frmaddDepartment.txtslBagsd1.value=="")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsd1.value="";
		}
		var exu=0;
		if(document.frmaddDepartment.exusp1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp1.value);
			document.frmaddDepartment.balBags1.value=parseInt(document.frmaddDepartment.txtslBagsg1.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balBags1.value="";*/
	}
}

function Bagsfd2(Bags2val)
{
	if(document.frmaddDepartment.txtslsubbd2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsd2.value="";
		document.frmaddDepartment.txtslsubbd2.focus();
	}
	if(document.frmaddDepartment.txtslBagsd2.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsd2.value==0 || document.frmaddDepartment.txtslBagsd2.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsd2.value="";
			document.frmaddDepartment.txtslBagsd2.focus();
		}
		var exu=0;
		if(document.frmaddDepartment.exusp2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp2.value);
			document.frmaddDepartment.balBags2.value=parseInt(document.frmaddDepartment.txtslBagsg2.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balBags2.value="";*/
	}
}

function qtyfd1(qty1val)
{	
	if(document.frmaddDepartment.txtslBagsd1.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyd1.value="";
	}
	if(document.frmaddDepartment.txtslqtyd1.value!="")
	{
		/*	if(document.frmaddDepartment.txtslqtyd1.value==0 || document.frmaddDepartment.txtslqtyd1.value=="0")
			{
				alert("Quantity can not be ZERO");
				document.frmaddDepartment.txtslqtyd1.value="";
				document.frmaddDepartment.txtslqtyd1.focus();
			}
			
		var exq=0;
		if(document.frmaddDepartment.exqty1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty1.value);
		document.frmaddDepartment.balqty1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqty1.value="";*/
	}

}

function qtyfd2(qty2val)
{
	if(document.frmaddDepartment.txtslBagsd2.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyd2.value="";
		document.frmaddDepartment.txtslBagsd2.focus();
	}
	if(document.frmaddDepartment.txtslqtyd2.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyd2.value==0 || document.frmaddDepartment.txtslqtyd2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyd2.value="";
			document.frmaddDepartment.txtslqtyd2.focus();
		}
		var exq=0;
		if(document.frmaddDepartment.exqty2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty2.value);
		document.frmaddDepartment.balqty2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqty2.value="";*/
	}
}

function mySubmit()
{ 
	/*if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}*/
	return true;	 
}

function nolchk(nolval)
{
	if(nolval <= 0 )
	{
		alert("Number of Lots cannot be Zero");
		document.frmaddDepartment.txtlot.value=="";
	}
}

function gensmpchk()
{
	if(document.frmaddDepartment.qc1.checked==false)
	{ 
		document.frmaddDepartment.gotstatus.value=document.frmaddDepartment.txtgot.value+' NUT';
		//document.getElementById('qcstatusid').style.display="block"
		//document.getElementById('qcstatusid1').style.display="none"
		//document.frmaddDepartment.txtqc1.value="Under Test";
		document.frmaddDepartment.gscheckbox.value=0;
	}
	else
	{ 
		document.frmaddDepartment.gotstatus.value=document.frmaddDepartment.txtgot.value+' Under Test';
		//document.getElementById('qcstatusid').style.display="none"
		//document.getElementById('qcstatusid1').style.display="block"
		//document.frmaddDepartment.txtqc1.value="Under Test";
		document.frmaddDepartment.gscheckbox.value=1;
	}
}

function openslocpop1()
{
	if(document.frmaddDepartment.txtvisualck.value=="")
	{
		 alert("Please Select Visual check.");
		 //document.frmaddDepartment.txtvisualck.focus();
	}
	else
	{
		var itm=document.frmaddDepartment.sstatus.value;
		winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function moischk()
{
	if(document.frmaddDepartment.recqtyp.value=="")
	{
		alert("Enter Received Qty");
		document.frmaddDepartment.txtmoist.value="";
	}
}

function moischk1()
{
	if(document.frmaddDepartment.gotstatus.value=="")
	{
		alert("Please Select Got Status");
		document.frmaddDepartment.txtgermi.value="";
	}
}

function visuchk()
{
	if(document.frmaddDepartment.txtvisualck.value=="")
	{
		alert("Please Select visual Check");
		//document.frmaddDepartment.txtgot.SelectedIndex=0;
		return false;
	}
	/*if(document.frmaddDepartment.qc3.value=="Mandatory")
	{
		document.frmaddDepartment.gotstatus.value=gchk+' Under Test';
		//document.getElementById('qcstatusid').style.display="none"
		//document.getElementById('qcstatusid1').style.display="block"
		//document.frmaddDepartment.txtqc1.value="Under Test";
		document.frmaddDepartment.gscheckbox.value=1;
	}
	else
	{
		if(document.frmaddDepartment.qc1.checked==false)
		{ 
			document.frmaddDepartment.gotstatus.value=gchk+' NUT';
			//document.getElementById('qcstatusid').style.display="block"
			//document.getElementById('qcstatusid1').style.display="none"
			//document.frmaddDepartment.txtqc1.value="Under Test";
			document.frmaddDepartment.gscheckbox.value=0;
		}
		else
		{ 
			document.frmaddDepartment.qc1.value=gchk+' Under Test';
			//document.getElementById('qcstatusid').style.display="none"
			//document.getElementById('qcstatusid1').style.display="block"
			//document.frmaddDepartment.txtqc1.value="Under Test";
			document.frmaddDepartment.gscheckbox.value=1;
		}
	}*/
}
	
function visuchk1()
{
	if(document.frmaddDepartment.txtgot.value=="")
	{
		alert("Please Select Got Type");
		//document.frmaddDepartment.txtvisualck.value="";
	}
	else
	{
		var lotno=document.frmaddDepartment.pcode.value+document.frmaddDepartment.ycodee.value+document.frmaddDepartment.txtlot2.value+"/"+document.frmaddDepartment.stcode.value;
	
		var subid=document.frmaddDepartment.subtrid.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		var dmgqty=document.frmaddDepartment.txtqtydc2.value;
		var goodqty=document.frmaddDepartment.txtqtydc.value;
		var stage=document.frmaddDepartment.txtsrtyp.value;
		showUser(stage,'subsubdivgood','slocshowsubgood',clasid,itmid,lotno,subid,dmgqty,goodqty);
	}
}

function dcdchk()
{
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	if(dt3 > dt4)
	{
		alert("Please select Valid Delivary Challan Date.");
		document.frmaddDepartment.txtdcno.value="";
		return false;
	}
}

function modetchk1(classval)
{	
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter DC Number first");
		document.frmaddDepartment.txtpp.selectedIndex=0;
		document.getElementById('selectpartylocation').style.display="none";
		document.getElementById('selectparty').style.display="none";
		document.frmaddDepartment.txtptype.value="";
		document.frmaddDepartment.rettype.value="";
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}
	else
	{
		if(classval != "")
		{
			document.getElementById('selectpartylocation').style.display="block";
			document.getElementById('selectparty').style.display="none";
			showUser(classval,'selectpartylocation','partylocation','','','','','');
			document.frmaddDepartment.txtptype.value=classval;
			if(classval=="Dealer" || classval=="Bulk" || classval=="Export Buyer")
			document.frmaddDepartment.rettype.value="Sales Recall P to C";	
			else if(classval=="Branch" || classval=="C&F")
			document.frmaddDepartment.rettype.value="Stock Transfer P to C";	
			else
			document.frmaddDepartment.rettype.value="";	
		}
		else
		{
			document.getElementById('selectpartylocation').style.display="none";
			document.getElementById('selectparty').style.display="none";
			document.frmaddDepartment.txtptype.value=classval;
			document.frmaddDepartment.rettype.value="";	
		}
	}	
}
	
function locslchk(statesl)
{
	showUser(statesl,'locations','location','','','','','','');
}

function stateslchk(valloc)
{
	if(document.frmaddDepartment.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
	}
	else
	{
		var classval=document.frmaddDepartment.txtptype.value;
		document.getElementById('selectparty').style.display="block";
		showUser(classval,'vitem1','item1',valloc,'','','','');
		document.frmaddDepartment.locationname.value=valloc;
	}
}

function loccontrychk(countryval)
{
	if(document.frmaddDepartment.txtpp.value!="")
	{
		var classval=document.frmaddDepartment.txtptype.value;
		document.getElementById('selectparty').style.display="block";
		showUser(classval,'vitem1','item1',countryval,'','','','');
		document.frmaddDepartment.locationname.value=countryval;
		document.frmaddDepartment.txtcountry1.value=countryval;
	}
	else
	{
		alert("Please Select Party Type");
		document.frmaddDepartment.txtcountrysl.selectedIndex=0;
	}

}

function ptchk(npval)
{
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please Select Party Type");
		document.frmaddDepartment.txtdcnopac.value="";
		return false;
	}
	if(document.frmaddDepartment.locationname.value=="")
	{
		alert("Please Select Location/Country");
		document.frmaddDepartment.txtdcnopac.value="";
		return false;
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Party");
		document.frmaddDepartment.txtdcnopac.value="";
		return false;
	}
	if(npval==0)
	{
		alert("Invalid Number of Packages");
		document.frmaddDepartment.txtdcnopac.value="";
		return false;
	}
}

function dcnpchk()
{
	if(document.frmaddDepartment.txtdcnopac.value=="")
	{
		alert("Please enter Number of Packages");
		document.frmaddDepartment.txtpackagetyp.selectedIndex=0;
		document.frmaddDepartment.txtdcnopac.focus();
		return false;
	}
}

function verchk()
{
	if(document.frmaddDepartment.stcodeo.value=="")
	{
		alert("Please enter Old Lot Number");
		document.frmaddDepartment.txtupsdc.value="";
		document.frmaddDepartment.stcodeo.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtsrtyp.value=="")
	{
		alert("Please select Return Type");
		document.frmaddDepartment.txtupsdc.value="";
		document.frmaddDepartment.txtsrtyp.focus();
		return false;
	}
	else
	{
		//showUser(subval,'postingsubsubtable','showversc',trid,typ,'','','');
	}
}


function showverifyscnew(subval,cropval,varietyval,upsval)
{
	var trid=document.frmaddDepartment.maintrid.value;
	var typ="vernew";
	//var subval="";
	showUser(subval,'postingsubsubtable','showversc',trid,cropval,varietyval,upsval,typ);	
	//showUser(subval,'postingsubsubtable','showbarlotsync',trid,cropval,varietyval,upsval,'');	
}

function showverifysc(subval,cropval,varietyval,upsval,nob,qty,subtid)
{
	var trid=document.frmaddDepartment.maintrid.value;
	var typ="verrec";
	//var subval=""; 
	showUser(subval,'postingsubsubtable','showversc',trid,cropval,varietyval,upsval,typ,nob,qty,subtid);	
}

function srtchk(srtval)
{
	document.frmaddDepartment.rettype.value="Sales Recall - ";
	if(document.frmaddDepartment.lotchecko.value == 0)
	{
		alert("Lot Number not present in System");
		document.frmaddDepartment.txtsrtyp.selectedIndex=0;
		document.frmaddDepartment.txtsrtyp.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.stcodeo.focus();
		return false;
	}
	else if(document.frmaddDepartment.stcodeo.value == "")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtsrtyp.selectedIndex=0;
		document.frmaddDepartment.txtsrtyp.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.stcodeo.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.rettype.value=document.frmaddDepartment.rettype.value+srtval;
		if(srtval=="P2C")
			document.frmaddDepartment.sstage.value="Condition";
		else if(srtval=="P2P")
			document.frmaddDepartment.sstage.value="Pack";
		else
			document.frmaddDepartment.sstage.value="Condition";
			
		var lotno=document.frmaddDepartment.pcode.value+document.frmaddDepartment.ycodee.value+document.frmaddDepartment.txtlot2.value+"/"+document.frmaddDepartment.stcode.value;
	
		var subid=document.frmaddDepartment.subtrid.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		var dmgqty=document.frmaddDepartment.txtqtydc2.value;
		var goodqty=document.frmaddDepartment.txtqtydc.value;
		var stage=document.frmaddDepartment.txtsrtyp.value;
		showUser(stage,'subsubdivgood','slocshowsubgood',clasid,itmid,lotno,subid,dmgqty,goodqty);	
	}
}

function upstypchk(upval)
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety");
		document.frmaddDepartment.upstype[0].checked=false;
		document.frmaddDepartment.upstype[1].checked=false;
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	if(upval!="")
	{
		if(upval=="Standard")
		{
			var varval=document.frmaddDepartment.txtvariety.value;
			showUser(varval,'upschd','upschdc',upval,'','','','','');
			document.frmaddDepartment.txtupstyp.value=upval;
		}
		else if(upval=="Non-Standard")
		{
			var varval=document.frmaddDepartment.txtvariety.value;
			showUser(varval,'upschd','upschdc',upval,'','','','','');
			document.frmaddDepartment.txtupstyp.value=upval;
		}
		else
		{
			document.frmaddDepartment.upstype[0].checked=false;
			document.frmaddDepartment.upstype[1].checked=false;
			document.frmaddDepartment.txtupstyp.value="";
			return false;
		}
	}
	else
	{
		document.frmaddDepartment.upstype[0].checked=false;
		document.frmaddDepartment.upstype[1].checked=false;
		document.frmaddDepartment.txtupstyp.value="";
		return false;
	}
}

function modetchk2(varval)
{
	showUser(varval,'upschd','upschdc','Standard','','','','','');
}

function pcdchk(pcdval)
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.pcodeo.value="";
		document.getElementById('pcodeo').SelectedIndex=0;
		document.frmaddDepartment.ycodeeo.value="";
		document.getElementById('ycodeeo').SelectedIndex=0;
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.pcode.value="";
		document.frmaddDepartment.ycodee.value="";
		document.frmaddDepartment.txtlot2.value="";
		return false;
	}
	else
	{
		document.frmaddDepartment.pcode.value=document.frmaddDepartment.pcodeo.value;
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
	}
}

function ycodchko(ycodval)
{
	if(document.frmaddDepartment.pcodeo.value=="")
	{
		alert("Please Select Plant Code");
		document.frmaddDepartment.ycodeeo.value="";
		document.getElementById('ycodeeo').SelectedIndex=0;
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
		return false;
	}
}

function lot2chko(lotchval)
{
	if(document.frmaddDepartment.ycodeeo.value=="")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot2o.value="";
		document.frmaddDepartment.stcodeo.value="";
		return false;
	}
	if(document.frmaddDepartment.stcodeo.value!="")
	{
		var val1=document.frmaddDepartment.pcodeo.value;
		var val2=document.frmaddDepartment.ycodeeo.value;
		var val3=document.frmaddDepartment.txtlot2o.value;
		var val4=document.frmaddDepartment.stcodeo.value;
		var val6=document.frmaddDepartment.stcode2o.value;
		var lot=val1+val2+val3+"/"+val4+"/"+val6;	
		var clasid=document.frmaddDepartment.ocrp.value;
		var itmid=document.frmaddDepartment.overty.value;
		var vtyp=document.frmaddDepartment.vtyp.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var oups=document.frmaddDepartment.oups.value;
		showUser(lot,'crpvershow','lotchko',clasid,itmid,vtyp,trid,oups,val1);
	}
}

function stchko()
{
	if(document.frmaddDepartment.txtlot2o.value=="")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.stcodeo.focus()
		document.frmaddDepartment.stcodeo.value="";
		return false;
	}
	else if(document.frmaddDepartment.stcodeo.value.length < 5)
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.stcodeo.focus()
		document.frmaddDepartment.stcodeo.value="";
		return false;
	}
	else
	{
		var val1=document.frmaddDepartment.pcodeo.value;
		var val2=document.frmaddDepartment.ycodeeo.value;
		var val3=document.frmaddDepartment.txtlot2o.value;
		var val4=document.frmaddDepartment.stcodeo.value;
		var val6=document.frmaddDepartment.stcode2o.value;
		var lot=val1+val2+val3+"/"+val4+"/"+val6;	
		var clasid=document.frmaddDepartment.ocrp.value;
		var itmid=document.frmaddDepartment.overty.value;
		var vtyp=document.frmaddDepartment.vtyp.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var oups=document.frmaddDepartment.oups.value;
		showUser(lot,'crpvershow','lotchko',clasid,itmid,vtyp,trid,oups,val1);
	}
}

function stchko2()
{
	if(document.frmaddDepartment.stcodeo.value == "")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.stcodeo.value="";
		document.frmaddDepartment.stcodeo.focus();
		return false;
	}
	else
	{
		var val1=document.frmaddDepartment.pcodeo.value;
		var val2=document.frmaddDepartment.ycodeeo.value;
		var val3=document.frmaddDepartment.txtlot2o.value;
		var val4=document.frmaddDepartment.stcodeo.value;
		var val6=document.frmaddDepartment.stcode2o.value;
		var lot=val1+val2+val3+"/"+val4+"/"+val6;	
		var clasid=document.frmaddDepartment.ocrp.value;
		var itmid=document.frmaddDepartment.overty.value;
		var vtyp=document.frmaddDepartment.vtyp.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var oups=document.frmaddDepartment.oups.value;
		showUser(lot,'crpvershow','lotchko',clasid,itmid,vtyp,trid,oups,val1);
	}
}
function gotchk(qcsrval)
{
	if(document.frmaddDepartment.txtqtydc.value=="")
	{
		alert("Please enter Quantity");
		document.frmaddDepartment.txtgstat.value="";
		document.frmaddDepartment.txtqtydc.focus();
		return false;
	}
}
function qtchk(qcsrval)
{
	if(document.frmaddDepartment.txtgstat.value=="")
	{
		alert("Please select GOT Type");
		document.frmaddDepartment.txtgotstatus.value;
		document.frmaddDepartment.txtgstat.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtgotstatus.value=qcsrval;
	}
}

function upchk(npval)
{
	var f=0;
	if(document.frmaddDepartment.stcodeo.value=="")
	{
		alert("Please enter Lot Number");
		document.frmaddDepartment.txtnopdc.value="";
		document.frmaddDepartment.stcodeo.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtupsdc.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtnopdc.value="";
		document.frmaddDepartment.txtupsdc.focus();
		f=1;
		return false;
	}
		
	if(npval<0)
	{
		alert("Invalid NoP");
		document.frmaddDepartment.txtnopdc.value="";
		document.frmaddDepartment.txtnopdc.focus();
		f=1;
		return false;
	}
	if(f!=0)
	{
		return false;
	}
	else
	{
		document.frmaddDepartment.txtnopdc3.value=parseInt(document.frmaddDepartment.txtnopd.value)-(parseInt(document.frmaddDepartment.txtnopdc.value)+parseInt(document.frmaddDepartment.txtnopdc2.value));
		document.frmaddDepartment.txtqtydc3.value=parseFloat(document.frmaddDepartment.txtqtyd.value)-(parseFloat(document.frmaddDepartment.txtqtydc.value)+parseFloat(document.frmaddDepartment.txtqtydc2.value));
	}
}

function upchk2(npval)
{
	if(document.frmaddDepartment.txtnopdc.value=="")
	{
		alert("Please enter NoP");
		document.frmaddDepartment.txtnopdc2.value="";
		document.frmaddDepartment.txtnopdc.focus();
		return false;
	}
	else if(npval<0)
	{
		alert("Invalid NoP");
		document.frmaddDepartment.txtnopdc2.value="";
		document.frmaddDepartment.txtnopdc2.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtnopdc3.value=parseInt(document.frmaddDepartment.txtnopd.value)-(parseInt(document.frmaddDepartment.txtnopdc.value)+parseInt(document.frmaddDepartment.txtnopdc2.value));
		document.frmaddDepartment.txtqtydc3.value=parseFloat(document.frmaddDepartment.txtqtyd.value)-(parseFloat(document.frmaddDepartment.txtqtydc.value)+parseFloat(document.frmaddDepartment.txtqtydc2.value));
	}
}

function nopschk(qtval)
{
	var f=0;
	if(document.frmaddDepartment.txtnopdc2.value=="")
	{
		alert("Please enter NoP");
		document.frmaddDepartment.txtqtydc.value="";
		document.frmaddDepartment.txtnopdc2.focus();
		f=1;
		return false;
	}
	
	if(qtval<0)
	{
		alert("Invalid Qty");
		document.frmaddDepartment.txtqtydc.value="";
		document.frmaddDepartment.txtqtydc.focus();
		f=1;
		return false;
	}
	if(f!=0)
	{
		return false;
	}
	else
	{
		document.frmaddDepartment.txtqtydc3.value=parseFloat(document.frmaddDepartment.txtqtyd.value)-(parseFloat(document.frmaddDepartment.txtqtydc.value)+parseFloat(document.frmaddDepartment.txtqtydc2.value));
		document.frmaddDepartment.txtnopdc3.value=parseInt(document.frmaddDepartment.txtnopd.value)-(parseInt(document.frmaddDepartment.txtnopdc.value)+parseInt(document.frmaddDepartment.txtnopdc2.value));
		setTimeout('showslocbins()',200);
	}
}

function nopschk2(qtval)
{
	if(document.frmaddDepartment.txtqtydc.value=="")
	{
		alert("Please enter Qty");
		document.frmaddDepartment.txtqtydc2.value="";
		document.frmaddDepartment.txtqtydc.focus();
		return false;
	}
	else if(qtval<0)
	{
		alert("Invalid Qty");
		document.frmaddDepartment.txtqtydc2.value="";
		document.frmaddDepartment.txtqtydc2.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtqtydc3.value=parseFloat(document.frmaddDepartment.txtqtyd.value)-(parseFloat(document.frmaddDepartment.txtqtydc.value)+parseFloat(document.frmaddDepartment.txtqtydc2.value));
		document.frmaddDepartment.txtnopdc3.value=parseInt(document.frmaddDepartment.txtnopd.value)-(parseInt(document.frmaddDepartment.txtnopdc.value)+parseInt(document.frmaddDepartment.txtnopdc2.value));
		setTimeout('showslocdbins()',200);
	}
}

function linkbarc(lotno)
{
	var subid=document.frmaddDepartment.subtrid.value;
	var crop=document.frmaddDepartment.ocrp.value;
	var variety=document.frmaddDepartment.overty.value;
	var upsval=document.frmaddDepartment.oups.value;
	var goodqty=document.frmaddDepartment.otqty.value;
	var otnop=document.frmaddDepartment.otnop.value;
	var stage="Pack";
	var txtpsrn=document.frmaddDepartment.rbcrefno.value;
	var trid=document.frmaddDepartment.maintrid.value;
	winHandle=window.open('lotpackaging_barsync.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety+'&upsval='+upsval+'&trid='+trid+'&subid='+subid+'&otqty='+goodqty+'&otnop='+otnop,'WelCome','top=170,left=180,width=950,height=550,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function unlinkbarc(snoval)
{
	var lotno1="txtlotno"+snoval;
	var lotno=document.getElementById(lotno1).value;
	var subid=document.frmaddDepartment.subtrid.value;
	var crop=document.frmaddDepartment.ocrp.value;
	var variety=document.frmaddDepartment.overty.value;
	var upsval=document.frmaddDepartment.oups.value;
	var goodqty=document.frmaddDepartment.otqty.value;
	var otnop=document.frmaddDepartment.otnop.value;
	var stage="Pack";
	var txtpsrn=document.frmaddDepartment.rbcrefno.value;
	var trid=document.frmaddDepartment.maintrid.value;
	winHandle=window.open('lotpackaging_barunlinc.php?lotno='+lotno+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety+'&upsval='+upsval+'&trid='+trid+'&subid='+subid+'&otqty='+goodqty+'&otnop='+otnop,'WelCome','top=170,left=180,width=950,height=550,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function unidupdate(sbinval, crop, variety, upsval, txtpsrn, trid, onop, oqty)
{
	var subid=document.frmaddDepartment.subtrid.value;
	winHandle=window.open('lotunidupdate_recallverify.php?sbinval='+sbinval+'&txtpsrn='+txtpsrn+'&crop='+crop+'&variety='+variety+'&upsval='+upsval+'&trid='+trid+'&subid='+subid+'&onop='+onop+'&oqty='+oqty,'WelCome','top=30,left=80,width=850,height=600,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" style="border-bottom:solid; border-bottom-color:#a8a09e" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Sales Recall - Verification</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Sales Recall' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['salesr_id'];

	$tdate=$row_tbl['salesr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['salesr_dcdate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
?>	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	 <input name="txt14" value="" type="hidden"> 
	 <input type="hidden" name="txtid" value="<?php echo $code?>" />
	 <input type="hidden" name="logid" value="<?php echo $logid?>" />
	 <input type="hidden" name="slrgln1" value="<?php echo $code2;?>" />
	 <input type="hidden" name="txtconchk" value="" />
	 <input type="hidden" name="txtptype" value="" />
	 <input type="hidden" name="txtcountrysl" value="" />
	 <input type="hidden" name="txtcountryl" value="" />
	 <input type="hidden" name="sstage" id="sstage" value="" />
	 <input type="hidden" name="date" value="<?php echo date("d-m-Y");?>" />
		
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Recall - Verification</td>
</tr>

 <tr class="Dark" height="30">
<td width="234" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="314"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "SR".$row_tbl['salesr_code']."/".$row_tbl['salesr_yearcode']."/".$row_tbl['salesr_logid'];?></td>

<td width="138" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="274" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<tr class="Dark" height="30">
<td width="234" align="right" valign="middle" class="tblheading">&nbsp;Recall BC Linking Ref. No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['salesr_recallrefno'];?><input type="hidden" name="rbcrefno" value="<?php echo $row_tbl['salesr_recallrefno'];?>" /></td>
</tr>
<tr class="Light" height="30">
<td width="234" align="right" valign="middle" class="tblheading">Party DC Date&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">Party DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcno'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_partytype'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">Reasons for Recall&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_retryp'];?></td>
</tr>
</table>
<div id="selectpartylocation"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{	
$sql_month=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['salesr_state']."' and productionlocationid='".$row_tbl['salesr_loc']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?><table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="234"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_state'];?></td>
	<td width="138"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia['productionlocation'];?></td>
  </tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="234"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="730" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_loc'];?></td>
</tr>
</table>
<?php
}
?>
</div>		   
<div id="selectparty"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$row_tbl['salesr_loc']."' and classification='".$row_tbl['salesr_partytype']."' and p_id='".$row_tbl['salesr_party']."' order by business_name")or die(mysqli_error($link));
}
else
{
$sql_month123=mysqli_query($link,"select * from tblcountry where  country='".$row_tbl['salesr_loc']."'")or die(mysqli_error($link));
$noticia123 = mysqli_fetch_array($sql_month123);
$c=$noticia123['c_id'];
$sql_month=mysqli_query($link,"select * from tbl_partymaser where country='".$c."' and classification='".$row_tbl['salesr_partytype']."' and p_id='".$row_tbl['salesr_party']."' order by business_name")or die(mysqli_error($link));
}
$noticia = mysqli_fetch_array($sql_month);

?>		   
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >   
 <tr class="Light" height="30">
<td width="235"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="729"  colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['business_name'];?></td>
	</tr>

<tr class="Dark" height="30">
<td width="235" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia['address'];?><?php if($noticia['city']!="") { echo ", ".$noticia['city']; }?>, <?php echo $noticia['state'];?></div></td>
</tr>
</table>
</div>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e"  > 

<!--<tr class="Light" height="30">
<td width="234" align="right"  valign="middle" class="tblheading">No. of Packages&nbsp;</td>
<td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcnop'];?></td>

<td width="138" align="right"  valign="middle" class="tblheading">Type of Packages&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_packtyp'];?></td>
</tr>-->
<tr class="Light" height="25">
<td width="234" align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['salesr_tmode'];?></td>
</tr>
</table>

<table id="trans" align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="Transport") echo "block"; else echo "none";?>" > 
<tr class="Light" height="30">
<td align="right" width="234" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_tname'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading" style="border-color:#a8a09e">Lorry Receipt No&nbsp;</td>
<td align="left" width="274" valign="middle" class="tbltext" colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_lrno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="234" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="314" valign="middle" class="tbltext"  style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_pmode'];?>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="Courier") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="234" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="314" valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_cname'];?></td>
<td align="right" width="138" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="274" valign="middle" class="tbltext" colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_docket'];?></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="By Hand") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="234" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Name of Person&nbsp;</td>
<td width="730" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_pname'];?></td>
</tr>

</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" valign="middle" class="tblheading">Packages</td>
  </tr>
<tr class="Light" height="30">
<td width="234" align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="center"  valign="middle" class="tblheading">As per DC</td>
<td align="center"  valign="middle" class="tblheading">Actual Received</td>
<td align="center"  valign="middle" class="tblheading">Excess/Shortage</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Cartons&nbsp;</td>
<td width="314" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_dnop'];?></td>
<td width="138" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1'];?></td>
<td width="274" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1']-$row_tbl['salesr_dnop'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Bags&nbsp;</td>
<td width="314" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_nob'];?></td>
<td width="138" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1'];?></td>
<td width="274" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1']-$row_tbl['salesr_nob'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Total Packages&nbsp;</td>
<td width="314" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_tnop'];?></td>
<td width="138" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1'];?></td>
<td width="274" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1']-$row_tbl['salesr_tnop'];?></td>
</tr>
</table>

<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Pre Verification</td>
</tr>	
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Sales Recall' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$subsubtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="123" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="191" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="114" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="124" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="115" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="202" align="center" valign="middle" class="tblheading">Verify</td>
</tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}
$subtid=$row_tbl_sub['salesrs_id'];
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']!=1){?><a href="Javascript:void(0);" onclick="showverifysc('<?php echo $row_tbl['salesr_recallrefno'];?>','<?php echo $noticia['cropid'];?>','<?php echo $noticia_item['varietyid'];?>','<?php echo $slups;?>','<?php echo $difn;?>','<?php echo $difq;?>','<?php echo $subtid;?>');">Verify</a><?php }else{?>Verified<?php }?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']!=1){?><a href="Javascript:void(0);" onclick="showverifysc('<?php echo $row_tbl['salesr_recallrefno'];?>','<?php echo $noticia['cropid'];?>','<?php echo $noticia_item['varietyid'];?>','<?php echo $slups;?>','<?php echo $difn;?>','<?php echo $difq;?>','<?php echo $subtid;?>');">Verify</a><?php }else{?>Verified<?php }?></td>
</tr>
<?php
}
$srno++;
}
}

?>
</table>
<br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Post Verification</td>
</tr>	
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Sales Recall' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_vflg!=0") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$subsubtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="59" align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
	<td width="90" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	<td width="51" align="center" valign="middle" class="tblheading" rowspan="2">Lot No.</td>
	<td width="52" align="center" valign="middle" class="tblheading" rowspan="2">Barcodes</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">As per DC</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Good</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Damage</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Excess / Shortage</td>
	<!--<td width="36" align="center" valign="middle" class="tblheading" rowspan="2">QCSR</td>-->
	<td width="117" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
	<td width="26" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
	<!--<td width="45" align="center" valign="middle" class="tblheading" rowspan="2">Delete</td>-->
</tr>
<tr class="tblsubtitle" height="20">
	<td width="59" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="36" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="43" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="41" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="42" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="39" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}

$slocs=""; $ltno=""; $brcod=""; $acnop=0; $acnomp=0; $acqty=0; $dnop=0; $dqty=0; $acqty1=0;
$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
{
if($ltno!="")
$ltno=$ltno."<br />".$row_salesvr_subsub['salesrss_lotno'];
else
$ltno=$row_salesvr_subsub['salesrss_lotno'];

if($brcod!="")
$brcod=$brcod."<br />".count(explode(",",$row_salesvr_subsub['salesrss_barcode']));
else
$brcod=count(explode(",",$row_salesvr_subsub['salesrss_barcode']));

$acnop=$acnop+$row_salesvr_subsub['salesrss_nob'];
$acnomp=$acnomp+$row_salesvr_subsub['salesrss_nomp'];
$acqty=$acqty+$row_salesvr_subsub['salesrss_qty'];

$acqty1=$acqty1+$row_salesvr_subsub['salesrss_qty'];

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh.$binn.$subbinn;
if($slocs!="")
$slocs=$slocs."<br/>".$sloc;
else
$slocs=$sloc;
}

$sql_salesvr_subsub2=mysqli_query($link,"select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub2=mysqli_fetch_array($sql_salesvr_subsub2))
{
$dnop=$dnop+$row_salesvr_subsub2['salesrss_nob'];
$dqty=$dqty+$row_salesvr_subsub2['salesrss_qty'];
}

$nob=0; $qty=0; $difnop=0; $difqty=0;
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
$qt=$acqty1+$dqty;
//if($qt==$qty) echo "equal"; else echo "not-equal";
//echo $qty;
$difqty=$qt-$qty;

$difnop=$acnop+$dnop-$nob;
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $brcod;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difqty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext">UT</td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <td width="26" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
   <!-- <td width="45" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $brcod;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difnop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difqty?></td>
	<!--<td align="center" valign="middle" class="smalltbltext">UT</td>-->
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td width="26" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <!--<td width="45" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>-->
</tr>
<?php
}
$srno++;
}
}

?>
</table><br />
<div id="postingsubsubtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15">
<td align="center" class="tblheading"><a href="Javascript:void(0);" onclick="showverifyscnew();">Post New Record</a></td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $pid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="" /><input type="hidden" name="ptp1" value="" /><input type="hidden" name="wtmp" id="wtmp" value="" /><input type="hidden" name="wtnop" id="wtnop" value="" />
</div>
</div>
</div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_recall.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;"  /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  