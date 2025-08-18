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
	
	date_default_timezone_set("Asia/Kolkata");
	
	if(isset($_REQUEST['pid'])) { $pid = $_REQUEST['pid']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{ 
		set_time_limit(120);
		$mainid=trim($_POST['maintrid']);
		$p_id=trim($_POST['maintrid']);
		$txt11=trim($_POST['txt11']);
		$trsbmval=trim($_POST['trsbmval']);
		
		if($trsbmval==0)
		{
			//$sql_main="update tbl_dalloc set dalloc_tflg='1' where dalloc_id='$mainid'";
			//$as=mysqli_query($link,$sql_main) or die(mysqli_error($link));
			echo "<script>window.location='home_dispallocation.php'</script>";		
		}
		else
		{
			echo "<script>window.location='home_dispallocation.php'</script>";	
		}
	}
	
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<script src="search.js"></script>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch Allocation</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script src="dispallocate.js"></script>
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

function pform()
{	
	var fl=0;	
	var olbtn="<img src='../images/post.gif' border='0' style='display:inline;cursor:pointer;' onclick='pform();' />&nbsp;&nbsp;";
	document.getElementById('frmbutn').innerHTML="<img src='../images/processing2.gif' border='0' style='display:inline;cursor:wait;' />&nbsp;&nbsp;";

	var sn=document.frmaddDepartment.sn.value;
	for (var i=1; i<sn; i++)
	{
		var sls="selsh_"+i;
		if(document.getElementById(sls).checked==true)
		{
			var bnop="bnop_"+i;
			var v_1=0;
			var qtyd=0;
			var qtyo=0;
			var qtyb=0;
			var sno1=document.frmaddDepartment.snlo.value;
			//alert(sno1); 
			if(sno1!="")
			{
				for (var k=1; k<=sno1; k++)
				{
					//var inpt="selmmc_"+k;
					
					//if(document.getElementById(inpt).checked==true)
					{ 
						var srno2="srno2_"+k;
						var val=document.getElementById(srno2).value;
						//alert(val);
						if(val!="")
						{	
							var nop=0;
							var nomp=0;
							for(var j=1; j<=val; j++)
							{ 
								var dc="recnolbp"+j+k;
								var rem="recqtyp"+j+k;
								var bal="txtbalqtyp"+j+k;
								var nop="txtbalnobp"+j+k;
								nop=parseInt(nop)+parseInt(document.getElementById(dc).value);
								nomp=parseInt(rem)+parseInt(document.getElementById(rem).value);
								
								if(document.getElementById(rem).value!="")
								{
									v_1++;
								}
									var q=document.getElementById(dc).value;
									var rq=document.getElementById(rem).value;
									var bq=document.getElementById(bal).value;
									
									if(rq=="")rq=0;
									
									var qtyd=parseFloat(qtyd)+parseFloat(rq);
									var qtyb=parseFloat(qtyb)+parseFloat(bq);
							}
							if(nop==0 && nomp==0)
							{
								alert("Please Enter NoLP/Qty to Allocate");
								document.getElementById('frmbutn').innerHTML=olbtn;
								f=1;
								return false;
							}
							/*if(v_1>=val)
							{
								alert("Please Enter NoLP/Qty to Allocate");
								f=1;
								return false;
							}	*/
							//alert(parseFloat(qtyd));
							//alert(parseFloat(document.getElementById(bnop).value));				
							/*if(parseFloat(qtyd) > parseFloat(document.getElementById(bnop).value))
							{
								alert("Please check. Total Quantity to be Allocated not matching with Total MMC Quantity");
								f=1;
								return false;
							}	*/
						}
					}
				}	
			}
			//alert(v_1);
			if(v_1==0)
			{
				alert("Please Enter NoLP/Qty for MMC Allocation");
				document.getElementById('frmbutn').innerHTML=olbtn;
				f=1;
				return false;
			}	
		}
	}

	/*if(document.frmaddDepartment.eseltyp.value=="barsel" && (document.frmaddDepartment.binshifting.value=="no" || document.frmaddDepartment.binshifting.value==""))
	{
		alert("Barcode(s) needs to be scanned and Bin shifting needs to be done");
		return false;
	}
	if(document.frmaddDepartment.binshifting.value=="yes")
	{
		if(parseInt(document.frmaddDepartment.nslval.value)!=parseInt(document.frmaddDepartment.nbarallval.value))
		{
			alert("Please scan the Barcode(s) for Bin shifting");
			return false;
		}
		var sln=document.frmaddDepartment.sln.value;
		for(var j=1; j<sln; j++)
		{ 
			var wh="txtwhg"+j;
			var bin="txtbing"+j;
			var nop="bnnomps_"+j;
			var qtr="bnqtys_"+j;
			
			if(document.getElementById(bin).value="")
			{
				alert("Please select Bin for Bin shifting");
				return false;
			}
		}	
	}*/
	//alert(fl);
	if(fl==1)
	{
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mmcform','','','','','');
	}  
}

function pformedtup()
{	
	var fl=0;
	var olbtn="<img src='../images/update.gif' border='0' style='display:inline;cursor:pointer;' onclick='pformedtup();' />&nbsp;&nbsp;";
	document.getElementById('frmbutn').innerHTML="<img src='../images/processing2.gif' border='0' style='display:inline;cursor:wait;' />&nbsp;&nbsp;";

	var sn=document.frmaddDepartment.sn.value;
	for (var i=1; i<sn; i++)
	{
		var sls="selsh_"+i;
		if(document.getElementById(sls).checked==true)
		{
			var bnop="bnop_"+i;
			var v_1=0;
			var qtyd=0;
			var qtyo=0;
			var qtyb=0;
			var sno1=document.frmaddDepartment.snlo.value;
			//alert(sno1); 
			if(sno1!="")
			{
				for (var k=1; k<sno1; k++)
				{
					//var inpt="selmmc_"+k;
					
					//if(document.getElementById(inpt).checked==true)
					{ 
						var srno2="srno2_"+k;
						var val=document.getElementById(srno2).value;
						//alert(val);
						if(val!="")
						{	
							var nop=0;
							var nomp=0;
							for(var j=1; j<=val; j++)
							{ 
								var dc="recnolbp"+j+k;
								var rem="recqtyp"+j+k;
								var bal="txtbalqtyp"+j+k;
								var nop="txtbalnobp"+j+k;
								nop=parseInt(nop)+parseInt(document.getElementById(dc).value);
								nomp=parseInt(rem)+parseInt(document.getElementById(rem).value);
								
								if(document.getElementById(rem).value!="")
								{
									v_1++;
								}
									var q=document.getElementById(dc).value;
									var rq=document.getElementById(rem).value;
									var bq=document.getElementById(bal).value;
									
									if(rq=="")rq=0;
									
									var qtyd=parseFloat(qtyd)+parseFloat(rq);
									var qtyb=parseFloat(qtyb)+parseFloat(bq);
							}
							if(nop==0 && nomp==0)
							{
								alert("Please Enter NoLP/Qty to Allocate");
								document.getElementById('frmbutn').innerHTML=olbtn;
								f=1;
								return false;
							}
							/*if(v_1>=val)
							{
								alert("Please Enter NoLP/Qty to Allocate");
								f=1;
								return false;
							}	*/
							//alert(parseFloat(qtyd));
							//alert(parseFloat(document.getElementById(bnop).value));				
							/*if(parseFloat(qtyd) > parseFloat(document.getElementById(bnop).value))
							{
								alert("Please check. Total Quantity to be Allocated not matching with Total MMC Quantity");
								f=1;
								return false;
							}	*/
						}
					}
				}	
			}
			//alert(v_1);
			if(v_1==0)
			{
				alert("Please Enter NoLP/Qty for MMC Allocation");
				document.getElementById('frmbutn').innerHTML=olbtn;
				f=1;
				return false;
			}	
		}
	}

	/*if(document.frmaddDepartment.eseltyp.value=="barsel" && (document.frmaddDepartment.binshifting.value=="no" || document.frmaddDepartment.binshifting.value==""))
	{
		alert("Barcode(s) needs to be scanned and Bin shifting needs to be done");
		return false;
	}
	if(document.frmaddDepartment.binshifting.value=="yes")
	{
		if(parseInt(document.frmaddDepartment.nslval.value)!=parseInt(document.frmaddDepartment.nbarallval.value))
		{
			alert("Please scan the Barcode(s) for Bin shifting");
			return false;
		}
		var sln=document.frmaddDepartment.sln.value;
		for(var j=1; j<sln; j++)
		{ 
			var wh="txtwhg"+j;
			var bin="txtbing"+j;
			var nop="bnnomps_"+j;
			var qtr="bnqtys_"+j;
			
			if(document.getElementById(bin).value="")
			{
				alert("Please select Bin for Bin shifting");
				return false;
			}
		}	
	}*/
	//alert(fl);
	if(fl==1)
	{
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mmcformsubedt','','','','');
	}
}

function modetchk(classval)
{
	document.getElementById('barcwise').style.display="none";
	document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="none";
	document.frmaddDepartment.barcode.value="";
	document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	showUser(classval,'vitem','item','','','','','');
	document.frmaddDepartment.txtlot1.value==""
}
	
function vendorchk1()
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
		var trid=document.frmaddDepartment.maintrid.value;
		winHandle=window.open('getuser_rem_lotno.php?crop='+crop+'&variety='+variety+'&trid='+trid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function editrec(edtrecid, trid)
{
	//alert(trid);
	//showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
} 

function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','');
	}
	else
	{
		return false;
	}
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
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
			
		showUser(get,'postingsubtable','get',crop,variety,tid,lotid,'','');
		document.frmaddDepartment.getdetflg.value=1;
	}
}

function openslocpop1()
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot No.");
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

