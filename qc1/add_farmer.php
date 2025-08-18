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
		 //$location=trim($_POST['produc_location']);
		$name=trim($_POST['name']);
		$txt1=trim($_POST['txt1']);
		$fname=trim($_POST['fname']);
		$address=trim($_POST['address']);
		$village=trim($_POST['village']);
		$district=trim($_POST['district']);
		//$stdno=trim($_POST['stdno']);
		$cstate=trim($_POST['cstate']);
		$mobileno=trim($_POST['mobileno']);
		
		$query=mysqli_query($link,"SELECT max(gotfarmer_code) FROM tbl_gotfarmer ") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_fetch_array($query);
		$code=$numofrecords[0]+1;
		
		 $sql_in="insert into tbl_gotfarmer (gotfarmer_name, gotfarmer_fathername, gotfarmer_address, gotfarmer_village, gotfarmer_district, gotfarmer_state, gotfarmer_mobile, gotfarmer_loc, gotfarmer_code, gotfarmer_status) values('$name',
											  '$fname',
											  '$address',
											  '$village',
											  '$district',
											  '$cstate',
											  '$mobileno',
											  '$person_list',
											  '$code',
											  '$txt1')";
											
		//exit;

		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_farmer.php?print=add'</script>";	
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
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="gotfarmer.js"></script>
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
	/*var str="";
	for (var i = 0; i <document.SearchInternal.lstselectpart.length; i++) {    //need to move this option to target element  	
	str=str+document.SearchInternal.lstselectpart.options[i].text+";";
	}					
	this.location="DefineSenior.php?lastpart="+str+"&ss="+document.SearchInternal.ss.value+"&str="+document.SearchInternal.names.value+"&"; */
	
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
	alert(tt);alert(pp);alert(xx);
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
return document.frmaddDept.hidtxt.value;
}      
function loc()
{
//window.location='add_farmer.php?lo='+document.frmaddDept.produc_location.value;
}
function f1(val)
{
	
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
	   
	   
	     if (document.frmaddDept.district.value=="") 
	 {
		alert ("Please enter District");
		document.frmaddDept.district.focus();
		return false;
	 } 
if(document.frmaddDept.district.value.charCodeAt() == 32)
	  {
		alert("District can not Start With Space!");
		return(false);
		document.frmaddDept.district.focus();
	   }
	
	   if(document.frmaddDept.cstate.value=="")
	{
	alert("Please select State");
	document.frmaddDept.cstate.focus();
	return false;
	}
	
	
	
	if(document.frmaddDept.mobileno.value=="")
	{
	alert("Please enter Mobile Number");
	document.frmaddDept.mobileno.focus();
	return false;
	}
	
	if(document.frmaddDept.mobileno.value!="")
	{
		/*if(!isNumeric(document.frmaddDept.mobileno.value))
		{
			alert("Mobile Number Allows Only Numeric value");
			document.frmaddDept.mobileno.focus();
			return(false);
		}*/
		
		if(document.frmaddDept.mobileno.value.length < 10)
		{
			alert("Mobile Number can not less than 10 digits");
			document.frmaddDept.mobileno.focus();
			return(false);
		}
	}
	var tt="";
	var pp="";
	var xx="";
	for(i=0;i<document.frmaddDept.lstselectpart.length;i++)
	{
		xx=document.frmaddDept.lstselectpart.options[i].value;
		tt=tt+document.frmaddDept.lstselectpart.options[i].value+";";
		pp=pp+xx.substring(0,xx.indexOf('('))+".\n";
		
	}
	//alert(tt);alert(pp);alert(xx);
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
	//alert(document.frmaddDept.hidtxt.value);
	if(document.frmaddDept.hidtxt.value=="")
	{
	alert("Please select location(s)");
	//document.frmaddDept.mobileno.focus();
	return false;
	}
	

	   if(confirm('You are adding Farmer:\nFarmer Name:  '+document.frmaddDept.name.value+'\nFather\'s Name: '+document.frmaddDept.fname.value+'\nAddress: '+document.frmaddDept.address.value+'\nVillage: '+document.frmaddDept.village.value+'\nMobile Number: '+document.frmaddDept.mobileno.value)) 
	   {
	   return true;
	   }
	   else
	   {
	   return false;
	   }
	//return true;
} 
function showlocs(classval)
{	//alert("hi");
	document.getElementById('txtHint').innerHTML='';		
	showUser(classval,'txtHint','item','','','','','');
}        
</SCRIPT><body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"   >
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
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
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Farmer Master - Add </td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse"  vspace=""> 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add New farmer </td>
</tr>
<tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td>
  </tr>

