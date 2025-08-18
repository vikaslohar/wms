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

	if(isset($_REQUEST['cropid']))
	{
	$pid = $_REQUEST['cropid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		  $p_id=trim($_POST['maintrid']);
		$remarks=trim($_POST['txtremarks']);
		$txtcla=trim($_POST['txtcla']);
		$txtdcno=trim($_POST['txtdcno']);
		$txtgrn=trim($_POST['txtgrn']);
		$txtor=trim($_POST['txtor']);
		$txt11=trim($_POST['txt11']);
		$txtcrop=trim($_POST['txtcrop']);
		$txtvariety=trim($_POST['txtvariety']);
		$txtstage=trim($_POST['txtstage']);
		$txtlot2=trim($_POST['txtlot2']);
		$txtvv=trim($_POST['txtvv']);
		$txtparty=trim($_POST['txtparty']);
		$remarks=str_replace("&","and",$remarks);
		
		if($txt11=="Transport")
		{
		$txttname=trim($_POST['txttname']);
		$txtlrn=trim($_POST['txtlrn']);
		$txtvn=trim($_POST['txtvn']);
		$txt14=trim($_POST['txt14']);
		}
		else
		{
		$txttname="";
		$txtlrn="";
		$txtvn="";
		$txt14="";
		}
		
		if($txt11=="Courier")
		{
		$txtcname=trim($_POST['txtcname']);
		$txtdc=trim($_POST['txtdc']);
		}
		else
		{
		$txtcname="";
		$txtdc="";
		}
		if($txt11=="By Hand")
		{ 
		$txtpname=trim($_POST['txtpname']);
		}
		else
		{
		$txtpname="";
		}
		
		/*<!--echo "<script>window.location='add_arrival_trading_preview.php?p_id=$pid&remarks=$remarks&txtlot=$txtcla&txtdcno=$txtdcno&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname'</script>";	
			
	}-->*/
	echo "<script>window.location='add_qc_preview.php?cropid=$p_id&txtvariety=$txtvariety&txtcrop=$txtcrop'</script>";	
			
	}
/*$sql_code="SELECT MAX(arr_code) FROM tbl_psw_main ORDER BY arr_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}
*/?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw- Transaction - psw  sampling</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading.js"></script>
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

function pform()
{	
var f=0;
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		f=1;
		return false;
	}
	
	if(document.frmaddDepartment.chk3.value=="")
	{
			alert("Please Select Qc Type ");
			f=1;
			return false;
	}
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mform','','','','','');
		
		}  
	}
//}

function pformedtup()
{	

	
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}

	if(document.frmaddDepartment.chk3.value=="")
	{
			alert("Please Select Qc Type ");
			f=1;
			return false;
	}
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformsubedt','','','','');
		//alert(a);
		}
	}
//}

