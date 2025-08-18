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

	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$pid=trim($_POST['txtitem']);
			
		$sql_arr=mysqli_query($link,"select * from tbl_unpsp2c where plantcode='$plantcode' AND unp_id='".$pid."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$trdate=$row_arr['unp_date'];
			$ltn=$row_arr['unp_lotno'];
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_newlot='".$ltn."'") or die(mysqli_error($link));
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$crop=$row_arrsub['salesrs_crop'];
				$variety=$row_arrsub['salesrs_variety'];
				$ststus="Condition";
				$oldlotno=$row_arrsub['salesrs_oldlot'];
				$stage="Condition";
				$gln=$row_arrsub['salesrs_orlot'];
				$lotno=$gln."C";
				
				$ups=$row_arrsub['salesrs_ups'];
				$dcnob=$row_arrsub['salesrs_nob'];
				$dcqty=$row_arrsub['salesrs_qty'];
				$gnob=$row_arrsub['salesrs_nobdc'];
				$gqty=$row_arrsub['salesrs_qtydc'];
				$dovalidy=$row_arrsub['salesrs_dov'];
				$moist=$row_arrsub['salesrs_moist'];
				$gemp=$row_arrsub['salesrs_gemp'];
				$vchk=$row_arrsub['salesrs_pp'];
				$qc=$row_arrsub['salesrs_qc'];	
				$dot=$row_arrsub['salesrs_dot'];
				$got=$row_arrsub['salesrs_got'];
				$got1=$row_arrsub['salesrs_got1'];
				$dogr=$row_arrsub['salesrs_dogt'];
				$rettype=$row_arrsub['salesrs_rettype'];			
				$got2=$got." ".$got1;
				
				
				$whid=$row_arr['unp_cwh1'];
				$binid=$row_arr['unp_cbin1'];
				$subbinid=$row_arr['unp_csbin1'];
				$ups=$row_arr['unp_cnob1'];
				$qty=$row_arr['unp_cqty1'];
					
				$opups=0;
				$opqty=0;
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
					
				$sql_sub_sub="insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty,  lotldg_balbags,  lotldg_balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, orlot, lotldg_qctestdate, lotldg_got1, lotldg_gottestdate, lotldg_got, plantcode) values('$yearid_id', '$lotno', 'SRP2C', '$pid', '$trdate', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty' ,'$stage', '$moist', '$gemp', '$vchk', '$qc', '$gln', '$dot', '$got2', '$dogr', '$got1', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						
				$sql_itm="update tbl_subbin set status='$ststus' where sid='$subbinid'";
				mysqli_query($link,$sql_itm) or die(mysqli_error($link));
				
				if($row_arr['unp_cqty2'] > 0)
				{
					$whid=$row_arr['unp_cwh2'];
					$binid=$row_arr['unp_cbin2'];
					$subbinid=$row_arr['unp_csbin2'];
					$ups=$row_arr['unp_cnob2'];
					$qty=$row_arr['unp_cqty2'];
						
					$opups=0;
					$opqty=0;
					$balups=$opups+$ups;
					$balqty=$opqty+$qty;
						
					$sql_sub_sub="insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty,  lotldg_balbags,  lotldg_balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, orlot, lotldg_qctestdate, lotldg_got1, lotldg_gottestdate, lotldg_got, plantcode) values('$yearid_id', '$lotno', 'SRP2C', '$pid', '$trdate', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty' ,'$stage', '$moist', '$gemp', '$vchk', '$qc', '$gln', '$dot', '$got2', '$dogr', '$got1', '$plantcode')";
					mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
							
					$sql_itm="update tbl_subbin set status='$ststus' where sid='$subbinid'";
					mysqli_query($link,$sql_itm) or die(mysqli_error($link));
				}
				
				$sql_itm2="update tbl_salesrv_sub set salesrs_rvflg=1 where salesrs_id='".$row_arrsub['salesrs_id']."'";
				mysqli_query($link,$sql_itm2) or die(mysqli_error($link));
			}
		}
		
		$sql_code="SELECT MAX(unp_code) FROM tbl_unpsp2c where plantcode='$plantcode' AND unp_yearcode='$yearid_id'  ORDER BY unp_code DESC";
		$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code) > 0)
		{
			$row_code=mysqli_fetch_row($res_code);
			$t_code=$row_code['0'];
			$code=$t_code+1;
		}
		else
		{
			$code=1;
		}	
		$sql_btslm2="update tbl_unpsp2c set unp_tflg=1, unp_code='$code' where unp_id='$pid'";
		$xcvb=mysqli_query($link,$sql_btslm2) or die(mysqli_error($link));
		//exit;
		echo "<script>window.location='select_srp2c_op.php?p_id=$pid'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return -Transaction - SR Unpacking - Pack to Condition (P2C) - Preview</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
</head>
<script src="farrival1.js"></script>
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

