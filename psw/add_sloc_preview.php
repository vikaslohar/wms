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
		$sql_arr=mysqli_query($link,"select * from tbl_sloc_psw where plantcode='$plantcode' and slid='".$pid."'") or die(mysqli_error($link));
		$row_arr=mysqli_fetch_array($sql_arr);
		$trdate=$row_arr['sldate'];
		$lotno=$row_arr['lotno'];
		$balanceups=0;$balanceqty=0;
		$cntd=0; $cntg=0;

		$sql_issue=mysqli_query($link,"select distinct subbinid, binid, whid  from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."'") or die(mysqli_error($link));
		while ($row_issue=mysqli_fetch_array($sql_issue))
		{
		
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
			//echo $row_issue1[0];echo "<BR>";
			//echo $t=mysqli_num_rows($sql_issue1); echo "<BR>";
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty>0") or die(mysqli_error($link)); 
			while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
			{
				$whid=$row_issuetbl['whid'];
				$binid=$row_issuetbl['binid'];
				$subbinid=$row_issuetbl['subbinid'];
				$opnop=$row_issuetbl['balnop'];
				$opups=$row_issuetbl['balnomp'];
				$opqty=$row_issuetbl['balqty'];
				$balups=0;
				$balqty=0;
				$balnops=0;
				
				$classid=$row_issuetbl['lotldg_crop'];
				$itemid=$row_issuetbl['lotldg_variety'];
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
				$resverstatus=$row_issuetbl['lotldg_resverstatus'];
				$revcomment=$row_issuetbl['lotldg_revcomment'];
				$yrcode=$row_issuetbl['yearcode'];
				$pcktyp=$row_issuetbl['packtype'];
				$packlabels=$row_issuetbl['packlabels'];
				$barcodes=$row_issuetbl['barcodes'];
				$wtinmp=$row_issuetbl['wtinmp'];
				$lotldg_dop=$row_issuetbl['lotldg_dop'];
				$lotldg_valperiod=$row_issuetbl['lotldg_valperiod'];
				$lotldg_valupto=$row_issuetbl['lotldg_valupto'];
				$lotldg_srtyp=$row_issuetbl['lotldg_srtyp'];
				$lotldg_srflg=$row_issuetbl['lotldg_srflg'];	
				$geneticpurity=$row_issuetbl['lotldg_genpurity'];
				
				$rvflg=$row_issuetbl['lotldg_rvflg'];
				$alflg=$row_issuetbl['lotldg_alflg'];
				$dispflg=$row_issuetbl['lotldg_dispflg'];
				$altrids=$row_issuetbl['lotldg_altrids'];
				$alqtys=$row_issuetbl['lotldg_alqtys'];
				$alnomps=$row_issuetbl['lotldg_alnomps'];
				$spremflg=$row_issuetbl['lotldg_spremflg'];
						
				if($sstage=="") $sstage="Pack";
				
				$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, plantcode) values('$yrcode','PSWSUO', '$sstage', '$pid', '$trdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opnop', '$opups', '$opqty', '$opnop', '$opups', '$opqty', '$balnops', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$geneticpurity', '$rvflg', '$alflg', '$dispflg', '$altrids', '$alqtys', '$alnomps', '$spremflg', '$plantcode')";
				mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
		
			//}	
				$cntg=0;		
				//$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where subbinid='".$subbinid."'") or die(mysqli_error($link));
				
				//while($row_issueg=mysqli_fetch_array($sql_issueg))
				//{ 
					$sql_lot=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
					while($row_lot=mysqli_fetch_array($sql_lot))
					{
						$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."' and lotno='".$row_issueg['lotno']."'") or die(mysqli_error($link));
						$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
						$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
						$totnog=mysqli_num_rows($sql_issuetblg);
						if($totnog > 0)
						{
						  $cntg++;
						} 
					}
				//}
			  
			  
				//$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
				//$cntg=0;
				//while($row_issueg=mysqli_fetch_array($sql_issueg))
				//{ 
					$sql_lot=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
					while($row_lot=mysqli_fetch_array($sql_lot))
					{   
						$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."'") or die(mysqli_error($link));
						$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
						$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
						$totnog=mysqli_num_rows($sql_issuetblg);
						if($totnog > 0)
						{
						  $cntg++;
						} 
					}	
				//}
			  
				
				if($cntg==0)
				{
					$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
					mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
				}
			}	
		}

		$sql_sloc_sub22=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$pid."'") or die(mysqli_error($link));
		while($row_sloc_sub22=mysqli_fetch_array($sql_sloc_sub22))
		{
			$opnop1=0; $opups1=0; $opqty1=0; $balnop1=0; $balups1=0; $balqty1=0; $nop1=0; $ups1=0; $qty1=0;
				
			$whid1=$row_sloc_sub22['whid'];
			$binid1=$row_sloc_sub22['binid'];
			$subbinid1=$row_sloc_sub22['subbinid'];
			$nop1=$row_sloc_sub22['nop'];
			$ups1=$row_sloc_sub22['nomp'];
			$qty1=$row_sloc_sub22['qty'];
			//$opqty
			$sql_issue122=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode'  and lotno='".$lotno."'") or die(mysqli_error($link));
			$t12322=mysqli_num_rows($sql_issue122);
			$row_issue122=mysqli_fetch_array($sql_issue122); 
			
			$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue122[0]."' and balqty>0") or die(mysqli_error($link)); 
			$tttttt22=mysqli_num_rows($sql_issuetbl22);
			if($tttttt22 == 0)
			{
				$sql_issue122=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$lotno."'") or die(mysqli_error($link));
				$t12322=mysqli_num_rows($sql_issue122);
				$row_issue122=mysqli_fetch_array($sql_issue122); 
						
				$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
				$row_issuetbl22=mysqli_fetch_array($sql_issuetbl22);
				$opnop1=0;
				$opups1=0;
				$opqty1=0;
			}
			else
			{
				$row_issuetbl22=mysqli_fetch_array($sql_issuetbl22);
				$opnop1=$row_issuetbl22['balnop'];
				$opups1=$row_issuetbl22['balnomp'];
				$opqty1=$row_issuetbl22['balqty'];
			}
				
			$balnop1=$nop1;
			$balups1=$ups1;
			$balqty1=$qty1;
			if($row_issuetbl22['subbinid']!=$subbinid1)
			{
				$balnop1=$balnop1+$opnop1;
				$balups1=$balups1+$opups1;
				$balqty1=$balqty1+$opqty1;
			}
			
			$classid=$row_issuetbl22['lotldg_crop'];
			$itemid=$row_issuetbl22['lotldg_variety'];
			
			$sstage1=$row_issuetbl22['lotldg_sstage'];
			$sstatus1=$row_issuetbl22['lotldg_sstatus'];
			$moist1=$row_issuetbl22['lotldg_moisture'];
			$gemp1=$row_issuetbl22['lotldg_gemp'];
			$vchk1=$row_issuetbl22['lotldg_vchk'];
			$got11=$row_issuetbl22['lotldg_got1'];
			$qc1=$row_issuetbl22['lotldg_qc'];
			
			$gotstatus1=$row_issuetbl22['lotldg_got'];
			$qctestdate1=$row_issuetbl22['lotldg_qctestdate'];
			$gottestdate1=$row_issuetbl22['lotldg_gottestdate'];
			$orlot1=$row_issuetbl22['orlot'];
			$resverstatus1=$row_issuetbl22['lotldg_resverstatus'];
			$revcomment1=$row_issuetbl22['lotldg_revcomment'];
			
			$yrcode1=$row_issuetbl22['yearcode'];
			$pcktyp1=$row_issuetbl22['packtype'];
			$packlabels1=$row_issuetbl22['packlabels'];
			$barcodes1=$row_issuetbl22['barcodes'];
			$wtinmp1=$row_issuetbl22['wtinmp'];
			$lotldg_dop1=$row_issuetbl22['lotldg_dop'];
			$lotldg_valperiod1=$row_issuetbl22['lotldg_valperiod'];
			$lotldg_valupto1=$row_issuetbl22['lotldg_valupto'];
			$lotldg_srtyp1=$row_issuetbl22['lotldg_srtyp'];
			$lotldg_srflg1=$row_issuetbl22['lotldg_srflg'];
			$geneticpurity1=$row_issuetbl22['lotldg_genpurity'];
			
			$rvflg1=$row_issuetbl22['lotldg_rvflg'];
			$alflg1=$row_issuetbl22['lotldg_alflg'];
			$dispflg1=$row_issuetbl22['lotldg_dispflg'];
			$altrids1=$row_issuetbl22['lotldg_altrids'];
			$alqtys1=$row_issuetbl22['lotldg_alqtys'];
			$alnomps1=$row_issuetbl22['lotldg_alnomps'];
			$spremflg1=$row_issuetbl22['lotldg_spremflg'];
						
			if($sstage1=="") $sstage1="Pack";
			
			$sql_ins_sub11="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, plantcode) values('$yrcode1','PSWSUC', '$sstage1', '$pid', '$trdate', '$lotno', '$pcktyp1', '$packlabels1', '$barcodes1', '$wtinmp1', '$classid', '$itemid', '$whid1', '$binid1', '$subbinid1', '$opnop1', '$opups1', '$opqty1', '$nop1', '$ups1', '$qty1', '$balnop1', '$balups1', '$balqty1', '$sstage1', '$sstatus1', '$moist1', '$gemp1', '$vchk1', '$got11', '$qc1', '$gotstatus1', '$qctestdate1', '$gottestdate1', '$orlot1', '$resverstatus1', '$revcomment1', '$lotldg_dop1', '$lotldg_valperiod1', '$lotldg_valupto1', '$lotldg_srtyp1', '$lotldg_srflg1', '$geneticpurity1', '$rvflg1', '$alflg1', '$dispflg1', '$altrids1', '$alqtys1', '$alnomps1', '$spremflg1', '$plantcode')";
			mysqli_query($link,$sql_ins_sub11) or die(mysqli_error($link));
				
			$sql_itmg="update tbl_subbin set status='$sstage1' where sid='$subbinid1'";
			mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
			
			$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_lotno='$lotno'") or die(mysqli_error($link));
			$tot_mps=mysqli_num_rows($sql_mps);
			if($tot_mps > 0)
			{
				//while($row_mps=mysqli_fetch_array($sql_mps))
				//{
				
					$sql_ins_main24="update tbl_mpmain set mpmain_wh='$whid1', mpmain_bin='$binid1', mpmain_subbin='$subbinid1' where mpmain_lotno='$lotno' and mpmain_wh!=12";
					mysqli_query($link,$sql_ins_main24) or die(mysqli_error($link));
				//}
			}	
		}
		
		/*$s_chk=mysqli_query($link,"SELECT * FROM tbl_sloc_psw where yearcode='$yearid_id'") or die (mysqli_error($link));
		$r_chk=mysqli_num_rows($s_chk);
		if($r_chk > 0)*/
		$sql_code="SELECT MAX(scode) FROM tbl_sloc_psw where plantcode='$plantcode' and yearcode='$yearid_id' ORDER BY scode DESC";
		/*else
			$sql_code="SELECT MAX(scode) FROM tbl_sloc_psw  ORDER BY scode DESC";*/
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
		
				
		$sql_main="update tbl_sloc_psw set supflg=1, scode=$code  where slid='".$pid."'";
		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		//exit;
 	
		echo "<script>window.location='select_sloc_op.php?p_id=$pid'</script>";	
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw -Transaction - Sloc Update-Lot wise</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
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

