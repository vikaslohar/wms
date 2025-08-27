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
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying-Report -Period Wise Report</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
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
          <td valign="top"><?php require_once("../include/arr_drying.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <?php
/*$quer2=mysqli_query($link,"SELECT DISTINCT dept_name,dept_id FROM tbldept where dept_id='$dept'"); 
$row_dept=mysqli_fetch_array($quer2);
	
		$sql_month=mysqli_query($link,"select * from tblmonth where month_act_id='$monthf'")or die("Error:".mysqli_error($link));
		$row_month=mysqli_fetch_array($sql_month);
		$a=$row_month['month_id'];
		//$month_year1=$row_month['month_year'];	
		
		
		$sql_month=mysqli_query($link,"select * from tblmonth where month_act_id='$montht'")or die("Error:".mysqli_error($link));
		$row_month=mysqli_fetch_array($sql_month);
		$b=$row_month['month_id'];
		//$month_year2=$row_month['month_year'];	*/
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25">&nbsp; Trading Arrivals Report </td>
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
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   ardate <= '$edate' and ardate >= '$sdate' and trflg=1 order by ardate desc ") or die(mysqli_error($link));
	}
	else if($loc!="ALL" && $itemid=="ALL")
	{ //location
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   ardate <= '$edate' and ardate >= '$sdate' and trflg=1 and productionlocationid='".$loc."' order by ardate desc ") or die(mysqli_error($link));
	}
	else if($loc=="ALL" && $itemid!="ALL")
	{ //T type
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   ardate <= '$edate' and ardate >= '$sdate' and trflg=1 and trtype='$itemid' order by ardate desc ") or die(mysqli_error($link));
	}
	else if($loc!="ALL" && $itemid!="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   ardate <= '$edate' and ardate >= '$sdate' and trflg=1 and productionlocationid='".$loc."' and trtype='$itemid' order by ardate desc ") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   ardate <= '$edate' and ardate >= '$sdate' and trflg=1 order by ardate desc ") or die(mysqli_error($link));
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
  
  <table  border="1" cellspacing="0" cellpadding="0" width="684" bordercolor="#adad11" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="19" align="center" valign="middle" class="tblheading">#</td>
			<td width="64" align="center" valign="middle" class="tblheading">Crop</td>
			<td width="103"  align="center" valign="middle" class="tblheading">variety</td>
			<td width="84" align="center" valign="middle" class="tblheading" >Vandors Lot No. </td>
			<td width="50"  align="center" valign="middle" class="tblheading">Lot No. </td>
			
			<td width="66"  align="center" valign="middle" class="tblheading">No. Of Bag</td>
			<td width="55"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="103" align="center" valign="middle" class="tblheading">Stage At Arrival </td>
			<td width="38"  align="center" valign="middle" class="tblheading">SLOC</td>
			<td width="80" align="center" valign="middle" class="tblheading" >% in Moisture </td>
			<td width="82" align="center" valign="middle" class="tblheading">Vendor Name </td>
			<!--<td width="59" align="center" valign="middle" class="tblheading">Status</td>
            <td width="58" align="center" valign="middle" class="tblheading">Login</td>-->
</tr>

