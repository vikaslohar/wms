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
	
	$sql_arr=mysqli_query($link,"select * from tbl_pswrem where plantcode='".$plantcode."' and pswrem_id='".$pid."'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	
	$trdate=$row_arr['pswrem_date'];
	$arrival_id=$row_arr['pswrem_id'];
	$txtpsrn=$row_arr['pswrem_dcno'];
	if($trdate=='0000-00-00' || $trdate=='--' || $trdate=='')
	{
		$trdate=date('Y-m-d');
		$sqd="update tbl_pswrem set pswrem_date='$trdate' where pswrem_id='".$pid."' ";
		$xsdf=mysqli_query($link,$sqd) or die(mysqli_error($link));
	}
	$sql_arrsub=mysqli_query($link,"select * from tbl_pswrem_sub where plantcode='".$plantcode."' and pswrem_id='".$arrival_id."'") or die(mysqli_error($link));
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		$crop=$row_arrsub['crop'];
		$variety=$row_arrsub['variety'];
		$lot=$row_arrsub['lotnumber'];
		$upss=$row_arrsub['upssize'];
		
		$bcflg=1;
		$a="";
		$sql_arrsub_sub=mysqli_query($link,"select * from tbl_pswremsub_sub where plantcode='".$plantcode."' and pswremsub_id='".$row_arrsub['pswremsub_id']."' and pswrem_id='".$row_arrsub['pswrem_id']."'") or die(mysqli_error($link));
		while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
		{
			$whid=$row_arrsub_sub['whid'];
			$binid=$row_arrsub_sub['binid'];
			$subbinid=$row_arrsub_sub['subbinid'];
			$ups=$row_arrsub_sub['remnop'];
			$nomp=$row_arrsub_sub['remnomp'];
			$qty=$row_arrsub_sub['remqty'];
			$obalnmp=$row_arrsub_sub['balnomp'];
			$abrc='';
			if($obalnmp>0)
			{
				$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_pswrem_bartemp where plantcode='".$plantcode."' and bar_lotno='".$lot."' and bar_tid='".$arrival_id."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'") or die(mysqli_error($link));
				$tot_barcode2=mysqli_num_rows($sql_barcode2);
				if($tot_barcode2 > 0)
				{
					while($row_barcode2=mysqli_fetch_array($sql_barcode2))
					{
						if($a!="")
						$a=$a.",".$row_barcode2['bar_barcodes'];
						else
						$a=$row_barcode2['bar_barcodes'];
						$bcd=$row_barcode24['bar_barcodes'];
						if($abrc!="")
						$abrc=$abrc.","."'$bcd'";
						else
						$abrc="'$bcd'";
					}
				}
			}
			
			$abarc=""; $cnto=0;
			if($a!='')
			{
				$abr=explode(",",$a);
				$abarc2=array_unique($abr);
				$cnto=count($abarc2);
				$abarc=implode(",",$abarc2);
			}
			
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and subbinid='".$subbinid."' and binid='".$binid."' and whid='".$whid."' and lotno='".$lot."' and packtype='".$upss."'") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
					
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
			$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
				
				
			$opups=$row_issuetbl['balnop'];
			$opnomp=$row_issuetbl['balnomp'];
			$opqty=$row_issuetbl['balqty'];
			$olot=$row_issuetbl['orlot'];
			
			$stage=$row_issuetbl['lotldg_sstage'];
			$status=$row_issuetbl['lotldg_sstatus'];
			$moist=$row_issuetbl['lotldg_moisture'];
			$gemp=$row_issuetbl['lotldg_gemp'];
			$vchk=$row_issuetbl['lotldg_vchk'];
			$got1=$row_issuetbl['lotldg_got1'];
			$qc=$row_issuetbl['lotldg_qc'];
			
			$lotno=$row_issuetbl['lotno'];
			$gotstatus=$row_issuetbl['lotldg_got'];
			$qctestdate=$row_issuetbl['lotldg_qctestdate'];
			$gottestdate=$row_issuetbl['lotldg_gottestdate'];
			$orlot=$row_issuetbl['orlot'];
			$resverstatus=$row_issuetbl['lotldg_resverstatus'];
			$revcomment=$row_issuetbl['lotldg_revcomment'];
			$geneticpurity=$row_issuetbl['lotldg_genpurity'];
			$ycode=$row_issuetbl['yearcode'];
			$pcktyp=$row_issuetbl['packtype'];
				
			$packlabels=$row_issuetbl['packlabels'];
			$barcodes=$row_issuetbl['barcodes'];
			$wtinmp=$row_issuetbl['wtinmp'];
			$lotldg_dop=$row_issuetbl['lotldg_dop'];
			$lotldg_valperiod=$row_issuetbl['lotldg_valperiod'];
			$lotldg_valupto=$row_issuetbl['lotldg_valupto'];
			$lotldg_srtyp=$row_issuetbl['lotldg_srtyp'];
			$lotldg_srflg=$row_issuetbl['lotldg_srflg'];
				
			$balups=$opups-$ups;
			$balnomp=$opnomp-$nomp;
			$balqty=$opqty-$qty;
			if($balqty<0){$balqty=0;$balups=0;$balnomp=0;}
				
			$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_spremflg,plantcode) values('$ycode','Qty-Rem', '$stage', '$pid', '$trdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$ups', '$nomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '1','$plantcode')";
			$xwdaz=mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			$nid=mysqli_insert_id($link);
			
			
			if($abarc!="") 
			{
				if($cnto>1)
					$sqlsubchk="update tbl_mpmain set mpmain_dflg='1' where mpmain_crop='".$crop."' and mpmain_variety='".$variety."' and mpmain_upssize='".$upss."' and mpmain_lotno='$lotno' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0 and (mpmain_trtype='PACKSMC' or mpmain_trtype='PACKNMC') and mpmain_barcode NOT IN ($abrc)";
				else
					$sqlsubchk="update tbl_mpmain set mpmain_dflg='1' where mpmain_crop='".$crop."' and mpmain_variety='".$variety."' and mpmain_upssize='".$upss."' and mpmain_lotno='$lotno' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0 and (mpmain_trtype='PACKSMC' or mpmain_trtype='PACKNMC') and mpmain_barcode!=$abrc";
			}
			else
			{
				$sqlsubchk="update tbl_mpmain set mpmain_dflg='1' where mpmain_crop='".$crop."' and mpmain_variety='".$variety."' and mpmain_upssize='".$upss."' and mpmain_lotno='$lotno' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0 and (mpmain_trtype='PACKSMC' or mpmain_trtype='PACKNMC')";
			}
			mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
			
			$sqlsubchk="update tbl_mpmain set mpmain_spremflg='1' where mpmain_lotno ='".$lotno."'";
			mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
				
				
			/*$sqlarrsubsub=mysqli_query($link,"select mpmain_barcode,mpmain_id from tbl_mpmain where mpmain_crop='".$crop."' and mpmain_variety='".$variety."' and mpmain_upssize='".$upss."' and mpmain_lotno='$lotno' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0 and (mpmain_trtype='PACKSMC' or mpmain_trtype='PACKNMC')") or die(mysqli_error($link));
			while($rowarrsubsub=mysqli_fetch_array($sqlarrsubsub))
			{
				if($abarc!="") 
				{
					if(!in_array($rowarrsubsub['mpmain_barcode'],$abarc))
					{
						if($bcflg<=$nomp)
						{
							$sqlsubchk="update tbl_mpmain set mpmain_dflg='1' where mpmain_id ='".$rowarrsubsub['mpmain_id']."' and mpmain_dflg=0";
							mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
						}
						$bcflg++;
					}
				}
				else
				{
					if($bcflg<=$nomp)
					{
						$sqlsubchk="update tbl_mpmain set mpmain_dflg='1' where mpmain_id ='".$rowarrsubsub['mpmain_id']."' and mpmain_dflg=0";
						mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
					}
					$bcflg++;
				}
							
				$sqlsubchk="update tbl_mpmain set mpmain_spremflg='1' where mpmain_lotno ='".$lotno."'";
				mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
			}
			*/
			
			/*$sqlarrsubsub=mysqli_query($link,"select * from tbl_mpmain where mpmain_crop='".$crop."' and mpmain_variety='".$variety."' and mpmain_upssize='".$upss."' and mpmain_dflg=0 and mpmain_upflg=0 and mpmain_rvflg=0 and (mpmain_trtype='PACKLMC' or mpmain_trtype='PACKNLC')") or die(mysqli_error($link));
			while($rowarrsubsub=mysqli_fetch_array($sqlarrsubsub))
			{
				$pty=$rowarrsubsub['mpmain_trtype'];
				if($rowarrsubsub['mpmain_dflg']!=1)
				{	
					$mpups=$rowarrsubsub['mpmain_upssize'];
					$lotn=explode(",",$rowarrsubsub['mpmain_lotno']);
					foreach($lotn as $mplotno)
					{
						if($mplotno<>"")
						{
							if($lotno==$mplotno)
							{
								if($abarc!="") 
								{
									if(!in_array($rowarrsubsub['mpmain_barcode'],$abarc))
									{
										if($bcflg<=$nomp)
										{
											$sqlsubchk="update tbl_mpmain set mpmain_dflg='1' where mpmain_id ='".$rowarrsubsub['mpmain_id']."' and mpmain_dflg=0";
											mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
										}
										$bcflg++;
									}
								}
								else
								{
									if($bcflg<=$nomp)
									{
										$sqlsubchk="update tbl_mpmain set mpmain_dflg='1' where mpmain_id ='".$rowarrsubsub['mpmain_id']."' and mpmain_dflg=0";
										mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
									}
									$bcflg++;
								}
								$sqlsubchk="update tbl_mpmain set mpmain_spremflg='1' where mpmain_lotno ='".$lotno."'";
								mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
							}
						}
					}
				}
			}	*/
		
			
			
			
			
				
			if($balqty == 0)
			{
				$sqlsubchk="update tbl_lot_ldg_pack set lotldg_dispflg='1' where orlot ='".$orlot."'";
				mysqli_query($link,$sqlsubchk) or die(mysqli_error($link));
					
				$x="";
				$sql_mainchk="update tbl_lot_ldg_pack set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$olot'";
				mysqli_query($link,$sql_mainchk) or die(mysqli_error($link));
				$sql_subchk="update tbl_softr_sub set softrsub_srflg='2' where softrsub_lotno ='$olot'";
				mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
									
				$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  subbinid='".$subbinid."'") or die(mysqli_error($link));
				$cntg=0;
				while($row_issueg=mysqli_fetch_array($sql_issueg))
				{ 
					$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."'") or die(mysqli_error($link));
					$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
					$sql_issuetblg=mysqli_query($link,"select lotdgp_id from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
					$totnog=mysqli_num_rows($sql_issuetblg);
					if($totnog == 0)
					{
						$cntg++;
					} 
				}
					  
					  
				$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
				//$cntg=0;
				while($row_issueg=mysqli_fetch_array($sql_issueg))
				{ 
					$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
					$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
					$sql_issuetblg=mysqli_query($link,"select lotldg_id from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
					$totnog=mysqli_num_rows($sql_issuetblg);
					if($totnog == 0)
					{
						$cntg++;
					} 
				}				
				if($cntg == 0)
				{
					$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
					mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
				}
				
			}
		}
	}
}	
	
	$sql_code1="SELECT MAX(pswrem_code) FROM tbl_pswrem where plantcode='".$plantcode."'  ORDER BY pswrem_code DESC";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
	if(mysqli_num_rows($res_code1) > 0)
	{
		$row_code1=mysqli_fetch_row($res_code1);
		$t_code1=$row_code1['0'];
		$ncode1=$t_code1+1;
		//$ncode=sprintf("%004d",$ncode);
	}
	else
	{ 
		$ncode1=1;
	}
  	$sql_main="update tbl_pswrem set pswrem_tflg=1, pswrem_code='$ncode1'  where pswrem_id ='$pid'";
	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	
	echo "<script>window.location='select_remspld_op.php?p_id=$pid'</script>";	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch -Transaction - Pack Seed SP Release - Preview</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
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

