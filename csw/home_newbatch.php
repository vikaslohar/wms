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
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSW- Transaction - Sloc Update -  Home</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
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
<script language="javascript" type="text/javascript">
var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.date,dt,document.frmaddDepartment.date, "dd-mmm-yyyy", xind, yind);
	}  


function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
/*function onloadfocus()
	{
	document.frmaddDepartment.txtdrno.focus();
	}*/
	

function openslocpopprint(tid)
{
winHandle=window.open('arr_vendor_print.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_csw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/csw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" style="border-bottom:solid; border-bottom-color:#fa8283" >
	    <tr >
	      <td width="810" height="25">&nbsp;Transaction - Lot Number Batch Generation</td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#fa8283" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:hand;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_newbatch.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>



<?php

$adjacents = 3;
	
 	$query = "SELECT COUNT(*) as num FROM tbl_lotbatch where plantcode='".$plantcode."' and  batch_tflg=1 ";
	$total_pages = mysqli_fetch_array(mysqli_query($link,$query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "home_sloc.php"; 	//your file name  (the name of this file)
	$limit = 10; 								//how many items to show per page
	if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "select * from tbl_lotbatch where plantcode='".$plantcode."' and  batch_tflg=1  order by batch_id desc LIMIT $start, $limit";
	$sql_arr_home = mysqli_query($link,$sql);
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination.= "<div class=\"pagination\" align=\"right\"  style=\"width:810px\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\">&laquo; Previous</a> ";
		else
			$pagination.= " <span class=\"disabled\">&laquo; Previous</span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\">$counter</span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
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
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
				$pagination.= "...";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\">$lpm1</a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\">$lastpage</a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\">1</a> ";
				$pagination.= " <a href=\"$targetpage?page=2\">2</a> ";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
				$pagination.= "...";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\">$lpm1</a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\">$lastpage</a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\">1</a> ";
				$pagination.= " <a href=\"$targetpage?page=2\">2</a> ";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\">Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\">Next &raquo;</span> ";
		$pagination.= "</div>\n";		
	} 
  $srno=($page-1)*$limit+1;


?>

<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Number Batch Generation</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#fa8283" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="3%"align="center" valign="middle" class="tblheading">#</td>
	<td width="9%" align="center" valign="middle" class="tblheading">Transaction Id</td>
	<td width="5%" align="center" valign="middle" class="tblheading">Date</td>
	<td width="13%" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="17%" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="14%" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="6%" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="14%" align="center" valign="middle" class="tblheading">Batch Lot No.</td>
	<td width="6%" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['batch_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$srole=$row_arr_home['batch_logid'];
	$yrcd=$row_arr_home['batch_yearcode'];
	
$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home['batch_crop']."'") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($quer3);
$cropname=$noticia_class['cropname'];
$itemqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['batch_variety']."' ") or die(mysqli_error($link));
$row_itm=mysqli_fetch_array($itemqry1);
$varietyname=$row_itm['popularname'];

$batch_lotno=$row_arr_home['batch_lotno'];
$batch_onob=$row_arr_home['batch_onob'];
$batch_oqty=$row_arr_home['batch_oqty'];
$batch_batchlot=$row_arr_home['batch_batchlot'];
$batch_nob=$row_arr_home['batch_nob'];
$batch_qty=$row_arr_home['batch_qty'];
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td width="9%" align="center" valign="middle" class="tbltext"><?php echo "BL".$row_arr_home['batch_code']."/".$yrcd."/".$srole;?></td>
	<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td width="13%" align="center" valign="middle" class="tbltext"><?php echo $cropname;?></td>
	<td width="17%" align="center" valign="middle" class="tbltext"><?php echo $varietyname;?></td>
	<td width="14%" align="center" valign="middle" class="tbltext"><?php echo $batch_lotno;?></td>
	<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $batch_onob;?></td>
	<td width="7%" align="center" valign="middle" class="tbltext"><?php echo $batch_oqty;?></td>
	<td width="14%" align="center" valign="middle" class="tbltext"><?php echo $batch_batchlot;?></td>
	<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $batch_nob;?></td>
	<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $batch_qty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="3%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td width="9%" align="center" valign="middle" class="tbltext"><?php echo "BL".$row_arr_home['batch_code']."/".$yrcd."/".$srole;?></td>
	<td width="5%" align="center" valign="middle" class="tbltext"><?php echo $trdate;?></td>
	<td width="13%" align="center" valign="middle" class="tbltext"><?php echo $cropname;?></td>
	<td width="17%" align="center" valign="middle" class="tbltext"><?php echo $varietyname;?></td>
	<td width="14%" align="center" valign="middle" class="tbltext"><?php echo $batch_lotno;?></td>
	<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $batch_onob;?></td>
	<td width="7%" align="center" valign="middle" class="tbltext"><?php echo $batch_oqty;?></td>
	<td width="14%" align="center" valign="middle" class="tbltext"><?php echo $batch_batchlot;?></td>
	<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $batch_nob;?></td>
	<td width="6%" align="center" valign="middle" class="tbltext"><?php echo $batch_qty;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
          </table>
<?php echo $pagination?>		  



</td><td width="30"></td>
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
