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
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];

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
	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
	 $a=$txttypchk;   $b=$txt11;
	if($txttypchk=="Variety")
	{
		$orn=explode(",", $foccode);
		foreach($orn as $fid)
		  	{		
				$sql_in1="update tbl_order_sub set order_sub_hold_flag=1, order_sub_hold_type='Variety Hold' where orderm_id='$fid' and order_sub_variety='".$txtvariety."'";	
				$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			}	
			
		$orn1=explode(",", $foccode1);
		foreach($orn1 as $fid1)
		  	{		
				$sql_in1="update tbl_order_sub set order_sub_hold_flag=0 where orderm_id='$fid1' and order_sub_variety='".$txtvariety."'";	
				$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			}
	}
	if($txttypchk=="Party")
	{
		if($b=="Commercial")
		{ $ortyp="Order TDF";
		$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname_org."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
		else if($b=="TDF")
		{
		$ortyp="Order TDF";
			if($fillpartyname1!="")
			{
			$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname_org."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
			}
			else
			{
			$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname_org."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
			}
		}
		else
		{
			if($fillpartyname1!="")
			{
			$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname_org."'  and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
			}
			else
			{
			$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname_org."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
			}
		}
		$tot_main=mysqli_num_rows($sql_main);
		
		$orn=explode(",", $foccode);
		$arcnt=count($orn);
		if($arcnt==$tot_main)
		$htyp="Party Hold";
		else
		$htyp="Order Hold";
		
		foreach($orn as $fid)
		  	{		
				$sql_in1="update tbl_orderm set orderm_holdflag=1, orderm_holdtype='$htyp' where orderm_id='$fid'";	
				$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			}	
		$orn1=explode(",", $foccode1);
		foreach($orn1 as $fid1)
		  	{		
				$sql_in1="update tbl_orderm set orderm_holdflag=0 where orderm_id='$fid1' ";	
				$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			}	
	}
	if($txttypchk=="Order")
	{
		if($orsrval=="ordersearch")
		{ 
			$orn=explode(",", $foccode);
			foreach($orn as $fid)
				{		
					$sql_in1="update tbl_orderm set orderm_holdflag=1, orderm_holdtype='Order Hold' where orderm_id='$fid' ";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}	
			$orn1=explode(",", $foccode1);
			foreach($orn1 as $fid1)
				{		
					$sql_in1="update tbl_orderm set orderm_holdflag=0 where orderm_id='$fid1' ";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}
		}
		if($orsrval=="partysearch")
		{
			if($b=="Commercial")
			{ $ortyp="Order TDF";
			$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname_org."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
			}
			else if($b=="TDF")
			{
			$ortyp="Order TDF";
				if($fillpartyname!="")
				{
				$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname_org."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
				}
				else
				{
				$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname_org."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
				}
			}
			else
			{
				if($fillpartyname!="")
				{
				$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname_org."'  and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
				}
				else
				{
				$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname_org."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
				}
			}
			$tot_main=mysqli_num_rows($sql_main);
			
			$orn=explode(",", $foccode);
			$arcnt=count($orn);
			if($arcnt==$tot_main)
			$htyp="Party Hold";
			else
			$htyp="Order Hold";
		
			foreach($orn as $fid)
				{		
					$sql_in1="update tbl_orderm set orderm_holdflag=1, orderm_holdtype='$htyp' where orderm_id='$fid'";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}	
			$orn1=explode(",", $foccode1);
			foreach($orn1 as $fid1)
				{		
					$sql_in1="update tbl_orderm set orderm_holdflag=0 where orderm_id='$fid1' ";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}	
		}
		if($orsrval=="datesearch")
		{
			$orn=explode(",", $foccode);
			foreach($orn as $fid)
				{		
					$sql_in1="update tbl_orderm set orderm_holdflag=1, orderm_holdtype='Order Hold' where orderm_id='$fid'";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}	
			$orn1=explode(",", $foccode1);
			foreach($orn1 as $fid1)
				{		
					$sql_in1="update tbl_orderm set orderm_holdflag=0 where orderm_id='$fid1'";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}	
		}
	}

		echo "<script>window.location='home_hold.php'</script>";	
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Stock Transfer Arrival - Preview</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
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

function openslocpopprint(txttypchk,txt11,foccode,foccode1,txtcrop,txtvariety,txtpartycat1,fillpartyname1,orsrval,orderno,txtlot,txtlot1,txtlot2,partyname_org,txtpartycat,fillpartyname,txtpp,txtstatesl,txtlocationsl,txtcountrysl,txtptype,txtparty,sdate,edate)
{
winHandle=window.open('holdunhold_order_view.php?txttypchk='+txttypchk+'&txt11='+txt11+'&foccode='+foccode+'&foccode1='+foccode1+'&txtcrop='+txtcrop+'&txtvariety='+txtvariety+'&txtpartycat1='+txtpartycat1+'&fillpartyname1='+fillpartyname1+'&orsrval='+orsrval+'&orderno='+orderno+'&txtlot='+txtlot+'&txtlot1='+txtlot1+'&txtlot2='+txtlot2+'&partyname='+partyname_org+'&txtpartycat='+txtpartycat+'&fillpartyname='+fillpartyname+'&txtpp='+txtpp+'&txtstatesl='+txtstatesl+'&txtlocationsl='+txtlocationsl+'&txtcountrysl='+txtcountrysl+'&txtptype='+txtptype+'&txtparty='+txtparty+'&sdate='+sdate+'&edate='+edate,'WelCome','top=170,left=180,width=820,height=550,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocpop(itm)
{
winHandle=window.open('booked_order_details.php?itmid='+itm,'WelCome','top=170,left=180,width=800,height=550,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}


function mySubmit()
{ 
		if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	return true;	 
	}
	else
	{
	return false;
	} 
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Holding- Unholding  Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form name="mainform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading"> Holding- Unholding Preview </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php
if($txttypchk=="Variety")
{
$mtyp="Variety";
}
else if($txttypchk=="Party")
{
$mtyp="Party";
}
else if($txttypchk=="Order")
{
$mtyp="Order(s) of Party";
}

?>
 <tr class="Dark" height="30">
<td width="190" align="right" valign="middle" class="tblheading">&nbsp;Hold-Unhold Type&nbsp;</td>
<td width="222"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $mtyp;?></td>

<td width="231" align="right"  valign="middle" class="tblheading" >&nbsp;Category&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $txt11;?></td>
</tr>
<?php
if($txttypchk=="Variety")
{
$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$txtvariety."' and actstatus='Active' order by popularname Asc");
$noticia_item = mysqli_fetch_array($quer4);
?>
<tr class="Dark" height="30">
<td align="right" width="190" valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left" width="222" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['cropname'];?></td>
<td align="right" width="231" valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext">&nbsp;<?php echo $noticia_item['popularname'];?></td>
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
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $txtpartycat1;?></td>
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $txtpp;?></td>
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
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $txtstatesl;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="8">&nbsp;<?php echo $txtcountrysl;?></td>
</tr>
<?php
}
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="8">&nbsp;<?php echo $partyname1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="8">&nbsp;<?php echo $partyname;?></td>
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
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $styp;?></td>
</tr>
<?php 
if($orsrval=="ordersearch")
{
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Order No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $orderno;?></td>
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
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $txtpartycat;?></td>
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $txtpp;?></td>
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
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $txtstatesl;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia['productionlocation'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $txtcountrysl;?></td>
</tr>
<?php
}
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="8">&nbsp;<?php echo $partyname1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="8">&nbsp;<?php echo $partyname;?></td>
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
<td align="left" width="222" valign="middle" class="tbltext">&nbsp;<?php echo $sdate;?></td>
<td align="right" width="231" valign="middle" class="tblheading">To Date&nbsp;</td>
<td align="left" width="297" valign="middle" class="tbltext">&nbsp;<?php echo $edate;?></td>
</tr>
<?php
}
}
?>
</table>
<br />
<?php
 $a=$txttypchk;   $b=$txt11;
if($a=="Variety")
{ 
?><table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="31" align="center" valign="middle" class="tblheading">#</td>
	<td width="42" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="91" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="163" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="125" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="296" align="center" valign="middle" class="tblheading">Party Name</td>
	<td width="86" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php

$srno=1; $cnt=0;
$sql_main=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_crop='".$txtcrop."' and order_sub_variety='".$txtvariety."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0 group by orderm_id") or die(mysqli_error($link));
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
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" disabled="disabled" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_sub['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_sub['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" disabled="disabled" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_sub['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_sub['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
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
?><table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="36" align="center" valign="middle" class="tblheading">#</td>
	<td width="77" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="153" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="269" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="213" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="88" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php

$srno=1;  $ort=$c; $rec=0;
//if($ort=="TDF - Individual")$ort="Individual";
//$sql_main=mysqli_query($link,"select * from tbl_order_sub where order_sub_crop='".$c."' and order_sub_variety='".$f."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."'  and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
$row_sub=mysqli_fetch_array($sql_sub);

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
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" disabled="disabled" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" disabled="disabled" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
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
else if($a=="Order")
{ 
?>
<?php
if($orsrval!="partysearch")
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="31" align="center" valign="middle" class="tblheading">#</td>
	<td width="42" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="91" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="163" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="125" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="296" align="center" valign="middle" class="tblheading">Party Name</td>
	<td width="86" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php

$srno=1; $cnt=0; 
if($orsrval=="ordersearch")
{
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
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
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
$row_sub=mysqli_fetch_array($sql_sub);

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
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" disabled="disabled" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="42" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" disabled="disabled" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?>	 /></td>
	<td width="91" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="163" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="125" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="296" align="center" valign="middle" class="tblheading"><?php echo $partyname;?></td>
	<td width="86" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
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
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="36" align="center" valign="middle" class="tblheading">#</td>
	<td width="77" align="center" valign="middle" class="tblheading">Hold</td>
	<td width="153" align="center" valign="middle" class="tblheading">Date of Order</td>
	<td width="269" align="center" valign="middle" class="tblheading">Order No.</td>
	<td width="213" align="center" valign="middle" class="tblheading">Order Type</td>
	<td width="88" align="center" valign="middle" class="tblheading">View</td>
</tr>
<?php
$srno=1; $cnt=0; 

if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
		if($fillpartyname!="")
		{
		$ortyp="Order TDF";
		$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
		else
		{
			$ortyp="Order TDF";
			$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
	}
	else
	{ 
		if($fillpartyname!="")
		{
		$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
		else
		{
			
		$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		}
	}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
$row_sub=mysqli_fetch_array($sql_sub);

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" disabled="disabled" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
	<td width="36" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="77" align="center" valign="middle" class="tblheading"><input type="checkbox" name="hluhlcb" disabled="disabled" value="<?php echo $row_main['orderm_id'];?>" <?php $orn=explode(",", $foccode);	foreach($orn as $fid) {	if($row_main['orderm_id'] == $fid) echo "checked"; }?> /></td>
	<td width="153" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="269" align="center" valign="middle" class="tblheading"><?php echo $row_main['orderm_porderno'];?></td>
	<td width="213" align="center" valign="middle" class="tblheading"><?php echo $row_main['order_trtype'];?></td>
	<td width="88" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onclick="openslocpop('<?php echo $row_main['orderm_id'];?>');">View</a></td>
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
<?php
}
else 
{
?><table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="tblheading">Records Not Found.</td>
	</tr>

</table>
<?php
}
?><input type="hidden" name="srno" value="<?php echo $srno;?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_hold.php?txttypchk=<?php echo $txttypchk?>&txt11=<?php echo $txt11?>&foccode=<?php echo $foccode?>&foccode1=<?php echo $foccode1?>&txtcrop=<?php echo $txtcrop?>&txtvariety=<?php echo $txtvariety?>&txtpartycat1=<?php echo $txtpartycat1?>&fillpartyname1=<?php echo $fillpartyname1?>&orsrval=<?php echo $orsrval?>&orderno=<?php echo $orderno?>&txtlot=<?php echo $txtlot?>&txtlot1=<?php echo $txtlot1?>&txtlot2=<?php echo $txtlot2?>&partyname=<?php echo $partyname_org?>&txtpartycat=<?php echo $txtpartycat?>&fillpartyname=<?php echo $fillpartyname?>&txtpp=<?php echo $txtpp?>&txtstatesl=<?php echo $txtstatesl?>&txtlocationsl=<?php echo $txtlocationsl?>&txtcountrysl=<?php echo $txtcountrysl?>&txtptype=<?php echo $txtptype?>&txtparty=<?php echo $txtparty?>&sdate=<?php echo $sdate?>&edate=<?php echo $edate?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $txttypchk?>','<?php echo $txt11?>','<?php echo $foccode?>','<?php echo $foccode1?>','<?php echo $txtcrop?>','<?php echo $txtvariety?>','<?php echo $txtpartycat1?>','<?php echo $fillpartyname1?>','<?php echo $orsrval?>','<?php echo $orderno?>','<?php echo $txtlot?>','<?php echo $txtlot1?>','<?php echo $txtlot2?>','<?php echo $partyname_org?>','<?php echo $txtpartycat?>','<?php echo $fillpartyname?>','<?php echo $txtpp?>','<?php echo $txtstatesl?>','<?php echo $txtlocationsl?>','<?php echo $txtcountrysl?>','<?php echo $txtptype?>','<?php echo $txtparty?>','<?php echo $sdate?>','<?php echo $edate?>');"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>
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