function ltchk()
{
	document.getElementById("postingsubtable").style.display="none";

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
	if(document.frmaddDepartment.txtlot1.value.length<6)
	{
		alert("Lot No cannot be less than 6 digits alphanumaric.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
	{
		alert("Lot No cannot start with Numaric value.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(1)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(2)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(3)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(4)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(5)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
}

function qtychk1(qtyval1, val, snlval)
{
	if(qtyval1!="" && qtyval1 > 0)
	{
		var z1="txtbalnobp"+val+snlval;
		var z2="txtextnob"+val+snlval;
		var z3="recnolbp"+val+snlval;
		var b1="txtbalqtyp"+val+snlval;
		var b2="txtextqty"+val+snlval;
		var b3="recqtyp"+val+snlval;
		if(parseInt(document.getElementById(z3).value) > parseInt(document.getElementById(z2).value))
		{
			alert( "Picked for Allocate NoLP(s) can only be equal or less than Available NoLP(s)");
			document.getElementById(z1).value="";
			document.getElementById(b1).value="";
			document.getElementById(z3).value="";
			document.getElementById(z3).focus();
			return false;
		}
		else
		{
			var qty=0.000;
			var txtnups='txtnups'+snlval;
			var packtp=document.getElementById(txtnups).value.split(" ");
			//alert(packtp[1]);
			if(packtp[1]=="Gms")
			{ 
				var ptp=(parseFloat(packtp[0])/1000);
			}
			else
			{
				var ptp=parseFloat(packtp[0]);
			}
			
			qty=parseFloat(qtyval1)*parseFloat(ptp);
			//alert(qtyval1);alert(ptp);alert(qty);

			document.getElementById(z1).value=parseInt(document.getElementById(z2).value)-parseInt(qtyval1);
			document.getElementById(b3).value=parseFloat(qty);
			document.getElementById(b3).value=parseFloat(document.getElementById(b3).value).toFixed(3);
			document.getElementById(b1).value=parseFloat(document.getElementById(b2).value)-parseFloat(document.getElementById(b3).value);
			document.getElementById(b1).value=parseFloat(document.getElementById(b1).value).toFixed(3);
			if(document.getElementById(b1).value<=0)document.getElementById(b1).value=0;
			//if(document.getElementById(b1).value > 0 && document.getElementById(z1).value<=0)document.getElementById(z1).value=1;
		}
	}
	/*else
	{
		alert( "NoMP can not be Zero");
		document.getElementById(z1).value="";
		document.getElementById(b1).value="";
		document.getElementById(b3).value="";
		document.getElementById(z3).value="";
		document.getElementById(z3).focus();
		return false;
	}*/
}

function Bagschk1(Bagsval1, val, snlval)
{
	if(Bagsval1!="" && Bagsval1 > 0)
	{
		var z1="txtbalnobp"+val+snlval;
		var z2="txtextnob"+val+snlval;
		var z3="recnolbp"+val+snlval;
		var z4="recnolbp"+val+snlval;
		var b1="txtbalqtyp"+val+snlval;
		var b2="txtextqty"+val+snlval;
		var b3="recqtyp"+val+snlval;
		if(parseFloat(document.getElementById(b3).value) > parseFloat(document.getElementById(b2).value))
		{
			alert("Qty picked for Allocate can only be equal or less than Available Qty");
			document.getElementById(z1).value="";
			document.getElementById(b1).value="";
			document.getElementById(b3).value="";
			document.getElementById(b3).focus();
			return false;
		}
		else
		{
			var txtnups='txtnups'+snlval;
			var packtp=document.getElementById(txtnups).value.split(" ");
			
			if(packtp[1]=="Gms")
			{ 
				var ptp=(1000/parseFloat(packtp[0]));
			}
			else
			{
				var ptp=parseFloat(packtp[0]);
			}
			
			var qty=parseFloat(Bagsval1)*parseFloat(ptp);
			
			if(parseInt(document.getElementById(z2).value)==0)qty=0;
			qty1=parseFloat(qty).toFixed(3);
			var xs=qty1.split(".");
			
			if(xs[1]>0)
			{
				alert("Invalid Qty. NoLP cannot be in Decimal value");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(z3).value="";
				document.getElementById(b3).value="";
				document.getElementById(b3).focus();
				return false;
			}
			
			document.getElementById(z1).value=parseInt(document.getElementById(z2).value)-parseInt(qty);
			document.getElementById(z3).value=parseInt(qty);
			
			if(parseInt(document.getElementById(z3).value) > parseInt(document.getElementById(z2).value))
			{
				alert( "Picked for Allocate NoLP(s) can only be equal or less than Available NoLP(s)");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(z3).value="";
				document.getElementById(z3).focus();
				return false;
			}
			
			document.getElementById(b1).value=parseFloat(document.getElementById(b2).value)-parseFloat(document.getElementById(b3).value);
			document.getElementById(b1).value=parseFloat(document.getElementById(b1).value).toFixed(3);
			if(document.getElementById(b1).value<=0)document.getElementById(b1).value=0;
			//if(document.getElementById(b1).value > 0 && document.getElementById(z1).value<=0)document.getElementById(z1).value=1;
		}
	}
	/*else
	{
		alert( "Qty can not be Zero");
		document.getElementById(z1).value="";
		document.getElementById(b1).value="";
		document.getElementById(b3).value="";
		document.getElementById(b3).focus();
		return false;
	}*/
}

function nompchk1(Bagsval1, val)
{
	var z1="txtdisp_"+val;
	var z2="txtrecbagp_"+val;
	var z3="txtdbagp_"+val;
		
	var q1="txtqty_"+val;
	var q2="recqtyp_"+val;
	var q3="txtdqtyp_"+val;
		
	var m1="txtallnomp_"+val;
	var m2="txtrecnomp_"+val;
	var m3="txtdnomp_"+val;
		
	var wtinmp="wtinmp_"+val;
	var pcktyp="upspacktype_"+val;
	
	var qty=0.000;
	var packtp=document.getElementById(pcktyp).value.split(" ");
			
	if(packtp[1]=="Gms")
	{ 
		var ptp=(parseFloat(packtp[0])/1000);
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
	}
	
	if(Bagsval1!="" && Bagsval1 > 0)
	{	
		if(parseInt(document.getElementById(m2).value)>parseInt(document.getElementById(m1).value))
		{
			alert( "NoMP can be either equal or less than Actual NoMP");
			document.getElementById(m2).value="";
			document.getElementById(m3).value="";
			document.getElementById(m2).focus();
			return false;
		}
		else
		{
			if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
			{
				qty=((parseFloat(document.getElementById(m2).value))*(parseFloat(document.getElementById(wtinmp).value)))+((parseFloat(document.getElementById(z2).value))*(parseFloat(ptp)));
			}
			else
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value));
			}
			
			document.getElementById(m3).value=parseInt(document.getElementById(m1).value)-parseInt(document.getElementById(m2).value);
			document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			//if(document.getElementById(z1).value<0)document.getElementById(z1).value=0;
		}
	}
	else
	{
			if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
			{
				qty=(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
				document.getElementById(q2).value=parseFloat(qty);
				document.getElementById(q3).value=parseFloat(qty);
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			}
	}
}

function spmchk()
{
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
	var t=0;
	var haystack=document.frmaddDepartment.extdcno.value.split(",");
	var needle=document.frmaddDepartment.txtdcno.value;
	var count=haystack.length;
	for(var i=0;i<count;i++)
	{
		if(haystack[i]===needle){t++;}
	}
	if(t>0)
	{
		alert("Duplicate Delivary Challan No.");
		document.frmaddDepartment.txtdcno.value="";
		return false;
	}
}

function inArray(needle,haystack)
{
	var count=haystack.length;
	for(var i=0;i<count;i++)
	{
		if(haystack[i]===needle){return true;}
	}
	return false;
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
		//document.frmaddDepartment.rettype.value="";
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtdcno.value.charCodeAt()==32)
	{
		alert("DC Number cannot start with Space");
		document.frmaddDepartment.txtpp.selectedIndex=0;
		document.getElementById('selectpartylocation').style.display="none";
		document.getElementById('selectparty').style.display="none";
		document.frmaddDepartment.txtptype.value="";
		//document.frmaddDepartment.rettype.value="";
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
			/*if(classval=="Dealer" || classval=="Bulk" || classval=="Export Buyer")
			document.frmaddDepartment.rettype.value="Sales Return P to C";	
			else if(classval=="Branch" || classval=="C&F")
			document.frmaddDepartment.rettype.value="Stock Transfer P to C";	
			else
			document.frmaddDepartment.rettype.value="";	*/
		}
		else
		{
			document.getElementById('selectpartylocation').style.display="none";
			document.getElementById('selectparty').style.display="none";
			document.frmaddDepartment.txtptype.value=classval;
			//document.frmaddDepartment.rettype.value="";	
		}
	}	
}	

function modetchk2(varval)
{
	showUser(varval,'upschd','upschdc','Standard','','','','','');
}

function locslchk(statesl)
{
	document.frmaddDepartment.locationname.value="";
	document.getElementById('barcwise').style.display="none";
	document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="none";
	document.frmaddDepartment.barcode.value="";
	document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	showUser(statesl,'locations','location','','','','','','');
}

function stateslchk(valloc)
{
	document.frmaddDepartment.locationname.value="";
	document.getElementById('barcwise').style.display="none";
	document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="none";
	document.frmaddDepartment.barcode.value="";
	document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	if(document.frmaddDepartment.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
		return false;
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
	document.frmaddDepartment.locationname.value="";
	document.getElementById('barcwise').style.display="none";
	document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="none";
	document.frmaddDepartment.barcode.value="";
	document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
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
		return false;
	}
}

function onloadfocus()
{
	//document.frmaddDepartment.txtdcno.focus();
}

function showaddr(prid)
{
	document.getElementById('barcwise').style.display="none";
	document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="block";
	document.frmaddDepartment.barcode.value="";
	document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	showUser(prid,'vaddress','vendor','','','','','');
	//setTimeout(function(){showUser(prid,'ordernos','ordrno','','','','','')},400);
	setTimeout(function(){showUser(prid,'orderdetails','orderdet','','','','','')},400);
}

function showordr(prid)
{
	showUser(prid,'orderdetails','orderdet','','','','','');
}

function chkbarcode1(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod";
	document.getElementById(txtbarcode).value=mltval;
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
	}
	if(flg==0)
	{
		var trid=document.frmaddDepartment.maintrid.value;
		var bardet='';
		var ver='';
		var ups='';
		var mchksel='';
		var upstyp='';
		showUser(bardet,'barchk','barchkmmc',mltval,trid,ver,ups,mchksel,upstyp)
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showpmodemmc('+mltval+')', 1000);
		//showUser(bardet,'orderdetails','ordrbar',mltval,trid,'','','')document.frmaddDepartment.mmcgrwt.focus();
		//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.mmcgrwt.focus();},400);
	}
}

