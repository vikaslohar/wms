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
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
	    $foccode=trim($_POST['foccode']);
		$barstype=trim($_POST['barstype']);
		$unpkgtyp=trim($_POST['unpkgtyp']);
		$zx=explode(",",$foccode);
		$bval="";
		$arrival_date=date("Y-m-d");
		$cnt=0;
		
		foreach($zx as $fval)
		{
			if($fval<>"")
			{
				if($bval!="")
				$bval=$bval.",".$fval;
				else
				$bval=$fval;
				
				$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_barcode='$fval'") or die(mysqli_error($link));
				$tot_mps=mysqli_num_rows($sql_mps);
				if($tot_mps > 0)
				{
					while($row_mps=mysqli_fetch_array($sql_mps))
					{
						$mptype=$row_mps['mpmain_trtype'];
						if($mptype!="PACKSMC" && $mptype!="PACKNMC")
						{
							$crparr=explode(",", $row_mps['mpmain_crop']);
							$verarr=explode(",", $row_mps['mpmain_variety']);
							$lotarr=explode(",", $row_mps['mpmain_lotno']);
							$upsarr=explode(",", $row_mps['mpmain_upssize']);
							$noparr=explode(",", $row_mps['mpmain_lotnop']);
							$subbinarr=$row_mps['mpmain_subbin'];
							
							
							$sql_unpkgmain="Insert into tbl_unpkg (unpkg_date, unpkg_barcode, unpkg_yearcode, unpkg_logid, plantcode) values('$arrival_date','$fval','$yearid_id', '$logid', '$plantcode')";
							if(mysqli_query($link,$sql_unpkgmain) or die(mysqli_error($link)))
							{
								$mainid=mysqli_insert_id($link);
							}
								
							for ($i=0; $i<count($lotarr); $i++)
							{
								$nops=$noparr[$i];
								$packnop=$nops;
								$packnomp=1;
								$lotno=$lotarr[$i];
								if($mptype!="PACKLMC" && $mptype!="PACKNLC" && $mptype!="PACKMMC")
								{
									$crop=$crparr[$i];
									$variety=$verarr[$i];
									$packtype=$upsarr[$i];
									$up=explode(" ", $upsarr[$i]);
								}
								else
								{
									$crop=$crparr[0];
									$variety=$verarr[0];
									$packtype=$upsarr[0];
									$up=explode(" ", $upsarr[0]);
								}
								
								$qtys=0;
								if($up[1]=="Gms")
								{
									$ptp=$up[0]/1000;
								}
								else
								{
									$ptp=$up[0];
								}
								$qtys=$ptp*$nops; 
								
								$sql_unpkgsub="Insert into tbl_unpkgsub (unpkg_id, unpkgsub_crop, unpkgsub_variety, unpkgsub_lotno, unpkgsub_mptype, unpkgsub_ups, unpkgsub_nop, unpkgsub_qty, plantcode) values('$mainid','$crop','$variety', '$lotno', '$mptype', '".$upsarr[$i]."', '$nops', '$qtys', '$plantcode')";
								if(mysqli_query($link,$sql_unpkgsub) or die(mysqli_error($link)))
								{
									$subid=mysqli_insert_id($link);
								}
								
								$lotqry=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."'") or die(mysqli_error($link));
								$tot_row=mysqli_num_rows($lotqry);
							
								if($tot_row > 0)
								{
									while($row_issue=mysqli_fetch_array($lotqry))
									{ 
										$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."' and subbinid='".$row_issue['subbinid']."' ") or die(mysqli_error($link));
										$row_issue1=mysqli_fetch_array($sql_issue1); 
										
										$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0 and balnomp > 0") or die(mysqli_error($link)); 
										
										while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
										{
											$whid=$row_issuetbl['whid'];
											$binid=$row_issuetbl['binid'];
											$subbinid=$row_issuetbl['subbinid'];
											$packlabels=$row_issuetbl['packlabels'];
											$barcodes=$row_issuetbl['barcodes'];
											$wtinmp=$row_issuetbl['wtinmp'];
											$opnop=$row_issuetbl['balnop'];
											$opnomp=$row_issuetbl['balnomp'];
											$optqty=$row_issuetbl['balqty'];
											$pcktyp=$row_issuetbl['packtype'];
												
											$pckt=explode(" ",$pcktyp);
											$ptp=0; $nopinmp=0;
											if($pckt[1]=="Gms")
											{
												$ptp=(($pckt[0]*$zxcv)/1000);
												$nnoopp=$pckt[0];
												$nopinmp=$wtinmp*(1000/$nnoopp);
											}
											else
											{
												$ptp=($pckt[0]*$zxcv);
												$nnoopp=$pckt[0]*1000;
												$nopinmp=$wtinmp*(1000/$pckt[1]);
											}
												//echo $nopinmp;
											$balnop=$packnop+$opnop;
											$balnomp=$opnomp-$packnomp;
											$balqty=$optqty;
											if($balnop<0)$balnop=0;
											if($balnomp<0)$balnomp=0;
											if($balqty<0)$balqty=0.000;
												
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
											$srtyp=$row_issuetbl['lotldg_srtyp'];
											$srflg=$row_issuetbl['lotldg_srflg'];
											$resverstatus=$row_issuetbl['lotldg_resverstatus'];
											$revcomment=$row_issuetbl['lotldg_revcomment'];
											$geneticpurity=$row_issuetbl['lotldg_genpurity'];
											$yearcode=$row_issuetbl['yearcode'];
											$dop1=$row_issuetbl['lotldg_dop'];
											$valperiod=$row_issuetbl['lotldg_valperiod'];
											$valupto=$row_issuetbl['lotldg_valupto'];
											
											$barcodes2="";	
											$barc=explode(",",$barcodes);
											$brv=explode(",",$bval);
											for($j=0; $j<count($barc); $j++)
											{
												if($barc[$j]<>"")
												{
													if(!in_array($barc[$j],$brv))
													{
													if($barcodes2!="")
														$barcodes2=$barcodes2.",".$barc[$j];
													else
														$barcodes2=$barc[$j];
													}
												}
											}
											$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, lotldg_trdate, lotno, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_srtyp, lotldg_srflg, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, trstage, packtype, packlabels, barcodes, wtinmp, lotldg_dop, lotldg_valperiod, lotldg_valupto, plantcode) values('$yearcode','UNPACKAGING', '$mainid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opnop', '$opnomp', '$optqty', '$packnop', '$packnomp', '$qtys', '$balnop', '$balnomp', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$srtyp', '$srflg', '$resverstatus', '$revcomment', '$geneticpurity', '$sstage', '$packtype', '$packlabels', '$barcodes2', '$wtinmp', '$dop1', '$valperiod', '$valupto', '$plantcode')";
											if(mysqli_query($link,$sql_ins_main) or die(mysqli_error($link)))
											{
												$cnt++;
											}
											
										}
									}
								}
							}
						}
						else
						{
							$crparr=$row_mps['mpmain_crop'];
							$verarr=$row_mps['mpmain_variety'];
							$lotarr=$row_mps['mpmain_lotno'];
							$upsarr=$row_mps['mpmain_upssize'];
							$noparr=$row_mps['mpmain_lotnop'];
							$subbinarr=$row_mps['mpmain_subbin'];
							
							
							$sql_unpkgmain="Insert into tbl_unpkg (unpkg_date, unpkg_barcode, unpkg_yearcode, unpkg_logid, plantcode) values('$arrival_date','$fval','$yearid_id', '$logid', '$plantcode')";
							if(mysqli_query($link,$sql_unpkgmain) or die(mysqli_error($link)))
							{
								$mainid=mysqli_insert_id($link);
							}
								
							//for ($i=0; $i<count($lotarr); $i++)
							{
								$nops=$noparr;
								$packnop=$nops;
								$packnomp=1;
								$lotno=$lotarr;
								$crop=$crparr;
								$variety=$verarr;
								$packtype=$upsarr;
								
								$qtys=0;
								$up=explode(" ", $upsarr);
								if($up[1]=="Gms")
								{
									$ptp=$up[0]/1000;
								}
								else
								{
									$ptp=$up[0];
								}
								$qtys=$ptp*$nops; 
								
								$sql_unpkgsub="Insert into tbl_unpkgsub (unpkg_id, unpkgsub_crop, unpkgsub_variety, unpkgsub_lotno, unpkgsub_mptype, unpkgsub_ups, unpkgsub_nop, unpkgsub_qty, plantcode) values('$mainid','$crop','$variety', '$lotno', '$mptype', '".$upsarr."', '$nops', '$qtys', '$plantcode')";
								if(mysqli_query($link,$sql_unpkgsub) or die(mysqli_error($link)))
								{
									$subid=mysqli_insert_id($link);
								}
								
								$lotqry=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."'") or die(mysqli_error($link));
								$tot_row=mysqli_num_rows($lotqry);
							
								if($tot_row > 0)
								{
									while($row_issue=mysqli_fetch_array($lotqry))
									{ 
										$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."' and subbinid='".$row_issue['subbinid']."' ") or die(mysqli_error($link));
										$row_issue1=mysqli_fetch_array($sql_issue1); 
										
										$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0 and balnomp > 0") or die(mysqli_error($link)); 
										
										while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
										{
											$whid=$row_issuetbl['whid'];
											$binid=$row_issuetbl['binid'];
											$subbinid=$row_issuetbl['subbinid'];
											$packlabels=$row_issuetbl['packlabels'];
											$barcodes=$row_issuetbl['barcodes'];
											$wtinmp=$row_issuetbl['wtinmp'];
											$opnop=$row_issuetbl['balnop'];
											$opnomp=$row_issuetbl['balnomp'];
											$optqty=$row_issuetbl['balqty'];
											$pcktyp=$row_issuetbl['packtype'];
												
											$pckt=explode(" ",$pcktyp);
											$ptp=0; $nopinmp=0;
											if($pckt[1]=="Gms")
											{
												$ptp=(($pckt[0]*$zxcv)/1000);
												$nnoopp=$pckt[0];
												$nopinmp=$wtinmp*(1000/$nnoopp);
											}
											else
											{
												$ptp=($pckt[0]*$zxcv);
												$nnoopp=$pckt[0]*1000;
												$nopinmp=$wtinmp*(1000/$pckt[1]);
											}
												//echo $nopinmp;
											$balnop=$packnop+$opnop;
											$balnomp=$opnomp-$packnomp;
											$balqty=$optqty;
											if($balnop<0)$balnop=0;
											if($balnomp<0)$balnomp=0;
											if($balqty<0)$balqty=0.000;
												
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
											$srtyp=$row_issuetbl['lotldg_srtyp'];
											$srflg=$row_issuetbl['lotldg_srflg'];
											$resverstatus=$row_issuetbl['lotldg_resverstatus'];
											$revcomment=$row_issuetbl['lotldg_revcomment'];
											$geneticpurity=$row_issuetbl['lotldg_genpurity'];
											$yearcode=$row_issuetbl['yearcode'];
											$dop1=$row_issuetbl['lotldg_dop'];
											$valperiod=$row_issuetbl['lotldg_valperiod'];
											$valupto=$row_issuetbl['lotldg_valupto'];
											
											$barcodes2="";	
											$barc=explode(",",$barcodes);
											$brv=explode(",",$bval);
											for($j=0; $j<count($barc); $j++)
											{
												if($barc[$j]<>"")
												{
													if(!in_array($barc[$j],$brv))
													{
													if($barcodes2!="")
														$barcodes2=$barcodes2.",".$barc[$j];
													else
														$barcodes2=$barc[$j];
													}
												}
											}
											$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode, trtype, lotldg_id, lotldg_trdate, lotno, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_srtyp, lotldg_srflg, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, trstage, packtype, packlabels, barcodes, wtinmp, lotldg_dop, lotldg_valperiod, lotldg_valupto, plantcode) values('$yearcode','UNPACKAGING', '$mainid', '$arrival_date', '$lotno', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opnop', '$opnomp', '$optqty', '$packnop', '$packnomp', '$qtys', '$balnop', '$balnomp', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$srtyp', '$srflg', '$resverstatus', '$revcomment', '$geneticpurity', '$sstage', '$packtype', '$packlabels', '$barcodes2', '$wtinmp', '$dop1', '$valperiod', '$valupto', '$plantcode')";
											if(mysqli_query($link,$sql_ins_main) or die(mysqli_error($link)))
											{
												$cnt++;
											}
											
										}
									}
								}
							}
						}
						$sql_mps1="update tbl_mpmain set mpmain_upflg='1' where mpmain_barcode='$fval'";
						mysqli_query($link,$sql_mps1) or die(mysqli_error($link));
						$sql_mps11="update tbl_barcodes set bar_unpackflg='1' where bar_barcode='$fval'";
						mysqli_query($link,$sql_mps11) or die(mysqli_error($link));
						
						if($unpkgtyp=="pouches")
						{
							$sql_wbmain=mysqli_query($link,"select * from tbl_wbqrcode where wb_mpbarcode='$fval' ") or die(mysqli_error($link)); 
							if($tot_wbmain=mysqli_num_rows($sql_wbmain)>0)
							{
								while($row_wbmain=mysqli_fetch_array($sql_wbmain))
								{
									$trtyp=NULL;
									$sql_wbm="UPDATE tbl_wbqrcode SET wb_actdate='$trtyp', wb_type='$trtyp', wb_pnptrid='0', wb_crop='$trtyp', wb_variety='$trtyp', wb_ups='$trtyp', wb_lotno='$trtyp', wb_nop='0', wb_qty='0', wb_actflg='0', wb_actlogid='$trtyp', wb_mptype='$trtyp', wb_mpqrcode='$trtyp', wb_mpbarcode='$trtyp', wb_mpwt='$trtyp', wb_mpqlinkflg='0', wb_mpblinkflg='0', wb_mpgrosswt='0' where wb_id='".$row_wbmain['wb_id']."'  ";
									mysqli_query($link,$sql_wbm) or die(mysqli_error($link));
									
									$sql_wbs="DELETE from tbl_wbqrcode_sub where wb_id='".$row_wbmain['wb_id']."' ";
									mysqli_query($link,$sql_wbs) or die(mysqli_error($link));
								}
							}
						}
						else
						{
							$sql_wbmain=mysqli_query($link,"select * from tbl_wbqrcode where wb_mpbarcode='$fval' ") or die(mysqli_error($link)); 
							if($tot_wbmain=mysqli_num_rows($sql_wbmain)>0)
							{
								while($row_wbmain=mysqli_fetch_array($sql_wbmain))
								{
									$trtyp=NULL;
									$sql_wbm="UPDATE tbl_wbqrcode SET wb_mptype='$trtyp', wb_mpqrcode='$trtyp', wb_mpbarcode='$trtyp', wb_mpwt='$trtyp', wb_mpqlinkflg='0', wb_mpblinkflg='0', wb_mpgrosswt='0' where wb_id='".$row_wbmain['wb_id']."'  ";
									mysqli_query($link,$sql_wbm) or die(mysqli_error($link));
									
									$sql_wbs="update tbl_wbqrcode_sub SET wb_mptype='$trtyp' where wb_id='".$row_wbmain['wb_id']."' ";
									mysqli_query($link,$sql_wbs) or die(mysqli_error($link));
								}
							}
						}
					}
					$sql_unpkgmain1="update tbl_unpkg set unpkg_tflg='1' where unpkg_id='$mainid'";
					mysqli_query($link,$sql_unpkgmain1) or die(mysqli_error($link));
				}
			}
		}
		//exit;
		echo "<script>window.location='home_unpackaging.php'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Unpackaging</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="unpackingslip.js"></script>
