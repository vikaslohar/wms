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
	
	
	$sql_tbl=mysqli_query($link,"select * from tbl_oflpnpslipmain where plantcode='$plantcode' and logid='".$logid."' and pnpslipmain_tflag=0") or die(mysqli_error($link));
	while($row_tbl=mysqli_fetch_array($sql_tbl))
	{
		$arrival_id=$row_tbl['pnpslipmain_id'];	
		
		$s_sub="delete from tbl_oflpnpslipsub where pnpslipmain_id='".$arrival_id."'";
		mysqli_query($link,$s_sub) or die(mysqli_error($link));
	}
	
	$s_sub="delete from tbl_oflpnpslipmain where logid='".$logid."' and pnpslipmain_tflag=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_packslip1.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='home_packslip.php'</script>";
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - OFL Packing Slip - Home</title>
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
	      <td width="820" height="25">&nbsp;Transaction - OFL Packing slip</td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#1dbe03" bordercolordark="#1dbe03" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_pack_slip_ofl.php" style="text-decoration:none; color:#000000">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#000000">Add </a><?php } ?></td>
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

  $sql_arr_home=mysqli_query($link,"select * from tbl_oflpnpslipmain where plantcode='$plantcode' and pnpslipmain_ttype='OFL Packing Slip' order by pnpslipmain_tcode desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_oflpnpslipmain where plantcode='$plantcode' and pnpslipmain_ttype='OFL Packing Slip' order by pnpslipmain_tcode desc";
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

?>
<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">OFL Packing slip</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#1dbe03" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="17" rowspan="2"align="center" valign="middle" class="smalltblheading">#</td>
			 <!--<td width="76" rowspan="2" align="center" valign="middle" class="smalltblheading">Transaction Id</td>-->
              <td width="60" rowspan="2" align="center" valign="middle" class="smalltblheading">Date</td>
              <td width="95" rowspan="2" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="125" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
              <td width="105" rowspan="2" align="center" valign="middle" class="smalltblheading">Lot No.</td>
              <td colspan="2" align="center" valign="middle" class="smalltblheading">Existing</td>
              <td width="20" rowspan="2" align="center" valign="middle" class="smalltblheading">E/P</td>
              <td width="55" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty for Packing</td>
			 <!-- <td width="46" rowspan="2" align="center" valign="middle" class="smalltblheading">Packing Loss</td>
              <td width="25" rowspan="2" align="center" valign="middle" class="smalltblheading">CC</td>-->
            <td width="55" rowspan="2" align="center" valign="middle" class="smalltblheading">Packed Qty</td>
			<td width="67" rowspan="2" align="center" valign="middle" class="smalltblheading">UPS</td>
			<td width="50" rowspan="2" align="center" valign="middle" class="smalltblheading">No. of Pchs</td>
			<td width="50" rowspan="2" align="center" valign="middle" class="smalltblheading">NoMP</td>
            <td width="40" rowspan="2" align="center" valign="middle" class="tblheading">Pack Status</td>
              </tr>
            <tr class="tblsubtitle" height="20">
              <td width="45" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
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
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_arr_home['pnpslipmain_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	$crop=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['pnpslipmain_variety']."'  order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);
	$variety=$noticia_item['popularname'];
	//echo $arrival_id;
	$lotno=""; $bags1=""; $qty1=""; $bags2=""; $qty2=""; $ep=""; $picqty=""; $pckloss=""; $cc=""; $pckqty=""; $upstyp=""; $nopch=""; $nomp=0;
	//echo "select * from tbl_oflpnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_oflpnpslipsub where plantcode='$plantcode' and pnpslipmain_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
		//echo $row_tbl_sub['pnpslipsub_pqty'];
		$aq=explode(".",$row_tbl_sub['pnpslipsub_onob']);
		if($aq[1]==000){$onob=$aq[0];}else{$onob=$row_tbl_sub['pnpslipsub_onob'];}
		
		$an=explode(".",$row_tbl_sub['pnpslipsub_oqty']);
		if($an[1]==000){$oqty=$an[0];}else{$oqty=$row_tbl_sub['pnpslipsub_oqty'];}

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
		
		$aq2=explode(".",$row_tbl_sub['pnpslipsub_pickpqty']);
		if($aq2[1]==000){$picqty=$aq2[0];}else{$picqty=$row_tbl_sub['pnpslipsub_pickpqty'];}
		$aq3=explode(".",$row_tbl_sub['pnpslipsub_packloss']);
		if($aq3[1]==000){$pckloss=$aq3[0];}else{$pckloss=$row_tbl_sub['pnpslipsub_packloss'];}
		$aq4=explode(".",$row_tbl_sub['pnpslipsub_packcc']);
		if($aq4[1]==000){$cc=$aq4[0];}else{$cc=$row_tbl_sub['pnpslipsub_packcc'];}
		$aq5=explode(".",$row_tbl_sub['pnpslipsub_packqty']);
		if($aq5[1]==000){$pckqty=$aq5[0];}else{$pckqty=$row_tbl_sub['pnpslipsub_packqty'];}
		
		$ep=$row_tbl_sub['pnpslipsub_packtype'];
		//$picqty=$row_tbl_sub['pnpslipsub_pickpqty'];
		//$pckloss=$row_tbl_sub['pnpslipsub_packloss'];
		//$cc=$row_tbl_sub['pnpslipsub_packcc'];
		//$pckqty=$row_tbl_sub['pnpslipsub_packqty'];
		$upstyp=$row_tbl_sub['pnpslipsub_ups'];
		$nopch=$row_tbl_sub['pnpslipsub_nop'];
		
		
		$quer_nomp=mysqli_query($link,"SELECT COUNT(*) AS total FROM `tbl_oflpnpslipbarcode` WHERE `pnpslipsub_id`='".$row_tbl_sub['pnpslipsub_id']."'");
		$row_nomp = mysqli_fetch_array($quer_nomp);
		$nomp=$row_nomp['total'];
	}
	
	
	
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
         <!--<td align="center" valign="middle" class="smalltbltext"><a href="add_packslip_view.php?p_id=<?php echo $arrival_id;?>"><?php echo "PS".$row_arr_home['pnpslipmain_tcode']."/".$yearid_id."/".$lrole;?></a></td>-->
         <td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $bags1?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $qty1?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $ep?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $picqty?></td>
         <!--<td align="center" valign="middle" class="smalltbltext"><?php echo $pckloss?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $cc?></td>-->
         <td align="center" valign="middle" class="smalltbltext"><?php echo $pckqty?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $upstyp?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $nopch?></td>
		 <td align="center" valign="middle" class="smalltbltext"><?php echo $nomp?></td>
		 <td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_tflag']==2){echo "Pendig";}else{echo "Completed";}?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
        <!-- <td align="center" valign="middle" class="smalltbltext"><a href="add_packslip_view.php?p_id=<?php echo $arrival_id;?>"><?php echo "PS".$row_arr_home['pnpslipmain_tcode']."/".$yearid_id."/".$lrole;?></a></td>-->
         <td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $bags1?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $qty1?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $ep?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $picqty?></td>
         <!--<td align="center" valign="middle" class="smalltbltext"><?php echo $pckloss?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $cc?></td>-->
         <td align="center" valign="middle" class="smalltbltext"><?php echo $pckqty?></td>
        <td align="center" valign="middle" class="smalltbltext"><?php echo $upstyp?></td>
         <td align="center" valign="middle" class="smalltbltext"><?php echo $nopch?></td>
		 <td align="center" valign="middle" class="smalltbltext"><?php echo $nomp?></td>
		 <td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_tflag']==2){echo "Pendig";}else{echo "Completed";}?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<?php echo $pagination?>


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
