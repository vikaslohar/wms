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
	
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
		$sdate = $_REQUEST['sdate'];
		$edate = $_REQUEST['edate'];
	
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return-Periodical Arrival vs Utilisation Report</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
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
<SCRIPT language="JavaScript">

function openprint()
{
var sdate=document.frmaddDepartment.sdate.value;
var edate=document.frmaddDepartment.edate.value;
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
winHandle=window.open('report_srutilisation2.php?&txtcrop='+itemid+'&txtvariety='+vv+'&sdate='+sdate+'&edate='+edate,'WelCome','top=20,left=80,width=900,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
  <tr><td>

   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" style="border-bottom:solid; border-bottom-color:#a8a09e" >
	    <tr >
	      <td width="813" height="25">&nbsp;Sales Return - Periodical Arrival vs Utilisation Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
<input name="frm_action" value="submit" type="hidden"> 
<input name="sdate" value="<?php echo $sdate?>" type="hidden"> 
<input name="edate" value="<?php echo $edate;?>" type="hidden">
<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
<input name="txtcrop" value="<?php echo $crop;?>" type="hidden"> 
<?php
$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
?>		
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
<?php
	$crp="ALL"; $ver="ALL";
	if($crop!="ALL")
	{	
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
?>	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="900" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Sales Return Periodical Arrival vs Utilisation Report</td>
  	</tr>
</table>
<table align="center" border="0" width="900" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Arrival Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
</table>	
<table align="center" border="0" cellspacing="0" cellpadding="0" width="900" style="border-collapse:collapse">
	<tr height="25" >
	 <td width="50%" align="left" class="subheading">&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
	 <td align="right" class="subheading">Variety: <?php echo $ver;?>&nbsp;&nbsp;</td>
  	</tr>
</table>
<?php
$crop1=$crop;
$variety1=$variety; 
$cont=0; $veriet="";

	$qry="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_trdate<='".$edt."' and lotldg_trdate>='".$sdt."' and lotldg_trtype='Sales Return' and lotldg_balqty > 0";

	if($crop!="ALL")
	{	
	$qry.=" and lotldg_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
	$qry.=" and lotldg_variety='$variety' ";
	}
	
	$qry.=" group by lotldg_crop, lotldg_variety order by lotldg_crop asc, lotldg_variety asc";
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	
	
	if($tot_arr_home>0)
	{
		while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
		{ 
			if($veriet!="")
				$veriet=$veriet.",".$row_arr_home1['lotldg_crop'];
			else
				$veriet=$row_arr_home1['lotldg_crop'];
			$cont++;
		}
	}
	
	$qry2="select Distinct lotldg_crop, lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_trdate<='".$edt."' and lotldg_trdate>='".$sdt."' and (trtype='Sales Return' OR trtype='SRRV') and balqty > 0";

	if($crop!="ALL")
	{	
	$qry2.=" and lotldg_crop='$crop' ";
	}
	if($variety!="ALL")
	{	
	$qry2.=" and lotldg_variety='$variety' ";
	}
	
	$qry2.=" group by lotldg_crop, lotldg_variety order by lotldg_crop asc, lotldg_variety asc";
	$sql_arr_home12=mysqli_query($link,$qry2) or die(mysqli_error($link));
 	$tot_arr_home2=mysqli_num_rows($sql_arr_home12);
	
	
	
	if($tot_arr_home>0)
	{
		while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
		{ 
			if($veriet!="")
				$veriet=$veriet.",".$row_arr_home12['lotldg_crop'];
			else
				$veriet=$row_arr_home12['lotldg_crop'];
			$cont++;
		}
	}
//echo $veriet;
$veriet22="";
if($veriet!="")
{
$quer33=mysqli_query($link,"SELECT * FROM tblcrop where cropid IN($veriet) order by cropname asc");
while($noticia33 = mysqli_fetch_array($quer33))
{
	if($veriet22!="")
		$veriet22=$veriet22.",".$noticia33['cropid'];
	else
		$veriet22=$noticia33['cropid'];
}
}
$variet=explode(",",$veriet22);
$variet = array_unique($variet); 
//sort($variet);


?> 
<!--<table align="center" border="0" cellspacing="0" cellpadding="0" width="900" style="border-collapse:collapse">
	<tr height="25" >
	 <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Crop:&nbsp;<?php echo $cropn;?></td>
  <td align="right" class="tblheading">Variety:&nbsp;<?php echo $varietyn;?>&nbsp;&nbsp;</td>
  	</tr>
</table> -->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="900" bordercolor="#a8a09e" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="24" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
	<td width="95" rowspan="2"  align="center" valign="middle" class="tblheading">Crop</td>
	<td width="140" rowspan="2"  align="center" valign="middle" class="tblheading">Variety</td>
	<td width="75" rowspan="2"  align="center" valign="middle" class="tblheading">Arrived Qty</td>
	<td width="60" rowspan="2" align="center" valign="middle" class="tblheading">Pro. Loss</td>
	<td width="60" rowspan="2" align="center" valign="middle" class="tblheading">Packing Loss</td>
	<td width="70" rowspan="2" align="center" valign="middle" class="tblheading">Packed Qty</td>
	<td width="70" rowspan="2"  align="center" valign="middle" class="tblheading">Discarded Qty</td>
	<td width="70" rowspan="2" align="center" valign="middle" class="tblheading">Available Qty</td>
	<td colspan="3" align="center" valign="middle" class="tblheading">QC Status (Qty in Kgs.)</td>
	</tr>
<tr class="tblsubtitle" height="20">
  <td align="center" valign="middle" class="tblheading">OK</td>
  <td align="center" valign="middle" class="tblheading">Fail</td>
  <td align="center" valign="middle" class="tblheading">UT</td>
</tr>
<?php
if($cont > 0)
{
$srno=1; $cnt=0;	
foreach($variet as $verval)
{
if($verval <> "")
{


if($variety!="ALL")
{
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_trdate<='".$edt."' and lotldg_trdate>='".$sdt."' and lotldg_crop='".$verval."' and lotldg_variety='".$variety."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' order by lotldg_id desc") or die(mysqli_error($link));
}
else
{
$sql_rr=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_trdate<='".$edt."' and lotldg_trdate>='".$sdt."' and lotldg_crop='".$verval."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' order by lotldg_id desc") or die(mysqli_error($link));
}
$tot_rr=mysqli_num_rows($sql_rr);
while($row_rr=mysqli_fetch_array($sql_rr))
{
	$trdate240=date("Y-m-d");
	$totalbags=0; $totalqty=0; $arrtotalbags=0; $arrtotalqty=0; $flg=0;		
	$sups=0; $sqty=0; $sstage=""; $sloc=""; $lotno=""; $bags=""; $qty=0; $stage=""; $got=""; $qc=""; $sstatus=""; $ups=""; 
	$qcresult=""; $slups=0; $slqty=0; $qcresultok=0; $qcresultfail=0; $qcresultut=0; $prloss=0; $pcloss=0; $pckqty=0; $dcdqty=0;
		
	$quer4=mysqli_query($link,"SELECT popularname, cropname FROM tblvariety  where varietyid='".$row_rr['lotldg_variety']."' "); 
	$noticia_item = mysqli_fetch_array($quer4);
	$varietyn=$noticia_item['popularname'];
	
	$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$verval."'");
	$noticia = mysqli_fetch_array($quer3);
	$cropn=$noticia['cropname'];
	
	
	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_trdate<='".$edt."' and lotldg_trdate>='".$sdt."' and lotldg_crop='".$verval."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' group by lotldg_lotno order by lotldg_crop asc, lotldg_variety asc") or die(mysqli_error($link));
	$xcv=mysqli_num_rows($sql_arr_home);
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{  
		$sql_issuearr=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_trdate<='".$edt."' and lotldg_trdate>='".$sdt."' and lotldg_crop='".$verval."' and lotldg_variety='".$row_rr['lotldg_variety']."' and lotldg_balqty > 0 and lotldg_trtype='Sales Return' order by lotldg_id asc") or die(mysqli_error($link));
		while($row_issuearr=mysqli_fetch_array($sql_issuearr))
		{ 
			$arrtotalqty=$arrtotalqty+$row_issuearr['lotldg_balqty']; 
			$arrtotalbags=$arrtotalbags+$row_issuearr['lotldg_balbags'];
		}
		
		$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and lotldg_balqty > 0  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		while($row_issue=mysqli_fetch_array($sql_issue))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  order by lotldg_id desc ") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
				
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='$plantcode' AND lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0  order by lotldg_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_issuetbl);
			if($t > 0)
			{	
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					$slups=$row_issuetbl['lotldg_balbags'];
					$slqty=$row_issuetbl['lotldg_balqty'];
					
					$sups=$sups+$row_issuetbl['lotldg_balbags'];
					$sqty=$sqty+$row_issuetbl['lotldg_balqty'];
					
					$qcresult=$row_issuetbl['lotldg_qc'];
					$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
					if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL" && $row_issuetbl['lotldg_got']!=" ")
					$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
					else
					$gotresult=$gorr[0]." ".$gorr[1];
					
					$stage=$row_issuetbl['lotldg_sstage'];
				
					$aq=explode(".",$slqty);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
					
					$an=explode(".",$slups);
					if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
						
					$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
					
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
					
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];
					
					$slups=$row_issuetbl['lotldg_balbags'];
					$slqty=$row_issuetbl['lotldg_balqty'];
					$aq1=explode(".",$slups);
					if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					$slups=$ac1;
					$slqty=$acn1;
					if($sloc!="")
					$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
					else
					$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
					
					$lotno=$row_arr_home['lotldg_lotno'];
					$sstage=$row_arr_home['lotldg_sstage'];
					if($got=="")
					$got=$row_arr_home['lotldg_moisture'];
					if($stage=="")
					$stage=$row_arr_home['lotldg_gemp'];
					
					if($qcresult=="")
					$qcresult=$row_arr_home['lotldg_qc'];
					
					
					$qty=$qty+$ac;
				
				
					$trdate2=$row_issuetbl['lotldg_qctestdate'];
					$trdate=$row_issuetbl['lotldg_qctestdate'];
					$tryear2=substr($trdate,0,4);
					$trmonth2=substr($trdate,5,2);
					$trday2=substr($trdate,8,2);
					$trdate=$trday2."-".$trmonth2."-".$tryear2;
					if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
				
					if($qcresult=="OK")$qcresultok=$qcresultok+$ac;
					if($qcresult=="Fail")$qcresultfail=$qcresultfail+$ac;
					if($qcresult=="UT" || $qcresult=="RT")$qcresultut=$qcresultut+$ac;
			
				}
			}
		}
		


$totalqty=$totalqty+$qty; 
$totalbags=$totalbags+$bags;
}

// Pack Seed

$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_trdate<='".$edt."' and lotldg_trdate>='".$sdt."' and lotldg_crop='".$verval."' and lotldg_variety='".$row_rr['lotldg_variety']."' and balqty > 0 and (trtype='Sales Return' OR trtype='SRRV') group by lotno order by lotldg_crop asc, lotldg_variety asc") or die(mysqli_error($link));
 	$xcv=mysqli_num_rows($sql_arr_home);
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{  
		$sql_issuearr=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and lotldg_trdate<='".$edt."' and lotldg_trdate>='".$sdt."' and lotldg_crop='".$verval."' and lotldg_variety='".$row_rr['lotldg_variety']."' and balqty > 0 and (trtype='Sales Return' OR trtype='SRRV') order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_issuearr=mysqli_fetch_array($sql_issuearr))
		{ 
			$arrtotalqty=$arrtotalqty+$row_issuearr['balqty']; 
			//$arrtotalbags=$arrtotalbags+$row_issuearr['lotldg_balbags'];
		}
		
		$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and balqty > 0  group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_issue=mysqli_fetch_array($sql_issue))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."'  order by lotdgp_id desc ") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
				
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0  order by lotdgp_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_issuetbl);
			if($t > 0)
			{	
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					//$slups=$row_issuetbl['lotldg_balbags'];
					$slqty=$row_issuetbl['balqty'];
					
					//$sups=$sups+$row_issuetbl['lotldg_balbags'];
					$sqty=$sqty+$row_issuetbl['balqty'];
					
					$qcresult=$row_issuetbl['lotldg_qc'];
					$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
					if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL" && $row_issuetbl['lotldg_got']!=" ")
					$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
					else
					$gotresult=$gorr[0]." ".$gorr[1];
					
					$stage=$row_issuetbl['trstage'];
				
					$aq=explode(".",$slqty);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
					
					$an=explode(".",$slups);
					if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
						
					$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
					
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
					
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];
					
					//$slups=$row_issuetbl['lotldg_balbags'];
					$slqty=$row_issuetbl['balqty'];
					$aq1=explode(".",$slups);
					if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					$slups=$ac1;
					$slqty=$acn1;
					if($sloc!="")
					$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
					else
					$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
					
					$lotno=$row_arr_home['lotno'];
					$sstage=$row_arr_home['trstage'];
					if($got=="")
					$got=$row_arr_home['lotldg_moisture'];
					if($stage=="")
					$stage=$row_arr_home['lotldg_gemp'];
					
					if($qcresult=="")
					$qcresult=$row_arr_home['lotldg_qc'];
					
					
					$qty=$qty+$ac;
					$pckqty=$pckqty+$ac;
				
					$trdate2=$row_issuetbl['lotldg_qctestdate'];
					$trdate=$row_issuetbl['lotldg_qctestdate'];
					$tryear2=substr($trdate,0,4);
					$trmonth2=substr($trdate,5,2);
					$trday2=substr($trdate,8,2);
					$trdate=$trday2."-".$trmonth2."-".$tryear2;
					if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
				
					if($qcresult=="OK")$qcresultok=$qcresultok+$ac;
					if($qcresult=="Fail")$qcresultfail=$qcresultfail+$ac;
					if($qcresult=="UT" || $qcresult=="RT")$qcresultut=$qcresultut+$ac;
			
				}
			}
		}
		


