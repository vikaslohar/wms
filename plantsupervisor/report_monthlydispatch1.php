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
<title>Plant - Report - Financial Year wise Monthly Dispatch Report</title>

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
	      <td width="940" height="25">&nbsp; Financial Year wise Monthly Dispatch Report <?php if($plantcode=="D"){echo "Deorjhal Plant";} else if($plantcode=="B"){echo "Boriya Plant";} else {echo "";}?></td>
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
<th align="center" valign="middle" class="smalltblheading" >#</th>
<th align="center" valign="middle" class="smalltblheading" >Crop Type</th>
<th align="center" valign="middle" class="smalltblheading" >Crop</th>
<th align="center" valign="middle" class="smalltblheading" >Variety</th>
<th align="center" valign="middle" class="smalltblheading" >Type</th>
<th align="center" valign="middle" class="smalltblheading" > Size</th>
<?php
 if ($selectedMonth!="ALL" && $startDate && $endDate){
?>
<th align="center" valign="middle" class="smalltblheading" ><?php echo $selectedMonth;?></th>
<?php }elseif ($selectedMonth=="ALL" && count($monthList)){ ?>
<?php
foreach ($monthList as $item){
?>
<th align="center" valign="middle" class="smalltblheading" ><?php echo $item['month']; ?></th>
<?php }} ?>
</tr>

</thead>
<tbody>
<?php
//echo $selectedMonth." = ".$startDate." = ".$endDate;

