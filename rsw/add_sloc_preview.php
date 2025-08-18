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
		$sql_arr=mysqli_query($link,"select * from tbl_sloc where slid='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
		$row_arr=mysqli_fetch_array($sql_arr);
		$classid=$row_arr['crop'];
		$itemid=$row_arr['variety'];
		$trdate=$row_arr['sldate'];
		$lotno=$row_arr['lotno'];
		$balanceups=0;$balanceqty=0;
		$cntd=0; $cntg=0;

		$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid  from tbl_lot_ldg where lotldg_crop='".$classid."' and lotldg_variety='".$itemid."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
		while ($row_issue=mysqli_fetch_array($sql_issue))
		{
		
		$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$itemid."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode' ") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		//echo $row_issue1[0];echo "<BR>";
		//echo $t=mysqli_num_rows($sql_issue1); echo "<BR>";
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."'and lotldg_balqty>0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
				$whid=$row_issuetbl['lotldg_whid'];
				$binid=$row_issuetbl['lotldg_binid'];
				$subbinid=$row_issuetbl['lotldg_subbinid'];
				$opups=$row_issuetbl['lotldg_balbags'];
				$opqty=$row_issuetbl['lotldg_balqty'];
				$balups=0;
				$balqty=0;
				
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
				$gs=$row_issuetbl['lotldg_gs'];
				$resverstatus=$row_issuetbl['lotldg_resverstatus'];
				$revcomment=$row_issuetbl['lotldg_revcomment'];
				$geneticpurity=$row_issuetbl['lotldg_genpurity'];
				$srtyp=$row_issuetbl['lotldg_srtyp'];
				$srflg=$row_issuetbl['lotldg_srflg'];
				$mergerflg=$row_issuetbl['lotldg_mergerflg'];
				$unlistflg=$row_issuetbl['lotldg_unlistflg'];
				$ycode=$row_issuetbl['yearcode'];
				
				if($sstage=="")$sstage="Raw";
				
				 $sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, lotldg_mergerflg, lotldg_unlistflg, plantcode) values('$ycode','RSWSUO', '$pid', '$trdate', '$lotno', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$opups', '$opqty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$geneticpurity', '$srtyp', '$srflg', '$mergerflg', '$unlistflg', '$plantcode')";
				mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
		
			}	
					
