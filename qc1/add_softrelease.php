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
		$crop = $_POST['txtcrop'];	 
		$variety= $_POST['txtvariety'];
		$typ= $_POST['txt11'];
		$lotlist= $_POST['lotlist'];
		$srtlist= $_POST['srtlist'];	 
		$txtid= $_POST['txtid'];
		$date= $_POST['date'];
		$txtwh= $_POST['txtwh'];
		$txtbin= $_POST['txtbin'];
		$txtsubbin= $_POST['txtsubbin'];
		
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;	

		$tdate=date("Y-m-d");
		
		$sql_srmain="Insert into tbl_softr (softr_tcode, softr_date, softr_crop, softr_variety, softr_typ, softr_wh, softr_bin, softr_subbin, yearcode) values('$txtid', '$tdate', '$crop', '$variety', '$typ', '$txtwh', '$txtbin', '$txtsubbin', '$yearid_id')";
		if(mysqli_query($link,$sql_srmain) or die(mysqli_error($link)))
		{
			$id=mysqli_insert_id($link);
			$lot1=explode(",", $lotlist);
			$srt1=explode(",", $srtlist);
			for($i=0; $i<count($lot1); $i++)
			{
				if($lot1[$i]<>"")
				{
					$sql_srsub="Insert into tbl_softr_sub (softr_id, softrsub_lotno, softrsub_srtyp, softrsub_srflg) values('$id', '$lot1[$i]', '$srt1[$i]', '1')";
					$ss=mysqli_query($link,$sql_srsub) or die(mysqli_error($link));
				}
			}
		}
		echo "<script>window.location='add_softrelease_preview.php?tid=$id'</script>";	
	}
	
	
	$a="TSF";
	$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr  where yearcode='$yearid_id'  ORDER BY softr_tcode DESC";
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
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Manager - Transaction - Soft Release</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="softr.js"></script>
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
{
	document.frmaddDepartment.txt11.value="";
	/*document.getElementById("vitem1").style.display="none";
	document.getElementById("vitem1").innerHTML="";*/
	document.getElementById('binselect').style.display="none";
	document.getElementById('postingsubtable').innerHTML="<input type='hidden' name='srno' value='1' />";
	document.frmaddDepartment.sllob[0].checked=false;
	document.frmaddDepartment.sllob[1].checked=false;
	showUser(classval,'vitem','item','','','','','','');
}

function varchk()
{
	document.getElementById('binselect').style.display="none";
	document.getElementById('postingsubtable').innerHTML="<input type='hidden' name='srno' value='1' />";
	document.frmaddDepartment.sllob[0].checked=false;
	document.frmaddDepartment.sllob[1].checked=false;
	document.frmaddDepartment.txt11.value="";
}

function srslchk(slval)
{
	if(document.frmaddDepartment.txtvariety.value!="")
	{
		if(slval=="sllot")
		{
			document.frmaddDepartment.txt11.value=slval;
			document.getElementById('binselect').style.display="none";
			document.getElementById('postingsubtable').innerHTML="<input type='hidden' name='srno' value='1' />";
			var crop=document.frmaddDepartment.txtcrop.value;
			var variety=document.frmaddDepartment.txtvariety.value;
			showUser(crop,'postingsubtable','showlist',variety,slval,'','','','');
		}
		else
		{
			document.frmaddDepartment.txt11.value=slval;
			document.getElementById('postingsubtable').innerHTML="<input type='hidden' name='srno' value='1' />";
			document.getElementById('binselect').style.display="block";
		}
	}
	else
	{
		document.frmaddDepartment.txt11.value="";
		document.getElementById('postingsubtable').innerHTML="<input type='hidden' name='srno' value='1' />";
		document.getElementById('binselect').style.display="none";
		alert("Select Variety");
	}
}

function wh(whval)
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Select Variety");
		document.frmaddDepartment.txtwh.value="";
		document.frmaddDepartment.txtbin.value="";
		document.frmaddDepartment.txtsubbin.value="";
	}
	else
	{
		showUser(whval,'bin','wh','txtbin','','','','');
	}
}