if($selectedMonth!="ALL" && $startDate && $endDate)
{
	$srno=1; $dbulk_id=''; $x=0; $disp_id=''; $varietylist='';
	$sql_bulkm=mysqli_query($link,"select dbulk_id from tbl_dbulk where dbulk_date<='$endDate' and dbulk_date>='$startDate' and dbulk_tflg=1 and plantcode='$plantcode' order by dbulk_date asc ") or die(mysqli_error($link));
	$tot_bulkm=mysqli_num_rows($sql_bulkm);
	if($tot_bulkm > 0)
	{
		while($row_bulkm=mysqli_fetch_array($sql_bulkm))
		{
			if($dbulk_id!=""){$dbulk_id=$dbulk_id.",".$row_bulkm['dbulk_id'];} else {$dbulk_id=$row_bulkm['dbulk_id'];}
		}
	}
	
	$sql_dispm=mysqli_query($link,"select disp_id from tbl_disp where disp_dodc<='$endDate' and disp_dodc>='$startDate' and disp_tflg=1 and plantcode='$plantcode' order by disp_dodc asc ") or die(mysqli_error($link));
	$tot_dispm=mysqli_num_rows($sql_dispm);
	if($tot_dispm > 0)
	{
		while($row_dispm=mysqli_fetch_array($sql_dispm))
		{
			if($disp_id!=""){$disp_id=$disp_id.",".$row_dispm['disp_id'];} else {$disp_id=$row_dispm['disp_id'];}
		}
	}
	
	
	$sql1="select distinct dbulks_crop from tbl_dbulk_sub where dbulk_id IN($dbulk_id) ";
	$sql2="select distinct dpss_crop from tbl_dispsub_sub where disp_id IN($disp_id) ";
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql1.=" and dbulks_crop='".$row_crop['cropname']."'";
		$sql2.=" and dpss_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql1.=" and dbulks_variety='".$row_var['popularname']."'";
		$sql2.=" and dpss_variety='".$txtvariety."'";
	}
	$sql1.=" order by dbulks_crop asc";
	$sql2.=" order by dpss_crop asc";
		//echo $disp_id;
	if($dbulk_id!="")	
	{

		$sql_dbulks=mysqli_query($link,$sql1) or die(mysqli_error($link));
		$subtbldbulks=mysqli_num_rows($sql_dbulks);
		while($row_dbulks=mysqli_fetch_array($sql_dbulks))
		{
			$sql21="select distinct dbulks_variety from tbl_dbulk_sub where dbulk_id IN($dbulk_id) and dbulks_crop='".$row_dbulks['dbulks_crop']."'";
			if($txtvariety!="ALL")
			{
				$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
				$row_var=mysqli_fetch_array($sq_var);
				$sql21.=" and dbulks_variety='".$row_var['popularname']."'";
			}
			$sql21.=" order by dbulks_variety asc";
				//echo $sql;
			$sql_dbulks2=mysqli_query($link,$sql2) or die(mysqli_error($link));
			$subtbldbulks2=mysqli_num_rows($sql_dbulks21);
			while($row_dbulks2=mysqli_fetch_array($sql_dbulks2))
			{
				$sq_var2=mysqli_query($link,"select varietyid from tblvariety where popularname='".$row_dbulks2['dbulks_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				if($varietylist!="") {$varietylist=$varietylist.",".$row_var2['varietyid'];} else {$varietylist=$row_var2['varietyid'];}
			}
		}		
	}
	if($disp_id!="")	
	{
		$sql_disps=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbldisps=mysqli_num_rows($sql_disps);
		while($row_disps=mysqli_fetch_array($sql_disps))
		{
			$sql22="select distinct dpss_variety from tbl_dispsub_sub where disp_id IN($disp_id) and dpss_crop='".$row_disps['dpss_crop']."'";
			if($txtvariety!="ALL")
			{
				$sql22.=" and dpss_variety='".$txtvariety."'";
			}
			$sql22.=" order by dpss_variety asc";
				//echo $sql22;
			$sql_disps2=mysqli_query($link,$sql22) or die(mysqli_error($link));
			$subtbldisps2=mysqli_num_rows($sql_disps2);
			while($row_disps2=mysqli_fetch_array($sql_disps2))
			{
				if($varietylist!="") {$varietylist=$varietylist.",".$row_disps2['dpss_variety'];} else {$varietylist=$row_disps2['dpss_variety'];}
			}
		}	
	}
//echo $varietylist;
	if($varietylist!="")
	{
		$vartylist=explode(",",$varietylist);
		array_unique($vartylist);
		foreach($vartylist as $verlist)
		{
			$qty=0;
			if($dbulk_id!='')
		{
			$dbulksid='';
			$sql213="select dbulks_id, dbulks_crop, dbulks_variety from tbl_dbulk_sub where dbulk_id IN($dbulk_id)  ";
			
			$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sq_var);
			$sql213.=" and dbulks_variety='".$row_var['popularname']."'";
			
			$sql213.=" order by dbulks_variety asc";
				
			$sql_dbulks23=mysqli_query($link,$sql213) or die(mysqli_error($link));
			$subtbldbulks23=mysqli_num_rows($sql_dbulks23);
			while($row_dbulks23=mysqli_fetch_array($sql_dbulks23))
			{
				if($dbulksid!=""){$dbulksid=$dbulksid.",".$row_dbulks23['dbulks_id'];}else{$dbulksid=$row_dbulks23['dbulks_id'];}
				$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype FROM tblcrop where cropname='".$row_dbulks23['dbulks_crop']."' order by cropname Asc") or die(mysqli_error($link));
				$row_crop2=mysqli_fetch_array($sq_crop2);
				$crpsize=$row_crop2['seedsize'];
				$croptype=$row_crop2['croptype'];
				$sq_var2=mysqli_query($link,"select vt from tblvariety where popularname='".$row_dbulks23['dbulks_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				$crop=$row_tbl_sub1['lotcrop'];
				$variety=$row_tbl_sub2['lotvariety'];	
				$vtype=$row_var2['vt'];

			}

			$dblksid=explode(",",$dbulksid);
			array_unique($dblksid);
			$dblksid2=implode(",",$dblksid);
			if($dblksid2!=""){
				$sql="select SUM(dbss_qty) from tbl_dbulksub_sub where dbulks_id IN ($dblksid2) order by dbss_id asc";
				//f($row_dbulks23['dbulks_variety']=="Kajal") {echo $sql; echo "<br />";}
	
				$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
				$subtbltot=mysqli_num_rows($sql_tbl_sub);
				while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
				{
					$ac=0;
					$aq=explode(".",$row_tbl_sub[0]);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub[0];}
					$qty=$qty+$ac;
					//if($row_dbulks23['dbulks_variety']=="Kajal") {echo $dbulk_id." = ".$qty;echo "<br />";}
					$x++;
				}
			}
		}			
			//echo "select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc";
			$sq_var2=mysqli_query($link,"select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
			$row_var2=mysqli_fetch_array($sq_var2);
			$variety=$row_var2['popularname'];	
			$vtype=$row_var2['vt'];	

			$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropname='".$row_var2['cropid']."' ") or die(mysqli_error($link));
			$row_crop2=mysqli_fetch_array($sq_crop2);
			$crpsize=$row_crop2['seedsize'];
			$croptype=$row_crop2['croptype'];
			$crop=$row_crop2['cropname'];

			if($disp_id!="")
			{
				$sqls="select SUM(dpss_qty) from tbl_dispsub_sub where disp_id IN($disp_id) and dpss_variety='".$verlist."' order by dpss_crop, dpss_variety asc";
					//echo $sql;
				$sql_tbl_subs=mysqli_query($link,$sqls) or die(mysqli_error($link));
				$subtbltots=mysqli_num_rows($sql_tbl_subs);
				while($row_tbl_subs=mysqli_fetch_array($sql_tbl_subs))
				{
					$aq=explode(".",$row_tbl_subs[0]);
					if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_subs[0];}
					$qty=$qty+$ac;
					$x++;
				}
			}
			
if($srno%2!=0)
{
?>			  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $croptype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $variety;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $vtype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crpsize;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty;?> </td>
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
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $vtype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crpsize;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty;?> </td>
</tr>
<?php
}
$srno=$srno+1;
}
}



}
elseif ($selectedMonth=="ALL" && count($monthList)>0)
{
	$startDate2=$monthList[0]['start_date'];
	$endDate2=$monthList[11]['end_date'];
	$srno=1; $dbulk_id=''; $x=0; $disp_id=''; $varietylist='';
	$sql_bulkm=mysqli_query($link,"select dbulk_id from tbl_dbulk where dbulk_date<='$endDate2' and dbulk_date>='$startDate2' and dbulk_tflg=1 and plantcode='$plantcode' order by dbulk_date asc ") or die(mysqli_error($link));
	$tot_bulkm=mysqli_num_rows($sql_bulkm);
	if($tot_bulkm > 0)
	{
		while($row_bulkm=mysqli_fetch_array($sql_bulkm))
		{
			if($dbulk_id!=""){$dbulk_id=$dbulk_id.",".$row_bulkm['dbulk_id'];} else {$dbulk_id=$row_bulkm['dbulk_id'];}
		}
	}
	
	$sql_dispm=mysqli_query($link,"select disp_id from tbl_disp where disp_dodc<='$endDate2' and disp_dodc>='$startDate2' and disp_tflg=1 and plantcode='$plantcode' order by disp_dodc asc ") or die(mysqli_error($link));
	$tot_dispm=mysqli_num_rows($sql_dispm);
	if($tot_dispm > 0)
	{
		while($row_dispm=mysqli_fetch_array($sql_dispm))
		{
			if($disp_id!=""){$disp_id=$disp_id.",".$row_dispm['disp_id'];} else {$disp_id=$row_dispm['disp_id'];}
		}
	}
	
	
	$sql1="select distinct dbulks_crop from tbl_dbulk_sub where dbulk_id IN($dbulk_id) ";
	$sql2="select distinct dpss_crop from tbl_dispsub_sub where disp_id IN($disp_id) ";
	if($txtcrop!="ALL")
	{
		$sq_crop=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$txtcrop' order by cropname Asc") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sq_crop);
		$sql1.=" and dbulks_crop='".$row_crop['cropname']."'";
		$sql2.=" and dpss_crop='".$txtcrop."'";
	}
	if($txtvariety!="ALL")
	{
		$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sq_var);
		$sql1.=" and dbulks_variety='".$row_var['popularname']."'";
		$sql2.=" and dpss_variety='".$txtvariety."'";
	}
	$sql1.=" order by dbulks_crop asc";
	$sql2.=" order by dpss_crop asc";
		//echo $disp_id;
	if($dbulk_id!="")	
	{
		$sql_dbulks=mysqli_query($link,$sql1) or die(mysqli_error($link));
		$subtbldbulks=mysqli_num_rows($sql_dbulks);
		while($row_dbulks=mysqli_fetch_array($sql_dbulks))
		{
			$sql21="select distinct dbulks_variety from tbl_dbulk_sub where dbulk_id IN($dbulk_id) and dbulks_crop='".$row_dbulks['dbulks_crop']."'";
			if($txtvariety!="ALL")
			{
				$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$txtvariety."' order by popularname Asc") or die(mysqli_error($link));
				$row_var=mysqli_fetch_array($sq_var);
				$sql21.=" and dbulks_variety='".$row_var['popularname']."'";
			}
			$sql21.=" order by dbulks_variety asc";
				//echo $sql;
			$sql_dbulks2=mysqli_query($link,$sql2) or die(mysqli_error($link));
			$subtbldbulks2=mysqli_num_rows($sql_dbulks21);
			while($row_dbulks2=mysqli_fetch_array($sql_dbulks2))
			{
				$sq_var2=mysqli_query($link,"select varietyid from tblvariety where popularname='".$row_dbulks2['dbulks_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				if($varietylist!="") {$varietylist=$varietylist.",".$row_var2['varietyid'];} else {$varietylist=$row_var2['varietyid'];}
			}
		}		
	}
	if($disp_id!="")	
	{
		$sql_disps=mysqli_query($link,$sql2) or die(mysqli_error($link));
		$subtbldisps=mysqli_num_rows($sql_disps);
		while($row_disps=mysqli_fetch_array($sql_disps))
		{
			$sql22="select distinct dpss_variety from tbl_dispsub_sub where disp_id IN($disp_id) and dpss_crop='".$row_disps['dpss_crop']."'";
			if($txtvariety!="ALL")
			{
				$sql22.=" and dpss_variety='".$txtvariety."'";
			}
			$sql22.=" order by dpss_variety asc";
				//echo $sql22;
			$sql_disps2=mysqli_query($link,$sql22) or die(mysqli_error($link));
			$subtbldisps2=mysqli_num_rows($sql_disps2);
			while($row_disps2=mysqli_fetch_array($sql_disps2))
			{
				if($varietylist!="") {$varietylist=$varietylist.",".$row_disps2['dpss_variety'];} else {$varietylist=$row_disps2['dpss_variety'];}
			}
		}	
	}
//echo $varietylist;
	if($varietylist!="")
	{
		$vartylist=explode(",",$varietylist);
		array_unique($vartylist);
		foreach($vartylist as $verlist)
		{
			//echo "select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc";
			$sq_var2=mysqli_query($link,"select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
			$row_var2=mysqli_fetch_array($sq_var2);
			$variety=$row_var2['popularname'];	
			$vtype=$row_var2['vt'];	

			$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropname='".$row_var2['cropid']."' ") or die(mysqli_error($link));
			$row_crop2=mysqli_fetch_array($sq_crop2);
			$crpsize=$row_crop2['seedsize'];
			$croptype=$row_crop2['croptype'];
			$crop=$row_crop2['cropname'];
			
			
	?>
	<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $srno;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $croptype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crop;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $variety;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $vtype;?> </td>
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $crpsize;?> </td>
	<?php
	$srno=$srno+1;$x=0;  $ac='';

	foreach ($monthList as $item){
		
		$startDate=$item['start_date'];
		$endDate=$item['end_date'];
		
		$dbulk_id=''; $x=0; $disp_id=''; $varietylist='';

		$sql_bulkm=mysqli_query($link,"select dbulk_id from tbl_dbulk where dbulk_date<='$endDate' and dbulk_date>='$startDate' and dbulk_tflg=1 and plantcode='$plantcode' order by dbulk_date asc ") or die(mysqli_error($link));
		$tot_bulkm=mysqli_num_rows($sql_bulkm);

		if($tot_bulkm > 0)
		{
			while($row_bulkm=mysqli_fetch_array($sql_bulkm))
			{
				if($dbulk_id!=""){$dbulk_id=$dbulk_id.",".$row_bulkm['dbulk_id'];} else {$dbulk_id=$row_bulkm['dbulk_id'];}
				//echo $dbulk_id;
			}
		}
		
		$sql_dispm=mysqli_query($link,"select disp_id from tbl_disp where disp_dodc<='$endDate' and disp_dodc>='$startDate' and disp_tflg=1 and plantcode='$plantcode' order by disp_dodc asc ") or die(mysqli_error($link));
		$tot_dispm=mysqli_num_rows($sql_dispm);
		if($tot_dispm > 0)
		{
			while($row_dispm=mysqli_fetch_array($sql_dispm))
			{
				if($disp_id!=""){$disp_id=$disp_id.",".$row_dispm['disp_id'];} else {$disp_id=$row_dispm['disp_id'];}
			}
		}
	
	//echo $dbulk_id;
	
		$qty=0;
		if($dbulk_id!='')
		{
			$dbulksid='';
			$sql213="select dbulks_id, dbulks_crop, dbulks_variety from tbl_dbulk_sub where dbulk_id IN($dbulk_id)  ";
			
			$sq_var=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
			$row_var=mysqli_fetch_array($sq_var);
			$sql213.=" and dbulks_variety='".$row_var['popularname']."'";
			
			$sql213.=" order by dbulks_variety asc";
				
			$sql_dbulks23=mysqli_query($link,$sql213) or die(mysqli_error($link));
			$subtbldbulks23=mysqli_num_rows($sql_dbulks23);
			while($row_dbulks23=mysqli_fetch_array($sql_dbulks23))
			{
				if($dbulksid!=""){$dbulksid=$dbulksid.",".$row_dbulks23['dbulks_id'];}else{$dbulksid=$row_dbulks23['dbulks_id'];}
				$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype FROM tblcrop where cropname='".$row_dbulks23['dbulks_crop']."' order by cropname Asc") or die(mysqli_error($link));
				$row_crop2=mysqli_fetch_array($sq_crop2);
				$crpsize=$row_crop2['seedsize'];
				$croptype=$row_crop2['croptype'];
				$sq_var2=mysqli_query($link,"select vt from tblvariety where popularname='".$row_dbulks23['dbulks_variety']."' order by popularname Asc") or die(mysqli_error($link));
				$row_var2=mysqli_fetch_array($sq_var2);
				$crop=$row_tbl_sub1['lotcrop'];
				$variety=$row_tbl_sub2['lotvariety'];	
				$vtype=$row_var2['vt'];

			}

			$dblksid=explode(",",$dbulksid);
			array_unique($dblksid);
			$dblksid2=implode(",",$dblksid);
			if($dblksid2!=""){
			$sql="select SUM(dbss_qty) from tbl_dbulksub_sub where dbulks_id IN ($dblksid2) order by dbss_id asc";
			//f($row_dbulks23['dbulks_variety']=="Kajal") {echo $sql; echo "<br />";}

			$sql_tbl_sub=mysqli_query($link,$sql) or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
			{
				$ac=0;
				$aq=explode(".",$row_tbl_sub[0]);
				if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub[0];}
				$qty=$qty+$ac;
				//if($row_dbulks23['dbulks_variety']=="Kajal") {echo $dbulk_id." = ".$qty;echo "<br />";}
				$x++;
			}
			}
		}
		
		//echo "select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc";
		$sq_var2=mysqli_query($link,"select vt, cropid, popularname from tblvariety where varietyid='".$verlist."' order by popularname Asc") or die(mysqli_error($link));
		$row_var2=mysqli_fetch_array($sq_var2);
		$variety=$row_var2['popularname'];	
		$vtype=$row_var2['vt'];	

		$sq_crop2=mysqli_query($link,"SELECT seedsize, croptype, cropname FROM tblcrop where cropname='".$row_var2['cropid']."' ") or die(mysqli_error($link));
		$row_crop2=mysqli_fetch_array($sq_crop2);
		$crpsize=$row_crop2['seedsize'];
		$croptype=$row_crop2['croptype'];
		$crop=$row_crop2['cropname'];

		if($disp_id!="")
		{
			$sqls="select SUM(dpss_qty) from tbl_dispsub_sub where disp_id IN($disp_id) and dpss_variety='".$verlist."' order by dpss_crop, dpss_variety asc";
				//echo $sql;
			$sql_tbl_subs=mysqli_query($link,$sqls) or die(mysqli_error($link));
			$subtbltots=mysqli_num_rows($sql_tbl_subs);
			while($row_tbl_subs=mysqli_fetch_array($sql_tbl_subs))
			{
				$aq=explode(".",$row_tbl_subs[0]);
				if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_subs[0];}
				$qty=$qty+$ac;
				$x++;
			}
		}
?>			  
	<td align="center" valign="middle" class="smalltbltext"> <?php echo $qty;?> </td>
<?php
	}
?>
</tr>
<?php
}
}
}
?>
</tbody>
</table>	
</div>		
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_monthlydispatch.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="excelmonthlydispatch.php?txtcrop=<?php echo $_REQUEST['txtcrop'];?>&financial_year=<?php echo $_REQUEST['financial_year'];?>&month=<?php echo $_REQUEST['month'];?>&txtvariety=<?php echo $_REQUEST['txtvariety'];?>&txtplant=<?php echo $_REQUEST['txtplant'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a><!--&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />-->
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
        fixedColumns:   {
            left: 6
        }
    } );
} );
</script>
</body>
</html>
