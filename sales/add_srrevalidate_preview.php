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
	if(isset($_REQUEST['sid']))
	{
	$sid = $_REQUEST['sid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$pid=trim($_POST['txtitem']);
		$sid=trim($_POST['sid']);
			
		$sql_arr=mysqli_query($link,"select * from tbl_srrevalidate where plantcode='$plantcode' AND srrv_id='".$pid."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$trdate=$row_arr['srrv_date'];
			$lotno=$row_arr['srrv_lotno'];
						
			$crop=$row_arr['srrv_crop'];
			$variety=$row_arr['srrv_variety'];
			$ststus="Pack";
			$oldlotno=$row_arr['salesrs_oldlot'];
			$stage="Pack";
			$zzz=implode(",", str_split($row_arr['srrv_lotno']));
			
			$gln=$zzz[0].$zzz[2].$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12].$zzz[14].$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24].$zzz[26].$zzz[28].$zzz[30];
			$orlot=$gln;
			$upss=$row_arr['srrv_ups'];
			$labels=$row_arr['srrv_slable']."-".$row_arr['srrv_elable'];
			
			$sql_variety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
			$row_variety=mysqli_fetch_array($sql_variety);
			
			$sno=0;
			$p1_array=explode(",",$row_variety['gm']);
			$p1_array2=explode(",",$row_variety['wtmp']);
			$p1_array3=explode(",",$row_variety['mptnop']);
			$p1=array();
			foreach($p1_array as $val1)
			{
				if($val1<>"")
				{
					$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
					$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
					$row12=mysqli_fetch_array($res);
					
					$upps=$row12['ups'].$row12['wt'];
					if($upps==$ups)
					{
						$wtmp=$p1_array2[$sno];
						$mptnop=$p1_array3[$sno];
					}
					$sno++;	
				}
			}	
			
			
			$sql_qc1=mysqli_query($link,"Select max(tid) from tbl_qctest where plantcode='$plantcode' AND lotno='".$row_arr['srrv_lotno']."'") or die(mysqli_error($link));
			$row_qc1=mysqli_fetch_array($sql_qc1);
			
			$sql_qc=mysqli_query($link,"Select * from tbl_qctest where plantcode='$plantcode' AND tid='".$row_qc1[0]."'") or die(mysqli_error($link));
			$row_qc=mysqli_fetch_array($sql_qc);
			
			$moist=$row_qc['moist'];
			$gemp=$row_qc['gemp'];
			$vchk=$row_qc['pp'];
			$genpurity=$row_qc['genpurity'];
			
			$qc=$row_arr['srrv_qc'];
			$dovalidy=$row_arr['srrv_valperiod'];
			$dov=$row_arr['srrv_valupto'];
			$dovdays=$row_arr['srrv_valdays'];
				
			$dot=$row_arr['srrv_dot'];
			$got=$row_arr['srrv_got'];
			$got1=$row_arr['srrv_got1'];
			$dogr=$row_arr['srrv_dogt'];
			$dop=$row_arr['srrv_dorvp'];			
			//$got2=$got." ".$got1;
			
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_srrevalidate_sub where plantcode='$plantcode' AND srrv_id ='".$row_arr['srrv_id'] ."'") or die(mysqli_error($link));
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$whid=$row_arrsub['srrvs_whid'];
				$binid=$row_arrsub['srrvs_binid'];
				$subbinid=$row_arrsub['srrvs_sbinid'];
				$ups=$row_arrsub['srrvs_nop'];
				$qty=$row_arrsub['srrvs_qty'];
					
				$opups=0;
				$opqty=0;
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
					
				$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, trstage, packtype, lotno, packlabels, barcodes, wtinmp, opnop, opnomp, optqty, whid, binid,  subbinid,  nop, nomp, tqty, balnop, balnomp, balqty, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_qctestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_gottestdate, lotldg_got, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto,plantcode) values('$yearid_id', 'SRRV', '$pid', '$stage', '$upss', '$lotno', '$labels', '', '$wtmp', '0', '0', '0', '$whid', '$binid', '$subbinid', '$ups', '0' ,'$qty', '$balups', '0', '$balqty', '$trdate', '$crop', '$variety', '$stage', '', '$moist', '$gemp', '$vchk', '$got', '$qc', '$dot', '$orlot', '', '', '$dogr', '$got1', '', '', '$genpurity', '$dop', '$dovalidy', '$dov', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						
				$sql_itm="update tbl_subbin set status='$ststus' where sid='$subbinid'";
				mysqli_query($link,$sql_itm) or die(mysqli_error($link));
			}
		}
		
		$sql_code="SELECT MAX(srrv_code) FROM tbl_srrevalidate where plantcode='$plantcode' AND srrv_yearcode='$yearid_id'  ORDER BY srrv_code DESC";
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
			
		$sql_btslm2="update tbl_srrevalidate set srrv_tflg=1, srrv_code='$code' where srrv_id='$pid'";
		$xcvb=mysqli_query($link,$sql_btslm2) or die(mysqli_error($link));
		
		$sql_btslm23="update tbl_salesrv_sub set salesrs_rvflg=1 where salesrs_id='$sid'";
		$xcvb3=mysqli_query($link,$sql_btslm23) or die(mysqli_error($link));
		//exit;
		echo "<script>window.location='select_srrv_op.php?p_id=$pid'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return -Transaction - Sales Return - Re-Validate - Preview</title>
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