<script src="../include/validation.js"></script>
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
function isNumberKey24(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 127 && (charCode < 47 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}
function isChar_o(Char) // This function accepts only alphabetic characters with no space, no special chars.
{
		var CharToChk = new String(Char);
		var LengthOfChar = CharToChk.length;
		var flag = true;
		for(var i=0;i<LengthOfChar;i++)
		{
			if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122)) {
			flag = false;
			break;
			}	
		}
		return flag;
}
function mySubmit()
{
var f=0;
document.frmaddDepartment.foccode.value="";
if(document.frmaddDepartment.barstype.value=="")
{
	alert("Please select Type");
	f=1;
	//document.frmaddDepartment.txtbarcode.focus();
	return false;
}
if(document.frmaddDepartment.barstype.value=="singleb")
{
	if(document.frmaddDepartment.txtbarcode0.value=="")
	{
		alert("Please enter Barcode first");
		document.frmaddDepartment.txtbarcode0.value="";
		document.frmaddDepartment.txtbarcode0.focus();
		f=1;
		return false;
	}
	else
	{
		if(document.frmaddDepartment.fet0.checked==true)
		{
			document.frmaddDepartment.foccode.value=document.frmaddDepartment.txtbarcode0.value;
		}
	}
} 
if(document.frmaddDepartment.barstype.value=="multiplebcv" || document.frmaddDepartment.barstype.value=="multipleb")
{
	var cnt=0;
	
	var ss=1;
	var ss2=20;
	if(document.frmaddDepartment.barstype.value=="multipleb")
	{ ss=21; ss2=40; }
	for (var i=ss; i<=ss2; i++)
	{
		var txtbarcode="txtbarcod"+i;
		var fet="fet"+i;
		if(document.getElementById(txtbarcode).value!="" && document.getElementById(fet).checked==true)
		{
			cnt++;
			if(document.frmaddDepartment.foccode.value!="")
			document.frmaddDepartment.foccode.value=document.frmaddDepartment.foccode.value+','+document.getElementById(txtbarcode).value;
			else
			document.frmaddDepartment.foccode.value=document.getElementById(txtbarcode).value;
		}
	}
	if(cnt==0)
	{
		alert("Please enter Barcode first");
		f=1;
		return false;
	}
	if(cnt<2)
	{
		alert("Please enter more than 1 Barcode");
		f=1;
		return false;
	}
	
}
if(document.frmaddDepartment.foccode.value=="")
{
	alert("Please select Barcode to Unpack");
	f=1;
	return false;
}
alert(document.frmaddDepartment.foccode.value);
if(f==1)
{	return false; }
else
{
	document.frmaddDepartment.submit();
	return false;
}	
}
function onloadfocus()
{
	//document.frmaddDepartment.txtbarcode.focus();
}

