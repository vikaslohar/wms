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
	$sql_arr=mysqli_query($link,"select * from tbl_sloc_binw where plantcode='$plantcode' and slid='".$pid."'") or die(mysqli_error($link));
	$row_arr=mysqli_fetch_array($sql_arr);
	$who=$row_arr['wh'];
	$bino=$row_arr['bin'];
	$subbino=$row_arr['subbin'];
	$trdate=$row_arr['sldate'];

	$sql_sloc_sub22=mysqli_query($link,"select * from tbl_sloc_binw_sub where plantcode='$plantcode' and slocid='".$pid."'") or die(mysqli_error($link));
	while($row_sloc_sub22=mysqli_fetch_array($sql_sloc_sub22))
	{
		$whid1=$row_sloc_sub22['whid'];
		$binid1=$row_sloc_sub22['binid'];
		$subbinid1=$row_sloc_sub22['subbinid'];
		$olotno=$row_sloc_sub22['lotno'];
		/*$itemid=$row_sloc_sub22['variety'];*/
				
		$sql_issue=mysqli_query($link,"select distinct (lotno)  from tbl_lot_ldg_pack where plantcode='$plantcode' and whid='".$who."' and binid='".$bino."' and subbinid='".$subbino."' and lotno='$olotno'") or die(mysqli_error($link));
		while ($row_issue=mysqli_fetch_array($sql_issue))
		{
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbino."' and binid='".$bino."' and whid='".$who."' and lotno='".$row_issue['lotno']."' ") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
			//echo $row_issue1[0];echo "<BR>";
			//echo $t=mysqli_num_rows($sql_issue1); echo "<BR>";
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
			while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
			{
				$whid=$row_issuetbl['whid'];
				$binid=$row_issuetbl['binid'];
				$subbinid=$row_issuetbl['subbinid'];
				$opnop=$row_issuetbl['balnop'];
				$opups=$row_issuetbl['balnomp'];
				$opqty=$row_issuetbl['balqty'];
				$balnop=0;
				$balups=0;
				$balqty=0;
				$nop1=0;
				$ups1=0;
				$qty1=0;
				
				$classid=$row_issuetbl['lotldg_crop'];
				$itemid=$row_issuetbl['lotldg_variety'];
				$sstage=$row_issuetbl['lotldg_sstage'];
				$sstatus=$row_issuetbl['lotldg_sstatus'];
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
						
				$balnop1=$opnop;
				$balups1=$opups;
				$balqty1=$opqty;
						
				$lotno1=$lotno1.",".$lotno;
					
				$sql_ins_main="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, plantcode) values('$ycode','SBWSUO', '$sstage', '$pid', '$trdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opnop', '$opups', '$opqty', '$opnop', '$opups', '$opqty', '$balnop', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$rvflg', '$alflg', '$dispflg', '$altrids', '$alqtys', '$alnomps', '$spremflg', '$plantcode')";
				mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
					
				$sql_ins_sub11="insert into tbl_lot_ldg_pack (yearcode, trtype, trstage, lotldg_id, lotldg_trdate, lotno, packtype, packlabels, barcodes, wtinmp, lotldg_crop, lotldg_variety, whid, binid, subbinid, opnop, opnomp, optqty, nop, nomp, tqty, balnop, balnomp, balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_resverstatus, lotldg_revcomment, lotldg_genpurity, lotldg_dop, lotldg_valperiod, lotldg_valupto, lotldg_srtyp, lotldg_srflg, lotldg_rvflg, lotldg_alflg, lotldg_dispflg, lotldg_altrids, lotldg_alqtys, lotldg_alnomps, lotldg_spremflg, plantcode) values('$ycode','SBWSUC', '$sstage', '$pid', '$trdate', '$lotno', '$pcktyp', '$packlabels', '$barcodes', '$wtinmp', '$classid', '$itemid', '$whid1', '$binid1', '$subbinid1', '$opnop', '$opups', '$opqty', '$nop1', '$ups1', '$qty1', '$balnop1', '$balups1', '$balqty1', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$resverstatus', '$revcomment', '$geneticpurity', '$lotldg_dop', '$lotldg_valperiod', '$lotldg_valupto', '$lotldg_srtyp', '$lotldg_srflg', '$rvflg', '$alflg', '$dispflg', '$altrids', '$alqtys', '$alnomps', '$spremflg', '$plantcode')";
				mysqli_query($link,$sql_ins_sub11) or die(mysqli_error($link));
				
				
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
				
				$sql_issueg=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
				$cntg=0;
				while($row_issueg=mysqli_fetch_array($sql_issueg))
				{ 
					$sql_lot=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."'") or die(mysqli_error($link));
					while($row_lot=mysqli_fetch_array($sql_lot))
					{
						$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$subbinid."' and binid='".$row_issueg['binid']."' and whid='".$row_issueg['whid']."' and lotno='".$row_issueg['lotno']."'") or die(mysqli_error($link));
						$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
						$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link)); 
						$totnog=mysqli_num_rows($sql_issuetblg);
						if($totnog > 0)
						{
							$cntg++;
						} 
					}
				}
				  
				  
				$sql_issueg=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
				$cntg=0;
				while($row_issueg=mysqli_fetch_array($sql_issueg))
				{ 
					$sql_lot=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));
					while($row_lot=mysqli_fetch_array($sql_lot))
					{   
						$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' and lotldg_subbinid='".$subbinid."' and lotldg_binid='".$row_issueg['lotldg_binid']."' and lotldg_whid='".$row_issueg['lotldg_whid']."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."'") or die(mysqli_error($link));
						$row_issueg1=mysqli_fetch_array($sql_issueg1); 
						
						$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' and lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
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
		}
		
		/*$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
		mysqli_query($link,$sql_itmg) or die(mysqli_error($link));*/
		$sql_itmg11="update tbl_subbin set status='$sstage' where sid='$subbinid1'";
		mysqli_query($link,$sql_itmg11) or die(mysqli_error($link));	
	}					
	$sql_main="update tbl_sloc_binw set supflg=1 where slid='".$pid."'";
	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	//exit;
	echo "<script>window.location='select_sloc_binw_op.php?p_id=$pid'</script>";	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PSW -Transaction -Sloc Update</title>
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
winHandle=window.open('binw_slupdation_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation Sub-Bin wise - Preview </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
<?php
	$sql1=mysqli_query($link,"select * from tbl_sloc_binw where plantcode='$plantcode' and slid='".$pid."'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	
	$tdate=$row['sldate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_sub=mysqli_query($link,"select * from tbl_sloc_binw_sub where plantcode='$plantcode' and slocid='".$pid."'")or die(mysqli_error($link));
    $row_sub=mysqli_fetch_array($sql_sub);
	
	$sql_wh=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row['wh']."' order by perticulars") or die(mysqli_error($link));
	$row_wh=mysqli_fetch_array($sql_wh);
	
	$sql_bn=mysqli_query($link,"select binid, binname from tbl_bin  where plantcode='$plantcode' and binid='".$row['bin']."'") or die(mysqli_error($link));
	$row_bn=mysqli_fetch_array($sql_bn);
	
	$sql_sbn=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and sid='".$row['subbin']."' order by sname")or die("Error:".mysqli_error($link));
	$row_sbn=mysqli_fetch_array($sql_sbn);
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
  <td colspan="6" align="center" class="tblheading">SLOC Updation Sub-Bin wise</td>
</tr>
 <tr class="tblsubtitle">
    <td align="center" valign="middle" class="tblheading" colspan="6">Existing SLOC</td>
  </tr>
<tr class="Light" height="25">
	<td width="110" align="right"  valign="middle" class="tblheading">&nbsp;WH&nbsp; </td>                                   
	<td width="163" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_wh['perticulars'];?></td>
	<td width="67" align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
	<td width="143" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_bn['binname'];?></td>
	<td width="73" align="right"  valign="middle" class="tblheading">Sub-Bin&nbsp;</td>
	<td width="180" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_sbn['sname'];?></td>
</tr>
</table>
<div id="showsloc" style="display:block">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse"  cols="2">
  <tr class="tblsubtitle">
    <td width="70" align="center" valign="middle" class="tblheading" >#</td>
	<td width="318" align="center" valign="middle" class="tblheading">Crop</td>
	  <td width="296" align="center" valign="middle" class="tblheading">Variety</td>
	   <td width="256" align="center" valign="middle" class="tblheading">Stage</td>
	   <td width="256" align="center" valign="middle" class="tblheading">Lot No.</td>
  </tr>
<?php
$srno=1; $cnt=0; $cropt="";$vert=""; $crpflg=0; $verflg=0; $stage=""; $stageflg=0;
$sql_iss=mysqli_query($link,"select distinct (lotno)  from tbl_lot_ldg_pack where plantcode='$plantcode' and whid='".$row['wh']."' and binid='".$row['bin']."' and subbinid='".$row['subbin']."'") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_iss);
while($row_iss=mysqli_fetch_array($sql_iss))
{ 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row['subbin']."' and binid='".$row['bin']."' and whid='".$row['wh']."' and lotno='".$row_iss['lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty>0") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
$cnt++;
$lot=$row_issuetbl['lotno'];
if($cropt=="")
{
	$cropt=$row_issuetbl['lotldg_crop'];
}
else
{
	if($cropt!=$row_issuetbl['lotldg_crop'])
	$crpflg++;
}
if($vert=="")
{
	$vert=$row_issuetbl['lotldg_variety'];
}
else
{
	if($vert!=$row_issuetbl['lotldg_variety'])
	$verflg++;
}
if($stage=="")
{
	$stage=$row_issuetbl['lotldg_sstage'];
}
else
{
	if($stage!=$row_issuetbl['lotldg_sstage'])
	$stageflg++;
}
$sql_crop=mysqli_query($link,"Select * from tblcrop where cropid='".$row_issuetbl['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crp=$row_crop['cropname'];
$sql_veriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$row_veriety=mysqli_fetch_array($sql_veriety);
$vv=$row_veriety['popularname'];

$tot_sub2=0;
$sql_sub2=mysqli_query($link,"select * from tbl_sloc_binw_sub where plantcode='$plantcode' and slocid='".$pid."' and lotno='".$lot."' and whid='".$row_sub['whid']."' and binid='".$row_sub['binid']."' and subbinid='".$row_sub['subbinid']."'")or die(mysqli_error($link));
$row_sub2=mysqli_fetch_array($sql_sub2);
$tot_sub2=mysqli_num_rows($sql_sub2);
if($tot_sub2>0)
{
if($srno%2!=0)
{
?> 
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="318"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="296"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_sstage'];?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" value="<?php echo $lot;?>" /></td>
</tr>
 <?php
}
else
{
?>
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="318"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="296"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_sstage'];?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" value="<?php echo $lot;?>" /></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
<input type="hidden" name="cnt" value="<?php echo $cnt;?>" /><input type="hidden" name="crpflg" value="<?php echo $crpflg;?>" /><input type="hidden" name="cropt" value="<?php echo $cropt;?>" /><input type="hidden" name="verflg" value="<?php echo $verflg;?>" /><input type="hidden" name="vert" value="<?php echo $vert;?>" /><input type="hidden" name="stageflg" value="<?php echo $stageflg;?>" /><input type="hidden" name="stage" value="<?php echo $stage;?>" />
 </table>
 <br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse"> <tr class="tblsubtitle">
    <td align="center" valign="middle" class="tblheading" colspan="6">New SLOC</td>
  </tr>
<?php
	$sql_wh2=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sub['whid']."' order by perticulars") or die(mysqli_error($link));
	$row_wh2=mysqli_fetch_array($sql_wh2);
	
	$sql_bn2=mysqli_query($link,"select binid, binname from tbl_bin  where plantcode='$plantcode' and binid='".$row_sub['binid']."'") or die(mysqli_error($link));
	$row_bn2=mysqli_fetch_array($sql_bn2);
	
	$sql_sbn2=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sub['subbinid']."' order by sname")or die("Error:".mysqli_error($link));
	$row_sbn2=mysqli_fetch_array($sql_sbn2);
?>  
<tr class="Light" height="25">
	<td width="110" align="right"  valign="middle" class="tblheading">&nbsp;WH&nbsp; </td>                                   
	<td width="163" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_wh2['perticulars'];?></td>
	<td width="67" align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
	<td width="143" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_bn2['binname'];?></td>
	<td width="73" align="right"  valign="middle" class="tblheading">Sub-Bin&nbsp;</td>
	<td width="180" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_sbn2['sname'];?></td>
</tr>
</table>
</div>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >

<tr >
<td valign="top" align="right"><a href="edit_sloc_binw_updation.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
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
