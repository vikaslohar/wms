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
		$slchk = $_REQUEST['slchk'];
		$slchk2 = $_REQUEST['slchk2'];
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
<title>Plant Manager-Report - Periodical Crop Variety wise Classified Stock Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
var slchk=document.frmaddDepartment.slchk.value; 
var slchk2=document.frmaddDepartment.slchk2.value; 
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var sdate=document.frmaddDepartment.sdate.value;
var edate=document.frmaddDepartment.edate.value;
winHandle=window.open('report_stockladgerbob2.php?slchk='+slchk+'&slchk2='+slchk2+'&txtcrop='+itemid+'&txtvariety='+vv+'&sdate='+sdate+'&edate='+edate,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <?php
	$sd=explode("-",$sdate);
	$stdate=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$ed=explode("-",$edate);
	$etdate=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
	
	
	$dt2=date('Y-m-d',mktime(0,0,0,$sd[1],($sd[0]-1),$sd[2]));
	
	
	
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and plantcode='$plantcode'";
	$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and plantcode='$plantcode'";
	$qry3="select Distinct salesrs_crop from tbl_salesrv_sub where salesrs_rettype='P2P' and plantcode='$plantcode'";
	if($crop!="ALL")
	{	
		$qry.=" and lotldg_crop='$crop' ";
		$qry2.=" and lotldg_crop='$crop' ";
		$qry3.=" and salesrs_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' AND actstatus='Active' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_crop";
	$qry2.=" group by lotldg_crop";
	$qry3.=" group by salesrs_crop";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home3=mysqli_query($link,$qry3) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);

	$croparr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
	{
		$sql_crop2=mysqli_query($link,"select cropname from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
	{
		$sql_crop2=mysqli_query($link,"select cropname from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home3))
	{
		$sql_crop2=mysqli_query($link,"select cropname from tblcrop where cropid='".$row_arr_home23['salesrs_crop']."' order by cropname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($croparr!="")
		$croparr=$croparr.",".$row312['cropname'];
		else
		$croparr=$row312['cropname'];
	}
	$crop2="";
	$cp=explode(",",$croparr);
	$cp=array_unique($cp);
	sort($cp);
	//print_r($cp);
	for($i=0; $i<count($cp); $i++)
	{
		if($cp[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select cropid from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($crop2!="")
			$crop2=$crop2.",".$row312['cropid'];
			else
			$crop2=$row312['cropid'];
		}
	}
	
	//exit;
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">Periodical Crop Variety wise Classified Stock Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="slchk" value="<?php echo $slchk;?>" type="hidden">  
		<input name="slchk2" value="<?php echo $slchk2;?>" type="hidden"> 
		<input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
		<input name="edate" value="<?php echo $edate;?>" type="hidden">    
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
  


<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="light" height="20">
  <td width="50%" align="left" class="tblheading">&nbsp;&nbsp;Period&nbsp;&nbsp;From:&nbsp;<?php echo $sdate?></td>
  <td align="right" class="tblheading">To:&nbsp;<?php echo $edate?>&nbsp;&nbsp;</td>
</tr>
<tr height="25" >
	<td align="left" class="tblheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
	<td align="right" class="tblheading" style="color:#303918;">Veriety: <?php echo $ver;?>&nbsp;&nbsp;</td>
</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#2e81c1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
	<td width="85" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="94" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="30" rowspan="2" align="center" valign="middle" class="tblheading">Type</td>
	<td width="55" rowspan="2" align="center" valign="middle" class="tblheading">Opening Stock</td>
	<td colspan="7" align="center" valign="middle" class="tblheading">Inward Qty</td>
	<td colspan="8" align="center" valign="middle" class="tblheading">Outward Qty</td>
	<td width="55" rowspan="2" align="center" valign="middle" class="tblheading">Closing Stock</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="55" align="center" valign="middle" class="tblheading">Fresh FRN</td>
  <td width="55" align="center" valign="middle" class="tblheading">Sales Return</td>
  <td width="55" align="center" valign="middle" class="tblheading">Stock Transfer (Plant)</td>
  <td width="55" align="center" valign="middle" class="tblheading">Stock Transfer (C&amp;F)</td>
  <td width="55" align="center" valign="middle" class="tblheading">IVT In</td>
  <td width="55" align="center" valign="middle" class="tblheading">CI</td>
  <td width="55" align="center" valign="middle" class="tblheading">Total Qty</td>
  <td width="55" align="center" valign="middle" class="tblheading">Sales</td>
  <td width="55" align="center" valign="middle" class="tblheading">Purchase Return</td>
  <td width="55" align="center" valign="middle" class="tblheading">Stock Transfer (Plant)</td>
  <td width="55" align="center" valign="middle" class="tblheading">Stock Transfer (C&amp;F)</td>
  <td width="55" align="center" valign="middle" class="tblheading">TDF</td>
  <td width="55" align="center" valign="middle" class="tblheading">IVT Out</td>
  <td width="55" align="center" valign="middle" class="tblheading">Loss</td>
  <td width="55" align="center" valign="middle" class="tblheading">Total Qty</td>
</tr>
<?php
$srno=1; 
//if($tot_arr_home > 0)
{
$crps=explode(",",$crop2);
//print_r($crps);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	$stage="Raw";
	$stage1="Condition";
	$stage2="Pack";
	
	$sql_crop=mysqli_query($link,"select cropname from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	


	$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_crop='".$crval."' and plantcode='$plantcode'";
	$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and plantcode='$plantcode'";
	$qry3="select Distinct salesrs_variety from tbl_salesrv_sub where salesrs_crop='".$crval."' and plantcode='$plantcode'";
	if($variety!="ALL")
	{	
		$qry.=" and lotldg_variety='$variety' ";
		$qry2.=" and lotldg_variety='$variety' ";
		$qry3.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' AND actstatus='Active' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by lotldg_variety";
	$qry2.=" group by lotldg_variety";
	$qry3.=" group by salesrs_variety";

	$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
	$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
	$sql_arr_home23=mysqli_query($link,$qry3) or die(mysqli_error($link));

	$verarr="";
	while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
	{
		$sql_crop2=mysqli_query($link,"select popularname from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."'  AND actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
	{
		$sql_crop2=mysqli_query($link,"select popularname from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."' AND actstatus='Active'  order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	while($row_arr_home23=mysqli_fetch_array($sql_arr_home23))
	{
		$sql_crop2=mysqli_query($link,"select popularname from tblvariety where varietyid='".$row_arr_home23['salesrs_variety']."'  AND actstatus='Active' order by popularname asc") or die(mysqli_error($link));
		$row312=mysqli_fetch_array($sql_crop2);
		if($verarr!="")
		$verarr=$verarr.",".$row312['popularname'];
		else
		$verarr=$row312['popularname'];
	}
	
	$ver2="";
	$cp2=explode(",",$verarr);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select varietyid from tblvariety where popularname='".$cp2[$i]."'  AND actstatus='Active' order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($ver2!="")
			$ver2=$ver2.",".$row312['varietyid'];
			else
			$ver2=$row312['varietyid'];
		}
	}
	//echo $variety;
	$cvcod=$crop1."-Coded";
	if($variety=="ALL" || $variety==$cvcod)
	$ver2=$ver2.",".$cvcod;
	
	$verps=explode(",",$ver2);
	$verps=array_unique($verps);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
		
		$totfrn=0; $totsrn=0; $totstp=0; $totstcnf=0; $totinw=0; $totdisp=0; $totpret=0; $totstpo=0; $totstcnfo=0; $totloss=0; $tottdf=0; $tototw=0; $totopqty=0; $ccnt=0; $totclqty=0; $totivtin=0; $totivtout=0;
		$vtyp=""; $cirec=0;
		$sql_var=mysqli_query($link,"select popularname, vt from tblvariety where varietyid='".$verval."' AND actstatus='Active' ") or die(mysqli_error($link));
		$vtot=mysqli_num_rows($sql_var);
		if($vtot>0)
		{
			$row_var=mysqli_fetch_array($sql_var);
			$verty=$row_var['popularname'];
			$vtyp=$row_var['vt'];
			if($vtyp=="Hybrid")$vtyp="HY";
		}
		else
		{
			$verty=$verval;
			$vtyp="";
		}
		$or=0; $oc=0; $opk=0; $osr=0; $ofs=0; $xc=0; $xv=0; $xst=0; $xd=0; $xz=0; $xp=0; $xf=0; $pr=0; $prl=0; $pkl=0; $ccl=0; $rvl=0; $drl=0; $cil=0; $cr=0; $cc=0; $cpk=0; $csr=0; $isr=0; $tdfl=0; $cfs=0;
		// Opening stock Records  -----------------------------------------
		
		//echo "Raw Opening Records <br/>";
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate<='$dt2' and lotldg_sstage='Raw' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_trdate<='$dt2' and lotldg_sstage='Raw' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_trdate<='$dt2' and lotldg_sstage='Raw' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select lotldg_balqty, lotldg_qc, lotldg_got, lotldg_lotno from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_sstage='Raw' and lotldg_trdate<='$dt2' and lotldg_balqty>0 and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						//echo $row_issuetbl['lotldg_lotno']." - ".$qt."<br/>";
						$totopqty=$totopqty+$qt;
						if($row_issuetbl['lotldg_qc']=="Fail" || $row_issuetbl['lotldg_got']=="Fail")
						{$ofs=$ofs+$qt;}
						else
						{$or=$or+$qt;}
						$ccnt++;
					}	
				}
			}
			//if($totopqty < 0)$totopqty=0;
		}
		
		//echo "Condition Opening Records <br/>";
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate<='$dt2' and lotldg_sstage='Condition' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_trdate<='$dt2' and lotldg_sstage='Condition' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_trdate<='$dt2' and lotldg_sstage='Condition' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select lotldg_balqty, lotldg_qc, lotldg_got, lotldg_lotno from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$dt2' and lotldg_balqty>0 and lotldg_sstage='Condition' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
						if($qt<0)$qt=0;
						//echo $row_issuetbl['lotldg_lotno']." - ".$qt."<br/>";
						$totopqty=$totopqty+$qt;
						if($row_issuetbl['lotldg_qc']=="Fail" || $row_issuetbl['lotldg_got']=="Fail")
						{$ofs=$ofs+$qt;}
						else
						{$oc=$oc+$qt;}
						$ccnt++;
					}	
				}
			}
			//if($totopqty < 0)$totopqty=0;
		}
		
		// Pack Seed opening Records
		$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate<='$dt2' and plantcode='$plantcode' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and lotldg_trdate<='$dt2' and plantcode='$plantcode' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and lotldg_trdate<='$dt2' and plantcode='$plantcode' order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select balqty, lotldg_qc, lotldg_got, lotno from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and lotldg_trdate<='$dt2' and balqty>0 and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty']; 
						if($qt<0)$qt=0;
					//	echo $row_issuetbl['lotno']." - ".$qt."<br/>";
						$totopqty=$totopqty+$qt; 
						if($row_issuetbl['lotldg_qc']=="Fail" || $row_issuetbl['lotldg_got']=="Fail")
						{$ofs=$ofs+$qt;}
						else
						{$opk=$opk+$qt;}
						$ccnt++;
					}	
				}
			}
			//if($totopqty < 0)$totopqty=0;
		}
		$soplots="";$soplots2="";
		// Sales Return opening Records
		$sql_arhome=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and salesrs_dovfy<='$dt2' and plantcode='$plantcode' order by 'salesrs_id' asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$s_srm=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_date<='$dt2' and salesr_id='".$row_arhome['salesr_id']."' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
					$t_srm=mysqli_num_rows($s_srm);
					if($t_srm > 0)
					{
						$qt=$row_issuetbl['salesrss_qty']; 
						if($qt<0)$qt=0;
						if($qt>0)
						{
							$tot_p2c=0; $tot_srrv=0;
							$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' and srrv_date<='$dt2' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_srrv=mysqli_num_rows($sq_srrv);
							
							$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' and unp_date<='$dt2' and plantcode='$plantcode'") or die(mysqli_error($link));
							$tot_p2c=mysqli_num_rows($sq_p2c);
							
							if($tot_p2c>0){}
							else if($tot_srrv > 0){}
							else
							{
								//echo $row_arhome['salesrs_newlot']." - ".$qt." - ".$row_arhome['salesrs_dovfy']."  =>  ".$row_arhome['salesrs_id']."<br/>";
								$totopqty=$totopqty+$qt;
								$osr=$osr+$qt;
								$ccnt++;
								if($soplots!="")
								$soplots=$soplots.",".$row_arhome['salesrs_newlot'];
								else
								$soplots=$row_arhome['salesrs_newlot'];
								
								if($soplots2!="")
								$soplots2=$soplots2.",".$row_arhome['salesrs_orlot'];
								else
								$soplots2=$row_arhome['salesrs_orlot'];
							}
						}
					}
				}	
			}
			//if($totopqty < 0)$totopqty=0;
		}
		
		//echo "<br/>";echo "<br />";
		//echo "Inward stock Records <br/>";
		// Opening Records Block end------------------------------------------
		
		
		// Inward Records Block ---------------------------------------------
		
		$srvoplot="";
		if($soplots!="")
		$srvoplot=explode(",",$soplots);
		//print_r($srvoplot);
		$srvoplot2="";
		if($soplots2!="")
		$srvoplot2=explode(",",$soplots2);
		//print_r($srvoplot);
		
		// Inward - Fresh FRN 
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and (lotldg_trtype='Opening Stock' || lotldg_trtype='Fresh Seed with PDN' || lotldg_trtype='Trading' || lotldg_trtype='Maize Dry Arrival') and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['lotldg_trqty']; 
				//echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
				if($qt<0)$qt=0;
				$totfrn=$totfrn+$qt;
				$totinw=$totinw+$qt;
				$ccnt++;
			}	
		}
		
		
		// Inward - Stock Transfer Plant 
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and lotldg_trtype='StockTransfer Arrival' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['lotldg_trqty']; 
			//	echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
				if($qt<0)$qt=0;
				$totstp=$totstp+$qt;
				$totinw=$totinw+$qt;
				$ccnt++;
			}	
		}
		
		// Inward - Stock Transfer Plant Pack Seed
		$sql_arhome=mysqli_query($link,"select tqty from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and trtype='Stock Transfer Arrival - Pack' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['tqty']; 
			//	echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
				if($qt<0)$qt=0;
				$totstp=$totstp+$qt;
				$totinw=$totinw+$qt;
				$ccnt++;
			}	
		}
		
		// Inward - Sales Return ----------------
		$sql_arhome=mysqli_query($link,"Select lotldg_trid, lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate'  and lotldg_trtype='Sales Return' and plantcode='$plantcode'") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$s_srm=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_id='".$row_arhome['lotldg_trid']."' and salesr_partytype!='C&F' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
			$t_srm=mysqli_num_rows($s_srm);
			if($t_srm > 0)
			{		
				while($r=mysqli_fetch_array($s_srm))
				{  
					$qt=$row_arhome['lotldg_trqty']; 
					if($qt<0)$qt=0;
					if($qt>0)
					{
					//	echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
						$totsrn=$totsrn+$qt;
						$totinw=$totinw+$qt;
						$isr=$isr+$qt;
						$ccnt++;
					}
				}
			}
			
			$s_srm2=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_id='".$row_arhome['lotldg_trid']."' and salesr_partytype='C&F' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
			$t_srm2=mysqli_num_rows($s_srm2);
			if($t_srm2 > 0)
			{		
				while($r=mysqli_fetch_array($s_srm2))
				{
					$qt=$row_arhome['lotldg_trqty']; 
					if($qt<0)$qt=0;
					if($qt>0)
					{
					//	echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
						$totstcnf=$totstcnf+$qt;
						$totinw=$totinw+$qt;
						$isr=$isr+$qt;
						$ccnt++;
					}
				}
			}
		}
		
		$sql_arhome=mysqli_query($link,"Select orlot, lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate'  and lotldg_trtype='SRP2C' and plantcode='$plantcode'") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  //echo "select * from tbl_salesrv_sub where salesrs_orlot='".$row_arhome['orlot']."'  order by salesrs_id asc";
			$sql_arhome2=mysqli_query($link,"select * from tbl_salesrv_sub where salesrs_orlot='".$row_arhome['orlot']."'  and plantcode='$plantcode' order by salesrs_id asc") or die(mysqli_error($link));
			while($row_arhome2=mysqli_fetch_array($sql_arhome2))
			{  
				$s_srm=mysqli_query($link,"select * from tbl_salesrv where salesr_id='".$row_arhome2['salesr_id']."' and salesr_partytype!='C&F' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
				$t_srm=mysqli_num_rows($s_srm);
				if($t_srm > 0)
				{		
					while($r=mysqli_fetch_array($s_srm))
					{  
						$qt=$row_arhome['lotldg_trqty']; //echo $row_arhome2['salesrs_newlot']." - ".$qt."  -  ".$fl." - ".$row_arhome2['srrv_date']."<br/>";
						if($qt<0)$qt=0;
						if($qt>0)
						{
							$f1=0;
							if($srvoplot2!="")
							{
								if(in_array($row_arhome2['salesrs_orlot'],$srvoplot2))$f1=1;
							}
							
							if($f1==0)
							{
							//	echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
								$totsrn=$totsrn+$qt;
								$totinw=$totinw+$qt;
								$isr=$isr+$qt;
								$ccnt++;
							}
						}
					}
				}
				
				$s_srm2=mysqli_query($link,"select * from tbl_salesrv where salesr_id='".$row_arhome2['salesr_id']."' and salesr_partytype='C&F' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
				$t_srm2=mysqli_num_rows($s_srm2);
				if($t_srm2 > 0)
				{		
					while($r=mysqli_fetch_array($s_srm2))
					{
						$qt=$row_arhome['lotldg_trqty']; //echo $row_arhome2['salesrs_newlot']." - ".$qt."  -  ".$fl." - ".$row_arhome2['srrv_date']."<br/>";
						if($qt<0)$qt=0;
						if($qt>0)
						{
							$f1=0;
							if($srvoplot2!="")
							{
								if(in_array($row_arhome2['salesrs_orlot'],$srvoplot2))$f1=1;
							}
							//echo $row_arhome2['salesrs_newlot']." - ".$qt."  =  ".$f1." = ".$row_arhome2['srrv_date']."<br/>";
							if($f1==0)
							{
							//	echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
								$totstcnf=$totstcnf+$qt;
								$totinw=$totinw+$qt;
								$isr=$isr+$qt;
								$ccnt++;
							}
						}
					}
				}
			}
		}	
		//echo "<br />";echo "<br />";
		
		
		$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_date>='$stdate' and srrv_date<='$etdate' and srrv_variety='$verval' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_srrv=mysqli_num_rows($sq_srrv);
		while($row_srrv=mysqli_fetch_array($sq_srrv))
		{ 
			$sql_arhome=mysqli_query($link,"select salesrs_id, salesr_id from tbl_salesrv_sub where salesrs_newlot='".$row_srrv['srrv_lotno']."' and salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and plantcode='$plantcode' order by salesrs_id asc") or die(mysqli_error($link));
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$s_srm=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_id='".$row_arhome['salesr_id']."' and salesr_partytype!='C&F' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
						$t_srm=mysqli_num_rows($s_srm);
						if($t_srm > 0)
						{
							while($r=mysqli_fetch_array($s_srm))
							{
								$qt=$row_issuetbl['salesrss_qty']; 
								if($qt<0)$qt=0;
								if($qt>0)
								{
									$fl=0;
									if($srvoplot!="")
									{
										if(in_array($row_srrv['srrv_lotno'],$srvoplot))$fl=1;
									}
									
									if($fl==0)
									{//echo $row_srrv['srrv_lotno']." SR-RV ".$qt."  -  ".$fl." - ".$row_srrv['srrv_date']."<br/>";
										$totsrn=$totsrn+$qt;
										$totinw=$totinw+$qt;
										$ccnt++;
									}	
								}
							}
						}
						$s_srm2=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_id='".$row_arhome['salesr_id']."' and salesr_partytype='C&F' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
						$t_srm2=mysqli_num_rows($s_srm2);
						if($t_srm2 > 0)
						{
							while($r2=mysqli_fetch_array($s_srm2))
							{
								$qt=$row_issuetbl['salesrss_qty']; 
								if($qt<0)$qt=0;
								if($qt>0)
								{
									$fl=0;
									if($srvoplot!="")
									{
										if(in_array($row_srrv['srrv_lotno'],$srvoplot))$fl=1;
									}
									
									if($fl==0)
									{//echo $row_srrv['srrv_lotno']." SR-RV ".$qt."  -  ".$fl." - ".$row_srrv['srrv_date']."<br/>";
										$totstcnf=$totstcnf+$qt;
										$totinw=$totinw+$qt;
										$ccnt++;
									}	
								}
							}
						}
					}
				}		
			}
		}
		
		//echo "<br />";echo "<br />";
		$sql_arhome=mysqli_query($link,"select salesrs_id, salesr_id, salesrs_newlot from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and salesrs_dovfy>='$stdate'  and salesrs_dovfy<='$etdate' and plantcode='$plantcode' order by salesrs_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$s_srm=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_id='".$row_arhome['salesr_id']."' and salesr_partytype!='C&F' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
					$t_srm=mysqli_num_rows($s_srm);
					if($t_srm > 0)
					{
						while($r=mysqli_fetch_array($s_srm))
						{
							$qt=$row_issuetbl['salesrss_qty']; 
							if($qt<0)$qt=0;
							if($qt>0)
							{
								$tot_p2c=0; $tot_srrv=0;
								$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' and srrv_date>='$stdate'  and srrv_date<='$etdate' and plantcode='$plantcode' ") or die(mysqli_error($link));
								$tot_srrv=mysqli_num_rows($sq_srrv);
								
								$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' and unp_date>='$stdate'  and unp_date<='$etdate' and plantcode='$plantcode' ") or die(mysqli_error($link));
								$tot_p2c=mysqli_num_rows($sq_p2c);
								
								if($tot_p2c>0){}
								else if($tot_srrv > 0){}
								else
								{
								//	echo $row_arhome['salesrs_newlot']." - ".$qt."<br/>";
									$totsrn=$totsrn+$qt;
									$totinw=$totinw+$qt;
									$isr=$isr+$qt;
									$ccnt++;
								}
							}
						}
					}
					
					$s_srm2=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_id='".$row_arhome['salesr_id']."' and salesr_partytype='C&F' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
					$t_srm2=mysqli_num_rows($s_srm2);
					if($t_srm2 > 0)
					{
						while($r2=mysqli_fetch_array($s_srm2))
						{
							$qt=$row_issuetbl['salesrss_qty']; 
							if($qt<0)$qt=0;
							if($qt>0)
							{
								$tot_p2c=0; $tot_srrv=0;
								$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' and srrv_date>='$stdate'  and srrv_date<='$etdate' and plantcode='$plantcode' ") or die(mysqli_error($link));
								$tot_srrv=mysqli_num_rows($sq_srrv);
								
								$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' and unp_date>='$stdate'  and unp_date<='$etdate' and plantcode='$plantcode' ") or die(mysqli_error($link));
								$tot_p2c=mysqli_num_rows($sq_p2c);
								
								if($tot_p2c>0){}
								else if($tot_srrv > 0){}
								else
								{
								//	echo $row_arhome['salesrs_newlot']." - ".$qt."<br/>";
									$totstcnf=$totstcnf+$qt;
									$totinw=$totinw+$qt;
									$isr=$isr+$qt;
									$ccnt++;
								}
							}
						}
					}
					
				}	
			}
			//if($totsrn < 0)$totsrn=0;
		}
		
		// Inward - IVT In ----------------
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and lotldg_trtype='IVTC' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['lotldg_trqty']; 
				//echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
				if($qt<0)$qt=0;
				$totivtin=$totivtin+$qt;
				$totinw=$totinw+$qt;
				$ccnt++;
			}	
		}
		
		
		//--------------------------------
		
