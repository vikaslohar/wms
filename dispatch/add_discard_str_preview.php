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
	
	
	if(isset($_REQUEST['tid']))
	{
	$tid = $_REQUEST['tid'];
	}
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	/*if(isset($_REQUEST['txtdrno']))
	{
	$txtdrno = $_REQUEST['txtdrno'];
	}
	if(isset($_REQUEST['txtparty']))
	{
	$txtparty = $_REQUEST['txtparty'];
	}
	if(isset($_REQUEST['txtaddress']))
	{
	$txtaddress = $_REQUEST['txtaddress'];
	}
if(isset($_GET['address1']))
	{
	$txtaddress1 = $_GET['address1'];	 
	}	
if(isset($_GET['city']))
	{
	$city = $_GET['city'];	 
	}	
if(isset($_GET['pin']))
	{
	$pin = $_GET['pin'];	 
	}	
if(isset($_GET['state']))
	{
	$state = $_GET['state'];	 
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
	if(isset($_REQUEST['txtpname']))
	{
	$txtpname = $_REQUEST['txtpname'];
	}
	if(isset($_REQUEST['txtappli']))
	{
	$txtappli = $_REQUEST['txtappli'];
	}
	if(isset($_REQUEST['rettyp']))
	{
	$rettyp = $_REQUEST['rettyp'];
	}
	if(isset($_REQUEST['remarks']))
	{
	$remarks = $_REQUEST['remarks'];
	}
	if(isset($_REQUEST['txtphone']))
	{
	$txtphone = $_REQUEST['txtphone'];
	}
		
$sql_main="update tbl_discard set  yearcode='$yearid_id', drno='$txtdrno', party_name='$txtparty', address='$txtaddress', address1='$txtaddress1', city='$city', pin='$pin', state='$state', tmode='$txt11', tname='$txttname', lrno='$txtlrn', vno='$txtvn', pmode='$txt14', cname='$txtcname', dcno='$txtdc', pname='$txtpname', rettyp='$rettyp', remarks= '$remarks', phoneno= '$txtphone' where tid = '$pid'";
$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));*/

	if(isset($_POST['frm_action'])=='submit')
	{	
	//exit;
		$pid=trim($_POST['pid']);
		$tid=trim($_POST['tid']);
		
	$sql_arr=mysqli_query($link,"select * from tbl_discard where plantcode='".$plantcode."' and  tid='".$pid."'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	$partyid=$row_arr['party_name'];
	$trdate=$row_arr['tdate'];
	
	$sql_arrsub=mysqli_query($link,"select * from tbl_discard_sub where plantcode='".$plantcode."' and  did_s='".$pid."'") or die(mysqli_error($link));
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		$classid=$row_arrsub['crop'];
		$itemid=$row_arrsub['variety'];
		
		$sql_arrsub_sub=mysqli_query($link,"select * from tbl_discard_sloc where plantcode='".$plantcode."' and  discard_trid='".$pid."' and discard_id='".$row_arrsub['did']."'") or die(mysqli_error($link));
		while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
		{
			$whid=$row_arrsub_sub['whid'];
			$binid=$row_arrsub_sub['binid'];
			$subbinid=$row_arrsub_sub['subbin'];
			$ups=$row_arrsub_sub['ups_discard'];
			$qty=$row_arrsub_sub['qty_discard'];
			$lotno=$row_arrsub['lotnumber'];
			$stage=$row_arrsub_sub['sstage'];
			
				$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$subbinid."' and lotldg_binid='".$binid."' and lotldg_whid='".$whid."' and orlot='".$lotno."' and lotldg_sstage='".$stage."'") or die(mysqli_error($link));
				$t=mysqli_num_rows($sql_issue1);
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link));
				$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['lotldg_balbags'];
				$opqty=$row_issuetbl['lotldg_balqty'];
				$balups=$opups-$ups;
				$balqty=$opqty-$qty;
				if($balqty > 0 && $balups==0) $balups=1;
				if($balqty==0 && $balups>0) $balups=0;
				
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
				$lotno1=$row_issuetbl['lotldg_lotno'];
				
				
				
				$sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment,plantcode) values('$yearid_id','Discard', '$pid', '$trdate', '$lotno1', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment','$plantcode')";
				
				//echo $sql_sub_sub="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trpartyid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty) values('$yearid_id','Discard', '$pid', '$partyid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
				mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
				if($balqty == 0)
				{

$totups=0; $totqtyd=0; $cntd=0;
				
$sql_issueg=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$subbinid."'") or die(mysqli_error($link));

while($row_issueg=mysqli_fetch_array($sql_issueg))
 { 
	$sql_issueg1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$subbinid."' and lotldg_lotno='".$row_issueg['lotldg_lotno']."'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_issueg1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link));
	$totnog=mysqli_num_rows($sql_issuetblg);
	if($totnog > 0)
	{
	  $cntd++;
	} 
}

$sql_issueg=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  subbinid='".$subbinid."'") or die(mysqli_error($link));

while($row_issueg=mysqli_fetch_array($sql_issueg))
 { 
	$sql_issueg1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  subbinid='".$subbinid."' and lotno='".$row_issueg['lotno']."'") or die(mysqli_error($link));
	$row_issueg1=mysqli_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_issueg1[0]."' and balqty > 0") or die(mysqli_error($link));
	$totnog=mysqli_num_rows($sql_issuetblg);
	if($totnog > 0)
	{
	  $cntd++;
	} 
}			
				if($cntd == 0)
				{
					$sql_itmd="update tbl_subbin set status='Empty' where  sid='$subbinid'";
					mysqli_query($link,$sql_itmd) or die(mysqli_error($link));
				}
				
			}
		}
	}
}
	
		$sql_code="SELECT MAX(dd_code) FROM tbl_discard where plantcode='".$plantcode."' and yearcode='$yearid_id'  ORDER BY dd_code DESC";
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
		
		$sql_code1="SELECT MAX(ncode) FROM tbl_discard where plantcode='".$plantcode."' and yearcode='$yearid_id' ORDER BY ncode DESC";
		$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
			{
				$row_code1=mysqli_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode=$t_code1+1;
			}
			else
			{
				$ncode=1;
			}

	$sql_main="update tbl_discard set ddflg=1, dd_code=$code, ncode='$ncode'  where tid = '$pid'";
	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));

	$s_chk=mysqli_query($link,"SELECT * FROM tbl_gate where plantcode='".$plantcode."' and  yearcode='$yearid_id'") or die (mysqli_error($link));
	$r_chk=mysqli_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code2="SELECT MAX(gid) FROM tbl_gate where plantcode='".$plantcode."' and  yearcode='$yearid_id' ORDER BY gid DESC";
	else
	$sql_code2="SELECT MAX(gid) FROM tbl_gate ORDER BY gid DESC";
	$rescode2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
		
		if(mysqli_num_rows($rescode2) > 0) 
			{
				$row_code2=mysqli_fetch_row($rescode2);
				$t_code2=$row_code2['0'];
				$gpcode=$t_code2+1;
			}	
			else 
			{
				$gpcode=1;
			}
