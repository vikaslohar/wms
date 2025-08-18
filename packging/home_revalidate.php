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

	date_default_timezone_set('Asia/Calcutta');
	//echo date("d-m-Y h:i:s A");
	
	$sql_tbl=mysqli_query($link,"select * from tbl_revalidate where plantcode='$plantcode' and rv_logid='".$logid."' and rv_tflg=0") or die(mysqli_error($link));
	while($row_tbl=mysqli_fetch_array($sql_tbl))
	{
		$arrival_id=$row_tbl['rv_id'];	
		$s_sub="delete from tbl_revalidate_sub where rv_id='".$arrival_id."'";
		mysqli_query($link,$s_sub) or die(mysqli_error($link));
		
		$s_sub3="delete from tbl_revalidate_sub2 where rv_id='".$arrival_id."'";
		mysqli_query($link,$s_sub3) or die(mysqli_error($link));
	}
	
	$s_sub="delete from tbl_revalidate where rv_logid='".$logid."' and rv_tflg=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	
	
	$sql_tbl2=mysqli_query($link,"select * from tbl_revalidatetemp where plantcode='$plantcode' and rv_logid='".$logid."' and rv_tflg=0") or die(mysqli_error($link));
	while($row_tbl2=mysqli_fetch_array($sql_tbl2))
	{
		$arrival_id2=$row_tbl2['rv_id'];	
		$s_sub2="delete from tbl_revalidatetmp_sub where rv_id='".$arrival_id2."'";
		mysqli_query($link,$s_sub2) or die(mysqli_error($link));
		
		$s_sub23="delete from tbl_revalidatetmp_sub2 where rv_id='".$arrival_id2."'";
		mysqli_query($link,$s_sub23) or die(mysqli_error($link));
	}
	$s_sub3="delete from tbl_revalidatetemp where rv_logid='".$logid."' and rv_tflg=0";
	mysqli_query($link,$s_sub3) or die(mysqli_error($link));	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		echo "<script>window.location='home_revalidate.php'</script>";
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging -Transaction - Pack Seed Re-Printing - Home</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
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

