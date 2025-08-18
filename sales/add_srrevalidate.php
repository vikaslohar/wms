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
		$pid=trim($_POST['txtitem']);
		$date=trim($_POST['date']);
		$tcode=trim($_POST['tcode']);
		$sstage=trim($_POST['sstage']);
		$crop=trim($_POST['crop']);
		$variety=trim($_POST['variety']);
		$lotno=trim($_POST['lotno']);
		$orlot=trim($_POST['orlot']);
		$upssize=trim($_POST['upssize']);
		$enop=trim($_POST['enop']);
		$eqty=trim($_POST['eqty']);
		$qcsts=trim($_POST['qcsts']);
		$dot=trim($_POST['dot']);
		$got=trim($_POST['got']);
		$go=explode(" ",$got);
		$got1=$go[1];
		$dogt=trim($_POST['dogt']);
		$txtpsrno=trim($_POST['txtpsrno']);
		$dcdate=trim($_POST['dcdate']);
		$txtnopqc=trim($_POST['txtnopqc']);
		$txtbnop=trim($_POST['txtbnop']);
		$txtbqty=trim($_POST['txtbqty']);
		$validityperiod=trim($_POST['validityperiod']);
		$validityupto=trim($_POST['validityupto']);
		$valdays=trim($_POST['valdays']);
		$domcs_1=trim($_POST['domcs_1']);
		$lbls_1=trim($_POST['lbls_1']);
		$domce_1=trim($_POST['domce_1']);
		$lble_1=trim($_POST['lble_1']);
		$slable=$domcs_1.$lbls_1;
		$elable=$domce_1.$lble_1;
		$lablerange=$slable."-".$elable;
		
		$ddate1=explode("-",$date);
		$date=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
			
		$edate1=explode("-",$dot);
		$dot=$edate1[2]."-".$edate1[1]."-".$edate1[0];
		
		$edate12=explode("-",$dogt);
		$dogt=$edate12[2]."-".$edate12[1]."-".$edate12[0];
		
		$edate2=explode("-",$dcdate);
		$dcdate=$edate2[2]."-".$edate2[1]."-".$edate2[0];
		
		$edate2=explode("-",$validityupto);
		$validityupto=$edate2[2]."-".$edate2[1]."-".$edate2[0];
		
		$sql_sub="insert into tbl_srrevalidate (srrv_date, srrv_crop, srrv_variety, srrv_lotno, srrv_ups, srrv_enop, srrv_eqty, srrv_qc, srrv_dot, srrv_got, srrv_got1, srrv_dogt, srrv_rvpsrn, srrv_dorvp, srrv_qcnop, srrv_bnop, srrv_bqty, srrv_valperiod, srrv_valupto, srrv_valdays, srrv_slable, srrv_elable, srrv_tcode, srrv_logid, srrv_yearcode, srrv_pid, plantcode) values('$date', '$crop', '$variety', '$lotno', '$upssize', '$enop', '$eqty', '$qcsts', '$dot', '$got', '$got1', '$dogt', '$txtpsrno', '$dcdate', '$txtnopqc', '$txtbnop', '$txtbqty', '$validityperiod', '$validityupto', '$valdays', '$slable', '$elable', '$tcode', '$logid', '$yearid_id', '$pid', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=mysqli_insert_id($link);
			for($j=1; $j<=8; $j++)
			{
				$txtwhgx="txtslwhg".$j;
				$txtbingx="txtslbing".$j;
				$txtsubbgx="txtslsubbg".$j;
				$txtslBagsgx="txtslBagsg".$j;
				$txtslqtygx="txtslqtyg".$j;
				$txtslwhg= trim($_POST[$txtwhgx]); 
				$txtslbing= trim($_POST[$txtbingx]);
				$txtslsubbg= trim($_POST[$txtsubbgx]);
				$existview= trim($_POST[$existviewx]);
				$txtslBagsg= trim($_POST[$txtslBagsgx]);
				$txtslqtyg= trim($_POST[$txtslqtygx]);
				if($txtslqtyg!="" || $txtslqtyg > 0)
				{
					$sql_sub_sub="insert into tbl_srrevalidate_sub (srrv_id, srrvs_whid, srrvs_binid, srrvs_sbinid, srrvs_nop, srrvs_qty, plantcode) values('$subid', '$txtslwhg', '$txtslbing', '$txtslsubbg', '$txtslBagsg', '$txtslqtyg', '$plantcode')";
					mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				}
			}
		}		
		//exit;
		echo "<script>window.location='add_srrevalidate_preview.php?p_id=$subid&sid=$pid'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return -Transaction - Sales Return - Re-Validate</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