<script src="slocup.js"></script>
<script language="javascript" type="text/javascript">


function openslocpopprint()
{

var pid=document.frmaddDept.pid.value;
winHandle=window.open('issue_slupdation_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
/*if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}*/
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
          <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation - Lot wise - Preview </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_sloc_psw where plantcode='$plantcode' and slid='".$pid."'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	
	$tdate=$row['sldate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_sub=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$pid."'")or die(mysqli_error($link));
    $row_sub=mysqli_fetch_array($sql_sub);
	
	$c=$row['crop'];
	$f=$row['variety'];
	$a=$row['lotno'];
?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="pid" value="<?php echo $pid;?>" type="hidden">
	  <input name="txtdate" value="<?php echo $tdate;?>" type="hidden">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation - Lot wise</td>
</tr>
 
 <?php 
$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$c."'") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($quer3);
?>
		 <tr class="Light" height="25">
           <td width="158"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?></td>
         </tr>
<?php 
$itemqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$f."' and actstatus='Active'") or die(mysqli_error($link));
$t=mysqli_num_rows($itemqry1);
if($t > 0)
{
	$row_itm=mysqli_fetch_array($itemqry1);
	$var=$row_itm['popularname'];
}
else
{
	$var=$f;
}
?> 
		<tr class="Dark" height="25">
           <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
           <td align="left"  valign="middle"  id="item" class="tbltext" colspan="3">&nbsp;<?php echo $var;?></td>
         </tr>
		  <tr class="Light" height="25">
		  <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $a;?></td>
	      </tr>
</table>
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="8">Existing Sloc </td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">UPS</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">NoP</td>
<td width="122" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$c."' and lotldg_variety='".$f."' and lotno='".$a."'") or die(mysqli_error($link));

