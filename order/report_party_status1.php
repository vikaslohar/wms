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
	
	if(isset($_REQUEST['cdate'])) { $cdate = $_REQUEST['cdate']; }
	if(isset($_REQUEST['txttypchk'])) { $txttypchk = $_REQUEST['txttypchk']; }
	if(isset($_REQUEST['txt11'])) { $txt11=trim($_REQUEST['txt11']); }
	if(isset($_REQUEST['foccode'])) { $foccode=trim($_REQUEST['foccode']); }
	if(isset($_REQUEST['foccode1'])) { $foccode1=trim($_REQUEST['foccode1']); }
	if(isset($_REQUEST['txtcrop'])) { $txtcrop=trim($_REQUEST['txtcrop']); }
	if(isset($_REQUEST['txtvariety'])) { $txtvariety=trim($_REQUEST['txtvariety']); }
	if(isset($_REQUEST['txtpartycat1'])) { $txtpartycat1=trim($_REQUEST['txtpartycat1']); }
	if(isset($_REQUEST['fillpartyname1'])) { $fillpartyname1=trim($_REQUEST['fillpartyname1']); }
	if(isset($_REQUEST['orsrval'])) { $orsrval = $_REQUEST['orsrval']; }
	if(isset($_REQUEST['orderno'])) { $orderno = $_REQUEST['orderno']; }
	if(isset($_REQUEST['txtlot'])) { $txtlot = $_REQUEST['txtlot']; }
	if(isset($_REQUEST['txtlot1'])) { $txtlot1 = $_REQUEST['txtlot1']; }
	if(isset($_REQUEST['txtlot2'])) { $txtlot2 = $_REQUEST['txtlot2']; }
	if(isset($_REQUEST['partyname'])) { $partyname = $_REQUEST['partyname']; }
	if(isset($_REQUEST['txtpartycat'])) { $txtpartycat=trim($_REQUEST['txtpartycat']); }
	if(isset($_REQUEST['fillpartyname'])) { $fillpartyname=trim($_REQUEST['fillpartyname']); }
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	$partyname_org=$partyname;
	
	if($txtpp=="CandF")
	{
	$txtpp="C&F";
	}
	if($txtpp=="C")
	{
	$txtpp="C&F";
	}
	
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Booking -Utility-Party-wise-Holding Status</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
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

