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

	$tid=$_REQUEST['tid'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
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
		
		$sql_srmain="Update tbl_softr2 set softr_tcode='$txtid', softr_date='$tdate', softr_crop='$crop', softr_variety='$variety', softr_typ='$typ', softr_wh='$txtwh', softr_bin='$txtbin', softr_subbin='$txtsubbin', yearcode='$yearid_id' where softr_id='".$tid."'";
		if(mysqli_query($link,$sql_srmain) or die(mysqli_error($link)))
		{
			$sql_sr="delete from tbl_softr_sub2 where softr_id='".$tid."'";
			$rr=mysqli_query($link,$sql_sr)or die(mysqli_error($link));
			
			$lot1=explode(",", $lotlist);
			$srt1=explode(",", $srtlist);
			for($i=0; $i<count($lot1); $i++)
			{
				if($lot1[$i]<>"")
				{
					$sql_srsub="Insert into tbl_softr_sub2 (softr_id, softrsub_lotno, softrsub_srtyp, softrsub_srflg) values('$tid', '$lot1[$i]', '$srt1[$i]', '1')";
					$ss=mysqli_query($link,$sql_srsub) or die(mysqli_error($link));
				}
			}
		}
		echo "<script>window.location='add_softrelease_preview2.php?tid=$tid'</script>";	
	}
	
	
	$a="TSL";
	$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr2  where yearcode='$yearid_id'  ORDER BY softr_tcode DESC";
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
<title>QC Manager - Transaction - Super Soft Release</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="softr2.js"></script>
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
	document.getElementById('postingsubtable').innerHTML="";
	document.frmaddDepartment.sllob[0].checked=false;
	document.frmaddDepartment.sllob[1].checked=false;
	showUser(classval,'vitem','item','','','','','','');
}

