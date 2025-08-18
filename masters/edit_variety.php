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
	
	if(isset($_REQUEST['varietyid']))
	{
	 $id = $_REQUEST['varietyid'];
	}
	if(isset($_REQUEST['page']))
	{
	 $pageid = $_REQUEST['page'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$txtdsp=trim($_POST['txtdsp']);		
		$cropname=trim($_POST['crop']);
		$vname=trim($_POST['vname']);
		$opt=trim($_POST['txtopt']);
		$type=trim($_POST['txtvt']);
		$gm=trim($_POST['flagcode']);
		$wb=trim($_POST['code1']);
		$nop=trim($_POST['code2']);
	 	$wtwb=trim($_POST['code3']);
	 	$mp=trim($_POST['code4']);
		$mpytype=trim($_POST['code5']);
	 	$wtmp=trim($_POST['code6']);
		$nowb=trim($_POST['code7']);
		$mptnop=trim($_POST['code8']);
		$expdt=trim($_POST['expdt']);
	  	$moilars=trim($_POST['moilars']);
		$txtleduration=trim($_POST['txtleduration']);
		
		$query24=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='$id' and actstatus='Active'") or die("Error: " . mysqli_error($link));
		$row24=mysqli_fetch_array($query24);
		$ovarietyname=$row24['popularname'];
		
		$query11=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$cropname."'") or die("Error: " . mysqli_error($link));
		$row=mysqli_fetch_array($query11);
		$cname=$row['cropname'];
				
		 $query=mysqli_query($link,"SELECT * FROM tblvariety where popularname='$vname' and varietyid!='$id' and actstatus='Active'") or die("Error: " . mysqli_error($link));
		// exit;
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="UPDATE tblvariety SET popularname='$vname' , cropname='$cropname', cropid='$cname',opt='$opt',vt='$type', gm='$gm',wbtype ='$wb',wtnop='$nop',wtnopkg='$wtwb',mtyp='$mp',mtype='$mpytype',wtmp='$wtmp' ,nowb='$nowb', gsdis='$txtdsp', expdt='$expdt', moinlors='$moilars', mptnop='$mptnop', leduration='$txtleduration' where varietyid='$id'";
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
		$sql_in24="UPDATE tblarrival_sub SET lotvariety='$vname' where lotvariety='$ovarietyname'";
		$xaxa=mysqli_query($link,$sql_in24)or die(mysqli_error($link));
		$sql_in240="UPDATE tblarr_sloc SET lotvariety='$vname' where lotvariety='$ovarietyname'";
		$xaa=mysqli_query($link,$sql_in240)or die(mysqli_error($link));
		}	
			echo "<script>window.location='home_variety.php?page=$pageid'</script>";	
	  }	
	}
		
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administration- Variety Master -Edit Variety  Master</title>
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
<script type="text/javascript" language="javascript">
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

/*function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }*/


function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function clk(val12)
{
//alert(val12);
//var aa='fetchk_'+[val12];
if (document.form1.crop.value=="") 
	 {
		alert ("Please Select Crop Name");
		document.getElementById('fetchk_'+[val12]).checked=false;
		document.form1.crop.focus();
		return false;
	  }
	 if(document.form1.crop.value.charCodeAt() == 32)
	  {
		alert("Crop Name Should Not Start With Space!");
		return(false);
		document.form1.crop.focus();
	   } 
	if(document.form1.vname.value=="")
	{
	alert("Please Enter Variety Name ");
	document.form1.vname.focus();
	return false;
	}
	if(document.form1.vname.value.charCodeAt() == 32)
	{
	alert("Variety Name cannot start with space.");
	document.form1.vname.focus();
	return false;
	}
	
	  if(document.form1.txtvt.value=="")
	{
	alert("Please Selcet Variety Type ");
	document.form1.txtvt.focus();
	return false;
	}
	if (document.form1.txtopt.value=="") 
	 {
		alert ("Please Select GOT At Arrival");
		document.form1.txtopt.focus();
		return false;
	  }
	  
	    if (document.form1.txtdsp.value=="") 
	 {
		alert ("Please Select GS Sample Keeping Duration");
		document.form1.txtdsp.focus();
		return false;
	  }
  if(document.getElementById('fetchk_'+[val12]).checked == true)
{
//var val12; 
document.getElementById('itm_'+[val12]).disabled=false;
//document.getElementById('id2_'+[val12]).disabled=false;
document.getElementById('id3_'+[val12]).disabled=false;

}
else
{
document.getElementById('itm_'+[val12]).selectedIndex=0;
document.getElementById('id2_'+[val12]).selectedIndex=0;
document.getElementById('id3_'+[val12]).selectedIndex=0;
document.getElementById('id3_'+[val12]).disabled=true;
document.getElementById('itm_'+[val12]).disabled=true;
document.getElementById('id2_'+[val12]).disabled=true;
document.getElementById('id5_'+[val12]).value="";
document.getElementById('id4_'+[val12]).selectedIndex=0;
document.getElementById('id4_'+[val12]).disabled=true;
document.getElementById('id6_'+[val12]).value="";
document.getElementById('id7_'+[val12]).value="";
document.getElementById('id6_'+[val12]).style.backgroundColor="#cccccc";

}

}

function clk1(va12 , val11)
{
//alert(va12);
//alert(document.getElementById('itm_'+[va12]).value);	  
  if(document.getElementById('itm_'+[va12]).value=="Yes")
{

document.getElementById('id2_'+[va12]).disabled=false;
}
else
{
document.getElementById('id2_'+[va12]).disabled=true;
document.getElementById('itm_'+[va12]).value==""
document.getElementById('id5_'+[va12]).value="";
document.getElementById('id7_'+[va12]).value="";
//document.getElementById('itm_'+[va12]).selectedIndex=0;
document.getElementById('id2_'+[va12]).selectedIndex=0;
}

}

function clk2(va12 , up, uo)
{
//alert(document.getElementById('id2_'+[va12]).value);
  if(document.getElementById('id2_'+[va12]).value!="")
{
document.getElementById('id5_'+[va12]).value=uo*parseFloat(up);
document.getElementById('id2_'+[va12]).disabled=false;
}
else
{
document.getElementById('id2_'+[va12]).disabled=true;
}

}
function clk3(va3 , va33)
{

  if(document.getElementById('id3_'+[va3]).value=="Yes")
{

document.getElementById('id4_'+[va3]).disabled=false;
document.getElementById('id6_'+[va3]).style.backgroundColor="#ffffff";
}
else
{
//document.getElementById('id3_'+[va3]).selectedIndex=0;
document.getElementById('id4_'+[va3]).selectedIndex=0;
//document.getElementById('id3_'+[va3]).disabled=true;
document.getElementById('id4_'+[va3]).disabled=true;
document.getElementById('id6_'+[va3]).value="";
document.getElementById('id7_'+[va3]).value="";
document.getElementById('id6_'+[va3]).style.backgroundColor="#cccccc";
}

}