$srno=1;
$totups=0; $totqty=0; $upssize=""; $totnops=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_variety='".$f."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 $upssize=$row_issuetbl['packtype'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nop1=0; $nop2=0; $b1=0; $b2=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$packtp=explode(" ",$row_issuetbl['packtype']);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp2=(1000/$packtp[0]);
}
else
{
	$ptp2=$packtp[0];
}
$bl=($row_issuetbl['balqty']*1000)/1000;
$b2=(($wtinmp*$row_issuetbl['balnomp'])*1000)/1000;
if($b1===$b2)
$penqty=0;
else
$penqty=$bl-$b2;


if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp2*$penqty);
	}
	else
	{
		$nop1=($penqty/$ptp2);
	}
}
if($packtp[1]=="Gms")
{
	$nop2=($ptp2*$row_issuetbl['balqty']);
}
else
{
	$nop2=($row_issuetbl['balqty']/$ptp2);
}

$txtlot1=$a;
$txtvariety=$f;
$nop2;
$zz=str_split($txtlot1);
$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];


$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$txtlot1' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=$row_mps['mpmain_crop'];
		$verarr=$row_mps['mpmain_variety'];
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=$row_mps['mpmain_upssize'];
		$noparr=explode(",", $row_mps['mpmain_mptnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nops=$nops+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; 
			}
		}
		
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$txtvariety' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=$row_mpl['mpmain_crop'];
		$verarr=$row_mpl['mpmain_variety'];
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=$row_mpl['mpmain_upssize'];
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopl=$nopl+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyl=$qtyl+($ptp*$noparr[$i]); $nompl=$nompl+$ct; 
			}
		}
		
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
if($tot_mpm > 0)
{
	while($row_mpm=mysqli_fetch_array($sql_mpm))
	{
		$crparr=explode(",", $row_mpm['mpmain_crop']);
		$verarr=explode(",", $row_mpm['mpmain_variety']);
		$lotarr=explode(",", $row_mpm['mpmain_lotno']);
		$upsarr=explode(",", $row_mpm['mpmain_upssize']);
		$noparr=explode(",", $row_mpm['mpmain_lotnop']);
		
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopm=$nopm+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtym=$qtym+($ptp*$noparr[$i]); $nompm=$nompm+$ct; 
			}
		}
		
	}
}