function varchk()
{
	document.getElementById('binselect').style.display="none";
	document.getElementById('postingsubtable').innerHTML="";
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
			document.getElementById('postingsubtable').innerHTML="";
			var crop=document.frmaddDepartment.txtcrop.value;
			var variety=document.frmaddDepartment.txtvariety.value;
			showUser(crop,'postingsubtable','showlist',variety,slval,'','','','');
		}
		else
		{
			document.frmaddDepartment.txt11.value=slval;
			document.getElementById('postingsubtable').innerHTML="";
			document.getElementById('binselect').style.display="block";
		}
	}
	else
	{
		document.frmaddDepartment.txt11.value="";
		document.getElementById('postingsubtable').innerHTML="";
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
           <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Super Soft Release</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php
$sql_srmain=mysqli_query($link,"Select * from tbl_softr2 where softr_id='".$tid."'") or die(mysqli_error($link));
$tot_srmain=mysqli_num_rows($sql_srmain);
$row_srmain=mysqli_fetch_array($sql_srmain);

	$tdate=$row_srmain['softr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
?>
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="<?php echo $row_srmain['softr_typ'];?>" type="hidden"> 
	    <input name="lotlist" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $row_srmain['softr_tcode']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="srtlist" value="" />
		
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Super Soft Release - Edit</td>
</tr>
<tr class="light" height="20">
  <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field</td>
</tr>

<tr class="Dark" height="30">
<td width="120" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="242"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TSF".$row_srmain['softr_tcode']."/".$yearid_id."/".$lgnid;?></td>
<td width="106" align="right" valign="middle" class="tblheading">&nbsp;Date</td>
<td width="272" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>
<td width="120" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="242" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($row_srmain['softr_crop']==$noticia['cropid']){ echo "selected";} ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_srmain['softr_crop']."' and actstatus='Active' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" onchange="varchk();">
<option value="" selected>--Select Variety-</option>
<?php while($noticia4 = mysqli_fetch_array($quer4)) { ?>
<option <?php if($row_srmain['softr_variety']==$noticia4['varietyid']){ echo "selected";} ?> value="<?php echo $noticia4['varietyid'];?>" />   
<?php echo $noticia4['popularname'];?>
<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
 </table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Select Display List type</td>
</tr>
<tr class="light" height="20">
  <td colspan="6" align="center" class="smalltblheading"><font color="#FF0000">Only Lots having status as:</font> <font color="#003366">QC UT / RT </font><font color="#FF0000">with </font> <font color="#003366">GOT-R UT / RT / OK / NUT  will be displayed</font>&nbsp;&nbsp;</td>
</tr>   
<tr class="Light" height="30">
   <td align="right"  valign="middle" class="tblheading" colspan="2"><input type="radio" name="sllob" value="sllot" onclick="srslchk(this.value);" <?php if($row_srmain['softr_typ']=="sllot") { echo "checked"; } ?>/></td>
  <td width="51%" align="left" valign="middle" class="tblheading" colspan="2">&nbsp;Display Complete Lot List</td>
</tr>
<tr class="Light" height="30">
   <td align="right"  valign="middle" class="tblheading" colspan="2"><input type="radio" name="sllob" value="slbin" <?php if($row_srmain['softr_typ']=="slbin") { echo "checked"; } ?> onclick="srslchk(this.value);" /></td>
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
<?php
	$crop = $row_srmain['softr_crop'];	 
	$variety = $row_srmain['softr_variety'];	 
	$type = $row_srmain['softr_typ'];	 
	$wh = $row_srmain['softr_wh'];	 
	$bin = $row_srmain['softr_bin'];	 
	$subbin = $row_srmain['softr_subbin'];	 

if($type=="sllot")	
{
$sql="SELECT distinct orlot, lotldg_got1 FROM tbl_lot_ldg WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot";
}
else
{
$sql="SELECT distinct orlot, lotldg_got1 FROM tbl_lot_ldg WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_whid='".$wh."' and lotldg_binid='".$bin."' and lotldg_subbinid='".$subbin."' and lotldg_srflg='0' and lotldg_qc!='NUT' and lotldg_qc!='Fail' order by orlot";
}
$sql_qc=mysqli_query($link,$sql)or die(mysqli_error($link));

$tt=mysqli_num_rows($sql_qc);
$countrec=0;

?>
<div id="binselect" style="display: <?php if($row_srmain['softr_typ']=="slbin") { echo "block"; } else { echo "none";} ?>">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 

<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
<tr class="Light" height="30" >

<td width="120" align="right"  valign="middle" class="tbltext">WH&nbsp;</td>
<td width="146" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:70px;" onchange="wh(this.value);"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($wh==$noticia_whd1['whid']){ echo "Selected";} ?> value="<?php echo $noticia_whd1['whid'];?>" />   
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
		<option <?php if($bin==$noticia_bing1['binid']){ echo "Selected"; } ?> value="<?php echo $noticia_bing1['binid'];?>" />   
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
		<option <?php if($subbin==$noticia_subbing1['sid']){ echo "Selected"; } ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<br />
<div id="postingsubtable">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="30">
	<td width="92" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="40" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="41" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="55" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="70" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="52" align="center" valign="middle" class="tblheading">Moist %</td>
	<td width="56" align="center" valign="middle" class="tblheading">Germ %</td>
	<td width="72" align="center" valign="middle" class="tblheading">GOT Status</td>
	<td colspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="56" align="center" valign="middle" class="tblheading">Select<br />
<a href="Javascript:vopid(0);" onclick="checkall();">CA</a> | <a href="Javascript:vopid(0);" onclick="clearall();">CL</a></td>
	<td width="90" align="center" valign="middle" class="tblheading">Soft Release</td>
</tr>
<?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_qc))
{
$flg=0;
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $stage="";	$sloc="";

$sql_qct=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home['orlot']."' order by tid desc") or die(mysqli_error($link));
$tot_qct=mysqli_num_rows($sql_qct);
if($tot_qct==0)
{
$flg=1;
}
//echo $flg;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where  orlot='".$row_arr_home['orlot']."'  and lotldg_balqty > 0  and lotldg_srflg='0' and lotldg_qc!='Fail'  order by orlot") or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_issue);
//if($zz==0)$flg=1;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$row_arr_home['orlot']."'  and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link)); 
 $xxz=mysqli_num_rows($sql_issuetbl);
//if($xxz==0)$flg=1;
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	//$tgotchk=explode(" ", $row_arr_home['lotldg_got1']);
	if($row_issuetbl['lotldg_balqty'] > 0)
	{
		if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
		{$flg=1;}
		if($tgot[0]=="GOT-NR")
		{
		$flg=1;
		}
		if($tgot[0]=="GOT-R" && $row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="Fail")
		{
		$flg=1;
		}
	}
	//echo $tgot[0];
	if($totgemp==0)$totgemp="";
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";

 $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_issuetbl['lotldg_balbags'];
$slqty=$slqty+$row_issuetbl['lotldg_balqty'];
 
if($slqty>0)
{
$stage=$row_issuetbl['lotldg_sstage'];

if($sloc!="")
$sloc=$sloc."<br/>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}

}
}

if($totqty>0 && $totnob==0)$totnob=1;

$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where orlot='".$row_arr_home['orlot']."' and balqty > 0 and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_issue);
//if($zz==0)$flg=1;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$row_arr_home['orlot']."' and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and lotldg_srflg='0' and lotldg_qc!='Fail' order by orlot") or die(mysqli_error($link)); 
 $xxz=mysqli_num_rows($sql_issuetbl);
//if($xxz==0)$flg=1;
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$row_issuetbl['balqty']; 
	//$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	//$tgotchk=explode(" ", $row_arr_home['lotldg_got1']); 
	if($row_issuetbl['balqty'] > 0)
	{
		if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
		{$flg=1;}
		if($tgot[0]=="GOT-NR")
		{
		$flg=1;
		}
		if($tgot[0]=="GOT-R" && $row_issuetbl['lotldg_got']=="OK" || $row_issuetbl['lotldg_got']=="Fail")
		{
		$flg=1;
		}
	}
	//echo $tgot[0];
	if($totgemp==0)$totgemp="";
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";

 $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

