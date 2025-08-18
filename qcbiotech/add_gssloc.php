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
		$txt11=trim($_POST['txt11']);
		$txt123="";
		$txtcrop="";
		$txtvariety="";
		$txtwhm="";
		$txtbinm="";
		$txtwhn="";
		$txtbinn="";
		$flagcode="";
		$code1="";
	    $code2="";

		if($txt11=="select")
		{
			$txtcrop=trim($_POST['txtcrop']);
			$txtvariety=trim($_POST['txtvariety']);
			$flagcode=trim($_POST['flagcode']);
			$code1=trim($_POST['code1']);
		    $code2=trim($_POST['code2']);
		}
		else
		{
			$txt123=trim($_POST['txt123']);
			if($txt123=="ycode")
			{
				$txtwhm=trim($_POST['txtslwhg']);
				$txtbinm=trim($_POST['txtslbing']);
				$flagcode=trim($_POST['flagcode']);
				$code1=trim($_POST['code1']);
			    $code2=trim($_POST['code2']);
			}
			else 
			{
				$txtwhm=trim($_POST['txtslwhg']);
				$txtbinm=trim($_POST['txtslbing']);
				$txtwhn=trim($_POST['txtslwhg222']);
				$txtbinn=trim($_POST['txtslbing222']);
			}
		}
		
		echo "<script>window.location='add_sloc_preview.php?txt11=$txt11&txt123=$txt123&txtcrop=$txtcrop&txtvariety=$txtvariety&txtwhm=$txtwhm&txtbinm=$txtbinm&txtwhn=$txtwhn&txtbinn=$txtbinn&flagcode=$flagcode&code1=$code1&code2=$code2'</script>";
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction -QC Result Update </title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="gs.js"></script>
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
/**/
			

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	
function modetchk(classval)
{
	//alert(classval);
	showUser(classval,'vitem','item','','','','','');
	document.getElementById('vitem2').style.display="none";
	document.getElementById('vitem2').innerHTML ="";
	//document.frmaddDepartment.txtlot1.value==""
	}
function modetchk1(val)
{
//alert(document.frmaddDepartment.txtcrop.value);
			document.getElementById('vitem2').style.display="block";
			var crop=document.frmaddDepartment.txtcrop.value;
			var variety=document.frmaddDepartment.txtvariety.value;
			showUser(crop,'vitem2','item2',variety,val,'','','');
		
		}
	
function chk2(va2 ,val2)
{
if(document.frmaddDepartment.txt11.value=="select")
{
document.getElementById("binwisep").innerHTML="";
document.getElementById("binwisec").innerHTML="";
}
else if(document.frmaddDepartment.txt11.value=="lotno" && document.frmaddDepartment.txt123.value=="ycode")
{
document.getElementById("vitem2").innerHTML="";
document.getElementById("binwisec").innerHTML="";
}
else if(document.frmaddDepartment.txt11.value=="lotno" && document.frmaddDepartment.txt123.value=="pcode")
{
document.getElementById("vitem2").innerHTML="";
document.getElementById("binwisep").innerHTML="";
}
else
{
document.getElementById("vitem2").innerHTML="";
document.getElementById("binwisep").innerHTML="";
document.getElementById("binwisec").innerHTML="";
}
if(document.getElementById('fetchk_'+[va2]).checked==true)
{
document.getElementById('rn1_'+[va2]).disabled=false;
document.getElementById('rn2_'+[va2]).disabled=false;
document.getElementById('rn1_'+[va2]).selectedIndex=0;
document.getElementById('rn2_'+[va2]).selectedIndex=0;
}
else
{
document.getElementById('rn1_'+[va2]).disabled=true;
document.getElementById('rn2_'+[va2]).disabled=true;
document.getElementById('rn1_'+[va2]).selectedIndex=0;
document.getElementById('rn2_'+[va2]).selectedIndex=0;
}
}
/*else
{
document.frmaddDepartment.txtslwhg1.SelectedIndex=0;
document.frmaddDepartment.txtslbing1.SelectedIndex=0;
document.frmaddDepartment.txtslwhg1.disabled=true;
document.frmaddDepartment.txtslbing1.disabled=true;
document.frmaddDepartment.txtslwhg1.style.backgroundColor="#cccccc";
document.frmaddDepartment.txtslbing1.style.backgroundColor="#cccccc";
}
*/
function typchk1(opt1)
{
document.frmaddDepartment.txt123.value="";
document.frmaddDepartment.txt123.value=opt1;
document.frmaddDepartment.txtslwhg.selectedIndex=0;
document.frmaddDepartment.txtslbing.selectedIndex=0;
document.getElementById('binwisep').style.display="none";
document.getElementById('binwisec').style.display="none";
}