function showpmodemmc(mltval)
{
	var trid=document.frmaddDepartment.maintrid.value;
	var bardet='';
	var ver='';
	var ups='';
	var mchksel='';
	var upstyp='';
	var brflg=document.frmaddDepartment.brflg.value;
	if(document.frmaddDepartment.brchflg.value==0)
	{
		showUser(bardet,'barchk','barchkmmc',mltval,trid,ver,ups,mchksel,upstyp)
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showpmodemmc('+mltval+')', 1000);
	}
	else
	{
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==1)
		{
			alert("Barcode cannot be Allocate.\n\nReason: Barcode already present in System");
			var txtbarcode="txtbarcod";
			document.getElementById(txtbarcode).value='';
			document.getElementById(txtbarcode).focus();
		}
		else
		{
			document.frmaddDepartment.mmcgrwt.focus();
		}	
	}
}
function chkgrwt2()
{
	if(parseFloat(document.frmaddDepartment.mmcgrwt.value)=="")
	{
		alert("Gross Weight cannot be more than 99.999 Kgs.");
		document.frmaddDepartment.mmcgrwt.value="";
		document.frmaddDepartment.mmcgrwt.focus();
		return false;
	}
	/*if(parseFloat(document.frmaddDepartment.mmcgrwt.value)>99.999)
	{
		alert("Gross Weight cannot be more than 99.999 Kgs.");
		document.frmaddDepartment.mmcgrwt.value="";
		document.frmaddDepartment.mmcgrwt.focus();
		return false;
	}	*/
}
function chkgrwt(wtval)
{
	var txtbarcode="txtbarcod";
	if(document.getElementById(txtbarcode).value=='')
	{
		alert("Barcode cannot be blank");
		document.frmaddDepartment.mmcgrwt.value="";
		document.getElementById(txtbarcode).focus();
		return false;
	}
	if(parseFloat(wtval)<parseFloat(document.frmaddDepartment.mmcnetwt.value))
	{
		alert("Gross Weight cannot be less than Net Weight");
		document.frmaddDepartment.mmcgrwt.value="";
		document.frmaddDepartment.mmcgrwt.focus();
		return false;
	}
	
	var np=1;
	var qt=document.frmaddDepartment.mmcnetwt.value;
	var i=document.frmaddDepartment.tsln.value;
	//alert(document.frmaddDepartment.tsln.value);
	var bnnomps="bnnomps_"+i;
	var bnqtys="bnqtys_"+i;
	var nrecqt="nbinqtys_"+i;
	var nrecnob="nbinnomps_"+i;
	//alert(bnnomps);alert(bnqtys);
	np=parseInt(np)+parseInt(document.getElementById(nrecnob).value);
	qt=parseFloat(qt)+parseFloat(document.getElementById(nrecqt).value);
	document.getElementById(bnnomps).value=parseInt(np);
	document.getElementById(bnqtys).value=parseFloat(qt);
	document.getElementById(bnqtys).value=parseFloat(document.getElementById(bnqtys).value).toFixed(3);
}

function pmmcup()
{
	var f=0;
	var olbtn="<img src='../images/update.gif' border='0' style='display:inline;cursor:pointer;' onclick='pmmcup();' />&nbsp;&nbsp;";
	document.getElementById('frmbutn').innerHTML="<img src='../images/processing2.gif' border='0' style='display:inline;cursor:wait;' />&nbsp;&nbsp;";

	var txtbarcode1="txtbarcod";
	var mltval1=document.getElementById(txtbarcode1).value;
	if(mltval1!='')
	{
		var trid=document.frmaddDepartment.maintrid.value;
		var bardet='';
		var ver='';
		var ups='';
		var mchksel='';
		var upstyp='';
		showUser(bardet,'barchk','barchkmmc',mltval,trid,ver,ups,mchksel,upstyp)
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showpmodemmc('+mltval+')', 100);
	}
	var txtbarcode="txtbarcod";
	var mltval=document.getElementById(txtbarcode).value;

	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById('frmbutn').innerHTML=olbtn;
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		f=1;
		return false;
	}
	
	if(document.frmaddDepartment.mmcnetwt.value=="")
	{
		alert("Net Weight cannot be blank");
		document.getElementById('frmbutn').innerHTML=olbtn;
		document.frmaddDepartment.mmcnetwt.value="";
		document.frmaddDepartment.mmcnetwt.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.mmcgrwt.value=="")
	{
		alert("Gross Weight cannot be blank");
		document.getElementById('frmbutn').innerHTML=olbtn;
		document.frmaddDepartment.mmcgrwt.value="";
		document.frmaddDepartment.mmcgrwt.focus();
		f=1;
		return false;
	}
	/*if(parseFloat(document.frmaddDepartment.mmcgrwt.value)>99.999)
	{
		alert("Gross Weight cannot be more than 99.999 Kgs.");
		document.getElementById('frmbutn').innerHTML=olbtn;
		document.frmaddDepartment.mmcgrwt.value="";
		document.frmaddDepartment.mmcgrwt.focus();
		f=1;
		return false;
	}*/
	if(document.frmaddDepartment.mptyp.value=="")
	{
		alert("Please Select MP Type");
		document.frmaddDepartment.mptyp.value="";
		document.getElementById('frmbutn').innerHTML=olbtn;
		document.frmaddDepartment.mptyp.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.binshifting.value=="yes")
	{
		var sln=document.frmaddDepartment.sln.value;
		var s=0;
		for(var j=1; j<sln; j++)
		{ 
			var wh="txtwhg"+j;
			var bin="txtbing"+j;
			var nop="bnnomps_"+j;
			var qtr="bnqtys_"+j;
			
			if(document.getElementById(bin).value==""&& s==0)
			{
				alert("Please select Bin for Bin shifting");
				document.getElementById('frmbutn').innerHTML=olbtn;
				f=1;
				return false;
			}
			if(document.getElementById(bin).value!="")
			{
				s++;
			}
		}	
	}
	
	if(f==1)
	{
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mmcupdate')
		return false;
	}
}
			
function alloctype(typ)
{
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Party First");
		document.getElementById('barcwise').style.display="none";
		document.getElementById('lotnwise').style.display="none";
		document.frmaddDepartment.barcode.value="";
		document.getElementById('lotnwise').innerHTML="";
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else if(document.frmaddDepartment.mchksel.value=="")
	{
		alert("Please Select Line Item in Pending Order(s) IN Progress");
		document.getElementById('barcwise').style.display="none";
		document.getElementById('lotnwise').style.display="none";
		document.frmaddDepartment.barcode.value="";
		document.getElementById('lotnwise').innerHTML="";
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else
	{
		if(typ=="lotwise")
		{
			document.getElementById('barcwise').style.display="none";
			document.getElementById('lotnwise').style.display="block";
			document.frmaddDepartment.barcode.value="";
			document.getElementById('lotnwise').innerHTML="";
			document.frmaddDepartment.allocationtype.value=typ;
			var ordn=document.frmaddDepartment.txtornos.value;
			var ver=document.frmaddDepartment.txtveridno.value;
			var ups=document.frmaddDepartment.txtupsnos.value;
			var qt=document.frmaddDepartment.txteqty.value;
			var party=document.frmaddDepartment.txtstfp.value;
			var trid=document.frmaddDepartment.maintrid.value;
			var sno=document.frmaddDepartment.mchksel.value;
			var txteupstyp=document.frmaddDepartment.txteupstyp.value;
			showUser(party,'lotnwise','ordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp)
		}
		else if(typ=="barcodewise")
		{
			document.getElementById('barcwise').style.display="block";
			document.getElementById('lotnwise').style.display="none";
			document.frmaddDepartment.barcode.value="";
			document.getElementById('lotnwise').innerHTML="";
			document.frmaddDepartment.allocationtype.value=typ;
			var ordn=document.frmaddDepartment.txtornos.value;
			var ver=document.frmaddDepartment.txtveridno.value;
			var ups=document.frmaddDepartment.txtupsnos.value;
			var qt=document.frmaddDepartment.txteqty.value;
			var party=document.frmaddDepartment.txtstfp.value;
			var trid=document.frmaddDepartment.maintrid.value;
			//showUser(party,'orderdetails','ordrbar',sno,ordn,ver,ups,qt,trid,typ)
		}
		else
		{
			document.getElementById('barcwise').style.display="none";
			document.getElementById('lotnwise').style.display="none";
			document.frmaddDepartment.barcode.value="";
			document.getElementById('lotnwise').innerHTML="";
			document.frmaddDepartment.allocationtype.value="";
		}
	}
}

function resetmmc(sno,ver,ups,qt,ordn,upstyp,strid,trid)
{
	//alert(sno);
	document.frmaddDepartment.totlots.value="";
	document.frmaddDepartment.txtornos.value=ordn;
	document.frmaddDepartment.txtveridno.value=ver;
	document.frmaddDepartment.txtupsnos.value=ups;
	document.frmaddDepartment.txteqty.value=qt;
	var party=document.frmaddDepartment.txtstfp.value;
	//var trid=document.frmaddDepartment.maintrid.value;
	//alert(trid);
	//var strid=document.frmaddDepartment.subtrid.value;
	showUser(party,'orderdetails','showordresmmc',sno,ordn,ver,ups,qt,trid,upstyp,strid)
	//document.frmaddDepartment.barcode.focus();
}

function selitm(sno,ver,ups,qt,ordn,upstyp,strid,trid)
{
	//alert(sno);
	document.frmaddDepartment.totlots.value="";
	document.frmaddDepartment.txtornos.value=ordn;
	document.frmaddDepartment.txtveridno.value=ver;
	document.frmaddDepartment.txtupsnos.value=ups;
	document.frmaddDepartment.txteqty.value=qt;
	var party=document.frmaddDepartment.txtstfp.value;
	//var trid=document.frmaddDepartment.maintrid.value;
	//alert(trid);
	//var strid=document.frmaddDepartment.subtrid.value;
	showUser(party,'orderdetails','showordselmmc',sno,ordn,ver,ups,qt,trid,upstyp,strid)
	//document.frmaddDepartment.barcode.focus();
}

function selctmmc(val1,ltn,strid,tid,ups,ver,nomp,qt,ssid)
{
	var sno1=document.frmaddDepartment.sno1.value;
	var totlots=""; 
	var ssids="";
	if(sno1>2)
	{
		for(var i=0; i<document.frmaddDepartment.selmmc.length; i++)
		{
			if(document.frmaddDepartment.selmmc[i].checked==true)
			{
				if(totlots!="")totlots=totlots+','+document.frmaddDepartment.ltno[i].value;
				else totlots=document.frmaddDepartment.ltno[i].value;
				if(ssids!="")ssids=ssids+','+document.frmaddDepartment.ssids.value;
			else ssids=document.frmaddDepartment.ssids.value;
			}
		}
	}
	else
	{
		if(document.frmaddDepartment.selmmc.checked==true)
		{
			if(totlots!="")totlots=totlots+','+document.frmaddDepartment.ltno.value;
			else totlots=document.frmaddDepartment.ltno.value;
			if(ssids!="")ssids=ssids+','+ssid;
			else ssids=ssid;
		}
	}
	
	showUser(val1,'postingsubsubtable','lotshowmmc',totlots,strid,tid,ups,ver,nomp,qt,ssids)
	//showUser(val1,'postingsubsubtable','lotshow',sno1,tidval,val2,val3,sn,subtrid,subsubtrid,val4,upsval,typ);
}

function alcfull(val,snlval)
{
	var allocfull='allocfull'+val+snlval;
	var z1="txtbalnobp"+val+snlval;
	var z2="txtextnob"+val+snlval;
	var z3="recnolbp"+val+snlval;
	var b1="txtbalqtyp"+val+snlval;
	var b2="txtextqty"+val+snlval;
	var b3="recqtyp"+val+snlval;
	
	if(document.getElementById(allocfull).checked==true)
	{
		document.getElementById(z3).value=parseInt(document.getElementById(z2).value);
		document.getElementById(b3).value=parseFloat(document.getElementById(b2).value);
		document.getElementById(b3).value=parseFloat(document.getElementById(b3).value).toFixed(3);
		document.getElementById(b1).value=0;
		document.getElementById(z1).value=0;
	}
	else
	{
		document.getElementById(z3).value="";
		document.getElementById(b3).value="";
		document.getElementById(b1).value="";
		document.getElementById(z1).value="";
	}
}

function chkall(strid,tid,ups,ver,nomp,qt,ssid)
{
	var sno1=document.frmaddDepartment.sno1.value;
	var totlots="";
	var ssids="";
	if(sno1>2)
	{
		for(var i=0; i<document.frmaddDepartment.selmmc.length; i++)
		{
			document.frmaddDepartment.selmmc[i].checked=true;
			if(totlots!="")totlots=totlots+','+document.frmaddDepartment.ltno[i].value;
			else totlots=document.frmaddDepartment.ltno[i].value;
			if(ssids!="")ssids=ssids+','+document.frmaddDepartment.ssids[i].value;
			else ssids=document.frmaddDepartment.ssids[i].value;
		}
	}
	else
	{
		document.frmaddDepartment.selmmc.checked=true;
		if(totlots!="")totlots=totlots+','+document.frmaddDepartment.ltno.value;
		else totlots=document.frmaddDepartment.ltno.value;
		if(ssids!="")ssids=ssids+','+document.frmaddDepartment.ssids.value;
			else ssids=document.frmaddDepartment.ssids.value;
	}
	
	showUser(sno1,'postingsubsubtable','lotshowmmc',totlots,strid,tid,ups,ver,nomp,qt,ssids)
}

function clrall(strid,tid,ups,ver,nomp,qt,ssid)
{
	var sno1=document.frmaddDepartment.sno1.value;
	var totlots="";
	if(sno1>2)
	{
		for(var i=0; i<document.frmaddDepartment.selmmc.length; i++)
		{
			document.frmaddDepartment.selmmc[i].checked=false;
		}
	}
	else
	{
		document.frmaddDepartment.selmmc.checked=false;
	}
	showUser(sno1,'postingsubsubtable','lotshowmmc',totlots,strid,tid,ups,ver,nomp,qt,ssid)
}

function nompchk1(Bagsval1, val)
{
	var z1="txtdisp_"+val;
	var z2="txtrecbagp_"+val;
	var z3="txtdbagp_"+val;
		
	var q1="txtqty_"+val;
	var q2="recqtyp_"+val;
	var q3="txtdqtyp_"+val;
		
	var m1="txtallnomp_"+val;
	var m2="txtrecnomp_"+val;
	var m3="txtdnomp_"+val;
		
	var wtinmp="wtinmp_"+val;
	var pcktyp="upspacktype_"+val;
	
	var qty=0.000;
	var packtp=document.getElementById(pcktyp).value.split(" ");
			
	if(packtp[1]=="Gms")
	{ 
		var ptp=(parseFloat(packtp[0])/1000);
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
	}
	
	if(Bagsval1!="" && Bagsval1 > 0)
	{	
		if(parseInt(document.getElementById(m2).value)>parseInt(document.getElementById(m1).value))
		{
			alert( "NoMP can be either equal or less than Actual NoMP");
			document.getElementById(m2).value="";
			document.getElementById(m3).value="";
			document.getElementById(m2).focus();
			return false;
		}
		else
		{
			if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
			{
				qty=((parseFloat(document.getElementById(m2).value))*(parseFloat(document.getElementById(wtinmp).value)))+((parseFloat(document.getElementById(z2).value))*(parseFloat(ptp)));
			}
			else
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value));
			}
			
			document.getElementById(m3).value=parseInt(document.getElementById(m1).value)-parseInt(document.getElementById(m2).value);
			document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			//if(document.getElementById(z1).value<0)document.getElementById(z1).value=0;
		}
	}
	else
	{
		if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
		{
			qty=(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
		}
	}
}