function resetbarcode(mltno, mltval)
{
	var txtbarcode="txtbarcod"+mltno;
	document.getElementById(txtbarcode).value="";
	mltval="";
	var bardet="bardet"+mltno;
	showUser(mltval,bardet,'showbarlots',mltno,'','','',''); 
	document.getElementById(txtbarcode).focus();
}
function chkbarcode(mltval, mltno)
{
	var flg=0;
	var mltnn=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod"+mltno;
	var txtbarcoden="txtbarcod"+mltnn;
	document.getElementById(txtbarcode).value=mltval;
	if(document.frmaddDepartment.barstype.value=="multiplebcv")
	{
		var mltn=mltno-1;
		if(mltno<20)
		mltnn=mltno+1;
		else
		mltnn=mltno;
		
		var txtbarcoden="txtbarcod"+mltnn;
		if(mltn > 0)
		{
			var txtbarcod="txtbarcod"+mltn;
			if(document.getElementById(txtbarcod).value=="")
			{
				alert("Please enter previous Barcode first");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcod).focus();
				flg=1;
				return false;
			}
		}
		var z=0;
		var ss=1;
		var ss2=20;
		for (var i=ss; i<=ss2; i++)
		{
			var txtbarcd="txtbarcod"+i;
			if(document.getElementById(txtbarcode).value==document.getElementById(txtbarcd).value)
			{
				z++;
			}
		}
		if(z > 1)
		{
			alert("Duplicate Barcode entered");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(document.frmaddDepartment.extbarcod.value!="")
		{
			var extbar=document.frmaddDepartment.extbarcod.value.split(",");
			var x=extbar.indexOf(mltval);
			if(x==-1)
			{
				alert("Barcode entered is not Linked with the Lot Number with the selected Crop-Variety");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
	}
	if(document.frmaddDepartment.barstype.value=="multipleb")
	{
		var mltn=mltno-1;
		if(mltno<40)
		mltnn=mltno+1;
		else
		mltnn=mltno;
		
		var txtbarcoden="txtbarcod"+mltnn;
		if(mltn > 20)
		{
			var txtbarcod="txtbarcod"+mltn;
			if(document.getElementById(txtbarcod).value=="")
			{
				alert("Please enter previous Barcode first");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcod).focus();
				flg=1;
				return false;
			}
			
		}
		var z=0;
		var ss=21;
		var ss2=40;
		for (var i=ss; i<=ss2; i++)
		{
			var txtbarcd="txtbarcod"+i;
			if(document.getElementById(txtbarcode).value==document.getElementById(txtbarcd).value)
			{
				z++;
			}
		}
		if(z > 1)
		{
			alert("Duplicate Barcode entered");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
	}
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		/*var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}*/
	}
	if(flg==0)
	{
		var bardet="bardet"+mltno;
		showUser(mltval,bardet,'showbarlots',mltno,'','','',''); 
		if(mltnn>0)
		document.getElementById(txtbarcoden).focus();
		else
		document.getElementById(txtbarcode).focus();
	}
}

function bartsel(bsval)
{
	if(bsval=="singleb")
	{
		document.getElementById('barsingle').style.display="block";
		document.getElementById('barmultiplecv').style.display="none";
		document.getElementById('barmultiple').style.display="none";
		document.frmaddDepartment.txtbarcode0.value="";
		document.frmaddDepartment.txtbarcode1.value="";
		document.frmaddDepartment.txtbarcode2.value="";
		document.frmaddDepartment.txtbarcode3.value="";
		document.frmaddDepartment.txtbarcode4.value="";
		document.frmaddDepartment.txtbarcode5.value="";
		document.frmaddDepartment.txtbarcode6.value="";
		document.frmaddDepartment.txtbarcode7.value="";
		document.frmaddDepartment.txtbarcode8.value="";
		document.frmaddDepartment.txtbarcode9.value="";
		document.frmaddDepartment.txtbarcode10.value="";
		document.frmaddDepartment.txtbarcode11.value="";
		document.frmaddDepartment.txtbarcode12.value="";
		document.frmaddDepartment.txtbarcode13.value="";
		document.frmaddDepartment.txtbarcode14.value="";
		document.frmaddDepartment.txtbarcode15.value="";
		document.frmaddDepartment.txtbarcode16.value="";
		document.frmaddDepartment.txtbarcode17.value="";
		document.frmaddDepartment.txtbarcode18.value="";
		document.frmaddDepartment.txtbarcode19.value="";
		document.frmaddDepartment.txtbarcode20.value="";
		document.frmaddDepartment.txtbarcode21.value="";
		document.frmaddDepartment.txtbarcode22.value="";
		document.frmaddDepartment.txtbarcode23.value="";
		document.frmaddDepartment.txtbarcode24.value="";
		document.frmaddDepartment.txtbarcode25.value="";
		document.frmaddDepartment.txtbarcode26.value="";
		document.frmaddDepartment.txtbarcode27.value="";
		document.frmaddDepartment.txtbarcode28.value="";
		document.frmaddDepartment.txtbarcode29.value="";
		document.frmaddDepartment.txtbarcode30.value="";
		document.frmaddDepartment.txtbarcode31.value="";
		document.frmaddDepartment.txtbarcode32.value="";
		document.frmaddDepartment.txtbarcode33.value="";
		document.frmaddDepartment.txtbarcode34.value="";
		document.frmaddDepartment.txtbarcode35.value="";
		document.frmaddDepartment.txtbarcode36.value="";
		document.frmaddDepartment.txtbarcode37.value="";
		document.frmaddDepartment.txtbarcode38.value="";
		document.frmaddDepartment.txtbarcode39.value="";
		document.frmaddDepartment.txtbarcode40.value="";
	}
	else if(bsval=="multiplebcv")
	{
		document.getElementById('barsingle').style.display="none";
		document.getElementById('barmultiplecv').style.display="block";
		document.getElementById('barmultiple').style.display="none";
		document.frmaddDepartment.txtbarcode0.value="";
		document.frmaddDepartment.txtbarcode1.value="";
		document.frmaddDepartment.txtbarcode2.value="";
		document.frmaddDepartment.txtbarcode3.value="";
		document.frmaddDepartment.txtbarcode4.value="";
		document.frmaddDepartment.txtbarcode5.value="";
		document.frmaddDepartment.txtbarcode6.value="";
		document.frmaddDepartment.txtbarcode7.value="";
		document.frmaddDepartment.txtbarcode8.value="";
		document.frmaddDepartment.txtbarcode9.value="";
		document.frmaddDepartment.txtbarcode10.value="";
		document.frmaddDepartment.txtbarcode11.value="";
		document.frmaddDepartment.txtbarcode12.value="";
		document.frmaddDepartment.txtbarcode13.value="";
		document.frmaddDepartment.txtbarcode14.value="";
		document.frmaddDepartment.txtbarcode15.value="";
		document.frmaddDepartment.txtbarcode16.value="";
		document.frmaddDepartment.txtbarcode17.value="";
		document.frmaddDepartment.txtbarcode18.value="";
		document.frmaddDepartment.txtbarcode19.value="";
		document.frmaddDepartment.txtbarcode20.value="";
		document.frmaddDepartment.txtbarcode21.value="";
		document.frmaddDepartment.txtbarcode22.value="";
		document.frmaddDepartment.txtbarcode23.value="";
		document.frmaddDepartment.txtbarcode24.value="";
		document.frmaddDepartment.txtbarcode25.value="";
		document.frmaddDepartment.txtbarcode26.value="";
		document.frmaddDepartment.txtbarcode27.value="";
		document.frmaddDepartment.txtbarcode28.value="";
		document.frmaddDepartment.txtbarcode29.value="";
		document.frmaddDepartment.txtbarcode30.value="";
		document.frmaddDepartment.txtbarcode31.value="";
		document.frmaddDepartment.txtbarcode32.value="";
		document.frmaddDepartment.txtbarcode33.value="";
		document.frmaddDepartment.txtbarcode34.value="";
		document.frmaddDepartment.txtbarcode35.value="";
		document.frmaddDepartment.txtbarcode36.value="";
		document.frmaddDepartment.txtbarcode37.value="";
		document.frmaddDepartment.txtbarcode38.value="";
		document.frmaddDepartment.txtbarcode39.value="";
		document.frmaddDepartment.txtbarcode40.value="";
	}
	else if(bsval=="multipleb")
	{
		document.getElementById('barsingle').style.display="none";
		document.getElementById('barmultiplecv').style.display="none";
		document.getElementById('barmultiple').style.display="block";
		document.frmaddDepartment.txtbarcode0.value="";
		document.frmaddDepartment.txtbarcode1.value="";
		document.frmaddDepartment.txtbarcode2.value="";
		document.frmaddDepartment.txtbarcode3.value="";
		document.frmaddDepartment.txtbarcode4.value="";
		document.frmaddDepartment.txtbarcode5.value="";
		document.frmaddDepartment.txtbarcode6.value="";
		document.frmaddDepartment.txtbarcode7.value="";
		document.frmaddDepartment.txtbarcode8.value="";
		document.frmaddDepartment.txtbarcode9.value="";
		document.frmaddDepartment.txtbarcode10.value="";
		document.frmaddDepartment.txtbarcode11.value="";
		document.frmaddDepartment.txtbarcode12.value="";
		document.frmaddDepartment.txtbarcode13.value="";
		document.frmaddDepartment.txtbarcode14.value="";
		document.frmaddDepartment.txtbarcode15.value="";
		document.frmaddDepartment.txtbarcode16.value="";
		document.frmaddDepartment.txtbarcode17.value="";
		document.frmaddDepartment.txtbarcode18.value="";
		document.frmaddDepartment.txtbarcode19.value="";
		document.frmaddDepartment.txtbarcode20.value="";
		document.frmaddDepartment.txtbarcode21.value="";
		document.frmaddDepartment.txtbarcode22.value="";
		document.frmaddDepartment.txtbarcode23.value="";
		document.frmaddDepartment.txtbarcode24.value="";
		document.frmaddDepartment.txtbarcode25.value="";
		document.frmaddDepartment.txtbarcode26.value="";
		document.frmaddDepartment.txtbarcode27.value="";
		document.frmaddDepartment.txtbarcode28.value="";
		document.frmaddDepartment.txtbarcode29.value="";
		document.frmaddDepartment.txtbarcode30.value="";
		document.frmaddDepartment.txtbarcode31.value="";
		document.frmaddDepartment.txtbarcode32.value="";
		document.frmaddDepartment.txtbarcode33.value="";
		document.frmaddDepartment.txtbarcode34.value="";
		document.frmaddDepartment.txtbarcode35.value="";
		document.frmaddDepartment.txtbarcode36.value="";
		document.frmaddDepartment.txtbarcode37.value="";
		document.frmaddDepartment.txtbarcode38.value="";
		document.frmaddDepartment.txtbarcode39.value="";
		document.frmaddDepartment.txtbarcode40.value="";
	}
	else
	{
		document.getElementById('barsingle').style.display="none";
		document.getElementById('barmultiplecv').style.display="none";
		document.getElementById('barmultiple').style.display="none";
		document.frmaddDepartment.txtbarcode0.value="";
		document.frmaddDepartment.txtbarcode1.value="";
		document.frmaddDepartment.txtbarcode2.value="";
		document.frmaddDepartment.txtbarcode3.value="";
		document.frmaddDepartment.txtbarcode4.value="";
		document.frmaddDepartment.txtbarcode5.value="";
		document.frmaddDepartment.txtbarcode6.value="";
		document.frmaddDepartment.txtbarcode7.value="";
		document.frmaddDepartment.txtbarcode8.value="";
		document.frmaddDepartment.txtbarcode9.value="";
		document.frmaddDepartment.txtbarcode10.value="";
		document.frmaddDepartment.txtbarcode11.value="";
		document.frmaddDepartment.txtbarcode12.value="";
		document.frmaddDepartment.txtbarcode13.value="";
		document.frmaddDepartment.txtbarcode14.value="";
		document.frmaddDepartment.txtbarcode15.value="";
		document.frmaddDepartment.txtbarcode16.value="";
		document.frmaddDepartment.txtbarcode17.value="";
		document.frmaddDepartment.txtbarcode18.value="";
		document.frmaddDepartment.txtbarcode19.value="";
		document.frmaddDepartment.txtbarcode20.value="";
		document.frmaddDepartment.txtbarcode21.value="";
		document.frmaddDepartment.txtbarcode22.value="";
		document.frmaddDepartment.txtbarcode23.value="";
		document.frmaddDepartment.txtbarcode24.value="";
		document.frmaddDepartment.txtbarcode25.value="";
		document.frmaddDepartment.txtbarcode26.value="";
		document.frmaddDepartment.txtbarcode27.value="";
		document.frmaddDepartment.txtbarcode28.value="";
		document.frmaddDepartment.txtbarcode29.value="";
		document.frmaddDepartment.txtbarcode30.value="";
		document.frmaddDepartment.txtbarcode31.value="";
		document.frmaddDepartment.txtbarcode32.value="";
		document.frmaddDepartment.txtbarcode33.value="";
		document.frmaddDepartment.txtbarcode34.value="";
		document.frmaddDepartment.txtbarcode35.value="";
		document.frmaddDepartment.txtbarcode36.value="";
		document.frmaddDepartment.txtbarcode37.value="";
		document.frmaddDepartment.txtbarcode38.value="";
		document.frmaddDepartment.txtbarcode39.value="";
		document.frmaddDepartment.txtbarcode40.value="";
	}
	document.frmaddDepartment.barstype.value=bsval;
}
function modetchk(classval)
{
	showUser(classval,'vitem','item','','','','','');
}

function modetchk1()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		 alert("Please Select Crop");
		 document.frmaddDepartment.txtvariety.selectedIndex=0;
		 document.frmaddDepartment.txtcrop.focus();
		 return false;
	}
	else
	{
		var cropval=document.frmaddDepartment.txtcrop.value;
		var classval=document.frmaddDepartment.txtvariety.value;
		showUser(classval,'extbarcodes','extbarco',cropval,'','','','');
	}
}
function selectall()
{
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++)
	{          
		var txtbarcode="txtbarcod"+i;
		if(document.getElementById(txtbarcode).value!="")
		document.frmaddDepartment.fet[i].checked = true;
	}
}