function bin(binval)
{
	if(document.frmaddDepartment.txtwh.value=="")
	{
		alert("Select Warehouse");
		//document.frmaddDepartment.txtwh.value="";
		document.frmaddDepartment.txtbin.value="";
		document.frmaddDepartment.txtsubbin.value="";
	}
	else
	{
		showUser(binval,'sbin','bin','txtsubin','','','','');
	}
}
function subbin(subbinval)
{
	if(document.frmaddDepartment.txtbin.value=="")
	{
		alert("Select Bin");
		//document.frmaddDepartment.txtwh.value="";
		//document.frmaddDepartment.txtbin.value="";
		document.frmaddDepartment.txtsubbin.value="";
	}
	else
	{
		var txt11=document.frmaddDepartment.txt11.value;
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var wh=document.frmaddDepartment.txtwh.value;
		var bin=document.frmaddDepartment.txtbin.value;
		showUser(crop,'postingsubtable','showlist',variety,txt11,wh,bin,subbinval,'');
	}
}

function chklot(val12)
{
	if(document.getElementById('fet'+[val12]).checked == true)
	{
		document.getElementById('srtyp'+[val12]).disabled=false;
	}
	else
	{
		document.getElementById('srtyp'+[val12]).selectedIndex=0;
		document.getElementById('srtyp'+[val12]).disabled=true;
	}
}