</head>
<script src="srrv.js"></script>
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

function psrnchk(qval)
{
	dt1=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.date.value,"-");
	dt3=getDateObject(document.frmaddDepartment.dot.value,"-");
	
	if(document.frmaddDepartment.txtpsrno.value=="")
	{
		alert("Re-Validation/Packing Slip Reference number cannot be blank");
		document.frmaddDepartment.txtpsrno.focus();
		return false;
	}
	if(dt1<dt3)
	{
		alert("Date of Re-Validation/Packing cannot be prior to Date of Test");
		return false;
	}
	if(dt1>dt2)
	{
		alert("Date of Re-Validation/Packing cannot be later than transaction Date");
		return false;
	}
	
	if(parseInt(qval) > 0)
	{
		var bnop=parseInt(document.frmaddDepartment.enop.value)-parseInt(qval);
		document.frmaddDepartment.txtbnop.value=parseInt(bnop);
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(parseFloat(ups[0])/1000);
		}
		else
		{
			pt=ups[0];
		}
		document.frmaddDepartment.txtbqty.value=Math.round((parseFloat(bnop)*parseFloat(pt))*1000)/1000;
	}
	else
	{
		document.frmaddDepartment.txtbnop.value=parseInt(document.frmaddDepartment.enop.value);
		document.frmaddDepartment.txtbqty.value=Math.round((parseFloat(document.frmaddDepartment.eqty.value))*1000)/1000;
	}
}

function chkvalidity(valval)
{
	if(document.frmaddDepartment.txtpsrno.value=="")
	{
		alert("Enter Re-Validation/Packing Slip Reference number");
		document.frmaddDepartment.txtpsrno.focus();
		return false;
	}
	else if(parseInt(document.frmaddDepartment.txtnopqc.value) < 0)
	{
		alert("NoP for QC Sample cannot be less than ZERO(0)");
		document.frmaddDepartment.txtnopqc.focus();
		return false;
	}
	else
	{
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
					var ddiff=dateDiff(document.frmaddDepartment.dcdate.value, document.frmaddDepartment.dp1.value);
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
					var ddiff=dateDiff(document.frmaddDepartment.dcdate.value, document.frmaddDepartment.dp2.value);
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
					var ddiff=dateDiff(document.frmaddDepartment.dcdate.value, document.frmaddDepartment.dp3.value);
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
	}
}


