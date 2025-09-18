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
	
	function getFinancialYears($count = 15) {
		$years = [];
		$currentYear = date('Y');
		$currentMonth = date('n');
		if ($currentMonth < 4) {
			$currentYear--;
		}
	
		for ($i = 0; $i < $count; $i++) {
			$start = $currentYear - $i;
			$end = $start + 1;
			$years[] = "$start-$end";
		}
		return $years;
	}
	
	// Ordered months in FY (April to March)
	$months = [
		"April" => 4,
		"May" => 5,
		"June" => 6,
		"July" => 7,
		"August" => 8,
		"September" => 9,
		"October" => 10,
		"November" => 11,
		"December" => 12,
		"January" => 1,
		"February" => 2,
		"March" => 3,
	];
	
	$selectedYear = '';
	$selectedMonth = '';
	$startDate = '';
	$endDate = '';
	$monthList = [];
	
	$financial_year = $_REQUEST['financial_year'];
	$month = $_REQUEST['month'];
	$txtorganiser = $_REQUEST['txtorganiser'];
	$txtcrop = $_REQUEST['txtcrop'];
	$txtvariety = $_REQUEST['txtvariety'];
	$plantcode = $_REQUEST['txtplant'];
	
	$selectedYear = $_REQUEST['financial_year'] ?? '';
    $selectedMonth = $_REQUEST['month'] ?? '';

    if (!empty($selectedYear)) {
        [$startYear, $endYear] = explode('-', $selectedYear);

        if (!empty($selectedMonth) && isset($months[$selectedMonth])) {
            // Specific month selected
            $monthNum = $months[$selectedMonth];
            $year = ($monthNum >= 4) ? $startYear : $endYear;

            $startDate = date("Y-m-d", strtotime("$year-$monthNum-01"));
            $endDate = date("Y-m-t", strtotime($startDate));
        } else {
            // Month is ALL ? build array of all months in FY
            foreach ($months as $monthName => $monthNum) {
                $year = ($monthNum >= 4) ? $startYear : $endYear;
                $start = date("Y-m-01", strtotime("$year-$monthNum-01"));
                $end = date("Y-m-t", strtotime($start));
                $monthList[] = [
                    'month' => $monthName,
                    'start_date' => $start,
                    'end_date' => $end
                ];
            }
        }
    }
		
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant - Report - Financial Year wise Monthly Packing Report</title>

<link href="../include/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../include/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../include/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../include/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../include/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<style>
.smalltblheading{
	background-color:#A2CEF9 !important;
	/*border-color:#d21704 !important;*/
}
</style>

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
var loc=document.frmaddDepartment.txtclass.value;
var state=document.frmaddDepartment.state.value;
var txtorganiser=document.frmaddDepartment.txtorganiser.value;
var txtcrop=document.frmaddDepartment.txtcrop.value;
var txtvariety=document.frmaddDepartment.txtvariety.value;