function modetchk(classval)
{
	showUser(classval,'vitem','item','','','','','');
	document.frmaddDepartment.txtlot1.value="";
}
function modetchk1(classval)
{
	document.frmaddDepartment.txtlot1.value="";
}
	function openslocpop()
{
if(document.frmaddDepartment.txtcrop.value=="")
{
 alert("Please Select Crop.");
document.frmaddDepartment.txtcrop.focus();
}
if(document.frmaddDepartment.txtvariety.value=="")
{
alert("Please Select Variety first.");
document.frmaddDepartment.txtvariety.focus();
}
else
{
//var itm="Pack Seed";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
var trid=document.frmaddDepartment.maintrid.value;
winHandle=window.open('getuser_trading_lotno.php?crop='+crop+'&variety='+variety+'&trid='+trid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}

function editrec(edtrecid, trid)
{
//alert(trid);
showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
} 

function deleterec(v1,v2)
{
//alert("v1")
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','');
	}
	else
	{
		return false;
	}
}


function mySubmit()
{ 
	//alert(maintrid);
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	/*if(document.frmaddDepartment.chk1.value=="" && document.frmaddDepartment.chk2.value=="" && document.frmaddDepartment.chk3.value=="" && document.frmaddDepartment.chk4.value=="")
	{
			alert("Please Select Qc Type ");
			return false;
	}*/
return true;	 
}

function clk(cval)
{
//alert(document.frmaddDepartment.txt1.checked);
	if(document.frmaddDepartment.txt1.checked==true) 
	{
		document.frmaddDepartment.chk1.value=document.frmaddDepartment.txt1.value;
	}
	else
	{
		document.frmaddDepartment.chk1.value="";
	}
	
	if(document.frmaddDepartment.txt12.checked==true)
	{
		document.frmaddDepartment.chk2.value=document.frmaddDepartment.txt12.value;
	}
	else
	{
		document.frmaddDepartment.chk2.value="";
	}
	
	if(document.frmaddDepartment.txt14.checked==true)
	{
		document.frmaddDepartment.chk3.value=document.frmaddDepartment.txt15.value;
	}
	else
	{
		document.frmaddDepartment.chk3.value="";
	}
	
	if(document.frmaddDepartment.txt16.checked==true)
	{
		document.frmaddDepartment.chk4.value=document.frmaddDepartment.txt16.value;
	}
	else
	{
		document.frmaddDepartment.chk4.value="";
	}
}

function ltchk()
{
document.getElementById("postingsubtable").style.display="none";

		if(document.frmaddDepartment.txtlot1.value=="")
				{
					alert("Please enter Lot No.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
			if(document.frmaddDepartment.txtlot1.value.charCodeAt() == 32)
				{
					alert("Lot No cannot start with space.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(document.frmaddDepartment.txtlot1.value.length<6)
				{
				alert("Lot No cannot be less than 6 digits alphanumaric.");
				document.frmaddDepartment.txtlot1.focus();
				return false;
				}
			if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
				{
					alert("Lot No cannot start with Numaric value.");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(1)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(2)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(3)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(4)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
				if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(5)))
				{
					alert("Invalid Lot Number");
					document.frmaddDepartment.txtlot1.focus();
					return false;
				}
}/**/
</script>

<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - QC Sampling Request </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  

<?php 
  $tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_psw_main where plantcode='$plantcode' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbll=mysqli_fetch_array($sql_tbl);
	$tot=mysqli_num_rows($sql_tbl);				
$arrival_id=$row_tbll['arrival_id'];

	$tdate=$row_tbll['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_psw where plantcode='$plantcode' and arrival_id='".$arrival_id."'") or die(mysqli_error($link));
 $subtbltot=mysqli_num_rows($sql_tbl_sub);
 $arrival_id=$row_tbl_sub['arrival_id'];
$subtid=0;
?>	  

  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="<?php echo $row_tbl['mode'];?>" type="hidden"> 
	    <input type="hidden" name="txtid" value="<?php echo $row_tbl['arr_code']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit QC Sampling Request </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TRQ".$row_tbll['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date of Sampling Request&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Stage&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;Pack </td>

</tr>

</table>
<br/>
<div id="postingtable" style="display:block"><table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
              <td width="17" align="center" valign="middle" class="tblheading">#</td>
			   <td width="98" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="125" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="78" align="center" valign="middle" class="tblheading">Lot No. </td>
			  <td width="87" align="center" valign="middle" class="tblheading">NoP</td>
			  <td width="99" align="center" valign="middle" class="tblheading">NoMP</td>
              <td width="79" align="center" valign="middle" class="tblheading">Qty</td>
			   <td width="152" align="center" valign="middle" class="tblheading">SLOC</td>
               <td width="85" align="center" valign="middle" class="tblheading">QC Tests </td>
			   <td width="50" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="57" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
  <?php
 
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['crop']."'"); 
$row31=mysqli_fetch_array($quer3);
 $lot=$row_tbl_sub['lotno'];

 $row_tbl_sub['lotno'];
 $totqty=0; $totnob=0; $totnomp=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; 	$sloc=""; 
	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
$row_issue1[0];
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 $nop1=0;
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=($packtp[0]/1000);
}
else
{
	$ptp=$packtp[0];
}
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}

	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$nop1; 
	$totnomp=$totnomp+$row_issuetbl['balnomp'];

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sups=$sups+$row_issuetbl['balnomp'];
 $sqty=$sqty+$row_issuetbl['balqty'];

if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$nop1." | ".$sups." | ".$sqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$nop1." | ".$sups." | ".$sqty."<br/>";$tp1=12;

}


}




$pp="";
	 if($row_tbl_sub['pp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['pp'];
}
else
{
$pp=$row_tbl_sub['pp'];
}
}
if($row_tbl_sub['gemp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['gemp'];
}
else
{
$pp=$row_tbl_sub['gemp'];
}
}
if($row_tbl_sub['got']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['got'];
}
else
{
$pp=$row_tbl_sub['got'];
}
}
if($row_tbl_sub['moist']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['moist'];
}
else
{
$pp=$row_tbl_sub['moist'];
}
}


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $vv;?></td>
    <td width="71" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnob?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnomp?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
		<td width="132" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
        <td width="71" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="74" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $vv;?></td>
    <td width="71" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnob?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnomp?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
		<td width="132" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
	        <td width="71" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="74" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
</table>
<br/>

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
<?php   
// $row_tbl_sub['crop'];
$quer3=mysqli_query($link,"SELECT cropid,cropname from tblcrop  order by cropname Asc"); 	
	//$row31=mysqli_fetch_array($quer3);
?>
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:150px;"  onchange="modetchk(this.value)">
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['cropid']==$row_tbl_sub['crop']){ echo "Selected";} ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tbl_sub['crop']."' and actstatus='Active' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" name="txtvariety" style="width:170px;" id="itm">
<option value="" selected>--Select Variety--</option>
<?php while($noticia = mysqli_fetch_array($quer4)) { ?>
		<option <?php if($noticia['varietyid']==$row_tbl_sub['variety']){ echo "Selected";} ?> value="<?php echo $noticia['varietyid'];?>" />   		<?php echo $noticia['popularname'];?>
		<?php } ?>
		</select>
              <font color="#FF0000">*</font>&nbsp;</td>
           </tr>
         <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#0BC5F4" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
		  
		   <td align="right"  valign="middle" class="tblheading">&nbsp;Select QC Tests&nbsp;</td>
  <td  align="left"  valign="middle" class="tbltext" ><input name="txt1" <?php if($row_tbl_sub['pp']=="P"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="P" onclick="clk(this.value);"/>PP   
   &nbsp;
  <input name="txt12" <?php if($row_tbl_sub['moist']=="M"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="M" onclick="clk(this.value);"/>  
    Moisture  
    &nbsp;
    <input name="txt14" <?php if($row_tbl_sub['gemp']=="G"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="G" onclick="clk(this.value);"/>
    Germination 
    &nbsp;
    <!--<input name="txt16" <?php if($row_tbl_sub['got']=="T"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="T" onclick="clk(this.value);" />
GOT <font color="#FF0000">*</font>&nbsp;--></td>
</tr>

</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="chk" value="" />
<input type="hidden" name="chk1" value="" />
<input type="hidden" name="chk2" value="" />
<input type="hidden" name="chk3" value="" />
<input type="hidden" name="chk4" value="" />
<br />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>		  

</div></div>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_qc.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  