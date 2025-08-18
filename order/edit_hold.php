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
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];

	if(isset($_REQUEST['txttypchk'])) { $txttypchk = $_REQUEST['txttypchk']; }
	if(isset($_REQUEST['txt11'])) { $txt11=trim($_REQUEST['txt11']); }
	if(isset($_REQUEST['foccode'])) { $foccode=trim($_REQUEST['foccode']); }
	if(isset($_REQUEST['foccode1'])) { $foccode1=trim($_REQUEST['foccode1']); }
	if(isset($_REQUEST['txtcrop'])) { $txtcrop=trim($_REQUEST['txtcrop']); }
	if(isset($_REQUEST['txtvariety'])) { $txtvariety=trim($_REQUEST['txtvariety']); }
	if(isset($_REQUEST['txtpartycat1'])) { $txtpartycat1=trim($_REQUEST['txtpartycat1']); }
	if(isset($_REQUEST['fillpartyname1'])) { $fillpartyname1=trim($_REQUEST['fillpartyname1']); }
	if(isset($_REQUEST['orsrval'])) { $orsrval = $_REQUEST['orsrval']; }
	if(isset($_REQUEST['orderno'])) { $orderno = $_REQUEST['orderno']; }
	if(isset($_REQUEST['txtlot'])) { $txtlot = $_REQUEST['txtlot']; }
	if(isset($_REQUEST['txtlot1'])) { $txtlot1 = $_REQUEST['txtlot1']; }
	if(isset($_REQUEST['txtlot2'])) { $txtlot2 = $_REQUEST['txtlot2']; }
	if(isset($_REQUEST['partyname'])) { $partyname = $_REQUEST['partyname']; }
	if(isset($_REQUEST['txtpartycat'])) { $txtpartycat=trim($_REQUEST['txtpartycat']); }
	if(isset($_REQUEST['fillpartyname'])) { $fillpartyname=trim($_REQUEST['fillpartyname']); }
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	$partyname_org=$partyname;
	
	if(isset($_POST['frm_action'])=='submit')
	{ 
		$txttypchk=trim($_POST['txttypchk']);
		$txt11=trim($_POST['txt11']);
		$foccode=trim($_POST['foccode']);
		$foccode1=trim($_POST['foccode1']);
		$txtcrop="";
		$txtvariety="";
		$txtpartycat1="";
		$fillpartyname1="";
		$orsrval="";
		$orderno="";
		$txtlot="";
		$txtlot1="";
		$txtlot2="";
		$partyname="";
		$txtpartycat="";
		$fillpartyname="";
		$txtpp="";
		$txtstatesl="";
		$txtlocationsl="";
		$txtcountrysl="";
		$txtptype="";
		$txtparty="";
		$sdate="";
		$edate="";
		//exit;
	if($txttypchk=="Variety")
	{
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
	}
	if($txttypchk=="Party")
	{
		$partyname=trim($_POST['partyname']);
		$fillpartyname1=trim($_POST['fillpartyname1']);
		if($fillpartyname1=="")
		{
			$txtpartycat1=trim($_POST['txtpartycat1']);
			$txtpp=trim($_POST['txtpp']);
			$txtptype=trim($_POST['txtptype']);
			if($txtpp!="Export Buyer")
			{
				$txtstatesl=trim($_POST['txtstatesl']);
				$txtlocationsl=trim($_POST['txtlocationsl']);
			}
			else
			{
				$txtcountrysl=trim($_POST['txtcountrysl']);
			}
			$txtparty=trim($_POST['txtparty']);
		}
	}
	if($txttypchk=="Order")
	{
		$orsrval=trim($_POST['orsrval']);
		
		if($orsrval=="ordersearch")
		{
			$orderno=trim($_POST['orderno']);
			$txtlot=trim($_POST['txtlot']);
			$txtlot1=trim($_POST['txtlot1']);
			$txtlot2=trim($_POST['txtlot2']);
		}
		if($orsrval=="partysearch")
		{
			$partyname=trim($_POST['partyname']);
			$fillpartyname=trim($_POST['fillpartyname']);
			if($fillpartyname=="")
			{
				$txtpartycat=trim($_POST['txtpartycat']);
				$txtpp=trim($_POST['txtpp']);
				$txtptype=trim($_POST['txtptype']);
				if($txtpp!="Export Buyer")
				{
					$txtstatesl=trim($_POST['txtstatesl']);
					$txtlocationsl=trim($_POST['txtlocationsl']);
				}
				else
				{
					$txtcountrysl=trim($_POST['txtcountrysl']);
				}
				$txtparty=trim($_POST['txtparty']);
			}
		}
		if($orsrval=="datesearch")
		{
			$sdate=trim($_POST['sdate']);
			$edate=trim($_POST['edate']);
		}
	}
		//exit;
		echo "<script>window.location='add_hold_preview.php?txttypchk=$txttypchk&txt11=$txt11&foccode=$foccode&foccode1=$foccode1&txtcrop=$txtcrop&txtvariety=$txtvariety&txtpartycat1=$txtpartycat1&fillpartyname1=$fillpartyname1&orsrval=$orsrval&orderno=$orderno&txtlot=$txtlot&txtlot1=$txtlot1&txtlot2=$txtlot2&partyname=$partyname&txtpartycat=$txtpartycat&fillpartyname=$fillpartyname&txtpp=$txtpp&txtstatesl=$txtstatesl&txtlocationsl=$txtlocationsl&txtcountrysl=$txtcountrysl&txtptype=$txtptype&txtparty=$txtparty&sdate=$sdate&edate=$edate'</script>";	
			
			
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order- Transaction-Holding -Unholding</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="holdunhold.js"></script>
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
<script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>
<script language="javascript" type="text/javascript">

function selectall()
{
	if(document.frmaddDepartment.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDepartment.hluhlcb.length; i++)
		{          
			document.frmaddDepartment.hluhlcb[i].checked = true;
		}
	}
	else
	{
		document.frmaddDepartment.hluhlcb.checked = true;
	}
}

