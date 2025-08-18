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
		$person_list=$_POST['hidtxt'];
		//$list_person_id=implode(";",$person_list);
		 $location=trim($_POST['produc_location']);
		 $name=trim($_POST['name']);
		 $code=trim($_POST['code']);
		 $fname=trim($_POST['fname']);
		 $address=trim($_POST['address']);
		 $village=trim($_POST['village']);
		 $land=trim($_POST['land']);
		 //$stdno=trim($_POST['stdno']);
		 $phoneno=trim($_POST['phoneno']);
		 $mobileno=trim($_POST['mobileno']);
		
		
		 $sql_in="insert into tblfarmer values('',
											  '$name',
											  '$fname',
											  '$code',
											  '$address',
											  '$village',
											  '$phoneno',
											  '$mobileno',
											  '$land',
											  '$location',
											  '$person_list')";
											
		$query=mysqli_query($link,"SELECT * FROM tblfarmer where farmername='$name' and productionlocationid='$location'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Farmer is already present for this Production Location.");
		  </script>
		 <?php }
		 else 
		 { 
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_farmer.php?print=add'</script>";	
		}
		}
	}
	
	
$curid = 1;
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>WMS - Farmer Master -Add Farmer</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
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
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">    
function MoveOption(objSourceElement, objTargetElement)   
{      
	
		var aryTempSourceOptions = new Array();        
		var x = 0;                
		//looping through source element to find selected options
		for (var i = 0; i < objSourceElement.length; i++) 
			{            
				if (objSourceElement.options[i].selected) 
				{                
					//need to move this option to target element                
					var intTargetLen = objTargetElement.length++;                
					objTargetElement.options[intTargetLen].text = objSourceElement.options[i].text;                
					objTargetElement.options[intTargetLen].value = objSourceElement.options[i].value;            
				}            
				else 
				{                
					//storing options that stay to recreate select element                
					var objTempValues = new Object();                
					objTempValues.text = objSourceElement.options[i].text;                
					objTempValues.value = objSourceElement.options[i].value;                
					aryTempSourceOptions[x] = objTempValues;                
					x++;            
				}        
			}
			//resetting length of source        
				objSourceElement.length = aryTempSourceOptions.length;        
				//looping through temp array to recreate source select element        
					for (var i = 0; i < aryTempSourceOptions.length; i++) 
					{            
						objSourceElement.options[i].text = aryTempSourceOptions[i].text;            
						objSourceElement.options[i].value = aryTempSourceOptions[i].value;            
						objSourceElement.options[i].selected = false;        
					}     
		
}

function ajy()
{
	var str="";
	for (var i = 0; i <document.SearchInternal.lstselectpart.length; i++) {    //need to move this option to target element  	
	str=str+document.SearchInternal.lstselectpart.options[i].text+";";
	}					
	this.location="DefineSenior.php?lastpart="+str+"&ss="+document.SearchInternal.ss.value+"&str="+document.SearchInternal.names.value+"&"; 
	
}
function closefun()
{
	var tt="";
	var pp="";
	var xx="";
	for(i=0;i<document.frmaddDept.lstselectpart.length;i++)
	{
		xx=document.frmaddDept.lstselectpart.options[i].value;
		tt=tt+document.frmaddDept.lstselectpart.options[i].value+";";
		pp=pp+xx.substring(0,xx.indexOf('('))+".\n";
		
	}
	//alert(pp);
   if( pp=="" )
	{ 
		
		document.frmaddDept.hidtxt.value = tt;
		
		//document.frmaddDept.action='insertsenior.php?tt='+tt+'&curid='+<?php echo $curid;?>;
	//document.frmaddDept.submit();
	 //alert("Please Select Senior from employee List");
	// return false;
  	}
	else {
	/*document.frmaddDept.action='insertsenior.php?tt='+tt+'&curid='+<?php echo $curid;?>;
	document.frmaddDept.submit();*/
	
	document.frmaddDept.hidtxt.value = tt;
	
	}
	//opener.document.getElementById(str).value=tt;
	//opener.document.getElementById(str+"link").title=pp;
	//opener.document.getElementById(str).title=pp;
	//window.close();
//return mysubmit();
}      
function loc()
{
window.location='add_farmer.php?lo='+document.frmaddDept.produc_location.value;
}
function f1(val)
{
	if(document.frmaddDept.produc_location.value=="")
	{
	alert("Select Production Location");
	 document.frmaddDept.name.value="";
	 document.frmaddDept.produc_location.focus();
	 return false;
	}
	}
	function f2(val)
{
	if(document.frmaddDept.name.value=="")
	{
	alert("Define Farmers  Name. ");
	 document.frmaddDept.village.value="";
	 document.frmaddDept.name.focus();
	 return false;
	}
	}
	/*function f3(val)
{
	if(document.frmaddDept.land.value=="")
	{
		alert("Define Land in Acras.");
	 document.frmaddDept.phoneno.value="";
	 document.frmaddDept.land.focus();
	 return false;
	}
	function f4(val)
{
	if(document.frmaddDept.phoneno.value=="")
	{
		alert("Define Phone No. ");
	 document.frmaddDept.mobileno.value="";
	 document.frmaddDept.phoneno.focus();
	 return false;
	}
function f4(val)
{
	if(document.frmaddDept.phoneno.value=="")
	{
		alert("Define Phone No. ");
	 document.frmaddDept.mobileno.value="";
	 document.frmaddDept.phoneno.focus();
	 return false;
	}*/