function domcchk(val1, val2)
{
	var x="domce_"+val2;
	//var nopc="nopc_"+val2;
	var domcs="domcs_"+val2;
	if(document.frmaddDepartment.txtbnop.value=="" || document.frmaddDepartment.txtbnop.value==0)
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
	else if(parseInt(document.getElementById(tx).value)<parseInt(document.getElementById(x).value))
	{
		alert("Please enter valid Label number");
		document.getElementById(tx).focus();
		return false;
	}
	else
	{
		//var z="nopc_"+dval;
		var xx="lble_"+dval;
		if(parseInt(document.frmaddDepartment.txtbnop.value)>1 && (parseInt(lbval)-parseInt(document.getElementById(x).value))>0)
		{
			if(parseInt(lbval)-parseInt(document.getElementById(x).value)<parseInt(document.frmaddDepartment.txtbnop.value))
			{
				alert("Total Label nos. are not matching with No. of Pouches");
				document.getElementById(xx).value="";
				return false;
			}
		}
	}
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

function mySubmit()
{ 
	var fl=0;	
	dt1=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.date.value,"-");
	dt3=getDateObject(document.frmaddDepartment.dot.value,"-");
	
	if(document.frmaddDepartment.txtpsrno.value=="")
	{
		alert("Re-Validation/Packing Slip Reference number cannot be blank");
		fl=1;
		return false;
	}
	if(dt1<dt3)
	{
		alert("Date of Re-Validation/Packing cannot be prior to Date of Test");
		fl=1;
		return false;
	}
	if(dt1>dt2)
	{
		alert("Date of Re-Validation/Packing cannot be later than transaction Date");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.txtnopqc.value) < 0)
	{
		alert("NoP for QC Sample cannot be less than ZERO(0)");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.txtbnop.value) <= 0)
	{
		alert("Balance Pouches cannot be ZERO(0)");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.valdays.value=="")
	{
		alert("Please Select Validity Period");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.valdays.value) <= 0)
	{
		alert("Validity Days cannot be ZERO(0)");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.domcs_1.value=="")
	{
		alert("Please select Label No.");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.lbls_1.value) <= 0)
	{
		alert("Label No. cannot be ZERO(0)");
		fl=1;
		return false;
	}
	if(parseInt(document.frmaddDepartment.lble_1.value) <= 0)
	{
		alert("Label No. cannot be ZERO(0)");
		fl=1;
		return false;
	}
	
	var g="";
	var q1="";
	var q2="";
	var q3="";
	var q4="";
	var q5="";
	var q6="";
	var q7="";
	var q8="";
	g=document.frmaddDepartment.txtbqty.value;
	if(g=="")g=0;
	if(parseFloat(g) > 0)
	{
		q1=document.frmaddDepartment.txtslqtyg1.value;
		q2=document.frmaddDepartment.txtslqtyg2.value;
		q3=document.frmaddDepartment.txtslqtyg3.value;
		q4=document.frmaddDepartment.txtslqtyg4.value;
		q5=document.frmaddDepartment.txtslqtyg5.value;
		q6=document.frmaddDepartment.txtslqtyg6.value;
		q7=document.frmaddDepartment.txtslqtyg7.value;
		q8=document.frmaddDepartment.txtslqtyg8.value;
	}
	if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;if(q4=="")q4=0;if(q5=="")q5=0;if(q6=="")q6=0;if(q7=="")q7=0;if(q8=="")q8=0;
	
	var qtyg=parseFloat(q1)+parseFloat(q2)+parseFloat(q3)+parseFloat(q4)+parseFloat(q5)+parseFloat(q6)+parseFloat(q7)+parseFloat(q8);
	
	if(parseFloat(g)!=parseFloat(qtyg))
	{
		alert("Please check. Balance Quantity is not matching with Quantity distributed in Bins");
		return false;
		f=1;
	}
	
	if(fl==1)
	{
		return false;
	}
	else
	{
		return true;	 
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
	var itemv=document.frmaddDepartment.variety.value;
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
		var slocnogood=document.frmaddDepartment.sstage.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var Bagsv1=document.frmaddDepartment.txtsrtyp.value;
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
	var txtslqtyg="txtslqtyg"+bagno;
	if(document.getElementsByName(txtslsubbg)[0].value=="")
	{
		alert("Please select Sub Bin");
		document.getElementsByName(txtslsubbg)[0].focus();
		document.getElementsByName(txtslBagsg)[0].value="";
		return false;
	}
	if(document.getElementsByName(txtslBagsg)[0].value!="")
	{
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(parseFloat(ups[0])/1000);
		}
		else
		{
			pt=ups[0];
		}
		document.getElementsByName(txtslqtyg)[0].value=Math.round((parseFloat(Bags1val)*parseFloat(pt))*1000)/1000;
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
		var ups=document.frmaddDepartment.upssize.value.split(" ");
		var pt="";
		if(ups[1]=="Gms")
		{
			pt=(1000/parseFloat(ups[0]));
			document.getElementsByName(txtslBagsg)[0].value=parseFloat(qty1val)*parseInt(pt);
		}
		else
		{
			pt=ups[0];
			document.getElementsByName(txtslBagsg)[0].value=parseFloat(qty1val)/parseInt(pt);
		}
		var x=document.getElementsByName(txtslBagsg)[0].value.split(".");
		if(parseInt(x[1]) > 0)
		{
			alert("Invalid NoP");
			document.getElementsByName(txtslBagsg)[0].value="";
			return false;
		}
	}
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
          <td width="100%" valign="top" align="center"><img src="../images/sales_curvetop.gif" /></td>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Sales Return - Pack Seed Re-Validate</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['salesrs_id'];

	$tdate=date("d-m-Y");
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['salesrs_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);

	$sql_code="SELECT MAX(srrv_tcode) FROM tbl_srrevalidate where plantcode='$plantcode' AND srrv_yearcode='$yearid_id'  ORDER BY srrv_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1="TRV".$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1="TRV".$code."/".$yearid_id."/".$lgnid;
	}	
	
