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
	
	if(isset($_REQUEST['pid'])) { $pid = $_REQUEST['pid']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//$connnew = mysqli_connect("localhost","wfuser","P1o5RSOloG8jCAN8") or die("Error:".mysqli_error($connnew));
		//$dbnew = mysqli_select_db($connnew,"wmsfocusdb") or die("Error:".mysqli_error($connnew));
		
		$todaydate=date('Y-m-d');
		$sql_mp=mysqli_query($link,"select * from tbl_stoutmpack where stoutmp_id='".$pid."'") or die(mysqli_error($link));
		while($row_mp=mysqli_fetch_array($sql_mp))
		{
			$sql_mpsub2=mysqli_query($link,"select * from tbl_stoutsspack where stoutmp_id='".$pid."'") or die(mysqli_error($link));
			$a_mpsub2=mysqli_num_rows($sql_mpsub2);
			while($row_mpsub2=mysqli_fetch_array($sql_mpsub2))
			{
				$sql_main2="update tbl_mpmain set mpmain_dflg=1, mpmain_altrid='$pid' where mpmain_barcode='".$row_mpsub2['stoutssp_barcode']."'";
				//$a123=mysqli_query($link,$sql_main2) or die(mysqli_error($link));
				
				$sql_barcode="update tbl_barcodes set bar_dispflg=1 where bar_barcode='".$row_mpsub2['stoutssp_barcode']."' ";
				//mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
			}			
		}
		
		
		$sql_arr=mysqli_query($link,"select * from tbl_stoutmpack where stoutmp_id='".$pid."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$sql_arrsub=mysqli_query($link,"select * from tbl_stoutspack where stoutmp_id='".$pid."'") or die(mysqli_error($link));
			$a_arrsub=mysqli_num_rows($sql_arrsub);
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$arrival_date=$row_arr['stoutmp_ddate'];
				$crop=$row_arrsub['stoutsp_crop'];
				$variety=$row_arrsub['stoutsp_variety'];
				$lotno=$row_arrsub['stoutsp_lotno'];
				
				
				$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotno='".$row_arrsub['stoutsp_lotno']."' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
				
					$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotno='".$row_arrsub['stoutsp_lotno']."'  order by lotdgp_id desc ") or die(mysqli_error($link));
					$row_is1=mysqli_fetch_array($sql_is1); 
						
					$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty > 0 order by lotdgp_id asc") or die(mysqli_error($link));
					
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_istbl))
						{ 
							$whid=$row_issuetbl['whid'];
							$binid=$row_issuetbl['binid'];
							$subbinid=$row_issuetbl['subbinid'];
							$opups=$row_issuetbl['balnomp'];
							$opqty=$row_issuetbl['balqty'];
							$nop1=$row_arrsub['stoutsp_loadnop'];
							$nomp1=$row_arrsub['stoutsp_loadnomp'];
							$qty1=$row_arrsub['stoutsp_loadqty'];
							$balups=$opups-$nomp1;
							$balqty=$opqty-$qty1;
							
							$sstage=$row_issuetbl['lotldg_sstage'];
							$sstatus=$row_issuetbl['lotldg_sstatus'];
							$moist=$row_issuetbl['lotldg_moisture'];
							$gemp=$row_issuetbl['lotldg_gemp'];
							$vchk=$row_issuetbl['lotldg_vchk'];
							$got1=$row_issuetbl['lotldg_got1'];
							$qc=$row_issuetbl['lotldg_qc'];
							
							$gotstatus=$row_issuetbl['lotldg_got'];
							$qctestdate=$row_issuetbl['lotldg_qctestdate'];
							$gottestdate=$row_issuetbl['lotldg_gottestdate'];
							$orlot=$row_issuetbl['orlot'];
							//$gs=$row_issuetbl['lotldg_gs'];
							$resverstatus=$row_issuetbl['lotldg_resverstatus'];
							$revcomment=$row_issuetbl['lotldg_revcomment'];
							$geneticpurity=$row_issuetbl['lotldg_genpurity'];
							$yearcode=$row_issuetbl['yearcode'];
							$srtype=$row_issuetbl['lotldg_srtyp'];
							$srflg=$row_issuetbl['lotldg_srflg'];
							
							$packlabels=$row_issuetbl['packlabels'];	
							$wtinmp=$row_issuetbl['wtinmp'];
							$trstage=$row_issuetbl['trstage'];
							$packtype=$row_issuetbl['packtype'];
							
							$lotldg_dop=$row_issuetbl['lotldg_dop'];	
							$valupto=$row_issuetbl['lotldg_valupto'];
							$valperiod=$row_issuetbl['lotldg_valperiod'];
							
							$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode,trtype, lotldg_id, lotldg_trdate, lotno, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnomp, optqty, nomp, tqty, balnomp, balqty, lotldg_sstage, lotldg_sstatus,  	lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, packlabels, wtinmp, trstage, packtype, nop, lotldg_dop, lotldg_valupto, lotldg_valperiod,plantcode) values('$yearcode','Stock Transfer Out-Pack', '$pid', '$todaydate', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nomp1', '$qty1', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$srtype', '$srflg', '$packlabels', '$wtinmp', '$trstage', '$packtype', '$nop1', '$lotldg_dop', '$valupto', '$valperiod','$plantcode')";
							//exit;
							$scv=mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
						}
					}
				}
				
			


		
			
			



				
				
			}
		}
		
		$sql_code1="SELECT MAX(stoutmp_code) FROM tbl_stoutmpack where plantcode='".$plantcode."' ORDER BY stoutmp_code DESC";
		$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
			
		if(mysqli_num_rows($res_code1) > 0)
		{
			$row_code1=mysqli_fetch_row($res_code1);
			$t_code1=$row_code1['0'];
			$ncode1=$t_code1+1;
		}
		else
		{ 
			$ncode1=1;
		}
		
		$ttime=date("h:i:s A");
		$sql_main="update tbl_stoutmpack set stoutmp_tflg=1, stoutmp_code='$ncode1', stoutmp_ddate='$todaydate', ttime='$titme' where stoutmp_id='$pid'";
		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		
		
		$quer33=mysqli_query($link,"select * from tblfnyears where years_flg =1 and years_status='a'"); 
		$noticia33 = mysqli_fetch_array($quer33);
		$yr=$noticia33['ycode'];
		
		$sql_code1="SELECT MAX(gid) FROM tbl_gatepass where plantcode='".$plantcode."' and  yearcode='$yr'";
		$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
			
		if(mysqli_num_rows($res_code1) > 0)
		{
			$row_code1=mysqli_fetch_row($res_code1);
			$t_code1=$row_code1['0'];
			$code1=$t_code1+1;
		}
		else
		{
			$code1=1;
		}
		
		$sql_main22="insert into tbl_gatepass (gid, trid, trtype, gdate, yearcode,plantcode) values ('$code1', '$pid', 'Stock Transfer Out-Pack' ,'$todaydate', '$yr','$plantcode')";
		$aa22=mysqli_query($link,$sql_main22) or die(mysqli_error($link));	
		
		$sql_code="SELECT MAX(dnote_code) FROM tbl_dispnote where plantcode='".$plantcode."' and  dnote_trtype='Stock Transfer Out-Pack' and dnote_yearcode='$yr'";
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
					
		$sql_main23="insert into tbl_dispnote (dnote_code, dnote_trid, dnote_trtype, dnote_date, dnote_ptype, dnote_logid, dnote_yearcode,plantcode) values ('$code', '$pid', 'Stock Transfer Out-Pack' ,'$todaydate' ,'Plant' ,'$logid' ,'$yr','$plantcode')";
		$aa23=mysqli_query($link,$sql_main23) or die(mysqli_error($link));
		 		
		echo "<script>window.location='select_stocktrn_packseed_op.php?p_id=$pid'</script>";	
		//exit;
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch Stock Transfer</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script src="dispsttrn.js"></script>
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

