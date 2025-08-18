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
	
	$sdate=$_REQUEST['sdate'];
	$edate=$_REQUEST['edate'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Utility-Order-Date wise Order Search</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk1.js"></script>
<script src="party.js"></script>
<script src="../include/validation.js"></script>
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
function openslocpop(party)
{
//var party=document.form.txtid.value;
winHandle=window.open('order_cancel_view.php?itmid='+party,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 
return true;
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_order.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >&nbsp;Utility - Date wise Order Search</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="txt11" value="<?php echo $_SESSION['yearid_id'];?>" type="hidden"> 
	 <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30">	 </td><td>
<?php 
if(!isset($_GET['page'])) { 
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
	
	
	 $tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;	
	
	
	$pdate=$edate;
	$pday=substr($pdate,0,2);
	$pmonth=substr($pdate,3,2);
	$pyear=substr($pdate,6,4);
	$pdate=$pyear."-".$pmonth."-".$pday;
	
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_date >='$tdate' and orderm_date <='$pdate'  and orderm_tflag=1  order by orderm_date asc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  from tbl_orderm where plantcode='$plantcode' and  orderm_date >='$tdate' and orderm_date <='$pdate' and  order_trtype='Order Stock' and orderm_tflag=1");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

    if($tot_arr_home >0) { 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="550" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Date wise Order Search From Date:<?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="900" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="52" align="center" valign="middle" class="tblheading">#</td>
			<td width="101"  align="center" valign="middle" class="tblheading">Date</td>
			<td width="117"  align="center" valign="middle" class="tblheading">Order No.</td>
				<td width="141" align="center" valign="middle" class="tblheading">Order Type</td>
			    <td width="210"  align="center" valign="middle" class="tblheading">Party Name </td>
			    <td width="104"  align="center" valign="middle" class="tblheading">Party Type</td>
			   <td width="76"  align="center" valign="middle" class="tblheading">Order  Status</td>
			    <td width="81" align="center" valign="middle" class="tblheading">Order Details</td>
			   <!--   <td width="84" align="center" valign="middle" class="tblheading">Qty</td>
	       <td width="56" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="53" align="center" valign="middle" class="tblheading">GOT Status</td>
            <td width="40" align="center" valign="middle" class="tblheading">Status</td>-->
</tr>
<?php
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['orderm_id'];
	$novariety=0;
$sql_tbl_sub=mysqli_query($link,"select distinct(order_sub_variety) from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."'") or die(mysqli_error($link));
$sql_tbl2=mysqli_fetch_array($sql_tbl_sub);


$dispatch="";
		if(($row_arr_home['orderm_cancelflag']==0 && $row_arr_home['orderm_supflag']==0 && $row_arr_home['orderm_tflag']==1 )&&($row_arr_home['orderm_holdflag']==1 || $sql_tbl2['order_sub_hold_flag']==1))
		{
		  $dispatch="Hold";
		}
		else if( $row_arr_home['orderm_cancelflag']==0 && $row_arr_home['orderm_supflag']==0 && $row_arr_home['orderm_tflag']==1 && $row_arr_home['orderm_holdflag']==0 && $sql_tbl2['order_sub_hold_flag']==0 && $row_arr_home['orderm_dispatchflag']==0)
		{
		  $dispatch="Live";
		}
		else if($row_arr_home['orderm_dispatchflag']==1)
		{
		 $dispatch="Dispatch";
		}
		else if($row_arr_home['orderm_supflag']==1)
		{
		$dispatch="Suspend";
		}
		else if($row_arr_home['orderm_cancelflag']!=0)
		{
		$dispatch="Cancel";
		}
		else if($row_arr_home['orderm_dispatchflag']==2)
		{
		$dispatch="Part Dispatch";
		}
		else if($sql_tbl2['order_sub_sup_flag']==1 && $row_arr_home['orderm_supflag']==0)
		{
		$dispatch="Part Suspend";
		}
		else
		{
		$dispatch="";
		}
/*		echo "Order No: ".$row_arr_home['orderm_porderno'];
echo "Cancel - ".$row_arr_home['orderm_cancelflag']."<br>";
echo "Hold - ".$row_arr_home['orderm_holdflag']."<br>";
echo "Suspend - ".$row_arr_home['orderm_supflag']."<br>";
echo "Dispatch - ".$row_arr_home['orderm_dispatchflag']."<br>";
echo "Part Dispatch - ".$sql_tbl2['order_sub_dispatch_flag']."<br>";
echo "Part Suspend - ".$sql_tbl2['order_sub_sup_flag']."<br>";
echo "<br>";
		echo $dispatch;
		echo "<br>";echo "<br>";*/
$partytype="";
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_arr_home['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row_arr_home['orderm_party']!="" && $row_arr_home['orderm_party'] > 0 )
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_arr_home['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	$partytyp=$row_arr_home['orderm_party_type'];
	$partytype == "Select";
	}
	else 
	{
	$partyname=$row_arr_home['orderm_partyname'];
	$partytyp=$row_arr_home['orderm_party_type'];
	$partytyp="Fill";
	}
	

	
if($srno%2!=0)
{
?>

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="101" align="center" valign="middle" class="smalltblheading"><?php echo $trdate?></td>
         <td width="117" align="center" valign="middle" class="smalltblheading"><?php echo $row_arr_home['orderm_porderno'];?></td>
		   <td width="141" align="center" valign="middle" class="smalltblheading"><?php echo $row_arr_home['order_trtype'];?></td>
         <td width="210" align="center" valign="middle" class="smalltblheading"><?php echo $partyname;?></td>
		 <td width="104" align="center" valign="middle" class="smalltblheading"><?php echo $partytyp;?></td>
         <td width="76" align="center" valign="middle" class="smalltblheading"><?php echo $dispatch?></td>
  <td align="center" valign="middle" class="smalltblheading">&nbsp;<a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_arr_home['orderm_id'];?>');">View</a></td>       
<!-- -->
         
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="101" align="center" valign="middle" class="smalltblheading"><?php echo $trdate?></td>
         <td width="117" align="center" valign="middle" class="smalltblheading"><?php echo $row_arr_home['orderm_porderno'];?></td>
		   <td width="141" align="center" valign="middle" class="smalltblheading"><?php echo $row_arr_home['order_trtype'];?></td>
         <td width="210" align="center" valign="middle" class="smalltblheading"><?php echo $partyname;?></td>
		 <td width="104" align="center" valign="middle" class="smalltblheading"><?php echo $partytyp;?></td>
         <td width="76" align="center" valign="middle" class="smalltblheading"><?php echo $dispatch?></td>
       <td align="center" valign="middle" class="smalltblheading">&nbsp;<a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_arr_home['orderm_id'];?>');">View</a></td>   
        
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
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}

?>
  
 <table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="utility_order_status.php"><img src="../images/back.gif" alt="Back" border="0" style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;</td>
</tr>
</table>  
  
</td>
<td ></td>
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
