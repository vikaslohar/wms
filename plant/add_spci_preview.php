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
	
	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}

	if(isset($_POST['frm_action'])=='submit')
	{	
		//exit;
		$pid=trim($_POST['pid']);
			
		$sql_arr=mysqli_query($link,"select * from tbl_ci where ci_id='".$pid."' AND plantcode='$plantcode'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$crop=$row_arr['ci_crop'];
			$variety=$row_arr['ci_variety'];
			
			$arrival_date=$row_arr['ci_date'];
			$trdate=$row_arr['ci_date'];
			
			$sql_arrsub=mysqli_query($link,"select * from tbl_cisub where ci_id='".$pid."' AND plantcode='$plantcode'") or die(mysqli_error($link));
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$norlot=$row_arrsub['cisub_newlotno'];
				$noldlot=$row_arrsub['cisub_lotno'];
				$lotstage=$row_arrsub['cisub_stage'];
				$eqty=$row_arrsub['cisub_eqty'];
				$nqty=$row_arrsub['cisub_qty'];
				$newlotno=$row_arrsub['cisub_newlotno']."C";
				$lotno=$row_arrsub['cisub_newlotno']."C";
				if($eqty>0)
				{
					$sql_arrsub_sub=mysqli_query($link,"select * from tbl_cisub_sub where ci_id='".$pid."' and cisub_id='".$row_arrsub['cisub_id']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
					while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
					{
					
						$nob=$row_arrsub_sub['ciss_nob'];
						$qty=$row_arrsub_sub['ciss_qty'];
						$whid=$row_arrsub_sub['ciss_whid'];
						$binid=$row_arrsub_sub['ciss_binid'];
						$sbinid=$row_arrsub_sub['ciss_subbinid'];
					
						$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$sbinid."' and lotldg_binid='".$binid."' and lotldg_whid='".$whid."' and lotldg_variety='".$variety."' and lotldg_sstage='".$lotstage."' and lotldg_lotno='".$lotno."' AND plantcode='$plantcode'") or die(mysqli_error($link));
						$row_issue1=mysqli_fetch_array($sql_issue1); 
							
						$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 AND plantcode='$plantcode'") or die(mysqli_error($link)); 
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							$whid=$row_issuetbl['lotldg_whid'];
							$binid=$row_issuetbl['lotldg_binid'];
							$subbinid=$row_issuetbl['lotldg_subbinid'];
							$opups=$row_issuetbl['lotldg_balbags'];
							$opqty=$row_issuetbl['lotldg_balqty'];
							$balups=$opups+$nob;
							$balqty=$opqty+$qty;
												
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
							$srtyp=$row_issuetbl['lotldg_srtyp'];
							$srflg=$row_issuetbl['lotldg_srflg'];
							$genpurty=$row_issuetbl['lotldg_genpurity'];
							$mgrflg=$row_issuetbl['lotldg_mergerflg'];
							$unlstflg=$row_issuetbl['lotldg_unlistflg'];
							
							
							
							$sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_mergerflg, lotldg_unlistflg, plantcode) values('$yearid_id','SPCI', '$pid', '$trdate', '$lotno1', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nob', '$qty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$srtyp', '$srflg', '$genpurty', '$mgrflg', '$unlstflg', '$plantcode')";
							mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
						
						}
					}
				}
				else
				{
					$sql_arrsub_sub=mysqli_query($link,"select * from tbl_cisub_sub where ci_id='".$pid."' and cisub_id='".$row_arrsub['cisub_id']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
					while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
					{
						$nob=$row_arrsub_sub['ciss_nob'];
						$qty=$row_arrsub_sub['ciss_qty'];
						$whid=$row_arrsub_sub['ciss_whid'];
						$binid=$row_arrsub_sub['ciss_binid'];
						$subbinid=$row_arrsub_sub['ciss_subbinid'];
						$opups=0;
						$opqty=0;
						$balups=$nob;
						$balqty=$qty;
							
						$sstage=$lotstage;
						$sstatus="";
						$moist="";
						$gemp="";
						$vchk="Acceptable";
						$got1="GOT-NR OK";
						$qc="UT";
							
						$gotstatus="OK";
						$qctestdate="";
						$gottestdate=$trdate;
						$orlot=$norlot;
						$gs=1;
						$resverstatus="";
						$revcomment="";
						$srtyp="";
						$srflg=0;
						$genpurty="";
						$mgrflg=0;
						$unlstflg=0;
						$lotno1=$newlotno;
							
						$sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment, lotldg_srtyp, lotldg_srflg, lotldg_genpurity, lotldg_mergerflg, lotldg_unlistflg, plantcode) values('$yearid_id','SPCI', '$pid', '$trdate', '$lotno1', '$crop', '$variety', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nob', '$qty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment', '$srtyp', '$srflg', '$genpurty', '$mgrflg', '$unlstflg', '$plantcode')";
						mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));	
							
						$sql_itm="update tbl_subbin set status='$sstage' where sid='$subbinid'";
						mysqli_query($link,$sql_itm) or die(mysqli_error($link));
					}
					
					$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where yearid='".$yearid_id."' AND plantcode='$plantcode' ORDER BY tid DESC";
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
					
					$got="GOT-NR OK"; $qc="UT"; $got1="OK"; $vchk="Acceptable";
					$state="P/M/G";	
										
					$sql_sub_sub1244="insert into tbl_qctest(pp, moist, got, lotno, srdate, crop, variety, sampleno, trstage, qc, state, gs, oldlot, yearid, gotdate, gotstatus, logid, plantcode) values ('$vchk', '$moist', '$got1', '$newlotno', '$trdate', '$crop', '$variety', '$ncode1', '$lotstage', '$qc', '$state',1 ,'$norlot', '$yearid_id', '$trdate', '$got1', '$logid', '$plantcode')";
					mysqli_query($link,$sql_sub_sub1244) or die(mysqli_error($link));
				}	
			}	
			
			$sql_code="SELECT MAX(ci_code) FROM tbl_ci where ci_yearcode='$yearid_id' AND plantcode='$plantcode' ORDER BY ci_code DESC";
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
				
			$sql_main="update tbl_ci set ci_tflg=1, ci_code=$code where ci_id='$pid'";
			$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		}
		//exit;
		echo "<script>window.location='select_spci_op.php?p_id=$pid'</script>";	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Transction - SP Cycle Inventory - Preview</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