?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="sstage" value="Pack" />
	<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
	<input type="hidden" name="date" value="<?php echo $tdate?>" />
	<input type="hidden" name="tcode" value="<?php echo $code;?>" />
	<input type="hidden" name="maintrid" value="0" />
	<input type="hidden" name="txtsrtyp" value="" />
	</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return - Pack Seed Re-Validate</td>
</tr>

 <tr class="Dark" height="30">
<td width="213" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="267"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?></td>

<td width="229" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="251" align="left" valign="middle" class="tbltext">&nbsp;<?php echo date("d-m-Y");?></td>
</tr>

<tr class="Light" height="30">
<td width="213" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['cropname'];?><input type="hidden" name="crop" value="<?php echo $row_tbl['salesrs_crop'];?>" /></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" name="variety" value="<?php echo $row_tbl['salesrs_variety'];?>" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesrs_newlot'];?><input type="hidden" name="lotno" value="<?php echo $row_tbl['salesrs_newlot'];?>" /></td>
<td width="229" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="251" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesrs_ups'];?><input type="hidden" name="upssize" value="<?php echo $row_tbl['salesrs_ups'];?>" /></td>
</tr>
<?php

$sql_arrival=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$tid."'") or die(mysqli_error($link));
$row_arrival=mysqli_fetch_array($sql_arrival);