function unselectall()
{
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
	{          
		document.frmaddDepartment.fet[i].checked = false;
	}
}
function unpktsel(selval)
{
	document.frmaddDepartment.unpkgtyp.value=selval;
}
</script>

<body onload="onloadfocus();">

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/pack_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Unpackaging
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >

<?php
	$plantcodes=""; $yearcodes="";
	$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
	while($noticia = mysqli_fetch_array($quer4)) 
	{
		if($yearcodes!="")
			$yearcodes=$yearcodes.",".$noticia['ycode'];
		else
			$yearcodes=$noticia['ycode'];
	}
	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	$row_month=mysqli_fetch_array($quer6);
	$plantcodes=$row_month['code'];
	$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
	while($noticia2 = mysqli_fetch_array($quer5)) 
	{
		if($plantcodes!="")
			$plantcodes=$plantcodes.",".$noticia2['stcode'];
		else
			$plantcodes=$noticia2['stcode'];
	}
?> 	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden">
	  <input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	 <input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" /> 
	 <input type="hidden" name="foccode" value="" />
	 <input type="hidden" name="unpkgtyp" value="windowbox" />	
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Select Unpackaging Type</td>
</tr>

 <tr class="Dark" height="25">
<td width="50%" align="right" valign="middle" class="tblheading">Single Master Pack&nbsp;</td>
<td width="50%" align="left" valign="middle" class="tbltext">&nbsp;<input type="radio" name="selbartyp" value="singleb" onclick="bartsel(this.value);" /></td>
</tr>
<tr class="Dark" height="25">
<td width="50%" align="right" valign="middle" class="tblheading">Crop Variety wise Multiple Master Pack&nbsp;</td>
<td width="50%" align="left" valign="middle" class="tbltext">&nbsp;<input type="radio" name="selbartyp" value="multiplebcv" onclick="bartsel(this.value);" /></td>
</tr>
<tr class="Dark" height="25">
<td width="50%" align="right" valign="middle" class="tblheading">Multiple Master Pack&nbsp;</td>
<td width="50%" align="left" valign="middle" class="tbltext">&nbsp;<input type="radio" name="selbartyp" value="multipleb" onclick="bartsel(this.value);" /></td>
</tr>
<input type="hidden" name="barstype" value="" />
</table>
<br />
  