$cod="Discard";
 	$sql_gp="insert into tbl_gate (gid, trid, trtype, gdate, yearcode,plantcode) values('$gpcode', '$pid', '$cod', '$trdate', '$yearid_id','$plantcode')";
	mysqli_query($link,$sql_gp) or die (mysqli_error($link));

//exit;
			echo "<script>window.location='select_issue_ddop.php?p_id=$pid'</script>";	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch -Transction -Material Discard</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script src="issue.js"></script>
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
<script language="JavaScript">

function openslocpopprint()
{

var pid=document.frmaddDept.pid.value;
winHandle=window.open('issue_dd_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
else if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	document.frmaddDept.submit();
	return true;	 
	}
	else
	{
	return false;
	}
}
	
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" 

bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" 

align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" 

cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction - Material Discard </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_discard where plantcode='".$plantcode."' and  tid=$pid")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; $erid=0;
	
	 $tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input name="code" type="hidden" value="<?php echo $code;?>" />
	<input name="tid" type="hidden" value="<?php echo $tid;?>" />
	<input name="pid" type="hidden" value="<?php echo $pid;?>" />
	<input name="txtdate" type="hidden" value="<?php echo $tdate;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Material Discard</td>
</tr>
  <tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
   
	  /* $sdate=$row['strdate'];
	$syear=substr($sdate,0,4);
	$smonth=substr($sdate,5,2);
	$sday=substr($sdate,8,2);
	$sdate=$sday."-".$smonth."-".$syear;
	
 $resettargetquery=mysqli_query($link,"select * from tbl_roles where id='".$row['strefno']."'");
  	$resetresult=mysqli_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysqli_num_rows($resettargetquery);*/