function unselectall()
{
	if(document.frmaddDepartment.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDepartment.hluhlcb.length; i++) 
		{          
			document.frmaddDepartment.hluhlcb[i].checked = false;
			document.frmaddDepartment.foccode.value="";
		}
	}
	else
	{
		document.frmaddDepartment.hluhlcb.checked = false;
		document.frmaddDepartment.foccode.value ="";
	}
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

function typechk(typ)
{
document.frmaddDepartment.txttypchk.value=typ;
document.getElementById('categorytyp').style.display="none";
document.getElementById('subblock').style.display="none";
document.frmaddDepartment.txt11.value="";
var radList = document.getElementsByName('txt15');
for (var i = 0; i < radList.length; i++) {
if(radList[i].checked) radList[i].checked = false;}
}
function clk(opt)
{ 
	if(document.frmaddDepartment.txttypchk.value!="")
	{
		var typ=document.frmaddDepartment.txttypchk.value;
		document.getElementById('categorytyp').style.display="block";
		document.getElementById('subblock').style.display="none";
		showUser(opt,'categorytyp','categorychk',typ,'','','');
		document.frmaddDepartment.txt11.value=opt;
	}
	else
	{
		alert("Please Select Type");
		document.getElementById('categorytyp').style.display="none";
		document.getElementById('subblock').style.display="none";
		document.frmaddDepartment.txt11.value="";
	}
}

