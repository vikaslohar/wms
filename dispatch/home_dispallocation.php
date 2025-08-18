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
 
	//date_default_timezone_set('Asia/Calcutta');
	//echo date("d-m-Y h:i:s A");
	  
	$sq=mysqli_query($link,"Select * from tbl_dalloc where plantcode='".$plantcode."' and  dalloc_tflg=0 and dalloc_logid='$logid'") or die(mysqli_error($link));
	while($ro=mysqli_fetch_array($sq))
	{
		$arid=$ro['dalloc_id'];
		
		$s_sub="delete from tbl_dalloc_sub where dalloc_id='".$arid."'";
			mysqli_query($link,$s_sub) or die(mysqli_error($link));	
		$s_sub1="delete from tbl_dallocsub_sub where dalloc_id='".$arid."'";
			mysqli_query($link,$s_sub1) or die(mysqli_error($link));	
		$s_sub2="delete from tbl_dallocsub_sub2 where dalloc_id='".$arid."'";
			mysqli_query($link,$s_sub2) or die(mysqli_error($link));	
		$s_sub3="delete from tbl_dallocsub_sub3 where dalloc_id='".$arid."'";
			mysqli_query($link,$s_sub3) or die(mysqli_error($link));	
		$s_sub4="delete from tbl_dallocsub_sub4 where dalloc_id='".$arid."'";
			mysqli_query($link,$s_sub4) or die(mysqli_error($link));	
		$s_sub5="delete from tbl_dallocmmc where dalloc_id='".$arid."'";
			mysqli_query($link,$s_sub5) or die(mysqli_error($link));	
		$s_sub6="delete from tbl_dallocbarc_temp where dalloc_id='".$arid."' and barc_logid='$logid'";
			mysqli_query($link,$s_sub6) or die(mysqli_error($link));	
	}
	
	$ssub="delete from tbl_dalloc where dalloc_logid='".$logid."' and dalloc_tflg=0";
	mysqli_query($link,$ssub) or die(mysqli_error($link));	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		echo "<script>window.location='home_p2c.php'</script>";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch Allocation - Home</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
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