//$slups=$slups+$row_issuetbl['lotldg_balbags'];
$slqty=$row_issuetbl['balqty'];
 
if($slqty>0)
{
$stage=$row_issuetbl['lotldg_sstage'];

if($sloc!="")
$sloc=$sloc."<br/>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}

}
}

if($totqty==0)$flg++;

if($flg==0)
{
$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub2 WHERE softr_id='".$tid."' and softrsub_lotno='".$row_arr_home['orlot']."'") or die(mysqli_error($link));
$tot_srsub=mysqli_num_rows($sql_srsub);
$row_srsub=mysqli_fetch_array($sql_srsub);

$countrec++;
if($srno%2!=0)
{
?>
<tr class="Light" height="30">
	
	<td width="92" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['orlot'];?></td>
	<td width="40" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="41" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="52" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $stage;?></td>
	<td width="146" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><input type="checkbox" name="lotchk" id="fet<?php echo $srno;?>" onchange="chklot(<?php echo $srno;?>)" <?php if($tot_srsub > 0) { echo "checked";}?> value="<?php echo $row_arr_home['orlot'];?>" /></td>
	<td width="90" align="center" valign="middle" class="tblheading"><select class="tbltext" id="srtyp<?php echo $srno;?>" name="srtyp" style="width:80px;"  <?php if($tot_srsub == 0) { echo "disabled";}?>  >
<option value="" selected>--Select--</option>
<?php if($stage=="Raw"){ ?>
<option <?php if($row_srsub['softrsub_srtyp']=="condition") { echo "selected";}?> value="condition">Condition</option>
<option <?php if($row_srsub['softrsub_srtyp']=="pack") { echo "selected";}?> value="pack">Pack</option>
<option <?php if($row_srsub['softrsub_srtyp']=="dispatch") { echo "selected";}?> value="dispatch">Dispatch</option>
<?php }else if($stage=="Condition"){ ?>
<option <?php if($row_srsub['softrsub_srtyp']=="pack") { echo "selected";}?> value="pack">Pack</option>
<option <?php if($row_srsub['softrsub_srtyp']=="dispatch") { echo "selected";}?> value="dispatch">Dispatch</option>
<?php }else if($stage=="Pack"){ ?>
<option <?php if($row_srsub['softrsub_srtyp']=="dispatch") { echo "selected";}?> value="dispatch">Dispatch</option>
<?php }?>
</select></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
	
	<td width="92" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['orlot'];?></td>
	<td width="40" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="41" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="52" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="72" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="54" align="center" valign="middle" class="tblheading"><?php echo $stage;?></td>
	<td width="146" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><input type="checkbox" name="lotchk" id="fet<?php echo $srno;?>" onchange="chklot(<?php echo $srno;?>)" <?php if($tot_srsub > 0) { echo "checked";}?> value="<?php echo $row_arr_home['orlot'];?>" /></td>
	<td width="90" align="center" valign="middle" class="tblheading"><select class="tbltext" id="srtyp<?php echo $srno;?>" name="srtyp" style="width:80px;"  <?php if($tot_srsub == 0) { echo "disabled";}?>  >
<option value="" selected>--Select--</option>
<?php if($stage=="Raw"){ ?>
<option <?php if($row_srsub['softrsub_srtyp']=="condition") { echo "selected";}?> value="condition">Condition</option>
<option <?php if($row_srsub['softrsub_srtyp']=="pack") { echo "selected";}?> value="pack">Pack</option>
<option <?php if($row_srsub['softrsub_srtyp']=="dispatch") { echo "selected";}?> value="dispatch">Dispatch</option>
<?php }else if($stage=="Condition"){ ?>
<option <?php if($row_srsub['softrsub_srtyp']=="pack") { echo "selected";}?> value="pack">Pack</option>
<option <?php if($row_srsub['softrsub_srtyp']=="dispatch") { echo "selected";}?> value="dispatch">Dispatch</option>
<?php }else if($stage=="Pack"){ ?>
<option <?php if($row_srsub['softrsub_srtyp']=="dispatch") { echo "selected";}?> value="dispatch">Dispatch</option>
<?php }?>
</select></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
//}
?>
<?php
if($countrec==0)
{
?>
<tr class="Light" height="30">
	<td align="center" valign="middle" class="tblheading" colspan="12">Record not fount</td>
</tr>
<?php
}
?>
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
</table>

</div>
</div>
<br />

<table cellpadding="5" cellspacing="5" border="0" width="850" align="center">
<tr >
<td align="center" colspan="3"><a href="home_softrelease2.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input type="image" src="../images/preview.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
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

  