function showpform()
{
	var maintyp=document.frmaddDepartment.txttypchk.value;
	var subtyp=document.frmaddDepartment.txt11.value;
	if(maintyp=="")
	{
		alert("Please Select Type");
		return false;
	}
	if(subtyp=="")
	{
		alert("Please Select Category");
		return false;
	}
	var val1="";
	var val2="";
	var val3="";
	if(maintyp=="Variety")
	{
		val1=document.frmaddDepartment.txtcrop.value;
		val2=document.frmaddDepartment.txtvariety.value;
		val3="";
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
	}
	if(maintyp=="Party")
	{
		val1=document.frmaddDepartment.fillpartyname1.value;
		val2=document.frmaddDepartment.partyname.value;
		val3=document.frmaddDepartment.fillpartyname1.value;
			if(val2=="")
			{
				alert("Please select/enter Party");
				return false;
			}
		/*if(val1=="")
		{
			alert("Please Select Party Type");
			return false;
		}
		if(val2=="")
		{
			alert("Please Select Party Name");
			return false;
		}*/
	}
	if(maintyp=="Order")
	{
		if(document.frmaddDepartment.orsrval.value=="")
		{
				alert("Please Select Search Type");
				return false;
		}
		if(document.frmaddDepartment.orsrval.value=="ordersearch")
		{
			val1=document.frmaddDepartment.orsrval.value;
			val2=document.frmaddDepartment.orderno.value;
			val3="";
			if(val2=="")
			{
				alert("Please enter Order Number");
				return false;
			}
		}
		if(document.frmaddDepartment.orsrval.value=="partysearch")
		{
			val1=document.frmaddDepartment.orsrval.value;
			val2=document.frmaddDepartment.partyname.value;
			val3=document.frmaddDepartment.fillpartyname.value;
			if(val2=="")
			{
				alert("Please select/enter Party");
				return false;
			}
		}
		if(document.frmaddDepartment.orsrval.value=="datesearch")
		{
			val1=document.frmaddDepartment.orsrval.value;
			val2=document.frmaddDepartment.sdate.value;
			val3=document.frmaddDepartment.edate.value;
			dt1=getDateObject(val2,"-");
			dt2=getDateObject(val3,"-");
				
			if(dt1 > dt2)
			{
			alert("Please select Valid Date Range.");
			return false;
			}
		}
	}
	//alert(val1);alert(val2);alert(val3);
	showUser(maintyp,'subblock','hluhlshow',subtyp,val1,val2,val3,'','');
	document.getElementById('showulform').style.display="none";
	document.getElementById('subblock').style.display="block";
}

function isNumberKey(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}

function modetchk(classval)
{	
			showUser(classval,'vitem','item','','','','','');
}

function modetchkparty(classval)
{	
			if(classval=="C&F")classval="CandF";
			
			showUser(classval,'vitem','partychk','','','','','');
}

function ordersrchk(srval)
{
	var subtyp=document.frmaddDepartment.txt11.value;
	document.getElementById('ordersrtyp').style.display="block";
	document.getElementById('showulform').style.display="block";
	document.getElementById('subblock').style.display="none";
	showUser(srval,'ordersrtyp','orderchk',subtyp,'','','','');
	document.frmaddDepartment.orsrval.value=srval;
}

function partycatsl(catslval)
{
document.frmaddDepartment.fillpartyname.value="";
document.frmaddDepartment.fillpartyname.disabled=true;
showUser(catslval,'orderpsltyp','partytypslchk','','','','','');
document.getElementById('orderpsltyp').style.display="block";
document.getElementById('selectpartylocation').style.display="none";
document.getElementById('selectparty').style.display="none";
}

function prtyslval(ptslval)
{ 
document.frmaddDepartment.partyname.value=ptslval;
}

function fillpartysl(fpslval)
{
document.frmaddDepartment.txtpartycat.SelectedIndex=0;
document.frmaddDepartment.txtpartycat.disabled=true;
document.frmaddDepartment.partyname.value=fpslval;
}

function partycatsl1(catslval)
{
document.frmaddDepartment.fillpartyname1.value="";
document.frmaddDepartment.fillpartyname1.disabled=true;
showUser(catslval,'orderpsltyp1','partytypslchk1','','','','','');
document.getElementById('orderpsltyp1').style.display="block";
document.getElementById('selectpartylocation').style.display="none";
document.getElementById('selectparty').style.display="none";
}

