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
function vartypechk(varval)
{
var classval=document.frmaddDepartment.txtcrop.value;
		showUser(classval,'vitem','item',varval,'','','','');

}
function modetchk(classval)
{	
			
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
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txttypchk" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="orsrval" value="" />
		<input type="hidden" name="txtptype" value="" />
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
 <td width="467" colspan="3" align="left"  valign="middle" class="tbltext" ><input name="txt1" type="radio" class="tbltext" value="Variety" onclick="typechk(this.value);"  />Variety&nbsp;<input name="txt1" type="radio" class="tbltext" value="Party" onclick="typechk(this.value);"  />Party&nbsp;<input name="txt1" type="radio" class="tbltext" value="Order" onclick="typechk(this.value);"  />Order(s) of Party&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Category&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" ><input name="txt15" type="radio" class="tbltext" value="Commercial" onClick="clk(this.value);" />Commercial&nbsp;<input name="txt15" type="radio" class="tbltext" value="TDF" onClick="clk(this.value);" />TDF&nbsp;<input name="txt15" type="radio" class="tbltext" value="Both" onClick="clk(this.value);" />Both&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="categorytyp" style="display:none"></div>
<br />
<div id="subblock" style="display:none"><input type="hidden" name="srno" value="0" /></div>
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

  