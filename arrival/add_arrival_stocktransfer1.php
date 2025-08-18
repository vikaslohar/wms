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
	
/*$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrtrflag=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['arrival_id'];	
	
	$s_sub="delete from tblarrival_sub where arrival_id='".$arrival_id."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	$s_sub_sub="delete from tblarr_sloc where arr_tr_id='".$arrival_id."'";
	mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));
	
}

	$s_sub="delete from tblarrival where arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrtrflag=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));*/	

if(isset($_REQUEST['ep_id']))
{
	$epid = $_REQUEST['ep_id'];
}
if(isset($_REQUEST['ctrid']))
{
	$ctrid = $_REQUEST['ctrid'];
}
	
	/*$sql_arr=mysqli_query($link,"select * from tbl_arrpack where stlotimpp_id='".$epid."' and arrpack_arrtrflg=0") or die(mysqli_error($link));
	$row_arr=mysqli_fetch_array($sql_arr);
	$tid=$row_arr['arrpack_id'];*/
	//echo "select * from tbl_arrpack where arrpack_logid='".$logid."' and arrpack_arrtrflg=0 ";
	
$sql_tbl=mysqli_query($link,"select * from tbl_arrpack where arrpack_logid='".$logid."' and arrpack_arrtrflg=0 and plantcode='$plantcode' ") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['arrpack_id'];
	//echo "select * from tbl_arrpack_sub where arrpack_id='".$arrival_id."' order by arrpacks_id";
	$sql_arrsub=mysqli_query($link,"select * from tbl_arrpack_sub where arrpack_id='".$arrival_id."' and plantcode='$plantcode' order by arrpacks_id") or die(mysqli_error($link));
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
	//echo "select * from tbl_stlotimp_pack_sub where stlotimpp_id='".$row_tbl['stlotimpp_id']."' and stlotimpp_lotno='".$row_arrsub['arrpacks_lotno']."' ";
		$sql_sub=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpp_id='".$row_tbl['stlotimpp_id']."' and stlotimpp_lotno='".$row_arrsub['arrpacks_lotno']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
		while($row_sub=mysqli_fetch_array($sql_sub))
		{
			$nop=$row_sub['stlotimpp_nop'];
			$loosenop=$row_sub['stlotimpp_loosenop'];
			$nomp=$row_sub['stlotimpp_nomp'];
			$qty=$row_sub['stlotimpp_qty'];

			$arrnop=$row_sub['stlotimpp_arrnop'];
			$arrloosenop=$row_sub['stlotimpp_arrloosenop'];
			$arrnomp=$row_sub['stlotimpp_arrnomp'];
			$arrqty=$row_sub['stlotimpp_arrqty'];
	
			//$arrnop=$arrnop-$row_arrsub['arrpacks_nop'];
			//$arrloosenop=$arrloosenop-$row_arrsub['arrpacks_loosenop'];
			//$arrnomp=$arrnomp-$row_arrsub['arrpacks_nomp'];
			//$arrqty=$arrqty-$row_arrsub['arrpacks_qty'];
			//$balloosenop=$loosenop;
			$balnop=$nop;
			$balloosenop=$loosenop;
			$balnomp=$nomp;
			$balqty=$qty;
			
	 		$sql_impsub="update tbl_stlotimp_pack_sub set stlotimpp_arrnop=NULL, stlotimpp_arrloosenop=NULL, stlotimpp_arrnomp=NULL, stlotimpp_arrqty=NULL, stlotimpp_balnop='$balnop', stlotimpp_balloosenop='$balloosenop', stlotimpp_balnomp='$balnomp', stlotimpp_balqty='$balqty' where stlotimpp_id='".$row_tbl['stlotimpp_id']."' and stlotimpp_lotno='".$row_arrsub['arrpacks_lotno']."' ";
			mysqli_query($link,$sql_impsub) or die(mysqli_error($link));
			//exit;
			
		}
	}

	$delete_barcode="delete from tbl_arrpack_barcode where arrpack_id='".$arrival_id."' and plantcode='$plantcode' ";
	mysqli_query($link,$delete_barcode) or die(mysqli_error($link));
	
	$delete_sub="delete from tbl_arrpack_sub where arrpack_id='".$arrival_id."' and plantcode='$plantcode' ";
	mysqli_query($link,$delete_sub) or die(mysqli_error($link));
	
	$delete_subsub="delete from tbl_arrpack_subsub where arrpack_id='".$arrival_id."' or arrpack_id=0 and plantcode='$plantcode' ";
	mysqli_query($link,$delete_subsub) or die(mysqli_error($link)); 
			
	$delete_main="delete from tbl_arrpack where arrpack_id='".$arrival_id."' and plantcode='$plantcode' ";
	mysqli_query($link,$delete_main) or die(mysqli_error($link));
	
}
//exit;		
	if(isset($_POST['frm_action'])=='submit')
	{
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
		//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='add_arrival_stocktransfer11.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='add_arrival_stocktransfer1.php'</script>";
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction -Arrival Pack Seed Stock Transfer-Plant</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
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

function openslocpopprint(tid)
{
winHandle=window.open('packstocknote.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}


function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.edate,dt,document.frmaddDept.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 	
function mySubmit()
{	
	dt1=getDateObject(document.frmaddDept.sdate.value,"-");
	dt2=getDateObject(document.frmaddDept.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
return true;
}

function openslocpopprint(itm)
{
//var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('packstocknote.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">


		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="950" class="Mainheading" height="25">
	  <table width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="950" height="25">&nbsp;Transaction - Arrival Pack Seed Stock Transfer - Plant</td>
	    </tr></table></td>
	 <!-- <td width="80" height="25" align="right" class="submenufont">
	  <table border="3" align="right" bordercolor="#F1B01E" bordercolordark="#F1B01E" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_arrival_packstocktransfer.php" style="text-decoration:none; color:#000000">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#000000">Add </a><?php } ?></td>
</tr>
</table></td>-->
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php

$sql_arr_home=mysqli_query($link,"select * from tbl_stlotimp_pack where stlotimpp_trflg!=1 and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>


<!--- Table Place Holder --->
<!--<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#F1B01E" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20"><td colspan="10" align="center" class="subheading">Search Transactions</td></tr>
  <tr class="Light" height="25">
  <td width="76" class="tblheading" align="right">&nbsp;Start Date&nbsp;</td>
  <td width="152" align="left">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('sdate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a></td>
  
  <td width="78" class="tblheading" align="right">&nbsp;End Date&nbsp;</td>
  <td width="147" align="left">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar('edate')" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a></td>

  <td width="135" class="tblheading" align="center"><input type="image" src="../images/search.gif" border="0"  /></td>
  </tr>
  </table><br/>-->
<?php
$targetpage = $_SERVER['PHP_SELF']; 
	$adjacents = 2;
	$limit = 10; 								
	if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		//echo "select * from tbl_stlotimp_pack where stlotimpp_trflg!=1 order by stlotimpp_stdndate desc, stlotimpp_stdnno desc LIMIT $start, $limit";
  $sql_arr_home=mysqli_query($link,"select * from tbl_stlotimp_pack where stlotimpp_trflg!=1 and plantcode='$plantcode' order by stlotimpp_stdndate desc, stlotimpp_stdnno desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_stlotimp_pack where stlotimpp_trflg!=1 and plantcode='$plantcode' order by stlotimpp_stdndate desc, stlotimpp_stdnno desc";
$total_pages = mysqli_num_rows(mysqli_query($link,$query));
//echo	$total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\"> previous </a> ";
		else
			$pagination.= " <span class=\"disabled\"> previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\"> next </a> ";
		else
			$pagination.= " <span class=\"disabled\"> next </span> ";
		$pagination.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrtrflag=1"),0);
 $srno=($page-1)*$limit+1;
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;} 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and arrtrflag=1 order by arrival_date desc, arr_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrival_type='StockTransfer Arrival' and arrtrflag=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
*/
//$tot_arr_home=0;
if($tot_arr_home >0) 
{ 
?>

<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Stock Transfer From Plant </td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#F1B01E" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			   <!--<td width="6%" align="center" valign="middle" class="tblheading">Date</td>
			 <td width="10%" align="center" valign="middle" class="tblheading">Transaction Id</td>-->
              <td width="10%" align="center" valign="middle" class="tblheading">Stock Transfer from Plant</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="8%" align="center" valign="middle" class="tblheading">UPS</td>
			  <td width="4%" align="center" valign="middle" class="tblheading">NoP</td>
              <td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="4%" align="center" valign="middle" class="tblheading">Arr. NoP</td>
              <td width="5%" align="center" valign="middle" class="tblheading">Arr. NoMP</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Arr. Qty</td>
			  <td width="4%" align="center" valign="middle" class="tblheading">Bal NoP</td>
              <td width="4%" align="center" valign="middle" class="tblheading">Bal NoMP</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Bal Qty</td>
              <td align="center" valign="middle" class="tblheading">Status</td>
              </tr>
<?php
//$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$arrid=0;
	$trdate=$row_arr_home['stlotimpp_stdndate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	//echo "select * from tbl_arrpack where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and arrpack_arrtrflg!=1 ";
	$sql_arr1=mysqli_query($link,"select * from tbl_arrpack where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and arrpack_arrtrflg!=1 and plantcode='$plantcode' ") or die(mysqli_error($link));
	$tot_arr1=mysqli_num_rows($sql_arr1);
	$row_arr1=mysqli_fetch_array($sql_arr1);
	if($tot_arr1>0)
		$arrid=$row_arr1['arrpack_id'];
	
	$arrival_id=$row_arr_home['stlotimpp_id'];
	$fplant=$row_arr_home['stlotimpp_plantname'];
	//echo "select distinct stlotimpp_lotno from tbl_stlotimp_pack_sub where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' order by stlotimpps_id asc";
	$sql_tbl=mysqli_query($link,"select distinct stlotimpp_lotno from tbl_stlotimp_pack_sub where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and plantcode='$plantcode' order by stlotimpps_id asc") or die(mysqli_error($link));
	
	$crop=""; $variety=""; $lotno=""; $ups=""; $nop=''; $nomp=""; $qty=""; $stage=""; $got=""; $qc=""; $got1="";
	$arrnop=""; $arrnomp=""; $arrqty=""; $balnop=""; $balnomp=""; $balqty=""; 
	while($row_tbl=mysqli_fetch_array($sql_tbl))
	{//echo "select * from tbl_stlotimp_pack_sub where stlotimpp_lotno='".$row_tbl['stlotimpp_lotno']."' and stlotimpp_id='".$row_arr_home['stlotimpp_id']."' order by stlotimpps_id asc";
		$sql_tbl1=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpp_lotno='".$row_tbl['stlotimpp_lotno']."' and stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and plantcode='$plantcode' order by stlotimpps_id asc") or die(mysqli_error($link));
		while($row_tbl1=mysqli_fetch_array($sql_tbl1))
		{	
			//$lrole=$row_arr_home['arr_role'];
		
			$aq=explode(".",$row_tbl1['stlotimpp_balqty']);
			if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl1['stlotimpp_balqty'];}
			
			if($crop=="")
				$crop=$row_tbl1['stlotimpp_crop'];
			else
				$crop=$crop."<br />".$row_tbl1['stlotimpp_crop'];
			
			if($variety=="")	
				$variety=$row_tbl1['stlotimpp_variety'];	
			else
				$variety=$variety."<br />".$row_tbl1['stlotimpp_variety'];
			
			if($lotno=="")	
				$lotno=$row_tbl1['stlotimpp_lotno'];
			else
				$lotno=$lotno."<br />".$row_tbl1['stlotimpp_lotno'];
				
			if($ups=="")	
				$ups=$row_tbl1['stlotimpp_ups'];
			else
				$ups=$ups."<br />".$row_tbl1['stlotimpp_ups'];
			
			if($nop=="")	
				$nop=$row_tbl1['stlotimpp_nop'];
			else
				$nop=$nop."<br />".$row_tbl1['stlotimpp_nop'];
			
			if($nomp=="")	
				$nomp=$row_tbl1['stlotimpp_nomp'];
			else
				$nomp=$nomp."<br />".$row_tbl1['stlotimpp_nomp'];
			
			if($qty=="")	
				$qty=$row_tbl1['stlotimpp_qty'];
			else
				$qty=$qty."<br />".$row_tbl1['stlotimpp_qty'];
				
			if($arrnop=="")
				$arrnop=$row_tbl1['stlotimpp_arrnop'];
			else
				$arrnop=$arrnop."<br />".$row_tbl1['stlotimpp_arrnop'];
			
			if($arrnomp=="")
				$arrnomp=$row_tbl1['stlotimpp_arrnomp'];
			else
				$arrnomp=$arrnomp."<br />".$row_tbl1['stlotimpp_arrnomp'];
				
			if($arrqty=="")
				$arrqty=$row_tbl1['stlotimpp_arrqty'];
			else
				$arrqty=$arrqty."<br />".$row_tbl1['stlotimpp_arrqty'];
				
			if($balnop=="")
				$balnop=$row_tbl1['stlotimpp_balnop'];
			else
				$balnop=$balnop."<br />".$row_tbl1['stlotimpp_balnop'];
				
			if($balnomp=="")
				$balnomp=$row_tbl1['stlotimpp_balnomp'];
			else
				$balnomp=$balnomp."<br />".$row_tbl1['stlotimpp_balnomp'];	
				
			if($balqty=="")
				$balqty=$row_tbl1['stlotimpp_balqty'];
			else
				$balqty=$balqty."<br />".$row_tbl1['stlotimpp_balqty'];			 
			
			$qc=$row_tbl1['qc'];
			$got=$row_tbl1['got']." ".$row_arr_home['got1'];
			$stage=$row_tbl1['sstage'];
				
			
			$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where stcode='".$row_arr_home['stlotimpp_plantcode']."'"); 
			$row3=mysqli_fetch_array($quer3);
			
			$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where  plantcode='$plantcode' ");
			$row_cls=mysqli_fetch_array($quer_cn);
			$city1=$row_cls['pcity'];
			$plname=$row_cls['company_name'];
		}
	}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="10%" align="center" valign="middle" class="smalltbltext"><?php echo $fplant;?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $nop?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $nomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $arrnop?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $arrnomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $arrqty?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnop?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty?></td>
	<!--<td width="8%" align="center" valign="middle" class="smalltbltext"><a href="add_arrival_packstocktransfer.php?ep_id=<?php echo $arrival_id;?>">Pending</a></td>-->
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php if($arrid==""){?><a href="add_arrival_packstocktransfer.php?ep_id=<?php echo $arrival_id;?>">Pending</a><?php }else{?><a href="edit_arrival_packstocktransfer.php?cropid=<?php echo $arrid;?>&ep_id=<?php echo $arrival_id;?>">Pending</a><?php }?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="10%" align="center" valign="middle" class="smalltbltext"><?php echo $row3['business_name'];?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $nop?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $nomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $arrnop?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $arrnomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $arrqty?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnop?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty?></td>
	<!--<td width="8%" align="center" valign="middle" class="smalltbltext"><a href="add_arrival_packstocktransfer.php?ep_id=<?php echo $arrival_id;?>">Pending</a></td>-->
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php if($arrid==""){?><a href="add_arrival_packstocktransfer.php?ep_id=<?php echo $arrival_id;?>">Pending</a><?php }else{?><a href="edit_arrival_packstocktransfer.php?cropid=<?php echo $arrid;?>&ep_id=<?php echo $arrival_id;?>">Pending</a><?php }?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
//}
//}
?>
</table>

<?php echo $pagination?><br />


<?php
$targetpage = $_SERVER['PHP_SELF']; 
	$adjacents = 2;
	$limit = 10; 								
	if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		//echo "select * from tbl_stlotimp_pack where stlotimpp_trflg!=1 order by stlotimpp_stdndate desc, stlotimpp_stdnno desc LIMIT $start, $limit";
  $sql_arr_home=mysqli_query($link,"select * from tbl_stlotimp_pack where stlotimpp_trflg=1 and plantcode='$plantcode' order by stlotimpp_stdndate desc, stlotimpp_stdnno desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_stlotimp_pack where stlotimpp_trflg=1 and plantcode='$plantcode' order by stlotimpp_stdndate desc, stlotimpp_stdnno desc";
$total_pages = mysqli_num_rows(mysqli_query($link,$query));
//echo	$total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\"> previous </a> ";
		else
			$pagination.= " <span class=\"disabled\"> previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\"> next </a> ";
		else
			$pagination.= " <span class=\"disabled\"> next </span> ";
		$pagination.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrtrflag=1"),0);
 $srno=($page-1)*$limit+1;
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;} 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and arrtrflag=1 order by arrival_date desc, arr_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrival_type='StockTransfer Arrival' and arrtrflag=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 
*/
//$tot_arr_home=0;
if($tot_arr_home >0) 
{ 
?>

<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Stock Transfer From Plant </td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#F1B01E" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			   <!--<td width="6%" align="center" valign="middle" class="tblheading">Date</td>
			 <td width="10%" align="center" valign="middle" class="tblheading">Transaction Id</td>-->
              <td width="10%" align="center" valign="middle" class="tblheading">Stock Transfer from Plant</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="8%" align="center" valign="middle" class="tblheading">UPS</td>
			  <td width="4%" align="center" valign="middle" class="tblheading">NoP</td>
              <td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="4%" align="center" valign="middle" class="tblheading">Arr. NoP</td>
              <td width="5%" align="center" valign="middle" class="tblheading">Arr. NoMP</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Arr. Qty</td>
			  <td width="4%" align="center" valign="middle" class="tblheading">Bal NoP</td>
              <td width="4%" align="center" valign="middle" class="tblheading">Bal NoMP</td>
			  <td width="7%" align="center" valign="middle" class="tblheading">Bal Qty</td>
              <td align="center" valign="middle" class="tblheading">Output</td>
              </tr>
<?php
//$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$arrid=0;
	$trdate=$row_arr_home['stlotimpp_stdndate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$sql_arr1=mysqli_query($link,"select * from tbl_arrpack where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and arrpack_arrtrflg=1 and plantcode='$plantcode' ") or die(mysqli_error($link));
	$tot_arr1=mysqli_num_rows($sql_arr1);
	$row_arr1=mysqli_fetch_array($sql_arr1);
	if($tot_arr1>0)
		$arrid=$row_arr1['arrpack_id'];
	
	$arrival_id=$row_arr_home['stlotimpp_id'];
	$fplant=$row_arr_home['stlotimpp_plantname'];
	//echo "select distinct stlotimpp_lotno from tbl_stlotimp_pack_sub where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' order by stlotimpps_id asc";
	$sql_tbl=mysqli_query($link,"select distinct stlotimpp_lotno from tbl_stlotimp_pack_sub where stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and plantcode='$plantcode' order by stlotimpps_id asc") or die(mysqli_error($link));
	
	$crop=""; $variety=""; $lotno=""; $ups=""; $nop=''; $nomp=""; $qty=""; $stage=""; $got=""; $qc=""; $got1="";
	$arrnop=""; $arrnomp=""; $arrqty=""; $balnop=""; $balnomp=""; $balqty=""; 
	while($row_tbl=mysqli_fetch_array($sql_tbl))
	{//echo "select * from tbl_stlotimp_pack_sub where stlotimpp_lotno='".$row_tbl['stlotimpp_lotno']."' and stlotimpp_id='".$row_arr_home['stlotimpp_id']."' order by stlotimpps_id asc";
		$sql_tbl1=mysqli_query($link,"select * from tbl_stlotimp_pack_sub where stlotimpp_lotno='".$row_tbl['stlotimpp_lotno']."' and stlotimpp_id='".$row_arr_home['stlotimpp_id']."' and plantcode='$plantcode' order by stlotimpps_id asc") or die(mysqli_error($link));
		while($row_tbl1=mysqli_fetch_array($sql_tbl1))
		{	
			//$lrole=$row_arr_home['arr_role'];
		
			$aq=explode(".",$row_tbl1['stlotimpp_balqty']);
			if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl1['stlotimpp_balqty'];}
			
			if($crop=="")
				$crop=$row_tbl1['stlotimpp_crop'];
			else
				$crop=$crop."<br />".$row_tbl1['stlotimpp_crop'];
			
			if($variety=="")	
				$variety=$row_tbl1['stlotimpp_variety'];	
			else
				$variety=$variety."<br />".$row_tbl1['stlotimpp_variety'];
			
			if($lotno=="")	
				$lotno=$row_tbl1['stlotimpp_lotno'];
			else
				$lotno=$lotno."<br />".$row_tbl1['stlotimpp_lotno'];
				
			if($ups=="")	
				$ups=$row_tbl1['stlotimpp_ups'];
			else
				$ups=$ups."<br />".$row_tbl1['stlotimpp_ups'];
			
			if($nop=="")	
				$nop=$row_tbl1['stlotimpp_nop'];
			else
				$nop=$nop."<br />".$row_tbl1['stlotimpp_nop'];
			
			if($nomp=="")	
				$nomp=$row_tbl1['stlotimpp_nomp'];
			else
				$nomp=$nomp."<br />".$row_tbl1['stlotimpp_nomp'];
			
			if($qty=="")	
				$qty=$row_tbl1['stlotimpp_qty'];
			else
				$qty=$qty."<br />".$row_tbl1['stlotimpp_qty'];
				
			if($arrnop=="")
				$arrnop=$row_tbl1['stlotimpp_arrnop'];
			else
				$arrnop=$arrnop."<br />".$row_tbl1['stlotimpp_arrnop'];
			
			if($arrnomp=="")
				$arrnomp=$row_tbl1['stlotimpp_arrnomp'];
			else
				$arrnomp=$arrnomp."<br />".$row_tbl1['stlotimpp_arrnomp'];
				
			if($arrqty=="")
				$arrqty=$row_tbl1['stlotimpp_arrqty'];
			else
				$arrqty=$arrqty."<br />".$row_tbl1['stlotimpp_arrqty'];
				
			if($balnop=="")
				$balnop=$row_tbl1['stlotimpp_balnop'];
			else
				$balnop=$balnop."<br />".$row_tbl1['stlotimpp_balnop'];
				
			if($balnomp=="")
				$balnomp=$row_tbl1['stlotimpp_balnomp'];
			else
				$balnomp=$balnomp."<br />".$row_tbl1['stlotimpp_balnomp'];	
				
			if($balqty=="")
				$balqty=$row_tbl1['stlotimpp_balqty'];
			else
				$balqty=$balqty."<br />".$row_tbl1['stlotimpp_balqty'];			 
			
			$qc=$row_tbl1['qc'];
			$got=$row_tbl1['got']." ".$row_arr_home['got1'];
			$stage=$row_tbl1['sstage'];
				
			
			$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where stcode='".$row_arr_home['stlotimpp_plantcode']."'"); 
			$row3=mysqli_fetch_array($quer3);
			
			$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
			$row_cls=mysqli_fetch_array($quer_cn);
			$city1=$row_cls['pcity'];
			$plname=$row_cls['company_name'];
		}
	}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="10%" align="center" valign="middle" class="smalltbltext"><?php echo $fplant;?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $nop?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $nomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $arrnop?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $arrnomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $arrqty?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnop?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty?></td>
	<!--<td width="8%" align="center" valign="middle" class="smalltbltext"><a href="add_arrival_packstocktransfer.php?ep_id=<?php echo $arrival_id;?>">Pending</a></td>-->
	<td width="8%" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $arrid;?>');">STRN</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="2%" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="10%" align="center" valign="middle" class="smalltbltext"><?php echo $row3['business_name'];?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $ups?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $nop?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $nomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $qty?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $arrnop?></td>
	<td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $arrnomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $arrqty?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnop?></td>
	<td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balnomp?></td>
	<td width="7%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty?></td>
	<!--<td width="8%" align="center" valign="middle" class="smalltbltext"><a href="add_arrival_packstocktransfer.php?ep_id=<?php echo $arrival_id;?>">Pending</a></td>-->
	<td width="8%" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $arrid;?>');">STRN</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
//}
//}
?>
</table>

<?php echo $pagination?>
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="select.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
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
