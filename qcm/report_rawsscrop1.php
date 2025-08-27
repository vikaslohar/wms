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
		$txtstage = $_REQUEST['txtstage'];
		
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality - Report - Crop Variety wise Substandard Raw Seed Report</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
var txtstage=document.frmaddDepartment.txtstage.value;
winHandle=window.open('report_rawsscrop2.php?txtcrop='+itemid+'&txtvariety='+vv+'&txtstage='+txtstage,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <?php
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">Crop Variety wise Substandard Seed Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="txtstage" value="<?php echo $txtstage;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
  
<?php
	
	$crp="ALL"; $ver="ALL"; $stage="ALL";
	if($txtstage!="ALL")
	{
		if($txtstage=="Raw")
		{
			$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and lotldg_sstage='$txtstage' and (lotldg_qc='Fail' OR lotldg_got='Fail')";
		}
		else if($txtstage=="Condition")
		{
			$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and lotldg_sstage='$txtstage' and (lotldg_qc='Fail' OR lotldg_got='Fail')";
		}
		else if($txtstage=="Pack")
		{
			$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
		}
		else
		{
			$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
			$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
		}
	}
	else
	{
		$qry="select Distinct lotldg_crop from tbl_lot_ldg where lotldg_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
		$qry2="select Distinct lotldg_crop from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail')";
	}
	
	if($crop!="ALL")
	{	
		if($txtstage!="ALL")
		{
			if($txtstage!="Pack")
				$qry.=" and lotldg_crop='$crop' ";
			if($txtstage=="Pack")
				$qry2.=" and lotldg_crop='$crop' ";
		}
		else
		{
			$qry.=" and lotldg_crop='$crop' ";
			$qry2.=" and lotldg_crop='$crop' ";
		}
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
		if($txtstage!="ALL")
		{
			if($txtstage!="Pack")
				$qry.=" and lotldg_variety='$variety' ";
			if($txtstage=="Pack")
				$qry2.=" and lotldg_variety='$variety' ";
		}
		else
		{
			$qry.=" and lotldg_variety='$variety' ";
			$qry2.=" and lotldg_variety='$variety' ";
		}
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	$tot_arr_home=0; $tot_arr_home1=0;
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$qry.=" group by lotldg_crop";
			$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
			$tot_arr_home=mysqli_num_rows($sql_arr_home1);
		}
		if($txtstage=="Pack")
		{
			$qry2.=" group by lotldg_crop";
			$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
			$tot_arr_home1=mysqli_num_rows($sql_arr_home2);
		}
	}
	else
	{
		$qry.=" group by lotldg_crop";
		$qry2.=" group by lotldg_crop";
		$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
		$sql_arr_home2=mysqli_query($link,$qry2) or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home1);
		$tot_arr_home1=mysqli_num_rows($sql_arr_home2);
	}
	
	
	$croparr="";
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
			{
				$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($croparr!="")
				$croparr=$croparr.",".$row312['cropname'];
				else
				$croparr=$row312['cropname'];
			}
		}
		else
		{
			while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
			{
				$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($croparr!="")
				$croparr=$croparr.",".$row312['cropname'];
				else
				$croparr=$row312['cropname'];
			}
		}
	}
	else
	{
		while($row_arr_home12=mysqli_fetch_array($sql_arr_home1))
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home12['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
			else
			$croparr=$row312['cropname'];
		}
		while($row_arr_home22=mysqli_fetch_array($sql_arr_home2))
		{
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home22['lotldg_crop']."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($croparr!="")
			$croparr=$croparr.",".$row312['cropname'];
			else
			$croparr=$row312['cropname'];
		}
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
			$sql_crop2=mysqli_query($link,"select * from tblcrop where cropname='".$cp[$i]."' order by cropname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($crop2!="")
			$crop2=$crop2.",".$row312['cropid'];
			else
			$crop2=$row312['cropid'];
		}
	}
	
