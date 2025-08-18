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
		$dt=date("Y-m-d");	
		
		$sql_arr=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$pid."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			//$trdate=$row_arr['salesr_date'];
			$sqlsub2="update tbl_salesrv_sub set salesrs_dovfy='$dt' where salesr_id='".$pid."'";
			$qqp2=mysqli_query($link,$sqlsub2) or die(mysqli_error($link));
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$pid."' and salesrs_rectyp='Yes'") or die(mysqli_error($link));
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$trdate=$row_arrsub['salesrs_dovfy'];
				
				$crop=$row_arrsub['salesrs_crop'];
				$variety=$row_arrsub['salesrs_variety'];
				$ststus=$row_arrsub['salesrs_stage'];
				$lotno=$row_arrsub['salesrs_newlot'];
				$oldlotno=$row_arrsub['salesrs_oldlot'];
				$stage=$row_arrsub['salesrs_stage'];
				$gln=$row_arrsub['salesrs_orlot'];
				
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
				
				if($gqty>0)
				{
					$sql_srnsr=mysqli_query($link,"select * from tbl_salesrv_nsr where plantcode='$plantcode' AND salesrs_id='".$row_arrsub['salesrs_id']."'") or die(mysqli_error($link));
					if($tot_srnsr=mysqli_num_rows($sql_srnsr)>0)
					{
						$sql_code12="SELECT MAX(srnsr_code) FROM tbl_salesrv_nsr where plantcode='$plantcode' AND srnsr_yearcode='$yearid_id' ORDER BY srnsr_code DESC";
						$res_code12=mysqli_query($link,$sql_code12)or die(mysqli_error($link));
								
						if(mysqli_num_rows($res_code12) > 0)
						{
							$row_code12=mysqli_fetch_row($res_code12);
							$t_code12=$row_code12['0'];
							if($t_code12>0)
								$ncode12=$t_code12+1;
							else
								$ncode12=90001;
							$ncode12=sprintf("%00005d",($ncode12));
						}
						else
						{
							$ncode12=90001;
						}
						
						$zzz=implode(",", str_split($row_arrsub['salesrs_newlot']));
						   
						$lotch1=$zzz[4].$zzz[6].$zzz[8].$zzz[10].$zzz[12];
						//$lotch2=$zzz[16].$zzz[18].$zzz[20].$zzz[22].$zzz[24];
						$lotch3=$zzz[28].$zzz[30];
						
						$lotno=$zzz[0].$zzz[2].$lotch1."/".$ncode12."/".$lotch3.$zzz[32];
						$orlot=$zzz[0].$zzz[2].$lotch1."/".$ncode12."/".$lotch3;
						$gln=$zzz[0].$zzz[2].$lotch1."/".$ncode12."/".$lotch3;
						
						$sql_itm2="update tbl_salesrv_nsr set srnsr_code='$ncode12', srnsr_tflg=1 where salesrs_id='".$row_arrsub['salesrs_id']."'";
						mysqli_query($link,$sql_itm2) or die(mysqli_error($link));
						
						$sql_itm23="update tbl_salesrv_sub set salesrs_newlot='$lotno', salesrs_orlot='$orlot' where salesrs_id='".$row_arrsub['salesrs_id']."'";
						mysqli_query($link,$sql_itm23) or die(mysqli_error($link));
					}
					
					$zz=str_split($lotno);
					$oltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];
					if($gln=="")$gln=$oltno;
					
					if($lotno!="")
					{
						$sql_arrsub_sub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesr_id='".$pid."' and salesrs_id='".$row_arrsub['salesrs_id']."'") or die(mysqli_error($link));
						while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
						{
							$whid=$row_arrsub_sub['salesrss_wh'];
							$binid=$row_arrsub_sub['salesrss_bin'];
							$subbinid=$row_arrsub_sub['salesrss_subbin'];
							$ups=$row_arrsub_sub['salesrss_nob'];
							$qty=$row_arrsub_sub['salesrss_qty'];
							
							if($rettype=="P2C")
							{
							$opups=0;
							$opqty=0;
							$balups=$opups+$ups;
							$balqty=$opqty+$qty;
								
							$sql_sub_sub="insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty,  lotldg_balbags,  lotldg_balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, orlot, lotldg_qctestdate, lotldg_got1, lotldg_gottestdate, lotldg_got, plantcode) values('$yearid_id', '$lotno', 'Sales Return', '$pid', '$trdate', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty' ,'$stage', '$moist', '$gemp', '$vchk', '$qc', '$gln', '$dot', '$got2', '$dogr', '$got1', '$plantcode')";
							mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
							
							$sql_itm="update tbl_subbin set status='$ststus' where sid='$subbinid'";
							mysqli_query($link,$sql_itm) or die(mysqli_error($link));
							}
							else
							{
							/*$opups=0;
							$opqty=0;
							$balups=$opups+$ups;
							$balqty=$opqty+$qty;
								
							$sql_sub_sub="insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty,  lotldg_balbags,  lotldg_balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, orlot, lotldg_qctestdate) values('$yearid_id', '$lotno', 'Sales Return', '$pid', '$trdate', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty' ,'$stage', '$moist', '$gemp', '$vchk', '$qc', '$gln', '$dot')";
							mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));*/
							
							$sql_itm="update tblsrsubbin set status='$ststus' where sid='$subbinid'";
							mysqli_query($link,$sql_itm) or die(mysqli_error($link));
							}
					
						}
						
							
						$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where yearid='$yearid_id' ORDER BY tid DESC";
						$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
							
						if(mysqli_num_rows($res_code1) > 0)
						{
							$row_code1=mysqli_fetch_row($res_code1);
							$t_code1=$row_code1['0'];
							$ncode1=$t_code1+1;
							//$ncode1=sprintf("%004d",$ncode1);
						}
						else
						{
							$ncode1=1;
						}
							
						$qc1="UT";
						$state="";
						if($qc=="UT" || $qc=="RT")
						{
							$state="P/M/G"; $qc1="UT";
						}
						if($got1=="UT")
						{
							if($state!="")
							$state=$state."/"."T";
							else
							$state="T";
						}
						$dogt=$trdate;	
						$classid=$crop;
						$itemid=$variety;	
						if($qc1=="UT" && $got1!="UT")
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, dosdate, bflg, gotdate, gotflg, gotstatus,yearid,logid,plantcode)values('$vchk', '$moist', '$got1', '$lotno', '$trdate', '$classid', '$itemid', '$ncode1', '$stage', '$qc', '$state',1,'$gln', '$trdate',0,'$dogt',1, '$got1','$yearid_id','$logid','$plantcode')";
						}
						else if($qc1!="UT" && $got1=="UT")
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, dosdate, bflg, testdate, qcflg, qcstatus,gotsmpdflg,yearid,logid,plantcode)values('$vchk', '$moist', '$got1', '$lotno', '$trdate', '$classid', '$itemid', '$ncode1', '$stage', '$qc', '$state',1,'$gln', '$trdate',0,'$dot',1, '$qc',1,'$yearid_id','$logid','$plantcode')";
						}	
						else if($qc1=="UT" || $got1=="UT")
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, bflg,yearid,logid,plantcode)values('$vchk', '$moist', '$got1', '$lotno', '$trdate', '$classid', '$itemid', '$ncode1', '$stage', '$qc', '$state',1,'$gln',0,0,'$yearid_id','$logid','$plantcode')";
						}	
						else
						{
							$sql_sub_sub12="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop,  variety, sampleno, trstage, qc, state, gs, oldlot, spdate, dosdate, bflg, testdate, qcflg, gotdate, gotflg, qcstatus,gotsmpdflg, gotstatus,yearid,logid,plantcode)values('$vchk', '$moist', '$got1', '$lotno', '$trdate', '$classid', '$itemid', '$ncode1', '$stage', '$qc', '$state',1,'$gln', '$trdate', '$trdate',1,'$dot',1,'$dogt',1, '$qc',1, '$got1','$yearid_id','$logid','$plantcode')";
						}	
						mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));	
					}
				}
			}
		}
		
		$sql_main="update tbl_salesrv set salesr_vflg=1 where salesr_id = '$pid'";
	
		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		
		echo "<script>window.location='select_slrop_returnverfy.php?p_id=$pid'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return -Transaction - Verification - Preview</title>
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
var remarks=document.frmaddDepartment.remarks.value
winHandle=window.open('slrverfy_details_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Sales Return - Verification - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['salesr_id'];

	$tdate=$row_tbl['salesr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['salesr_dcdate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
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
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return - Verification</td>
</tr>

 <tr class="Dark" height="30">
<td width="234" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="314"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "SR".$row_tbl['salesr_code']."/".$row_tbl['salesr_yearcode']."/".$row_tbl['salesr_logid'];?></td>

<td width="138" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="274" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
<td width="234" align="right" valign="middle" class="tblheading">Party DC Date&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate1;?></td>
<td align="right"  valign="middle" class="tblheading">Party DC No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcno'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_partytype'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading">SRI No.&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo sprintf("%00005d",$row_tbl['salesr_slrno']);?></td>
</tr>
</table>
<div id="selectpartylocation"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{	
$sql_month=mysqli_query($link,"select * from tblproductionlocation where state='".$row_tbl['salesr_state']."' and productionlocationid='".$row_tbl['salesr_loc']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?><table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="234"  align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_state'];?></td>
	<td width="138"  align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<?php echo $noticia['productionlocation'];?></td>
  </tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td width="234"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td width="730" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_loc'];?></td>
</tr>
</table>
<?php
}
?>
</div>		   
<div id="selectparty"style="display:block" >
<?php
if($row_tbl['salesr_partytype']!="Export Buyer")
{
$sql_month=mysqli_query($link,"select * from tbl_partymaser where location_id='".$row_tbl['salesr_loc']."' and classification='".$row_tbl['salesr_partytype']."' and p_id='".$row_tbl['salesr_party']."' order by business_name")or die(mysqli_error($link));
}
else
{
$sql_month123=mysqli_query($link,"select * from tblcountry where  country='".$row_tbl['salesr_loc']."'")or die(mysqli_error($link));
$noticia123 = mysqli_fetch_array($sql_month123);
$c=$noticia123['c_id'];
$sql_month=mysqli_query($link,"select * from tbl_partymaser where country='".$c."' and classification='".$row_tbl['salesr_partytype']."' and p_id='".$row_tbl['salesr_party']."' order by business_name")or die(mysqli_error($link));
}
$noticia = mysqli_fetch_array($sql_month);

?>		   
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >   
 <tr class="Light" height="30">
<td width="235"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="729"  colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia['business_name'];?></td>
	</tr>

<tr class="Dark" height="30">
<td width="235" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia['address'];?><?php if($noticia['city']!="") { echo ", ".$noticia['city']; }?>, <?php echo $noticia['state'];?></div></td>
</tr>
</table>
</div>	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e"  > 

<!--<tr class="Light" height="30">
<td width="234" align="right"  valign="middle" class="tblheading">No. of Packages&nbsp;</td>
<td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_dcnop'];?></td>

<td width="138" align="right"  valign="middle" class="tblheading">Type of Packages&nbsp;</td>
<td width="274" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_packtyp'];?></td>
</tr>-->
<tr class="Light" height="25">
<td width="234" align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['salesr_tmode'];?></td>
</tr>
</table>

<table id="trans" align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="Transport") echo "block"; else echo "none";?>" > 
<tr class="Light" height="30">
<td align="right" width="234" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_tname'];?></td>
<td width="138" align="right"  valign="middle" class="tblheading" style="border-color:#a8a09e">Lorry Receipt No&nbsp;</td>
<td align="left" width="274" valign="middle" class="tbltext" colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_lrno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="234" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="314" valign="middle" class="tbltext"  style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_pmode'];?>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="Courier") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="234" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="314" valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_cname'];?></td>
<td align="right" width="138" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="274" valign="middle" class="tbltext" colspan="3" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_docket'];?></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="display:<?php if($row_tbl['salesr_tmode']=="By Hand") echo "block"; else echo "none";?>" > 
<tr class="Dark" height="30">
<td align="right" width="234" valign="middle" class="tblheading" style="border-color:#a8a09e">&nbsp;Name of Person&nbsp;</td>
<td width="730" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#a8a09e">&nbsp;<?php echo $row_tbl['salesr_pname'];?></td>
</tr>

</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" valign="middle" class="tblheading">Packages</td>
  </tr>
<tr class="Light" height="30">
<td width="234" align="right"  valign="middle" class="tblheading">&nbsp;</td>
<td align="center"  valign="middle" class="tblheading">As per DC</td>
<td align="center"  valign="middle" class="tblheading">Actual Received</td>
<td align="center"  valign="middle" class="tblheading">Excess/Shortage</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Cartons&nbsp;</td>
<td width="314" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_dnop'];?></td>
<td width="138" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1'];?></td>
<td width="274" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_dnop1']-$row_tbl['salesr_dnop'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Bags&nbsp;</td>
<td width="314" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_nob'];?></td>
<td width="138" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1'];?></td>
<td width="274" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_nob1']-$row_tbl['salesr_nob'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Total Packages&nbsp;</td>
<td width="314" align="center"  valign="middle" class="tbltext"><?php echo $row_tbl['salesr_tnop'];?></td>
<td width="138" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1'];?></td>
<td width="274" align="center"  valign="middle" class="tblheading"><?php echo $row_tbl['salesr_tnop1']-$row_tbl['salesr_tnop'];?></td>
</tr>
</table>
<?php
$srsloc=""; $wareh=""; $binn=""; $wareh2=""; $binn2="";
if($row_tbl['salesr_nop'] > 0)
{
$sql_whouse=mysqli_query($link,"select perticulars from tblpvwarehouse where plantcode='$plantcode' AND whid='".$row_tbl['salesr_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tblpvbin where plantcode='$plantcode' AND binid='".$row_tbl['salesr_bin']."' and whid='".$row_tbl['salesr_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']." | ".$row_tbl['salesr_nop'];
}
if($row_tbl['salesr_nop1'] > 0)
{
$sql_whouse2=mysqli_query($link,"select perticulars from tblpvwarehouse where plantcode='$plantcode' AND whid='".$row_tbl['salesr_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse2=mysqli_fetch_array($sql_whouse2);
$wareh2=", ".$row_whouse2['perticulars']."/";

$sql_binn2=mysqli_query($link,"select binname from tblpvbin where plantcode='$plantcode' AND binid='".$row_tbl['salesr_bin']."' and whid='".$row_tbl['salesr_wh']."'") or die(mysqli_error($link));
$row_binn2=mysqli_fetch_array($sql_binn2);
$binn2=$row_binn2['binname']." | ".$row_tbl['salesr_nop1'];
}
$srsloc=$wareh.$binn.$wareh2.$binn2;
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="234" valign="middle" class="tblheading" >&nbsp;SR-PV SLOC&nbsp;</td>
<td width="730" colspan="8" align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $srsloc;?></td>
</tr>

</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Pre Verification</td>
</tr>	
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_typ='verrec'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$subsubtid=0; $verflg=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="123" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="191" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="114" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="124" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="115" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="202" align="center" valign="middle" class="tblheading">Verify</td>
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
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}

if($row_tbl_sub['salesrs_vflg']==0)$verflg++;

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']==0){?><a href="Javascript:void(0);" onclick="showverifysc(<?php echo $row_tbl_sub['salesrs_id'];?>);">Verify</a><?php }else{?>verified<?php }?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_vflg']==0){?><a href="Javascript:void(0);" onclick="showverifysc(<?php echo $row_tbl_sub['salesrs_id'];?>);">Verify</a><?php }else{?>verified<?php }?></td>
</tr>
<?php
}
$srno++;
}
}