function clk4(va12 , up, uo)
{
//alert(document.getElementById('id2_'+[va12]).value);
  if(document.getElementById('id2_'+[va12]).value=="uo")
{
document.getElementById('id6_'+[va12]).disabled=true;

}
else
{
document.getElementById('id6_'+[va12]).disabled=false;
}

}
function calc(va133, up1, uo1)
{
	if(uo1>0 && uo1<=99.999)
	{
	var flg=0;
	var valwb=document.getElementById('id5_'+[va133]).value;
	//alert(valwb);
	var nop2=parseFloat(uo1)/parseFloat(valwb);
	
	var nzzz=Math.round(nop2*100)/100;
	var zz=nzzz+'';
	var zzz=zz.split(".");
	if(zzz[1] > 0)
	{
		alert("Enter Valid Wt. in Master Pack.\nNoWB can not be fractional")
		document.getElementById('id6_'+[va133]).value="";
		flg=1;
		return false;
	}
	
	var n=up1*1000;
	var nop=parseFloat(uo1)*parseFloat(1000/n);
	var nzzz=Math.round(nop*100)/100;
	var zz=nzzz+'';
	var zzz=zz.split(".");
	if(zzz[1] > 0)
	{
		alert("Enter Valid Wt. in Master Pack.\nPouch can not be fractional")
		document.getElementById('id6_'+[va133]).value="";
		flg=1;
		return false;
	}
	
	if(flg==0 && document.getElementById('id5_'+[va133]).value!="")
	{
		 document.getElementById('id7_'+[va133]).value=Math.round((parseFloat(uo1)/parseFloat(valwb))*100)/100;
	}
	document.getElementById('mptnop_'+[va133]).value=nop;
	}
	else
	{
	alert("Wt. in Master Pack cannot be Zero(0) or less and cannot be more than 99.999");
	document.getElementById('id6_'+[va133]).value="";
	document.getElementById('mptnop_'+[va133]).value="";
	return false;
	}
}
function onloadfocus()
	{
	document.form1.crop.focus();
	}
 
function f1(val)
{
	if(document.form1.crop.value=="")
	{
	alert("select Crop Name");
	 document.form1.vname.value="";
	 document.form1.crop.focus();
	 return false;
	}
	}
	function f2(val)
{
	if(document.form1.vname.value=="")
	{
	alert("Add Variety Name ");
	 document.form1.txt.value="";
	 document.form1.vname.focus();
	 return false;
	}
	}
	
function expdtqc(expval)
{
if(document.form1.txtdsp.value=="") 
{
	alert ("Please Select GS Sample Keeping Duration");
	document.form1.txtdsp.focus();
	document.form1.expdt.value="";
	return false;
}
if(expval <=0 || expval >=100)
{
	alert("Invalid Expected Date of QC Results");
	document.form1.expdt.value="";
	return false;
}
}		

function mySubmit()
{
document.form1.flagcode.value = "";
var z=document.form1.vname.value;
var x=z.substr(1);
var y=document.form1.vname.value.charAt(0);
var zz=y.toUpperCase();
document.form1.vname.value=zz+x;
//return false;
if (document.form1.crop.value=="") 
	 {
		alert ("Please Select Crop Name");
		document.form1.crop.focus();
		return false;
	  }
if(document.form1.crop.value.charCodeAt() == 32)
	  {
		alert("Crop Name Should Not Start With Space!");
		return(false);
		document.form1.crop.focus();
	   } 
if(document.form1.vname.value=="")
	{
	alert("Please Enter Variety Name ");
	document.form1.vname.focus();
	return false;
	}
if(document.form1.vname.value.charCodeAt() == 32)
	{
	alert("Variety Name cannot start with space.");
	document.form1.vname.focus();
	return false;
	}
	
if(document.form1.txtvt.value=="")
	{
	alert("Please Selcet Variety Type ");
	document.form1.txtvt.focus();
	return false;
	}

if (document.form1.txtopt.value=="") 
	 {
		alert ("Please Select GOT At Arrival");
		document.form1.txtopt.focus();
		return false;
	  }
	  if (document.form1.txtdsp.value=="") 
	 {
		alert ("Please Select GS Sample Keeping Duration");
		document.form1.txtdsp.focus();
		return false;
	  }
  if (document.form1.expdt.value=="") 
	 {
		alert("Invalid Expected Days of QC Results");
		document.form1.expdt.focus();
		return false;
	  }
	  if (document.form1.expdt.value<=0) 
	 {
		alert("Invalid Expected Days of QC Results");
		document.form1.expdt.focus();
		return false;
	  }
	  	  
var cnt1=0;cnt2=0;cnt3=0;cnt4=0;cnt5=0;
for (var i = 0; i < document.form1.fet.length; i++) 
{          
		 //alert(document.getElementById('mptnop_'+[i+1]).value);
		  if(document.form1.fet[i].checked == true)
			{
				if(document.form1.flagcode.value =="")
				{
				document.form1.flagcode.value=document.form1.fet[i].value;
				}
				else
				{
				document.form1.flagcode.value = document.form1.flagcode.value +','+document.form1.fet[i].value;
				}
				
				if(document.form1.txtwb[i].value=="")cnt1++;
				
				if(document.form1.code1.value =="")
				{
				document.form1.code1.value=document.form1.txtwb[i].value;
				}
				else
				{
				document.form1.code1.value = document.form1.code1.value +','+document.form1.txtwb[i].value;
				}
				
				if(document.form1.txtwb[i].value=="Yes" && document.form1.txtnop[i].value=="")cnt2++;
				
				if(document.form1.code2.value =="")
				{
				document.form1.code2.value=document.form1.txtnop[i].value;
				}
				else
				{
				document.form1.code2.value = document.form1.code2.value +','+document.form1.txtnop[i].value;
				}
				
				if(document.form1.code3.value =="")
				{
				document.form1.code3.value=document.form1.txtwb1[i].value;
				}
				else
				{
				document.form1.code3.value = document.form1.code3.value +','+document.form1.txtwb1[i].value;
				}
				
				
				if(document.form1.txtmp[i].value=="")cnt3++;
				
				if(document.form1.code4.value =="")
				{
				document.form1.code4.value=document.form1.txtmp[i].value;
				}
				else
				{
				document.form1.code4.value = document.form1.code4.value +','+document.form1.txtmp[i].value;
				}
				
				if(document.form1.txtmp[i].value=="Yes" && document.form1.txtmpt[i].value=="")cnt4++;
				
				if(document.form1.code5.value =="")
				{
				document.form1.code5.value=document.form1.txtmpt[i].value;
				}
				else
				{
				document.form1.code5.value = document.form1.code5.value +','+document.form1.txtmpt[i].value;
				}
				
				if(document.form1.txtmp[i].value=="Yes" && document.form1.txtmpt[i].value!="" && document.form1.txt1[i].value=="")cnt5++;
				
				if(document.form1.code6.value =="")
				{
				document.form1.code6.value=document.form1.txt1[i].value;
				}
				else
				{
				document.form1.code6.value = document.form1.code6.value +','+document.form1.txt1[i].value;
				}
								
				if(document.form1.code7.value =="")
				{
				document.form1.code7.value=document.form1.txt2[i].value;
				}
				else
				{
				document.form1.code7.value = document.form1.code7.value +','+document.form1.txt2[i].value;
				}
								
				if(document.form1.code8.value =="")
				{
				document.form1.code8.value=document.getElementById('mptnop_'+[i+1]).value;
				}
				else
				{
				document.form1.code8.value = document.form1.code8.value +','+document.getElementById('mptnop_'+[i+1]).value;
				}
			}
}

//alert(cnt1);alert(cnt2);alert(cnt3);alert(cnt4);alert(cnt5);
if(cnt1 > 0)
{
alert("Select Window Box");
return false;
}
if(cnt2 > 0)
{
alert("Select No. of Packs");
return false;
}
if(cnt3 > 0)
{
alert("Select Master Pack");
return false;
}
if(cnt4 > 0)
{
alert("Select Master Pack Type");
return false;
}
if(cnt5 > 0)
{
alert("Enter Wt. in Master Pack");
return false;
}
//document.getElementById('id5_'+[flagcode]).value = document.from1.txtwb1.value;
//alert(document.form1.txtwb1.value);
if(document.form1.flagcode.value == "")
{
alert("Please select UPS");
return false;
}
	 return true;
}