$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$txtlot1' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=$row_mpns['mpmain_crop'];
		$verarr=$row_mpns['mpmain_variety'];
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=$row_mpns['mpmain_upssize'];
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopns=$nopns+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$txtvariety' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=$row_mpnl['mpmain_crop'];
		$verarr=$row_mpnl['mpmain_variety'];
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=$row_mpnl['mpmain_upssize'];
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopnl=$nopnl+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$ct; 
			}
		}
		
	}
}
//echo $nops."  -  ".$nopl;
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 	
$qty=$row_issuetbl['balqty']-$totextqtys;
$nop=$nop2-$totextpouches;
if($row_issuetbl['balqty']>0)
$nop=$nop2-$totextpouches;
//$qty=$nob*$ptp2;


$nomp=$row_issuetbl['balnomp'];
$bqty=$row_issuetbl['balqty'];
$aq1=explode(".",$nop1);
$aq2=explode(".",$row_issuetbl['balnomp']);
$aq3=explode(".",$row_issuetbl['balqty']);
if($aq1[1]==000){$nop=$aq1[0];}else{$nop=$nop1;}
if($aq2[1]==000){$nomp=$aq2[0];}else{$nomp=$row_issuetbl['balnomp'];}
if($aq3[1]==000){$bqty=$aq3[0];}else{$bqty=$row_issuetbl['balqty'];}

$totnop=$totnop+$nop;
$totnomp=$totnomp+$nomp;
$totqty=$totqty+$bqty;

if($nomp<=0){$nomp=0;}
if($totnomp<=0){$totnomp=0;}
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $upssize;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balnomp'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $upssize;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balnomp'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['balqty'];?></td>
 </tr>
 <?php
 }
 $srno++;
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="5">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totnops;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="8">Updated Sloc </td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">UPS</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">NoP</td>
<td width="122" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sr=1;
$totups=0; $totqty=0; $totnop=0;
$sql_sloc_sub=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$pid."' order by slocsubid") or die (mysqli_error($link));

while($row_sloc_sub=mysqli_fetch_array($sql_sloc_sub))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc_sub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sloc_sub['subbinid']."' and binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];


$wtinmp=$row_sloc_sub['wtinmp'];
$upspacktype=$row_sloc_sub['packtype'];
if($upspacktype=="")$upspacktype=$upssize;
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
$bl=($row_sloc_sub['balqty']*100)/100;
$b2=(($wtinmp*$row_sloc_sub['balnomp'])*100)/100;
if($b1===$b2)
$penqty=0;
else
$penqty=$bl-$b2;
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}

$totnop=$totnop+$row_sloc_sub['nop'];
$totups=$totups+$row_sloc_sub['balnomp'];
$totqty=$totqty+$row_sloc_sub['balqty'];

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $upspacktype;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['nop'];?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['balnomp'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['balqty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $upspacktype;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['nop'];?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['balnomp'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['balqty'];?></td>
</tr>
<?php
}
$sr++;
}
?>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="5">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totnop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >

<tr >
<td valign="top" align="right"><a href="edit_sloc_updation.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
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