if($tot_arr_home > 0 || $tot_arr_home1 > 0)
{
$crps=explode(",",$crop2);
//print_r($crps);
foreach($crps as $crval)
{
if($crval<>"")
{
	$crop1=""; 
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crval."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$crop1=$row31['cropname'];	

	if($txtstage!="ALL")
	{
		if($txtstage=="Raw")
		{
			$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_id!=0 and lotldg_sstage='$txtstage' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
		}
		else if($txtstage=="Condition")
		{
			$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_id!=0 and lotldg_sstage='$txtstage' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
		}
		else if($txtstage=="Pack")
		{
			$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
		}
		else
		{
			$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
			$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
		}
	}
	else
	{
		$qry="select Distinct lotldg_variety from tbl_lot_ldg where lotldg_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
		$qry2="select Distinct lotldg_variety from tbl_lot_ldg_pack where lotdgp_id!=0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_crop='".$crval."'";
	}	

	if($variety!="ALL")
	{	
		if($txtstage!="ALL")
		{
			if($txtstage!="Pack")
			{
				$qry.=" and lotldg_variety='$variety' ";
			}
			else
			{
				$qry2.=" and lotldg_variety='$variety' ";
			}
		}
		else
		{
			$qry.=" and lotldg_variety='$variety' ";
			$qry2.=" and lotldg_variety='$variety' ";
		}		
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$qry.=" group by lotldg_variety";
			$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
		}
		else
		{
			$qry2.=" group by lotldg_variety";
			$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
		}
	}
	else
	{
		$qry.=" group by lotldg_variety";
		$qry2.=" group by lotldg_variety";
		$sql_arr_home12=mysqli_query($link,$qry) or die(mysqli_error($link));
		$sql_arr_home22=mysqli_query($link,$qry2) or die(mysqli_error($link));
	}	

	$verarr="";
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
			{
				$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($verarr!="")
				$verarr=$verarr.",".$row312['popularname'];
				else
				$verarr=$row312['popularname'];
			}
		}
		else
		{
			while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
			{
				$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
				$row312=mysqli_fetch_array($sql_crop2);
				if($verarr!="")
				$verarr=$verarr.",".$row312['popularname'];
				else
				$verarr=$row312['popularname'];
			}
		}
	}
	else
	{
		while($row_arr_home12=mysqli_fetch_array($sql_arr_home12))
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home12['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
			else
			$verarr=$row312['popularname'];
		}
		while($row_arr_home22=mysqli_fetch_array($sql_arr_home22))
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home22['lotldg_variety']."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($verarr!="")
			$verarr=$verarr.",".$row312['popularname'];
			else
			$verarr=$row312['popularname'];
		}
	}
	
	
	$ver2="";
	$cp2=explode(",",$verarr);
	$cp2=array_unique($cp2);
	sort($cp2);
	for($i=0; $i<count($cp2); $i++)
	{
		if($cp2[$i]!="")
		{
			$sql_crop2=mysqli_query($link,"select * from tblvariety where popularname='".$cp2[$i]."'  order by popularname asc") or die(mysqli_error($link));
			$row312=mysqli_fetch_array($sql_crop2);
			if($ver2!="")
			$ver2=$ver2.",".$row312['varietyid'];
			else
			$ver2=$row312['varietyid'];
		}
	}

	$verps=explode(",",$ver2);
	foreach($verps as $verval)
	{
	if($verval<>"")
	{
	
	$ccnt=0;

	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage'  group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  order by lotldg_id desc ") or die(mysqli_error($link));
					$row_is1=mysqli_fetch_array($sql_is1); 
					$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
							$ccnt++;
					}
				}
			}
		}
		else
		{
			$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
			
			while($row_arhome=mysqli_fetch_array($sql_arhome))
			{  
				$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
				while($row_is=mysqli_fetch_array($sql_is))
				{ 
					$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  order by lotdgp_id desc ") or die(mysqli_error($link));
					$row_is1=mysqli_fetch_array($sql_is1); 
					$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty>0 order by lotdgp_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
							$ccnt++;
					}
				}
			}
		}
	}
	else
	{
		$sql_arhome=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_lotno='".$row_arhome['lotldg_lotno']."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_lotno='".$row_arhome['lotldg_lotno']."'  order by lotldg_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					$ccnt++;
				}
			}
		}
			//echo $ccnt;
		$sql_arhome=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arhome=mysqli_fetch_array($sql_arhome))
		{  
			$sql_is=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotno='".$row_arhome['lotno']."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			while($row_is=mysqli_fetch_array($sql_is))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_is['subbinid']."' and binid='".$row_is['binid']."' and lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and lotno='".$row_arhome['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail')  order by lotdgp_id desc ") or die(mysqli_error($link));
				$row_is1=mysqli_fetch_array($sql_is1); 
				$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_is1[0]."' and balqty>0 order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_istbl);
				if($t > 0)
				{
					$ccnt++;
				}
			}
		}
	}