winHandle=window.open('report_arrivalplcvq2.php?sdate='+sdate+'&edate='+edate+'&txtclass='+loc+'&state='+state+'&txtorganiser='+txtorganiser+'&txtcrop='+txtcrop+'&txtvariety='+txtvariety,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="940" height="25">&nbsp; Financial Year wise Monthly Packing Report <?php if($plantcode=="D"){echo "Deorjhal Plant";} else if($plantcode=="B"){echo "Boriya Plant";} else {echo "";}?></td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="financial_year" value="<?php echo $_REQUEST['financial_year'];?>" type="hidden"> 
	<input name="month" value="<?php echo $_REQUEST['month'];?>" type="hidden">  
	<input name="txtcrop" value="<?php echo $_REQUEST['txtcrop'];?>" type="hidden">  
	<input name="txtvariety" value="<?php echo $_REQUEST['txtvariety'];?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse">
    	<tr height="25" >
      <td align="left" class="subheading" style="color:#303918; " >&nbsp; Financial Year <?= htmlspecialchars($selectedYear) ?> Month <?= $selectedMonth ? htmlspecialchars($selectedMonth) : 'ALL' ?></td>
  	</tr>
</table>
  
<div style="overflow:scroll; height:400px; width:974px;">
<table width="2000" align="center" border="1" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" id="example">
<thead >
<tr class="tblsubtitle" height="25">
<th align="center" valign="middle" class="smalltblheading" rowspan="2" >#</th>
<th align="center" valign="middle" class="smalltblheading" rowspan="2" >Crop Type</th>
<th align="center" valign="middle" class="smalltblheading" rowspan="2" >Crop</th>
<th align="center" valign="middle" class="smalltblheading" rowspan="2" >Variety</th>
<th align="center" valign="middle" class="smalltblheading" rowspan="2" >UPS</th>
<th align="center" valign="middle" class="smalltblheading" rowspan="2" >Type</th>
<th align="center" valign="middle" class="smalltblheading" rowspan="2" > Size</th>
<?php
 if ($selectedMonth!="ALL" && $startDate && $endDate){
?>
<th align="center" valign="middle" class="smalltblheading" colspan="4" ><?php echo $selectedMonth;?></th>
<?php }elseif ($selectedMonth=="ALL" && count($monthList)){ ?>
<?php
foreach ($monthList as $item){
?>
<th align="center" valign="middle" class="smalltblheading" colspan="4" ><?php echo $item['month']; ?></th>
<?php }} ?>
</tr>
<tr class="tblsubtitle" height="25">
<?php
 if ($selectedMonth!="ALL" && $startDate && $endDate){
?>
<th align="center" valign="middle" class="smalltblheading">Picked for Packing Qty</th>
<th align="center" valign="middle" class="smalltblheading">Pack Seed Qty</th>
<th align="center" valign="middle" class="smalltblheading">Packing Loss</th>
<th align="center" valign="middle" class="smalltblheading">Packing Loss %</th>
<?php }elseif ($selectedMonth=="ALL" && count($monthList)){ ?>
<?php
foreach ($monthList as $item){
?>
<th align="center" valign="middle" class="smalltblheading">Picked for Packing Qty</th>
<th align="center" valign="middle" class="smalltblheading">Pack Seed Qty</th>
<th align="center" valign="middle" class="smalltblheading">Packing Loss</th>
<th align="center" valign="middle" class="smalltblheading">Packing Loss %</th>
<?php }} ?>
</tr>
</thead>
<tbody>
<?php

if($selectedMonth!="ALL" && $startDate && $endDate)
{
	$srno=1; $x=0;
	
	$sql1="select distinct lotldg_crop from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP')  ";
	if($txtcrop!="ALL")
	{
		$sql1.=" and lotldg_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sql1.=" and lotldg_variety='".$txtvariety."'";
	}
		$sql1.=" order by lotldg_crop asc";
		//echo $sql;
	$sql_tbl_sub1=mysqli_query($link,$sql1) or die(mysqli_error($link));
	$subtbltot1=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub1))
	{
		
		$sql2="select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') ";
		$sql2.=" and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."'";
		if($txtvariety!="ALL")
		{
			$sql2.=" and lotldg_variety='".$txtvariety."'";
		}
			$sql2.=" order by lotldg_variety asc";
			//echo $sql;
		$sql_tbl_sub2=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbltot2=mysqli_num_rows($sql_tbl_sub2);
		while($row_tbl_sub2=mysqli_fetch_array($sql_tbl_sub2))
		{
			$sql3="select distinct packtype from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' order by packtype asc";
			$sql_tbl_sub3=mysqli_query($link,$sql3) or die(mysqli_error($link));
			$subtbltot3=mysqli_num_rows($sql_tbl_sub3);
			while($row_tbl_sub3=mysqli_fetch_array($sql_tbl_sub3))
			{
				$ups=$row_tbl_sub3['packtype'];
				$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropid='".$row_tbl_sub1['lotldg_crop']."' order by cropname Asc") or die(mysqli_error($link));
				$row_crop2=mysqli_fetch_array($sq_crop2);
				$crpsize=$row_crop2['seedsize'];
				$croptype=$row_crop2['croptype'];
				$crop=$row_crop2['cropname'];
				
				$sq_var2=mysqli_query($link,"select vt, popularname from tblvariety where varietyid='".$row_tbl_sub2['lotldg_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				$variety=$row_var2['popularname'];	
				$vtype=$row_var2['vt'];	
				$arrival_id='';
				$sql_srsub=mysqli_query($link,"select Distinct lotldg_id from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' and packtype='".$row_tbl_sub3['packtype']."' ") or die(mysqli_error($link));
				$tot_arr_home=mysqli_num_rows($sql_srsub);
				while($row_srsub=mysqli_fetch_array($sql_srsub))
				{
					if($arrival_id!=""){$arrival_id=$arrival_id.",".$row_srsub['lotldg_id'];} else {$arrival_id=$row_srsub['lotldg_id'];}
				}	
			
				$rawqty=0; $conqty=0; $totalpl=0; $totalplper=0;
				if($arrival_id!='')
				{
					$sql="select Distinct trtype from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' and packtype='".$row_tbl_sub3['packtype']."' and lotldg_id IN($arrival_id) ";
					//echo $sql;
					$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
					$subtbltot=mysqli_num_rows($sql_tbl_sub);
					while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
					{
						if($row_tbl_sub['trtype']=='PNPSLIP' || $row_tbl_sub['trtype']=='NSTPNPSLIP')
						{
							$sql_is=mysqli_query($link,"select pnpslipmain_id from tbl_pnpslipmain where  pnpslipmain_id IN($arrival_id) and pnpslipmain_crop='".$row_tbl_sub1['lotldg_crop']."' and pnpslipmain_variety='".$row_tbl_sub2['lotldg_variety']."' and pnpslipmain_tflag=1 order by pnpslipmain_id asc") or die(mysqli_error($link));
							while($row_is=mysqli_fetch_array($sql_is))
							{ 
								$sql_istbl=mysqli_query($link,"select sum(pnpslipsub_pickpqty), sum(pnpslipsub_packqty), sum(pnpslipsub_packloss), sum(pnpslipsub_packcc) from tbl_pnpslipsub where pnpslipmain_id='".$row_is['pnpslipmain_id']."' and pnpslipsub_ups='".$row_tbl_sub3['packtype']."' order by pnpslipsub_id asc") or die(mysqli_error($link)); 
								$t=mysqli_num_rows($sql_istbl);
								while($row_pnpsub=mysqli_fetch_array($sql_istbl))
								{ 
									$rawqty=$rawqty+$row_pnpsub[0]; 
									$totalpl=$totalpl+($row_pnpsub[2]+$row_pnpsub[3]); 
									$conqty=$conqty+$row_pnpsub[1]; 
								}	
							}
						}
						if($row_tbl_sub['trtype']=='PACKAGINGSLIP')
						{
							$sql_is=mysqli_query($link,"select packaging_id from tbl_rpspackaging where packaging_id IN($arrival_id) and packaging_crop='".$row_tbl_sub1['lotldg_crop']."' and packaging_variety='".$row_tbl_sub2['lotldg_variety']."' and packaging_upssize='".$row_tbl_sub3['packtype']."' and packaging_tflg=1 order by packaging_id asc") or die(mysqli_error($link));
							while($row_is=mysqli_fetch_array($sql_is))
							{ 
								$sql_istbl=mysqli_query($link,"select sum(packagingsub_extqty), sum(packagingsub_ccqty), sum(packagingsub_ccqty) from tbl_rpspackaging_sub where packaging_id='".$row_is['packaging_id']."' order by packagingsub_id asc") or die(mysqli_error($link)); 
								$t=mysqli_num_rows($sql_istbl);
								while($row_pnpsub=mysqli_fetch_array($sql_istbl))
								{ 
									$rawqty=$rawqty+$row_pnpsub[0]; 
									$totalpl=$totalpl+($row_pnpsub[1]+$row_pnpsub[2]); 
									$conqty=$conqty+($row_pnpsub[0]-($row_pnpsub[1]+$row_pnpsub[2])); 
								}	
							}
						}
						$x++;
					}
					$tot=$totalpl/$rawqty;
					if($tot>0)
					{
						$totalplper=round(($tot*100),3);
					}
				}
			//echo $rawqty." = ".$conqty." = ".$totalpl." = ".$totalplper."<br />";	
if($srno%2!=0)
{
?>			  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $croptype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $variety;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $ups;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $vtype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crpsize;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $rawqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $conqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $totalpl;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $totalplper;?> </td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $croptype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $variety;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $ups;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $vtype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crpsize;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $rawqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $conqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $totalpl;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $totalplper;?> </td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}


}
elseif ($selectedMonth=="ALL" && count($monthList)>0)
{
	$startDate2=$monthList[0]['start_date'];
	$endDate2=$monthList[11]['end_date'];
	$srno=1;$arrivalid=""; $x=0; $verty="";
	
	$sql1="select distinct lotldg_crop from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate2' and lotldg_trdate >= '$startDate2' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP')  ";
	if($txtcrop!="ALL")
	{
		$sql1.=" and lotldg_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sql1.=" and lotldg_variety='".$txtvariety."'";
	}
		$sql1.=" order by lotldg_crop asc";
		//echo $sql;
	$sql_tbl_sub1=mysqli_query($link,$sql1) or die(mysqli_error($link));
	$subtbltot1=mysqli_num_rows($sql_tbl_sub1);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub1))
	{
		
		$sql2="select distinct lotldg_variety from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate2' and lotldg_trdate >= '$startDate2' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') ";
		$sql2.=" and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."'";
		if($txtvariety!="ALL")
		{
			$sql2.=" and lotldg_variety='".$txtvariety."'";
		}
			$sql2.=" order by lotldg_variety asc";
			//echo $sql;
		$sql_tbl_sub2=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbltot2=mysqli_num_rows($sql_tbl_sub2);
		while($row_tbl_sub2=mysqli_fetch_array($sql_tbl_sub2))
		{
			$sql3="select distinct packtype from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate2' and lotldg_trdate >= '$startDate2' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' order by packtype asc";
			$sql_tbl_sub3=mysqli_query($link,$sql3) or die(mysqli_error($link));
			$subtbltot3=mysqli_num_rows($sql_tbl_sub3);
			while($row_tbl_sub3=mysqli_fetch_array($sql_tbl_sub3))
			{
				$ups=$row_tbl_sub3['packtype'];
			
				$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropid='".$row_tbl_sub1['lotldg_crop']."' order by cropname Asc") or die(mysqli_error($link));
				$row_crop2=mysqli_fetch_array($sq_crop2);
				$crpsize=$row_crop2['seedsize'];
				$croptype=$row_crop2['croptype'];
				$crop=$row_crop2['cropname'];
				
				$sq_var2=mysqli_query($link,"select vt, popularname from tblvariety where varietyid='".$row_tbl_sub2['lotldg_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				$variety=$row_var2['popularname'];	
				$vtype=$row_var2['vt'];	
	?>
	<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $croptype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $variety;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $ups;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $vtype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crpsize;?> </td>
	<?php
	$srno=$srno+1;$x=0;  $ac='';

	foreach ($monthList as $item){
		
		$startDate=$item['start_date'];
		$endDate=$item['end_date'];
		$arrival_id=''; $ac='';
		
		$arrival_id='';
		$sql_srsub=mysqli_query($link,"select Distinct lotldg_id from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' and packtype='".$row_tbl_sub3['packtype']."' ") or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_srsub);
		while($row_srsub=mysqli_fetch_array($sql_srsub))
		{
			if($arrival_id!=""){$arrival_id=$arrival_id.",".$row_srsub['lotldg_id'];} else {$arrival_id=$row_srsub['lotldg_id'];}
		}	
	
		$rawqty=0; $conqty=0; $totalpl=0; $totalplper=0;
		if($arrival_id!='')
		{
			$sql="select Distinct trtype from tbl_lot_ldg_pack where lotldg_trdate <= '$endDate' and lotldg_trdate >= '$startDate' and plantcode='$plantcode' and (trtype='PNPSLIP' or trtype='NSTPNPSLIP' or trtype='PACKRV' or trtype='PACKAGINGSLIP') and lotldg_crop='".$row_tbl_sub1['lotldg_crop']."' and lotldg_variety='".$row_tbl_sub2['lotldg_variety']."' and packtype='".$row_tbl_sub3['packtype']."' and lotldg_id IN($arrival_id) ";
			//echo $sql;
			$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				if($row_tbl_sub['trtype']=='PNPSLIP' || $row_tbl_sub['trtype']=='NSTPNPSLIP')
				{
					$sql_is=mysqli_query($link,"select pnpslipmain_id from tbl_pnpslipmain where  pnpslipmain_id IN($arrival_id) and pnpslipmain_crop='".$row_tbl_sub1['lotldg_crop']."' and pnpslipmain_variety='".$row_tbl_sub2['lotldg_variety']."' and pnpslipmain_tflag=1 order by pnpslipmain_id asc") or die(mysqli_error($link));
					while($row_is=mysqli_fetch_array($sql_is))
					{ 
						$sql_istbl=mysqli_query($link,"select sum(pnpslipsub_pickpqty), sum(pnpslipsub_packqty), sum(pnpslipsub_packloss), sum(pnpslipsub_packcc) from tbl_pnpslipsub where pnpslipmain_id='".$row_is['pnpslipmain_id']."' and pnpslipsub_ups='".$row_tbl_sub3['packtype']."' order by pnpslipsub_id asc") or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						while($row_pnpsub=mysqli_fetch_array($sql_istbl))
						{ 
							$rawqty=$rawqty+$row_pnpsub[0]; 
							$totalpl=$totalpl+($row_pnpsub[2]+$row_pnpsub[3]); 
							$conqty=$conqty+$row_pnpsub[1]; 
						}	
					}
				}
				if($row_tbl_sub['trtype']=='PACKAGINGSLIP')
				{
					$sql_is=mysqli_query($link,"select packaging_id from tbl_rpspackaging where packaging_id IN($arrival_id) and packaging_crop='".$row_tbl_sub1['lotldg_crop']."' and packaging_variety='".$row_tbl_sub2['lotldg_variety']."' and packaging_upssize='".$row_tbl_sub3['packtype']."' and packaging_tflg=1 order by packaging_id asc") or die(mysqli_error($link));
					while($row_is=mysqli_fetch_array($sql_is))
					{ 
						$sql_istbl=mysqli_query($link,"select sum(packagingsub_extqty), sum(packagingsub_ccqty), sum(packagingsub_ccqty) from tbl_rpspackaging_sub where packaging_id='".$row_is['packaging_id']."' order by packagingsub_id asc") or die(mysqli_error($link)); 
						$t=mysqli_num_rows($sql_istbl);
						while($row_pnpsub=mysqli_fetch_array($sql_istbl))
						{ 
							$rawqty=$rawqty+$row_pnpsub[0]; 
							$totalpl=$totalpl+($row_pnpsub[1]+$row_pnpsub[2]); 
							$conqty=$conqty+($row_pnpsub[0]-($row_pnpsub[1]+$row_pnpsub[2])); 
						}	
					}
				}
				$x++;
			}
			$tot=$totalpl/$rawqty;
			if($tot>0)
			{
				$totalplper=round(($tot*100),3);
			}
		}
	//echo $rawqty." = ".$conqty." = ".$totalpl." = ".$totalplper."<br />";	
?>			  
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $rawqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $conqty;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $totalpl;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $totalplper;?> </td>
<?php
	}
?>
</tr>
<?php
}
}
}
}
?>
</tbody>
</table>	
</div>		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_monthlypacking.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="excelmonthlydpacking.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&financial_year=<?php echo $_REQUEST['financial_year'];?>&month=<?php echo $_REQUEST['month'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtplant=<?php echo $_REQUEST['txtplant'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a><!--&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />-->
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
<script>
$(document).ready(function() {
var table = $('#example').DataTable( {
scrollY:        "300px",
scrollX:        true,
scrollCollapse: true,
paging:         false,
searching: false,
ordering:  false,
fixedHeader: true,

} );
} );
</script>
</body>
</html>