function checkall()
{
	for (var i=1; i<document.frmaddDepartment.srno.value; i++)
	{
		document.getElementById('fet'+[i]).checked = true;
		document.getElementById('srtyp'+[i]).disabled=false;
		document.getElementById('srtyp'+[i]).selectedIndex=0;
	}
}
function clearall()
{
	for (var i=1; i<document.frmaddDepartment.srno.value; i++)
	{
		document.getElementById('fet'+[i]).checked = false;
		document.getElementById('srtyp'+[i]).selectedIndex=0;
		document.getElementById('srtyp'+[i]).disabled=true;
	}
}
function mySubmit()
{ 
	var f=0; var l=0; var s=0;
	document.frmaddDepartment.lotlist.value="";
	document.frmaddDepartment.srtlist.value="";
	//  lotchk
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	//alert(document.frmaddDepartment.srno.value);
	if(document.frmaddDepartment.srno.value > 1)
	{
		if(document.frmaddDepartment.srno.value > 2)
		{
			for(var i=0; i<document.frmaddDepartment.lotchk.length; i++)
			{
				if(document.frmaddDepartment.lotchk[i].checked==true)
				{	l++;
					if(document.frmaddDepartment.lotlist.value!="")
					{
						document.frmaddDepartment.lotlist.value=document.frmaddDepartment.lotlist.value+","+document.frmaddDepartment.lotchk[i].value;
					}
					else
					{
						document.frmaddDepartment.lotlist.value=document.frmaddDepartment.lotchk[i].value;
					}
					if(document.frmaddDepartment.srtyp[i].value!="")
					{ s++;
						if(document.frmaddDepartment.srtlist.value!="")
						{
							document.frmaddDepartment.srtlist.value=document.frmaddDepartment.srtlist.value+","+document.frmaddDepartment.srtyp[i].value;
						}
						else
						{
							document.frmaddDepartment.srtlist.value=document.frmaddDepartment.srtyp[i].value;
						}
					}
				}
			}
		}
		else
		{
			if(document.frmaddDepartment.lotchk.checked==true)
			{	l++;
				if(document.frmaddDepartment.lotlist.value!="")
				{
					document.frmaddDepartment.lotlist.value=document.frmaddDepartment.lotlist.value+","+document.frmaddDepartment.lotchk.value;
				}
				else
				{
					document.frmaddDepartment.lotlist.value=document.frmaddDepartment.lotchk.value;
				}
				if(document.frmaddDepartment.srtyp.value!="")
				{ s++;
					if(document.frmaddDepartment.srtlist.value!="")
					{
						document.frmaddDepartment.srtlist.value=document.frmaddDepartment.srtlist.value+","+document.frmaddDepartment.srtyp.value;
					}
					else
					{
						document.frmaddDepartment.srtlist.value=document.frmaddDepartment.srtyp.value;
					}
				}
			}
		}
	}
	else
	{
		f=1;
	}
	if(document.frmaddDepartment.lotlist.value=="")
	{
		alert("Please select lot(s) for Soft Release");
		f=1;
	}
	if(document.frmaddDepartment.lotlist.value!="")
	{
		if(l!=s)
		{
			alert("Please select Soft Release Type");
			f=1;
		}
	}
	
	if(f==0)
	{
		return true;	 
	}
	else
	{
		return false;
	}
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
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
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Soft Release</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="lotlist" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="srtlist" value="0" />
		
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Soft Release - Add</td>
</tr>
<tr class="light" height="20">
  <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field</td>
</tr>
<tr class="Dark" height="30">
<td width="120" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="242"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
<td width="106" align="right" valign="middle" class="tblheading">&nbsp;Date</td>
<td width="272" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>

 <tr class="Light" height="30">
 <?php
 //$sql="SELECT * FROM tbl_lot_ldg where lotldg_got1='GOT-NR UT' and lotldg_got='UT'";
 
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>
<td width="120" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="242" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onchange="varchk();">
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
 </table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Select Display List type</td>
</tr>
<tr class="light" height="20">
  <td colspan="6" align="right" class="smalltblheading"><font color="#FF0000">Only Lots having status as:</font> <font color="#003366">QC UT / RT </font><font color="#FF0000">with </font> <font color="#003366">GOT-NR UT / RT / OK </font><font color="#FF0000">&nbsp;&nbsp;OR   &nbsp;&nbsp;</font> <font color="#003366">GOT-NUT</font>   <font color="#FF0000">&nbsp;&nbsp;OR   &nbsp;&nbsp;</font> <font color="#003366">GOT-R OK  will be displayed</font>&nbsp;&nbsp;</td>
</tr> 
<tr class="Light" height="30">
   <td align="right"  valign="middle" class="tblheading" colspan="2"><input type="radio" name="sllob" value="sllot" onclick="srslchk(this.value);" /></td>
  <td width="51%" colspan="2" align="left" valign="middle" class="tblheading">&nbsp;Display Complete Lot List</td>
</tr>
<tr class="Light" height="30">
   <td align="right"  valign="middle" class="tblheading" colspan="2"><input type="radio" name="sllob" value="slbin" onclick="srslchk(this.value);" /></td>
  <td align="left" valign="middle" class="tblheading" colspan="2">&nbsp;Display Sub Bin wise Lot List</td>
</tr>
</table>
<!--<div id="lotselect" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
 <tr class="Light" height="30">
   <td width="364" align="right"  valign="middle" class="tblheading">Lot No. &nbsp;</td>
  <td width="380" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" id="smt" type="text" class="tbltext" value="" style="background-color:#CCCCCC" readonly="true"  />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
  </tr>
</table>
</div>-->
<div id="binselect" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 

   <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="120" align="right"  valign="middle" class="tbltext">WH&nbsp;</td>
<td width="146" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:70px;" onchange="wh(this.value);"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($whi==$noticia_whd1['whid']){ echo "Selected";} ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where whid='".$whi."'") or die(mysqli_error($link));
?>
<td width="94" align="right"  valign="middle" class="tbltext">Bin&nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bin">&nbsp;<select class="tbltext" name="txtbin" style="width:60px;" onchange="bin(this.value);" >
<option value="" selected>--Bin--</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($bni==$noticia_bing1['binid']){ echo "Selected"; } ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where whid='".$whi."' and binid='".$bni."' order by sname") or die(mysqli_error($link));
?>	
<td width="90" align="right"  valign="middle" class="tbltext">Sub Bin&nbsp;</td>
<td width="179" align="left"  valign="middle" class="tbltext" id="sbin">&nbsp;<select class="tbltext" name="txtsubbin" style="width:80px;" onchange="subbin(this.value);"  >
<option value="" selected>--Sub Bin--</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($sbni==$noticia_subbing1['sid']){ echo "Selected"; } ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<br />
<div id="postingsubtable"><input type='hidden' name='srno' value='1' /></div>
</div>
<br />

<table cellpadding="5" cellspacing="5" border="0" width="850" align="center">
<tr >
<td align="center" colspan="3"><a href="home_softrelease.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input type="image" src="../images/preview.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
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

  