function openslocpopprint(tid)
{
	winHandle=window.open('p2c_note.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}
/*function openpackdetails(tid)
{
winHandle=window.open('packdetails_home.php?itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}*/

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
	return false;
}
 
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="820" height="25">&nbsp;Transaction - Dispatch Allocation</td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#378b8b" bordercolordark="#378b8b" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_dispatch.php" style="text-decoration:none; color:#000000">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#000000">Add </a><?php } ?></td>
</tr>
</table></td>
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="10">	 </td><td>

<!--<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#378b8b" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20"><td colspan="10" align="center" class="subheading">Search Transactions</td></tr>
  <tr class="Light" height="25">
  <td width="76" class="tblheading" align="right">&nbsp;Start Date&nbsp;</td>
  <td width="152" align="left">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDept.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
  
  <td width="78" class="tblheading" align="right">&nbsp;End Date&nbsp;</td>
  <td width="147" align="left">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDept.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>

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
		
  $sql_arr_home=mysqli_query($link,"select * from tbl_dalloc where plantcode='".$plantcode."' and  dalloc_tflg!=0 and dalloc_dflg!=1 order by dalloc_id DESC LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_dalloc where plantcode='".$plantcode."' and  dalloc_tflg!=0 and dalloc_dflg!=1 order by dalloc_id DESC";
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
			$pagination.= " <a href=\"$targetpage?page=$prev\">&laquo; Previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">&laquo; Previous </span> ";	
		
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
			$pagination.= " <a href=\"$targetpage?page=$next\"> Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\"> Next &raquo;</span> ";
		$pagination.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrtrflag=1"),0);
 $srno1=($page-1)*$limit+1;
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
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_dalloc where dalloc_tflg=1 order by dalloc_dodc DESC, dalloc_code DESC LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
//$tot_arr_home=0;

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_dalloc where dalloc_tflg=1 order by dalloc_dodc DESC, dalloc_code DESC");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */

if($tot_arr_home >0) { 

?>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch - Allocation</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#378b8b" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="18" align="center" valign="middle" class="smalltblheading">#</td>
			  <td width="84" align="center" valign="middle" class="smalltblheading">Transaction ID</td>
			  <td width="61" align="center" valign="middle" class="smalltblheading">Date</td>
			  <td width="166" align="center" valign="middle" class="smalltblheading">Party Name</td>
			  <td width="90" align="center" valign="middle" class="smalltblheading">Location</td>
              <td width="90" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="130" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <td width="110" align="center" valign="middle" class="smalltblheading">Lot No.</td>
			  <td width="50" align="center" valign="middle" class="smalltblheading">NoMP</td>
			  <td width="65" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td width="30" align="center" valign="middle" class="smalltblheading">MMC</td>
              <td width="30" align="center" valign="middle" class="smalltblheading">Edit</td>
            </tr>
<?php
//$srno1=1;

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['dalloc_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$lrole=$row_arr_home['dalloc_logid'];
	$arrival_id=$row_arr_home['dalloc_id'];
	$tid=$arrival_id;
	
	$crop=""; $variety=""; $lotno="";$nnob=""; $nqty=""; $tflg=0;
		
	$sql_arr_home2=mysqli_query($link,"select distinct dallocs_variety from tbl_dalloc_sub where plantcode='".$plantcode."' and  dalloc_id='$tid' and dallocs_allocqty>0 order by dallocs_id asc") or die(mysqli_error($link));
	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
	 	
		$sql_sub=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_variety='".$row_arr_home2['dallocs_variety']."' and dallocs_allocqty>0 and dalloc_id='$tid'") or die(mysqli_error($link));
		while($row_sub=mysqli_fetch_array($sql_sub))
		{	$tflg++;
			if($crop!="")
			$crop=$crop."<br />".$row_sub['dallocs_crop'];  
			else
			$crop=$row_sub['dallocs_crop']; 
			
			if($variety!="") 
			$variety=$variety."<br />".$row_arr_home2['dallocs_variety'];
			else
			$variety=$row_arr_home2['dallocs_variety'];
			
			$sid=$row_sub['dallocs_id'];
			
				
						
			$sq2=mysqli_query($link,"Select distinct dallocss_lotno from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
			$totrec=mysqli_num_rows($sq2);
			if($totrec=mysqli_num_rows($sq2) > 0)
			{	
				
				while($ro2=mysqli_fetch_array($sq2))
				{	
					$tnp=0;	$tqty=0; $nnomp=0;
					$lot2=$ro2['dallocss_lotno']; 
					$sq3=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocss_lotno='$lot2' and dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
					while($ro3=mysqli_fetch_array($sq3))
					{
						$ups=$ro3['dallocss_ups'];
						$tqty=$tqty+$ro3['dallocss_qty']; 
						$tnp=$tnp+$ro3['dallocss_nomp'];	
					}
					
					$sql_dalcsubsub=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$sid' and dalloc_id='$tid' and dallocss_lotno='$lot2' and dallocss_altype!='barcodewise'") or die(mysqli_error($link));
					$tot_dalcsubsub=mysqli_num_rows($sql_dalcsubsub);
					while($row_dalcsubsub=mysqli_fetch_array($sql_dalcsubsub))
					{
						$nnomp=$nnomp+$row_dalcsubsub['dallocss_nomp'];
					}
					
					$sql_dalcsubsub2=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocs_id='$sid' and dalloc_id='$tid' and dallocss_lotno='$lot2' and dallocss_altype='barcodewise'") or die(mysqli_error($link));
					 $tot_dalcsubsub2=mysqli_num_rows($sql_dalcsubsub2);
					//if($tot_dalcsubsub2>0)
					while($row_dalcsubsub2=mysqli_fetch_array($sql_dalcsubsub2))
					{
						$sq231=mysqli_query($link,"Select distinct dallocss3_barcode from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and  dallocs_id='$sid'  and dalloc_id='$tid' and dallocss3_lotno='".$row_dalcsubsub2['dallocss_lotno']."' and dallocss3_dflg!=1 ") or die(mysqli_error($link));
						$totre231=mysqli_num_rows($sq231);
						while($row231=mysqli_fetch_array($sq231))
						{
							$nnomp=$nnomp+1;
						}
					}
					$sqmmc1=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dallocs_id='$sid' and dmmc_lotno='$lot2' and dmmc_flg=1") or die(mysqli_error($link));
					$totmmc1=mysqli_num_rows($sqmmc1);
					while($rommc1=mysqli_fetch_array($sqmmc1))
					{
						$nnomp=$nnomp+1;
					}
					//echo $lot2." ".$nnomp." - ".$tqty."<br />";			
					if($lotno!="")
					$lotno=$lotno."<br />".$lot2;
					else
					$lotno=$lot2;
					
					if($nnob!="")
					$nnob=$nnob."<br />".$nnomp;
					else
					$nnob=$nnomp;
					
					if($nqty!="")
					$nqty=$nqty."<br />".$tqty;
					else
					$nqty=$tqty;
				}
			}	
		}
	}
//}	

$transid="DA";
if($row_arr_home['dalloc_tflg']==1)
$transid=$transid.$row_arr_home['dalloc_code'];
else
$transid=$transid.$row_arr_home['dalloc_tcode'];

$transid=$transid."/".$row_arr_home['dalloc_yearcode']."/".$row_arr_home['dalloc_logid'];


$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['dalloc_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);

$mmcflg=0;
	$sq3=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid'") or die(mysqli_error($link));
	$totre3=mysqli_num_rows($sq3);
	while($row3=mysqli_fetch_array($sq3))
	{
		$mmcflg++;
	}

if($tflg>0)
{
if($srno1%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $transid;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['city'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
    <td align="center" valign="middle" class="smalltbltext"><?php if($mmcflg>0){ ?><a href="add_dispmmc.php?pid=<?php echo $arrival_id;?>">MMC<?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['dalloc_logid']==$logid){ ?><a href="edit_dispallocation.php?pid=<?php echo $arrival_id;?>"><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;"  /></a><?php } else { echo $lrole; } ?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $transid;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['city'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
	 <td align="center" valign="middle" class="smalltbltext"><?php if($mmcflg>0){ ?><a href="add_dispmmc.php?pid=<?php echo $arrival_id;?>">MMC<?php } ?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['dalloc_logid']==$logid){ ?><a href="edit_dispallocation.php?pid=<?php echo $arrival_id;?>"><img border="0" src="../images/edit.png"  style="display:inline;cursor:pointer;"  /></a><?php } else { echo $lrole; } ?></td>
</tr>
<?php
}
$srno1=$srno1+1;
}
}
?>
</table>
<?php echo $pagination?>
<?php
}
?>
<br />
<br />
 <?php
  /*$targetpage = $_SERVER['PHP_SELF']; 
	$adjacents = 2;
	$limit = 10; 								
	if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysqli_query($link,"select * from tbl_dalloc where dalloc_dflg=1 order by dalloc_code DESC LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_dalloc where dalloc_tflg=1 order by dalloc_code DESC";
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
			$pagination.= " <a href=\"$targetpage?page=$prev\">&laquo; Previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">&laquo; Previous </span> ";	
		
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
			$pagination.= " <a href=\"$targetpage?page=$next\"> Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\"> Next &raquo;</span> ";
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
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_dalloc where dalloc_tflg=1 order by dalloc_dodc DESC, dalloc_code DESC LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
//$tot_arr_home=0;

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_dalloc where dalloc_tflg=1 order by dalloc_dodc DESC, dalloc_code DESC");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

if($tot_arr_home >0) {*/ 
?>
<!--<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch - Allocation</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#378b8b" style="border-collapse:collapse">

            <!--<tr class="tblsubtitle" height="20">
              <td width="19" align="center" valign="middle" class="smalltblheading">#</td>
			  <td width="88" align="center" valign="middle" class="smalltblheading">Transaction ID</td>
			  <td width="70" align="center" valign="middle" class="smalltblheading">Date</td>
			  <td width="115" align="center" valign="middle" class="smalltblheading">Party Name</td>
			  <td width="95" align="center" valign="middle" class="smalltblheading">Location</td>
              <td width="95" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="115" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <td width="102" align="center" valign="middle" class="smalltblheading">Lot No.</td>
			  <td width="50" align="center" valign="middle" class="smalltblheading">NoMP</td>
			  <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
             <!-- <td width="164" align="center" valign="middle" class="smalltblheading">SLOC</td>
              <td width="70" align="center" valign="middle" class="smalltblheading">Edit / Output</td>
            </tr>-->
<?php
//$srno=1;
/*while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['dalloc_dodc'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$lrole=$row_arr_home['dalloc_logid'];
	$arrival_id=$row_arr_home['dalloc_id'];
	$tid=$arrival_id;
	
	$crop=""; $variety=""; $lotno="";$nnob=""; $nqty="";
		
	$sql_arr_home2=mysqli_query($link,"select distinct dallocs_variety from tbl_dalloc_sub where dalloc_id='$tid' order by dallocs_id asc") or die(mysqli_error($link));
	$tot_arr_home2=mysqli_num_rows($sql_arr_home2);
	while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
	{
	 	
		$sql_sub=mysqli_query($link,"Select * from tbl_dalloc_sub where dallocs_variety='".$row_arr_home2['dallocs_variety']."' and dalloc_id='$tid'") or die(mysqli_error($link));
		while($row_sub=mysqli_fetch_array($sql_sub))
		{	
			if($crop!="")
			$crop=$crop."<br />".$row_sub['dallocs_crop'];  
			else
			$crop=$row_sub['dallocs_crop']; 
			
			if($variety!="") 
			$variety=$variety."<br />".$row_arr_home2['dallocs_variety'];
			else
			$variety=$row_arr_home2['dallocs_variety'];
			
			$sid=$row_sub['dallocs_id'];
						
			$sq2=mysqli_query($link,"Select distinct dallocss_lotno from tbl_dallocsub_sub where dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
			$totrec=mysqli_num_rows($sq2);
			if($totrec=mysqli_num_rows($sq2) > 0)
			{	
				
				while($ro2=mysqli_fetch_array($sq2))
				{	
					$tnp=0;	$tqty=0;
					$lot2=$ro2['dallocss_lotno']; 
					$sq3=mysqli_query($link,"Select * from tbl_dallocsub_sub where dallocss_lotno='$lot2' and dallocs_id='$sid' and dalloc_id='$tid'") or die(mysqli_error($link));
					while($ro3=mysqli_fetch_array($sq3))
					{
						$ups=$ro3['dallocss_ups'];
						$tqty=$tqty+$ro3['dallocss_qty']; 
						$tnp=$tnp+$ro3['dallocss_nomp'];	
					}
					//echo $lot2." ".$tnp." - ".$tqty."<br />";			
					if($lotno!="")
					$lotno=$lotno."<br />".$lot2;
					else
					$lotno=$lot2;
					
					if($nnob!="")
					$nnob=$nnob."<br />".$tnp;
					else
					$nnob=$tnp;
					
					if($nqty!="")
					$nqty=$nqty."<br />".$tqty;
					else
					$nqty=$tqty;
				}
			}	
		}
	}
//}	

$transid="PD";
if($row_arr_home['dalloc_tflg']==1)
$transid=$transid.$row_arr_home['dalloc_code'];
else
$transid=$transid.$row_arr_home['dalloc_tcode'];

$transid=$transid."/".$row_arr_home['dalloc_yearcode']."/".$row_arr_home['dalloc_logid'];

$sql_month24=mysqli_query($link,"select * from tbl_partymaser where p_id='".$row_arr_home['dalloc_party']."' order by business_name")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month24);

if($srno%2!=0)
{*/
?>			  
<!--<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $transid;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['city'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['dalloc_tflg']==1) {?><a href="select_dispalloc_op.php?p_id=<?php echo $arrival_id;?>">Outputs</a><?php } else { ?><?php } ?></td>
</tr>
<?php
/*}
else
{*/
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $transid;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['business_name'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['city'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nnob;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $nqty;?></td>
	<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['dalloc_tflg']==1) {?><a href="select_dispalloc_op.php?p_id=<?php echo $arrival_id;?>">Outputs</a><?php } else { ?><?php } ?></td>
</tr>
<?php
/*}
$srno=$srno+1;
}*/
?>
</table>-->

<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='950' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>";
} */
?>

</td>
<td width="10"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
		  
		  
<!-- actual page end  -->	
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