function openprint(cdate,txttypchk,txt11,txtcrop,txtvariety,txtpartycat1,fillpartyname1,orsrval,orderno,txtlot,txtlot1,txtlot2,partyname_org,txtpartycat,fillpartyname,txtpp,txtstatesl,txtlocationsl,txtcountrysl,txtptype,txtparty,sdate,edate)
{
winHandle=window.open('report_hold2.php?cdate='+cdate+'&txttypchk='+txttypchk+'&txt11='+txt11+'&txtcrop='+txtcrop+'&txtvariety='+txtvariety+'&txtpartycat1='+txtpartycat1+'&fillpartyname1='+fillpartyname1+'&orsrval='+orsrval+'&orderno='+orderno+'&txtlot='+txtlot+'&txtlot1='+txtlot1+'&txtlot2='+txtlot2+'&partyname='+partyname_org+'&txtpartycat='+txtpartycat+'&fillpartyname='+fillpartyname+'&txtpp='+txtpp+'&txtstatesl='+txtstatesl+'&txtlocationsl='+txtlocationsl+'&txtcountrysl='+txtcountrysl+'&txtptype='+txtptype+'&txtparty='+txtparty+'&sdate='+sdate+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
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
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	     <td width="813" height="25">Utility -&nbsp;Party-wise-Holding Status</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden">
		   <input name="txtgstat" value="<?php echo $typ;?>" type="hidden"> 
		  <input name="txtstfp" value="<?php echo $vv;?>" type="hidden">  
	 	 <input name="txtvariety" value="<?php echo $ite;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
<?php
if($txttypchk=="Consolidated")
{
$mtyp="Consolidated";
$mtyp1="Consolidated Hold";
}
if($txttypchk=="Variety")
{
$mtyp="Variety";
$mtyp1="Variety Hold";
}
else if($txttypchk=="Party")
{
$mtyp="Party";
$mtyp1="Party Hold";
}
else if($txttypchk=="Order")
{
$mtyp="Order(s) of Party";
$mtyp1="Order(s) of Party Hold";
}
?>

<table align="center" border="1" bordercolor="#cc30cc" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  	
<!-- <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; " colspan="10"> Date:<?php echo $_GET['cdate'];?></td>
  	</tr>-->

<?php
if($txttypchk=="Consolidated")
{
?>

 <tr class="Dark" height="30">
<td width="190" align="right" valign="middle" class="tblheading">&nbsp;Type&nbsp;</td>
<td width="222"  align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $mtyp1;?></td>
</tr>
<?php
}
else
{
?>
 <tr class="Dark" height="30">
<td width="190" align="right" valign="middle" class="tblheading">&nbsp;Type&nbsp;</td>
<td width="222"  align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $mtyp1;?></td>

<td width="231" align="right"  valign="middle" class="tblheading" >&nbsp;Category&nbsp;</td>
<td align="left" width="297" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $txt11;?></td>
</tr>

<?php
if($txttypchk=="Variety")
{
$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$txtvariety."'  order by popularname Asc");
$noticia_item = mysqli_fetch_array($quer4);
?>
<tr class="Dark" height="30">
<td align="right" width="190" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" width="222" valign="middle" class="smalltblheading">&nbsp;<?php echo $noticia['cropname'];?></td>
<td align="right" width="231" valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left" width="297" valign="middle" class="smalltblheading">&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>
<?php
}
else if($txttypchk=="Party")
{
if($fillpartyname1=="")
{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$partyname."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname1=$row3['business_name']; 
?>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading" >Order Type&nbsp;</td>
    <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $txtpartycat1;?></td>
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $txtpp;?></td>
  </tr>
  <?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
//echo $txtstatesl."  -  ".$txtlocationsl."  -  ".$txtcountrysl;
if($txtpp!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $txtstatesl;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $txtcountrysl;?></td>
</tr>
<?php
}
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $partyname1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $partyname;?></td>
</tr>
<?php
}
?>
<?php
}
else if($txttypchk=="Order")
{
?>
<?php
if($orsrval=="ordersearch")
{
$styp="Order Search";
}
else if($orsrval=="partysearch")
{
$styp="Party Search";
}
else if($orsrval=="datesearch")
{
$styp="Date Search";
}

?>
 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >Search Type&nbsp;</td>
<td align="left"  valign="middle" class="smalltblheading"colspan="8">&nbsp;<?php echo $styp;?></td>
</tr>
<?php 
if($orsrval=="ordersearch")
{
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Order No.&nbsp;</td>
<td align="left"  valign="middle" class="smalltblheading" colspan="8" id="vaddress">&nbsp;<?php echo $orderno;?></td>
</tr>
<?php
}
else if($orsrval=="partysearch")
{
if($fillpartyname=="")
{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$partyname."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname1=$row3['business_name']; 
?>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading" >Order Type&nbsp;</td>
    <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $txtpartycat;?></td>
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="smalltblheading">&nbsp;<?php echo $txtpp;?></td>
  </tr>
  <?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
//echo $txtstatesl."  -  ".$txtlocationsl."  -  ".$txtcountrysl;
if($txtpp!="Export Buyer")
{	
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $txtstatesl;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $txtcountrysl;?></td>
</tr>
<?php
}
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $partyname1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="smalltblheading" colspan="8">&nbsp;<?php echo $partyname;?></td>
</tr>
<?php
}
?>
<?php
}
else if($orsrval=="datesearch")
{
?>
<tr class="Dark" height="30">
<td align="right" width="190" valign="middle" class="tblheading">Period - From Date&nbsp;</td>
<td align="left" width="222" valign="middle" class="smalltblheading">&nbsp;<?php echo $sdate;?></td>
<td align="right" width="231" valign="middle" class="tblheading">To Date&nbsp;</td>
<td align="left" width="297" valign="middle" class="smalltblheading">&nbsp;<?php echo $edate;?></td>
</tr>
<?php
}
}
?>
<?php
}
?>
</table>
<br />
<?php
 $a=$txttypchk;   $b=$txt11;
if($a=="Consolidated")
{ 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Typ.</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1;  $rec=0;
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));