<tr class="Dark" height="25">
<td width="322" align="right" class="tblheading" valign="middle">&nbsp;Farmer&acute;s Name&nbsp;</td>
<td width="322" align="left"  valign="middle">&nbsp;<input name="name" type="text" size="37" class="tbltext" tabindex="0" onChange="f1(this.value);"/>&nbsp;<font color="#FF0000" >*</font></td>
</tr>
<tr class="Light" height="25">
<td align="right" class="tblheading" valign="middle">&nbsp;Father&acute;s Name&nbsp;</td>
<td align="left"  valign="middle" colspan="3">&nbsp;<input name="fname" type="text" size="37" class="tbltext" tabindex="0"  /></td>
</tr>
<tr class="Dark" height="25">
<td align="right" class="tblheading" valign="middle">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" colspan="3">&nbsp;<textarea name="address" rows="4" cols="34" class="tbltext" id="address1" tabindex="7"></textarea></td>
</tr>
<tr class="Light" height="25">
<td align="right" class="tblheading" valign="middle">&nbsp;Village&nbsp;</td>
<td align="left"  valign="middle" colspan="3">&nbsp;<input name="village" type="text" size="37" class="tbltext" tabindex="0" onChange="f2(this.value);" />&nbsp;<font color="#FF0000"  >*</font></td>
</tr>
<tr class="Dark" height="25">
<td align="right" class="tblheading" valign="middle">&nbsp;District&nbsp;</td>
<td align="left"  valign="middle" colspan="3">&nbsp;<input name="district" type="text" size="37" class="tbltext" tabindex="0" onChange="f2(this.value);" />&nbsp;<font color="#FF0000"  >*</font></td>
</tr>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>	
	<tr class="Light" height="25">
    <td  align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<select name="cstate" class="tbltext"  style="width:170px;" tabindex="" onchange="showlocs(this.value);" >
	<option value="" selected="selected">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
    <option value="<?php echo $ro_states['state_id'];?>" ><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
<td align="right" class="tblheading" valign="middle">&nbsp;Mobile Number&nbsp;</td>
<td align="left"  valign="middle" colspan="3">&nbsp;<input name="mobileno" type="text" size="15" maxlength="15" class="tbltext" tabindex="0"  />&nbsp;<font color="#FF0000" >*</font></td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Status&nbsp;</td>
<td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Active" onClick="clk(this.value);" />Active<input name="txt1" type="radio" class="tbltext" value="In-Active" onClick="clk(this.value);" />In-Active&nbsp;<font color="#FF0000" >* </font></td>
</tr>
</table>

<div id="txtHint">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#d21704" style="border-collapse:collapse">
<input type="hidden" name="totemp" value="" onChange="f6(this.value);"/>
<tr class="Dark"><td height="20" colspan="3" class="tblheading" align="center">&nbsp;Assign Farmer to Location(s)</td>
</tr>
<tr>
<td  align="center" valign="top" class="tbltext">&nbsp;<span class="tblheading">Select Location(s) </span>&nbsp;

<select name="lstfrmdb" size="12" multiple style="width:160px" class="tbltext">
</select>    
</td>
<td width="100" valign="top">
<div align="center">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p ><input name="add" src="../images/add3.gif" type="button" width="91" onClick="MoveOption(this.form.lstfrmdb,this.form.list_production_presonal)" value="&nbsp;&nbsp;&nbsp; Add -&gt;" class="tbltext">
<br><br> <input name="remove" src="../images/remove.gif" type="button" width="91"  value="&lt;- Remove &nbsp;&nbsp;&nbsp;" class="tbltext" onClick="MoveOption(this.form.list_production_presonal,this.form.lstfrmdb)">
<input type="hidden" name="hidtxt" />
</p>

<p>&nbsp;</p>
</div></td>
<td align="center" valign="top" class="tbltext">&nbsp;
<span class="tblheading">Selected Location(s) </span>&nbsp;
<select name="lstselectpart" size="12" multiple class="tbltext" id="list_production_presonal" style="width: 160px">
</select></td>
</tr>

</table>
</div>

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
