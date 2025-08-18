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
		$txttypchk=trim($_POST['txttypchk']);
		$txt11=trim($_POST['txt11']);
		$cdate=trim($_POST['cdate']);
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
		echo "<script>window.location='report_hold1.php?cdate=$cdate&txttypchk=$txttypchk&txt11=$txt11&txtcrop=$txtcrop&txtvariety=$txtvariety&txtpartycat1=$txtpartycat1&fillpartyname1=$fillpartyname1&orsrval=$orsrval&orderno=$orderno&txtlot=$txtlot&txtlot1=$txtlot1&txtlot2=$txtlot2&partyname=$partyname&txtpartycat=$txtpartycat&fillpartyname=$fillpartyname&txtpp=$txtpp&txtstatesl=$txtstatesl&txtlocationsl=$txtlocationsl&txtcountrysl=$txtcountrysl&txtptype=$txtptype&txtparty=$txtparty&sdate=$sdate&edate=$edate'</script>";	
		//echo "<script>window.location='report_hold1.php?sdate=$sdate&txtstfp=$type&txtvariety=$itemid&txtgstat=$typ'</script>";
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Booking-Report -Item on Hold Report on</title>
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
<SCRIPT language="JavaScript">
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
function typchk(typval)
{
if(typval != "Consolidated")
{
document.getElementById('cattyp').style.display="block";
document.getElementById('categorytyp').style.display="none";
var radList = document.getElementsByName('repcattyp');
for (var i = 0; i < radList.length; i++) {
if(radList[i].checked) radList[i].checked = false;}
}
else
{
document.getElementById('cattyp').style.display="none";
document.getElementById('categorytyp').style.display="none";
var radList = document.getElementsByName('repcattyp');
for (var i = 0; i < radList.length; i++) {
if(radList[i].checked) radList[i].checked = false;}
}
document.frmaddDepartment.txttypchk.value=typval;
}	