if($ccnt>0)	
{
	$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$verval."' ") or die(mysqli_error($link));
	$row_var=mysqli_fetch_array($sql_var);
	$verty=$row_var['popularname'];
	$srno=0; $totalbags=0; $totalqty=0;	
// 		Table code for crop & variety wise lot numbers
?>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">
<tr height="25" >
	<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crop1;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $verty;?></td>

</tr>
</table>

  <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="22" align="center" valign="middle" class="smalltblheading">#</td>
		<td width="127"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
			<td width="44"  align="center" valign="middle" class="smalltblheading">Stage</td>
			<td width="51"  align="center" valign="middle" class="smalltblheading">NoB</td>
			<td width="62"  align="center" valign="middle" class="smalltblheading">Qty</td>
			<td width="145"  align="center" valign="middle" class="smalltblheading">SLOC</td>
			<td width="52"  align="center" valign="middle" class="smalltblheading">QC status</td>
			<td width="43" align="center" valign="middle" class="smalltblheading">Moist %</td>
			<td width="44" align="center" valign="middle" class="smalltblheading">Germ %</td>
	        <td width="61"  align="center" valign="middle" class="smalltblheading">DoT</td>
			<td width="67"  align="center" valign="middle" class="smalltblheading">GOT Status</td>
			<td width="71"  align="center" valign="middle" class="smalltblheading">Genetic Purity %</td>
			<td width="65"  align="center" valign="middle" class="smalltblheading">DOGR</td>
			<td width="66"  align="center" valign="middle" class="smalltblheading">Seed Status</td>
			</tr>

<?php
	if($txtstage!="ALL")
	{
		if($txtstage!="Pack")
		{
			$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage' group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
			while($row_arr_home=mysqli_fetch_array($sql_arr_home))
			{  
				$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
				$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage="";
				$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage' group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			
				while($row_issue=mysqli_fetch_array($sql_issue))
				{ 
					$txtdot=""; 
				
					$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage' order by lotldg_id asc ") or die(mysqli_error($link));
					$row_issue1=mysqli_fetch_array($sql_issue1); 
				
					$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') and lotldg_sstage='$txtstage' order by lotldg_id asc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_issuetbl);
					if($t > 0)
					{
						while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
						{ 
							//echo $row_issuetbl['lotldg_id']."<BR>";
							$cnt++;
							$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
							$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
							
							$stage=$row_issuetbl['lotldg_sstage']; 
							$totqc=$row_issuetbl['lotldg_qc']; 
							$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
							$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
							$totmost=$row_issuetbl['lotldg_moisture']; 
							$totgemp=$row_issuetbl['lotldg_gemp']; 
							$genpp=$row_issuetbl['lotldg_genpurity']; 
							$totsst=$row_issuetbl['lotldg_sstatus']; 
							if($row_issuetbl['lotldg_srflg'] > 0)
							{
								if($totsst!="")$totsst=$totsst."/"."S";
								else
								$totsst="S";
							}
							if($txtdot=="")
							{
							$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
							$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
							}
							
							if($dogr=="")
							{
							$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
							$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
							}
							
							if($txtdot=="00-00-0000" || $txtdot=="--")
							$txtdot="";
							
							if($dogr=="00-00-0000" || $dogr=="--")
							$dogr="";
							if($totgemp==0 || $totgemp=="") $totgemp="";
							
							if($genpp=="0.00" || $genpp=="NULL")$genpp="";
						
						
							$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
							$row_whouse=mysqli_fetch_array($sql_whouse);
							$wareh=$row_whouse['perticulars']."/";
							
							$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
							$row_binn=mysqli_fetch_array($sql_binn);
							$binn=$row_binn['binname']."/";
							
							$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
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
						}
					}
				}
		

//echo $cnt;
if($cnt>0)
{
$srno++;
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotldg_lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotldg_lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
</tr>
<?php
}
}
}
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
		while($row_arr_home=mysqli_fetch_array($sql_arr_home))
		{  
			$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
			$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage="";
			$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotno='".$row_arr_home['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$txtdot=""; 
				
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc ") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc") or die(mysqli_error($link)); 
				$t=mysqli_num_rows($sql_issuetbl);
				if($t > 0)
				{
					while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
					{ 
						//echo $row_issuetbl['lotldg_id']."<BR>";
						$cnt++;
						$totqty=$totqty+$row_issuetbl['balqty']; 
						//$totnob=$totnob+$row_issuetbl['balbags']; 
						
						$stage="Pack"; 
						$totqc=$row_issuetbl['lotldg_qc']; 
						$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
						$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
						$totmost=$row_issuetbl['lotldg_moisture']; 
						$totgemp=$row_issuetbl['lotldg_gemp']; 
						$genpp=$row_issuetbl['lotldg_genpurity']; 
						$totsst=$row_issuetbl['lotldg_sstatus']; 
						if($row_issuetbl['lotldg_srflg'] > 0)
						{
							if($totsst!="")$totsst=$totsst."/"."S";
							else
							$totsst="S";
						}
						if($txtdot=="")
						{
							$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
							$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
						}
						
						if($dogr=="")
						{
							$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
							$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
						}
						
						if($txtdot=="00-00-0000" || $txtdot=="--")
						$txtdot="";
						
						if($dogr=="00-00-0000" || $dogr=="--")$dogr="";
						
						if($totgemp==0 || $totgemp=="") $totgemp="";
						
						if($genpp=="0.00" || $genpp=="NULL")$genpp="";
					
					
						$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
						$row_whouse=mysqli_fetch_array($sql_whouse);
						$wareh=$row_whouse['perticulars']."/";
						
						$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
						$row_binn=mysqli_fetch_array($sql_binn);
						$binn=$row_binn['binname']."/";
						
						$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
						$row_subbinn=mysqli_fetch_array($sql_subbinn);
						$subbinn=$row_subbinn['sname'];
						
						//$slups=$row_issuetbl['lotldg_balbags'];
						$slqty=$row_issuetbl['balqty'];
						//$aq1=explode(".",$slups);
						//if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
						
						$an1=explode(".",$slqty);
						if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
						//$slups=$ac1;
						$slqty=$acn1;
						if($sloc!="")
							$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slqty."<br/>";
						else
							$sloc=$wareh.$binn.$subbinn." | ".$slqty."<br/>";
					}
				}
			}
		