function mySubmit()
{
	if (document.frmaddDept.produc_location.value=="") 
	 {
		alert ("Please select Production Location");
		document.frmaddDept.produc_location.focus();
		return false;
	  }
	
	if (document.frmaddDept.name.value=="") 
	 {
		alert ("Please enter Farmer name");
		document.frmaddDept.name.focus();
		return false;
	 }
	if(document.frmaddDept.name.value.charCodeAt() == 32)
	  {
		alert("Farmer name can not Start With Space!");
		return(false);
		document.frmaddDept.name.focus();
	   } 
	  
	   if (document.frmaddDept.village.value=="") 
	 {
		alert ("Please enter Village");
		document.frmaddDept.village.focus();
		return false;
	 } 
if(document.frmaddDept.village.value.charCodeAt() == 32)
	  {
		alert("Village can not Start With Space!");
		return(false);
		document.frmaddDept.village.focus();
	   } 
	   
	   
	     if (document.frmaddDept.land.value=="") 
	 {
		alert ("Please enter land holding");
		document.frmaddDept.land.focus();
		return false;
	 } 
if(document.frmaddDept.land.value.charCodeAt() == 32)
	  {
		alert("Land can not Start With Space!");
		return(false);
		document.frmaddDept.land.focus();
	   }
	
	   if(document.frmaddDept.phoneno.value=="")
	{
	alert("Please enter Phone no. Number");
	document.frmaddDept.phoneno.focus();
	return false;
	}
	
	if(document.frmaddDept.phoneno.value!="")
	{
		if(!isNumeric(document.frmaddDept.phoneno.value))
		{
			alert("Mobile Number Allows Only Numeric value");
			document.frmaddDept.phoneno.focus();
			return(false);
		}
		
		if(document.frmaddDept.phoneno.value.length < 10)
		{
			alert("Mobile Number can not less than 10 digits");
			document.frmaddDept.phoneno.focus();
			return(false);
		}
	}
	
	if(document.frmaddDept.mobileno.value=="")
	{
	alert("Please enter Mobile Number");
	document.frmaddDept.mobileno.focus();
	return false;
	}
	
	if(document.frmaddDept.mobileno.value!="")
	{
		if(!isNumeric(document.frmaddDept.mobileno.value))
		{
			alert("Mobile Number Allows Only Numeric value");
			document.frmaddDept.mobileno.focus();
			return(false);
		}
		
		if(document.frmaddDept.mobileno.value.length < 10)
		{
			alert("Mobile Number can not less than 10 digits");
			document.frmaddDept.mobileno.focus();
			return(false);
		}
	}
	

	   if(confirm('You are adding Farmer:\nFarmer Name:  '+document.frmaddDept.name.value+'\nFarmer Code: ' +document.frmaddDept.code.value+'\nFather\'s Name: '+document.frmaddDept.fname.value+'\nAddress: '+document.frmaddDept.address.value+'\nVillage: '+document.frmaddDept.village.value+'\nLand Holding (in acres): '+document.frmaddDept.land.value+'\nPhone Number: '+document.frmaddDept.phoneno.value+'\nMobile Number: '+document.frmaddDept.mobileno.value)) 
	   {
	   return true;
	   }
	   else
	   {
	   return false;
	   }
	return true;
} 
         