//$quer3=mysqli_query($link,"SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TMD".$row['tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Discard&nbsp;Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Discard &nbsp;Instruction Ref. No.&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3" >&nbsp;<?php echo $row['drno'];?></td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['party_name'];?></td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress"><div style="padding-left:3px"><?php echo $row['address']." ".$row['address1']." ".$row['city']." ".$row['pin']." ".$row['state'];?><br />Ph: <?php echo $row['phoneno'];?></div></td>
</tr>

<?php
if($row['tmode'] == "") 
{
?>
<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo "Not Applicable"; ?></td>
</tr>
<?php
}
if($row['tmode'] != "") 
{
?>
<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['tmode'];?></td>
</tr>
<?php
if($row['tmode'] == "Transport")
{
?>
<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['tname'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['lrno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['vno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row['pmode'] == "ToPay")
$pmode="To Pay";
else
$pmode=$row['pmode'];
echo $pmode;?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row['tmode'] == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['cname'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['dcno'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['pname'];?></td>
</tr>
<?php
}
}
?>
</table>
</br>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#378b8b" style="border-collapse:collapse">

			<tr class="tblsubtitle">
			  <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  <td width="12%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
			  <td width="18%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
			  <td colspan="3" align="center" valign="middle" class="tblheading">Existing</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
              <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
              </tr>
			<tr class="tblsubtitle">
			  <td width="5%" align="center" valign="middle" class="tblheading">SLOC</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
                  	<td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php
$sr=1; $itmdchk="";
$sql_eindent_sub=mysqli_query($link,"select * from tbl_discard_sub where plantcode='".$plantcode."' and did_s=$trid") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_eindent_sub['variety'].",";
	}
	else
	{
	$itmdchk=$row_eindent_sub['variety'].",";
	}
	
	$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty=""; $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; $stage="";
	
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_eindent_sub['crop']."'") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);

$tto=0;
$sql_veriety=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_eindent_sub['variety']."' and actstatus='Active'") or die(mysqli_error($link));
$tto=mysqli_num_rows($sql_veriety);
if($tto>0)
{		
	$row_variety=mysqli_fetch_array($sql_veriety);
	$itemid=$row_variety['popularname'];				
}
else
{
	$itemid=$row_eindent_sub['variety'];
}

/*if($trid > 0)
{*/
$sql_tblissue=mysqli_query($link,"select * from tbl_discard_sloc where plantcode='".$plantcode."' and  discard_trid='".$trid."' and discard_id='".$row_eindent_sub['did']."'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);



while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_tblissue['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_tblissue['subbin']."' and binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$row_tblissue['ups_discard'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";


$slqty=$row_tblissue['qty_discard'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balups=$row_tblissue['ups_balance'];
if($balups1!="")
$balups1=$balups1.$balups."<br/>";
else
$balups1=$balups."<br/>";


$balqty=$row_tblissue['qty_balance'];
if($balqty1!="")
$balqty1=$balqty1.$balqty."<br/>";
else
$balqty1=$balqty."<br/>";

$sql_stldg1=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_tblissue['discard_rowid']."'") or die(mysqli_error($link));
$row_stldg1=mysqli_fetch_array($sql_stldg1); 

$opups=$row_stldg1['lotldg_balbags'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$row_stldg1['lotldg_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['discard_id'];

if($stage!="")
$stage=$stage.$row_tblissue['sstage']."<br/>";
else
$stage=$row_tblissue['sstage']."<br/>";


}
/*}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $erid=0;
}*/
if($sr%2!=0)
{
?>		  
 <tr class="Light" height="20">
             <td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
			 <td width="12%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['cropname'];?></td>
             <td width="18%" align="center" valign="middle" class="tbltext"><?php echo $itemid;?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['lotnumber'];?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $opups1;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $opqty1;?></td>
		     <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
             <td width="7%" align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
             <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $balups1;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balqty1;?></td>
             </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />

<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
			 <td width="12%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['cropname'];?></td>
             <td width="18%" align="center" valign="middle" class="tbltext"><?php echo $itemid;?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['lotnumber'];?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $opups1;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $opqty1;?></td>
			 <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
             <td width="7%" align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
             <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $balups1;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balqty1;?></td>
             </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="84" align="right"  valign="middle" class="tblheading">&nbsp;Return status&nbsp;</td>
<td width="660" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['rettyp'];?></td>
</tr>
<tr class="Dark" height="30">
<td width="84" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="660" align="left"  valign="middle" class="tbltext"><div style="padding-left:3px"><?php echo $row['remarks'];?></div></td>
</tr>
</table>
<br />
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_material_discard.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table></td><td width="30"></td>
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
