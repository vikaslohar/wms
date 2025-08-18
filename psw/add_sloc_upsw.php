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
	
/*$sql_tbl=mysqli_query($link,"select * from tbl_sloc where surole='".$logid."' and supflg=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['slid'];	
	
	$s_sub="delete from tbl_sloc_sub where slocid='".$arrival_id."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
}

	$s_sub="delete from tbl_sloc where surole='".$logid."' and supflg=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	

*/
	
	if(isset($_POST['frm_action'])=='submit')
	{ 
		$crop=trim($_POST['txtcrop']);
		$variety=trim($_POST['txtvariety']);
		$txtups=trim($_POST['txtups']);
		$whn=trim($_POST['txtslwhg24']);
		$binn=trim($_POST['txtslbing24']);
		$subbinn=trim($_POST['txtslsubbing24']);
		$cnt=trim($_POST['cnt']);
		$stageo=trim($_POST['stage']);
		$tdate=trim($_POST['txtdate']);
		$olots=trim($_POST['olots']);
		$code=trim($_POST['code']);
		//exit;
	 	$sql_in1="insert into tbl_sloc_upsw (code, sldate, crop, variety, upssize, yearcode, surole, stage, plantcode) values ('$code', '$tdate', '$crop', '$variety', '$txtups', '$yearid_id', '$lgnid','$stageo', '$plantcode')";
	
		if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
		{
			$mainid=mysqli_insert_id($link);
			$p_array=explode(",",$olots);
			foreach($p_array as $val)
			{
				if($val <> "")
				{
				
				$a=$txtups;
				$b=$crop;
				$c=$variety;
				
				$sql_iss23=mysqli_query($link,"select distinct (subbinid)  from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$val."' and lotldg_crop='".$b."' and lotldg_variety='".$c."' and packtype='".$a."' order by subbinid") or die(mysqli_error($link));
				$tot23=mysqli_num_rows($sql_iss23);
				while($row_iss23=mysqli_fetch_array($sql_iss23))
				{ 
				
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_iss23['subbinid']."' and lotno='".$val."' ") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty>0") or die(mysqli_error($link)); 
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
				
				$wareh=$row_issuetbl['whid'];
				$bino=$row_issuetbl['binid'];
				$subbino=$row_issuetbl['subbinid'];
				

		 	 	$sql_in="insert into tbl_sloc_upsw_sub(slocid, lotno, whid, binid, subbinid, plantcode) values('$mainid', '$val', '$wareh', '$bino', '$subbino', '$plantcode')";
				mysqli_query($link,$sql_in) or die(mysqli_error($link));
				}
				}
				
				$sql_in2="insert into tbl_sloc_upsw_sub2(slocid, lotno, whid, binid, subbinid, plantcode) values('$mainid', '$val', '$whn', '$binn', '$subbinn', '$plantcode')";
				mysqli_query($link,$sql_in2) or die(mysqli_error($link));
				}
			}
		}
		//exit;
			echo "<script>window.location='add_sloc_upsw_preview.php?pid=$mainid'</script>";	
	}
		
	$a="TBU";
	$sql_code="SELECT MAX(code) FROM tbl_sloc_binw2  where plantcode='$plantcode' and yearcode='$yearid_id'  ORDER BY code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1=$a.$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1=$a.$code."/".$lgnid;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PSW -Transaction  - SLOC Consolidation - UPS wise</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
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

<script src="slocupups.js"></script>
<script language="javascript" type="text/javascript">
var x = 0;

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

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function mySubmit()
{ 
	if(document.frmaddDepartment.cnt.value==0)
	{
		alert("No lots found to update SLOC");
		return false;
	}
	document.frmaddDepartment.olots.value="";
	//alert(document.frmaddDepartment.cnt.value);
	//alert(document.frmaddDepartment.lotsn.length);
	if(document.frmaddDepartment.cnt.value>1)
	{ 
		for (var i = 1; i <=document.frmaddDepartment.lotsn.length; i++) 
		{          
			if(document.frmaddDepartment.olots.value=="")
			{
				document.frmaddDepartment.olots.value=document.getElementById('lotsn'+[i]).value;
			}
			else
			{
				document.frmaddDepartment.olots.value=document.frmaddDepartment.olots.value+','+document.getElementById('lotsn'+[i]).value;
			}
		}
	}
	else
	{
		if(document.frmaddDepartment.olots.value=="")
		{
			document.frmaddDepartment.olots.value=document.frmaddDepartment.lotsn.value;
		}
		else
		{
			document.frmaddDepartment.olots.value=document.frmaddDepartment.olots.value+','+document.frmaddDepartment.lotsn.value;
		}
	}
	/*if(document.frmaddDepartment.txtslsubbing24.value=="")
	{
		alert("No Sub-Bin selected to update SLOC");
		return false;
	}*/
	
	return true;	 
}

function cropchk(cropval)
{ 
	document.getElementById('showsloc').innerHTML="";	
	var b='vitem';
	showUser(cropval,b,'item','','','','','');
}

function varchk(varval)
{ 
	document.getElementById('showsloc').innerHTML="";	
	var b='vitem2';
	var crop=document.frmaddDepartment.txtcrop.value;
	showUser(varval,b,'item2',crop,'','','','');
}

function upschk(upsval)
{ 
	var b='showsloc';
	var crop=document.frmaddDepartment.txtcrop.value;
	var variety=document.frmaddDepartment.txtvariety.value;
	showUser(upsval,b,'showslocs',crop,variety,'','','');
}