function nompchk()
{
	var txtornomp=document.frmaddDepartment.txtornomp.value;
	var txtallnomp=document.frmaddDepartment.txtallnomp.value;
	var txtlonomp=document.frmaddDepartment.txtlonomp.value;
	var txttlonomp=document.frmaddDepartment.txttlonomp.value;
	var txtorblnomp=document.frmaddDepartment.txtorblnomp.value;
	if(parseInt(document.frmaddDepartment.txtallnomp.value) > parseInt(document.frmaddDepartment.txtornomp.value))
	{
		alert("NoMP Allocated cannot be more than Ordered NoMP");
		document.frmaddDepartment.txtallnomp.value="";
		document.frmaddDepartment.txtlonomp.value="";
		document.frmaddDepartment.txttlonomp.value="";
		document.frmaddDepartment.txtorblnomp.value="";
		return false;
	}
	else
	{	
		document.frmaddDepartment.txttlonomp.value=parseInt(document.frmaddDepartment.txtornomp.value)-parseInt(document.frmaddDepartment.txtallnomp.value);
		var qty=(parseFloat(document.frmaddDepartment.txtallnomp.value)*parseFloat(document.frmaddDepartment.ewtmp.value));
		document.frmaddDepartment.txtlonomp.value=parseFloat(qty);
		document.frmaddDepartment.txtorblnomp.value=parseFloat(document.frmaddDepartment.txteoqty.value)-parseFloat(qty);
	}
}

function nompchk2()
{
	var txtornomp=document.frmaddDepartment.txtornomp.value;
	var txtallnomp=document.frmaddDepartment.txtallnomp.value;
	var txtlonomp=document.frmaddDepartment.txtlonomp.value;
	var txttlonomp=document.frmaddDepartment.txttlonomp.value;
	var txtorblnomp=document.frmaddDepartment.txtorblnomp.value;
	
	if(parseFloat(document.frmaddDepartment.txtlonomp.value) > parseFloat(document.frmaddDepartment.txteqty.value))
	{
		alert("Qty Allocated cannot be more than Ordered Qty");
		document.frmaddDepartment.txtallnomp.value="";
		document.frmaddDepartment.txtlonomp.value="";
		document.frmaddDepartment.txttlonomp.value="";
		document.frmaddDepartment.txtorblnomp.value="";
		return false;
	}
	else
	{	
		if(document.frmaddDepartment.txteupstyp.value=="ST")
		{
			var	qty=(parseFloat(document.frmaddDepartment.txtlonomp.value)/parseFloat(document.frmaddDepartment.ewtmp.value));
			qty=parseFloat(qty).toFixed(3);
			var packtp=qty.split(" ");
			if(packtp[1]!="000")
			{
				alert("Qty Allocated cannot be more than Ordered Qty");
				document.frmaddDepartment.txtallnomp.value="";
				document.frmaddDepartment.txtlonomp.value="";
				document.frmaddDepartment.txttlonomp.value="";
				document.frmaddDepartment.txtorblnomp.value="";
				return false;
			}
			else
			{
				document.frmaddDepartment.txtallnomp.value=parseFloat(qty);
				document.frmaddDepartment.txtorblnomp.value=parseFloat(document.frmaddDepartment.txteqty.value)-parseFloat(document.frmaddDepartment.txtlonomp.value);
				document.frmaddDepartment.txttlonomp.value=parseInt(document.frmaddDepartment.txtallnomp.value)-parseInt(document.frmaddDepartment.txtlonomp.value);
			}
		}
		else
		{
			document.frmaddDepartment.txtorblnomp.value=parseFloat(document.frmaddDepartment.txteqty.value)-parseFloat(document.frmaddDepartment.txtlonomp.value);
		}
	}
}

function bform()
{
	if(document.frmaddDepartment.subtrid.value=="" || document.frmaddDepartment.subtrid.value==0)
	{
		alert("You have not posted any record for selected Crop/Variety");
		return false;
	}
	else if(parseFloat(document.frmaddDepartment.txttobealqty.value)!=parseFloat(document.frmaddDepartment.txtloqty.value))
	{
		alert("ALERT\n\n'Allocated Qty' of selected item is not equal with 'To be Allocated Qty'.\n Until that matches you will not be allowed to proceed with selection of next item.");
		return false;
	}
	else
	{
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value
		//var txtallnomp=document.frmaddDepartment.txtallnomp.value;
		//var txtpvariety=document.frmaddDepartment.txtpvariety.value;
		
		//alert(trid);alert(subtrid);alert(subsubtrid);
		showUser(subtrid,'postingtable','mbform',trid,subsubtrid,'','','');
	}
}

function barfocus()
{
	if(document.getElementById('txtbarcod').value=="done" || document.getElementById('txtbarcod').value=="")
	{
		document.getElementById('txtbarcod').focus(); 
		document.getElementById('txtbarcod').scrollIntoView();
		document.getElementById('txtbarcod').value="";
	}
}

function editrecsub(lotn, edtrecid, trid, ups, variety)
{
	//alert(lotn);alert(edtrecid);alert(trid);alert(ups);alert(variety);
	showUser(lotn,'postingsubsubtable','subformedt',edtrecid,trid,ups,variety,'');
} 
function editrecsubmmc(val1,ltn,strid,tid,ups,ver,nomp,qt,ssid)
{
	var sno1=document.frmaddDepartment.sno1.value;
	var totlots=ltn; 
	/*if(sno1>2)
	{
		for(var i=0; i<document.frmaddDepartment.selmmc.length; i++)
		{
			document.frmaddDepartment.selmmc[i].checked=true;
			if(totlots!="")totlots=totlots+','+document.frmaddDepartment.ltno[i].value;
			else totlots=document.frmaddDepartment.ltno[i].value;
		}
	}
	else
	{
		if(totlots!="")totlots=totlots+','+document.frmaddDepartment.ltno.value;
		else totlots=document.frmaddDepartment.ltno.value;
	}*/
	
	showUser(val1,'postingsubsubtable','subformedtmmc',totlots,strid,tid,ups,ver,nomp,qt,ssid)
	//showUser(val1,'postingsubsubtable','lotshow',sno1,tidval,val2,val3,sn,subtrid,subsubtrid,val4,upsval,typ);
}
function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','');
	}
	else
	{
		return false;
	}
}

function editrecmain(edtrecid, trid, sn)
{
	//var txtallnomp=document.frmaddDepartment.txtallnomp.value;
	//alert(edtrecid);alert(trid);alert(sn);
	showUser(edtrecid,'postingtable','mainformedt',trid,sn,'','','');
}
function editrecmmc(edtrecid, trid, sn)
{
	showUser(edtrecid,'postingtable','mainformedtmmc',trid,sn,'','','');
}
function backupform()
{
	document.getElementById('barcwise').style.display="none";
	document.getElementById('lotnwise').style.display="none";
	document.frmaddDepartment.barcode.value="";
	document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	var prid=document.frmaddDepartment.txtstfp.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var subsubtrid=document.frmaddDepartment.subsubtrid.value
	var txtallnomp=document.frmaddDepartment.txtallnomp.value;
	
	if(trid>0)
		showUser(subtrid,'postingtable','mbform2',trid,subsubtrid,prid,'','');
	else
		showUser(prid,'orderdetails','orderdet','','','','','');
}