?>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['salesr_remarks'];?></td>
</tr>
</table>
<br />
<div id="postingsubtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Post Verification</td>
</tr>	
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_trtype='Sales Return' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_vflg!=0") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$subsubtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="59" align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
	<td width="90" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
	<td width="59" align="center" valign="middle" class="tblheading" rowspan="2">SR Item Found</td>
	<td width="51" align="center" valign="middle" class="tblheading" rowspan="2">Old Lot No.</td>
	<td width="52" align="center" valign="middle" class="tblheading" rowspan="2">New Lot No.</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">As per DC</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Good</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Actual Damage</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Excess / Shortage</td>
	<td width="36" align="center" valign="middle" class="tblheading" rowspan="2">QCSR</td>
	<td width="117" align="center" valign="middle" class="tblheading" rowspan="2">SLOC</td>
	<!--<td width="26" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
	<td width="45" align="center" valign="middle" class="tblheading" rowspan="2">Delete</td>-->
</tr>
<tr class="tblsubtitle" height="20">
	<td width="59" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="36" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="43" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="41" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="42" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="39" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
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
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$slups=$row_tbl_sub['salesrs_ups']; 
$slnob=$row_tbl_sub['salesrs_nob']; 
$slqty=$row_tbl_sub['salesrs_qty'];