$dot="";
if($row_arrival['salesrs_dot']!="")
{
$dt=explode("-",$row_arrival['salesrs_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
$dgt=explode("-",$row_arrival['salesrs_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];
$got=$row_arrival['salesrs_got']." ".$row_arrival['salesrs_got1'];
$qc=$row_arrival['salesrs_qc'];
//echo $row_arrival['salesrs_typ'];

$nop="";$qty="";$ewh="";$ebin="";$esbin="";
//if($row_arrival['salesrs_typ']=="verrec")
//{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		$ewh=$row1['salesrss_wh'];
		$ebin=$row1['salesrss_bin'];
		$esbin=$row1['salesrss_subbin'];
	}
	/*else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		$ewh=$row_arrival['salesrs_wh'];
		$ebin=$row_arrival['salesrs_bin'];
		$esbin=$row_arrival['salesrs_subbin'];
	}
}*/
else if($row_arrival['salesrs_typ']=="vernew")
{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		$ewh=$row1['salesrss_wh'];
		$ebin=$row1['salesrss_bin'];
		$esbin=$row1['salesrss_subbin'];
	}
	else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		$ewh=$row_arrival['salesrs_wh'];
		$ebin=$row_arrival['salesrs_bin'];
		$esbin=$row_arrival['salesrs_subbin'];
	}
}
else
{
	$nop=$row_arrival['salesrs_nobdc'];
	$qty=$row_arrival['salesrs_qtydc'];
	$ewh=$row_arrival['salesrs_wh'];
	$ebin=$row_arrival['salesrs_bin'];
	$esbin=$row_arrival['salesrs_subbin'];
}

if($dot!="")
{
	$trdate2=explode("-",$dot);
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

?>
<tr class="Light" height="30" >
<td align="right" width="213"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="267" valign="middle" class="tbltext">&nbsp;<?php echo $nop;?><input type="hidden" name="enop" value="<?php echo $nop;?>" /></td>	
<td align="right" width="229" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="251" valign="middle" class="tbltext">&nbsp;<?php echo $qty;?><input type="hidden" name="eqty" value="<?php echo $qty;?>" /></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $qc;?><input type="hidden" name="qcsts" value="<?php echo $qc;?>" /></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dot;?><input type="hidden" name="dot" value="<?php echo $dot;?>" /><input type="hidden" name="dp1" value="<?php echo $dp1;?>" /><input type="hidden" name="dp2" value="<?php echo $dp2;?>" /><input type="hidden" name="dp3" value="<?php echo $dp3;?>" /></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $got;?><input type="hidden" name="got" value="<?php echo $got;?>" /></td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dogt;?><input type="hidden" name="dogt" value="<?php echo $dogt;?>" /></td>
<input type="hidden" name="orlot" value="<?php echo $row_arrival['salesrs_orlot'];?>" />
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Re-Validation Details</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Re-Validate/Packing Slip Ref. No.&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="txtpsrno" id="txtpsrtno" class="smalltbltext" value="" size="15"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td align="right" valign="middle" class="tblheading" colspan="3">Date of Re-Validation/Packing&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading" id="pltno">&nbsp;<input name="dcdate" id="dcdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a>&nbsp;<font color="#FF0000" >* </font>&nbsp;<script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> </td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">NoP for QC Sample&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="txtnopqc" id="txtnopqc" class="smalltbltext" value="0" size="2" onchange="psrnchk(this.value);" onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="107" align="right" valign="middle" class="tblheading">Balance Pouches&nbsp;</td>
<td width="108" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="txtbnop" id="txtbnop" class="smalltbltext" value="<?php echo $nop;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="right" valign="middle" class="tblheading">Balance Quantity&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading" id="pltno">&nbsp;<input type="text" name="txtbqty" id="txtbqty" class="smalltbltext" value="<?php echo $qty;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="Light" height="25">
<td width="191" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<select name="validityperiod" id="validityperiod" class="tbltext" style="size:50px" onchange="chkvalidity(this.value)">
<option value="" selected="selected">Select</option>
<option value="9" >9</option>
<option value="6" >6</option>
<option value="3" >3</option>
</select>&nbsp;Months&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="107" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="108" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" class="tbltext" name="validityupto" id="validityupto" value="" size="12" readonly="true" style="background-color:#ECECEC"  /></td>
<td width="112" align="right" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<input type="text" name="valdays" id="valdays" size="4" class="tblheading" value="" readonly="true" style="background-color:#ECECEC; color:#FF0000" />&nbsp;From DoT</td>
</tr>
<tr class="Light" height="25">  
<td align="right" valign="middle" class="tblheading">Label No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="6"><?php $quer3=mysqli_query($link,"SELECT dom_mcode FROM tbl_rm_dommac where plantcode='$plantcode' order by dom_mcode Asc"); $sno=1; ?>&nbsp;<select class="smalltbltext" name="domcs_<?php echo $sno?>" id="domcs_<?php echo $sno?>" style="width:40px;" onchange="domcchk(this.value, '<?php echo $sno?>')"> <option value="" selected>Select</option> <?php while($noticia = mysqli_fetch_array($quer3)) { ?> <option value="<?php echo $noticia['dom_mcode'];?>" /><?php echo $noticia['dom_mcode'];?><?php } ?></select>&nbsp;<font color="#FF0000" >* </font>&nbsp;<input type="text" name="lbls_<?php echo $sno?>" id="lbls_<?php echo $sno?>" size="5" maxlength="7" class="tbltext" value="" onkeypress="return isNumberKey(event)" onchange="domchk('<?php echo $sno?>');"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;&nbsp;<input type="text" name="domce_<?php echo $sno?>" id="domce_<?php echo $sno?>" class="tbltext" size="1" maxlength="1" readonly="true" style="background-color:#CCCCCC" value="" />&nbsp;<input type="text" name="lble_<?php echo $sno?>" id="lble_<?php echo $sno?>" size="5"  maxlength="7" class="tbltext" value=""  onkeypress="return isNumberKey(event)" onchange="domchk1(this.value, '<?php echo $sno?>')" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<!--<tr class="Light" height="25">
<td width="103" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="154" align="left" valign="middle" class="tbltext"></td>
<td width="81" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="368" align="left" valign="middle" class="tbltext"> &nbsp;&nbsp;<b>Validity Days</b> </td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Entire</td>
<td width="125" align="center" valign="middle" class="tblheading">Pack Partial</td>
</tr>-->
<input type="hidden" name="pcktype" id="pcktype" value="" />
</table><br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="5">SLOC Details</td>
</tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="340" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="294" rowspan="2" align="center" valign="middle" class="tblheading">Pack Seed</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh(this.value,1);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin(this.value,1);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin(this.value,1);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,1);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,1);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
<?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh(this.value,2);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin(this.value,2);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin(this.value,2);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,2);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,2);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>