function cattypchk(cattypval)
{
var typ=document.frmaddDepartment.txttypchk.value;
document.getElementById('categorytyp').style.display="block";
showUser(cattypval,'categorytyp','categorychk_rep',typ,'','','');
document.frmaddDepartment.txt11.value=cattypval;
}
function mySubmit()
{ 

	var maintyp=document.frmaddDepartment.txttypchk.value;
	var subtyp=document.frmaddDepartment.txt11.value;
	if(maintyp=="")
	{
		alert("Please Select Type");
		return false;
	}
	if(maintyp!="Consolidated")
	{
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
			if(val1=="")
			{
				if(document.frmaddDepartment.txtpartycat1.value=="")
				{
					alert("Please Select Order Type");
					return false
				}
				if(document.frmaddDepartment.txtpartycat1.value!="")
				{
					if(document.frmaddDepartment.txtpp.value=="")
					{
						alert("Please Select Party Type");
						return false
					}
					if(document.frmaddDepartment.txtpp.value!="")
					{
						if(document.frmaddDepartment.txtpp.value!="Export Buyer")
						{
							if(document.frmaddDepartment.txtstatesl.value=="")
							{
								alert("Please Select State");
								return false
							}
							if(document.frmaddDepartment.txtlocationsl.value=="")
							{
								alert("Please Select Location");
								return false
							}
							if(document.frmaddDepartment.txtlocationsl.value!="")
							{
								if(document.frmaddDepartment.txtparty.value=="")
								{
									alert("Please Select Party");
									return false
								}
							}
						}
						else
						{
							if(document.frmaddDepartment.txtcountrysl.value=="")
							{
								alert("Please Select Country");
								return false
							}
							if(document.frmaddDepartment.txtcountrysl.value!="")
							{
								if(document.frmaddDepartment.txtparty.value=="")
								{
									alert("Please Select Party");
									return false
								}
							}
						}
					}
				}
			}
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
				/*if(document.frmaddDepartment.txtlot1.value=="")
				{
					alert("Please enter Order Number");
					return false;
				}*/
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
				if(val3=="")
				{
					if(document.frmaddDepartment.txtpartycat.value=="")
					{
						alert("Please Select Order Type");
						return false
					}
					if(document.frmaddDepartment.txtpartycat.value!="")
					{
						if(document.frmaddDepartment.txtpp.value=="")
						{
							alert("Please Select Party Type");
							return false
						}
						if(document.frmaddDepartment.txtpp.value!="")
						{
							if(document.frmaddDepartment.txtpp.value!="Export Buyer")
							{
								if(document.frmaddDepartment.txtstatesl.value=="")
								{
									alert("Please Select State");
									return false
								}
								if(document.frmaddDepartment.txtlocationsl.value=="")
								{
									alert("Please Select Location");
									return false
								}
								if(document.frmaddDepartment.txtlocationsl.value!="")
								{
									if(document.frmaddDepartment.txtparty.value=="")
									{
										alert("Please Select Party");
										return false
									}
								}
							}
							else
							{
								if(document.frmaddDepartment.txtcountrysl.value=="")
								{
									alert("Please Select Country");
									return false
								}
								if(document.frmaddDepartment.txtcountrysl.value!="")
								{
									if(document.frmaddDepartment.txtparty.value=="")
									{
										alert("Please Select Party");
										return false
									}
								}
							}
						}
					}
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
	}
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
	//document.getElementById('showulform').style.display="block";
	//document.getElementById('subblock').style.display="none";
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
//document.getElementById('showulform').style.display="none";
//document.getElementById('subblock').style.display="none";
}


</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_order.php");?></td>
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
	      <td width="813" height="30"class="Mainheading"  >Item on Hold Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	  <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="radtyp" value="" />
	  <input type="hidden" name="orsrval" value="" />
		<input type="hidden" name="txtptype" value="" />
		<input name="txt11" value="" type="hidden"> 
	    <input name="txttypchk" value="" type="hidden"> 
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
          <tr height="7">
            <td height="7"></td>
          </tr>
          <tr>
            <td width="30"></td>
            <td><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">Item on Hold Report </td>
                </tr>
                <tr height="15">
                  <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
                </tr>
                <?php
 /*$code="";
$quer2=mysqli_query($link,"SELECT DISTINCT dept_name,dept_id FROM tbldept order by dept_name Asc"); */
?>
                <tr class="Dark" height="25">
                    <td align="right" width="376" height="30" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="468" align="left"  valign="middle" >&nbsp;<input name="cdate" id="cdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;</td>
                </tr>
				
				<tr class="Light" height="25">
                    <td align="right" height="30" valign="middle" class="tblheading">&nbsp;Consolidated&nbsp;</td>
           <td align="left"  valign="middle" ><input type="radio" name="reptyp" value="Consolidated" onClick="typchk(this.value);" /></td>
                </tr>
				<tr class="Dark" height="25">
                    <td align="right" height="30" valign="middle" class="tblheading">&nbsp;Variety on Hold&nbsp;</td>
           <td align="left"  valign="middle" ><input type="radio" name="reptyp" value="Variety" onClick="typchk(this.value);" /></td>
                </tr>
				<tr class="Light" height="25">
                    <td align="right" height="30" valign="middle" class="tblheading">&nbsp;Party on Hold&nbsp;</td>
           <td align="left"  valign="middle" ><input type="radio" name="reptyp" value="Party" onClick="typchk(this.value);" /></td>
               </tr>
				<tr class="Dark" height="25">
                    <td align="right" height="30" valign="middle" class="tblheading">&nbsp;Order(s) of Party on Hold&nbsp;</td>
           <td align="left"  valign="middle" ><input type="radio" name="reptyp" value="Order" onClick="typchk(this.value);" /></td>
               </tr>
              </table>
<div id="cattyp" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
 	<tr height="15" class="tblsubtitle">
    	<td colspan="6" align="center" class="tblheading">Category</td>
    </tr>
	<tr class="Dark" height="25">
		<td align="right" width="376" height="30" valign="middle" class="tblheading">&nbsp;Commercial&nbsp;</td>
		<td width="468" align="left"  valign="middle" ><input type="radio" name="repcattyp" value="Commercial" onClick="cattypchk(this.value);" /></td>
    </tr>
	<tr class="Light" height="25">
    	<td align="right" height="30" valign="middle" class="tblheading">&nbsp;TDF&nbsp;</td>
    	<td align="left"  valign="middle" ><input type="radio" name="repcattyp" value="TDF" onClick="cattypchk(this.value);" /></td>
    </tr>
	<tr class="Dark" height="25">
    	<td align="right" height="30" valign="middle" class="tblheading">&nbsp;Both&nbsp;</td>
    	<td align="left"  valign="middle" ><input type="radio" name="repcattyp" value="Both" onClick="cattypchk(this.value);" /></td>
    </tr>
</table>				
</div>
<div id="categorytyp" style="display:none"></div>		

	  
                <table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center">&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="next Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();" />
                        <input type="hidden" name="txtinv" />
                      <input type="hidden" name="flagcode" value=""/>
                      <input type="hidden" name="flagcode1" value=""/></td>
                  </tr>
              </table></td>
            <td ></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
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