//echo $cnt;
if($cnt>0)
{
$srno++;
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
</tr>
<?php
}
}
}

}
}
else
{
	$sql_arr_home=mysqli_query($link,"select distinct lotldg_lotno from tbl_lot_ldg where  lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotldg_lotno order by lotldg_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{  
		$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
		$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage="";
		$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_arr_home['lotldg_lotno']."'  and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
			
		while($row_issue=mysqli_fetch_array($sql_issue))
		{ 
			$txtdot=""; 
				
			$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_arr_home['lotldg_lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotldg_id asc ") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
				
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotldg_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_issuetbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					//echo $row_issuetbl['lotldg_id']."<BR>";
					$cnt++;
					$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
					$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
						
					$stage=$row_issuetbl['lotldg_sstage']; 
					$totqc=$row_issuetbl['lotldg_qc']; 
					$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
					$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
					$totmost=$row_issuetbl['lotldg_moisture']; 
					$totgemp=$row_issuetbl['lotldg_gemp']; 
					$genpp=$row_issuetbl['lotldg_genpurity']; 
					$totsst=$row_issuetbl['lotldg_sstatus']; 
					if($row_issuetbl['lotldg_srflg'] > 0)
					{
						if($totsst!="")$totsst=$totsst."/"."S";
						else
						$totsst="S";
					}
					if($txtdot=="")
					{
						$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
						$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
					}
							
					if($dogr=="")
					{
						$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
						$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
					}
							
					if($txtdot=="00-00-0000" || $txtdot=="--")
						$txtdot="";
							
					if($dogr=="00-00-0000" || $dogr=="--")
						$dogr="";
					if($totgemp==0 || $totgemp=="") $totgemp="";
							
					if($genpp=="0.00" || $genpp=="NULL")$genpp="";
						
						
					$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
							
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
							
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
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
				}
			}
		}
	

//echo $cnt;
if($cnt>0)
{
$srno++;
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotldg_lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotldg_lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
</tr>
<?php
}
}
}
	$sql_arr_home=mysqli_query($link,"select distinct lotno from tbl_lot_ldg_pack where lotldg_crop='".$crval."' and lotldg_variety='".$verval."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by lotno order by lotdgp_id asc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{  
		$wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	 $cnt=0;
		$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $sloc=""; $genpp=""; $dogr=""; $stage="";
		$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where lotno='".$row_arr_home['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') group by subbinid order by lotdgp_id asc") or die(mysqli_error($link));
			
		while($row_issue=mysqli_fetch_array($sql_issue))
		{ 
			$txtdot=""; 
				
			$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_arr_home['lotno']."' and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc ") or die(mysqli_error($link));
			$row_issue1=mysqli_fetch_array($sql_issue1); 
				
			$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0 and (lotldg_qc='Fail' OR lotldg_got='Fail') order by lotdgp_id asc") or die(mysqli_error($link)); 
			$t=mysqli_num_rows($sql_issuetbl);
			if($t > 0)
			{
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					//echo $row_issuetbl['lotldg_id']."<BR>";
					$cnt++;
					$totqty=$totqty+$row_issuetbl['balqty']; 
					//$totnob=$totnob+$row_issuetbl['balbags']; 
					
					$stage="Pack"; 
					$totqc=$row_issuetbl['lotldg_qc']; 
					$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
					$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
					$totmost=$row_issuetbl['lotldg_moisture']; 
					$totgemp=$row_issuetbl['lotldg_gemp']; 
					$genpp=$row_issuetbl['lotldg_genpurity']; 
					$totsst=$row_issuetbl['lotldg_sstatus']; 
					if($row_issuetbl['lotldg_srflg'] > 0)
					{
						if($totsst!="")$totsst=$totsst."/"."S";
						else
						$totsst="S";
					}
					if($txtdot=="")
					{
						$rdate=explode("-",$row_issuetbl['lotldg_qctestdate']);
						$txtdot=$rdate[2]."-".$rdate[1]."-".$rdate[0];
					}
						
					if($dogr=="")
					{
						$rdate=explode("-",$row_issuetbl['lotldg_gottestdate']);
						$dogr=$rdate[2]."-".$rdate[1]."-".$rdate[0];
					}
						
					if($txtdot=="00-00-0000" || $txtdot=="--")
					$txtdot="";
						
					if($dogr=="00-00-0000" || $dogr=="--")$dogr="";
						
					if($totgemp==0 || $totgemp=="") $totgemp="";
						
					if($genpp=="0.00" || $genpp=="NULL")$genpp="";
					
					
					$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
						
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
						
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];
						
					//$slups=$row_issuetbl['lotldg_balbags'];
					$slqty=$row_issuetbl['balqty'];
					//$aq1=explode(".",$slups);
					//if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
						
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					//$slups=$ac1;
					$slqty=$acn1;
					if($sloc!="")
						$sloc=$sloc.$wareh.$binn.$subbinn." | ".$slqty."<br/>";
					else
						$sloc=$wareh.$binn.$subbinn." | ".$slqty."<br/>";
				}
			}
		}
		