function fillpartysl1(fpslval)
{
document.frmaddDepartment.txtpartycat1.SelectedIndex=0;
document.frmaddDepartment.txtpartycat1.disabled=true;
document.frmaddDepartment.partyname.value=fpslval;
}
function ornock(orval)
{
	if(document.frmaddDepartment.txtlot1.value=="" || document.frmaddDepartment.txtlot1.value <= 0)
	{
		alert("Please enter valid Order No.");
		return false;
	}
	else
	{
		document.frmaddDepartment.orderno.value="OR"+document.frmaddDepartment.txtlot1.value+"/"+orval+"/";
	}
}

function modetchk1(classval)
{	
		if(classval != "")
		{
		if(classval=="C&F")classval="CandF";
		document.getElementById('selectpartylocation').style.display="block";
		document.getElementById('selectparty').style.display="none";
		showUser(classval,'selectpartylocation','partylocation','','','','','');
		document.frmaddDepartment.txtptype.value=classval;
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
		showUser(classval,'selectparty','partychk1',valloc,'','','','');
		document.frmaddDepartment.locationname.value=valloc;
	}
}
function loccontrychk(countryval)
{
		if(document.frmaddDepartment.txtpp.value!="")
		{
			var classval=document.frmaddDepartment.txtptype.value;
			document.getElementById('selectparty').style.display="block";
			showUser(classval,'selectparty','partychk1',countryval,'','','','');
			document.frmaddDepartment.locationname.value=countryval;
		}
		else
		{
			alert("Please Select Party Type");
			document.frmaddDepartment.txtcountrysl.selectedIndex=0;
		}

}

function subblockchk()
{
document.getElementById('showulform').style.display="block";
document.getElementById('subblock').style.display="none";
}

