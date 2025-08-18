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
	
	if(isset($_REQUEST['ep_id']))
	{
		$epid = $_REQUEST['ep_id'];
	}
	
	if(isset($_REQUEST['txtstfp']))
	{
		$txtstfp=trim($_REQUEST['txtstfp']);
	}
	
	if(isset($_REQUEST['txtcrop']))
	{
		$txtcrop=trim($_REQUEST['txtcrop']);
	}
	
	if(isset($_REQUEST['txtvariety']))
	{
		$txtvariety=trim($_REQUEST['txtvariety']);
	}
	
	if(isset($_REQUEST['sstage']))
	{
		$sstage=trim($_REQUEST['sstage']);
	}
	
	if(isset($_REQUEST['txtstfp']))
	{
		$txtstfp=trim($_REQUEST['txtstfp']);
	}
	
	if(isset($_REQUEST['txt11']))
	{
		$txt11 = $_REQUEST['txt11'];
	}
	
	if(isset($_REQUEST['txttname']))
	{
		$txttname = $_REQUEST['txttname'];
	}
	
	if(isset($_REQUEST['txtlrn']))
	{
		$txtlrn = $_REQUEST['txtlrn'];
	}
	
	if(isset($_REQUEST['txtvn']))
	{
		$txtvn = $_REQUEST['txtvn'];
	}
	
	if(isset($_REQUEST['txt14']))
	{
		$txt14 = $_REQUEST['txt14'];
	}
	
	if(isset($_REQUEST['txtcname']))
	{
		$txtcname = $_REQUEST['txtcname'];
	}
	
	if(isset($_REQUEST['txtdc']))
	{
		$txtdc = $_REQUEST['txtdc'];
	}
	
		if(isset($_REQUEST['txtdcno']))
	{
		$txtdcno = $_REQUEST['txtdcno'];
	}
	
	if(isset($_REQUEST['txtpname']))
	{
		$txtpname = $_REQUEST['txtpname'];
	}
	
	if(isset($_REQUEST['remarks']))
	{
		$remarks = $_REQUEST['remarks'];
	}
	
	if(isset($_REQUEST['txtsttp']))
	{
		$txtsttp=trim($_REQUEST['txtsttp']);
	}
	
	if(isset($_REQUEST['dcdate']))
	{
		 $dc=trim($_REQUEST['dcdate']);
	}