function wh4(wh1val)
{ 
	if(document.frmaddDepartment.crpflg.value > 0 || document.frmaddDepartment.verflg.value > 0 || document.frmaddDepartment.stageflg.value > 0)
	{
		alert("Cannot update SLOC.\n\nReason:\n\nLots with different Crop/Variety/Stage Stored in above selected Bin");
		document.frmaddDepartment.txtslwhg24.value="";
		return false;
	}
	else
	{
		var b='bing24';
		showUser(wh1val,b,'wh3','4','','','','');
	}
}
/*function bin1(binval)
{
	if(document.frmaddDepartment.txtslwhg.value=="")
	{
		alert("Select Warehouse");
		document.frmaddDepartment.txtslbing.value="";
		return false;
	}
	else
	{
		var b='showsloc';
		var wh=document.frmaddDepartment.txtslwhg.value;
		var f=document.frmaddDepartment.txt123.value;
		showUser(binval,b,'showslocs',wh,'',f,'','');
	}
}*/
function bin2(binval)
{
	document.getElementById('showsloc').innerHTML="";
	if(document.frmaddDepartment.txtslwhg2.value=="")
	{
		alert("Select Warehouse");
		document.frmaddDepartment.txtslbing2.value="";
		document.frmaddDepartment.txtslsubbing2.value="";
		return false;
	}
	else
	{
		var b='sbing2';
		showUser(binval,b,'bin2','2','','','','');
		/*var b='showsloc';
		var wh=document.frmaddDepartment.txtslwhg2.value;
		var bin=document.frmaddDepartment.txtslbing2.value;
		var f=document.frmaddDepartment.txt123.value;
		showUser(binval,b,'showslocs',wh,bin,f,'','');*/
	}
}
/*function bin3(binval)
{
	if(document.frmaddDepartment.txtslwhg222.value=="")
	{
		alert("Select Warehouse");
		document.frmaddDepartment.txtslbing222.value="";
		return false;
	}
}*/
function bin4(binval)
{
	if(document.frmaddDepartment.txtslwhg24.value=="")
	{
		alert("Select Warehouse");
		document.frmaddDepartment.txtslbing24.value="";
		document.frmaddDepartment.txtslsubbing24.value="";
		return false;
	}
	else
	{
		var b='sbing24';
		showUser(binval,b,'bin4','4','','','','');
		/*var b='prvewshow';
		var wh=document.frmaddDepartment.txtslwhg24.value;
		var bin=document.frmaddDepartment.txtslbing24.value;
		var f=document.frmaddDepartment.stage.value;
		var g=document.frmaddDepartment.vert.value;
		showUser(binval,b,'prvewshw',wh,bin,f,g,'');*/
	}
}
function subbin2(subbinval)
{
	document.getElementById('showsloc').innerHTML="";
	if(document.frmaddDepartment.txtslbing2.value=="")
	{
		alert("Select Bin");
		document.frmaddDepartment.txtslsubbing2.value="";
		return false;
	}
	else
	{
		var b='showsloc';
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var f=document.frmaddDepartment.txt123.value;
		showUser(subbinval,b,'showslocs',wh,bin,f,'','');
	}
}
function subbin4(subbinval)
{
	document.getElementById('prvewshow').innerHTML="";
	if(document.frmaddDepartment.txtslbing24.value=="")
	{
		alert("Select Bin");
		document.frmaddDepartment.txtslsubbing24.value="";
		return false;
	}
	/*else if(document.frmaddDepartment.txtslsubbing24.value==document.frmaddDepartment.txtslsubbing2.value)
	{
		alert("Cannot update in same SLOC");
		document.frmaddDepartment.txtslsubbing24.value="";
		return false;
	}*/
	else
	{
		var b='prvewshow';
		var wh=document.frmaddDepartment.txtslwhg24.value;
		var bin=document.frmaddDepartment.txtslbing24.value;
		var f=document.frmaddDepartment.txt123.value;
		var g=document.frmaddDepartment.txtvariety.value;
		showUser(subbinval,b,'prvewshw',wh,bin,f,g,'');
	}
}
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Consolidation - UPS wise</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>

	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="code" value="<?php echo $code;?>" type="hidden">
	   <input name="txt123" value="Pack" type="hidden">
	  <input type="hidden" name="olots" value="" />
	  <input type="hidden" name="txtdate" value="<?php echo date("Y-m-d");?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Consolidation - UPS wise</td>
</tr>

<tr class="Dark" height="25">
	<td width="88" height="30" align="right" valign="middle" class="tblheading">Select Crop&nbsp;</td>
  <?php
$whg2_query=mysqli_query($link,"select cropid, cropname from tblcrop order by cropname");
?>                 
				<td width="200"  align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtcrop" style="width:120px;" onChange="cropchk(this.value);"   >
            <option value="" selected>--Select--</option>
            <?php while($noticia_whg2=mysqli_fetch_array($whg2_query)) { ?>
            <option value="<?php echo $noticia_whg2['cropid'];?>" />    
            <?php echo $noticia_whg2['cropname'];?>
            <?php } ?>
    </select><font color="#FF0000">*</font>&nbsp;</td>
    <td width="91" height="30" align="right" valign="middle" class="tblheading">Select Variety&nbsp;</td>
                  
    <td width="227"  align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" name="txtvariety"  id="itm"style="width:170px;" onchange="varchk(this.value)"  >
     <option value="" selected>--Select--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	    <td width="72" height="30" align="right" valign="middle" class="tblheading">Select UPS&nbsp;</td>
                  
    <td width="158"  align="left"  valign="middle" class="tbltext" id="vitem2">&nbsp;<select class="tbltext" name="txtups" style="width:100px;" onchange="upschk(this.value)"  >
     <option value="" selected>--Select--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
</tr>
</table>
<div id="showsloc" style="display:block"></div>

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