</SCRIPT><body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" >
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
            <ul  id="nav"> <li><a href="index1.php"> Masters </a>
              <ul>
                  <li><a href="home_crop.php" >&nbsp;Crop&nbsp;Master</a></li>
                <li><a href="home_variety.php" >&nbsp;Variety&nbsp;Master</a></li>
				 <li><a href="home_location.php" >&nbsp;Production&nbsp;Location</a></li>
                <li><a href="home_personnel.php" >&nbsp;Production&nbsp;Personnel&nbsp;Master</a></li>
                <li><a href="home_organiser.php" >&nbsp;Organiser&nbsp;Master</a></li>
                <li><a href="home_farmer.php" >&nbsp;Farmer&nbsp;Master</a></li>
				<li><a href="companyhome.php" >&nbsp;Parameter&nbsp;Master</a></li>
				<li><a href="operator_home.php" >&nbsp;Operator&nbsp;Master</a></li>
                 <li><a href="current_year.php" >&nbsp;Year&nbsp;Management&nbsp;Master</a></li>
              </ul>
            </li>
            <li><a href="index1.php">Transactions </a>
             <ul>
                <li><a href="../Transaction/add_g.php" >&nbsp;Good&nbsp;to&nbsp;Damage</a></li>
                <li><a href="../Transaction/add_d.php" >&nbsp;Damage&nbsp;to&nbsp;Good</a></li>
                <li><a href="../Transaction/add_shortage.php" >&nbsp;Excess/Shortage</a></li>
                <li><a href="../Transaction/home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="../Transaction/home_interitem.php" >&nbsp;Inter&nbsp;Item&nbsp;Transfer</a></li>
				<li><a href="../Transaction/home_openstock.php" >&nbsp;Opening&nbsp;Stock</a></li>
              </ul>
            </li>
            <li><a href="index1.php"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
				 <li><a href="../reports/slocreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
				<li><a href="../reports/masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility </a>
			<ul><li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')" >&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Abbreviations</a></li>
              </ul>
            </li>
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
                <li> <a href="../Transaction/adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="../Transaction/help.php">Help </a>| </li>
                <li> &nbsp;<a href="../logout.php">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  
<!-- actual page start--->	
	  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Pack Size Master - Add </td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  <form name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add Pack Type </td>
</tr>
<input type="hidden" name="plocation" value="<?php echo $location?>" />
<?php
if(isset($_GET['lo'])) {
$lo= $_GET['lo'];
$sql_code="SELECT MAX(`farmercode`) FROM tblfarmer where productionlocationid='$lo'  ORDER BY `farmercode` DESC";
	 $res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$code=$row_code[0]+1;
				$code=sprintf("%004d",$code);			
			}	
		else
		{
			$code=sprintf("%004d",0001);
		}
	}
	else
	{
	$code="";
	}
?>
<tr class="Light" height="25">
<td align="right" class="tblheading" valign="middle">Pack Type &nbsp;</td>
<td align="left"  valign="middle" colspan="3">&nbsp;<input name="village" type="text" size="37" class="tbltext" tabindex="0" onChange="f2(this.value);" />&nbsp;<font color="#FF0000"  >*</font></td>
</tr>

<tr class="Dark" height="25">
<td align="right" class="tblheading" valign="middle">&nbsp;Unit Size &nbsp;</td>
<td align="left"  valign="middle" colspan="3">&nbsp;<input name="mobileno" type="text" size="15" maxlength="15" class="tbltext" tabindex="0"  onChange="f5(this.value);"/>&nbsp;<font color="#FF0000" >*</font> Kgs.</td>
</tr>
</table>

<div id="txtHint"></div>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_farmer.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>
</td>
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