<div id="barsingle" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" class="tblheading">Barcode Details</td>
</tr>
<tr class="Dark" height="20">
	<td width="91" rowspan="2" align="center" valign="middle" class="smalltblheading">Barcode</td>
	<td width="30" rowspan="2" align="center" valign="middle" class="smalltblheading">MP Type</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="119" rowspan="2" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total NoP</td>
	<td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total Qty</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Action</td> 
	</tr>
<tr class="Dark" height="20">
  <td width="60" align="center" valign="middle" class="smalltblheading">Reset</td>
  <td width="60" align="center" valign="middle" class="smalltblheading"><a style="text-decoration:underline; color:#0000FF; cursor:pointer" onclick="selectall();">CA</a>&nbsp;|&nbsp;<a style="text-decoration:underline; color:#0000FF; cursor:pointer " onclick="unselectall();">CL</a></td>
</tr>
</table>
<div id="bardet0">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode0" id="txtbarcod0" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,0);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet0" disabled="disabled" /></td>
</tr>
</table>
</div>
</div>

<div id="barmultiplecv" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Barcodes</td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
<tr class="Dark" height="25">
<td width="25%" align="right" valign="middle" class="tblheading">&nbsp;Select Crop&nbsp;</td>
<td width="25%" align="left" valign="middle" class="tbltext">&nbsp;<select class="smalltbltext" name="txtcrop" style="width:120px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="15%" align="right" valign="middle" class="tblheading">&nbsp;Select Variety&nbsp;</td>
<td width="35%" align="left" valign="middle" class="tbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:150px;" onchange="modetchk1();" >
<option value="" selected>--Select Variety--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table><br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" class="tblheading">Barcode Details<span id="extbarcodes"><input type="hidden" name="extbarcod" value="" /></span></td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Dark" height="20">
	<td width="91" rowspan="2" align="center" valign="middle" class="smalltblheading">Barcode</td>
	<td width="30" rowspan="2" align="center" valign="middle" class="smalltblheading">MP Type</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="119" rowspan="2" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total NoP</td>
	<td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total Qty</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Action</td> 
	</tr>