winHandle=window.open('srrv_details_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Sales Return - Re-Validate - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_srrevalidate where plantcode='$plantcode' AND srrv_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['srrv_id'];

	$tdate=$row_tbl['srrv_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['srrv_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl['srrv_variety']."' and actstatus='Active' order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);

?> 
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
		<input type="Hidden" name="sid" value="<?php echo $sid?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return - Re-Validate</td>
</tr>

 <tr class="Dark" height="30">
<td width="234" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="314"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TRV".$row_tbl['srrv_tcode']."/".$row_tbl['srrv_yearcode']."/".$row_tbl['srrv_logid'];?></td>

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
<td align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_lotno'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_ups'];?></td>
</tr>
<?php

$dot="";
if($row_tbl['srrv_dot']!="")
{
$dt=explode("-",$row_tbl['srrv_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
$dgt=explode("-",$row_tbl['srrv_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];

$dvt=explode("-",$row_tbl['srrv_dorvp']);
$dorvp=$dvt[2]."-".$dvt[1]."-".$dvt[0];

$dovt=explode("-",$row_tbl['srrv_valupto']);
$dov=$dovt[2]."-".$dovt[1]."-".$dovt[0];

if($dot!="")
{
	$trdate2=explode("-",$dot);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
		$m=$trdate2[1];
		$de=$trdate2[2];
		$y=$trdate2[0];
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}
//echo $dp3;
$orlot=$row_tbl['srrv_lotno'];
?>
<tr class="Light" height="30" >
<td align="right" width="174"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td align="left" width="257" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_enop'];?></td>	
<td align="right" width="236" valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left" width="269" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_eqty'];?></td>	
</tr>
<tr class="Light" height="30" >
<td align="right"   valign="middle" class="tblheading">QC Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['srrv_qc'];?></td>	
<td align="right"  valign="middle" class="tblheading">DoT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dot;?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">GoT Status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $row_tbl['srrv_got'];?></td>
<td align="right"  valign="middle" class="tblheading">DoGT&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"   >&nbsp;<?php echo $dogt;?></td>
<input type="hidden" name="orlot" value="<?php echo $row_arrival['srrv_lotno'];?>" />
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="9">Re-Validation Details</td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Re-Validate/Packing Slip Ref. No.&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['srrv_rvpsrn'];?></td>
<td align="right" valign="middle" class="tblheading" colspan="3">Date of Re-Validation/Packing&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading" id="pltno">&nbsp;<?php echo $dorvp;?></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">NoP for QC Sample&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['srrv_qcnop'];?></td>
<td width="107" align="right" valign="middle" class="tblheading">Balance Pouches&nbsp;</td>
<td width="108" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['srrv_bnop'];?></td>
<td align="right" valign="middle" class="tblheading">Balance Quantity&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['srrv_bqty'];?></td>
</tr>
<tr class="Light" height="25">
<td width="191" align="right" valign="middle" class="tblheading">Validity Period&nbsp;</td>
<td width="170" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['srrv_valperiod'];?>&nbsp;Months</td>
<td width="107" align="right" valign="middle" class="tblheading">Valid upto&nbsp;</td>
<td width="108" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $dov;?></td>
<td width="112" align="right" valign="middle" class="tblheading">Validity Days&nbsp;</td>
<td width="148" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl['srrv_valdays'];?>&nbsp;From DoT</td>
</tr>
<tr class="Light" height="25">  
<td align="right" valign="middle" class="tblheading">Label No.&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="6">&nbsp;<?php echo $row_tbl['srrv_slable']." - ".$row_tbl['srrv_elable'];?></td>
</tr>
<input type="hidden" name="pcktype" id="pcktype" value="" />
</table><br />
<?php
	
	$sql_sub=mysqli_query($link,"Select * from tbl_srrevalidate_sub where plantcode='$plantcode' AND srrv_id='$arrival_id'") or die(mysqli_error($link));
	$tot_sub=mysqli_num_rows($sql_sub);
	
?>
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
  	<td width="26" align="center" valign="middle" class="tblheading">#</td>
    <td width="143" align="center" valign="middle" class="tblheading">WH</td>
    <td width="140" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="167" align="center" valign="middle" class="tblheading">Sub Bin</td>
	<td width="179" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="181" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
  
$srno=1;
if($tot_sub>0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_sub['srrvs_whid']."' order by perticulars") or die(mysqli_error($link));
$noticia_whg1 = mysqli_fetch_array($whg1_query);

$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_sub['srrvs_binid']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bing1_query);

$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_sub['srrvs_sbinid']."'") or die(mysqli_error($link));
$noticia_sbing1 = mysqli_fetch_array($subbing1_query);
if($srno%2==0)
{
?>
<tr class="Light" height="30" >
	<td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $srno;?></td>
	<td width="143" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="140" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="167" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="179"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['srrvs_nop'];?></td>
	<td width="181" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['srrvs_qty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30" >
	<td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $srno;?></td>
	<td width="143" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
	<td width="140" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_bing1['binname'];?></td>
	<td width="167" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_sbing1['sname'];?></td>
	<td align="center" width="179"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['srrvs_nop'];?></td>
	<td width="181" align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub['srrvs_qty'];?></td>
</tr>
<?php
}$srno++;
}
}
?>
</table>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_srrevalidate.php?pid=<?php echo $pid;?>&sid=<?php echo $sid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="verflg" value="<?php echo $verflg;?>" /></td>
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

  