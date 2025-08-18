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
	
	$sql_arr=mysqli_query($link,"select * from tbl_pswrem where plantcode='$plantcode' and pswrem_id='".$pid."'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	$trdate=$row_arr['pswrem_date'];
	$dcdate=$row_arr['pswrem_dcdate'];
	$dcno=$row_arr['pswrem_dcno'];
	$dcptype=$row_arr['pswrem_ptype'];
	$dcstate=$row_arr['pswrem_state'];
	$dcloc=$row_arr['pswrem_location'];
	$dccountry=$row_arr['pswrem_country'];
	$dcparty=$row_arr['pswrem_party'];
	
	if($trdate=='0000-00-00' || $trdate=='--' || $trdate=='')
	{
		$trdate=date('Y-m-d');
		$sqd="update tbl_pswrem set pswrem_date='$trdate' where pswrem_id='".$pid."' ";
		$xsdf=mysqli_query($link,$sqd) or die(mysqli_error($link));
	}
	$arrival_id=$row_arr['pswrem_id'];
	
	$sql_arrsub=mysqli_query($link,"select * from tbl_pswrem_bar where plantcode='$plantcode' and pswrem_id='".$arrival_id."'") or die(mysqli_error($link));
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		//$pty=$row_arrsub['mptype'];
		
		$sql_arrsub_sub=mysqli_query($link,"select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='".$row_arrsub['barcodes']."'") or die(mysqli_error($link));
		while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
		{
			
			/*$whid=$row_arrsub_sub['mpmain_wh'];
			$binid=$row_arrsub_sub['mpmain_bin'];
			$subbinid=$row_arrsub_sub['mpmain_subbin'];*/
			$upss=$row_arrsub_sub['mpmain_upssize'];
			$pty=$row_arrsub_sub['mpmain_trtype'];
			
			if($pty=="PACKSMC" || $pty=="PACKNMC")
			{
				//$crop=$row_arrsub_sub['mpmain_crop'];
				//$variety=$row_arrsub_sub['mpmain_variety'];
				$lot=$row_arrsub['mplotno'];
				$qty=$row_arrsub['mpwtmp'];
				$ups=$row_arrsub['mplotnop'];
				$nomp=1;
				
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lot."' and packtype='".$upss."'") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
				$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
				
				$crop=$row_issuetbl['lotldg_crop'];
				$variety=$row_issuetbl['lotldg_variety'];
				$opups=$row_issuetbl['balnop'];
				$opnomp=$row_issuetbl['balnomp'];
				$opqty=$row_issuetbl['balqty'];
				$olot=$row_issuetbl['orlot'];
				
				$whid=$row_issuetbl['whid'];
				$binid=$row_issuetbl['binid'];
				$subbinid=$row_issuetbl['subbinid'];
				
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
				
				$rvflg=$row_issuetbl['lotldg_rvflg'];
				$alflg=$row_issuetbl['lotldg_alflg'];
				$dispflg=$row_issuetbl['lotldg_dispflg'];
				$altrids=$row_issuetbl['lotldg_altrids'];
				$alqtys=$row_issuetbl['lotldg_alqtys'];
				$alnomps=$row_issuetbl['lotldg_alnomps'];
				$spremflg=$row_issuetbl['lotldg_spremflg'];
						
				$balups=$opups-$ups;
				$balnomp=$opnomp-$nomp;
				$balqty=$opqty-$qty;
				
				if($balnomp<0)$balnomp=0;
				if($balqty<0)$balqty=0;
				
				$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, plantcode) values('$ycode','Qty-Rem', '$stage', '$pid', '$trdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$ups', '$nomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$rvflg', '$alflg', '$dispflg', '$altrids', '$alqtys', '$alnomps', '$spremflg', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				if($balqty == 0)
				{
				
					$x="";
					$sql_mainchk="update tbl_lot_ldg_pack set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$olot'";
					mysqli_query($link,$sql_mainchk) or die(mysqli_error($link));
					$sql_subchk="update tbl_softr_sub set softrsub_srflg='2' where softrsub_lotno ='$olot'";
					mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
									
					$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
					$cntg=0;
					while($row_issueg=mysqli_fetch_array($sql_issueg))
					{
						$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."'") or die(mysqli_error($link));
						$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
						$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
						$totnog=mysqli_num_rows($sql_issuetblg);
						if($totnog == 0)
						{
						  $cntg++;
						} 
					}
					  
					  
					 $sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
					//$cntg=0;
					while($row_issueg=mysqli_fetch_array($sql_issueg))
					{ 
						$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
						$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
						$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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
			else
			{
				
				$ltnp=explode(",",$row_arrsub_sub['mpmain_lotnop']);
				$lotn=explode(",",$row_arrsub_sub['mpmain_lotno']);
				for($i=0; $i<count($lotn); $i++)
				{
					$lot=$lotn[$i];
					$ups=$ltnp[$i];
					if($lot<>"")
					{
						//$ups=$row_arrsub_sub['mpmain_lotnop'];
						$xc=explode(" ",$row_arrsub_sub['mpmain_upssize']);
						if($xc[1]=="Gms")
						{
							$ptp=$xc[0]/1000;
						}
						else
						{
							$ptp=$xc[0];
						}
						$qt=$ptp*$ups;
						
						
						$nomp=1;
						$qty=$qt;
					
						$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lot."' and packtype='".$upss."'") or die(mysqli_error($link));
						$row_issue1=mysqli_fetch_array($sql_issue1); 
							
						$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
						$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
						
						$crop=$row_issuetbl['lotldg_crop'];
						$variety=$row_issuetbl['lotldg_variety'];
						$opups=$row_issuetbl['balnop'];
						$opnomp=$row_issuetbl['balnomp'];
						$opqty=$row_issuetbl['balqty'];
						$olot=$row_issuetbl['orlot'];
						
						$whid=$row_issuetbl['whid'];
						$binid=$row_issuetbl['binid'];
						$subbinid=$row_issuetbl['subbinid'];
						
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
						
						$rvflg=$row_issuetbl['lotldg_rvflg'];
						$alflg=$row_issuetbl['lotldg_alflg'];
						$dispflg=$row_issuetbl['lotldg_dispflg'];
						$altrids=$row_issuetbl['lotldg_altrids'];
						$alqtys=$row_issuetbl['lotldg_alqtys'];
						$alnomps=$row_issuetbl['lotldg_alnomps'];
						$spremflg=$row_issuetbl['lotldg_spremflg'];
							
						$balups=$opups-$ups;
						$balnomp=$opnomp-$nomp;
						$balqty=$opqty-$qty;
						if($balnomp<0)$balnomp=0;
						if($balqty<0)$balqty=0;
						$sql_sub_sub="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, plantcode) values('$ycode','Qty-Rem', '$stage', '$pid', '$trdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opnomp', '$opqty', '$ups', '$nomp', '$qty', '$balups', '$balnomp', '$balqty', '$stage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$rvflg', '$alflg', '$dispflg', '$altrids', '$alqtys', '$alnomps', '$spremflg', '$plantcode')";
						mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						if($balqty == 0)
						{
						
							$x="";
							$sql_mainchk="update tbl_lot_ldg_pack set lotldg_srtyp='$x', lotldg_srflg='0' where orlot ='$olot'";
							mysqli_query($link,$sql_mainchk) or die(mysqli_error($link));
							$sql_subchk="update tbl_softr_sub set softrsub_srflg='2' where softrsub_lotno ='$olot'";
							mysqli_query($link,$sql_subchk) or die(mysqli_error($link));
											
							$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
							$cntg=0;
							while($row_issueg=mysqli_fetch_array($sql_issueg))
							{
								$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."'") or die(mysqli_error($link));
								$row_issueg1=mysqli_fetch_array($sql_issueg1); 
								
								$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
								$totnog=mysqli_num_rows($sql_issuetblg);
								if($totnog == 0)
								{
								  $cntg++;
								} 
							}
							  
							  
							 $sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
							//$cntg=0;
							while($row_issueg=mysqli_fetch_array($sql_issueg))
							{ 
								$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."'") or die(mysqli_error($link));
								$row_issueg1=mysqli_fetch_array($sql_issueg1); 
								
								$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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
				//
				}	
			}
		}
	
		$sql_main2="update tbl_mpmain set mpmain_dflg=1 where mpmain_barcode='".$row_arrsub['barcodes']."'";
		$a123=mysqli_query($link,$sql_main2) or die(mysqli_error($link));
		
		$sql_main23="update tbl_barcodes set bar_dispflg=1 where bar_barcode='".$row_arrsub['barcodes']."'";
		$a1234=mysqli_query($link,$sql_main23) or die(mysqli_error($link));
	}
}	
	
	$sql_code1="SELECT MAX(pswrem_code) FROM tbl_pswrem where plantcode='$plantcode'  ORDER BY pswrem_code DESC";
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
	//exit;
	echo "<script>window.location='home_rembarqty.php'</script>";	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw -Transaction - Packaged Seed Release - Preview</title>
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