winHandle=window.open('srp2c_details_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	if(document.frmaddDepartment.verflg.value!=0)
	{
		alert("Please Verify the Sales Return Lots first");
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
           <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" style="border-bottom:solid; border-bottom-color:#a8a09e" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SR Unpacking - Pack to Condition (P2C) - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_unpsp2c where plantcode='$plantcode' AND unp_logid='".$logid."' and unp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['unp_id'];

	$tdate=$row_tbl['unp_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['unp_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl['unp_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);

?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">SR Unpacking - Pack to Condition (P2C)</td>
</tr>

 <tr class="Dark" height="30">
<td width="234" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="314"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TPC".$row_tbl['unp_tcode']."/".$row_tbl['unp_yearcode']."/".$row_tbl['unp_logid'];?></td>

<td width="138" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="274" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td width="234" align="right" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_ups'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_lotno'];?></td>
</tr>
<?php

$sql_arrival=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_crop='".$row_tbl['unp_crop']."' and salesrs_variety='".$row_tbl['unp_variety']."' and salesrs_rettype='P2P' and salesrs_rvflg=0 and salesrs_ups='".$row_tbl['unp_ups']."' and salesrs_newlot='".$row_tbl['unp_lotno']."'") or die(mysqli_error($link));
$row_arrival=mysqli_fetch_array($sql_arrival);

$dot="";
if($row_arrival['salesrs_dot']!="")
{
$dt=explode("-",$row_arrival['salesrs_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
$dgt=explode("-",$row_arrival['salesrs_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];
$got=$row_arrival['salesrs_got']." ".$row_arrival['salesrs_got1'];

//echo $row_arrival['salesrs_typ'];

$nop="";$qty="";$ewh="";$ebin="";$esbin="";
//if($row_arrival['salesrs_typ']=="verrec")
//{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		$ewh=$row1['salesrss_wh'];
		$ebin=$row1['salesrss_bin'];
		$esbin=$row1['salesrss_subbin'];
	}
	/*else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		$ewh=$row_arrival['salesrs_wh'];
		$ebin=$row_arrival['salesrs_bin'];
		$esbin=$row_arrival['salesrs_subbin'];
	}
}*/
else if($row_arrival['salesrs_typ']=="vernew")
{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		$ewh=$row1['salesrss_wh'];
		$ebin=$row1['salesrss_bin'];
		$esbin=$row1['salesrss_subbin'];
	}
	else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		$ewh=$row_arrival['salesrs_wh'];
		$ebin=$row_arrival['salesrs_bin'];
		$esbin=$row_arrival['salesrs_subbin'];
	}
}
else
{
	$nop=$row_arrival['salesrs_nobdc'];
	$qty=$row_arrival['salesrs_qtydc'];
	$ewh=$row_arrival['salesrs_wh'];
	$ebin=$row_arrival['salesrs_bin'];
	$esbin=$row_arrival['salesrs_subbin'];
}
?>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tbltext">&nbsp;<?php echo $nop;?></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tbltext">&nbsp;<?php echo $qty;?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_arrival['salesrs_qc'];?></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dot;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $got;?></td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dogt;?></td>
<input type="hidden" name="orlot" value="<?php echo $row_arrival['salesrs_orlot'];?>" />
</table>
<br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" valign="middle" class="tblheading">SR Condition Seed - SLOC Details</td>
  </tr>
  <!--<tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="279" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="271" rowspan="2" align="center" valign="middle" class="tblheading">SR Condition Seed</td>
  </tr>-->
  <tr class="tblsubtitle" height="20">
    <td width="157" align="center" valign="middle" class="tblheading">WH</td>
    <td width="145" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="173" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="183" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="180" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
$cnt=0;
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_tbl['unp_cwh1']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg1 = mysqli_fetch_array($whg1_query);

$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_tbl['unp_cbin1']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bing1_query);

$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_tbl['unp_csbin1']."'") or die(mysqli_error($link));
$noticia_sbing1 = mysqli_fetch_array($subbing1_query);
?>
<tr class="Light" height="30" >
	<td width="157" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="145" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="173" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="183"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_cnob1'];?></td>
	<td width="180" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_cqty1'];?></td>
</tr>
<?php
if($row_tbl['unp_cqty2'] > 0)
{
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_arrival['unp_cwh2']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg2 = mysqli_fetch_array($whg2_query);

$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_tbl['unp_cbin2']."'") or die(mysqli_error($link));
$noticia_bing2 = mysqli_fetch_array($bing2_query);

$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_tbl['unp_csbin2']."'") or die(mysqli_error($link));
$noticia_sbing2 = mysqli_fetch_array($subbing2_query);
?>
<tr class="Light" height="30" >
	<td width="157" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg2['perticulars'];?></td>
	<td width="145" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing2['binname'];?></td>
	<td width="173" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing2['sname'];?></td>
	<td align="center" width="183"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_cnob2'];?></td>
	<td width="180" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['unp_cqty2'];?></td>
</tr>
<?php
}
?>
</table>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_p2c.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="verflg" value="<?php echo $verflg;?>" /></td>
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

  