winHandle=window.open('spci_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" 

cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction - SP Cycle Inventory - Preview</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$tid=$pid;
	$trid=$pid;
	$sql1=mysqli_query($link,"select * from tbl_ci where ci_id='$tid' AND plantcode='$plantcode'")or die(mysqli_error($link));
	$row=mysqli_fetch_array($sql1);
	
	$tdate=$row['ci_date'];
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
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">SP Cycle Inventory</td>
</tr>
 

<tr class="Dark" height="25">
           <td width="200" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
            <td width="415"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TCI".$row['ci_tcode']."/".$row['ci_yearcode']."/".$row['ci_logid'];?></td>
		   
		   <td width="64" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="161" align="left"  valign="middle">&nbsp;<?php echo $tdate;?></td>
		   </tr>
<?php 
$classqry=mysqli_query($link,"select * from tblcrop where cropid='".$row['ci_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Light" height="25">
   <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td width="268" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $noticia_class['cropid'];?>" />&nbsp;<font color="#FF0000">*</font></td>

<?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ci_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item = mysqli_fetch_array($itemqry);
?>            
         
<td width="102" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="317" align="left" valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" class="tbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" /></td>
</tr><input type="hidden" name="itmdchk" value="" />

<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<!-- <tr class="Light" height="25">
            <td width="153" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
   
	<option value="<?php echo $a;?>" selected ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00"  onchange="slocshow2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  <td align="left"valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After entry of lot no. click on 'Get Details')<input type="hidden" name="getdet" value="0" /><input type="hidden" name="txtlot1" value="" /></td>	 
         </tr>-->	
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">SP Cycle Inventory Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Old Lot No.</td>
	<td width="143" align="center" class="smalltblheading">New Lot No.</td>
	<td width="88" align="center" class="smalltblheading">Stage</td>
	<td width="73" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="73" align="center" class="smalltblheading">Edit</td>
	<td width="72" align="center" class="smalltblheading">Delete</td>-->
</tr>
<?php
$sr=1;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_cisub where ci_id='$tid' AND plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

$stage=$row_eindent_sub['cisub_stage'];
$lotn=$row_eindent_sub['cisub_newlotno'];
$olotn=$row_eindent_sub['cisub_lotno'];
	
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_eindent_sub['cisub_crop']."'") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
$classid=$noticia_class['cropname'];

$tto=0;
$sql_veriety=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_eindent_sub['cisub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$tto=mysqli_num_rows($sql_veriety);
if($tto>0)
{		
	$row_variety=mysqli_fetch_array($sql_veriety);
	$itemid=$row_variety['popularname'];				
}
else
{
	$itemid=$row_eindent_sub['cisub_variety'];
}
$slups=0; $slqty=0; 
$sql_tblissue=mysqli_query($link,"select * from tbl_cisub_sub where ci_id='".$trid."' and cisub_id='".$row_eindent_sub['cisub_id']."' AND plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{
$slups=$slups+$row_tblissue['ciss_nob'];
$slqty=$slqty+$row_tblissue['ciss_qty'];
}

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $classid;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $itemid;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $stage;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<!--<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['cisub_id'];?>,<?php echo $row_eindent_sub['ci_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ci_id'];?>,<?php echo $row_eindent_sub['cisub_id'];?>);" /></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $classid;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $itemid;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $stage;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<!--<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['cisub_id'];?>,<?php echo $row_eindent_sub['ci_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ci_id'];?>,<?php echo $row_eindent_sub['cisub_id'];?>);" /></td>-->
</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_cycleinventory.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
