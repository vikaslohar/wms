<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
		
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
		//$cid = $_REQUEST['txtclass'];
		$itemid = $_REQUEST['itemid'];
		$loc = $_REQUEST['txtloc'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lgen-Report -Period Wise Report</title>
<link href="../../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
var loc=document.frmaddDepartment.txtloc.value;
var ite=document.frmaddDepartment.itemid.value;
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('preview_lotd.php?sdate='+sdate+'&txtloc='+loc+'&itemid='+ite+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../../include/arr_plant1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <?php
   $sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='StockTransfer Arrival' and arrtrflag=1 and plantcode='$plantcode' order by arr_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblarrival where arrival_type='StockTransfer Arrival' and arrtrflag=1 and plantcode='$plantcode'");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

  //  if($tot_arr_home >0) { 

?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Stock Transfer - Plant </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	   <input name="txtloc" value="<?php echo $loc;?>" type="hidden"> 
	    <input name="itemid" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
	
	/*$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	//$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['itemid'];
	$loc = $_REQUEST['txtloc'];	
	
	$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
	 	 
		 
	
	

	if($loc=="ALL" && $itemid=="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where ardate <= '$edate' and ardate >= '$sdate' and trflg=1 order by ardate desc ") or die(mysqli_error($link));
	}
	else if($loc!="ALL" && $itemid=="ALL")
	{ //location
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where ardate <= '$edate' and ardate >= '$sdate' and trflg=1 and productionlocationid='".$loc."' order by ardate desc ") or die(mysqli_error($link));
	}
	else if($loc=="ALL" && $itemid!="ALL")
	{ //T type
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where ardate <= '$edate' and ardate >= '$sdate' and trflg=1 and trtype='$itemid' order by ardate desc ") or die(mysqli_error($link));
	}
	else if($loc!="ALL" && $itemid!="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where ardate <= '$edate' and ardate >= '$sdate' and trflg=1 and productionlocationid='".$loc."' and trtype='$itemid' order by ardate desc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where ardate <= '$edate' and ardate >= '$sdate' and trflg=1 order by ardate desc ") or die(mysqli_error($link));
	}*/
//echo 	$tot=mysqli_num_rows($sql_arr_home);
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination: <?php echo $cls['dest'];?></td>
  	</tr>-->
	
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#2e81c1" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="66" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="124" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
              <td width="131" rowspan="2" align="center" valign="middle" class="tblheading">Dispatch No. of Bags</td>
			  <td width="76" rowspan="2" align="center" valign="middle" class="tblheading">Dispatch Qty</td>
               <td width="93" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
			   <td width="64" rowspan="2" align="center" valign="middle" class="tblheading">Quality Status</td>
			    <td width="85" rowspan="2" align="center" valign="middle" class="tblheading">Received Qty</td>
			    <td width="69" rowspan="2" align="center" valign="middle" class="tblheading">Recived No. of Bags</td>
                  <td colspan="2"  align="center" valign="middle" class="tblheading">Diff</td>
                  </tr>
			<tr class="tblsubtitle">
			  <td align="center" valign="middle" class="tblheading">Bag</td>
			  <td align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
<?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{
?>			  
 <tr class="Light" height="20">
             <td width="66" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="124" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
             <td width="131" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>			 
             <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
             <td width="85" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
             <td width="69" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
             <td width="55" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
             <td width="65" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
			 </tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
            <td width="66" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="124" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
             <td width="131" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>			 
             <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
             <td width="85" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
             <td width="69" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
             <td width="55" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
             <td width="65" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
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
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_arrival.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../../images/istratlogo.gif"  align="left"/><img src="../../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