$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
if($row_main['orderm_holdflag']==1)
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
}
else
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0 and order_sub_hold_flag=1 group by orderm_id") or die(mysqli_error($link));
}

$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
$flgtyp="";
while($row_sub=mysqli_fetch_array($sql_sub))
{

if($row_main['orderm_holdflag']==1)
{
$flgtyp=$row_main['orderm_holdtype'];
}
else
{
$flgtyp=$row_sub['order_sub_hold_type'];
}
	
	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $flgtyp;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $flgtyp;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<?php
}
else if($a=="Variety")
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1; $cnt=0;
$sql_main=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_crop='".$txtcrop."' and order_sub_variety='".$txtvariety."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0 and order_sub_hold_flag=1 group by orderm_id") or die(mysqli_error($link));
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{

if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
else
{
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$tdate=$row_sub['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_sub['orderm_party']!="" && $row_sub['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_sub['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_sub['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$txtvariety."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_sub['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_sub['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_main['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_sub_hold_type'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_sub['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_sub['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_main['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_sub_hold_type'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>

<?php
}
else if($a=="Party")
{ 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1;  $rec=0;
$ortyp="Order TDF"; 
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>

<?php
}
else if($a=="Order")
{ 
?>
<?php
if($orsrval!="partysearch")
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1; $cnt=0; 
$ortyp="Order TDF"; 
if($orsrval=="ordersearch")
{
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{

		$sdate=$sdate;
		$sday=substr($sdate,0,2);
		$smonth=substr($sdate,3,2);
		$syear=substr($sdate,6,4);
		$sdate1=$syear."-".$smonth."-".$sday;
		
		$edate=$edate;
		$eday=substr($edate,0,2);
		$emonth=substr($edate,3,2);
		$eyear=substr($edate,6,4);
		$edate1=$eyear."-".$emonth."-".$eday;	
			
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>

<?php
}
else
{
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="20" align="center" valign="middle" class="tblheading">#</td>
			<td width="70"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Order No.</td>
			<td width="75"  align="center" valign="middle" class="tblheading">Order Type</td>
			<td width="165"  align="center" valign="middle" class="tblheading">Party Name</td>
			<td width="100"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="145"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="55" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="71" align="center" valign="middle" class="tblheading">Hold Type</td>
</tr>
<?php
$srno=1;  $rec=0;
$ortyp="Order TDF"; 
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($fillpartyname!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($fillpartyname!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."'  order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="smalltblheading"><?php echo $srno?></td>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $tdate;?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="75" align="center" valign="middle" class="smalltblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="165" align="center" valign="middle" class="smalltblheading"><?php echo $partyname?></td>
	<td width="100" align="center" valign="middle" class="smalltblheading"><?php echo $noticia['cropname'];?></td>
	<td width="145" align="center" valign="middle" class="smalltblheading"><?php echo $noticia_item['popularname'];?></td>
<?php
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.$qt1."<br/>";
	else
	$qt=$qt1."<br/>";
	
	if($np!="")
	$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
	else
	$np=$row_sloc['order_sub_sub_nop']."<br/>";
	}
?>
	<td width="70" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $qt?></td>
	<td width="55" align="center" valign="middle" class="smalltblheading"><?php echo $np?></td>
	<td align="center" valign="middle" class="smalltblheading"><?php echo $row_main['orderm_holdtype'];?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
</table>
<?php
}
?>
<?php
}
else 
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Criteria</td></tr>
  </table>
<?php
}
?>

<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="utility_party_status.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;
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