function typchk(opt)
{
document.frmaddDepartment.txt123.value="";
document.frmaddDepartment.txt11.value="";
document.frmaddDepartment.txt11.value=opt;
		if(opt!="")
	{
		if(opt=="select")
		{
			document.getElementById('trans').style.display="block";
			document.frmaddDepartment.txtcrop.selectedIndex=0;
			document.frmaddDepartment.txtvariety.selectedIndex=0;
			document.getElementById('courier').style.display="none";
			document.getElementById('vitem2').style.display="none";
			document.getElementById('binwisep').style.display="none";
			document.getElementById('binwisec').style.display="none";
		}
		else if(opt=="lotno")
		{
		//alert("lotno");
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			var radList = document.getElementsByName('reptyp1');
			for (var i = 0; i < radList.length; i++) {
			if(radList[i].checked) radList[i].checked = false;}
			document.frmaddDepartment.txtslwhg.selectedIndex=0;
			document.frmaddDepartment.txtslbing.selectedIndex=0;
			document.getElementById('vitem2').style.display="none";	
			document.getElementById('binwisep').style.display="none";
			document.getElementById('binwisec').style.display="none";				
		}	
		
	}
}
function wh1(wh1val,srno)
{ 
	var b='bing_'+srno;
		showUser(wh1val,b,'wh',srno,'','','','');
		
}
function wh2(wh1val)
{ 
	var b='bing222';
		showUser(wh1val,b,'wh2','','','','','');
}
function wh(wh1val)
{ 
	if(document.frmaddDepartment.txt123.value=="")
	{
	alert("Please select Type");
	document.frmaddDepartment.txtslwhg.selectedIndex=0;
	document.frmaddDepartment.txtslbing.selectedIndex=0;
	return false;
	}
	else
	{
		var b='bing';
		showUser(wh1val,b,'wh1','','','','','');
	}	
}

function bin2(bin2val)
{
var wh=document.frmaddDepartment.txtslwhg.value;
var type=document.frmaddDepartment.txt123.value;
document.getElementById('binwisep').style.display="none";
document.getElementById('binwisec').style.display="none";
if(type!="")
{
	if(type=="ycode")
	{
		document.getElementById('binwisep').style.display="block";
		document.getElementById('binwisec').style.display="none";
		showUser(bin2val,'binwisep','binwp',wh,'','','','');
	}
	else
	{
		document.getElementById('binwisep').style.display="none";
		document.getElementById('binwisec').style.display="block";
		showUser(bin2val,'binwisec','binwc',wh,'','','','');
	}
}
}
function binl(bin1val)
{

var a=document.getElementById('rn1_'+[bin1val]).value;
var b=document.getElementById('rn2_'+[bin1val]).value;
var c=document.getElementById('a'+[bin1val]).value;
var d=document.getElementById('b'+[bin1val]).value;

if(a==c && b==d)
{
alert("Cannot transfer the Lot Guard Sample into same bin");
document.getElementById('rn1_'+[bin1val]).selectedIndex=0;
document.getElementById('rn2_'+[bin1val]).selectedIndex=0;
return false;
}
}

function bin3(bin1val)
{
var a=document.frmaddDepartment.txtslwhg222.value;
var b=document.frmaddDepartment.txtslbing222.value;
var c=document.frmaddDepartment.txtslwhg.value;
var d=document.frmaddDepartment.txtslbing.value;
if(a==c && b==d)
{
alert("Cannot transfer the Guard Sample Lot(s) into same bin");
document.frmaddDepartment.txtslwhg222.selectedIndex=0;
document.frmaddDepartment.txtslbing222.selectedIndex=0;
return false;
}
}
	