function showpmode(mltval)
{
	var bardet=document.frmaddDepartment.txteordno.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var ver=document.frmaddDepartment.txtevariety.value;
	var ups=document.frmaddDepartment.txteups.value;
	var mchksel=document.frmaddDepartment.mchksel.value;
	var brflg=document.frmaddDepartment.brflg.value;
	if(document.frmaddDepartment.brchflg.value==0)
	{
		showUser(bardet,'barchk','barchk1',mltval,trid,ver,ups,mchksel)
	}
	else
	{
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==0)
		{
			//pform();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
		else
		{
			/*if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==1)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode not present in System");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==2)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Dispatched");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==3)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Loaded in current OR other Operator's Transaction");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==4)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Variety not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==5)
			{
				alert("Barcode cannot be Allocated.\n\nReason: UPS not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==6)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Lot's current QC/GOT Status is FAIL");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==7)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Lot's current QC/GOT Status is UT and Soft Release is not activated");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==8)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==9)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Barcode is already Unpackaged");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==10)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Lot is under Reserve Status");
			}*/
			
		//	pform();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
	}
}

function showmbarcodes(barcodes)
{
	if(barcodes!="")
	{
		winHandle=window.open('getuser_mbarstatus.php?tp='+barcodes,'WelCome','top=170,left=180,width=750,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function showbarcodes(barcodes)
{
	if(barcodes!="")
	{
		winHandle=window.open('getuser_barstatus.php?tp='+barcodes,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function searchlotname(searchval)
{
	var txttblwhg1=document.frmaddDepartment.txttblwhg1.value;
	var bsearch=document.frmaddDepartment.bsearch.value;
	var typ=document.frmaddDepartment.allocationtype.value;
	var ordn=document.frmaddDepartment.txtornos.value;
	var ver=document.frmaddDepartment.txtveridno.value;
	var ups=document.frmaddDepartment.txtupsnos.value;
	var qt=document.frmaddDepartment.txteqty.value;
	var party=document.frmaddDepartment.txtstfp.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var sno=document.frmaddDepartment.mchksel.value;
	var sn=document.frmaddDepartment.sn.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var subsubtrid=document.frmaddDepartment.subsubtrid.value;
	searchUser(searchval,"searchresult","lotserch",txttblwhg1,bsearch,party,sno,ordn,ver,ups,qt,trid,typ,subtrid,subsubtrid,sn);
}

function searchbinname(searchval)
{
	if(document.frmaddDepartment.txttblwhg1.value=="")
	{
		alert("Please Select Warehouse first.");
		document.frmaddDepartment.bsearch.value="";
		return false;
	}
	else
	{
		var txttblwhg1=document.frmaddDepartment.txttblwhg1.value;
		var bsearch=document.frmaddDepartment.lsearch.value;
		var typ=document.frmaddDepartment.allocationtype.value;
		var ordn=document.frmaddDepartment.txtornos.value;
		var ver=document.frmaddDepartment.txtveridno.value;
		var ups=document.frmaddDepartment.txtupsnos.value;
		var qt=document.frmaddDepartment.txteqty.value;
		var party=document.frmaddDepartment.txtstfp.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var sno=document.frmaddDepartment.mchksel.value;
		var sn=document.frmaddDepartment.sn.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value;
		searchUser(searchval,"searchresult","binserch",txttblwhg1,bsearch,party,sno,ordn,ver,ups,qt,trid,typ,subtrid,subsubtrid,sn);
	}
}

function sellot(val1,sno1,val2,val3,sn,val4,upsval,tidval,typ)
{
	/*var bnop="bnop_"+sn;
	var selsh="selsh_"+sn;
	if(document.getElementById(bnop).value==0)
	{
		alert("Balance Qty to be Allocated is ZERO.");
		//document.getElementById(selsh).checked=false;
		return false;
	}
	else*/
	{
		document.frmaddDepartment.ltchksel.value=sno1;
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value;
		showUser(val1,'postingsubsubtable','lotshow',sno1,tidval,val2,val3,sn,subtrid,subsubtrid,val4,upsval,typ);
	}
}

function selnslsts(stsval)
{
	var qt=0;
	var bcval=0;
	document.frmaddDepartment.bcvalues.value="";
	for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var txtbalqtyp="txtbalqtyp"+i;
		var recqtyp="recqtyp"+i;
		var recnobp="recnobp"+i;
		if(document.getElementById(recqtyp).value!="" && document.getElementById(recqtyp).value > 0)
		{
			if(document.getElementById(recnobp).value!="" && document.getElementById(recnobp).value > 0)
			{
				qt++;
				bcval=parseInt(bcval)+parseInt(document.getElementById(recnobp).value);
			}
		}
	}
	if(document.frmaddDepartment.eseltyp.value=="barsel"){bcval=1; qt=1;}
	document.frmaddDepartment.nslval.value=parseInt(bcval);
		//alert(bcval);
	if(stsval=="yes" && qt > 0)
	{
		document.getElementById('shownsloc').style.display="block";
		if(qt > 0)
			document.getElementById('barcupload').innerHTML="<a href=Javascript:void(0); onclick=getbarc()>Scan Barcode(s)</a>";
		else
			document.getElementById('barcupload').innerHTML="";
	}
	else
	{
		for(var i=1; i<document.frmaddDepartment.binshift.length; i++)
		{
			document.frmaddDepartment.binshift[i].checked=true;
		}
		stsval='no';
		if(document.frmaddDepartment.nslval.value==0)
			document.getElementById('shownsloc').style.display="none";
		document.getElementById('barcupload').innerHTML="";
	}
	document.frmaddDepartment.binshifting.value=stsval;
}

function getbarc()
{
	var qt=0;
	var bcval=0;
	document.frmaddDepartment.bcvalues.value="";
	for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var txtbalqtyp="txtbalqtyp"+i;
		var recqtyp="recqtyp"+i;
		var recnobp="recnobp"+i;
		if(document.getElementById(recqtyp).value!="" && document.getElementById(recqtyp).value > 0)
		{
			if(document.getElementById(recnobp).value!="" && document.getElementById(recnobp).value > 0)
			{
				qt++;
				bcval=parseInt(bcval)+parseInt(document.getElementById(recnobp).value);
			}
		}
	}
	if(document.frmaddDepartment.eseltyp.value=="barsel"){bcval=1; qt=1;}
	if(qt > 0 && bcval > 0)
	{
		//alert(bcval);
		var txtolotno=document.frmaddDepartment.txtolotno.value;
		if(document.frmaddDepartment.eseltyp.value=="barsel")
		{txtolotno=txtolotno.replace(/<br ?\/?>/g,",");}
		
		var maintrid=document.frmaddDepartment.maintrid.value;
		var txtnups=document.frmaddDepartment.txtnups.value;
		winHandle=window.open('getuser_prtbaradd.php?tp='+bcval+'&ltno='+txtolotno+'&dtrid='+maintrid+'&eups='+txtnups,'WelCome','top=170,left=180,width=750,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
		return false;
	}	
}

function wh(wh1val, whno)
{ 
	var bingn="bingn"+whno;
	showUser(wh1val,bingn,'wh',bingn,whno,'','','');
}

function bin(bin1val, binno)
{
	var qt=0.000;
	var bcval=0;
	var txtwhg="txtwhg"+binno;
	if(document.getElementById(txtwhg).value=="")
	{
		alert("Please select Warehouse");
		return false;
	}
	else
	{
		if(document.frmaddDepartment.eseltyp.value=="mmcbarsel")
		{
			bcval=1;
			qt=parseFloat(qt)+parseFloat(document.frmaddDepartment.mmcnetwt.value);
		}
		else if(document.frmaddDepartment.eseltyp.value=="barsel")
		{
			bcval=parseInt(bcval)+parseInt(document.getElementById('txtonob').value);
			qt=parseFloat(qt)+parseFloat(document.getElementById('txtoqty').value);
		}
		else
		{
			for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
			{
				var recqtyp="recqtyp"+i;
				var recnobp="recnobp"+i;
				bcval=parseInt(bcval)+parseInt(document.getElementById(recnobp).value);
				qt=parseFloat(qt)+parseFloat(document.getElementById(recqtyp).value);
			}	
		}
		var recqt="bnqtys_"+binno;
		var recnob="bnnomps_"+binno;
		var nrecqt="nbinqtys_"+binno;
		var nrecnob="nbinnomps_"+binno;
		if(document.getElementById(recqt).value!="")
		{
			bcval=parseInt(bcval)+parseInt(document.getElementById(nrecnob).value);
			qt=parseFloat(qt)+parseFloat(document.getElementById(nrecqt).value); 
			//bcval=parseInt(bcval)+parseInt(document.getElementById(recnob).value);
			//qt=parseFloat(qt)+parseFloat(document.getElementById(recqt).value); 
		}
		document.getElementById(recnob).value=parseInt(bcval);
		document.getElementById(recqt).value=parseFloat(qt);
		document.frmaddDepartment.newslocsel.value=bin1val;
	}
}

function addnewsl(nslval)
{
	var nval=nslval-1;
	var nwslocs="nwslocs"+nslval;
	var bnqtys="bnqtys_"+nval;
	if(document.getElementById(bnqtys).value=="")
	{
		alert("Qty not present in previous SLOC");
		return false;
	}
	else
	{
		document.getElementById(nwslocs).style.display="block";
		document.frmaddDepartment.newsloc.value=1;
	}
}

function itmqtychk(itmqtyval)
{
	var eqty=document.getElementById('txteoqty').value;
	var txtornomp=document.getElementById('txtornomp').value;
	
	var loadedqty=document.getElementById('txtloqty').value;
	var alnolp=document.getElementById('txtallonolp').value;
	var alnomp=document.getElementById('txtallnomp').value;
	
	var orbalnomp=document.getElementById('txtorblnomp').value;
	var orbalnolp=document.getElementById('txtorblnolp').value;
	var orbalqty=document.getElementById('txtorblqty').value;
	
	var ewtmp=document.frmaddDepartment.ewtmp.value;
	var txteups=document.getElementById('txteups').value;
	var txteupstyp=document.getElementById('txteupstyp').value;
	
	
	var tnomp=parseFloat(itmqtyval)/parseFloat(ewtmp);
	tnomp=Math.floor(tnomp);
	var bnomp=parseInt(txtornomp)-parseInt(tnomp);
	
	if(parseFloat(itmqtyval) > parseFloat(eqty))
	{
		alert("Qty to be Allocated cannot be more than Ordered Qty");
		document.getElementById('txttobealqty').value=eqty;
		document.getElementById('txtallnomp').value=alnomp;
		document.getElementById('txtallonolp').value=alnolp;
		document.getElementById('txtorblnomp').value=orbalnomp;
		document.getElementById('txtorblnolp').value=orbalnolp;
		document.getElementById('txtorblqty').value=orbalqty;
		return false;
	}
	if(parseFloat(itmqtyval) < parseFloat(loadedqty))
	{
		alert("Qty to be Allocated cannot be less than Allocated Qty.\nYou need to Unallocate the Allocated Qty first then proceed to reduce Qty tobe Allocated");
		document.getElementById('txttobealqty').value=eqty;
		document.getElementById('txtallnomp').value=alnomp;
		document.getElementById('txtallonolp').value=alnolp;
		document.getElementById('txtorblnomp').value=orbalnomp;
		document.getElementById('txtorblnolp').value=orbalnolp;
		document.getElementById('txtorblqty').value=orbalqty;
		return false;
	}
	
	
	var packtp=document.frmaddDepartment.txteups.value.split(" ");
			
	if(packtp[1]=="Gms")
	{ 
		var ptp=(1000/parseFloat(packtp[0]));
		var ptp1=(parseFloat(packtp[0])/1000);
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
		var ptp1=parseFloat(packtp[0]);
	}
	document.getElementById('txtallnomp').value=parseInt(tnomp);
	document.getElementById('txtorblqty').value=parseFloat(eqty)-parseFloat(itmqtyval);
	var qt1=(parseFloat(document.getElementById('txtorblqty').value)/parseFloat(document.frmaddDepartment.ewtmp.value));
	qt1=Math.floor(qt1);
	document.getElementById('txtorblnomp').value=parseInt(qt1);
			
	var qqt=parseFloat(document.frmaddDepartment.ewtmp.value)*parseFloat(document.getElementById('txtallnomp').value);
	var qqt1=parseFloat(document.frmaddDepartment.ewtmp.value)*parseFloat(document.getElementById('txtorblnomp').value);
	if(packtp[1]=="Gms")
	document.getElementById('txtallonolp').value=((parseFloat(itmqtyval)-parseFloat(qqt))*parseFloat(ptp));
	else
	document.getElementById('txtallonolp').value=((parseFloat(itmqtyval)-parseFloat(qqt))/parseFloat(ptp));
	
	var x=document.getElementById('txtallonolp').value.split(".");
	if(parseInt(x[1])>0)
	{
		alert("Qty to be Allocated cannot have fractional UPS.");
		document.getElementById('txttobealqty').value=eqty;
		document.getElementById('txtallnomp').value=alnomp;
		document.getElementById('txtallonolp').value=alnolp;
		document.getElementById('txtorblnomp').value=orbalnomp;
		document.getElementById('txtorblnolp').value=orbalnolp;
		document.getElementById('txtorblqty').value=orbalqty;
		return false;
	}
	if(parseFloat(document.getElementById('txtallonolp').value)<0)
	document.getElementById('txtallonolp').value=0;
	
	document.getElementById('txtorblnolp').value=((parseFloat(document.getElementById('txtorblqty').value)-parseFloat(qqt1))*parseFloat(ptp));
	if(parseFloat(document.getElementById('txtorblnolp').value)<0)
	document.getElementById('txtorblnolp').value=0;
}

function myhome()
{ 
	var fl=0;	
	if(document.frmaddDepartment.maintrid.value!="" || document.frmaddDepartment.maintrid.value>0)
	{
		if(document.frmaddDepartment.subtrid.value!="" && document.frmaddDepartment.subtrid.value>0)
		{
			alert("You are in Loading Process. Click on Next to complete the Loading then click on Back.");
			fl=1;
			return false;
		}
	}		
	if(fl==1)
	{
		return false;
	}
	else
	{
		window.location='home_dispallocation.php';
		return true;
	} 	 
}

function mycancel(sbmval)
{
	if(confirm('Do You wish to Cancel this Transaction?')==true)
	{
		document.frmaddDepartment.trsbmval.value=sbmval;
		document.frmaddDepartment.submit();
		return true;
	}
	else
	{
		return false;
	}
}

function mySubmit(sbmval)
{ 
	//dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	//dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	var fl=0;	
	if(document.frmaddDepartment.maintrid.value=="" || document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not posted any record. Please post record then click on Preview");
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.maintrid.value!="" || document.frmaddDepartment.maintrid.value>0)
	{
		if(document.frmaddDepartment.subtrid.value!="" && document.frmaddDepartment.subtrid.value>0)
		{
			alert("You are in Loading Process. Click on Next to complete the Loading then click on Back.");
			fl=1;
			return false;
		}
	}		
	
	if(fl==1)
	{
		return false;
	}
	else
	{
		document.frmaddDepartment.trsbmval.value=sbmval;
		document.frmaddDepartment.submit();
		return true;
	} 	 
}

function packmmc(trid,subtrid)
{
	//var trid=document.frmaddDepartment.maintrid.value;
	//var subtrid=document.frmaddDepartment.subtrid.value;
	var subsubtrid=document.frmaddDepartment.subsubtrid.value
	showUser(trid,'orderdetails','packmmc',subtrid,subsubtrid,'','','');
}

function printmmcslip(barcval)
{
	var trid=document.frmaddDepartment.maintrid.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	winHandle=window.open('getuser_prtmmcbar.php?tp='+barcval+'&mtrid='+trid+'&strid='+subtrid,'WelCome','top=170,left=180,width=750,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
</script>

<style>
#table-wrapper {
	height:101px;
	width:970px;
	overflow:auto;
	/*overflow-y:scroll;*/  
	margin-top:0px;
}
#table-wrapper table {
	width:942px;
	float:right;
	color:#000;    
}
#table-wrapper table thead tr .text {
	position:fixed;   
	top:0px;  
	height:20px;
	width:35%;
	border:1px solid red;
}
			   
::-webkit-input-placeholder { /* WebKit browsers */
    color:#CCCCCC;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    #CCCCCC;
   opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    #CCCCCC;
   opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
   color:    #CCCCCC;
} 
</style>

<body onLoad="onloadfocus();">

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
        </tr>
        </tr>
</table>
<table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch Allocation - MMC Allocation</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  <?php
$tid=$pid;

	$sql_tbl=mysqli_query($link,"select * from tbl_dalloc where dalloc_id='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);		
	
	$arrival_id=$row_tbl['dalloc_id'];

	$tdate=$row_tbl['dalloc_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate2=$row_tbl['dalloc_dcdate'];
	$tyear=substr($tdate2,0,4);
	$tmonth=substr($tdate2,5,2);
	$tday=substr($tdate2,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;
	
	$code=$row_tbl['dalloc_tcode'];
	
$subtid=0;
$subsubtid=0;
?> 
	  
	  <td align="center" colspan="4" >
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" enctype="multipart/form-data"   > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="txt14" value="" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input type="hidden" name="getdetflg" value="0" />
	<input type="hidden" name="txtconchk" value="" />
	<input type="hidden" name="txtptype" value="" />
	<input type="hidden" name="txtcountrysl" value="" />
	<input type="hidden" name="txtcountryl" value="" />
	<input type="hidden" name="rettype" value=""  />
	<input type="hidden" name="extdcno" value="<?php echo $extdcno?>"  />
	<input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	<input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" /> 
	<input type="hidden" name="trsbmval" value="0" /> 
		
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Allocation - MMC Allocation</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDB".$row_tbl['dalloc_tcode']."/".$row_tbl['dalloc_yearcode']."/".$row_tbl['dalloc_logid'];?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dalloc_partytype']; ?><input type="hidden" class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)" value="<?php echo $row_tbl['dalloc_partytype']; ?>"  /></td>
</tr>
</table>
<div id="selectpartylocation"style="display:<?php if($row_tbl['dalloc_partytype']!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php
if($row_tbl['dalloc_partytype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td width="229"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dalloc_state']; ?><input type="hidden"  class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)" value="<?php echo $row_tbl['dalloc_state']; ?>" /></td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['dalloc_state']."' and productionlocationid='".$row_tbl['dalloc_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
?>	
	<td width="180"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="269" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia3['productionlocation']; ?><input type="hidden" class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)" value="<?php echo $row_tbl['dalloc_location']; ?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dalloc_location']; ?>" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl['dalloc_location']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['country'];?><input type="hidden" class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)" value="<?php echo $row_tbl['dalloc_location'];?>" /></td>
</tr><input type="hidden" name="locationname" value="<?php echo $row_tbl['dalloc_location'];?>" />
<?php
}
?>
</table>
</div>		   
<div id="selectparty"style="display:<?php if($row_tbl['dalloc_partytype']!=""){ echo "block";} else { echo "none"; }?>" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<?php
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_tbl['dalloc_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);
//echo $t=mysqli_num_rows($sql_month24);
?>   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $noticia['business_name'];?><input type="hidden" class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" value="<?php echo $row_tbl['dalloc_party'];?>"  /></td>
	</tr>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['dalloc_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?></div><input type="hidden" name="adddchk" value="" />  </td>
</tr>

</table>
</div>

<br />
<div id="orderdetails" >

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="15" align="center" class="tblheading">MMC Packaging List</td>
</tr>
<?php
	$sq_mmc2=mysqli_query($link,"Select distinct dmmc_barcode from tbl_dallocmmc where dalloc_id='$tid' and dmmc_flg=1") or die(mysqli_error($link));
	$tot_mmc=mysqli_num_rows($sq_mmc2);
	$sq_mmc1=mysqli_query($link,"Select * from tbl_dallocmmc where dalloc_id='$tid' and dmmc_flg=2") or die(mysqli_error($link));
	$tot_mmc1=mysqli_num_rows($sq_mmc1);
	$srmc=0;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcode</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Net Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Gross Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">SLOC</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Lot No.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Status</td>
</tr>
<?php
if($tot_mmc>0)
{
while($row_mmc2=mysqli_fetch_array($sq_mmc2))
{
$mmcbrcd="";$mmcwt="";$mmcgrswt="";$mmccrp="";$mmcver="";$mmcltn="";$mmcup="";$mmcnop="";$mmcqtt="";$mmcsloc="";$mmcsts="";
$sq_mmc=mysqli_query($link,"Select * from tbl_dallocmmc where dalloc_id='$tid' and dmmc_flg=1 and dmmc_barcode='".$row_mmc2['dmmc_barcode']."'") or die(mysqli_error($link));
while($row_mmc=mysqli_fetch_array($sq_mmc))
{
$mmcbrcd=$row_mmc['dmmc_barcode'];
$mmcwt=$row_mmc['dmmc_wtmp'];
$mmcgrswt=$row_mmc['dmmc_grosswt'];

$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where whid='".$row_mmc['dmmc_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);

$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where whid='".$row_mmc['dmmc_wh']."' and binid='".$row_mmc['dmmc_bin']."' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);

$mmcsloc=$noticia_whd1['perticulars']."/".$noticia_bing1['binname'];


$sq2=mysqli_query($link,"Select * from tbl_dalloc_sub where dallocs_id='".$row_mmc['dallocs_id']."' and dalloc_id='".$row_mmc['dalloc_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dallocs_crop'];
else
$mmccrp=$ro2['dallocs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dallocs_variety'];
else
$mmcver=$ro2['dallocs_variety'];

if($mmcltn!="")	
$mmcltn=$mmcltn."<br />".$row_mmc['dmmc_lotno'];
else
$mmcltn=$row_mmc['dmmc_lotno'];

if($mmcup!="")	
$mmcup=$mmcup."<br />".$row_mmc['dmmc_eups'];
else
$mmcup=$row_mmc['dmmc_eups'];

if($mmcnop!="")	
$mmcnop=$mmcnop."<br />".$row_mmc['dmmc_nolp'];
else
$mmcnop=$row_mmc['dmmc_nolp'];

if($mmcqtt!="")	
$mmcqtt=$mmcqtt."<br />".$row_mmc['dmmc_qty'];
else
$mmcqtt=$row_mmc['dmmc_qty'];

$mmcsts="MMC Slip";
}
$srmc++;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $srmc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcbrcd;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcwt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcgrswt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcsloc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmccrp;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcver;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcltn;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcup;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcnop;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcqtt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="printmmcslip('<?php echo $mmcbrcd;?>');"><?php echo $mmcsts;?></a></td>
</tr>
<?php
}
}
?>
<?php
if($tot_mmc1>0)
{
$mmcbrcd="";$mmcwt="";$mmcgrswt="";$mmccrp="";$mmcver="";$mmcltn="";$mmcup="";$mmcnop="";$mmcqtt="";$mmcsloc="";$mmcsts="";
while($row_mmc1=mysqli_fetch_array($sq_mmc1))
{
$mtid=$row_mmc1['dalloc_id'];
$stid=$row_mmc1['dallocs_id'];
$mmcbrcd=$row_mmc1['dmmc_barcode'];
$mmcwt=$row_mmc1['dmmc_wtmp'];
$mmcgrswt=$row_mmc1['dmmc_grosswt'];

$sq2=mysqli_query($link,"Select * from tbl_dalloc_sub where dallocs_id='".$row_mmc1['dallocs_id']."' and dalloc_id='".$row_mmc1['dalloc_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dallocs_crop'];
else
$mmccrp=$ro2['dallocs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dallocs_variety'];
else
$mmcver=$ro2['dallocs_variety'];

if($mmcltn!="")	
$mmcltn=$mmcltn."<br />".$row_mmc1['dmmc_lotno'];
else
$mmcltn=$row_mmc1['dmmc_lotno'];

if($mmcup!="")	
$mmcup=$mmcup."<br />".$row_mmc1['dmmc_eups'];
else
$mmcup=$row_mmc1['dmmc_eups'];

if($mmcnop!="")	
$mmcnop=$mmcnop."<br />".$row_mmc1['dmmc_nolp'];
else
$mmcnop=$row_mmc1['dmmc_nolp'];

if($mmcqtt!="")	
$mmcqtt=$mmcqtt."<br />".$row_mmc1['dmmc_qty'];
else
$mmcqtt=$row_mmc1['dmmc_qty'];


$mmcsloc='';
$mmcsts="Pack MMC";
}
$srmc++;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $srmc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcbrcd;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcwt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcgrswt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcsloc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmccrp;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcver;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcltn;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcup;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcnop;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcqtt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="packmmc('<?php echo $mtid?>','<?php echo $stid?>');"><?php echo $mmcsts;?></a></td>
</tr>
<?php
}
?>
</table>
<br />



<?php

$sqlmonth=mysqli_query($link,"select distinct(orderm_id) from tbl_orderm where orderm_party='".$row_tbl['dalloc_party']."' and orderm_dispatchflag!='1' and orderm_supflag!='1' and orderm_cancelflag!='1' and orderm_tflag=1 order by orderm_id")or die("Error:".mysqli_error($link));
$t=mysqli_num_rows($sqlmonth);

$arrivalid="";
while($rowtbl=mysqli_fetch_array($sqlmonth))
{
	/*$sql_month=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$rowtbl['orderm_id']."'")or die("Error:".mysqli_error($link));
	while($row_month=mysqli_fetch_array($sql_month))
	{*/
		if($arrivalid!="")
		$arrivalid=$arrivalid.",".$rowtbl['orderm_id'];
		else
		$arrivalid=$rowtbl['orderm_id'];
	//}
}
//echo $arrivalid;

$ver=""; $cpr="";
if($arrivalid!="")
{
	$sql_ver1=mysqli_query($link,"select distinct order_sub_crop from tbl_order_sub where orderm_id in($arrivalid) order by order_sub_crop") or die(mysqli_error($link));
	$totver1=mysqli_num_rows($sql_ver1);
	while($row_ver1=mysqli_fetch_array($sql_ver1))
	{
		if($cpr!="")
			$cpr=$cpr.",".$row_ver1['order_sub_crop'];
		else
			$cpr=$row_ver1['order_sub_crop'];
	}
	
	$cp="";
	$sq_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid IN ($cpr) order by cropname Asc") or die(mysqli_error($link));
	while($ro_crp=mysqli_fetch_array($sq_crp))
	{
		if($cp!="")
			$cp=$cp.",".$ro_crp['cropid'];
		else
			$cp=$ro_crp['cropid'];
	}
	
	$arid=explode(",",$cp);
	foreach($arid as $atrid)
	{
		if($atrid<>"")
		{
			$ver1="";
			$sql_ver2=mysqli_query($link,"select distinct order_sub_variety from tbl_order_sub where orderm_id in($arrivalid) and order_sub_crop='$atrid' order by order_sub_variety") or die(mysqli_error($link));
			$totver2=mysqli_num_rows($sql_ver2);
			while($row_ver2=mysqli_fetch_array($sql_ver2))
			{
				if($ver1!="")
					$ver1=$ver1.",".$row_ver2['order_sub_variety'];
				else
					$ver1=$row_ver2['order_sub_variety'];
			}
			$vp="";
			$sq_vrp=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid IN ($ver1) and actstatus='Active' order by popularname Asc") or die(mysqli_error($link));
			while($ro_vrp=mysqli_fetch_array($sq_vrp))
			{
				if($vp!="")
					$vp=$vp.",".$ro_vrp['varietyid'];
				else
					$vp=$ro_vrp['varietyid'];
			}
			if($ver!="")
				$ver=$ver.",".$vp;
			else
				$ver=$vp;
			
		}
	}
}

?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="15" align="center" class="tblheading">Pending Order(s) in Progress - MMC Packaging List</td>
</tr>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS Type</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Order No</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoMP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcodes</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Allocated</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Gross Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty Balance</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty MMC</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Select</td>
</tr>
<?php 
$sn=1; $sn24=0; $sid=0; $dflg=0; $ordnos=""; $veridno=""; $upsnos=""; $totbarcs="";
if($arrivalid!="")
{
if($ver!="")
{
$verid=explode(",",$ver);
foreach($verid as $verrid)
{
if($verrid<>"")
{
$orsid="";
$sqlson=mysqli_query($link,"select * from tbl_order_sub where order_sub_variety='".$verrid."' and orderm_id in($arrivalid) order by order_sub_variety")or die("Error:".mysqli_error($link));
$totsz=mysqli_num_rows($sqlson);
while($rowtsub=mysqli_fetch_array($sqlson))
{
if($orsid!="")
$orsid=$orsid.",".$rowtsub['order_sub_id'];
else
$orsid=$rowtsub['order_sub_id'];
}
//echo $orsid."<br/>";
$sqlsloc=mysqli_query($link,"select distinct order_sub_sub_ups from tbl_order_sub_sub where orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_subbal_qty>0 order by order_sub_sub_ups ASC") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc);
while($rowsloc=mysqli_fetch_array($sqlsloc))
{ //echo $orsid."  =  ".$rowsloc['order_sub_sub_ups']."<br/>";
$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";$crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $nord=0; $ordno="";
$sqlsloc2=mysqli_query($link,"select * from tbl_order_sub_sub where orderm_id in($arrivalid) and order_sub_id IN ($orsid) and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' and order_sub_subbal_qty>0 order by order_sub_sub_ups") or die(mysqli_error($link));
$totvs=mysqli_num_rows($sqlsloc2);
while($rowsloc2=mysqli_fetch_array($sqlsloc2))
{ 	//echo $verrid."  -  ".$rowsloc['order_sub_sub_ups']."  =  ".$rowsloc2['order_sub_id']."<br/>";
$sqlmon=mysqli_query($link,"select * from tbl_order_sub where order_sub_variety='".$verrid."' and orderm_id in($arrivalid) and order_sub_id='".$rowsloc2['order_sub_id']."' and order_sub_totbal_qty>0 order by order_sub_id")or die("Error:".mysqli_error($link));
$totz=mysqli_num_rows($sqlmon);
while($rowtblsub=mysqli_fetch_array($sqlmon))
{

		

		$sql_m=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$rowtblsub['orderm_id']."' and orderm_tflag=1")or die("Error:".mysqli_error($link));
		if($tot=mysqli_num_rows($sql_m) > 0)
		{
			while($row_m=mysqli_fetch_array($sql_m))
			{
				if($ordno!="")
				$ordno=$ordno.",".$row_m['orderm_porderno'];
				else
				$ordno=$row_m['orderm_porderno'];
				$nord++;
			}
		}
		$orxd=explode(",",$ordno);
		$tid240=array_keys(array_flip($orxd));
		$ordno=implode(",",$tid240);
		
		if($reptyp1=="hold")
	    {	
			if($rowtblsub['order_sub_hold_flag']!=0)
				$statussub=$rowtblsub['order_sub_hold_type'];	
		}
		else
		{
			$statussub="";
		}


		$variet=$row_dept4['popularname'];
		$upstyp=$rowtblsub['order_sub_ups_type'];
		if($upstyp=="Yes")$upstyp="ST";
		if($upstyp=="No")$upstyp="NST";
		
		/*if($crop!="")
		{
		$crop=$crop."<br>".$rowtblsub['order_sub_crop'];
		// $rowtblsub['lotcrop'];
		}
		else
		{*/
		$crop=$rowtblsub['order_sub_crop'];
		//}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		/*if($variety!="")
		{
		$variety=$variety."<br>".$rowtblsub['order_sub_variety'];
		}
		else
		{*/
		$variety=$rowtblsub['order_sub_variety'];	
		//}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		/*if($lotno!="")
		{
			$lotno=$lotno."<br>".$rowtblsub['lotno'];
		}
		else
		{
			$lotno=$rowtblsub['lotno'];
		}
		if($bags!="")
		{
			$bags=$bags."<br>".$acn;
		}
		else
		{
			$bags=$acn;
		}
		if($qty!="")
		{
			$qty=$qty."<br>".$ac;
		}
		else
		{
			$qty=$ac;
		}
		if($qc!="")
		{
			$qc=$qc."<br>".$rowtblsub['qc'];
		}
		else
		{
			$qc=$rowtblsub['qc'];
		}
		if($got!="")
		{
			$got=$got."<br>".$rowtblsub['got'];
		}
		else
		{
			$got=$rowtblsub['got'];
		}
		if($stage!="")
		{
			$stage=$stage."<br>".$rowtblsub['order_sub_totbal_qty'];
		}
		else
		{
			$stage=$rowtblsub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
			$per=$per."<br>".$rowtblsub['pper'];
		}
		else
		{
			$per=$rowtblsub['pper'];
		}*/
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where orderm_id in($arrivalid) and order_sub_id='".$rowtblsub['order_sub_id']."' and order_sub_sub_ups='".$rowsloc['order_sub_sub_ups']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	$xfd=count($dq);
	if($upstyp=="NST")
	{
		//$dq[1]="000";
		//if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
		//if($dq[1]==000){$qt12=$dq[0];}else{$qt12=$dq[0].".".$dq[1];}
		if($xfd>1)$qt1=$dq[0].".".$dq[1]; else $qt1=$dq[0].".000";
	}
	else
	{
		if($dq[1]==000){$qt1=$dq[0].".".$dq[1];}else{$qt1=$dq[0].".".$dq[1];}
	}
	$up1=$qt1." ".$zz[1];
	
	/*if($up!="")
		$up=$up.$up1."<br/>";
	else*/
		$up=$up1;

	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}
	
	/*if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else*/
	$qt=$qt+$qt1;
	/*if($sstatus!="")
	{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
	}
	else
	{*/
		$sstatus=$sstatus+$row_sloc['order_sub_sub_nop'];
	//}
	 //$rowtblsub['arrsub_id'];
}
}
}
//}
if($ordnos!="")
{
	$ordnos=$ordnos.",".$ordno;
}
else
{
	$ordnos=$ordno;
}

if($veridno!="")
{
	$veridno=$veridno.",".$variety;
}
else
{
	$veridno=$variety;
}
if($upsnos!="")
{
	$upsnos=$upsnos.",".$up1;
}
else
{
	$upsnos=$up1;
}
if($qt > 0)	 
{

$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='$cro'"); 
$row_dept5=mysqli_fetch_array($quer5);
$cp=$row_dept5['cropid'];
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='$variet' and actstatus='Active'"); 
$row_dept4=mysqli_fetch_array($quer4);
$vt=$row_dept4['varietyid'];		

if($subtid!=0)
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where dallocs_crop='$cro' and dallocs_variety='$variet' and dallocs_id='$subtid' and dallocs_alflg!=1 and dalloc_id='$tid' and dallocs_upstype='$upstyp' and dallocs_ups='$up1'") or die(mysqli_error($link));
else
$sq=mysqli_query($link,"Select * from tbl_dalloc_sub where dallocs_crop='$cro' and dallocs_variety='$variet' and dallocs_alflg!=1 and dalloc_id='$tid' and dallocs_upstype='$upstyp' and dallocs_ups='$up1'") or die(mysqli_error($link));
$nups=""; $nnob=0; $nqty=0; $nbqty=$qt;  $dbsflg=0; $nolots=0; $nobarcs=""; $grswt=0; $tor=0; $mcflg=0; $nnolp=0;

if($to=mysqli_num_rows($sq) > 0)
{
	$ro=mysqli_fetch_array($sq);
	$nups=$ro['dallocs_ups']; 
	$nnob=$ro['dallocs_nob']; 
	$nqty=$ro['dallocs_qty']; 
	//$nbqty=$ro['dallocs_bqty'];
	//$nbqty=$qt-$nqty;
	$nbqty=round($qt,3)-round($nqty,3);
	if($nbqty<=0)$nbqty=0;
	$norno=$ro['dallocs_ordno'];
	$nnomp=$ro['dallocs_nomp']; 
	$nnolp=$ro['dallocs_nop']; 
	
	$crpnm=$cp; 
	$vernm=$vt;
	$sid=$ro['dallocs_id'];
	$sn24=$sn;
	$dbsflg=$ro['dallocs_alflg'];
	$tor=1;
	
	$sq23=mysqli_query($link,"Select distinct dallocss3_barcode from tbl_dallocsub_sub3 where dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
	$totre=mysqli_num_rows($sq23);
	while($row23=mysqli_fetch_array($sq23))
	{
		$nolots++;
		if($nobarcs!="")
		$nobarcs=$nobarcs.",".$row23['dallocss3_barcode'];
		else
		$nobarcs=$row23['dallocss3_barcode'];
		
		$grswt=$grswt+$row23['dallocss3_grossweight'];
	}


	$mmcqty=0;
	$sq3=mysqli_query($link,"Select * from tbl_dallocsub_sub where dallocs_id='$sid' and dalloc_id='$tid' and dallocss_altype='lotwise' and dallocss_nolp>0") or die(mysqli_error($link));
	$totre3=mysqli_num_rows($sq3);
	while($row3=mysqli_fetch_array($sq3))
	{ //echo $row3['dallocss_id'];
		$xc=explode(" ",$row3['dallocss_ups']);
		if($xc[1]=="Gms")
		{
			$ptp=$xc[0]/1000;
		}
		else
		{
			$ptp=$xc[0];
		}
		$qts=$ptp*$row3['dallocss_nolp'];
		$mmcqty=$mmcqty+$qts;
	}
	//echo $mmcqty;
if($grswt==0)$grswt="";
if(($nnomp==0 && $nqty>0)||$mmcqty>0){$mmcflg++; }
if($mmcqty<0)$mmcqty=0;
if($mmcqty>0)
{ 
$totmmc1=0;
$sqmmc1=mysqli_query($link,"Select * from tbl_dallocmmc where dalloc_id='$tid' and dallocs_id='$sid' and dmmc_flg=2") or die(mysqli_error($link));
$totmmc1=mysqli_num_rows($sqmmc1);
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="tblheading"><?php echo $sn;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $cro?><input type="hidden" name="ecrop<?php echo $sn;?>" id="ecrop_<?php echo $sn;?>" value="<?php echo $cro;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $variet?><input type="hidden" name="evariety<?php echo $sn;?>" id="evariety_<?php echo $sn;?>" value="<?php echo $variet;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $upstyp?><input type="hidden" name="eupstyp<?php echo $sn;?>" id="eupstyp_<?php echo $sn;?>" value="<?php echo $upstyp;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $up1?><input type="hidden" name="eups<?php echo $sn;?>" id="eups_<?php echo $sn;?>" value="<?php echo $up1;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $sstatus;?><input type="hidden" name="enop<?php echo $sn;?>" id="enop_<?php echo $sn;?>" value="<?php echo $sstatus;?>" /></td>

	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $qt;?><input type="hidden" name="eqty<?php echo $sn;?>" id="eqty_<?php echo $sn;?>" value="<?php echo $qt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext" title="<?php echo $norno ?>"><?php echo $norno;?><input type="hidden" name="eordno<?php echo $sn;?>" id="eordno_<?php echo $sn;?>" value="<?php echo $norno;?>" /><input type="hidden" name="enoordno<?php echo $sn;?>" id="enoordno_<?php echo $sn;?>" value="<?php echo $nord;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnomp;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnomp;?>" /></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php if($nolots>0){?><a href="Javascript:void(0);" onclick="showmbarcodes('<?php echo $nobarcs;?>','<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')"><?php echo $nolots;?></a><?php } ?><input type="hidden" name="txtnolots" id="txtnolots" value="<?php echo $nolots;?>" /></td>
	<!--<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nnob;?><input type="hidden" name="rnob<?php echo $sn;?>" id="rnob_<?php echo $sn;?>" value="<?php echo $nnob;?>" /></td>-->
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nqty;?><input type="hidden" name="rqty<?php echo $sn;?>" id="rqty_<?php echo $sn;?>" value="<?php echo $nqty;?>" /></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $grswt;?><input type="hidden" name="grswt<?php echo $sn;?>" id="grswt_<?php echo $sn;?>" value="<?php echo $grswt;?>" /></td>
	<td width="275" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $nbqty;?><input type="hidden" name="bnop<?php echo $sn;?>" id="bnop_<?php echo $sn;?>" value="<?php echo $nbqty;?>" /></td>
	
	<td width="275" align="center"  valign="middle" class="tbltext"><?php echo $mmcqty;?></td>
	<td width="275" align="center"  valign="middle" class="tbltext"><?php if($totmmc1>0){?><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="editrecmmc('<?php echo $sid;?>','<?php echo $tid?>','<?php echo $sn;?>')" /><input type="hidden" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $vt?>','<?php echo $up1?>','<?php echo $mmcqty?>','<?php echo $ordno ?>','<?php echo $upstyp?>','<?php echo $sid?>','<?php echo $tid?>')" value="<?php echo $sn;?>"  /><?php } else { ?><input type="radio" name="selsh<?php echo $sn;?>" id="selsh_<?php echo $sn;?>" onclick="selitm('<?php echo $sn;?>','<?php echo $vt?>','<?php echo $up1?>','<?php echo $mmcqty?>','<?php echo $ordno ?>','<?php echo $upstyp?>','<?php echo $sid?>','<?php echo $tid?>')" value="<?php echo $sn;?>"  /><?php } ?></td>
</tr>
<?php
$sn++;
}
}
}
}
}
}
}
}
//}
//}
?>
<input type="hidden" name="sn" value="<?php echo $sn;?>" /><input type="hidden" name="mchksel" value="<?php echo $sn24?>" />
<input type="hidden" name="txtornos" value="" /><input type="hidden" name="txtveridno" value="" /><input type="hidden" name="txtupsnos" value="" /><input type="hidden" name="txteqty" value="" /><input type="hidden" name="totbarcs" value="<?php echo $totbarcs;?>" /><input type="hidden" name="totlots" value="" />
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="newsloc" value="" />
</div>	
<div id="bardetails" ></div>
<br />
<!--<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Allocation Type</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Allocation type&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext"><input type="radio" name="allctyp" class="tbltext" value="lotwise" onClick="alloctype(this.value);" />&nbsp;Pick to Allocate&nbsp;&nbsp;<input type="radio" name="allctyp" class="tbltext" value="barcodewise" onClick="alloctype(this.value);" />&nbsp;Scan to Allocate&nbsp;<font color="#FF0000" >*</font>&nbsp;<input type="hidden" name="allocationtype" value="" /></td></tr>
</table><br />
<div id="barcwise" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Enter Barcode</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>

</table><br />-->
<div id="barupdetails" ></div>
</div>
<div id="lotnwise" style="display:none"></div>
<div id="shownsloc" style="display:none">

</div>
<br />
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0" style="display:inline;cursor:Pointer;" onClick="return myhome();"  />&nbsp;&nbsp;<img src="../images/finalsubmit.gif" border="0"style="display:inline;cursor:Pointer;" onClick="return mySubmit('0');" /></td>
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