$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slnob);
if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
$slocs="";
$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_tbl_sub['salesrs_id']."'") or die(mysqli_error($link));
while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
{
	if($row_tbl_sub['salesrs_rettype']=="P2C")
	{
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$sloc=$wareh.$binn.$subbinn;
		if($slocs!="")
		$slocs=$slocs."<br/>".$sloc;
		else
		$slocs=$sloc;
	}
	else
	{
		$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$sloc=$wareh.$binn.$subbinn;
		if($slocs!="")
		$slocs=$slocs."<br/>".$sloc;
		else
		$slocs=$sloc;
	}
}

$nob=0; $qty=0;
if($row_tbl_sub['salesrs_typ']=="verrec") { $nob=$difn; $qty=$difq; }
$xn=$row_tbl_sub['salesrs_nobdc']+$row_tbl_sub['salesrs_nobdamage'];
$xnob=$xn-$nob;
$xb=floatval($row_tbl_sub['salesrs_qtydc'])+floatval($row_tbl_sub['salesrs_qtydamage']);
$xqty=floatval($xb)-floatval($qty);
$xqty=number_format($xqty, 3, '.', ',');
if($xnob==0 && $xqty!=0)$xqty=0;
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_rectyp'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_rectyp']=="Yes") echo "UT"; else echo ""; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <!--<td width="26" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="45" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_rectyp'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_nobdamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qtydamage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $xqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_rectyp']=="Yes") echo "UT"; else echo ""; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	 <!--<td width="26" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
   <td width="45" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>-->
</tr>
<?php
}
$srno++;
}
}

?>
</table>
</div>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_sales_returnverfy.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="verflg" value="<?php echo $verflg;?>" /></td>
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

  