//		echo "<br />";echo "<br />";
		// Total with Opening Stock
		$totinw=$totinw+$totopqty;
	//	echo "Outword stock Records <br/>";
		// Inward Records Block end ---------------------------------------------
		
		
		// Outward Records Block  ---------------------------------------------
		
		//Outward - Sales - Dispatch
		
		//echo "select * from tbl_dispsub_sub where dpss_crop='".$crval."' and dpss_variety='".$verval."' order by disp_id asc";
		$sql_is=mysqli_query($link,"select disp_id, dpss_qty from tbl_dispsub_sub where dpss_crop='".$crval."' and dpss_variety='".$verval."' and plantcode='$plantcode' order by disp_id asc") or die(mysqli_error($link));
		$tdfgh=mysqli_num_rows($sql_is);
		while($row_is=mysqli_fetch_array($sql_is))
		{ //echo $row_is['dpss_id']."  =  ";
			$sql_istbl=mysqli_query($link,"select disp_id from tbl_disp where disp_id='".$row_is['disp_id']."' and disp_dodc>='$stdate' and disp_dodc<='$etdate' and disp_partytype NOT IN ('C&F','Branch') and disp_tflg=1 and plantcode='$plantcode' order by disp_id desc ") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($r=mysqli_fetch_array($sql_istbl))
				{
					$qt=$row_is['dpss_qty']; 
					if($qt<0)$qt=0;
//					echo $row_is['dpss_lotno']." Disp ".$qt."<br/>";
					$totdisp=$totdisp+$qt;
					$tototw=$tototw+$qt;
					$xc=$xc+$qt;
					$ccnt++;
				}
			}
			
			$sql_istbl=mysqli_query($link,"select disp_id from tbl_disp where disp_id='".$row_is['disp_id']."' and disp_dodc>='$stdate' and disp_dodc<='$etdate' and disp_partytype IN ('C&F','Branch') and disp_tflg=1 and plantcode='$plantcode' order by disp_id desc ") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($r=mysqli_fetch_array($sql_istbl))
				{
					
					$qt=$row_is['dpss_qty']; 
					if($qt<0)$qt=0;
//					echo $row_is['dpss_lotno']." Disp ".$qt."<br/>";
					$totstcnfo=$totstcnfo+$qt;
					$tototw=$tototw+$qt;
					$xf=$xf+$qt;
					$ccnt++;
				}
			}
		}
		//echo "Sales ".$xc."<br/>";
		//echo "C&F ".$xf."<br/>";		
		//Outward - Sales - Dispatch Bulk
		
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trtype='Dispatch Bulk' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['lotldg_trqty']; 
				if($qt<0)$qt=0;
	//			echo $row_arhome['lotldg_lotno']." D-Bulk ".$qt."<br/>";
				$totdisp=$totdisp+$qt;
				$tototw=$tototw+$qt;
				$xv=$xv+$qt;
				$ccnt++;
			}	
		}
		
		//Outward - Sales - Release
		
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trtype='Qty-Rem' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['lotldg_trqty']; 
				if($qt<0)$qt=0;
	//			echo $row_arhome['lotldg_lotno']." Rem ".$qt."<br/>";
				$totdisp=$totdisp+$qt;
				$tototw=$tototw+$qt;
				$xd=$xd+$qt;
				$ccnt++;
			}	
		}
		//echo "Sales Release R&C".$xd."<br/>";
		$sql_arhome=mysqli_query($link,"select lotldg_id, tqty from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and trtype='Qty-Rem' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$sql_istbl2=mysqli_query($link,"select pswrem_id from tbl_pswrem where pswrem_id='".$row_arhome['lotldg_id']."' and pswrem_ptype IS NULL and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$t2=mysqli_num_rows($sql_istbl2);
				if($t2 > 0)
				{
					while($r=mysqli_fetch_array($sql_istbl2))
					{ //echo " *".$row_arhome['lotldg_id']."* ";
						$qt=$row_arhome['tqty']; 
						if($qt<0)$qt=0;
	//					echo $row_arhome['lotno']." PK-Rem ".$qt."<br/>";
						$totdisp=$totdisp+$qt; 
						$tototw=$tototw+$qt;
						$xz=$xz+$qt;
						$ccnt++;
					}	
				}
				$sql_istbl2=mysqli_query($link,"select pswrem_id from tbl_pswrem where pswrem_id='".$row_arhome['lotldg_id']."' and pswrem_ptype!='C&F' and pswrem_ptype IS NOT NULL and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$t2=mysqli_num_rows($sql_istbl2);
				if($t2 > 0)
				{
					while($r=mysqli_fetch_array($sql_istbl2))
					{ //echo " *".$row_arhome['lotldg_id']."* ";
						$qt=$row_arhome['tqty']; 
						if($qt<0)$qt=0;
	//					echo $row_arhome['lotno']." PK-Rem ".$qt."<br/>";
						$totdisp=$totdisp+$qt; 
						$tototw=$tototw+$qt;
						$xz=$xz+$qt;
						$ccnt++;
					}	
				}
			}	
		}
		//echo "Sales Release Pack".$xz."<br/>";
		//Outward - Sales - Stock Transfer Plant
		
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trtype='Stock Transfer Out' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{   
				$qt=$row_arhome['lotldg_trqty']; 
				if($qt<0)$qt=0;
	//			echo $row_arhome['lotldg_lotno']." ST-Out ".$qt."<br/>";
				$totstpo=$totstpo+$qt;
				$tototw=$tototw+$qt;
				$xp=$xp+$qt;
				$ccnt++;
			}	
		}
		
		//Outward - Sales - Stock Transfer Plant Pack Seed
		
		$sql_arhome=mysqli_query($link,"select tqty from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and trtype='Stock Transfer Out-Pack' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{   
				$qt=$row_arhome['tqty']; 
				if($qt<0)$qt=0;
	//			echo $row_arhome['lotldg_lotno']." ST-Out ".$qt."<br/>";
				$totstpo=$totstpo+$qt;
				$tototw=$tototw+$qt;
				$xp=$xp+$qt;
				$ccnt++;
			}	
		}
		
		//echo "Stock Transfer Out ".$xp."<br/>";
		$sql_arhome=mysqli_query($link,"select lotldg_id, tqty from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and trtype='Qty-Rem' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{   
				$sql_istbl2=mysqli_query($link,"select pswrem_id from tbl_pswrem where pswrem_id='".$row_arhome['lotldg_id']."' and pswrem_ptype='C&F' and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$t2=mysqli_num_rows($sql_istbl2);
				if($t2 > 0)
				{
					while($r=mysqli_fetch_array($sql_istbl2))
					{
						$qt=$row_arhome['tqty']; 
						if($qt<0)$qt=0;
	//					echo $row_arhome['lotno']." PK-Rem ".$qt."<br/>";
						$totstcnfo=$totstcnfo+$qt; 
						$xf=$xf+$qt;
						$tototw=$tototw+$qt;
						$ccnt++;
					}
				}
				
				$sql_istbl2=mysqli_query($link,"select pswrem_id from tbl_pswrem where pswrem_id='".$row_arhome['lotldg_id']."' and pswrem_ptype!='C&F' and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$t2=mysqli_num_rows($sql_istbl2);
				if($t2 > 0)
				{
					while($r=mysqli_fetch_array($sql_istbl2))
					{
						$qt=$row_arhome['tqty']; 
						if($qt<0)$qt=0;
	//					echo $row_arhome['lotno']." PK-Rem ".$qt."<br/>";
						$totstpo=$totstpo+$qt; 
						$xp=$xp+$qt;
						$tototw=$tototw+$qt;
						$ccnt++;
					}
				}
			}	
		}
		//echo "Sales Release Pack C&F".$xf."<br/>";
		//Outward - Purchase Return
		
		$sql_is=mysqli_query($link,"select did_s, qty from tbl_discard_sub where crop='".$crval."' and variety='".$verval."' and plantcode='$plantcode' order by did_s asc") or die(mysqli_error($link));
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			$sql_istbl=mysqli_query($link,"select tid from tbl_discard where tid='".$row_is['did_s']."' and tdate>='$stdate' and tdate<='$etdate' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($r=mysqli_fetch_array($sql_istbl))
				{
					$qt=$row_is['qty']; 
					if($qt<0)$qt=0;
	//				echo $row_is['lotnumber']." Discard ".$qt."<br/>";
					$totpret=$totpret+$qt;
					$tototw=$tototw+$qt;
					$pr=$pr+$qt;
					$ccnt++;
				}
			}
		}
		//echo "Discard ".$pr."<br/>";
		//Outward - Loss
		
		$sql_is=mysqli_query($link,"select proslipmain_id from tbl_proslipmain where proslipmain_date>='$stdate' and proslipmain_date<='$etdate' and proslipmain_tflag=1 and proslipmain_crop='".$crval."' and proslipmain_variety='".$verval."' and plantcode='$plantcode' order by proslipmain_id asc") or die(mysqli_error($link));
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			$sql_istbl=mysqli_query($link,"select proslipsub_tlqty from tbl_proslipsub where proslipmain_id='".$row_is['proslipmain_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_is2=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_is2['proslipsub_tlqty']; 
					if($qt<0)$qt=0;
		//			echo $row_is2['proslipsub_lotno']." PR-Loss ".$qt."<br/>";
					$totloss=$totloss+$qt;
					$tototw=$tototw+$qt;
					$prl=$prl+$qt;
					$ccnt++;
				}
			}
		}
		
		$sql_is=mysqli_query($link,"select pnpslipmain_id from tbl_pnpslipmain where pnpslipmain_date>='$stdate' and pnpslipmain_date<='$etdate' and pnpslipmain_tflag=1 and pnpslipmain_crop='".$crval."' and pnpslipmain_variety='".$verval."' and plantcode='$plantcode' order by pnpslipmain_id asc") or die(mysqli_error($link));
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			$sql_istbl=mysqli_query($link,"select pnpslipsub_tlqty, pnpslipsub_packloss, pnpslipsub_packcc from tbl_pnpslipsub where pnpslipmain_id='".$row_is['pnpslipmain_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_is2=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_is2['pnpslipsub_tlqty']; 
					$qt2=$row_is2['pnpslipsub_packloss']; 
					$qt3=$row_is2['pnpslipsub_packcc']; 
					if($qt<0)$qt=0;
					if($qt2<0)$qt2=0;
					if($qt3<0)$qt3=0;
					$totloss=$totloss+$qt+$qt2+$qt3;
//					echo $row_is2['pnpslipsub_lotno']." PK-Loss ".($qt+$qt2+$qt3)."<br/>";
					$tototw=$tototw+$qt+$qt2+$qt3;
					$prl=$prl+$qt;
					$pkl=$pkl+$qt2;
					$ccl=$ccl+$qt3;
					$ccnt++;
				}
			}
		}

		
		// Re-Printing Packaging using App Loss calculation
		$sql_is=mysqli_query($link,"select packaging_id from tbl_rpspackaging where packaging_tdate>='$stdate' and packaging_tdate<='$etdate' and packaging_tflg=1 and packaging_crop='".$crval."' and packaging_variety='".$verval."' and plantcode='$plantcode' order by packaging_id asc") or die(mysqli_error($link));
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			$sql_istbl=mysqli_query($link,"select packagingsub_lossqty, packagingsub_ccqty from tbl_rpspackaging_sub where packaging_id='".$row_is['packaging_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_is2=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_is2['packagingsub_lossqty']; 
					$qt2=$row_is2['packagingsub_ccqty']; 
					if($qt<0)$qt=0;
					if($qt2<0)$qt2=0;
					$totloss=$totloss+$qt+$qt2;
//					echo $row_is2['pnpslipsub_lotno']." PK-Loss ".($qt+$qt2+$qt3)."<br/>";
					$tototw=$tototw+$qt+$qt2;
					$prl=$prl+$qt;
					$pkl=$pkl+$qt2;
					$ccl=$ccl+$qt3;
					$ccnt++;
				}
			}
		}
		

		//echo "<br />";echo $rvl."  -  ";
		$sql_is=mysqli_query($link,"select rv_ups, rv_qcnop, rv_pl from tbl_revalidate where rv_date>='$stdate' and rv_date<='$etdate' and rv_rvflg=1 and rv_crop='".$crval."' and rv_variety='".$verval."' and plantcode='$plantcode' order by rv_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_is);
		if($t > 0)
		{
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$up=$row_is['rv_ups']; 
				$qt2=$row_is['rv_qcnop']; 
				$qt3=$row_is['rv_pl']; 
				$zz=explode(" ",$up);
				if($zz[1]=="Gms")
				{
					$pty=$zz[0]/1000;
				}
				else
				{
					$pty=$zz[0];
				}
				
				$ltqt=$qt2*$pty;
				$ltqt2=$qt3*$pty;
				
				if($ltqt<0)$ltqt=0;
				if($ltqt2<0)$ltqt2=0;
				$totloss=$totloss+$ltqt+$ltqt2;
				$tototw=$tototw+$ltqt+$ltqt2;
				$rvl=$rvl+$ltqt+$ltqt2;
				$ccnt++;
//				echo $row_is['rv_lotno']."  RV-Loss  ".($ltqt+$ltqt2)."<br/>";
				//echo $row_is['rv_lotno']." P-K ".$ltqt."  -  ".$ltqt2."<br/>";	
			}
		}
		//echo $rvl."  -  ";
		
		/*$sql_is=mysqli_query($link,"select * from tbl_drying where dryingdate>='$stdate' and dryingdate<='$etdate' and dflg=1 and crop='".$crval."' and variety='".$verval."' order by trid asc") or die(mysqli_error($link));
		$t2=mysqli_num_rows($sql_is);
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			$sql_istbl=mysqli_query($link,"select * from tbl_dryingsubsub where trid='".$row_is['trid']."'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_is2=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_is2['dryingloss']; 
					if($qt<0)$qt=0;
					$totloss=$totloss+$qt;
					$tototw=$tototw+$qt;
					$drl=$drl+$qt;
					$ccnt++;
				}
			}
		}*/
		
		
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trtype='DRYSUC' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['lotldg_trqty']; 
				if($qt<0)$qt=0;
	//			echo $row_arhome['lotldg_lotno']." DRY-Loss ".$qt."<br/>";
				$totloss=$totloss+$qt;
				$tototw=$tototw+$qt;
				$drl=$drl+$qt;
				$ccnt++;
			}	
		}
		
		
		
		//Outward - TDF - Dispatch
		
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trtype='Dispatch TDF' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['lotldg_trqty']; 
				if($qt<0)$qt=0;
	//			echo $row_arhome['lotldg_lotno']." TDF ".$qt."<br/>";
				$tottdf=$tottdf+$qt;
				$tototw=$tototw+$qt;
				$tdfl=$tdfl+$qt;
				$ccnt++;
			}	
		}
		
		//Outward - TDF - Dispatch Pack
		
		$sql_arhome=mysqli_query($link,"select tqty from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and trtype='Dispatch TDF' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['tqty']; 
				if($qt<0)$qt=0;
	//			echo $row_arhome['lotno']." TDF ".$qt."<br/>";
				$tottdf=$tottdf+$qt;
				$tototw=$tototw+$qt;
				$tdfl=$tdfl+$qt;
				$ccnt++;
			}	
		}
		
		
		
		$sq_srrv=mysqli_query($link,"Select srrv_ups, srrv_qcnop from tbl_srrevalidate where srrv_date>='$stdate' and srrv_date<='$etdate' and srrv_variety='$verval' and plantcode='$plantcode'") or die(mysqli_error($link));
		$tot_srrv=mysqli_num_rows($sq_srrv);
		while($row_srrv=mysqli_fetch_array($sq_srrv))
		{ 
			$up=$row_srrv['srrv_ups']; 
			$qt2=$row_srrv['srrv_qcnop']; 
			$zz=explode(" ",$up);
			if($zz[1]=="Gms")
			{
				$pty=$zz[0]/1000;
			}
			else
			{
				$pty=$zz[0];
			}
			
			$qt=$qt2*$pty;
			if($qt<0)$qt=0;
			$totloss=$totloss+$qt;
			$tototw=$tototw+$qt;
			$rvl=$rvl+$qt;
			$ccnt++;
//			echo $row_srrv['srrv_lotno']." RV-Loss ".$qt."<br/>";	
			//echo $row_srrv['srrv_lotno']." S-R ".$qt."<br/>";	
		}
		//echo $rvl."  -  ";
		$sql_is=mysqli_query($link,"select ci_id from tbl_ci where ci_date>='$stdate' and ci_date<='$etdate' and ci_tflg=1 and ci_crop='".$crval."' and ci_variety='".$verval."' and plantcode='$plantcode' order by ci_id asc") or die(mysqli_error($link));
		$xt=mysqli_num_rows($sql_is);
		while($row_is=mysqli_fetch_array($sql_is))
		{ 
			$sql_istbl=mysqli_query($link,"select cisub_qty from tbl_cisub where ci_id='".$row_is['ci_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_is2=mysqli_fetch_array($sql_istbl))
				{ 
					$qt=$row_is2['cisub_qty']; 
					if($qt<0)
					{
						$totloss=$totloss-($qt);
						$tototw=$tototw-($qt);
						$cil=$cil-($qt);
						$ccnt++;
					}
					else
					{
						$cirec=$cirec+$qt;
						$totinw=$totinw+$qt;
						$cil=$cil+$qt;
						$ccnt++;
					}
				}
			}
		}
		
		// Inward - IVT Out ----------------
		$sql_arhome=mysqli_query($link,"select lotldg_trqty from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate>='$stdate' and lotldg_trdate<='$etdate' and lotldg_trtype='IVTO' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link));
		$t=mysqli_num_rows($sql_arhome);
		if($t > 0)
		{
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$qt=$row_arhome['lotldg_trqty']; 
				//echo $row_arhome['lotldg_lotno']." - ".$qt."<br/>";
				if($qt<0)$qt=0;
				$totivtout=$totivtout+$qt;
				$tototw=$tototw+$qt;
				$ccnt++;
			}	
		}
		
		//echo "<br/>";echo "<br/>";
		//echo "Closing stock Records <br/>";
		//Outward records block  end -------------------------------------------------
		
		// closing stock Records  -----------------------------------------
		
		// Raw Seed closing Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate<='$etdate' and lotldg_sstage='Raw' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_trdate<='$etdate' and lotldg_sstage='Raw' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_trdate<='$etdate' and lotldg_sstage='Raw' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select lotldg_balqty, lotldg_qc, lotldg_got from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$etdate' and lotldg_balqty>0 and lotldg_sstage='Raw' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
	//					echo  $row_arhome['lotldg_lotno']."  CL-RC  ".$qt."<br/>";
						if($qt<0)$qt=0;
						$totclqty=$totclqty+$qt;
						if($row_issuetbl['lotldg_qc']=="Fail" || $row_issuetbl['lotldg_got']=="Fail")
						{$cfs=$cfs+$qt;}
						else
						{$cr=$cr+$qt;}
						$ccnt++;
					}	
				}
			}
			if($totclqty < 0)$totclqty=0;
		}
		
		// Condition Seed closing Records
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate<='$etdate' and lotldg_sstage='Condition' and plantcode='$plantcode' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and lotldg_trdate<='$etdate' and lotldg_sstage='Condition' and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_trdate<='$etdate' and lotldg_sstage='Condition' and plantcode='$plantcode' order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select lotldg_balqty, lotldg_qc, lotldg_got from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_trdate<='$etdate' and lotldg_balqty>0 and lotldg_sstage='Condition' and plantcode='$plantcode' order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['lotldg_balqty']; 
	//					echo  $row_arhome['lotldg_lotno']."  CL-RC  ".$qt."<br/>";
						if($qt<0)$qt=0;
						$totclqty=$totclqty+$qt;
						if($row_issuetbl['lotldg_qc']=="Fail" || $row_issuetbl['lotldg_got']=="Fail")
						{$cfs=$cfs+$qt;}
						else
						{$cc=$cc+$qt;}
						//$crc=$crc+$qt;
						$ccnt++;
					}	
				}
			}
			if($totclqty < 0)$totclqty=0;
		}
		
		// Pack Seed closing Records
		$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_trdate<='$etdate' and plantcode='$plantcode' group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and lotldg_trdate<='$etdate' and plantcode='$plantcode' group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and lotldg_trdate<='$etdate' and plantcode='$plantcode' order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select balqty, lotldg_qc, lotldg_got from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and lotldg_trdate<='$etdate' and balqty>0 and plantcode='$plantcode' order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_istbl))
					{ 
						$qt=$row_issuetbl['balqty'];
						//echo  $row_arhome['lotno']."  CL-PK  ".$qt."<br/>";
						if($qt<0)$qt=0;
						$totclqty=$totclqty+$qt; 
						if($row_issuetbl['lotldg_qc']=="Fail" || $row_issuetbl['lotldg_got']=="Fail")
						{$cfs=$cfs+$qt;}
						else
						{$cpk=$cpk+$qt;}
						
						$ccnt++;
					}	
				}
			}
			if($totclqty < 0)$totclqty=0;
		}
		
		// Sales Return closing Records
		$sql_arhome=mysqli_query($link,"select salesrs_id, salesr_id, salesrs_newlot from tbl_salesrv_sub where salesrs_crop='".$crval."' and salesrs_variety='".$verval."' and salesrs_rettype='P2P' and salesrs_dovfy<='$etdate' and plantcode='$plantcode' order by 'salesrs_id' asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_istbl=mysqli_query($link,"select salesrss_qty from tbl_salesrvsub_sub where salesrs_id='".$row_arhome['salesrs_id']."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_istbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_istbl))
				{ 
					$s_srm=mysqli_query($link,"select salesr_id from tbl_salesrv where salesr_date<='$etdate' and salesr_id='".$row_arhome['salesr_id']."' and salesr_vflg=1 and plantcode='$plantcode'") or die(mysqli_error($link));
					$t_srm=mysqli_num_rows($s_srm);
					if($t_srm > 0)
					{
						while($r=mysqli_fetch_array($s_srm))
						{
							$qt=$row_issuetbl['salesrss_qty']; 
							if($qt<0)$qt=0;
							if($qt>0)
							{
								$tot_p2c=0; $tot_srrv=0;
								$sq_srrv=mysqli_query($link,"Select srrv_lotno from tbl_srrevalidate where srrv_lotno='".$row_arhome['salesrs_newlot']."' and srrv_date<='$etdate' and plantcode='$plantcode'") or die(mysqli_error($link));
								$tot_srrv=mysqli_num_rows($sq_srrv);
								
								$sq_p2c=mysqli_query($link,"Select unp_lotno from tbl_unpsp2c where unp_lotno='".$row_arhome['salesrs_newlot']."' and unp_date<='$etdate' and plantcode='$plantcode'") or die(mysqli_error($link));
								$tot_p2c=mysqli_num_rows($sq_p2c);
								
								if($tot_p2c>0){}
								else if($tot_srrv > 0){}
								else
								{
//									echo $row_arhome['salesrs_newlot']."  CL-SR  ".$qt."<br/>";
									$totclqty=$totclqty+$qt;
									$csr=$csr+$qt;
									$ccnt++;
								}
							}
						}
					}
				}	
			}
			if($totclqty < 0)$totclqty=0;
		}
		// closing Records Block end------------------------------------------
		
	//echo  $or." + ".$oc." + ".$opk." + ".$osr." + ".$isr." + ".$xc." + ".$xv." + ".$xd." + ".$xz." + ".$xp." + ".$xf." + ".$totivtout." + ".$pr." + ".$prl." + ".$pkl." + ".$ccl." + ".$rvl." + ".$drl." + ".$cil." + ".$tdfl." + ".$totloss." = ".$tototw." => ".$cr." - ".$cc." - ".$cpk." - ".$csr."<br>";	
	