function openslocpopprint()
{
//alert(txtcrop);
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('qtyremspld_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Crop first.");
document.frmaddDepartment.txtcrop.focus();
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Pack Seed SP Release-RO- Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
 	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<?php  

 $tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_pswrem where plantcode='".$plantcode."' and  pswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pswrem_id'];

	$tdate=$row_tbl['pswrem_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;

$tdate=$row_tbl['pswrem_dcdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate2=$tday."-".$tmonth."-".$tyear;	
/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);*/
$subtid=0;
?>	

<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed SP Release-RO</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "TCR".$row_tbl['pswrem_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $tdate1;?>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $tdate2;?></td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $row_tbl['pswrem_dcno'];?></td>
</tr>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;VNR Seeds Private Limited-Raipur Depot</td>

</tr>
</table><br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#378b8b" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pswrem_sub where plantcode='".$plantcode."' and  pswrem_id='".$arrival_id."'") or die(mysqli_error($link));
 $subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
	<td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No.</td>
	<td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >UPS</td>
	<td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Crop</td>
	<td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Variety</td>
	<td width="91" align="center" valign="middle" class="tblheading"rowspan="2" >SLOC</td>
	<td align="center" valign="middle" class="tblheading"  colspan="3">Actual Quantity</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Quantity Released</td>
	<td align="center" valign="middle" class="tblheading" colspan="3">Balance Quantity</td>
</tr>
<tr class="tblsubtitle">
	<td width="50" align="center" valign="middle" class="tblheading" >NoP</td>
	<td width="50" align="center" valign="middle" class="tblheading" >NoMP</td>
	<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="49" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="49" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="53" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="48" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="48" align="center" valign="middle" class="tblheading">NoMP</td>
	<td width="52" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $difq="";  $rtotalnop=0; $rtotalups=0; $rtotalqty=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['pswrem_id'];

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_pswremsub_sub where plantcode='".$plantcode."' and  pswremsub_id='".$row_tbl_sub['pswremsub_id']."' and pswrem_id='".$row_tbl_sub['pswrem_id']."'") or die(mysqli_error($link));
while($row_subsub=mysqli_fetch_array($sql_tbl_subsub))
{

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=""; $slocs=""; $gd=""; $slups=0; $slqty=0; $onob=0; $onomp=0; $oqty=0; $nob=0; $nomp=0; $qty=0; $baln=0; $balmp=0; $balq=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_subsub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_subsub['subbinid']."' and binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$onob=$onob+$row_subsub['opnop'];
$onomp=$onomp+$row_subsub['opnomp'];
$oqty=$oqty+$row_subsub['opqty'];
$nob=$nob+$row_subsub['remnop'];
$nomp=$nomp+$row_subsub['remnomp'];
$qty=$qty+$row_subsub['remqty'];
$baln=$baln+$row_subsub['balnop'];
$balmp=$balmp+$row_subsub['balnomp'];
$balq=$balq+$row_subsub['balqty'];

}
$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['crop']."' order by cropname Asc"); 
$row_crp = mysqli_fetch_array($sql_crp);

$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl_sub['variety']."' and actstatus='Active' order by popularname Asc"); 
$row_var = mysqli_fetch_array($sql_var);

$rtotalnop=$rtotalnop+$onob;
$rtotalups=$rtotalups+$onomp;
$rtotalqty=$rtotalqty+$oqty;

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['upssize'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_crp['cropname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_var['popularname'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $slocs;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $onob;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $onomp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $baln;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balmp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balq;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['upssize'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_crp['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_var['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $onob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $onomp;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $nob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nomp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $baln;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balmp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $balq;?></td>
  </tr>
<?php
}
$srno++;
}
}
?>
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edittrn_qty_removalspl.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  