var pid=document.frmaddDepartment.pid.value;
winHandle=window.open('issue_dispstocktrnpack_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
		document.frmaddDepartment.submit();
		return true;	 
	}
	else
	{
		return false;
	}
}
</script>

<body >

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch Stock Transfer - Plant</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
 <?php
$tid=$pid; 

$sql_tbl=mysqli_query($link,"select * from tbl_stoutmpack where plantcode='".$plantcode."' and  stoutmp_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

	$tdate=$row_tbl['stoutmp_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
$arrival_id=$row_tbl['stoutmp_id'];

$quer5=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['stoutmp_plantid']."' order by stcode asc"); 
$noticia2 = mysqli_fetch_array($quer5); 
$plantname=$noticia2['business_name'];

	
$subtid=0;
?> 
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();"   > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="txt11" value="" type="hidden"> 
	<input name="txt14" value="" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input name="pid" type="hidden" value="<?php echo $pid;?>" />
	
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Stock Transfer - Plant</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="158" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "STRN".$row_tbl['stoutmp_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="191" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
  <tr class="Dark" height="30">
<td width="158"  align="right"  valign="middle" class="tblheading">Plant Name&nbsp;</td>
<td  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<?php echo $plantname;?></td>
	</tr>

<tr class="Dark" height="30">
<td width="158" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $noticia2['address'];?><?php if($noticia2['city']!="") { echo ", ".$noticia2['city']; }?>, <?php echo $noticia2['state'];?></div></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3" >&nbsp;<?php echo $row_tbl['stoutmp_tmode'];?><input name="txt11" value="<?php echo $row_tbl['stoutmp_tmode'];?>" type="hidden"> </td>
</tr>
<?php
if($row_tbl['stoutmp_tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_tname'];?><input name="txttname" value="<?php echo $row_tbl['stoutmp_tname'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_lorryrepno'];?><input name="txtlrn" value="<?php echo $row_tbl['stoutmp_lorryrepno'];?>" type="hidden"></td>
</tr>

<tr class="Light" height="25">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" >&nbsp;<?php echo $row_tbl['stoutmp_tvehno'];?><input name="txtvn" value="<?php echo $row_tbl['stoutmp_tvehno'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_paymode'];?>&nbsp;(Transport)<input name="txt13" value="<?php echo $row_tbl['stoutmp_paymode'];?>" type="hidden"></td>
</tr>
<?php
}
else if($row_tbl['stoutmp_tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_couriername'];?><input name="txtcname" value="<?php echo $row_tbl['stoutmp_couriername'];?>" type="hidden"></td>
<td align="right" valign="middle" class="smalltblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_docketno'];?><input name="txtdc" value="<?php echo $row_tbl['stoutmp_docketno'];?>" type="hidden"></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" valign="middle" class="smalltblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutmp_pnamebyhand'];?><input name="txtpname" value="<?php echo $row_tbl['stoutmp_pnamebyhand'];?>" type="hidden"></td>
</tr>
<?php
}
?>
</table>
<br />
<div id="postingtable" style="display:block">

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Stock Transfer Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="25" align="center" class="smalltblheading">#</td>
	<td width="131" align="center" class="smalltblheading">Crop</td>
	<td width="199" align="center" class="smalltblheading">Variety</td>
	<td width="165" align="center" class="smalltblheading">Lot No.</td>
	<td width="85" align="center" class="smalltblheading">UPS</td>
	<td width="71" align="center" class="smalltblheading">NoP</td>
	<td width="71" align="center" class="smalltblheading">NoMP</td>
	<td width="82" align="center" class="smalltblheading">Qty</td>
	<!--<td width="74" align="center" class="smalltblheading">Edit</td>-->
	<!--<td width="72" align="center" class="smalltblheading">Delete</td>-->
</tr>
<?php 
$srno=1;
//echo "Select * from tbl_stoutspack where stoutmp_id='$pid' and stoutsp_subflg=1 order by stoutsp_id asc";
$sql_sub=mysqli_query($link,"Select * from tbl_stoutspack where plantcode='".$plantcode."' and stoutmp_id='$pid' and stoutsp_subflg=1 order by stoutsp_id asc") or die(mysqli_error($link));
if($tot_sub=mysqli_num_rows($sql_sub) > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stoutsp_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$crop=$noticia_class['cropname'];

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stoutsp_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variety=$noticia_item['popularname'];

$lotn=$row_sub['stoutsp_lotno'];
$stgw=$row_sub['stoutsp_ups'];
$nop=$row_sub['stoutsp_loadnop'];
$nomp=$row_sub['stoutsp_loadnomp'];
$qtys=$row_sub['stoutsp_loadqty'];

if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nop;?></td>
	<td align="center" class="smalltblheading"><?php echo $nomp;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<!--<td align="center" class="smalltblheading"><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_sub['stouts_id'];?>);" /></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nop;?></td>
	<td align="center" class="smalltblheading"><?php echo $nomp;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<!--<td align="center" class="smalltblheading"><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_sub['stouts_id'];?>);" /></td>-->
</tr>
<?php
}
$srno++;
}
}
?>
</table>
<br />
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="70" align="right" valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="774" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['stoutm_ramarks'];?></td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_dispp2p_packseed.php?maintrid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  