function openslocpopprint()
{
//alert(txtcrop);
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('qtyrembar_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Packaged Seed Release - Preview </td>
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
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<?php  

 $tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_pswrem where plantcode='$plantcode' and pswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['pswrem_id'];

	$tdate=$row_tbl['pswrem_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['pswrem_dcdate'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate2=$tday1."-".$tmonth1."-".$tyear1;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);*/
$subtid=0;
?>	

<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Packaged Seed Release</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TCR".$row_tbl['pswrem_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate2;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pswrem_dcno'];?>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['pswrem_ptype'];?></td>
</tr>
<?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$row_tbl['pswrem_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
if($row_tbl['pswrem_ptype']!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td align="right" width="205" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" width="234" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pswrem_state'];?></td>
<td align="right" width="172" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" width="229" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['pswrem_country'];?></td>
</tr>
<?php
}
?>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['pswrem_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row3['business_name'];?></td>
</tr>

<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3"><div style="padding-bottom:0px; padding-left:5px; padding-right:5px; padding-top:0px;"><?php echo $row3['address'];?><?php if($row3['city']!=""){ echo ", ".$row3['city'];}?> - <?php echo $row3['state'];?><?php if($row_tbl['pswrem_country']!=""){ echo ", ".$row_tbl['pswrem_country'];}?></div></td>
</tr>
</table>
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="970" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="" height="20">
  <td colspan="4" align="center" class="tblheading"><font color="#FF0000">Barcode data provided in excel sheet can only be viewed but cannot be edited <br />
If there are any changes required than you may have to CANCEL transaction, make changes in excel and re-upload it through new transaction</font></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td align="center" valign="middle" class="tblheading" colspan="12">Barcode Details</td>
</tr>	
<tr class="light" height="20">
	<td align="center" valign="middle" class="tblheading" width="120">BC as per Excel</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_totrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC avbl for release</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_remrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC already released</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_relrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC not is system</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_nosrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC Invalid</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_invrec'];?></td>
	<td align="center" valign="middle" class="tblheading" width="120">BC duplicate</td>
	<td align="center" valign="middle" class="tblheading" width="40"><?php echo $row_tbl['pswrem_duprec'];?></td>
</tr>
</table>
<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#0BC5F4" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_pswrem_bar where plantcode='$plantcode' and pswrem_id='".$arrival_id."' order by barcodes") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="92" align="center" valign="middle" class="tblheading">Barcode</td>
	<td width="92" align="center" valign="middle" class="tblheading">Pack Type</td>
	<td width="123" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="123" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="91" align="center" valign="middle" class="tblheading">UPS</td>
	<td align="center" valign="middle" class="tblheading">Lot No.</td>
	<td align="center" valign="middle" class="tblheading">Lot Qty</td>
	<td align="center" valign="middle" class="tblheading">Qty Removed</td>
</tr>
<?php
$srno=1;
if($subtbltot > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	$lotno=""; $qty=""; $totqty=0; $crop=""; $variety=""; $lotno=""; $ups=""; $packtyp="";
	  
	$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='".$row_tbl_sub['barcodes']."'") or die(mysqli_error($link));
	$tot_barcode1=mysqli_num_rows($sql_barcode1);
	$row_barcode1=mysqli_fetch_array($sql_barcode1);
	
	$pty=$row_tbl_sub['mptype'];
	if($pty=="PACKSMC")
	$packtyp="SMC";
	if($pty=="PACKLMC")
	$packtyp="LMC";
	if($pty=="PACKMMC")
	$packtyp="MMC";
		
	if($pty=="PACKSMC")
	{
		
		$lotno=$row_tbl_sub['mplotno'];
		$qty=$row_tbl_sub['mpwtmp'];
		$totqty=$row_tbl_sub['mpwtmp'];
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
	}
	else
	{
	
		$lotn=explode(",",$row_barcode1['mpmain_lotno']);
		foreach($lotn as $ltn)
		{
			if($ltn<>"")
			{
				if($lotno!="")
					$lotno=$lotno."<br/>".$ltn;
				else
					$lotno=$ltn;
			}
		}
		$ltnp=explode(",",$row_barcode1['mpmain_lotnop']);
		foreach($ltnp as $ltnop)
		{
			if($ltnop<>"")
			{
				$xc=explode(" ",$row_barcode1['mpmain_upssize']);
				if($xc[1]=="Gms")
				{
					$ptp=$xc[0]/1000;
				}
				else
				{
					$ptp=$xc[0];
				}
				$qt=$ptp*$ltnop;
				
				if($qty!="")
					$qty=$qty."<br/>".$qt;
				else
					$qty=$qt;
			}
		}
		$totqty=$row_tbl_sub['mpwtmp'];
		$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_barcode1['mpmain_crop']."' order by cropname Asc"); 
		$row_crp = mysqli_fetch_array($sql_crp);
		$crop=$row_crp['cropname'];
		
		$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_barcode1['mpmain_variety']."' and actstatus='Active' order by popularname Asc"); 
		$row_var = mysqli_fetch_array($sql_var);
		$variety=$row_var['popularname'];
	
	}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['barcodes'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $packtyp;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $variety;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['mpups'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $qty;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $totqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['barcodes'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $packtyp;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $crop;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $variety;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $row_tbl_sub['mpups'];?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $lotno;?></td>
	<td align="center"  valign="middle" class="tbltext" ><?php echo $qty;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $totqty;?></td>
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
<td valign="top" align="right"><a href="home_rembarqty.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onClick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  