/*function openslocpopprint(tid)
{
winHandle=window.open('fpdngrn.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}*/
function openpackdetails(tid)
{
winHandle=window.open('packdetails_home.php?itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
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
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/pack_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">


		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	    <tr >
	      <td width="820" height="25">&nbsp;Transaction - Pack Seed Re-Printing</td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#1dbe03" bordercolordark="#1dbe03" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_qcrv.php" style="text-decoration:none; color:#000000">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#000000">Add </a><?php } ?></td>
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

<!--<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#1dbe03" style="border-collapse:collapse">
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
		
  $sql_arr_home=mysqli_query($link,"select * from tbl_revalidate where plantcode='$plantcode' and rv_tflg=1 and rv_rvflg!=1 order by rv_date asc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_revalidate where plantcode='$plantcode' and rv_tflg=1 and rv_rvflg!=1 order by rv_date asc";
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
		$pagination .= "<div class=\"pagination\" align=\"right\" style=\"width:900px\">";
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
		$srno=(($page * 50)+1) - 50;
	} 
	$max_results = 50; 
	$from = (($page * $max_results) - $max_results); 
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_revalidate where rv_tflg=1 and rv_rvflg!=1 order by rv_date asc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_revalidate where rv_tflg=1 and rv_rvflg!=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */

?>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Re-Printing - Pending List</td>
  <td width="98" align="right" class="tblheading"><a href="filter1.php">Search</a>&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#1dbe03" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="20" align="center" valign="middle" class="smalltblheading">#</td>
			  <td width="69" align="center" valign="middle" class="smalltblheading">DoQCR</td>
              <td width="104" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="121" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <td width="98" align="center" valign="middle" class="smalltblheading">Lot No.</td>
			  <td width="91" align="center" valign="middle" class="smalltblheading">UPS</td>
			  <td width="60" align="center" valign="middle" class="smalltblheading">NoP</td>
			  <td width="70" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td width="107" align="center" valign="middle" class="smalltblheading">QC Status</td>
			  <td width="88" align="center" valign="middle" class="smalltblheading">DoT</td>
			  <td width="121" align="center" valign="middle" class="smalltblheading">SLOC</td>
              <td width="88" align="center" valign="middle" class="smalltblheading">Re-Printing</td>
</tr>
<?php

if($tot_arr_home > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_tbl_sub['rv_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_tbl_sub['rv_logid'];
	$arrival_id=$row_tbl_sub['rv_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=0; $got=""; $qc=""; $phsrn=""; $nlotno=""; $ups="";
	/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where salesr_id='".$arrival_id."' and salesrs_rettype='P2P'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))*/
	{
		$slups=0; $slqty=0;
		
		//$slups=$row_tbl_sub['rv_enop']; 
		$slqty=$row_tbl_sub['rv_eqty'];
		
		$packtp2=explode(" ",$row_tbl_sub['rv_ups']);
		$packtyp=$packtp2[0]; 
		if($packtp2[1]=="Gms")
		{ 
			$ptp2=(1000/$packtp2[0]);
			$ptp1=($packtp2[0]/1000);
		}
		else
		{
			if($packtp2[0]<1)
			{
				$ptp2=(1000/$packtp2[0])/1000;
				$ptp1=($packtp2[0]/1000)*1000;
			}
			else
			{
				$ptp2=$packtp2[0];
				$ptp1=$packtp2[0];
			}
		}
		if($packtp2[1]=="Gms")
		{
			$slups=($ptp2*$slqty);
		}
		else
		{
			if($packtp2[0]<1)
				$slups=($slqty*$ptp2);
			else
				$slups=($slqty/$ptp2);
			//$nop2=($row_issuetbl['balqty']/$ptp2);
		}
	//echo $slups;
		$aq=explode(".",$slqty);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
		
		$an=explode(".",$slups);
		if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
		
		$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['rv_crop']."' order by cropname Asc");
		$noticia = mysqli_fetch_array($quer3);
		
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['rv_variety']."'  order by popularname Asc"); 
		$noticia_item = mysqli_fetch_array($quer4);
		
		$crop=$noticia['cropname'];
		$variety=$noticia_item['popularname'];	
		
		$upspacktype=$row_tbl_sub['rv_ups'];
		$upspacktype=trim($upspacktype);
		$packtp=explode(" ",$upspacktype);
		$packt=trim($packtp[0]);
		$packtyp=explode(".",$packt);
		if($packtyp[1]=="000")
		$ups=$packtyp[0]." ".$packtp[1];	
		else
		$ups=$packtp[0]." ".$packtp[1];	
		
		
		$lotno=$row_tbl_sub['rv_lotno'];	



$dot="";
if($row_tbl_sub['rv_dot']!="")
{
$dt=explode("-",$row_tbl_sub['rv_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
if($dot=="00-00-0000" || $dot=="--")$dot="";
$dgt=explode("-",$row_tbl_sub['rv_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];
$got=$row_tbl_sub['rv_got'];
$qc=$row_tbl_sub['rv_qc'];
//echo $row_arrival['salesrs_typ'];
$bags=$acn;
$qty=$ac;

$sloc=""; $wareh=""; $binn=""; $subbinn="";
$lotqry=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where lotno='".$lotno."'") or die(mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
while($row_issue=mysqli_fetch_array($lotqry))
{ 
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		//$nomp=$row_tbl_subsub['rvs_nomp']; 
		//$nop=$row_tbl_subsub['rvs_nop']; 
		//$totp=$row_tbl_subsub['rvs_qty']; 
		
		//$diq=explode(".",$row_issuetbl['balqty']);
		//if($diq[1]==000){$totqty=$diq[0];}else{$totqty=$row_issuetbl['balqty'];}
		
		if($dot=="" && ($qc=="OK" || $qc=="Fail"))
		{
		$dt=explode("-",$row_issuetbl['lotldg_qctestdate']);
		$dot=$dt[2]."-".$dt[1]."-".$dt[0];
		}
		
		
		if($sloc!=""){
		$sloc=$sloc."<br />".$wareh.$binn.$subbinn;}
		else{
		$sloc=$wareh.$binn.$subbinn;}
	}	
}		
if($qc=="UT" || $qc=="RT")$dot="";
if($qty > 0)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php if($qc=="OK") { ?><a href="add_revalidate.php?pid=<?php echo $arrival_id?>">Re-Printing</a><?php } else {?>Re-Printing<?php } ?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php if($qc=="OK") { ?><a href="add_revalidate.php?pid=<?php echo $arrival_id?>">Re-Printing</a><?php } else {?>Re-Printing<?php } ?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='850' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
		echo "</td></tr></table>"; */
?>
<?php echo $pagination?>
<br />
<br />
  <?php
  $targetpage1 = $PHP_SELF; 
	$adjacents1 = 2;
	$limit1 = 10; 								
	$page1 = $_GET['page1'];
	if($page1) 
		$start1 = ($page1 - 1) * $limit1; 			//first item to display on this page
	else
		$start1 = 0;	
		
  $sql_arr_home1=mysqli_query($link,"select * from tbl_revalidate where rv_tflg=1 and rv_rvflg=1 order by rv_date desc LIMIT $start1, $limit1") or die(mysqli_error($link));
 $tot_arr_home1=mysqli_num_rows($sql_arr_home1);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query1 = "select * from tbl_revalidate where rv_tflg=1 and rv_rvflg=1 order by rv_date desc";
$total_pages1 = mysqli_num_rows(mysqli_query($link,$query1));
//echo	$total_pages = $total_pages[num];
	
	if ($page1 == 0) $page1 = 1;					//if no page var is given, default to 1.
	$prev1 = $page1 - 1;							//previous page is page - 1
	$next1 = $page1 + 1;							//next page is page + 1
	$lastpage1 = ceil($total_pages1/$limit1);		//lastpage is = total pages / items per page, rounded up.
	$lpm11 = $lastpage1 - 1;						//last page minus 1
	
$pagination1 = "";
	if($lastpage1 > 1)
	{	
		$pagination1 .= "<div class=\"pagination1\" align=\"right\" style=\"width:900px\">";
		//previous button
		if ($page1 > 1) 
			$pagination1.= " <a href=\"$targetpage1?page1=$prev1\">« previous </a> ";
		else
			$pagination1.= " <span class=\"disabled1\">« previous </span> ";	
		
		//pages	
		if ($lastpage1 < 7 + ($adjacents1 * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter1 = 1; $counter1 <= $lastpage1; $counter1++)
			{
				if ($counter1 == $page1)
					$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
				else
					$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
			}
		}
		elseif($lastpage1 > 5 + ($adjacents1 * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page1 < 1 + ($adjacents1 * 2))		
			{
				for ($counter1 = 1; $counter1 < 4 + ($adjacents1 * 2); $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
				$pagination1.= " ... ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lpm11\"> $lpm11 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lastpage1\"> $lastpage1 </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage1 - ($adjacents1 * 2) > $page1 && $page1 > ($adjacents1 * 2))
			{
				$pagination1.= " <a href=\"$targetpage1?page1=1\"> 1 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=2\"> 2 </a> ";
				$pagination1.= " ... ";
				for ($counter1 = $page1 - $adjacents1; $counter1 <= $page1 + $adjacents1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
				$pagination1.= " ... ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lpm11\"> $lpm11 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lastpage1\"> $lastpage1 </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination1.= " <a href=\"$targetpage1?page1=1\"> 1 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=2\"> 2 </a> ";
				$pagination1.= " ... ";
				for ($counter1 = $lastpage1 - (2 + ($adjacents1 * 2)); $counter1 <= $lastpage1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
			}
		}
		
		//next button
		if ($page1 < $counter1 - 1) 
			$pagination1.= " <a href=\"$targetpage1?page1=$next1\"> next »</a> ";
		else
			$pagination1.= " <span class=\"disabled1\"> next »</span> ";
		$pagination1.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrtrflag=1"),0);
 $srno1=($page1-1)*$limit1+1;
/*if(!isset($_GET['page2'])) { 
		$page2 = 1; 
		$srno2=1;
	} else { 
		$page2 = $_GET['page2']; 
		$srno2=(($page2 * 50)+1) - 50;
	} 
	$max_results2 = 50; 
	$from2 = (($page2 * $max_results2) - $max_results2); 
	
	
$sql_arr_home2=mysqli_query($link,"select * from tbl_revalidate where rv_tflg=1 and rv_rvflg=1 order by rv_date desc LIMIT $from2, $max_results2") or die(mysqli_error($link));
$tot_arr_home2=mysqli_num_rows($sql_arr_home2);

$total_results2 = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_revalidate where rv_tflg=1 and rv_rvflg=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */

?>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Pack Seed Re-Printing - Completed List</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#1dbe03" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
              <td width="20" align="center" valign="middle" class="smalltblheading">#</td>
			  <td width="69" align="center" valign="middle" class="smalltblheading">DoRV</td>
              <td width="104" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="121" align="center" valign="middle" class="smalltblheading">Variety</td>
			  <td width="98" align="center" valign="middle" class="smalltblheading">Lot No.</td>
			  <td width="91" align="center" valign="middle" class="smalltblheading">UPS</td>
			  <td width="60" align="center" valign="middle" class="smalltblheading">NoP</td>
			  <td width="70" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td width="107" align="center" valign="middle" class="smalltblheading">QC Status</td>
              <td width="88" align="center" valign="middle" class="smalltblheading">DoT</td>
</tr>
<?php

if($tot_arr_home1 > 0)
{
while($row_tbl_sub2=mysqli_fetch_array($sql_arr_home1))
{
	$trdate=$row_tbl_sub2['rv_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_tbl_sub2['rv_logid'];
	$arrival_id=$row_tbl_sub2['rv_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=0; $got=""; $qc=""; $phsrn=""; $nlotno=""; $ups="";
	/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where salesr_id='".$arrival_id."' and salesrs_rettype='P2P'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))*/
	{
		$slups=0; $slqty=0;
		
		//$slups=$row_tbl_sub['rv_enop']; 
		$slqty=$row_tbl_sub2['rv_eqty'];
		
		$packtp2=explode(" ",$row_tbl_sub2['rv_ups']);
		$packtyp=$packtp2[0]; 
		if($packtp2[1]=="Gms")
		{ 
			$ptp2=(1000/$packtp2[0]);
			$ptp1=($packtp2[0]/1000);
		}
		else
		{
			if($packtp2[0]<1)
			{
				$ptp2=(1000/$packtp2[0])/1000;
				$ptp1=($packtp2[0]/1000)*1000;
			}
			else
			{
				$ptp2=$packtp2[0];
				$ptp1=$packtp2[0];
			}
		}
		if($packtp2[1]=="Gms")
		{
			$slups=($ptp2*$slqty);
		}
		else
		{
			if($packtp2[0]<1)
				$slups=($slqty*$ptp2);
			else
				$slups=($slqty/$ptp2);
			//$nop2=($row_issuetbl['balqty']/$ptp2);
		}
		
		$aq=explode(".",$slqty);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
		
		$an=explode(".",$slups);
		if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
		
		$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub2['rv_crop']."' order by cropname Asc");
		$noticia = mysqli_fetch_array($quer3);
		
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub2['rv_variety']."'  order by popularname Asc"); 
		$noticia_item = mysqli_fetch_array($quer4);
		
		$crop=$noticia['cropname'];
		$variety=$noticia_item['popularname'];
			
		$upspacktype=$row_tbl_sub2['rv_ups'];
		$upspacktype=trim($upspacktype);
		$packtp=explode(" ",$upspacktype);
		$packt=trim($packtp[0]);
		$packtyp=explode(".",$packt);
		if($packtyp[1]=="000")
		$ups=$packtyp[0]." ".$packtp[1];	
		
		$lotno=$row_tbl_sub2['rv_lotno'];	



$dot="";
if($row_tbl_sub2['rv_dot']!="")
{
$dt=explode("-",$row_tbl_sub2['rv_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
$dgt=explode("-",$row_tbl_sub2['salesrs_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];
$got=$row_tbl_sub2['rv_got'];
$qc=$row_tbl_sub2['rv_qc'];
//echo $row_arrival['salesrs_typ'];

		
$bags=$acn;
$qty=$ac;
if($qty > 0)
{
if($srno1%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $dot; ?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $dot; ?></td>
</tr>
<?php
}
$srno1=$srno1+1;
}
}
}
}
?>
</table>
<?php
	/*$total_pages2 = ceil($total_results2 / $max_results2); 
	$no2=(($page2 * $max_results2)+1) - $max_results2;
	$tono2=$srno2-1;
	echo "<table width='850' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page2 > 1)
	{ 
		$prev2 = ($page2 - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page2=$prev2\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages2; $i++)
	{ 
		if(($page2) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page2=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page2 < $total_pages2)
	{ 
		$next2 = ($page2 + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page2=$next2\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>"; */
?>
<?php echo $pagination1?>
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
