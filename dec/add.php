<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");

	
	//echo $logid="LG1";
	if(isset($_POST['frm_action'])=='submit')
	{
		
		$p_id=trim($_POST['maintrid']);
				
		/*echo "<script>window.location='add_preview.php?cropid=$p_id'</script>";	*/
		header('Location: add_preview.php?cropid='.$p_id);
			
	}

//$a="c";
	//$a="c";
	$sql_code="SELECT MAX(scode) FROM tblspdec  ORDER BY scode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="DM".$code."/".$yearid_id."/".$logid;
			}
			//}
			else
			{
				$code=1;
				$code1="DM".$code."/".$yearid_id."/".$logid;
			}
		
		//$a="TFS";
	/*$sql_code="SELECT MAX(pdnno) FROM tblarrival_sub ORDER BY pdnno DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code11=$a.$code;
		}
		else
		{
			$code=00001;
			$code11=$a.$code;
		}*/
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Decode- Transaction -Decode</title>
<link href="../include/main_dec.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="../include/validation.js"></script>
<script src="vaddresschk.js"></script>
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
function modetchk(classval)
{	//alert(document.frmaddDepartment.spcodedchk.value);
			var f=0;
			if(document.frmaddDepartment.spcodem.value=="") 
	 		{
				alert ("Please add Seed Production (SP) Code-Male");
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.spcodem.focus();
				f=1;
				return false;
	  		}
			if(document.frmaddDepartment.spcodedchk.value > 0)
			{
				alert ("Combination of Seed Production (SP) Code-Female and Seed Production (SP) Code-Male is already present in system.");
				document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.spcodef.focus();
				f=1;
				return false;
			}
			if(f==1)
			{
			return false;
			}
			else
			{
				var spcf=document.frmaddDepartment.spcodef.value;
				var spcm=document.frmaddDepartment.spcodem.value;
				showUser(classval,'vitem','item',spcf,spcm,'','','');
			}
}
	
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function upschk1()
{
	if(document.frmaddDepartment.spcodef.value=="") 
	{
		alert ("Please add Seed Production (SP) Code-Female");
		document.frmaddDepartment.spcodef.focus();
		return false;
	}
	if(document.frmaddDepartment.spcodef.value.charCodeAt() == 32)
	{
		alert("Seed Production (SP) Code-Female cannot start with a Space!");
		return false;
		document.frmaddDepartment.spcodef.focus();
	} 
	if(document.frmaddDepartment.spcodef.value.length < 5)
	{
		alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
		return false;
		document.frmaddDepartment.spcodef.focus();
	}
   	if(document.frmaddDepartment.spcodef.value!="") 
	 {
   		if(!isChar_W(document.frmaddDepartment.spcodef.value.charAt(0)))
		{
			alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
			document.frmaddDepartment.spcodef.focus();
			return false;
		} 
		if(!isChar_W(document.frmaddDepartment.spcodef.value.charAt(1)))
	  	{
			alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
		  	document.frmaddDepartment.spcodef.focus();
		  	return false;
  		}  
   		if(isNaN(document.frmaddDepartment.spcodef.value.charAt(2)))
 		{
			alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
		 	document.frmaddDepartment.spcodef.focus();
		  	return false;
		}
 		if(isNaN(document.frmaddDepartment.spcodef.value.charAt(3)))
  		{
			alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
	  		frmaddDepartment.spcodef.focus();
	  		return false;
  		} 
  		if(isNaN(document.frmaddDepartment.spcodef.value.charAt(4)))
  		{
			alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
	  		document.frmaddDepartment.spcodef.focus();
	  		return false;
  		} 
	}
	if(document.frmaddDepartment.spcodef.value!="" && document.frmaddDepartment.spcodem.value!="") 
 	{
		var spcf=document.frmaddDepartment.spcodef.value;
		var spcm=document.frmaddDepartment.spcodem.value;
		var subid=document.frmaddDepartment.subtrid.value;
		showUser(spcf,'spcdchk','spcchk',spcm,subid,'','','');
	}
	document.frmaddDepartment.txtcrop.selectedIndex=0;
	document.frmaddDepartment.txtcrop.value="";
	document.frmaddDepartment.txtvariety.selectedIndex=0;
	document.frmaddDepartment.txtvariety.value="";
}
function crop()
{
	if(document.frmaddDepartment.spcodef.value=="") 
	{
		alert ("Please add Seed Production (SP) Code-Female");
		document.frmaddDepartment.spcodem.value="";
		document.frmaddDepartment.spcodef.focus();
		return false;
	}
	if(document.frmaddDepartment.spcodem.value=="") 
	{
		alert ("Please add Seed Production (SP) Code-Male");
		document.frmaddDepartment.spcodem.focus();
		return false;
	}
	
	if(document.frmaddDepartment.spcodem.value.charCodeAt() == 32)
	{
		alert("Seed Production (SP) Code-Male cannot start with a Space!");
		return false;
		document.frmaddDepartment.spcodem.focus();
   	} 
   
   	if(document.frmaddDepartment.spcodem.value.length < 5)
  	{
		alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
		return false;
		document.frmaddDepartment.spcodem.focus();
   	}
   	if(document.frmaddDepartment.spcodem.value!="") 
 	{
	  
   		if(!isChar_W(document.frmaddDepartment.spcodem.value.charAt(0)))
		{
			alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
			document.frmaddDepartment.spcodem.focus();
			return false;
		} 
			 
		if(!isChar_W(document.frmaddDepartment.spcodem.value.charAt(1)))
	  	{
			alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
		  	document.frmaddDepartment.spcodem.focus();
		  	return false;
  		}  
		   
		if(isNaN(document.frmaddDepartment.spcodem.value.charAt(2)))
		{
			 alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
			 document.frmaddDepartment.spcodem.focus();
			 return false;
		}
		  
		if(isNaN(document.frmaddDepartment.spcodem.value.charAt(3)))
		{
			alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
			document.frmaddDepartment.spcodef.focus();
			return false;
		} 
			 
		if(isNaN(document.frmaddDepartment.spcodem.value.charAt(4)))
		{
			alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
			document.frmaddDepartment.spcodem.focus();
			return false;
		} 
	         
	}
	if(document.frmaddDepartment.spcodef.value!="" && document.frmaddDepartment.spcodem.value!="") 
 	{
		var spcf=document.frmaddDepartment.spcodef.value;
		var spcm=document.frmaddDepartment.spcodem.value;
		var subid=document.frmaddDepartment.subtrid.value;
		showUser(spcf,'spcdchk','spcchk',spcm,subid,'','','');
	}
	document.frmaddDepartment.txtcrop.selectedIndex=0;
	document.frmaddDepartment.txtcrop.value="";
	document.frmaddDepartment.txtvariety.selectedIndex=0;
	document.frmaddDepartment.txtvariety.value="";
}
			