$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where subbinid='".$subbinid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$cntg=0;
while($row_issueg=mysqli_fetch_array($sql_issueg))
{ 
$sql_lot=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where subbinid='".$subbinid."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_lot=mysqli_fetch_array($sql_lot))
{
	$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."' and lotno='".$row_issueg['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issueg1[0]."' and balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
	$totnog=mysqli_num_rows($sql_issuetblg);
	if($totnog > 0)
	{
	  $cntg++;
	} 
  }
  }
  
  
$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$cntg=0;
while($row_issueg=mysqli_fetch_array($sql_issueg))
{ 
$sql_lot=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_lot=mysqli_fetch_array($sql_lot))
{   
	$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 
	$totnog=mysqli_num_rows($sql_issuetblg);
	if($totnog > 0)
	{
	  $cntg++;
	} 
  }	
  }	
  if($cntg==0)
  {
  	$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
	mysqli_query($link,$sql_itmg) or die(mysqli_error($link));		
  }
}

		$sql_sloc_sub22=mysqli_query($link,"select * from tbl_sloc_sub where slocid='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
		while($row_sloc_sub22=mysqli_fetch_array($sql_sloc_sub22))
		{
				$whid1=$row_sloc_sub22['whid'];
				$binid1=$row_sloc_sub22['binid'];
				$subbinid1=$row_sloc_sub22['subbinid'];
				$ups1=$row_sloc_sub22['bags'];
				$qty1=$row_sloc_sub22['qty'];
				
				$sql_issue122=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid1."' and lotldg_binid='".$binid1."' and lotldg_whid='".$whid1."' and lotldg_variety='".$itemid."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$t12322=mysqli_num_rows($sql_issue122);
		$row_issue122=mysqli_fetch_array($sql_issue122); 

	$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue122[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
	$tttttt22=mysqli_num_rows($sql_issuetbl22);
	if($tttttt22 == 0)
	{
	$sql_issue122=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_variety='".$itemid."' and lotldg_lotno='".$lotno."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$t12322=mysqli_num_rows($sql_issue122);
	$row_issue122=mysqli_fetch_array($sql_issue122); 
	
	$sql_issuetbl22=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
	
	$row_issuetbl22=mysqli_fetch_array($sql_issuetbl22);
	}
	else
	{
	$row_issuetbl22=mysqli_fetch_array($sql_issuetbl22);
	}
				$opups1=$row_issuetbl22['lotldg_balbags'];
				$opqty1=$row_issuetbl22['lotldg_balqty'];
				//$opups1=$balups1+$opups1;
				//$opqty1=$balqty1+$opqty1;
				$balups1=$ups1;
				$balqty1=$qty1;
				
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
				$gs1=$row_issuetbl22['lotldg_gs'];
				$resverstatus1=$row_issuetbl22['lotldg_resverstatus'];
				$revcomment1=$row_issuetbl22['lotldg_revcomment'];
				$geneticpurity2=$row_issuetbl22['lotldg_genpurity'];
				$srtyp1=$row_issuetbl22['lotldg_srtyp'];
				$srflg1=$row_issuetbl22['lotldg_srflg'];
				$mergerflg1=$row_issuetbl22['lotldg_mergerflg'];
				$unlistflg1=$row_issuetbl22['lotldg_unlistflg'];
				$ycode1=$row_issuetbl22['yearcode'];
				
				if($sstage1=="")$sstage1=="Raw";
				
			 	$sql_ins_sub11="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_srtyp, lotldg_srflg, lotldg_mergerflg, lotldg_unlistflg, plantcode) values('$ycode1','RSWSUC', '$pid', '$trdate', '$lotno', '$classid', '$itemid', '$whid1', '$binid1', '$subbinid1', '$opups1', '$opqty1', '$ups1', '$qty1', '$balups1', '$balqty1', '$sstage1', '$sstatus1', '$moist1', '$gemp1', '$vchk1', '$got11', '$qc1', '$gotstatus1', '$qctestdate1', '$gottestdate1', '$orlot1', '$gs1', '$resverstatus1', '$revcomment1', '$geneticpurity2', '$srtyp1', '$srflg1', '$mergerflg1', '$unlistflg1', '$plantcode')";
				mysqli_query($link,$sql_ins_sub11) or die(mysqli_error($link));
				
				$sql_itmg="update tbl_subbin set status='$sstage1' where sid='$subbinid1'";
				mysqli_query($link,$sql_itmg) or die(mysqli_error($link));
		
		}
		
		
		/*$sql_itm=mysqli_query($link,"select * from tbl_stores where items_id='".$itemid."' and srl_status='Yes'") or die (mysqli_error($link));
		$t_itm=mysqli_num_rows($sql_itm);
		if($t_itm > 0)
		{
			$row_itm=mysqli_fetch_array($sql_itm);
			$tqty=0;
			$sql_is=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_trclassid='".$classid."' and lotldg_variety!='".$itemid."'") or die(mysqli_error($link));
$cntg=0;
			while($row_is=mysqli_fetch_array($sql_is))
 			{ 
			
			$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_whid='".$row_is['lotldg_whid']."' and lotldg_variety='".$itemid."'") or die(mysqli_error($link));		
			$row_is1=mysqli_fetch_array($sql_is1); 
			
			$sql_issue1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link));
			$tot_issue1=mysqli_num_rows($sql_issue1);
			if($tot_issue1 > 0)
			{
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				$tqty=$tqty+$row_issue1['lotldg_balqty'];
			}
			}	
			$actrol=$row_itm['srl'];
			$srlstatus=$row_itm['srl_status'];
			if(($tqty <= $actrol) && $srlstatus!="OR")
			{
			$sql_sub_sub="update tbl_lot_ldg set orstatus='R' where lotldg_variety='".$itemid."' and lotldg_balqty > 0";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			}
		}
		
		*/
		
	$s_chk=mysqli_query($link,"SELECT * FROM tbl_sloc where yearcode='$yearid_id' and plantcode='$plantcode'") or die (mysqli_error($link));
	$r_chk=mysqli_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(scode) FROM tbl_sloc where yearcode='$yearid_id' and plantcode='$plantcode' ORDER BY scode DESC";
	else
	$sql_code="SELECT MAX(scode) FROM tbl_sloc WHERE plantcode='$plantcode' ORDER BY scode DESC";
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
		
				
	$sql_main="update tbl_sloc set supflg=1, scode=$code  where slid='".$pid."'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	//exit;
 	
			echo "<script>window.location='select_sloc_op.php?p_id=$pid'</script>";	
}
		

	
/*	$a="c";
	$sql_code="SELECT MAX(code) FROM tbl_sloc where  yearcode='$yearid_id' ORDER BY code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code;
		}
		else
		{
			$code=1;
			$code1=$a.$code;
		}*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW -Transaction -Sloc Update</title>
<link href="../include/main_rsw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
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
          <td valign="top"><?php require_once("../include/arr_rsw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#e48324"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" style="border-bottom:solid; border-bottom-color:#e48324" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation - Preview </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_sloc where slid='".$pid."' and plantcode='$plantcode'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	
	$tdate=$row['sldate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_sub=mysqli_query($link,"select * from tbl_sloc_sub where slocid='".$pid."' and plantcode='$plantcode'")or die(mysqli_error($link));
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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation</td>
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
$itemqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$f."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">Existing Sloc </td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">Bags</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$c."' and lotldg_variety='".$f."' and lotldg_lotno='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$f."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totups=$totups+$row_issuetbl['lotldg_balbags'];
$totqty=$totqty+$row_issuetbl['lotldg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?></td>
 </tr>
 <?php
 }
 $srno++;
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">Updated Sloc </td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">Bags</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sr=1;
$totups=0; $totqty=0;
$sql_sloc_sub=mysqli_query($link,"select * from tbl_sloc_sub where slocid='".$pid."' and plantcode='$plantcode' order by slocsubid") or die (mysqli_error($link));

while($row_sloc_sub=mysqli_fetch_array($sql_sloc_sub))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc_sub['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc_sub['subbinid']."' and binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totups=$totups+$row_sloc_sub['bags'];
$totqty=$totqty+$row_sloc_sub['qty'];

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['bags'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['qty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['bags'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['qty'];?></td>
</tr>
<?php
}
$sr++;
}
?>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
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