<tr class="Dark" height="20">
  <td width="60" align="center" valign="middle" class="smalltblheading">Reset</td>
  <td width="60" align="center" valign="middle" class="smalltblheading"><a style="text-decoration:underline; color:#0000FF; cursor:pointer" onclick="selectall();">CA</a>&nbsp;|&nbsp;<a style="text-decoration:underline; color:#0000FF; cursor:pointer " onclick="unselectall();">CL</a></td>
</tr>
</table>
<div id="bardet1">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode1" id="txtbarcod1" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,1);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet1" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet2">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode2" id="txtbarcod2" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,2);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet2" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet3">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode3" id="txtbarcod3" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,3);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet3" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet4">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode4" id="txtbarcod4" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,4);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet4" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet5">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode5" id="txtbarcod5" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,5);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet5" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet6">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode6" id="txtbarcod6" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,6);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet6" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet7">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode7" id="txtbarcod7" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,7);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet7" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet8">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode8" id="txtbarcod8" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,8);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet8" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet9">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode9" id="txtbarcod9" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,9);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet9" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet10">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode10" id="txtbarcod10" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,10);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet10" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet11">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode11" id="txtbarcod11" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,11);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet11" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet12">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode12" id="txtbarcod12" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,12);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet12" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet13">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode13" id="txtbarcod13" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,13);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet13" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet14">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode14" id="txtbarcod14" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,14);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet14" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet15">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode15" id="txtbarcod15" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,15);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet15" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet16">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode16" id="txtbarcod16" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,16);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet16" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet17">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode17" id="txtbarcod17" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,17);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet17" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet18">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode18" id="txtbarcod18" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,18);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet18" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet19">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode19" id="txtbarcod19" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,19);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet19" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet20">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode20" id="txtbarcod20" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,20);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet20" disabled="disabled" /></td>
</tr>
</table>
</div>