if($ccnt > 0)
{
/*echo $totopqty." - ".$totfrn." - ".$totsrn." - ".$totstp." - ".$totstcnf." - ".$cirec;
echo " =  ".$totinw." =  ";
echo $totdisp." - ".$totpret." - ".$totstpo." - ".$totstcnfo." - ".$totloss;
echo " = ".$tototw;
echo " = ".$totclqty;
echo "<br/>";*/

$sql_rep="Insert into tmp_pmsldgrep2 (crop, variety, vertype, oprawseed, opconseed, oppackseed, opsrseed, opfailseed, opstock, frnstock, srinstock, stinplant, stincnf, ivtin, cistock, totinstock, salesstock, purretstock, stoutplant, stoutcnf, tdfstock, ivtout, totloss, totoutstock, clrawseed, clconseed, clpackseed, clsrseed, clfailseed, clstock, logid, repflg, plantcode) values ('$crop1', '$verty', '$vtyp', '$or', '$oc', '$opk', '$osr', '$ofs', '$totopqty', '$totfrn', '$totsrn', '$totstp', '$totstcnf', '$totivtin', '$cirec', '$totinw', '$totdisp', '$totpret', '$totstpo', '$totstcnfo', '$tottdf', '$totivtout', '$totloss', '$tototw', '$cr', '$cc', '$cpk', '$csr', '$cfs', '$totclqty', '$logid', '1', '$plantcode')";
$ins=mysqli_query($link,$sql_rep) or die(mysqli_error($link));

if($srno%2!=0)
{
?>		  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vtyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totopqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totfrn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstcnf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totivtin;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cirec;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totinw;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totdisp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpret?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstpo;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstcnfo;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tottdf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totivtout;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tototw?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totclqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $verty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vtyp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totopqty?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totfrn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsrn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstcnf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totivtin;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cirec;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totinw;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totdisp;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totpret?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstpo;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totstcnfo;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tottdf;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totivtout;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totloss?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tototw?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totclqty?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
}

?>
</table>			
<br />
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_stockladgerbob.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" />&nbsp;<a href="excel-stockladgerbob.php?txtcrop=<?php echo $_REQUEST['txtcrop']?>&txtvariety=<?php echo $_REQUEST['txtvariety']?>&slchk=<?php echo $slchk;?>&slchk2=<?php echo $slchk2;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;</td>
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