function mySubmit()
{	
if(document.frmaddDepartment.txt11.value=="select")
{
document.getElementById("binwisep").innerHTML="";
document.getElementById("binwisec").innerHTML="";
}
else if(document.frmaddDepartment.txt11.value=="lotno" && document.frmaddDepartment.txt123.value=="ycode")
{
document.getElementById("vitem2").innerHTML="";
document.getElementById("binwisec").innerHTML="";
}
else if(document.frmaddDepartment.txt11.value=="lotno" && document.frmaddDepartment.txt123.value=="pcode")
{
document.getElementById("vitem2").innerHTML="";
document.getElementById("binwisep").innerHTML="";
}
else
{
document.getElementById("vitem2").innerHTML="";
document.getElementById("binwisep").innerHTML="";
document.getElementById("binwisec").innerHTML="";
}
document.frmaddDepartment.flagcode.value="";
var maintyp=document.frmaddDepartment.txt11.value;
if(maintyp=="")
{
	alert("Please Select Updation type");
	return false;
}
else
{

if(maintyp=="select")
{
	var	val1=document.frmaddDepartment.txtcrop.value;
	var	val2=document.frmaddDepartment.txtvariety.value;
	if(val1=="")
	{
		alert("Please Select Crop");
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Variety");
		return false;
	}
	
	
	var cnt1=0;cnt2=0;
	if(document.frmaddDepartment.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDepartment.txtlotno.length; i++) 
		{          
				 
			if(document.frmaddDepartment.txtlotno[i].checked == true)
			{
				if(document.frmaddDepartment.flagcode.value =="")
				{
					document.frmaddDepartment.flagcode.value=document.frmaddDepartment.txtlotno[i].value;
				}
				else
				{
					document.frmaddDepartment.flagcode.value = document.frmaddDepartment.flagcode.value +','+document.frmaddDepartment.txtlotno[i].value;
				}
						
				if(document.frmaddDepartment.txtslwhg1[i].value=="")cnt1++;
						
				if(document.frmaddDepartment.code1.value =="")
				{
					document.frmaddDepartment.code1.value=document.frmaddDepartment.txtslwhg1[i].value;
				}
				else
				{
					document.frmaddDepartment.code1.value = document.frmaddDepartment.code1.value +','+document.frmaddDepartment.txtslwhg1[i].value;
				}
				
				if(document.frmaddDepartment.txtslbing1[i].value=="")cnt2++;
						
				if(document.frmaddDepartment.code2.value =="")
				{
					document.frmaddDepartment.code2.value=document.frmaddDepartment.txtslbing1[i].value;
				}
				else
				{
					document.frmaddDepartment.code2.value = document.frmaddDepartment.code2.value +','+document.frmaddDepartment.txtslbing1[i].value;
				}
					
				
			}
		}
	}
	else
	{
		if(document.frmaddDepartment.txtlotno.checked == true)
		{
			if(document.frmaddDepartment.flagcode.value =="")
			{
				document.frmaddDepartment.flagcode.value=document.frmaddDepartment.txtlotno.value;
			}
			else
			{
				document.frmaddDepartment.flagcode.value = document.frmaddDepartment.flagcode.value +','+document.frmaddDepartment.txtlotno.value;
			}
					
			if(document.frmaddDepartment.txtslwhg1.value=="")cnt1++;
					
			if(document.frmaddDepartment.code1.value =="")
			{
				document.frmaddDepartment.code1.value=document.frmaddDepartment.txtslwhg1.value;
			}
			else
			{
				document.frmaddDepartment.code1.value = document.frmaddDepartment.code1.value +','+document.frmaddDepartment.txtslwhg1.value;
			}
				
			if(document.frmaddDepartment.txtslbing1.value=="")cnt2++;
						
			if(document.frmaddDepartment.code2.value =="")
			{
				document.frmaddDepartment.code2.value=document.frmaddDepartment.txtslbing1.value;
			}
			else
			{
				document.frmaddDepartment.code2.value = document.frmaddDepartment.code2.value +','+document.frmaddDepartment.txtslbing1.value;
			}
					
				
		}
	}	
	//alert(cnt1);alert(cnt2);alert(cnt3);alert(cnt4);alert(cnt5);
	if(cnt1 > 0)
	{
		alert("Select Warehouse");
		return false;
	}
	if(cnt2 > 0)
	{
		alert("Select Bin");
		return false;
	}
	if(document.frmaddDepartment.flagcode.value=="")
	{
		alert("Please select Lot Number");
		return false;
	}

}
else
{
	var subtype=document.frmaddDepartment.txt123.value;
			
	if(subtype=="")
	{
	 	alert("Please Select Bin wise Updation type");
		return false;
	}
	else
	{
		var	val3=document.frmaddDepartment.txtslwhg.value;
		var	val4=document.frmaddDepartment.txtslbing.value;
		if(val3=="")
		{
			alert("Please Select Warehouse");
			return false;
		}
		if(val4=="")
		{
			alert("Please Select Bin");
			return false;
		}
		
		if(subtype=="ycode")
		{
			
			var cnt1=0;cnt2=0;
			if(document.frmaddDepartment.srno.value > 2)
			{
				for (var i = 0; i < document.frmaddDepartment.txtlotno.length; i++) 
				{          
						 
					if(document.frmaddDepartment.txtlotno[i].checked == true)
					{
						if(document.frmaddDepartment.flagcode.value =="")
						{
							document.frmaddDepartment.flagcode.value=document.frmaddDepartment.txtlotno[i].value;
						}
						else
						{
							document.frmaddDepartment.flagcode.value = document.frmaddDepartment.flagcode.value +','+document.frmaddDepartment.txtlotno[i].value;
						}
								
						if(document.frmaddDepartment.txtslwhg1[i].value=="")cnt1++;
								
						if(document.frmaddDepartment.code1.value =="")
						{
							document.frmaddDepartment.code1.value=document.frmaddDepartment.txtslwhg1[i].value;
						}
						else
						{
							document.frmaddDepartment.code1.value = document.frmaddDepartment.code1.value +','+document.frmaddDepartment.txtslwhg1[i].value;
						}
						
						if(document.frmaddDepartment.txtslbing1[i].value=="")cnt2++;
								
						if(document.frmaddDepartment.code2.value =="")
						{
							document.frmaddDepartment.code2.value=document.frmaddDepartment.txtslbing1[i].value;
						}
						else
						{
							document.frmaddDepartment.code2.value = document.frmaddDepartment.code2.value +','+document.frmaddDepartment.txtslbing1[i].value;
						}
							
						
					}
				}
			}
			else
			{
				if(document.frmaddDepartment.txtlotno.checked == true)
				{
					if(document.frmaddDepartment.flagcode.value =="")
					{
						document.frmaddDepartment.flagcode.value=document.frmaddDepartment.txtlotno.value;
					}
					else
					{
						document.frmaddDepartment.flagcode.value = document.frmaddDepartment.flagcode.value +','+document.frmaddDepartment.txtlotno.value;
					}
							
					if(document.frmaddDepartment.txtslwhg1.value=="")cnt1++;
							
					if(document.frmaddDepartment.code1.value =="")
					{
						document.frmaddDepartment.code1.value=document.frmaddDepartment.txtslwhg1.value;
					}
					else
					{
						document.frmaddDepartment.code1.value = document.frmaddDepartment.code1.value +','+document.frmaddDepartment.txtslwhg1.value;
					}
						
					if(document.frmaddDepartment.txtslbing1.value=="")cnt2++;
								
					if(document.frmaddDepartment.code2.value =="")
					{
						document.frmaddDepartment.code2.value=document.frmaddDepartment.txtslbing1.value;
					}
					else
					{
						document.frmaddDepartment.code2.value = document.frmaddDepartment.code2.value +','+document.frmaddDepartment.txtslbing1.value;
					}
							
						
				}
			}
			
			//alert(cnt2);alert(cnt3);alert(cnt4);alert(cnt5);
			if(cnt1 > 0)
			{
				alert("Select Warehouse");
				return false;
			}
			if(cnt2 > 0)
			{
				alert("Select Bin");
				return false;
			}
			if(document.frmaddDepartment.flagcode.value == "")
			{
				alert("Please select Lot Number");
				return false;
			}
		}
		else
		{
			var	val5=document.frmaddDepartment.txtslwhg222.value;
			var	val6=document.frmaddDepartment.txtslbing222.value;
			if(val5=="")
			{
				alert("Please Select Warehouse");
				return false;
			}
			if(val6=="")
			{
				alert("Please Select Bin");
				return false;
			}
		}
	}
}          
}
return true;
}