function openslocpop(itm)
{
winHandle=window.open('booked_order_details.php?itmid='+itm,'WelCome','top=170,left=180,width=800,height=550,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 
	if(document.frmaddDepartment.srno.value<=1)
	{
		alert("You have not Selected any Order to Hold / Unhold. Please select & then click Preview");
		return false;
	}
	if(document.frmaddDepartment.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDepartment.hluhlcb.length; i++) 
		{          
		 
		  if(document.frmaddDepartment.hluhlcb[i].checked == true)
			{ 
				if(document.frmaddDepartment.foccode.value=="")
				{
				document.frmaddDepartment.foccode.value=document.frmaddDepartment.hluhlcb[i].value;
				}
				else
				{
				document.frmaddDepartment.foccode.value = document.frmaddDepartment.foccode.value +','+document.frmaddDepartment.hluhlcb[i].value;
				}
			}
			else
			{
				if(document.frmaddDepartment.foccode1.value=="")
				{
				document.frmaddDepartment.foccode1.value=document.frmaddDepartment.hluhlcb[i].value;
				}
				else
				{
				document.frmaddDepartment.foccode1.value = document.frmaddDepartment.foccode1.value +','+document.frmaddDepartment.hluhlcb[i].value;
				}
			}
		}
		
	}
	else
	{
		if(document.frmaddDepartment.hluhlcb.checked == true)
		{
			if(document.frmaddDepartment.foccode.value =="")
			{
				document.frmaddDepartment.foccode.value=document.frmaddDepartment.hluhlcb.value;
			}
			else
			{
				document.frmaddDepartment.foccode.value = document.frmaddDepartment.foccode.value +','+document.frmaddDepartment.hluhlcb.value;
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
           <td valign="top"><?php require_once("../include/arr_order.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Holding - Unholding</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="<?php echo $txt11;?>" type="hidden"> 
	    <input name="txttypchk" value="<?php echo $txttypchk;?>" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="orsrval" value="<?php echo $orsrval;?>" />
		<input type="hidden" name="txtptype" value="<?php echo $txtptype;?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Type of Holding-Unholding</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="25">
<td width="377" align="right"  valign="middle" class="tblheading">&nbsp;Select Type &nbsp;</td>
 <td width="467" colspan="3" align="left"  valign="middle" class="tbltext" ><input name="txt1" type="radio" class="tbltext" value="Variety" onclick="typechk(this.value);" <?php if($txttypchk=="Variety") echo "checked";?>  />Variety&nbsp;<input name="txt1" type="radio" class="tbltext" value="Party" onclick="typechk(this.value);" <?php if($txttypchk=="Party") echo "checked";?>  />Party&nbsp;<input name="txt1" type="radio" class="tbltext" value="Order" onclick="typechk(this.value);" <?php if($txttypchk=="Order") echo "checked";?>  />Order(s) of Party&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Category&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="txt15" type="radio" class="tbltext" value="Commercial" onClick="clk(this.value);" <?php if($txt11=="Commercial") echo "checked";?> />Commercial&nbsp;<input name="txt15" type="radio" class="tbltext" value="TDF" onClick="clk(this.value);" <?php if($txt11=="TDF") echo "checked";?> />TDF&nbsp;<input name="txt15" type="radio" class="tbltext" value="Both" onClick="clk(this.value);" <?php if($txt11=="Both") echo "checked";?> />Both&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="categorytyp" style="display: <?php if($txttypchk!="") echo "block"; else echo "none";?>">
<?php
if($txttypchk == "Variety")	
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="156" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="279" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option  <?php if($txtcrop==$noticia['cropid']) echo "selected";?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
    <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT * FROM tblvariety where cropname='".$txtcrop."' and actstatus='Active' order by popularname Asc");

?>
	<td width="122" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="283" align="left"  valign="middle" class="tbltext" id="vitem" colspan="3">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onchange="subblockchk()" >
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($quer4)) { ?>
		<option  <?php if($txtvariety==$noticia_item['varietyid']) echo "selected";?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
	<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
<input type="hidden" name="itmdchk" value="" />

</table>
<?php
}
else if($txttypchk=="Party")
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
		<tr class="Dark" height="30">
<td width="199" align="right"  valign="middle" class="tblheading" >Select Order Type&nbsp;</td>
<td width="177" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtpartycat1" style="width:80px;" onchange="partycatsl1(this.value);">
    <option value="" selected="selected">--Select--</option>
	<option <?php if($txtpartycat1=="Sales") echo "selected";?> value="Sales">Sales</option>
	<option <?php if($txtpartycat1=="Stock Transfer") echo "selected";?> value="Stock Transfer">Stock Transfer</option>
	<option <?php if($txtpartycat1=="TDF") echo "selected";?> value="TDF">TDF</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading" >Fill Party Name&nbsp;</td>
<td width="342" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="fillpartyname1" class="tbltext" size="35" value="<?php echo $fillpartyname1;?>" <?php if($txt11=="Commercial") echo 'disabled'; ?> title="Fill the TDF Party Name to search which is not available in Party master" onchange="fillpartysl1(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp; <input type="hidden" name="partyname" value="<?php echo $partyname;?>" /></td>
</tr>
		
<tr height="15"><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">Select Order Type to select Party in cases where party is listed under party master.</div></td><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">In case of TDF, where party is not present in party master. Specify Exact Party Name, here</div></td></tr>	
</table>	
<div id="orderpsltyp1" style="display:<?php if($txtpartycat1!="") echo "block"; else "none"; ?>">
<?php
	if($txtpartycat1=="Sales") $a="Channel";
	if($txtpartycat1=="Stock Transfer") $a="Stock Transfer";
if($txtpartycat1!="TDF")
{	
$sql_month=mysqli_query($link,"select * from tblclassification where main='".$a."' order by classification")or die(mysqli_error($link));
}
else
{
$sql_month=mysqli_query($link,"select * from tblclassification where classification='TDF - Individual' order by classification")or die(mysqli_error($link));
}
$t=mysqli_num_rows($sql_month);
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="202" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)">
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($txtpp==$noticia['classification']) echo "selected";?> value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
</table>
</div>
<div id="selectpartylocation"style="display:<?php if($txtpartycat1!="") echo "block"; else "none"; ?>" >
<?php
if($txtpp!="Export Buyer")
{	
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="202"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)">
<option value="">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($txtstatesl==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
          
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$txtstatesl."' order by productionlocation")or die(mysqli_error($link));
?>	
	
	<td width="202"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<select class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)">
<option value="" selected>--Select--</option>
<?php while($noticia3 = mysqli_fetch_array($sql_month3)) { ?>
		<option <?php if($txtlocationsl==$noticia3['productionlocationid']){ echo "Selected";} ?> value="<?php echo $noticia3['productionlocationid'];?>" />   
		<?php echo $noticia3['productionlocation'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr><input type="hidden" name="locationname" value="" />
</table>
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry order by country")or die(mysqli_error($link));
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="202"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)">
<option value="">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($txtcountrysl==$noticia['country']){ echo "Selected";} ?> value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
</table>
<?php
}
?>
</div>		   
<div id="selectparty"style="display:<?php if($txtpartycat1!="") echo "block"; else "none"; ?>" >
<?php
if($txtpp!="Export Buyer")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$txtlocationsl."' and classification='".$txtpp."' order by business_name")or die(mysqli_error($link));
}
else
{
$sql_month123=mysqli_query($link,"select * from tblcountry where  country='".$txtcountrysl."'")or die(mysqli_error($link));
$noticia123 = mysqli_fetch_array($sql_month123);
$c=$noticia123['c_id'];
$sql_month=mysqli_query($link,"select * from tbl_partymaser where  country='".$c."' and classification='".$txtpp."' order by business_name")or die(mysqli_error($link));
}
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="202" align="right"  valign="middle" class="tblheading" >Party Name &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="prtyslval(this.value);"  >
<option value="" selected="selected">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($partyname==$noticia['p_id']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

</div>
<?php
}
else if($txttypchk="Order")
{
?>	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Light" height="25">
<td width="376" align="right"  valign="middle" class="tblheading">Order No. Search&nbsp;</td>
<td width="468" align="left"  valign="middle" class="tbltext" ><input type="radio" name="orsearch" value="ordersearch" onclick="ordersrchk(this.value)" <?php if($orsrval=="ordersearch") echo "checked";?> /></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >Party Name Search&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" ><input type="radio" name="orsearch" value="partysearch" onclick="ordersrchk(this.value)" <?php if($orsrval=="partysearch") echo "checked";?> /></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >Date wise Search&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"><input type="radio" name="orsearch" value="datesearch" onclick="ordersrchk(this.value)" <?php if($orsrval=="datesearch") echo "checked";?> /></td>
</tr>
</table>
<div id="ordersrtyp" style="display:<?php if($orsrval!="") echo "block"; else "none";?>">
<?php
if($orsrval=="ordersearch")
{
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by yearsid desc"); 
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="377" align="right"  valign="middle" class="tblheading" >Order No.&nbsp;</td>
<td width="467" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlot" type="text" size="1" class="tbltext" tabindex="0" maxlength="2" value="OR" readonly="true" style="background-color:#EFEFEF"/>&nbsp;<input name="txtlot1" type="text" size="6" class="tbltext" tabindex="0" maxlength="5" value="<?php echo $txtlot1;?>"/>&nbsp;<select class="tbltext" name="txtlot2" style="width:60px;" onchange="ornock(this.value);">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option <?php if($txtlot2==$noticia['ycode']) echo "selected";?> value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?>
  </select>&nbsp;<input type="hidden" name="orderno" class="tbltext" size="20" value="<?php echo $orderno;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<?php
}
else if($orsrval=="partysearch")
{
//echo $txt11;
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
		<tr class="Dark" height="30">
<td width="199" align="right"  valign="middle" class="tblheading" >Select Order Type&nbsp;</td>
<td width="177" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtpartycat" style="width:80px;" onchange="partycatsl(this.value);">
    <option value="" selected="selected">--Select--</option>
	<option <?php if($txtpartycat=="Sales") echo "selected";?> value="Sales">Sales</option>
	<option <?php if($txtpartycat=="Stock Transfer") echo "selected";?> value="Stock Transfer">Stock Transfer</option>
	<option <?php if($txtpartycat=="TDF") echo "selected";?> value="TDF">TDF</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading" >Fill Party Name&nbsp;</td>
<td width="342" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="fillpartyname" class="tbltext" size="35" value="<?php echo $fillpartyname;?>" <?php if($txt11=="Commercial" || $txtpartycat!="") echo 'disabled'; ?> title="Fill the TDF Party Name to search which is not available in Party master" onchange="fillpartysl(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp; <input type="hidden" name="partyname" value="<?php echo $partyname;?>" /></td>
</tr>
<tr height="15"><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">Select Order Type to select Party in cases where party is listed under party master.</div></td><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">In case of TDF, where party is not present in party master. Specify Exact Party Name, here</div></td></tr>	
		</table>
<div id="orderpsltyp" style="display:<?php if($txtpartycat!="") echo "block"; else "none"; ?>">
<?php
	if($txtpartycat=="Sales") $a="Channel";
	if($txtpartycat=="Stock Transfer") $a="Stock Transfer";
if($txtpartycat!="TDF")
{	
$sql_month=mysqli_query($link,"select * from tblclassification where main='".$a."' order by classification")or die(mysqli_error($link));
}
else
{
$sql_month=mysqli_query($link,"select * from tblclassification where classification='TDF - Individual' order by classification")or die(mysqli_error($link));
}
$t=mysqli_num_rows($sql_month);
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="202" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)">
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($txtpp==$noticia['classification']) echo "selected";?> value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
</table>
</div>
<div id="selectpartylocation"style="display:<?php if($txtpartycat!="") echo "block"; else "none"; ?>" >
<?php
if($txtpp!="Export Buyer")
{	
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="202"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)">
<option value="">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($txtstatesl==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
          
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$txtstatesl."' order by productionlocation")or die(mysqli_error($link));
?>	
	
	<td width="202"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<select class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)">