function boilarschk(valle)
{
	if(document.form1.txtstduration.value=="") 
	{
		alert("Please enter Settlement Duration");
		document.form1.txtleduration.valu="";
		document.form1.txtstduration.focus();
		return false;
	}
}
</script>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_adm1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  
<!-- actual page start--->	
	<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  >  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Variety Master - Edit </td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
  <input name="frm_action" value="submit" type="hidden"> 
  <input type="hidden" name="varietyid" value="<?php echo $id;?>" />
  <input type="hidden" name="cropid" value="<?php echo $cid;?>" />
   <input name="txt" value="" type="hidden"> 
   <input type="hidden" name="pageid" value="<?php echo $pageid;?>" />
  	
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

  <table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Edit Variety Master</td>
</tr>
<tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td>
  </tr>
     <?php
	 $sql1=mysqli_query($link,"select * from tblvariety where varietyid='".$id."' and actstatus='Active' order by gm Asc")or die(mysqli_error($link));
  	$row=mysqli_fetch_array($sql1);
	$total=mysqli_num_rows($sql1);	
	 //echo $row['cropname'];
	//$row_qry['wt'];
		 ?> 
		  <?php
$quer3=mysqli_query($link,"SELECT DISTINCT cropname,cropid FROM tblcrop order by cropname Asc"); 
?>
<tr class="Light" height="25" >
<td width="240" align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
<td align="left"  valign="middle">&nbsp;<select class="tbltext" name="crop" style="width:170px;" tabindex="" >
    <option value="">--Select--</option>
    <?php while($noticia3 = mysqli_fetch_array($quer3)) { ?>
    <option <?php if($noticia3['cropid']==$row['cropname']) { echo "Selected"; }?> value="<?php echo $noticia3['cropid'];?>" />  
    <?php echo $noticia3['cropname'];?>
    <?php } ?> <input type="hidden" name="cropname" value="<?php echo $noticia3['cropname'];?>" />
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Variety Name&nbsp;</td>
<td align="left"  valign="middle" >&nbsp;<input name="vname" type="text" size="30" class="tbltext" tabindex="0" value="<?php echo $row['popularname'];?>" "f1(this.value);"  maxlength="30" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000" >*</font>	</td>
</tr>

<tr class="Light" height="25">
         
		<td  align="right"  valign="middle" class="tblheading">Variety Type&nbsp;</td>
<td width="235" align="left"  valign="middle">&nbsp;<select name="txtvt" class="tbltext"  style="width:110px;" tabindex=""><option value="" selected>--Select Type--</option>
		<option value="Hybrid" <?php if($row['vt']=="Hybrid") echo "selected"; ?>>Hybrid</option>
		<option value="OP" <?php if($row['vt']=="OP") echo "selected"; ?>>OP</option></select>&nbsp;<font color="#FF0000" >*</font></td>
		 <td align="right" valign="middle" class="tblheading">&nbsp;Auto GOT at  Arrival&nbsp;</td>
           <td align="left"  valign="middle"  class="tblbutn">&nbsp;<select name="txtopt" class="tbltext"  style="width:100px;" tabindex="" >
		><option value="" selected>--Select--</option>
		<option value="Mandatory" <?php if($row['opt']=="Mandatory") echo "selected"; ?>>Mandatory</option>
		<option value="Optional" <?php if($row['opt']=="Optional") echo "selected"; ?>>Optional</option>
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
			
		<tr class="Dark" height="25">
		<td width="240" align="right"  valign="middle" class="tblheading">Guard Sample Retention Period (GSRP)&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select name="txtdsp" class="tbltext"  style="width:80px;" tabindex="" >
		<option value="">---Select--</option>
		<option value="6" <?php if($row['gsdis']=="6"){ echo "Selected";}  ?>>6</option>
		<option value="12" <?php if($row['gsdis']=="12"){ echo "Selected";}  ?>>12</option>
		<option value="18" <?php if($row['gsdis']=="18"){ echo "Selected";}  ?>>18</option>
		<option value="24" <?php if($row['gsdis']=="24"){ echo "Selected";}  ?>>24</option>
		</select>&nbsp;<font color="#FF0000" >*</font>&nbsp;Months</td>
		<td width="209" align="right" valign="middle" class="tblheading">&nbsp;Expected Days of QC Result (EDOR)&nbsp;</td>
         <td width="256"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="expdt" type="text" size="1" class="tbltext" tabindex="0" onChange="expdtqc(this.value);" onKeyPress="return isNumberKey(event)" value="<?php echo $row['expdt'];?>"  maxlength="2" />&nbsp;<font color="#FF0000" >*</font>&nbsp;From Date of Sample Collection</td>
		</tr>
			<tr class="Dark" height="25">
		<td width="234" align="right"  valign="middle" class="tblheading">Merger of Inorganic Lots at Raw Stage&nbsp;</td>
		<td align="left"  valign="middle" class="tbltext"><input type="radio" <?php if($row['moinlors']=="Yes"){ echo "checked";}  ?> name="moilars" value="Yes" class="tbltext" />Allowed&nbsp;&nbsp;<input type="radio" <?php if($row['moinlors']=="No"){ echo "checked";}  ?> name="moilars" value="No" class="tbltext" />Not-allowed&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
		<td width="213" align="right" valign="middle" class="smalltblheading">&nbsp;Life Expectancy (LE)&nbsp;</td>
        <td width="252"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtleduration" type="text" size="2" class="smalltbltext" tabindex="0" onChange="boilarschk(this.value);" onKeyPress="return isNumberKey(event)"  maxlength="3"  value="<?php echo $row['leduration'];?>" />&nbsp;<font color="#FF0000" >*</font>&nbsp;Months&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="tblsubtitle" height="15">
  <td colspan="15" align="center" class="tblheading">UPS Allocation </td>
