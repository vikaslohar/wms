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
	
		if(isset($_REQUEST['txtlot']))
	{
  $lot = $_REQUEST['txtlot'];
	}
	
	if(isset($_REQUEST['txtlot1']))
	{
	  $lot1 = $_REQUEST['txtlot1'];
	}
	if(isset($_REQUEST['txtlot2']))
	{
	  $lot2 = $_REQUEST['txtlot2'];
	}
	if(isset($_REQUEST['txtlot3']))
	{
	  $lot3 = $_REQUEST['txtlot3'];
	}
			 $a=$lot.$lot1."/".$lot2;
		
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order-Utility-Order Number wise-Holding Status</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="indent.js"></script>

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



function rck(rval)
{
//alert(rval);
document.frmaddDepartment.flagcode.value=rval;
}
function mySubmit()
{ 
	
	/*if(document.frmaddDepartment.flagcode.value=="")
	{
		alert("Select Report Type");
		document.frmaddDepartment.flagcode.focus();
		return false;
	}*/
	
	
return true;
}
function openslocpopprint(subid)
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('view.php?itmid='+itm+'&subid='+subid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//}
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
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
		  <!-- actual page start--->	

   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25">&nbsp;Utility - Order Number wise Search</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	 
	  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
	  
	  <?php
 $lot = $_REQUEST['txtlot'];
	 $lot1 = $_REQUEST['txtlot1'];
	  $lot2 = $_REQUEST['txtlot2'];
	 $a=$lot.$lot1."/".$lot2;
	
	 
$ort=""; $ptype=""; $orst=""; $far="";  $dispatch=""; $party="";
$srno=1;
//$txtlot1;

$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_porderno like '%".$a."%'and orderm_cancelflag=0 and orderm_supflag=0 and orderm_tflag=1 and orderm_holdflag=1 ")or die(mysqli_error($link));
  $tot_crop=mysqli_num_rows($sql_tbl);
  if($tot_crop > 0)
{
	while($row_arr=mysqli_fetch_array($sql_tbl))
	{
	
	    $row_arr['orderm_cancelflag'];
		 $arrival_id=$row_arr['orderm_id'];
		
		  $sql_tbl1=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_id='".$arrival_id."'")or die(mysqli_error($link));
				 $sql_tbl2=mysqli_fetch_array($sql_tbl1);
		
		
		$dispatch="";
		if(($row_arr['orderm_cancelflag']==0 && $row_arr['orderm_supflag']==0 && $row_arr['orderm_tflag']==1 )&&($row_arr['orderm_holdflag']==1 || $sql_tbl2['order_sub_hold_flag']==1))
		{
		  $dispatch="Hold";
		}
		else if( $row_arr['orderm_cancelflag']==0 && $row_arr['orderm_supflag']==0 && $row_arr['orderm_tflag']==1 && $row_arr['orderm_holdflag']==0 && $sql_tbl2['order_sub_hold_flag']==0 )
		{
		  $dispatch="Live";
		}
		else if($row_arr['orderm_dispatchflag']==1)
		{
		 $dispatch="Dispatch";
		}
		else if($row_arr['orderm_supflag']==1)
		{
		$dispatch="Suspend";
		}
		else if($row_arr['orderm_cancelflag']!=0)
		{
		$dispatch="Cancel";
		}
		else if($sql_tbl2['order_sub_dispatch_flag']==1 && $row_arr['orderm_dispatchflag']==0)
		{
		$dispatch="Part Dispatch";
		}
		else if($sql_tbl2['order_sub_sup_flag']==1 && $row_arr['orderm_supflag']==0)
		{
		$dispatch="Part Suspend";
		}
		else
		{
		$dispatch="";
		}
	
	


$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_arr['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	if($row_arr['orderm_party']!=""   && $row_arr['orderm_party'] > 0 )
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_arr['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$party=$row3['business_name'];
	$ptyp=$row_arr['orderm_party_type'];
	$ptyp == "Select";
	}
	else 
	{
	$party=$row_arr['orderm_partyname'];
	$ptyp=$row_arr['orderm_party_type'];
	$ptyp="Fill";
	}
	

		 $trdate=$row_arr['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
		 $arr_type=$sql_tbl2['order_trtype'];
       $orno=$row_arr['orderm_porderno'];
		 $ort=$row_arr['order_trtype'];
		$ptype=$row_arr['orderm_pname'];
				
			}		
	
		
if($srno%2!=0)
{
?>

	 
    <tr class="Light" height="25">
      <td align="left" class="subheading" style="color:#303918; " colspan="3">Order Number: <?php echo $orno;?></td>
         
          </tr>
	</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">

        <tr class="tblsubtitle" height="20">
          <td width="17" height="45" align="center" valign="middle" class="tblheading">#</td>
		   <td width="53" align="center"  valign="middle" class="tblheading"> Date</td>
		   <td width="99"  align="center" valign="middle" class="tblheading">Order No.</td>
          <td width="131" align="center"  valign="middle" class="tblheading">Order Type</td>
         		  <td width="169" align="center"  valign="middle" class="tblheading">Party Name</td>
		
          <td width="113" align="center"  valign="middle" class="tblheading">Party Type </td>
            <td width="94" align="center" valign="middle" class="tblheading">Order Status</td>
         <td width="106" align="center" valign="middle" class="tblheading">Order Details</td>
		          </tr>

	
<tr class="Light" height="20">
          <td width="17" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
		  <td align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td> 
		   <td width="99" align="center" valign="middle" class="smalltblheading"><?php echo $orno;?></td>
          <td width="131" align="center" valign="middle" class="smalltblheading"><?php echo $ort;?></td>
		  <td width="169" align="center" valign="middle" class="smalltblheading"><?php echo $party;?></td>
          <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $ptyp;?></td>
				          <td width="94" align="center" valign="middle" class="smalltblheading"><?php echo $dispatch;?>&nbsp;</td>
          <td align="center" valign="middle" class="smalltblheading">&nbsp;<?php if($dispatch!="Cancel" && $dispatch!="Suspend"){ ?><a href="Javascript:void(0)" onClick="openslocpopprint('<?php echo $arrival_id;?>');">View</a><?php }?></td>
    	 
          </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
         <td width="17" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
		  <td align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td> 
		    <td width="99" align="center" valign="middle" class="smalltblheading"><?php echo $orno;?></td>
          <td width="131" align="center" valign="middle" class="smalltblheading"><?php echo $ort;?></td>
		
		  <td width="169" align="center" valign="middle" class="smalltblheading"><?php echo $party;?></td>
		  
          <td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $ptyp;?></td>
				          <td width="94" align="center" valign="middle" class="smalltblheading"><?php echo $dispatch;?>&nbsp;</td>
           <td align="center" valign="middle" class="smalltblheading">&nbsp;<?php if($dispatch!="Cancel" && $dispatch!="Suspend"){ ?><a href="Javascript:void(0)" onClick="openslocpopprint('<?php echo $arrival_id;?>');">View</a><?php }?></td>
    	         
          </tr>
		 <?php
  }
$srno=$srno+1;		  
	}
else
{

?>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25">
    <td colspan="10" align="center" class="subheading">No Records found for selected Order No. </td>
  </tr>
  </table>
<?php
}

?>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="utility_order_holding.php"><input name="Submit" type="image" src="../images/back.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();" align="middle"></a>&nbsp;&nbsp;</td>
</tr>
</table>
</form> 
</td>
</tr>
</table>
  
          </td>
          <td ></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>

	  
	  
    </td>
  </tr>
</table>


