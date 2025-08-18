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
	
		
	if(isset($_REQUEST['tid']))
	{
	$tid = $_REQUEST['tid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$ups=trim($_POST['txtups']);
		$wt=trim($_POST['txtwt']);
		$uom=trim($_POST['txtuom']);
		//$crop=trim($_POST['lstselectpart']);
		$crop=trim($_POST['hidtxt']);
		
			if($wt=="Gms")
			{
			$uom=trim($_POST['txtuom']);
			}
			else if($wt=="Kgs")
			{
			$uom=trim($_POST['txtups']);
			}
		 $query=mysqli_query($link,"SELECT * FROM tblups_tdf where ups='$ups'and uom='$uom' and tid!='$tid'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
		  	$sql_in="insert into tblups_tdf(ups,wt,uom,crop) values('$ups','$wt','$uom','$crop')";
			if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
			{
				echo "<script>window.location='home_ups1.php'</script>";	
			}
		}
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration-  Master -Add UPS</title>
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
<script language="javascript" type="text/javascript">
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }function onloadfocus()
	{
	document.frmaddDepartment.txtups.focus();
	}
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function clk(opt)
{
	
	if(opt!="")
	{
		var val=document.frmaddDepartment.txtups.value;
		if(parseInt(val) < 1000)
		{
			if(opt=="Gms")
			{
				if(parseInt(val)>=1000)
				{
				alert("Invalid UPS .");
				document.getElementById('twt').selectedIndex=0;
				document.frmaddDepartment.txtups.focus();
				document.getElementById('pro').style.display="none";
				document.frmaddDepartment.txtuom.value="";
				return false;
				}
				else
				{
				document.getElementById('pro').style.display="block";
				document.frmaddDepartment.txtuom.value=parseFloat(document.frmaddDepartment.txtups.value)/1000;
				}
			}
			else
			{
				if(parseInt(val)>=100)
				{
				alert("Invalid UPS .");
				document.getElementById('twt').selectedIndex=0;
				document.frmaddDepartment.txtups.focus();
				document.getElementById('pro').style.display="none";
				document.frmaddDepartment.txtuom.value="";
				return false;
				}
				else
				{
				document.getElementById('pro').style.display="none";
				}
			}	
		}
		else
		{
				alert("Invalid UPS.");
				document.getElementById('twt').selectedIndex=0;
				document.getElementById('pro').style.display="none";
				document.frmaddDepartment.txtuom.value="";
				document.frmaddDepartment.txtups.focus();
				return false;
		}
	}
	else
	{
		alert("Please select UPS First");
		document.frmaddDepartment.txtups.value="";
	}
}
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
	for(i=0;i<document.frmaddDepartment.lstselectpart.length;i++)
	{
		xx=document.frmaddDepartment.lstselectpart.options[i].value;
		tt=tt+document.frmaddDepartment.lstselectpart.options[i].value+";";
		pp=pp+xx.substring(0,xx.indexOf('('))+".\n";
		
	}
	//alert(pp);alert(tt);
   if( pp=="" )
	{ 
		
		document.frmaddDepartment.hidtxt.value = tt;
		
		//document.frmaddDepartment.action='insertsenior.php?tt='+tt+'&curid='+<?php echo $curid;?>;
	//document.frmaddDepartment.submit();
	 //alert("Please Select Senior from employee List");
	// return false;
  	}
	else {
	/*document.frmaddDepartment.action='insertsenior.php?tt='+tt+'&curid='+<?php echo $curid;?>;
	document.frmaddDepartment.submit();*/
	
	document.frmaddDepartment.hidtxt.value = tt;
	
	}
	//opener.document.getElementById(str).value=tt;
	//opener.document.getElementById(str+"link").title=pp;
	//opener.document.getElementById(str).title=pp;
	//window.close();
//return mysubmit();
}    
function mySubmit()
{ 
		
		if(document.frmaddDepartment.txtups.value=="")
	{
	alert("Please Enter UPS");
	
	document.frmaddDepartment.txtups.focus();
	return false;
	}
	if(document.frmaddDepartment.txtups.value.length <=0 )
		{
			alert("UPS cannot be Zero");
			document.frmaddDepartment.txtups.focus();
			return(false);
		}
	if(document.frmaddDepartment.txtups.value.charCodeAt() == 32)
	{
	alert("UPS cannot start with space.");
	document.frmaddDepartment.txtups.focus();
	return false;
	}
	
		if(document.frmaddDepartment.txtwt.value=="")
	{
	alert("Please Select UoM");
	document.frmaddDepartment.txtwt.focus();
	return false;
	}
	
return true;
}
function nopchk(val1)
{
	document.frmaddDepartment.txtwt.value="";
	document.frmaddDepartment.txtuom.value="";
}
</script>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr>
           <td valign="top"><?php require_once("../include/arr_adm1.php");?></td>
         </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="600" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">	<!-- actual page start--->	
	  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="5398ee" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="5398ee" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="4ea1e1" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;UPS Master - Add UPS </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();"> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1"style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading">Add a NEW UPS </td>