</tr>
<tr class="tblsubtitle" height="15">
  <td width="29"  align="center" class="tblheading"># </td>
  <td width="41"  align="center" class="tblheading">UPS</td>
  <td width="42"  align="center" class="tblheading">UOM</td>
  <td width="35"  align="center" class="tblheading">UPS in Kgs.</td>
  <td width="56"  align="center" class="tblheading">Select</td>
  <td width="113"  align="center" class="tblheading">Window Box</td>
  <td width="116"  align="center" class="tblheading">No. of Packs</td>
  <td width="73"  align="center" class="tblheading">Wt. in WB</td>
  <td width="110"  align="center" class="tblheading">Master Pack</td>
  <td width="148"  align="center" class="tblheading">Master Pack Type</td>
   <td width="94"  align="center" class="tblheading">Wt. in Master Pack</td>
  <td width="67"  align="center" class="tblheading">NoWB</td>
</tr>
  <?php
$srno=1;
	$sql_sel="select * from tblups order by uom Asc";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	 $total=mysqli_num_rows($res);
	if($total >0) 
	{ 
	
	while($row12=mysqli_fetch_array($res))
	{
	$x=0;
	if ($srno%2 != 0)
	{
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row12['ups'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row12['wt'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row12['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet" onClick="clk('<?php echo $srno?>');" id="fetchk_<?php echo $srno?>"<?php $p1_array=explode(",",$row['gm']);
			$i=0; $z="";
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == $row12['uid']) { $i++; $z=$val1.",".$x;}
				}$x++; 
				}
				if($i!=0) { echo "checked";}?>  value="<?php echo $row12['uid'];?>"/></td>
				
<?php
	$p_array=explode(",",$z);
	$x=$p_array[1];
	if( $i!=0)
	{
?>		
				<td valign="middle" class="tbltext" align="center"><select name="txtwb" class="tbltext"  style="width:80px;" tabindex="" id="itm_<?php echo $srno?>"  onChange="clk1('<?php echo $srno?>',this.value);" >
		<option value=""  >---Select--</option>
		 <option value="Yes" <?php $p1_array=explode(",",$row['wbtype']); if($i!=0 && $p1_array[$x]=="Yes"){ echo "Selected";} ?> >Yes</option>
	<option value="No" <?php $p1_array=explode(",",$row['wbtype']); if($i!=0 && $p1_array[$x]=="No"){ echo "Selected";} ?> >No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		<?php
		$p1_array=explode(",",$row['wbtype']); if($i!=0 && $p1_array[$x]=="Yes"){
		?>
		<td valign="middle" class="tbltext" align="center"><select name="txtnop" class="tbltext"  style="width:80px;" tabindex=""  id="id2_<?php echo $srno?>"  onchange="clk2('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);">
		<option value="" >---Select--</option>
		 <option value="1" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="1"){ echo "Selected";} ?> >1</option>
		  <option value="2" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="2"){ echo "Selected";} ?> >2</option>
		  <option value="3" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="3"){ echo "Selected";} ?> >3</option>
		  <option value="3" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="4"){ echo "Selected";} ?> >4</option>
		<option value="5" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="5"){ echo "Selected";} ?>>5</option>
		<option value="6" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="6"){ echo "Selected";} ?>>6</option>
		<option value="7" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="7"){ echo "Selected";} ?>>7</option>
		<option value="8" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="8"){ echo "Selected";} ?>>8</option>
		<option value="9" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="9"){ echo "Selected";} ?>>9</option>
		<option value="10" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="10"){ echo "Selected";} ?>>10</option>
		<option value="11" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="11"){ echo "Selected";} ?>>11</option>
		<option value="12" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="12"){ echo "Selected";} ?>>12</option>
		<option value="13" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="13"){ echo "Selected";} ?>>13</option>
		<option value="14" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="14"){ echo "Selected";} ?>>14</option>
		<option value="15" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="15"){ echo "Selected";} ?>>15</option>
		<option value="16" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="16"){ echo "Selected";} ?>>16</option>
		<option value="17" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="17"){ echo "Selected";} ?>>17</option>
		<option value="18" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="18"){ echo "Selected";} ?>>18</option>
		<option value="19" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="19"){ echo "Selected";} ?>>19</option>
		<option value="20" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="20"){ echo "Selected";} ?>>20</option>
		 <option value="21" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="21"){ echo "Selected";} ?> >21</option>
		  <option value="22" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="22"){ echo "Selected";} ?> >22</option>
		  <option value="23" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="23"){ echo "Selected";} ?> >23</option>
		  <option value="24" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="24"){ echo "Selected";} ?> >24</option>
		<option value="25" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="25"){ echo "Selected";} ?>>25</option>
		<option value="26" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="26"){ echo "Selected";} ?>>26</option>
		<option value="27" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="27"){ echo "Selected";} ?>>27</option>
		<option value="28" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="28"){ echo "Selected";} ?>>28</option>
		<option value="29" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="29"){ echo "Selected";} ?>>29</option>
		<option value="30" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="30"){ echo "Selected";} ?>>30</option>
		<option value="31" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="31"){ echo "Selected";} ?>>31</option>
		<option value="32" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="32"){ echo "Selected";} ?>>32</option>
		<option value="33" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="33"){ echo "Selected";} ?>>33</option>
		<option value="34" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="34"){ echo "Selected";} ?>>34</option>
		<option value="35" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="35"){ echo "Selected";} ?>>35</option>
		<option value="36" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="36"){ echo "Selected";} ?>>36</option>
		<option value="37" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="37"){ echo "Selected";} ?>>37</option>
		<option value="38" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="38"){ echo "Selected";} ?>>38</option>
		<option value="39" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="39"){ echo "Selected";} ?>>39</option>
		<option value="40" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="40"){ echo "Selected";} ?>>40</option>
		 <option value="41" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="41"){ echo "Selected";} ?> >41</option>
		  <option value="42" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="42"){ echo "Selected";} ?> >42</option>
		  <option value="43" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="43"){ echo "Selected";} ?> >43</option>
		  <option value="44" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="44"){ echo "Selected";} ?> >44</option>
		<option value="45" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="45"){ echo "Selected";} ?>>45</option>
		<option value="46" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="46"){ echo "Selected";} ?>>46</option>
		<option value="47" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="47"){ echo "Selected";} ?>>47</option>
		<option value="48" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="48"){ echo "Selected";} ?>>48</option>
		<option value="49" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="49"){ echo "Selected";} ?>>49</option>
		<option value="50" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="50"){ echo "Selected";} ?>>50</option>
		<option value="51" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="51"){ echo "Selected";} ?>>51</option>
		<option value="52" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="52"){ echo "Selected";} ?>>52</option>
		<option value="53" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="53"){ echo "Selected";} ?>>53</option>
		<option value="54" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="54"){ echo "Selected";} ?>>54</option>
		<option value="55" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="51"){ echo "Selected";} ?>>55</option>
		<option value="56" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="56"){ echo "Selected";} ?>>56</option>
		<option value="57" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="57"){ echo "Selected";} ?>>57</option>
		<option value="58" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="58"){ echo "Selected";} ?>>58</option>
		<option value="59" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="59"){ echo "Selected";} ?>>59</option>
		<option value="60" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="60"){ echo "Selected";} ?>>60</option>
		 <option value="61" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="61"){ echo "Selected";} ?> >61</option>
		  <option value="62" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="62"){ echo "Selected";} ?> >62</option>
		  <option value="63" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="63"){ echo "Selected";} ?> >63</option>
		  <option value="64" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="64"){ echo "Selected";} ?> >64</option>
		<option value="65" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="65"){ echo "Selected";} ?>>65</option>
		<option value="66" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="66"){ echo "Selected";} ?>>66</option>
		<option value="67" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="67"){ echo "Selected";} ?>>67</option>
		<option value="68" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="68"){ echo "Selected";} ?>>68</option>
		<option value="69" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="69"){ echo "Selected";} ?>>69</option>
		<option value="70" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="70"){ echo "Selected";} ?>>70</option>
		<option value="71" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="71"){ echo "Selected";} ?>>71</option>
		<option value="72" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="72"){ echo "Selected";} ?>>72</option>
		<option value="73" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="73"){ echo "Selected";} ?>>73</option>
		<option value="74" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="74"){ echo "Selected";} ?>>74</option>
		<option value="75" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="75"){ echo "Selected";} ?>>75</option>
		<option value="76" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="76"){ echo "Selected";} ?>>76</option>
		<option value="77" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="77"){ echo "Selected";} ?>>77</option>
		<option value="78" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="78"){ echo "Selected";} ?>>78</option>
		<option value="79" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="79"){ echo "Selected";} ?>>79</option>
		<option value="80" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="80"){ echo "Selected";} ?>>80</option>
		 <option value="81" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="81"){ echo "Selected";} ?> >81</option>
		  <option value="82" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="82"){ echo "Selected";} ?> >82</option>
		  <option value="83" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="83"){ echo "Selected";} ?> >83</option>
		  <option value="84" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="84"){ echo "Selected";} ?> >84</option>
		<option value="85" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="85"){ echo "Selected";} ?>>85</option>
		<option value="86" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="86"){ echo "Selected";} ?>>86</option>
		<option value="87" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="87"){ echo "Selected";} ?>>87</option>
		<option value="88" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="88"){ echo "Selected";} ?>>88</option>
		<option value="89" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="89"){ echo "Selected";} ?>>89</option>
		<option value="90" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="90"){ echo "Selected";} ?>>90</option>
		<option value="91" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="91"){ echo "Selected";} ?>>91</option>
		<option value="92" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="92"){ echo "Selected";} ?>>92</option>
		<option value="93" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="93"){ echo "Selected";} ?>>93</option>
		<option value="94" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="94"){ echo "Selected";} ?>>94</option>
		<option value="95" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="95"){ echo "Selected";} ?>>95</option>
		<option value="96" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="96"){ echo "Selected";} ?>>96</option>
		<option value="97" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="97"){ echo "Selected";} ?>>97</option>
		<option value="98" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="98"){ echo "Selected";} ?>>98</option>
		<option value="99" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="99"){ echo "Selected";} ?>>99</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		<?php
		}
		else
		{
		?>
		<td valign="middle" class="tbltext" align="center"><select name="txtnop" class="tbltext"  style="width:80px;" tabindex=""  id="id2_<?php echo $srno?>"  onchange="clk2('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);" disabled="disabled">
		<option value="" >---Select--</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
		<option value="60">60</option>
		<option value="61">61</option>
		<option value="62">62</option>
		<option value="63">63</option>
		<option value="64">64</option>
		<option value="65">65</option>
		<option value="66">66</option>
		<option value="67">67</option>
		<option value="68">68</option>
		<option value="69">69</option>
		<option value="70">70</option>
		<option value="71">71</option>
		<option value="72">72</option>
		<option value="73">73</option>
		<option value="74">74</option>
		<option value="75">75</option>
		<option value="76">76</option>
		<option value="77">77</option>
		<option value="78">78</option>
		<option value="79">79</option>
		<option value="80">80</option>
		<option value="81">81</option>
		<option value="82">82</option>
		<option value="83">83</option>
		<option value="84">84</option>
		<option value="85">85</option>
		<option value="86">86</option>
		<option value="87">87</option>
		<option value="88">88</option>
		<option value="89">89</option>
		<option value="90">90</option>
		<option value="91">91</option>
		<option value="92">92</option>
		<option value="93">93</option>
		<option value="94">94</option>
		<option value="95">95</option>
		<option value="96">96</option>
		<option value="97">97</option>
		<option value="98">98</option>
		<option value="99">99</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		<?php
		}
		?>
				<td valign="middle" class="tbltext" align="center">&nbsp;<input name="txtwb1" type="text" size="2" class="tbltext" tabindex=""  maxlength="2"   style="background-color:#CCCCCC"   id="id5_<?php echo $srno?>" disabled="disabled" value="<?php $p1_array=explode(",",$row['wtnopkg']); echo $p1_array[$x];?>"/></td>
		<td valign="middle" class="tbltext" align="center"><select name="txtmp" class="tbltext"  style="width:80px;" tabindex=""  id="id3_<?php echo $srno?>" onChange="clk3('<?php echo $srno?>',this.value);">
		<option value="" >---Select--</option>
		 <option value="Yes" <?php $p1_array=explode(",",$row['mtyp']); if($i!=0 && $p1_array[$x]=="Yes"){ echo "Selected";} ?> >Yes</option>
	<option value="No" <?php $p1_array=explode(",",$row['mtyp']); if($i!=0 && $p1_array[$x]=="No"){ echo "Selected";} ?> >No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<?php
		$p1_array=explode(",",$row['mtyp']); if($i!=0 && $p1_array[$x]=="Yes"){
		?>	
		<td valign="middle" class="tbltext" align="center"><select name="txtmpt" class="tbltext"  style="width:80px;" tabindex="" id="id4_<?php echo $srno?>" onChange="clk4('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);" >
		<option value="" >---Select--</option>
		<option value="Carton" <?php $p1_array=explode(",",$row['mtype']); if($i!=0 && $p1_array[$x]=="Carton"){ echo "Selected";} ?>>Carton</option>
		<option value="Bag" <?php $p1_array=explode(",",$row['mtype']); if($i!=0 && $p1_array[$x]=="Bag"){ echo "Selected";} ?>>Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
<?php
}
else
{
?>
<td valign="middle" class="tbltext" align="center"><select name="txtmpt" class="tbltext"  style="width:80px;" tabindex="" id="id4_<?php echo $srno?>" onChange="clk4('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);"  disabled="disabled">
		<option value="" >---Select--</option>
		<option value="Carton" >Carton</option>
		<option value="Bag" >Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
<?php
}
?>
<td align="center" width="94" valign="middle" class="tbltext">&nbsp;<input name="txt1" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"      id="id6_<?php echo $srno?>" onChange="calc('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);"onkeypress="return isNumberKey(event)"  value="<?php $p1_array=explode(",",$row['wtmp']); echo $p1_array[$x];?>" <?php  if($p1_array[$x]=="") echo "disabled"; ?>>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="center" width="67" valign="middle" class="tbltext">&nbsp;<input name="txt2" type="text" size="2" class="tbltext" tabindex=""  maxlength="9"   style="background-color:#CCCCCC" id="id7_<?php echo $srno?>"  readonly="true" value="<?php $p1_array=explode(",",$row['nowb']); echo $p1_array[$x];?>"></td>
<?php				 
	}
	else
	{
?>				
	<td valign="middle" class="tbltext" align="center"><select name="txtwb" class="tbltext"  style="width:80px;" tabindex="" id="itm_<?php echo $srno?>"  onChange="clk1('<?php echo $srno?>',this.value);" disabled="disabled" >
		<option value=""  >---Select--</option>
		 <option value="Yes" <?php if($i!=0 && $row['wbtype']=="Yes"){ echo "Selected";} ?> >Yes</option>
	<option value="No" <?php if( $i!=0 && $row['wbtype']=="No"){ echo "Selected";} ?> >No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		
		<td valign="middle" class="tbltext" align="center"><select name="txtnop" class="tbltext"  style="width:80px;" tabindex=""  id="id2_<?php echo $srno?>"  onchange="clk2('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);" disabled="disabled">
		<option value="" >---Select--</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
		<option value="60">60</option>
		<option value="61">61</option>
		<option value="62">62</option>
		<option value="63">63</option>
		<option value="64">64</option>
		<option value="65">65</option>
		<option value="66">66</option>
		<option value="67">67</option>
		<option value="68">68</option>
		<option value="69">69</option>
		<option value="70">70</option>
		<option value="71">71</option>
		<option value="72">72</option>
		<option value="73">73</option>
		<option value="74">74</option>
		<option value="75">75</option>
		<option value="76">76</option>
		<option value="77">77</option>
		<option value="78">78</option>
		<option value="79">79</option>
		<option value="80">80</option>
		<option value="81">81</option>
		<option value="82">82</option>
		<option value="83">83</option>
		<option value="84">84</option>
		<option value="85">85</option>
		<option value="86">86</option>
		<option value="87">87</option>
		<option value="88">88</option>
		<option value="89">89</option>
		<option value="90">90</option>
		<option value="91">91</option>
		<option value="92">92</option>
		<option value="93">93</option>
		<option value="94">94</option>
		<option value="95">95</option>
		<option value="96">96</option>
		<option value="97">97</option>
		<option value="98">98</option>
		<option value="99">99</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		
				<td valign="middle" class="tbltext" align="center">&nbsp;<input name="txtwb1" type="text" size="2" class="tbltext" tabindex=""  maxlength="2"   style="background-color:#CCCCCC"   id="id5_<?php echo $srno?>" readonly="true"     value="" disabled="disabled"/></td>
		<td valign="middle" class="tbltext" align="center"><select name="txtmp" class="tbltext"  style="width:80px;" tabindex=""  id="id3_<?php echo $srno?>" onChange="clk3('<?php echo $srno?>',this.value);" disabled="disabled">
		<option value="" >---Select--</option>
		 <option value="Yes"  >Yes</option>
	<option value="No"  >No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		
		<td valign="middle" class="tbltext" align="center"><select name="txtmpt" class="tbltext"  style="width:80px;" tabindex="" id="id4_<?php echo $srno?>" onChange="clk4('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);"  disabled="disabled">
		<option value="" >---Select--</option>
		<option value="Carton" >Carton</option>
		<option value="Bag" >Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>

<td align="center" width="94" valign="middle" class="tbltext">&nbsp;<input name="txt1" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"   style="background-color:#CCCCCC" id="id6_<?php echo $srno?>" onChange="calc('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);"onkeypress="return isNumberKey(event)"  value="" disabled="disabled">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="center" width="67" valign="middle" class="tbltext">&nbsp;<input name="txt2" type="text" size="2" class="tbltext" tabindex=""  maxlength="9"   style="background-color:#CCCCCC" id="id7_<?php echo $srno?>"  readonly="true" value="" disabled="disabled"
			></td>
	
<?php
	}