$totalqty=$totalqty+$qty; 
$totalbags=$totalbags+$bags;
}






if($qty > 0)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrtotalqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $prloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pcloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pckqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcdqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $qcresultok?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $qcresultfail?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $qcresultut?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrtotalqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $prloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pcloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pckqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcdqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultfail?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultut?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
<?php
/*if($variety!="ALL")
{
$sql_rr2=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$verval."' and lotldg_variety='".$variety."' and balqty > 0 and (trtype='Sales Return' OR trtype='SRRV')") or die(mysqli_error($link));
}
else
{
$sql_rr2=mysqli_query($link,"select distinct lotldg_variety from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$verval."' and balqty > 0 and (trtype='Sales Return' OR trtype='SRRV')") or die(mysqli_error($link));
}
 $tot_rr2=mysqli_num_rows($sql_rr2);
while($row_rr2=mysqli_fetch_array($sql_rr2))
{
	
	$quer4=mysqli_query($link,"SELECT popularname, cropname FROM tblvariety  where varietyid='".$row_rr2['lotldg_variety']."'"); 
	$noticia_item = mysqli_fetch_array($quer4);
	$varietyn=$noticia_item['popularname'];
	
	$quer3=mysqli_query($link,"SELECT cropname FROM tblcrop where cropid='".$verval."'");
	$noticia = mysqli_fetch_array($quer3);
	$cropn=$noticia['cropname'];
	
	
	$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotldg_crop='".$verval."' and lotldg_variety='".$row_rr2['lotldg_variety']."' and balqty > 0 and (trtype='Sales Return' OR trtype='SRRV') group by lotno order by lotldg_crop asc, lotldg_variety asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{  
		
		
			
		//$lrole=$row_arr_home['arr_role'];
		//$arrival_id=$row_arr_home['lotdgp_id'];
		
		
		$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$row_arr_home['lotno']."' and balqty > 0  group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_issue=mysqli_fetch_array($sql_issue))
		{ 
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' order by lotdgp_id asc") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
				
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0  order by lotdgp_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_issuetbl);
			if($t > 0)
			{	
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					$slups=$row_issuetbl['balnop'];
					$slqty=$row_issuetbl['balqty'];
					
					$sups=$sups+$row_issuetbl['balnop'];
					$sqty=$sqty+$row_issuetbl['balqty'];
					
					$qcresult=$row_issuetbl['lotldg_qc'];
					$gorr=explode(" ", $row_issuetbl['lotldg_got1']);
					if($row_issuetbl['lotldg_got']!="" && $row_issuetbl['lotldg_got']!="NULL" && $row_issuetbl['lotldg_got']!=" ")
					$gotresult=$gorr[0]." ".$row_issuetbl['lotldg_got'];
					else
					$gotresult=$gorr[0]." ".$gorr[1];
					
					$stage=$row_issuetbl['lotldg_sstage'];
				
				$aq=explode(".",$slqty);
				if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
				
				$an=explode(".",$slups);
				if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
					
				$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
				$row_whouse=mysqli_fetch_array($sql_whouse);
				$wareh=$row_whouse['perticulars']."/";
				
				$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
				$row_binn=mysqli_fetch_array($sql_binn);
				$binn=$row_binn['binname']."/";
				
				$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
				$row_subbinn=mysqli_fetch_array($sql_subbinn);
				$subbinn=$row_subbinn['sname'];
				
				$slups=$row_issuetbl['balnop'];
				$slqty=$row_issuetbl['balqty'];
				$aq1=explode(".",$slups);
				if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
				
				$an1=explode(".",$slqty);
				if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
				$slups=$ac1;
				$slqty=$acn1;
				if($sloc!="")
				$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
				else
				$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty."<br/>";
				
				$lotno=$row_arr_home['lotno'];
				$sstage=$row_arr_home['lotldg_sstage'];
				if($got=="")
				$got=$row_arr_home['lotldg_moisture'];
				if($stage=="")
				$stage=$row_arr_home['lotldg_gemp'];
				
				if($qcresult=="")
				$qcresult=$row_arr_home['lotldg_qc'];
				
				
				$qty=$qty+$ac;
				
				$trdate2=$row_issuetbl['lotldg_qctestdate'];
				
				$trdate=$row_issuetbl['lotldg_qctestdate'];
				$tryear=substr($trdate,0,4);
				$trmonth=substr($trdate,5,2);
				$trday=substr($trdate,8,2);
				$trdate=$trday."-".$trmonth."-".$tryear;
				if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
				
				if($qcresult=="OK")$qcresultok=$qcresultok+$ac;
				if($qcresult=="Fail")$qcresultfail=$qcresultfail+$ac;
				if($qcresult=="UT" || $qcresult=="RT")$qcresultut=$qcresultut+$ac;
			}
			}
			}


$totalqty=$totalqty+$qty; 
$totalbags=$totalbags+$bags;
}
if($qty > 0)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pckqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcdqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultfail?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultut?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyn?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pckqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dcdqty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultok?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultfail?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcresultut?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}*/

}
}
}
?>	</table>		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="center" valign="top"><a href="report_srutilisation.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td ></td>
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