<?php
$whg3_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh(this.value,3);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg3 = mysqli_fetch_array($whg3_query)) { ?>
          <option value="<?php echo $noticia_whg3['whid'];?>" />  
          <?php echo $noticia_whg3['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin(this.value,3);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:80px;" onchange="subbin(this.value,3);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow3">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg3" id="Bags3" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,3);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,3);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid3" value="0" />
  </tr>
  <?php
$whg4_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg4" style="width:70px;" onchange="wh(this.value,4);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg4 = mysqli_fetch_array($whg4_query)) { ?>
          <option value="<?php echo $noticia_whg4['whid'];?>" />  
          <?php echo $noticia_whg4['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing4">&nbsp;<select class="tbltext" name="txtslbing4" style="width:60px;" onchange="bin(this.value,4);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing4">&nbsp;<select class="tbltext" name="txtslsubbg4" style="width:80px;" onchange="subbin(this.value,4);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow4">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg4" id="Bags4" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,4);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg4" id="qty4" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,4);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid4" value="0" />
  </tr>
  <?php
$whg5_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg5" style="width:70px;" onchange="wh(this.value,5);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg5 = mysqli_fetch_array($whg5_query)) { ?>
          <option value="<?php echo $noticia_whg5['whid'];?>" />  
          <?php echo $noticia_whg5['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing5">&nbsp;<select class="tbltext" name="txtslbing5" style="width:60px;" onchange="bin(this.value,5);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing5">&nbsp;<select class="tbltext" name="txtslsubbg5" style="width:80px;" onchange="subbin(this.value,5);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow5">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg5" id="Bags5" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,5);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg5" id="qty5" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,5);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid5" value="0" />
  </tr>
  <?php
$whg6_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg6" style="width:70px;" onchange="wh(this.value,6);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg6 = mysqli_fetch_array($whg6_query)) { ?>
          <option value="<?php echo $noticia_whg6['whid'];?>" />  
          <?php echo $noticia_whg6['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing6">&nbsp;<select class="tbltext" name="txtslbing6" style="width:60px;" onchange="bin(this.value,6);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing6">&nbsp;<select class="tbltext" name="txtslsubbg6" style="width:80px;" onchange="subbin(this.value,6);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow6">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg6" id="Bags6" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,6);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg6" id="qty6" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,6);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid6" value="0" />
  </tr>
  <?php
$whg7_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg7" style="width:70px;" onchange="wh(this.value,7);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg7 = mysqli_fetch_array($whg7_query)) { ?>
          <option value="<?php echo $noticia_whg7['whid'];?>" />  
          <?php echo $noticia_whg7['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing7">&nbsp;<select class="tbltext" name="txtslbing7" style="width:60px;" onchange="bin(this.value,7);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing7">&nbsp;<select class="tbltext" name="txtslsubbg7" style="width:80px;" onchange="subbin(this.value,7);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow7">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg7" id="Bags7" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,7);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg7" id="qty7" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,7);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid7" value="0" />
  </tr>
  <?php
$whg8_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg8" style="width:70px;" onchange="wh(this.value,8);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg8 = mysqli_fetch_array($whg8_query)) { ?>
          <option value="<?php echo $noticia_whg8['whid'];?>" />  
          <?php echo $noticia_whg8['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing8">&nbsp;<select class="tbltext" name="txtslbing8" style="width:60px;" onchange="bin(this.value,8);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing8">&nbsp;<select class="tbltext" name="txtslsubbg8" style="width:80px;" onchange="subbin(this.value,8);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow8">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
        <tr>
		<td width="340"  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoP&nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg8" id="Bags8" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" onchange="Bagsf(this.value,8);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty&nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg8" id="qty8" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey1(event)" onchange="qtyf(this.value,8);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid8" value="0" />
  </tr>
</table>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_srrevalidate.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="verflg" value="<?php echo $verflg;?>" /></td>
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

  