function pform()
{	
	var flag=0;
			if(document.frmaddDepartment.spcodef.value!="" && document.frmaddDepartment.spcodem.value!="") 
 			{
				var spcf=document.frmaddDepartment.spcodef.value;
				var spcm=document.frmaddDepartment.spcodem.value;
				var subid=document.frmaddDepartment.subtrid.value;
				showUser(spcf,'spcdchk','spcchk',spcm,subid,'','','');
			}
  			if(document.frmaddDepartment.spcodef.value=="") 
	 		{
				alert ("Please add Seed Production (SP) Code-Female");
				document.frmaddDepartment.spcodef.focus();
				flag=1;
				return false;
	  		}
	  
			if(document.frmaddDepartment.spcodef.value.charCodeAt() == 32)
	  		{
				alert("Seed Production (SP) Code-Female cannot start with a Space!");
				document.frmaddDepartment.spcodef.focus();
				flag=1;
				return false;
	   		} 
	   
	   		if(document.frmaddDepartment.spcodef.value.length < 5)
	  		{
				alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodef.focus();
				flag=1;
				return false;
	   		}
	   
	    	if(document.frmaddDepartment.spcodef.value!="") 
	 		 {
	  
		   		if(!isChar_W(document.frmaddDepartment.spcodef.value.charAt(0)))
				{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					flag=1;
					return false;
				} 
			 
				if(!isChar_W(document.frmaddDepartment.spcodef.value.charAt(1)))
			  	{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					flag=1;
					return false;
		  		}  
		   
		   		 if(isNaN(document.frmaddDepartment.spcodef.value.charAt(2)))
		 		 {
					 alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					 document.frmaddDepartment.spcodef.focus();
					 flag=1;
					 return false;
		  		 }
		  
		  		if(isNaN(document.frmaddDepartment.spcodef.value.charAt(3)))
		  		{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					frmaddDepartment.spcodef.focus();
					flag=1;
					return false;
		  		} 
			 
		  		if(isNaN(document.frmaddDepartment.spcodef.value.charAt(4)))
		  		{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					flag=1;
					return false;
		  		} 
	         
	  		}
  if (document.frmaddDepartment.spcodem.value=="") 
	 	{
			alert ("Please add Seed Production (SP) Code-Male");
			document.frmaddDepartment.spcodem.focus();
			flag=1;
			return false;
	  	}
	  
		if(document.frmaddDepartment.spcodem.value.charCodeAt() == 32)
	  	{
			alert("Seed Production (SP) Code-Male cannot start with a Space!");
			frmaddDepartment.spcodem.focus();
			flag=1;
			return false;
	   	} 
	   
	   	if(document.frmaddDepartment.spcodem.value.length < 5)
	  	{
			alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
			document.frmaddDepartment.spcodem.focus();
			flag=1;
			return false;
	   	}
	   
	    if(document.frmaddDepartment.spcodem.value!="") 
	  	{
	  
		   	if(!isChar_W(document.frmaddDepartment.spcodem.value.charAt(0)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	}  
			
			if(!isChar_W(document.frmaddDepartment.spcodem.value.charAt(1)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	}  
		   
		   if(isNaN(document.frmaddDepartment.spcodem.value.charAt(2)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	}
		  
		  if(isNaN(document.frmaddDepartment.spcodem.value.charAt(3)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	}  
			
		  if(isNaN(document.frmaddDepartment.spcodem.value.charAt(4)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	} 
	         
	  	}
	//}
 		 if(document.frmaddDepartment.spcodedchk.value > 0)
			{
				alert ("Combination of Seed Production (SP) Code-Female and Seed Production (SP) Code-Male is already present in system.");
				//document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.spcodef.focus();
				f=1;
				return false;
			}
   if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		flag=1;
		return false;
	}
	 if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		flag=1;
		return false;
	}
		
		if(flag==1)
		{
			return false;
		}
		else
		{
				var a=formPost(document.getElementById('mainform'));
				//alert(a);
				showUser(a,'postingtable','mform','','','','','');
		}
}

function pformedtup()
 {	
 var flag=0;
			if(document.frmaddDepartment.spcodef.value!="" && document.frmaddDepartment.spcodem.value!="") 
 			{
				var spcf=document.frmaddDepartment.spcodef.value;
				var spcm=document.frmaddDepartment.spcodem.value;
				var subid=document.frmaddDepartment.subtrid.value;
				showUser(spcf,'spcdchk','spcchk',spcm,subid,'','','');
			}
  			if(document.frmaddDepartment.spcodef.value=="") 
	 		{
				alert ("Please add Seed Production (SP) Code-Female");
				document.frmaddDepartment.spcodef.focus();
				flag=1;
				return false;
	  		}
	  
			if(document.frmaddDepartment.spcodef.value.charCodeAt() == 32)
	  		{
				alert("Seed Production (SP) Code-Female cannot start with a Space!");
				document.frmaddDepartment.spcodef.focus();
				flag=1;
				return false;
	   		} 
	   
	   		if(document.frmaddDepartment.spcodef.value.length < 5)
	  		{
				alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodef.focus();
				flag=1;
				return false;
	   		}
	   
	    	if(document.frmaddDepartment.spcodef.value!="") 
	 		 {
	  
		   		if(!isChar_W(document.frmaddDepartment.spcodef.value.charAt(0)))
				{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					flag=1;
					return false;
				} 
			 
				if(!isChar_W(document.frmaddDepartment.spcodef.value.charAt(1)))
			  	{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					flag=1;
					return false;
		  		}  
		   
		   		 if(isNaN(document.frmaddDepartment.spcodef.value.charAt(2)))
		 		 {
					 alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					 document.frmaddDepartment.spcodef.focus();
					 flag=1;
					 return false;
		  		 }
		  
		  		if(isNaN(document.frmaddDepartment.spcodef.value.charAt(3)))
		  		{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					frmaddDepartment.spcodef.focus();
					flag=1;
					return false;
		  		} 
			 
		  		if(isNaN(document.frmaddDepartment.spcodef.value.charAt(4)))
		  		{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					flag=1;
					return false;
		  		} 
	         
	  		}
  if (document.frmaddDepartment.spcodem.value=="") 
	 	{
			alert ("Please add Seed Production (SP) Code-Male");
			document.frmaddDepartment.spcodem.focus();
			flag=1;
			return false;
	  	}
	  
		if(document.frmaddDepartment.spcodem.value.charCodeAt() == 32)
	  	{
			alert("Seed Production (SP) Code-Male cannot start with a Space!");
			frmaddDepartment.spcodem.focus();
			flag=1;
			return false;
	   	} 
	   
	   	if(document.frmaddDepartment.spcodem.value.length < 5)
	  	{
			alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
			document.frmaddDepartment.spcodem.focus();
			flag=1;
			return false;
	   	}
	   
	    if(document.frmaddDepartment.spcodem.value!="") 
	  	{
	  
		   	if(!isChar_W(document.frmaddDepartment.spcodem.value.charAt(0)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	}  
			
			if(!isChar_W(document.frmaddDepartment.spcodem.value.charAt(1)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	}  
		   
		   if(isNaN(document.frmaddDepartment.spcodem.value.charAt(2)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	}
		  
		  if(isNaN(document.frmaddDepartment.spcodem.value.charAt(3)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	}  
			
		  if(isNaN(document.frmaddDepartment.spcodem.value.charAt(4)))
		  	{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				flag=1;
				return false;
		  	} 
	         
	  	}
	//}
 		 if(document.frmaddDepartment.spcodedchk.value > 0)
			{
				alert ("Combination of Seed Production (SP) Code-Female and Seed Production (SP) Code-Male is already present in system.");
				//document.frmaddDepartment.txtcrop.selectedIndex=0;
				document.frmaddDepartment.spcodef.focus();
				f=1;
				return false;
			}
   if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		flag=1;
		return false;
	}
	 if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		flag=1;
		return false;
	}
		
		if(flag==1)
		{
			return false;
		}
		else
		{	
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformsubedt','','','','','');
		}
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}

function deleterec(v1,v2,v3)
{
	if(confirm('Do You wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,v3,'','','');
	}
	else
	{
		return false;
	}
}

function mySubmit()
{
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;	 
}

</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr>
           <td valign="top"><?php require_once("../include/arr_adm.php");?></td>
         </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dec_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/dec_rupee1.gif" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" style="border-bottom:solid; border-bottom-color:#7a9931" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Decode Manual - Add</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>
<?php
$tid=0; $subtid=0; $spcodedchk=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="35">	 </td>
<td width="909">

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Decode Manual</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="138" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="222" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
</table>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#7a9931"
 style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="5%"  align="center" valign="middle" class="tblheading">#</td>
			  <td width="12%" align="center" r valign="middle" class="tblheading">SP Code-Female</td>
              <td width="12%"  align="center" valign="middle" class="tblheading">SP Code-Male</td>
			  <td width="27%"  align="left" valign="middle" class="tblheading">&nbsp;Crop </td>
              <td width="31%"  align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
			  <td width="6%"  align="center" valign="middle" class="tblheading">Edit</td>
              <td width="7%"  align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
          </table>
		  <br />
		  <div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse"  > 
<tr class="Light" height="30">
 <td width="137" align="right"  valign="middle" class="tblheading" >SP Code-Female&nbsp;</td>
<td width="279" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="spcodef" type="text" size="5" class="tbltext" tabindex=""  onchange="upschk1(this.value);"  maxlength="5" onBlur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="162" align="right"  valign="middle" class="tblheading">SP Code-Male&nbsp;</td>
<td width="262" align="left"  valign="middle" class="tbltext">&nbsp;<input name="spcodem" type="text" size="5" class="tbltext" tabindex=""    maxlength="5"  onchange="crop(this.value);" onBlur="javascript:this.value=this.value.toUpperCase();" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>
<tr class="Light" height="30">
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
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

  <input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</table>
<div id="spcdchk"><input type="hidden" name="spcodedchk" value="<?php echo $spcodedchk;?>" /></div>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
</div>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_decode.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  