<?php 
/*$srno=1;

while($row=mysqli_fetch_array($sql_arr_home))
	{
	$tdate=$row['ardate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
$tp=""; $crop="";

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   lotnoid='".$lid."'") or die(mysqli_error($link));
				$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
				 $arrival_id=$row_tbl_sub['arid'];


if($row['trtype']=="freshpdn")
{
$tp="Fresh Seed with PDN";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else if($row['trtype']=="Trading")
{
$tp="Trading";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else if($row['trtype']=="UnidentifiedArrival")
{
$tp="Unidentified";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else if($row['trtype']=="Existing")
{
$tp="Lot Regularisation";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else if($row['trtype']=="LotMerger")
{
$tp="Lot Merger";
$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$crop=$row_class['cropname'];
}
else
{
$tp="";
$crop="";
}

$lotno=""; $orgn=""; $farmer=""; $dest=""; $lotstat=""; $loc="";
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arid='".$row['arid']."' order by lotnoid desc") or die(mysqli_error($link));
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	$sql_cls=mysqli_query($link,"SELECT * FROM tbllot where id='".$row_tbl_sub['lotnoid']."' order by lotno desc") or die(mysqli_error($link));
	$row_cls=mysqli_fetch_array($sql_cls);
	
		if($row['trtype']=="UnidentifiedArrival")
		{
		$tp="Unidentified";
		$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropid']."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		//$crop=$row_class['cropname'];
		//if($crop!="")
		//	$crop=$crop."<br>".$row_class['cropname'];
		//	else
			$crop=$row_class['cropname'];
		}
	//if($lot!="")
	//$lot=$row_cls['lotnumber'];
	//else
	$lotno=$row_cls['lotnumber'];
	
			$tp1="";
			if($row_cls['impflg'] ==0) { $tp1="IMP-No";}
			else if($row_cls['impflg'] ==1) { $tp1="IMP-Yes";}
			else if($row_cls['impflg'] ==2) { $tp1="SUSPENDED";}
			
	//if($lotstat!="")
	//$lotstat=$lotstat."<br>".$tp1;
	//else
	$lotstat=$tp1;
	
	$sql_item1=mysqli_query($link,"select * from tblfarmer where farmerid='".$row_tbl_sub['farmerid']."'") or die(mysqli_error($link));
	$row_item1=mysqli_fetch_array($sql_item1);
	$tot_item1=mysqli_num_rows($sql_item1);
	if($tot_item1 > 0)
	{
	//if($farmer!="")
	//$farmer=$farmer."<br>".$row_item1['farmername'];
	//else
	$farmer=$row_item1['farmername'];
	}
	else
	{
	//if($farmer!="")
	//$farmer=$farmer."<br>"." ";
	//else
	$farmer=" ";
	}
	$sql_item=mysqli_query($link,"select * from tblorganiser where orgid='".$row_tbl_sub['orgid']."'") or die(mysqli_error($link));
	$row_item=mysqli_fetch_array($sql_item);
	$tot_item=mysqli_num_rows($sql_item);
	if($tot_item > 0)
	{
	//if($orgn!="")
	//$orgn=$orgn."<br>".$row_item['orgname'];
	//else
	$orgn=$row_item['orgname'];
	}
	else
	{
	//if($orgn!="")
	//$orgn=$orgn."<br>"." ";
	//else
	$orgn=" ";
	}
	
$fln=$row_cls['dest'];

			$flnid =explode(",",$fln);
			foreach($flnid as $fid)
		  	{	
				if($fid<>"")
				{ 
					
					$sql_dst=mysqli_query($link,"SELECT * FROM tbldestination where  plantcode='".$plantcode."' and   did='".$fid."'") or die(mysqli_error($link));
					while($row_dst=mysqli_fetch_array($sql_dst))
					{
						if($dest!="")
						$dest=$dest.", ".$row_dst['dest'];
						else
						$dest=$row_dst['dest'];
					}
					
				}
			}
			//$dest=$dest."<br>";

$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row['cropid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item1=mysqli_query($link,"select * from tblfarmer where farmerid='".$row_tbl_sub['farmerid']."'") or die(mysqli_error($link));
$row_item1=mysqli_fetch_array($sql_item1);

$sql_item=mysqli_query($link,"select * from tblorganiser where orgid='".$row_tbl_sub['orgid']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);

$sql_pp=mysqli_query($link,"select * from tblproductionlocation where productionlocationid ='".$row['productionlocationid']."'") or die(mysqli_error($link));
$row_pp=mysqli_fetch_array($sql_pp);
$loc1=$row_pp['productionlocation'];				
$prtype=$row_tbl_sub['prtype'];

$sql_pro=mysqli_query($link,"select * from tblproductionpersonnel where productionpersonnelid='".$row['productionpersonnelid']."'") or die(mysqli_error($link));
$row_pro=mysqli_fetch_array($sql_pro);
$per=$row_pro['productionpersonnel'];

	if($row['trtype']=="Trading" || $row['trtype']=="Existing")
	{
		$oldlot = $row_tbl_sub['oldlot'];
	}
	else
	{
		$oldlot = $row['oldlot'];
	}
				$sql_usr=mysqli_query($link,"select * from tbluser where plantcode='".$plantcode."' and scode='".$row['logid']."'") or die(mysqli_error($link));
				$row_usr=mysqli_fetch_array($sql_usr);
				
				$sql_opr1=mysqli_query($link,"select * from tblopr where plantcode='".$plantcode."' and id='".$row_usr['uid']."'") or die(mysqli_error($link));
				$row_opr1=mysqli_fetch_array($sql_opr1);
				$login=$row_opr1['name'];
				
if ($srno%2 != 0)
	{		
*/?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $tp;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row['spcodef'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row['spcodem'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $oldlot;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $orgn;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $per;?></td>
			<!--/*<td align="center" valign="middle" class="tblheading"><?php echo $lotstat;?></td>
            <td align="center" valign="middle" class="tblheading"><?php echo $login;?></td>*/
</tr>-->
<?php
/*}
else
{
*/?>
<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $tp;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_arr['spcodef'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_arr['spcodem'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $oldlot;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $orgn;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $per;?></td>
		<!--<td align="center" valign="middle" class="tblheading"><?php echo $lotstat;?></td>
        <td align="center" valign="middle" class="tblheading"><?php echo $login;?></td>-->
</tr>
<?php
/*}
$srno=$srno+1;
}
}
}
}
}*/
?>
</table>			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_arrival.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