?>
<input type="hidden" name="mptnop<?php echo $srno?>" id="mptnop_<?php echo $srno?>" value="" />
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row12['ups'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row12['wt'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row12['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet" onClick="clk('<?php echo $srno?>');" id="fetchk_<?php echo $srno?>"<?php $p1_array=explode(",",$row['gm']);
			$i=0; $z="";
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == $row12['uid']) { $i++; $z=$val1.",".$x;}
				}$x++; 
				}
				if($i!=0) { echo "checked";}?>  value="<?php echo $row12['uid'];?>"/></td>
				
<?php
	$p_array=explode(",",$z);
	$x=$p_array[1];
	if( $i!=0)
	{
?>		
				<td valign="middle" class="tbltext" align="center"><select name="txtwb" class="tbltext"  style="width:80px;" tabindex="" id="itm_<?php echo $srno?>"  onChange="clk1('<?php echo $srno?>',this.value);" >
		<option value=""  >---Select--</option>
		 <option value="Yes" <?php $p1_array=explode(",",$row['wbtype']); if($i!=0 && $p1_array[$x]=="Yes"){ echo "Selected";} ?> >Yes</option>
	<option value="No" <?php $p1_array=explode(",",$row['wbtype']); if($i!=0 && $p1_array[$x]=="No"){ echo "Selected";} ?> >No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		<?php
		$p1_array=explode(",",$row['wbtype']); if($i!=0 && $p1_array[$x]=="Yes"){
		?>
		<td valign="middle" class="tbltext" align="center"><select name="txtnop" class="tbltext"  style="width:80px;" tabindex=""  id="id2_<?php echo $srno?>"  onchange="clk2('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);">
		<option value="" >---Select--</option>
		 <option value="1" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="1"){ echo "Selected";} ?> >1</option>
		  <option value="2" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="2"){ echo "Selected";} ?> >2</option>
		  <option value="3" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="3"){ echo "Selected";} ?> >3</option>
		  <option value="4" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="4"){ echo "Selected";} ?> >4</option>
		<option value="5" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="5"){ echo "Selected";} ?>>5</option>
		<option value="6" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="6"){ echo "Selected";} ?>>6</option>
		<option value="7" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="7"){ echo "Selected";} ?>>7</option>
		<option value="8" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="8"){ echo "Selected";} ?>>8</option>
		<option value="9" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="9"){ echo "Selected";} ?>>9</option>
		<option value="10" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="10"){ echo "Selected";} ?>>10</option>
		<option value="11" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="11"){ echo "Selected";} ?>>11</option>
		<option value="12" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="12"){ echo "Selected";} ?>>12</option>
		<option value="13" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="13"){ echo "Selected";} ?>>13</option>
		<option value="14" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="14"){ echo "Selected";} ?>>14</option>
		<option value="15" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="15"){ echo "Selected";} ?>>15</option>
		<option value="16" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="16"){ echo "Selected";} ?>>16</option>
		<option value="17" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="17"){ echo "Selected";} ?>>17</option>
		<option value="18" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="18"){ echo "Selected";} ?>>18</option>
		<option value="19" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="19"){ echo "Selected";} ?>>19</option>
		<option value="20" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="20"){ echo "Selected";} ?>>20</option>
		  <option value="21" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="21"){ echo "Selected";} ?> >21</option>
		  <option value="22" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="22"){ echo "Selected";} ?> >22</option>
		  <option value="23" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="23"){ echo "Selected";} ?> >23</option>
		  <option value="24" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="24"){ echo "Selected";} ?> >24</option>
		<option value="25" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="25"){ echo "Selected";} ?>>25</option>
		<option value="26" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="26"){ echo "Selected";} ?>>26</option>
		<option value="27" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="27"){ echo "Selected";} ?>>27</option>
		<option value="28" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="28"){ echo "Selected";} ?>>28</option>
		<option value="29" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="29"){ echo "Selected";} ?>>29</option>
		<option value="30" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="30"){ echo "Selected";} ?>>30</option>
		<option value="31" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="31"){ echo "Selected";} ?>>31</option>
		<option value="32" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="32"){ echo "Selected";} ?>>32</option>
		<option value="33" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="33"){ echo "Selected";} ?>>33</option>
		<option value="34" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="34"){ echo "Selected";} ?>>34</option>
		<option value="35" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="35"){ echo "Selected";} ?>>35</option>
		<option value="36" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="36"){ echo "Selected";} ?>>36</option>
		<option value="37" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="37"){ echo "Selected";} ?>>37</option>
		<option value="38" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="38"){ echo "Selected";} ?>>38</option>
		<option value="39" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="39"){ echo "Selected";} ?>>39</option>
		<option value="40" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="40"){ echo "Selected";} ?>>40</option>
		 <option value="41" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="41"){ echo "Selected";} ?> >41</option>
		  <option value="42" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="42"){ echo "Selected";} ?> >42</option>
		  <option value="43" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="43"){ echo "Selected";} ?> >43</option>
		  <option value="44" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="44"){ echo "Selected";} ?> >44</option>
		<option value="45" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="45"){ echo "Selected";} ?>>45</option>
		<option value="46" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="46"){ echo "Selected";} ?>>46</option>
		<option value="47" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="47"){ echo "Selected";} ?>>47</option>
		<option value="48" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="48"){ echo "Selected";} ?>>48</option>
		<option value="49" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="49"){ echo "Selected";} ?>>49</option>
		<option value="50" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="50"){ echo "Selected";} ?>>50</option>
		<option value="51" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="51"){ echo "Selected";} ?>>51</option>
		<option value="52" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="52"){ echo "Selected";} ?>>52</option>
		<option value="53" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="53"){ echo "Selected";} ?>>53</option>
		<option value="54" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="54"){ echo "Selected";} ?>>54</option>
		<option value="55" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="51"){ echo "Selected";} ?>>55</option>
		<option value="56" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="56"){ echo "Selected";} ?>>56</option>
		<option value="57" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="57"){ echo "Selected";} ?>>57</option>
		<option value="58" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="58"){ echo "Selected";} ?>>58</option>
		<option value="59" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="59"){ echo "Selected";} ?>>59</option>
		<option value="60" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="60"){ echo "Selected";} ?>>60</option>
		 <option value="61" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="61"){ echo "Selected";} ?> >61</option>
		  <option value="62" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="62"){ echo "Selected";} ?> >62</option>
		  <option value="63" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="63"){ echo "Selected";} ?> >63</option>
		  <option value="64" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="64"){ echo "Selected";} ?> >64</option>
		<option value="65" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="65"){ echo "Selected";} ?>>65</option>
		<option value="66" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="66"){ echo "Selected";} ?>>66</option>
		<option value="67" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="67"){ echo "Selected";} ?>>67</option>
		<option value="68" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="68"){ echo "Selected";} ?>>68</option>
		<option value="69" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="69"){ echo "Selected";} ?>>69</option>
		<option value="70" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="70"){ echo "Selected";} ?>>70</option>
		<option value="71" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="71"){ echo "Selected";} ?>>71</option>
		<option value="72" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="72"){ echo "Selected";} ?>>72</option>
		<option value="73" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="73"){ echo "Selected";} ?>>73</option>
		<option value="74" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="74"){ echo "Selected";} ?>>74</option>
		<option value="75" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="75"){ echo "Selected";} ?>>75</option>
		<option value="76" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="76"){ echo "Selected";} ?>>76</option>
		<option value="77" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="77"){ echo "Selected";} ?>>77</option>
		<option value="78" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="78"){ echo "Selected";} ?>>78</option>
		<option value="79" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="79"){ echo "Selected";} ?>>79</option>
		<option value="80" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="80"){ echo "Selected";} ?>>80</option>
		 <option value="81" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="81"){ echo "Selected";} ?> >81</option>
		  <option value="82" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="82"){ echo "Selected";} ?> >82</option>
		  <option value="83" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="83"){ echo "Selected";} ?> >83</option>
		  <option value="84" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="84"){ echo "Selected";} ?> >84</option>
		<option value="85" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="85"){ echo "Selected";} ?>>85</option>
		<option value="86" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="86"){ echo "Selected";} ?>>86</option>
		<option value="87" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="87"){ echo "Selected";} ?>>87</option>
		<option value="88" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="88"){ echo "Selected";} ?>>88</option>
		<option value="89" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="89"){ echo "Selected";} ?>>89</option>
		<option value="90" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="90"){ echo "Selected";} ?>>90</option>
		<option value="91" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="91"){ echo "Selected";} ?>>91</option>
		<option value="92" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="92"){ echo "Selected";} ?>>92</option>
		<option value="93" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="93"){ echo "Selected";} ?>>93</option>
		<option value="94" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="94"){ echo "Selected";} ?>>94</option>
		<option value="95" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="95"){ echo "Selected";} ?>>95</option>
		<option value="96" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="96"){ echo "Selected";} ?>>96</option>
		<option value="97" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="97"){ echo "Selected";} ?>>97</option>
		<option value="98" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="98"){ echo "Selected";} ?>>98</option>
		<option value="99" <?php $p1_array=explode(",",$row['wtnop']); if($i!=0 && $p1_array[$x]=="99"){ echo "Selected";} ?>>99</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		<?php
		}
		else
		{
		?>
		<td valign="middle" class="tbltext" align="center"><select name="txtnop" class="tbltext"  style="width:80px;" tabindex=""  id="id2_<?php echo $srno?>"  onchange="clk2('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);" disabled="disabled">
		<option value="" >---Select--</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
		<option value="60">60</option>
		<option value="61">61</option>
		<option value="62">62</option>
		<option value="63">63</option>
		<option value="64">64</option>
		<option value="65">65</option>
		<option value="66">66</option>
		<option value="67">67</option>
		<option value="68">68</option>
		<option value="69">69</option>
		<option value="70">70</option>
		<option value="71">71</option>
		<option value="72">72</option>
		<option value="73">73</option>
		<option value="74">74</option>
		<option value="75">75</option>
		<option value="76">76</option>
		<option value="77">77</option>
		<option value="78">78</option>
		<option value="79">79</option>
		<option value="80">80</option>
		<option value="81">81</option>
		<option value="82">82</option>
		<option value="83">83</option>
		<option value="84">84</option>
		<option value="85">85</option>
		<option value="86">86</option>
		<option value="87">87</option>
		<option value="88">88</option>
		<option value="89">89</option>
		<option value="90">90</option>
		<option value="91">91</option>
		<option value="92">92</option>
		<option value="93">93</option>
		<option value="94">94</option>
		<option value="95">95</option>
		<option value="96">96</option>
		<option value="97">97</option>
		<option value="98">98</option>
		<option value="99">99</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		<?php
		}
		?>
				<td valign="middle" class="tbltext" align="center">&nbsp;<input name="txtwb1" type="text" size="2" class="tbltext" tabindex=""  maxlength="2"   style="background-color:#CCCCCC"   id="id5_<?php echo $srno?>" disabled="disabled" value="<?php $p1_array=explode(",",$row['wtnopkg']); echo $p1_array[$x];?>"/></td>
		<td valign="middle" class="tbltext" align="center"><select name="txtmp" class="tbltext"  style="width:80px;" tabindex=""  id="id3_<?php echo $srno?>" onChange="clk3('<?php echo $srno?>',this.value);">
		<option value="" >---Select--</option>
		 <option value="Yes" <?php $p1_array=explode(",",$row['mtyp']); if($i!=0 && $p1_array[$x]=="Yes"){ echo "Selected";} ?> >Yes</option>
	<option value="No" <?php $p1_array=explode(",",$row['mtyp']); if($i!=0 && $p1_array[$x]=="No"){ echo "Selected";} ?> >No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<?php
		$p1_array=explode(",",$row['mtyp']); if($i!=0 && $p1_array[$x]=="Yes"){
		?>	
		<td valign="middle" class="tbltext" align="center"><select name="txtmpt" class="tbltext"  style="width:80px;" tabindex="" id="id4_<?php echo $srno?>" onChange="clk4('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);" >
		<option value="" >---Select--</option>
		<option value="Carton" <?php $p1_array=explode(",",$row['mtype']); if($i!=0 && $p1_array[$x]=="Carton"){ echo "Selected";} ?>>Carton</option>
		<option value="Bag" <?php $p1_array=explode(",",$row['mtype']); if($i!=0 && $p1_array[$x]=="Bag"){ echo "Selected";} ?>>Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
<?php
}
else
{
?>
<td valign="middle" class="tbltext" align="center"><select name="txtmpt" class="tbltext"  style="width:80px;" tabindex="" id="id4_<?php echo $srno?>" onChange="clk4('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);"  disabled="disabled">
		<option value="" >---Select--</option>
		<option value="Carton" >Carton</option>
		<option value="Bag" >Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
<?php
}
?>
<td align="center" width="94" valign="middle" class="tbltext">&nbsp;<input name="txt1" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"   id="id6_<?php echo $srno?>" onChange="calc('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);"onkeypress="return isNumberKey(event)"  value="<?php $p1_array=explode(",",$row['wtmp']); echo $p1_array[$x];?>" <?php  if($p1_array[$x]=="") echo "disabled"; ?>>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="center" width="67" valign="middle" class="tbltext">&nbsp;<input name="txt2" type="text" size="2" class="tbltext" tabindex=""  maxlength="9"   style="background-color:#CCCCCC" id="id7_<?php echo $srno?>"  readonly="true" value="<?php $p1_array=explode(",",$row['nowb']); echo $p1_array[$x];?>"></td>
<?php				 
	}
	else
	{
?>				
	<td valign="middle" class="tbltext" align="center"><select name="txtwb" class="tbltext"  style="width:80px;" tabindex="" id="itm_<?php echo $srno?>"  onChange="clk1('<?php echo $srno?>',this.value);" disabled="disabled" >
		<option value=""  >---Select--</option>
		 <option value="Yes" <?php if($i!=0 && $row['wbtype']=="Yes"){ echo "Selected";} ?> >Yes</option>
	<option value="No" <?php if( $i!=0 && $row['wbtype']=="No"){ echo "Selected";} ?> >No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		
		<td valign="middle" class="tbltext" align="center"><select name="txtnop" class="tbltext"  style="width:80px;" tabindex=""  id="id2_<?php echo $srno?>"  onchange="clk2('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);" disabled="disabled">
		<option value="" >---Select--</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
		<option value="60">60</option>
		<option value="61">61</option>
		<option value="62">62</option>
		<option value="63">63</option>
		<option value="64">64</option>
		<option value="65">65</option>
		<option value="66">66</option>
		<option value="67">67</option>
		<option value="68">68</option>
		<option value="69">69</option>
		<option value="70">70</option>
		<option value="71">71</option>
		<option value="72">72</option>
		<option value="73">73</option>
		<option value="74">74</option>
		<option value="75">75</option>
		<option value="76">76</option>
		<option value="77">77</option>
		<option value="78">78</option>
		<option value="79">79</option>
		<option value="80">80</option>
		<option value="81">81</option>
		<option value="82">82</option>
		<option value="83">83</option>
		<option value="84">84</option>
		<option value="85">85</option>
		<option value="86">86</option>
		<option value="87">87</option>
		<option value="88">88</option>
		<option value="89">89</option>
		<option value="90">90</option>
		<option value="91">91</option>
		<option value="92">92</option>
		<option value="93">93</option>
		<option value="94">94</option>
		<option value="95">95</option>
		<option value="96">96</option>
		<option value="97">97</option>
		<option value="98">98</option>
		<option value="99">99</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		
				<td valign="middle" class="tbltext" align="center">&nbsp;<input name="txtwb1" type="text" size="2" class="tbltext" tabindex=""  maxlength="2"   style="background-color:#CCCCCC"   id="id5_<?php echo $srno?>" readonly="true"     value="" disabled="disabled"/></td>
		<td valign="middle" class="tbltext" align="center"><select name="txtmp" class="tbltext"  style="width:80px;" tabindex=""  id="id3_<?php echo $srno?>" onChange="clk3('<?php echo $srno?>',this.value);" disabled="disabled">
		<option value="" >---Select--</option>
		 <option value="Yes"  >Yes</option>
	<option value="No"  >No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
		
		<td valign="middle" class="tbltext" align="center"><select name="txtmpt" class="tbltext"  style="width:80px;" tabindex="" id="id4_<?php echo $srno?>" onChange="clk4('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);"  disabled="disabled">
		<option value="" >---Select--</option>
		<option value="Carton" >Carton</option>
		<option value="Bag" >Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>

<td align="center" width="94" valign="middle" class="tbltext">&nbsp;<input name="txt1" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"   style="background-color:#CCCCCC" id="id6_<?php echo $srno?>" onChange="calc('<?php echo $srno?>','<?php echo $row12['uom'];?>',this.value);"onkeypress="return isNumberKey(event)"  value="" disabled="disabled">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="center" width="67" valign="middle" class="tbltext">&nbsp;<input name="txt2" type="text" size="2" class="tbltext" tabindex=""  maxlength="9"   style="background-color:#CCCCCC" id="id7_<?php echo $srno?>"  readonly="true" value="" disabled="disabled"
			></td>
<?php
	}
?>
<input type="hidden" name="mptnop<?php echo $srno?>" id="mptnop_<?php echo $srno?>" value="" />
  </tr>
<?php	
}
$srno=$srno+1;
}
}
?>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_variety.php?page=<?php echo $pageid;?>"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"><input type="hidden" name="flagcode" value=""/><input type="hidden" name="code1" value=""/><input type="hidden" name="code2" value=""/><input type="hidden" name="code3" value=""/><input type="hidden" name="code4" value=""/><input type="hidden" name="code5" value=""/><input type="hidden" name="code6" value=""/><input type="hidden" name="code7" value=""/><input type="hidden" name="code8" value=""/></td>
</tr>
</table>

</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	<!--  </td>
	  </tr>
	  </table>-->
	  
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