</div>


<div id="barmultiple" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" class="tblheading">Barcode Details</td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Dark" height="20">
	<td width="91" rowspan="2" align="center" valign="middle" class="smalltblheading">Barcode</td>
	<td width="30" rowspan="2" align="center" valign="middle" class="smalltblheading">MP Type</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="119" rowspan="2" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total NoP</td>
	<td width="90" rowspan="2" align="center" valign="middle" class="smalltblheading" >Total Qty</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Action</td> 
	</tr>
<tr class="Dark" height="20">
  <td width="60" align="center" valign="middle" class="smalltblheading">Reset</td>
  <td width="60" align="center" valign="middle" class="smalltblheading"><a style="text-decoration:underline; color:#0000FF; cursor:pointer" onclick="selectall();">CA</a>&nbsp;|&nbsp;<a style="text-decoration:underline; color:#0000FF; cursor:pointer " onclick="unselectall();">CL</a></td>
</tr>
</table>
<div id="bardet21">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode21" id="txtbarcod21" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,21);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet21" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet22">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode22" id="txtbarcod22" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,22);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet22" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet23">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode23" id="txtbarcod23" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,23);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet23" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet24">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode24" id="txtbarcod24" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,24);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet24" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet25">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode25" id="txtbarcod25" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,25);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet25" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet26">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode26" id="txtbarcod26" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,26);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet26" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet27">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode27" id="txtbarcod27" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,27);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet27" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet28">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode28" id="txtbarcod28" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,28);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet28" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet29">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode29" id="txtbarcod29" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,29);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet29" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet30">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode30" id="txtbarcod30" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,30);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet30" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet31">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode31" id="txtbarcod31" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,31);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet31" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet32">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode32" id="txtbarcod32" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,32);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet32" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet33">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode33" id="txtbarcod33" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,33);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet33" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet34">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode34" id="txtbarcod34" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,34);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet34" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet35">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode35" id="txtbarcod35" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,35);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet35" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet36">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode36" id="txtbarcod36" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,36);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet36" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet37">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode37" id="txtbarcod37" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,37);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet37" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet38">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode38" id="txtbarcod38" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,38);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet38" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet39">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode39" id="txtbarcod39" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,39);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet39" disabled="disabled" /></td>
</tr>
</table>
</div>
<div id="bardet40">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse"  > 
<tr class="Dark" height="25">
<td width="91" align="center" valign="middle" class="smalltbltext"><input name="txtbarcode40" id="txtbarcod40" type="text" size="9" class="smalltbltext" value="" maxlength="11" onchange="chkbarcode(this.value,40);" tabindex="0" onkeypress="return isNumberKey24(event)" onblur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font></td>
<td width="30" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="100" align="center" valign="middle" class="smalltbltext"></td>
<td width="119" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="90" align="center" valign="middle" class="smalltbltext"></td>
<td width="60" align="center" valign="middle" class="smalltbltext">Reset</td>
<td width="60" align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="fet" id="fet40" disabled="disabled" /></td>
</tr>
</table>
</div>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
 <tr class="Dark" height="25">
<td width="50%" align="right" valign="middle" class="tblheading">Unpackage To&nbsp;</td>
<td width="50%" align="left" valign="middle" class="tbltext">&nbsp;<input type="radio" name="selunpkgtyp" value="pouches" onclick="unpktsel(this.value);" />&nbsp;Pouches&nbsp;<input type="radio" name="selunpkgtyp" value="windowbox" onclick="unpktsel(this.value);" checked="checked" />&nbsp;Window Box</td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_unpackaging.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<img src="../images/unpack.gif" border="0" onClick="return mySubmit();" /></td>
</tr>
</table>


</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
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

  