//$sql_main="update tblarrival set lotcrop='$txtcrop', lotvariety='$txtvariety', nolot='$txtlot', sstage='$sstage',  tmode='$txt11', trans_name='$txttname', trans_lorryrepno='$txtlrn', trans_vehno='$txtvn', trans_paymode='$txt14', courier_name='$txtcname', docket_no='$txtdc', pname_byhand='$txtpname', remarks='$remarks',dcno='$txtdcno',party_id='$txtstfp' where arrival_id = '$pid'";
//$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));


	
if(isset($_POST['frm_action'])=='submit')
{
	//exit;
	$pid=trim($_POST['txtitem']);
	
	$sql_arr=mysqli_query($link,"select * from tbl_arrpack where arrpack_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
		$tdate11=$row_arr['arrpack_date'];
		$sql_arrsub=mysqli_query($link,"select * from tbl_arrpack_sub where arrpack_id='".$pid."' and plantcode='$plantcode' order by arrpacks_id asc") or die(mysqli_error($link));
		while($row_arrsub=mysqli_fetch_array($sql_arrsub))
		{
			$crop=$row_arrsub['arrpacks_crop'];
			$variety=$row_arrsub['arrpacks_variety'];
			
			$sql_crop=mysqli_query($link,"select * from tblvariety where popularname='$variety'") or die(mysqli_error($link));
			$row_crop=mysqli_fetch_array($sql_crop);
			$classid=$row_crop['cropid'];
			
			$classid=$row_crop['cropname'];
			$itemid=$row_crop['varietyid'];	
			$lotno=$row_arrsub['arrpacks_lotno'];
			$moist=$row_arrsub['arrpacks_moist'];
			$gemp=$row_arrsub['arrpacks_germ'];
			$qc=$row_arrsub['arrpacks_qcstatus'];
			$got=$row_arrsub['arrpacks_gotstatus'];
			$tdate=$row_arrsub['arrpacks_qcdot'];
			$pklable=$row_arrsub['arrpacks_pklable1'];
			$ups=$row_arrsub['arrpacks_ups'];
			$vchk=$row_arrsub['arrpacks_pp'];
			$dop=$row_arrsub['arrpacks_dop'];
			$dov=$row_arrsub['arrpacks_dov'];
			$wtinmp=$row_arrsub['arrpacks_wtmp'];
			
			if($row_arrsub['arrpacks_srtype']!="")
				$srtype=$row_arrsub['arrpacks_srtype'];
			else
				$srtype=$row_arrsub['arrpacks_ssrtype'];
			
			$gotrusl="";
			if($got!="")
			{
				$gotr=explode(" ",$got);
				$gotrusl=$gotr[0];
			}
			$got1=$row_arrsub['arrpacks_gotstatus'];
			$gotdate=$row_arrsub['arrpacks_gotdate'];
			
			$olot=str_split($lotno);
			$orlot=$olot[0].$olot[1].$olot[2].$olot[3].$olot[4].$olot[5].$olot[6].$olot[7].$olot[8].$olot[9].$olot[10].$olot[11].$olot[12].$olot[13].$olot[14].$olot[15];
			
			$sql_arrsub_sub=mysqli_query($link,"select * from  `tbl_arrpack_subsub` where arrpack_id='".$pid."' and arrpacks_id='".$row_arrsub['arrpacks_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
			while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
			{
				$whid=$row_arrsub_sub['arrpackss_whid'];
				$binid=$row_arrsub_sub['arrpackss_binid'];
				$subbinid=$row_arrsub_sub['arrpackss_subbinid'];
				$nomp=$row_arrsub_sub['arrpackss_nomp'];
				$qty=$row_arrsub_sub['arrpackss_qty'];
				
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where lotldg_variety='".$itemid."' and lotldg_crop='".$classid."' and lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				$tot_issue1=mysqli_num_rows($sql_issue1);
				//echo $row_issue1[0];
				if($row_issue1[0] != "")
				{	
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotldg_id='".$row_issue1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
					$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
					$opups=$row_issuetbl['balnomp'];
					$opqty=$row_issuetbl['balqty'];
					$balups=$opups+$nomp;
					$balqty=$opqty+$qty;
				}
				else
				{
					$opups=0;
					$opqty=0;
					$balups=$opups+$nomp;
					$balqty=$opqty+$qty;
				}
				
				$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, lotno, trtype, lotldg_id, lotldg_trdate, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnomp, optqty, packtype, nomp, tqty, balnomp, balqty, lotldg_sstage, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_qc, lotldg_got1, lotldg_sstatus, orlot, lotldg_qctestdate, lotldg_got, lotldg_gottestdate, lotldg_dop, lotldg_srtyp, lotldg_valupto, wtinmp, plantcode) values('$yearid_id', '$lotno', 'Stock Transfer Arrival - Pack', '$pid', '$tdate11', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$nomp', '$qty', '$balups', '$balqty', 'Pack', '$moist', '$gemp', '$vchk', '$qc', '$gotrusl', '$sstatus', '$orlot', '$tdate', '$got', '$gotdate', '$dop', '$srtype', '$dov', '$wtinmp', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				//exit;
				
				$sql_arr_barcode=mysqli_query($link,"select * from  tbl_arrpack_barcode where arrpacks_id='".$row_arrsub['arrpacks_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
				while($row_arr_barcode=mysqli_fetch_array($sql_arr_barcode))
				{
					$bar=$row_arr_barcode['arrpackss2_barcode'];
					$mptyp=$row_arr_barcode['arrpackss2_bartype'];
					$mptnop=$row_arr_barcode['arrpackss2_lotnop'];
					$lotnop=$row_arr_barcode['arrpackss2_lotnop'];
					$lotqty=$row_arr_barcode['arrpackss2_barqty'];
					$grswt=$row_arr_barcode['arrpackss2_grosswt'];
					$upkflg=$row_arr_barcode['arrpackss2_upkflg'];
					
					if($row_arr_barcode['arrpackss2_bartype']=="SMC")
					{
						$trtyp="PACKSMC";
						$sql_main="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtyp, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_mptype, mpmain_wtmp, mpmain_mptnop, mpmain_lotnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid, mpmain_upflg, plantcode) values('$tdate11', '$pid', 'Arrival', '$trtyp', '$classid', '$itemid', '$lotno', '$ups', '$bar', '$mptyp', '$wtinmp', '$mptnop', '$lotnop', '$lotnop', '$lotqty', '$lotnop', '$lotqty', '$lotnop', '$lotqty', '$whid', '$binid', '$subbinid', '$yearid_id', '$logid', '$upkflg', '$plantcode')";
						mysqli_query($link,$sql_main) or die(mysqli_error($link));
					}
						
					if($row_arr_barcode['arrpackss2_bartype']=="LMC")
					{
						$trtyp="PACKLMC";
						$lotnop=""; $lot="";
						$sql_arr_barcode1=mysqli_query($link,"select * from  tbl_arrpack_barcode where arrpacks_id='".$row_arrsub['arrpacks_id']."' and arrpackss2_barcode='".$row_arr_barcode['arrpackss2_barcode']."' and plantcode='$plantcode' order by arrpackss2_id asc") or die(mysqli_error($link));
						while($row_arr_barcode1=mysqli_fetch_array($sql_arr_barcode1))
						{
							if($lotnop!="")
								$lotnop=$lotnop.",".$row_arr_barcode1['arrpackss2_lotnop'];
							else
								$lotnop=$row_arr_barcode1['arrpackss2_lotnop'];
								
							
							if($lotnop!="")
								$lot=$lotnop.",".$row_arr_barcode1['arrpackss2_lotno'];
							else
								$lot=$row_arr_barcode1['arrpackss2_lotno'];	
							
						}	
						$sql_main="insert into tbl_mpmain (mpmain_date, mpmain_trid, mpmain_trtyp, mpmain_trtype, mpmain_crop, mpmain_variety, mpmain_lotno, mpmain_upssize, mpmain_barcode, mpmain_mptype, mpmain_wtmp, mpmain_mptnop, mpmain_lotnop, mpmain_opnop, mpmain_opqty, mpmain_nop, mpmain_qty, mpmain_balnop, mpmain_balqty, mpmain_wh, mpmain_bin, mpmain_subbin, mpmain_yearcode, mpmain_logid, mpmain_upflg, plantcode) values('$tdate11', '$pid', 'Arrival', '$trtyp', '$classid', '$itemid', '$lot', '$ups', '$bar', '$mptyp', '$wtinmp', '$mptnop', '$lotnop', '$lotnop', '$lotqty', '$lotnop', '$lotqty', '$lotnop', '$lotqty', '$whid', '$binid', '$subbinid', '$yearid_id', '$logid', '$upkflg', '$plantcode')";
						mysqli_query($link,$sql_main) or die(mysqli_error($link));
						
					}
					
					$sql_barcode="insert into tbl_barcodes (bar_trid, bar_trtype, bar_lotno, bar_orlot, bar_barcode, bar_wtmp, bar_grosswt, logid, yearid, bar_crop, bar_variety, bar_ups, bar_dop, bar_vdate, bar_netweight, bar_unpackflg, plantcode) values('$pid', 'Arrival', '$lotno', '$orlot', '$bar', '$wtinmp', '$grswt', '$logid', '$yearid_id', '$classid', '$itemid', '$ups', '$dop', '$dov', '$lotqty', '$upkflg','$plantcode')";
					mysqli_query($link,$sql_barcode) or die(mysqli_error($link));
				//exit;
				}
			}
		}
	}
	
	$sql_code="SELECT MAX(arrpack_code) FROM tbl_arrpack where arrpack_yearcode='$yearid_id' and plantcode='$plantcode' ORDER BY arrpack_code DESC";
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
	
	$dcdate=date('Y-m-d');
	$sql_main="update tbl_arrpack set arrpack_arrtrflg=1, arrpack_dcdate='$dcdate', arrpack_code=$code where arrpack_id = '$pid'";
	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	
	$mainarrflg=1;
	$sql_impsub=mysqli_query($link,"SELECT * FROM tbl_stlotimp_pack_sub where stlotimpp_id='$epid' and plantcode='$plantcode' ORDER BY stlotimpps_id asc") or die(mysqli_error($link));
	while($row_impsub=mysqli_fetch_array($sql_impsub))
	{
		if($row_impsub['stlotimpp_balqty']!=0)
			$mainarrflg=0;
	}
	
	$sql_updimp="update tbl_stlotimp_pack set stlotimpp_trflg='$mainarrflg' where stlotimpp_id = '$epid'";
	$imp=mysqli_query($link,$sql_updimp) or die(mysqli_error($link));
	//exit;
	
	echo "<script>window.location='select_arrival_packstockop.php?p_id=$pid'</script>";	
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Arrival Pack Seed Stock Transfer Plant - Preview</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
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
if(document.mainform.txtitem.value!="")
{
var itm=document.mainform.txtitem.value;
var remarks=document.mainform.remarks.value
winHandle=window.open('packstock_view.php?itmid='+itm+'&remarks='+remarks,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.mainform.txtitem.focus();
}
}



function mySubmit()
{ 
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
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Arrival Pack Seed Stock Transfer - Plant - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form name="mainform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		<input type="hidden" name="dcdate" value="<?php echo $tdate1?>" />
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['arrival_code']?>" />

		</br>

<?php 

 $tid=$pid;
?>
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_arrpack where arrpack_logid='".$logid."' and arrpack_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrpack_id'];


	$tdate=$row_tbl['arrpack_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$dc;
	/*$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
*/
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading"> Arrival Pack Seed Stock Transfer - Plant - Preview </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="196"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arrpack_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['arrpack_plantcode']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Stock Transfer from Plant&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $row3['business_name'];?></td>
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
?>

</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address'];?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?>&nbsp;</td>
</tr>
<?php
if($row_tbl['arrpack_tmode'] == "Transport")
{
?>
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_transname'];?></td>
<td width="207" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_lrno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="196" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['arrpack_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['arrpack_tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="196" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_couriername'];?></td>
<td align="right" width="207" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_docketno'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['arrpack_pname'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">

<?php
$sql_tbl=mysqli_query($link,"select * from tbl_arrpack where arrpack_logid='".$logid."' and arrpack_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrpack_id'];
?>
<tr class="tblsubtitle" height="20">
	<td width="31" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
	<td width="55" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
	<td width="58" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="75" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Dispatch</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Received</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
	<td width="48" rowspan="2" align="center" valign="middle" class="tblheading">Quality Status</td>
	<td width="43" rowspan="2" align="center" valign="middle" class="tblheading">PP</td>
	<td width="44" rowspan="2" align="center" valign="middle" class="tblheading">Moist %</td>
	<td width="50" rowspan="2" align="center" valign="middle" class="tblheading">Germ. %</td>
	<td width="35" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type</td>
	<td colspan="4" align="center" valign="middle" class="tblheading">SLOC</td>
</tr>
<tr class="tblsubtitle">
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="35" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="48" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="35" align="center" valign="middle" class="tblheading">WH</td>
	<td width="33" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="33" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="51" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
  <?php
$srno=1;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_arrpack_sub where arrpack_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

	$crop=$row_tbl_sub['arrpacks_crop'];
	$variety=$row_tbl_sub['arrpacks_variety'];
	$lotno=$row_tbl_sub['arrpacks_lotno'];
	$qc=$row_tbl_sub['arrpacks_qcstatus'];
	$moist=$row_tbl_sub['arrpacks_moist'];
	$germ=$row_tbl_sub['arrpacks_germ'];
	$got=$row_tbl_sub['arrpacks_gotstatus'];
	
	$dnop=$row_tbl_sub['arrpacks_eloosenop'];
	$dnomp=$row_tbl_sub['arrpacks_enomp'];
	$dqty=$row_tbl_sub['arrpacks_eqty'];
	
	$arrnop=$row_tbl_sub['arrpacks_loosenop'];
	$arrnomp=$row_tbl_sub['arrpacks_nomp'];
	$arrqty=$row_tbl_sub['arrpacks_qty'];
	
	$balnop=$row_tbl_sub['arrpacks_balloosenop'];
	$balnomp=$row_tbl_sub['arrpacks_balnomp'];
	$balqty=$row_tbl_sub['arrpacks_balqty'];
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['lotvariety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
		
	$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act=""; $nomp="";
//echo "select * from tbl_arrpack_subsub where arrpack_id='".$arrival_id."' and arrpacks_id='".$row_tbl_sub['arrpacks_id']."'";
$sql_sloc=mysqli_query($link,"select * from tbl_arrpack_subsub where arrpack_id='".$arrival_id."' and arrpacks_id='".$row_tbl_sub['arrpacks_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
	$slups=0; $slqty=0;
	$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['arrpackss_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars']."/";
	
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['arrpackss_binid']."' and whid='".$row_sloc['arrpackss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname']."/";
	
	$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['arrpackss_subbinid']."' and binid='".$row_sloc['arrpackss_binid']."' and whid='".$row_sloc['arrpackss_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];
	
	if($slocs!="")
	$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
	else
	$slocs=$wareh.$binn.$subbinn."<br/>";
	if($act1!="")
	$act1=$act1.$row_sloc['arrpackss_nop']."<br/>";
	else
	$act1=$row_sloc['arrpackss_nop']."<br/>";
	if($nomp!="")
	$nomp=$nomp.$row_sloc['arrpackss_nomp']."<br/>";
	else
	$nomp=$row_sloc['arrpackss_nomp']."<br/>";
	if($act!="")
	$act=$act.$row_sloc['arrpackss_qty']."<br/>";
	else
	$act=$row_sloc['arrpackss_qty']."<br/>";
}
	
	
	if($row_tbl_sub['arrpacks_pp']=="Acceptable")
	{
	$cc="ACC";
	}
	else if($row_tbl_sub['arrpacks_pp']=="Not-Acceptable")
	{
	$cc="NAC";
	}
	if($srno%2!=0)
	{

?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tbltext"><?php echo $crop?></td>
    <td width="58" align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
    <td width="75" align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
    <td width="35" align="center" valign="middle" class="tbltext"><?php echo $dnop;?></td>
	 <td width="35" align="center" valign="middle" class="tbltext"><?php echo $dnomp;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $dqty;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $arrnop;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $arrnomp;?></td>
    <td width="41" align="center" valign="middle" class="tbltext"><?php echo $arrqty;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $balnop;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $balnomp;?></td>	
    <td width="52" align="center" valign="middle" class="tbltext"><?php echo $balqty;?></td>
    <td width="48" align="center" valign="middle" class="tbltext"><?php echo $qc;?></td>
    <td width="43" align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td width="44" align="center" valign="middle" class="tbltext"><?php echo $moist;?></td>
    <td width="50" align="center" valign="middle" class="tbltext"><?php echo $germ;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $act1;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $nomp;?></td>
	<td width="51" align="center" valign="middle" class="tbltext"><?php echo $act;?></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
	<td width="31" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tbltext"><?php echo $crop?></td>
	<td width="58" align="center" valign="middle" class="tbltext"><?php echo $variety;?></td>
	<td width="75" align="center" valign="middle" class="tbltext"><?php echo $lotno;?></td>
	<td width="35" align="center" valign="middle" class="tbltext"><?php echo $dnop;?></td>
	 <td width="35" align="center" valign="middle" class="tbltext"><?php echo $dnomp;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $dqty;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $arrnop;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $arrnomp;?></td>
    <td width="41" align="center" valign="middle" class="tbltext"><?php echo $arrqty;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $balnop;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $balnomp;?></td>	
    <td width="52" align="center" valign="middle" class="tbltext"><?php echo $balqty;?></td>
	<td width="48" align="center" valign="middle" class="tbltext"><?php echo $qc;?></td>
	<td width="43" align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
	<td width="44" align="center" valign="middle" class="tbltext"><?php echo $moist;?></td>
	<td width="50" align="center" valign="middle" class="tbltext"><?php echo $germ;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $got;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $act1;?></td>
	<td width="33" align="center" valign="middle" class="tbltext"><?php echo $nomp;?></td>
	<td width="51" align="center" valign="middle" class="tbltext"><?php echo $act;?></td>
</tr>
  <?php
}
$srno++;
}
}

?>
</table><br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
<tr class="Dark" height="30">
<td width="58" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="20">&nbsp;<?php echo $row_tbl['arrpack_remarks'];?></td>
</tr>
</table> 
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_arrival_packstocktransfer.php?cropid=<?php echo $pid;?>&ep_id=<?php echo $epid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  