//echo $cnt;
if($cnt>0)
{
$srno++;
$totalqty=$totalqty+$totqty; 
$totalbags=$totalbags+$totnob;
if($totqc=="UT")$txtdot="";
if($srno%2!=0)
{
?>			  
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
			<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
		  	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home['lotno']?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
         	<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
           	<td align="center" valign="middle" class="smalltblheading"><?php echo $totqc;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totmost;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totgemp;?></td>
          	<td align="center" valign="middle" class="smalltbltext"><?php echo $txtdot?></td>
			<td align="center" valign="middle" class="smalltblheading"><?php echo $totgot;?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $genpp?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $dogr?></td>
           	<td align="center" valign="middle" class="smalltbltext"><?php echo $totsst;?></td>
</tr>
<?php
}
}
}

}
?>
<tr class="Dark">
			<td align="center" valign="middle" class="smalltblheading" colspan="3">Total</td>
         	<td align="center" valign="middle" class="smalltblheading"><?php echo $totalbags?></td>
		   	<td align="center" valign="middle" class="smalltblheading"><?php echo $totalqty;?></td>
			<td align="center" valign="middle" class="smalltblheading" colspan="9">&nbsp;</td>
</tr>
</table>			
<br />
<?php
}
}
}
}
}
}
?>
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_rawsscrop.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
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
