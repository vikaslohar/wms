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
	
	
$sql_tbl=mysqli_query($link,"select * from tbl_pnpslipmain where logid='".$logid."' and pnpslipmain_tflag=0 and pnpslipmain_trtype='fc' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['pnpslipmain_id'];	
	
	$s_sub="delete from tbl_pnpslipsub where pnpslipmain_id='".$arrival_id."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	$s_sub_sub="delete from tbl_pnpslipsubsub where pnpslipmain_id='".$arrival_id."'";
	mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));
	
	$s_sub_sub2="delete from tbl_pnpslipsubsub2 where pnpslipmain_id='".$arrival_id."'";
	mysqli_query($link,$s_sub_sub2) or die(mysqli_error($link));
	
	$s_sub_sub3="delete from tbl_pnpslipsubsub3 where pnpslipmain_id='".$arrival_id."'";
	mysqli_query($link,$s_sub_sub3) or die(mysqli_error($link));
}
	
	$s_sub="delete from tbl_pnpslipmain where logid='".$logid."' and pnpslipmain_tflag=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	
	
	$s_sub3="delete from tbl_barcodestmp where bar_logid='".$logid."'";
	mysqli_query($link,$s_sub3) or die(mysqli_error($link));

	$sql_tbl=mysqli_query($link,"select * from tbl_btslmain where btsl_trtyp='packaging' and btsl_logid='$logid' and btsl_tflg=0 and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_tbl=mysqli_fetch_array($sql_tbl))
	{
		$arrival_id=$row_tbl['btsl_id'];	
		$s_sub="delete from tbl_btslsub where btsl_id='".$arrival_id."'";
		mysqli_query($link,$s_sub) or die(mysqli_error($link));
	}
				
	$s_sub="delete from tbl_btslmain where btsl_trtyp='packaging' and btsl_logid='$logid' and btsl_tflg=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	
		
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_pronpslip1.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='home_pronpslip_fc.php'</script>";
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Processing - Transaction - Processing and Packing Slip Field Crop - Home</title>
<link href="../include/main_process.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_process.css" rel="stylesheet" type="text/css" />
</head>
<script src="search.js"></script>
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
winHandle=window.open('packdetails_pnpslip_home.php?itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
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
function searchlotname(searchval)
{
	
	if(searchval.length>=6)
	{searchUser(searchval,"searchresult","fclotserch",'','','','','','','','','','');}
	else
	{searchval=""; searchUser(searchval,"searchresult","fclotserch",'','','','','','','','','','');}
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_process.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/process_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">


		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="820" height="25">&nbsp;Transaction - Processing and Packing slip (Field Crop)</td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#adad11" bordercolordark="#adad11" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_pronpslip_slip_fc.php" style="text-decoration:none; color:#000000">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#000000">Add </a><?php } ?></td>
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
<table align="center" border="0" width="970" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="5" align="center" class="tblheading">Processing and Packing slip</td>
  <td width="173" align="left" class="tblheading">&nbsp;Search Lot No.&nbsp;
    <input type="text" class="smalltbltext" size="7" maxlength="7" name="lsearch" id="lsearch" onkeyup="searchlotname(this.value)" style="background-color:#FFFFFF; border-color:#378b8b" placeholder="DP12345" />&nbsp;</td>
</tr>
</table>
<div id="searchresult" name="searchresult">
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
		
  $sql_arr_home=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_ttype='Processing and Packing Slip' and pnpslipmain_tflag=2 and plantcode='$plantcode' and pnpslipmain_trtype='fc' order by pnpslipmain_tcode desc LIMIT $start, $limit") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_pnpslipmain where pnpslipmain_ttype='Processing and Packing Slip' and pnpslipmain_tflag=2 and plantcode='$plantcode' and pnpslipmain_trtype='fc' order by pnpslipmain_tcode desc";
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
	 $srno=($page-1)*$limit+1;

    if($tot_arr_home >0) { 
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" rowspan="2"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="76" rowspan="2" align="center" valign="middle" class="smalltblheading">Transaction Id</td>
	<td width="76" rowspan="2" align="center" valign="middle" class="smalltblheading">MTN No.</td>
	<td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading">Date</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="130" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Existing</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Conditioned</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">IM</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Total C. Loss</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="tblheading">Pack Details</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="tblheading">Processing Finalize</td>
</tr>
<tr class="tblsubtitle" height="20">
	<td width="45" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">%</td>
</tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['pnpslipmain_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$lrole=$row_arr_home['logid'];
		
	$arrival_id=$row_arr_home['pnpslipmain_id'];
	$mtnno=$row_arr_home['pnpslipmain_mtnno'];
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_arr_home['pnpslipmain_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	$crop=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['pnpslipmain_variety']."'  order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);
	$variety=$noticia_item['popularname'];
	//echo $arrival_id;
	$lotno=""; $bags1=""; $qty1=""; $bags2=""; $qty2=""; $rm=""; $im=""; $pl=""; $tpl=""; $tplper="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
//echo $row_tbl_sub['pnpslipsub_pqty'];
$aq=explode(".",$row_tbl_sub['pnpslipsub_pnob']);
if($aq[1]==000){$onob=$aq[0];}else{$onob=$row_tbl_sub['pnpslipsub_pnob'];}

$an=explode(".",$row_tbl_sub['pnpslipsub_pqty']);
if($an[1]==000){$oqty=$an[0];}else{$oqty=$row_tbl_sub['pnpslipsub_pqty'];}

$aq2=explode(".",$row_tbl_sub['pnpslipsub_connob']);
if($aq2[1]==000){$cnob=$aq2[0];}else{$cnob=$row_tbl_sub['pnpslipsub_connob'];}

$an2=explode(".",$row_tbl_sub['pnpslipsub_conqty']);
if($an2[1]==000){$cqty=$an2[0];}else{$cqty=$row_tbl_sub['pnpslipsub_conqty'];}

$aq3=explode(".",$row_tbl_sub['pnpslipsub_rm']);
if($aq3[1]==000){$rmqty=$aq3[0];}else{$rmqty=$row_tbl_sub['pnpslipsub_rm'];}

$an3=explode(".",$row_tbl_sub['pnpslipsub_im']);
if($an3[1]==000){$imqty=$an3[0];}else{$imqty=$row_tbl_sub['pnpslipsub_im'];}

if($row_tbl_sub['pnpslipsub_pl']!="")
{
$an4=explode(".",$row_tbl_sub['pnpslipsub_pl']);
if($an4[1]==000){$plqty=$an4[0];}else{$plqty=$row_tbl_sub['pnpslipsub_pl'];}
}
else
{
$an4=explode(".",$row_tbl_sub['pnpslipsub_rpl']);
if($an4[1]==000){$plqty=$an4[0];}else{$plqty=$row_tbl_sub['pnpslipsub_rpl'];}
}

$an5=explode(".",$row_tbl_sub['pnpslipsub_tlqty']);
if($an5[1]==000){$tplqty=$an5[0];}else{$tplqty=$row_tbl_sub['pnpslipsub_tlqty'];}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['pnpslipsub_lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['pnpslipsub_lotno'];
		}
		if($bags1!="")
		{
		$bags1=$bags1."<br>".$onob;
		}
		else
		{
		$bags1=$onob;
		}
		if($qty1!="")
		{
		$qty1=$qty1."<br>".$oqty;
		}
		else
		{
		$qty1=$oqty;
		}
		if($bags2!="")
		{
		$bags2=$bags2."<br>".$cnob;
		}
		else
		{
		$bags2=$cnob;
		}
		if($qty2!="")
		{
		$qty2=$qty2."<br>".$cqty;
		}
		else
		{
		$qty2=$cqty;
		}
		if($rm!="")
		{
		$rm=$rm."<br>".$rmqty;
		}
		else
		{
		$rm=$rmqty;
		}
		if($im!="")
		{
		$im=$im."<br>".$imqty;
		}
		else
		{
		$im=$imqty;
		}
		if($pl!="")
		{
		$pl=$pl."<br>".$plqty;
		}
		else
		{
		$pl=$plqty;
		}
		if($tpl!="")
		{
		$tpl=$tpl."<br>".$tplqty;
		}
		else
		{
		$tpl=$tplqty;
		}
		if($tplper!="")
		{
		$tplper=$tplper."<br>".$row_tbl_sub['pnpslipsub_tlper'];
		}
		else
		{
		$tplper=$row_tbl_sub['pnpslipsub_tlper'];
		}
		
	}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="add_pronpslipmtn_view_fc.php?p_id=<?php echo $arrival_id;?>"><?php echo "PS".$row_arr_home['pnpslipmain_tcode']."/".$yearid_id."/".$lrole;?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mtnno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $im?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tpl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1) { ?><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $arrival_id;?>)">View</a><?php } else { ?>Pending<?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1 && $row_arr_home['pnpslipmain_prolossupdflg']==0) { ?><a href="add_pronpslipmtn_finalize_fc.php?p_id=<?php echo $arrival_id;?>">Update</a><?php } else if($row_arr_home['pnpslipmain_prolossupdflg']==1) { ?>Updated<?php }else{ ?>Pending<?php } ?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="add_pronpslipmtn_view_fc.php?p_id=<?php echo $arrival_id;?>"><?php echo "PS".$row_arr_home['pnpslipmain_tcode']."/".$yearid_id."/".$lrole;?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mtnno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $im?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tpl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1) { ?><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $arrival_id;?>)">View</a><?php } else { ?>Pending<?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1 && $row_arr_home['pnpslipmain_prolossupdflg']==0) { ?><a href="add_pronpslipmtn_finalize_fc.php?p_id=<?php echo $arrival_id;?>">Update</a><?php } else if($row_arr_home['pnpslipmain_prolossupdflg']==1) { ?>Updated<?php }else{ ?>Pending<?php } ?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
          </table>
<?php
}
?>
<!--<table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
</table>-->

<?php echo $pagination?>
</div>
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