</tr> 
<tr height="10">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Light" height="25">
<td width="388" align="right" height="30" valign="middle" class="tblheading">Unit Pack Size&nbsp;</td>
<td width="356" align="left"  valign="middle">&nbsp;<input name="txtups" type="text" size="6" class="tbltext" tabindex="0" maxlength="6" onKeyPress="return isNumberKey(event)" onChange="nopchk(this.value);"   />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

</tr>


<tr class="Light" height="25">
          <td align="right" valign="middle" class="tblheading">&nbsp;Unit of Measurement&nbsp;</td>
           <td align="left"  valign="middle" colspan="3"  class="tblbutn">&nbsp;<select name="txtwt" id="twt" class="tbltext"  style="width:150px;background-color:#CCCCCC" tabindex="" onChange="clk(this.value);">
		<option value="">--Select --</option>
		<option value="Gms">Gms</option>
		<option value="Kgs">Kgs</option>
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
</table>
<div id="pro" style="display:none">
 <table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="25" >
 <td width="390" align="right" valign="middle" class="tblheading">UoM in Kgs.&nbsp;</td>
 <td width="354" align="left"  valign="middle"  class="tblbutn">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" maxlength="10"  style="width:150px;background-color:#CCCCCC" readonly="true"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
</table>
</div>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1"style="border-collapse:collapse" >
<tr>
</tr>
<tr>
<td width="350" height="300" align="center" valign="top">&nbsp;<span class="tblheading">Select Crop </span>&nbsp;
<?php
  $test=mysqli_query($link,"SELECT * FROM tblcrop order by cropname");
?>
<select name="lstfrmdb" size="22" multiple style="width:260px" class="tbltext">
<?php
   while($rowstr = mysqli_fetch_array($test))
	{
 ?>
<option value="<?php echo $rowstr['cropid']?>" ><?php echo $rowstr['cropname'];?></option>
<?php
	} 
    ?>	
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
<p>&nbsp;</p>
</div></td>
<td width="330" height="300" align="center" valign="top">&nbsp;
<span class="tblheading">List of Selected Crop</span>&nbsp;
<select name="lstselectpart" size="22" style="width:260px"class="tbltext" id="list_production_presonal">
<?php
	$sql_p1=mysqli_query($link,"select * from tblcrop");
	$total_pl=mysqli_num_rows($sql_p1);
if($total_pl >0)
{
	$row=mysqli_fetch_row($total_pl);
 	$person=$row['0'];
 if( ! empty($person)) {
 $personid=explode(";",$person);
 $zz=count($personid);
for($i=0 ; $i < $zz ; $i++)
{
$personquerylist=mysqli_query($link,"SELECT cropname, cropid FROM tblcrop where cropid='$personid[$i]'");
?>
<?php	while($noticia = mysqli_fetch_array($personquerylist)) { ?>
<option value="<?php echo $noticia['cropid'];?>" selected="true"><?php echo $noticia['cropname'];?></option>
<?php }?><?php } }}?>
</select></td>
</tr>
</table>

<table align="center" width="509" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td width="489" align="center" valign="top"><a href="home_ups1.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<!--<a href="javascript:document.frmaddDepartment.reset();"><img src="../images/reset.gif" alt="reset"  border="0" style="display:inline;cursor:hand;"></a>&nbsp;--><input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="closefun();" border="0" style="display:inline;cursor:hand;"></td>
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