<option value="" selected>--Select--</option>
<?php while($noticia3 = mysqli_fetch_array($sql_month3)) { ?>
		<option <?php if($txtlocationsl==$noticia3['productionlocationid']){ echo "Selected";} ?> value="<?php echo $noticia3['productionlocationid'];?>" />   
		<?php echo $noticia3['productionlocation'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr><input type="hidden" name="locationname" value="" />
</table>
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry order by country")or die(mysqli_error($link));
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="202"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtcountrysl" style="width:120px;" onchange="loccontrychk(this.value)">
<option value="">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($txtcountrysl==$noticia['country']){ echo "Selected";} ?> value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
</table>
<?php
}
?>
</div>		   
<div id="selectparty"style="display:<?php if($txtpartycat!="") echo "block"; else "none"; ?>" >
<?php
if($txtpp!="Export Buyer")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$txtlocationsl."' and classification='".$txtpp."' order by business_name")or die(mysqli_error($link));
}
else
{
$sql_month123=mysqli_query($link,"select * from tblcountry where  country='".$txtcountrysl."'")or die(mysqli_error($link));
$noticia123 = mysqli_fetch_array($sql_month123);
$c=$noticia123['c_id'];
$sql_month=mysqli_query($link,"select * from tbl_partymaser where  country='".$c."' and classification='".$txtpp."' order by business_name")or die(mysqli_error($link));
}
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="202" align="right"  valign="middle" class="tblheading" >Party Name &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="prtyslval(this.value);"  >
<option value="" selected="selected">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($partyname==$noticia['p_id']){ echo "Selected";} ?> value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

