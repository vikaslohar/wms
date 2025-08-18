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

	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying -Transaction -Fresh Seed Arrival with PDN - Preview</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
</head>
<script src="farrival.js"></script>
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


function openslocpopprint()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
var remarks=document.frmaddDepartment.remarks.value
winHandle=window.open('fpdn_details_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}



function mySubmit()
{ 
	if(document.frmaddDepartment.date.value=="00-00-0000" || document.frmaddDepartment.date.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
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
           <td valign="top"><?php require_once("../include/arr_drying.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Fresh Seed Arrival with PDN- View</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arrival_type='Fresh Seed with PDN' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];
$lrole=$row_tbl['arr_role'];
	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['dc_date'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
	
	$tdate2=$row_tbl['disp_date'];
	$tyear2=substr($tdate2,0,4);
	$tmonth2=substr($tdate2,5,2);
	$tday2=substr($tdate2,8,2);
	$tdate2=$tday2."-".$tmonth2."-".$tyear2;

?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Fresh Seed Arrival with PDN - View</td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "AF".$row_tbl['arr_code']."/".$yearid_id."/".$lrole;?></td>

<td width="101" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="259" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Type of Arrival&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;Fresh Arrival with PDN</td>
	<td align="right"  valign="middle" class="tblheading">Dispatch Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>
           </tr>
		   <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">DC Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dcno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="99" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="99" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="642" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arrival_type='Fresh Seed with PDN' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' order by arrsub_id") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
    <td width="1%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="7%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-F</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-M</td>
	<td width="11%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	<td height="33" colspan="2" align="center" valign="middle" class="tblheading">PDN</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
 	<td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>
  	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
	<td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status </td>
	<td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td width="4%" colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    </tr>
 
<tr class="tblsubtitle">
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
   	<td width="3%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="5%" align="center" valign="middle" class="tblheading">Moist %</td>
    <td width="8%" align="center" valign="middle" class="tblheading">PP</td>
</tr>
<?php
	 	$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
		$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['lotvariety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['lotvariety'].",";
	}

$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NACC";
}
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>
  
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbldrywarehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbldrybin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>
  
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbldrywarehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbldrybin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    </tr>
<?php
}
$srno++;
}
}
?>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['remarks'];?></td>
</tr>
</table>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_freshpdn.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;</td>
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

  