</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>	
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp; Transaction - GS SLOC Updation </td>
	    </tr></table></td>
	  <!--<td width="116" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#F1B01E" bordercolordark="#F1B01E" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_result_update.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>
</table></td>-->
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">Select</td>
                </tr>
  		
				<tr class="Light" height="25">
                    <td width="376" height="30" align="right" valign="middle"><input type="radio" name="reptyp" value="select" onClick="typchk(this.value);" /></td>
                    <td width="468" align="left"  valign="middle" class="tblheading" >&nbsp;Lot Wise</td>
                </tr>
				<tr class="Dark" height="25">
           <td align="right" height="30" valign="middle"> <input type="radio" name="reptyp" value="lotno" onClick="typchk(this.value);" /></td>
           <td align="left"  valign="middle" class="tblheading" >&nbsp;Bin  Wise</td>
                </tr>
				
              </table>
		
	  
<div id="trans" style="display:none">
           <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704"  style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Search</td>
</tr>
<tr height="15">
<td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Dark" height="30">
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
        	</table>		  
		   
</div>
<div id="courier" style="display:none" >
<?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));?>

           <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704"  style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
                    <td height="30" colspan="2" align="right" valign="middle" class="tblheading">Partial &nbsp;</td>
                  
                    <td  align="left" colspan="2"  valign="middle" ><input type="radio" name="reptyp1" value="ycode" onClick="typchk1(this.value);" /></td>
		</tr>
				<tr class="Dark" height="25">
                    <td align="right" height="30" colspan="2" valign="middle" class="tblheading">Complete&nbsp;</td>
                  
                    <td align="left"  valign="middle" colspan="2" ><input type="radio" name="reptyp1" value="pcode" onClick="typchk1(this.value);" /></td>
					
                </tr>
				<tr class="Dark" height="25">
				<td width="206" height="30" align="right" valign="middle" class="tblheading">Select Ware House&nbsp;</td>
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars");
?>                 
				<td width="167"  align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg" style="width:80px;" onChange="wh(this.value);"   >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg2=mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg2['whid'];?>" />    
            <?php echo $noticia_whg2['perticulars'];?>
            <?php } ?>
    </select><font color="#FF0000">*</font>&nbsp;</td>
	  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
    <td width="190" height="30" align="right" valign="middle" class="tblheading">Select Bin&nbsp;</td>
                  
       <td width="272"  align="left"  valign="middle" class="tbltext" id="bing">&nbsp;<select class="tbltext" name="txtslbing" style="width:80px;"  >
          <option value="" selected>------Bin-------</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	</tr>
				</table>	
		   
</div>



<div id="vitem2" style="display:block"></div> 
<div id="binwisep" style="display:block"></div> 
<div id="binwisec" style="display:block"></div> 
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_gssloc.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input type="image" name="submit" src="../images/submit.gif" border="0" style="display:inline;cursor:Pointer;" onclick="return mySubmit();" />&nbsp;&nbsp; 
					  <input type="hidden" name="txtinv" />
                      <input name="txt11" value="" type="hidden"> 
					  <input name="txt123" value="" type="hidden"> 
                      <input type="hidden" name="flagcode" value=""/>
					  <input type="hidden" name="code1" value=""/>
					  <input type="hidden" name="code2" value=""/></td>
</tr>
</table>

  </tr>       


<td width="30"></td>
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