</div>
<?php
}
else if($orsrval=="datesearch")
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="25">
                  <td width="201" height="30" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;&raquo;&nbsp;&nbsp;&nbsp;From&nbsp;</td>
    <td width="175" align="left"  valign="middle"  >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $sdate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
                  <td width="80" align="right"  valign="middle" class="tblheading">&nbsp;To&nbsp;</td>
                  <td width="384"  colspan="8" align="left"  valign="middle">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $edate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDepartment.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle" /></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>
  </tr>
</table>
<?php
}
else
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td align="center"  valign="middle" class="tblheading" >Select Search Type</td>
</tr>
</table>
<?php
}
?>
</div> 
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr height="15"><td colspan="6" align="center" class="tblheading">Type Not Selected</td></tr>
</table>
<?php
}
?>
<div id="showulform" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td valign="middle" align="right"><img src="../images/display.gif" border="0"style="display:inline;cursor:pointer;" onclick="showpform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>	
</div>
<br />
<div id="subblock" style="display:<?php if($orsrval!="") echo "block"; else "none";?>">
<?php
 $a=$txttypchk;   $b=$txt11;
if($a=="Variety")
{ 
?><table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="7" align="left" class="tblheading"><a href="javascript:void(0)" onclick="selectall()">Check All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear All </a>&nbsp;</td></tr>
<tr class="tblsubtitle" height="20">
	<td width="31" align="center" valign="middle" class="tblheading">#</td>
	<td width="42" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="91" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="163" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="125" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="296" align="center" valign="middle" class="tblheading">Party Name</td>
	<td width="86" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php

$srno=1; $cnt=0;
$sql_main=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_crop='".$txtcrop."' and order_sub_variety='".$txtvariety."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0 group by orderm_id") or die(mysqli_error($link));
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
else
{
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$tdate=$row_sub['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_sub['orderm_party']!="" && $row_sub['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_sub['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_sub['orderm_partyname'];
	}
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_sub['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_sub['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_sub['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_sub['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>								
</table>
<?php
}
else if($a=="Party")
{ 
?><table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="7" align="left" class="tblheading"><a href="javascript:void(0)" onclick="selectall()">Check All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear All </a>&nbsp;</td></tr>
<tr class="tblsubtitle" height="20">
	<td width="36" align="center" valign="middle" class="tblheading">#</td>
	<td width="77" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="153" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="269" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="213" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="88" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php

$srno=1;  $ort=$c; $rec=0;
//if($ort=="TDF - Individual")$ort="Individual";
//$sql_main=mysqli_query($link,"select * from tbl_order_sub where order_sub_crop='".$c."' and order_sub_variety='".$f."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
$row_sub=mysqli_fetch_array($sql_sub);

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php
}
else if($a=="Order")
{ 
?>
<?php
if($orsrval!="partysearch")
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="7" align="left" class="tblheading"><a href="javascript:void(0)" onclick="selectall()">Check All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear All </a>&nbsp;</td></tr>
<tr class="tblsubtitle" height="20">
	<td width="31" align="center" valign="middle" class="tblheading">#</td>
	<td width="42" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="91" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="163" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="125" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="296" align="center" valign="middle" class="tblheading">Party Name</td>
	<td width="86" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php

$srno=1; $cnt=0; 
if($orsrval=="ordersearch")
{
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{

		$sdate=$sdate;
		$sday=substr($sdate,0,2);
		$smonth=substr($sdate,3,2);
		$syear=substr($sdate,6,4);
		$sdate1=$syear."-".$smonth."-".$sday;
		
		$edate=$edate;
		$eday=substr($edate,0,2);
		$emonth=substr($edate,3,2);
		$eyear=substr($edate,6,4);
		$edate1=$eyear."-".$emonth."-".$eday;	
			
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
$row_sub=mysqli_fetch_array($sql_sub);

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?>	 /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>	
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="7" align="left" class="tblheading"><a href="javascript:void(0)" onclick="selectall()">Check All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear All </a>&nbsp;</td></tr>
<tr class="tblsubtitle" height="20">
	<td width="36" align="center" valign="middle" class="tblheading">#</td>
	<td width="77" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="153" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="269" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="213" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="88" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php
$srno=1; $cnt=0; 

if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
		if($fillpartyname!="")
		{
		$ortyp="Order TDF";
		$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
		else
		{
			$ortyp="Order TDF";
			$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
	}
	else
	{ 
		if($fillpartyname!="")
		{
		$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
		else
		{
			
		$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
	}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
$row_sub=mysqli_fetch_array($sql_sub);

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php
}
?>
<?php
}
else 
{
?><table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading">Records Not Found.</td>
	</tr>

</table>
<?php
}
?><input type="hidden" name="srno" value="<?php echo $srno;?>" />
</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_hold.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="foccode" value="" /><input type="hidden" name="foccode1" value="" /></td>
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

  