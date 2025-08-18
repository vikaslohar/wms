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
	
		
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['txtptyp'])) { $txtptyp = $_REQUEST['txtptyp']; }
	if(isset($_REQUEST['txt11'])) { $txt11=trim($_REQUEST['txt11']); }
	if(isset($_REQUEST['txtpartycat1'])) { $txtpartycat1=trim($_REQUEST['txtpartycat1']); }
	if(isset($_REQUEST['fillpartyname1'])) { $fillpartyname1=trim($_REQUEST['fillpartyname1']); }
	if(isset($_REQUEST['partyname'])) { $partyname = $_REQUEST['partyname']; }
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	if(isset($_REQUEST['reptyp1'])) { $reptyp1 = $_REQUEST['reptyp1']; }
	
	if($txtpp=="CandF")
	{
	$txtpp="C&F";
	}
	if($txtpp=="C")
	{
	$txtpp="C&F";
	}
	$partyname_org=$partyname;
	
			if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order-Report -Party wise Compiled Pending Order Report </title>
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

function openprint(sdate,txtptyp,txtptype,txt11,txtpartycat1,fillpartyname1,partyname,txtpp,txtstatesl,txtlocationsl,txtcountrysl,txtparty,reptyp1)
{

winHandle=window.open('report_pending2.php?sdate='+sdate+'&txtptyp='+txtptyp+'&txtptype='+txtptype+'&txt11='+txt11+'&txtpartycat1='+txtpartycat1+'&fillpartyname1='+fillpartyname1+'&partyname='+partyname+'&txtpp='+txtpp+'&txtstatesl='+txtstatesl+'&txtlocationsl='+txtlocationsl+'&txtcountrysl='+txtcountrysl+'&txtparty='+txtparty+'&reptyp1='+reptyp1,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
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
	      <td width="813" height="25">&nbsp;Party wise Compiled Pending Order Report </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	 	 <input name="txtgstat" value="<?php echo $typ;?>" type="hidden"> 
		  <input name="txtstfp" value="<?php echo $vv;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
if($reptyp1=="hold")
	    {	
			$aa="";
			$aa1="";
		}
		else
		{
			$aa=" and order_sub_hold_flag=0";
			$aa1=" and orderm_holdflag=0";
		}
		
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
if($fillpartyname1!="")
{
	$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='$fillpartyname1' and order_trtype='Order TDF' and  orderm_date  <= '$tdate' and  orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));

$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home > 0)
{ 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
  <tr height="25">
    <td  width="408" valign="middle" align="center" class="subheading" style="color:#303918; " colspan="3"><U>Party wise Compiled Pending Order Report as on date: <?php echo $_GET['sdate'];?></U></td>
  </tr>
  
<tr height="25" >  
    <td align="left" class="subheading" style="color:#303918; " colspan="3">Party Name: <?php echo $fillpartyname1;?></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="69" align="center" valign="middle" class="tblheading">Order No. </td>
			<td width="57" align="center" valign="middle" class="tblheading">Order Date </td>
			<td width="116"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="138"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="95"  align="center" valign="middle" class="tblheading">UPS</td>
			<td width="40"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="74" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="57" align="center" valign="middle" class="tblheading">Total Qty </td>
			<?php 
			if($reptyp1=="hold")
	    	{	
			?>	
			<td width="58" align="center" valign="middle" class="tblheading">Status</td>
			<?php
			}
			?>
</tr>

<?php
$srno=1; 

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$loc1="";
	 $arrival_id=$row_arr_home['orderm_id'];
	if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['orderm_porderno'];
		}
		else
		{
		$loc1=$row_arr_home['orderm_porderno'];
		}
	
	$status=""; $statussub=""; $status1="";
			if($reptyp1=="hold")
	    	{	
				if($row_arr_home['orderm_holdflag']!=0)
				$status1=$row_arr_home['orderm_holdtype'];	
			}
			else
			{
			$status1="";
			}
			
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' $aa order by order_sub_crop") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
			 $s_id=$sql_tbl_sub['orderm_id'];
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
     $crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus="";


			if($reptyp1=="hold")
	    	{	
				if($row_tbl_sub['order_sub_hold_flag']!=0)
				$statussub=$row_tbl_sub['order_sub_hold_type'];	
			}
			else
			{
			$statussub="";
			}


		$variet=$row_dept4['popularname'];
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['order_sub_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['order_sub_crop'];
		}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['order_sub_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['order_sub_variety'];	
		}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
		}
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['order_sub_totbal_qty'];
		}
		else
		{
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$per=$row_tbl_sub['pper'];
		}
		

$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";


	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";
if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
		}
		else
		{
		$sstatus=$row_sloc['order_sub_sub_nop'];
		}
		if($sstatus==0){
	 
	 $sstatus="";
	 }
	 //$row_tbl_sub['arrsub_id'];
	 }
	 
	if($status1=="")
	 $status=$statussub;
	 else
	 $status=$status1;
	 
if($stage > 0)	 
{	 
	if($srno%2!=0)
{

	
?>
	  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="116" align="center" valign="middle" class="tblheading"><?php echo $cro?></td>
    <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variet?></td>
    <td width="95" align="center" valign="middle" class="tblheading"><?php echo $up?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
    <td width="74" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<?php 
	if($reptyp1=="hold")
	{	
	?>	
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $status;?></td>
	<?php
	}
	?>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="116" align="center" valign="middle" class="tblheading"><?php echo $cro?></td>
    <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variet?></td>
    <td width="95" align="center" valign="middle" class="tblheading"><?php echo $up?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
    <td width="74" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<?php 
	if($reptyp1=="hold")
	{	
	?>	
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $status;?></td>
	<?php
	}
	?>
</tr>
<?php
}$srno=$srno+1;
}
}
}
//}

?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td height="19" colspan="10" align="center" class="subheading">No Records found for selected Period</td>
  </tr>
  </table>
<?php
}
}
else
{
?>
<?php
if($txtparty !="ALL")
{
	if($txtptyp=="TDF - Individual")
	{ 
		$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
	}
	else
	{
		if($txt11 != "TDF")
		{
			if($txtpp !="Export Buyer")
			{
				$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and orderm_party_type='$txtpp' and orderm_location='$txtlocationsl'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
			else
			{
				$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
		else
		{
			if($txtpp !="Export Buyer")
			{
				$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and orderm_party_type='$txtpp' and orderm_location='$txtlocationsl'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
			else
			{
				$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$txtparty' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
	}

$tot_arr_home=mysqli_num_rows($sql_arr_home);

		$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser where p_id='$txtparty'"); 
	$row3=mysqli_fetch_array($quer3);
		$variet=$row3['business_name'];
	//$variet1=$row3['pid'];

if($tot_arr_home > 0)
{ 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
  <tr height="25">
    <td  width="408" valign="middle" align="center" class="subheading" style="color:#303918; " colspan="3"><U>Party wise Compiled Pending Order Report as on date: <?php echo $_GET['sdate'];?></U></td>
  </tr>
<tr height="25" >  
    <td align="left" class="subheading" style="color:#303918;" colspan="3">Party Name: <?php echo $variet;?></td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="69" align="center" valign="middle" class="tblheading">Order No. </td>
			<td width="57" align="center" valign="middle" class="tblheading">Order Date </td>
			<td width="116"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="138"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="95"  align="center" valign="middle" class="tblheading">UPS</td>
			<td width="40"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="74" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="57" align="center" valign="middle" class="tblheading">Total Qty </td>
			<?php 
			if($reptyp1=="hold")
	    	{	
			?>	
			<td width="58" align="center" valign="middle" class="tblheading">Status</td>
			<?php
			}
			?>
</tr>

<?php
$srno=1; 

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
		$status=""; $statussub=""; $status1="";
			if($reptyp1=="hold")
	    	{	
				if($row_arr_home['orderm_holdflag']!=0)
				$status1=$row_arr_home['orderm_holdtype'];	
			}
			else
			{
			$status1="";
			}
	
	
	
	$loc1="";
	 $arrival_id=$row_arr_home['orderm_id'];
	if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['orderm_porderno'];
		}
		else
		{
		$loc1=$row_arr_home['orderm_porderno'];
		}
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' $aa order by order_sub_crop") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
			 $s_id=$sql_tbl_sub['orderm_id'];
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
     $crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus="";

		$variet=$row_dept4['popularname'];
		
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['order_sub_totbal_qty'];
		}
		else
		{
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		}
		
		if($reptyp1=="hold")
	    	{	
				if($row_tbl_sub['order_sub_hold_flag']!=0)
				$statussub=$row_tbl_sub['order_sub_hold_type'];	
			}
			else
			{
			$statussub="";
			}

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['order_sub_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['order_sub_crop'];
		}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['order_sub_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['order_sub_variety'];	
		}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		/*if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
		}
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['order_sub_totbal_qty'];
		}
		else
		{
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$per=$row_tbl_sub['pper'];
		}*/
		


$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";

	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";
if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
		}
		else
		{
		$sstatus=$row_sloc['order_sub_sub_nop'];
		}
			if($sstatus==0){
	 
	 $sstatus="";
	 }
	 //$row_tbl_sub['arrsub_id'];
	 }
	 
	 
if($status1=="")
	 $status=$statussub;
	 else
	 $status=$status1;
if($stage > 0)	 
{	 
	if($srno%2!=0)
{

	
?>
	  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="116" align="center" valign="middle" class="tblheading"><?php echo $cro?></td>
    <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variet?></td>
    <td width="95" align="center" valign="middle" class="tblheading"><?php echo $up?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
    <td width="74" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<?php 
	if($reptyp1=="hold")
	{	
	?>	
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $status;?></td>
	<?php
	}
	?>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="116" align="center" valign="middle" class="tblheading"><?php echo $cro?></td>
    <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variet?></td>
    <td width="95" align="center" valign="middle" class="tblheading"><?php echo $up?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
    <td width="74" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<?php 
	if($reptyp1=="hold")
	{	
	?>	
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $status;?></td>
	<?php
	}
	?>
</tr>
<?php
}$srno=$srno+1;
}
}
}
//}

?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td height="19" colspan="10" align="center" class="subheading">No Records found for selected Period</td>
  </tr>
  </table>
<?php
}
}
else
{
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
  <tr height="25">
    <td  width="408" valign="middle" align="center" class="subheading" style="color:#303918; " colspan="3"><U>Party wise Compiled Pending Order Report as on date: <?php echo $_GET['sdate'];?></U></td>
  </tr>
</table>
<?php
if($txtptyp=="TDF - Individual")
	{ 
		if($txtlocationsl !="ALL")
		{
				$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_location='$txtlocationsl' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
		else
		{
			$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_locstate='$txtstatesl' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
	}
	else
	{
		if($txt11 != "TDF")
		{
			if($txtpp !="Export Buyer")
			{
				if($txtlocationsl !="ALL")
				{
						$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_location='$txtlocationsl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_locstate='$txtstatesl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
					$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
		else
		{
			if($txtpp !="Export Buyer")
			{
				if($txtlocationsl !="ALL")
				{
						$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_location='$txtlocationsl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_locstate='$txtstatesl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
					$sql_arr_home22=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
	}



$tot_arr_home22=mysqli_num_rows($sql_arr_home22);
if($tot_arr_home22 > 0)
{
while($row_22=mysqli_fetch_array($sql_arr_home22))
{
//echo $row_22[0]."<BR>";
if($txtptyp=="TDF - Individual")
	{ 
		if($txtlocationsl !="ALL")
		{
				$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_location='$txtlocationsl' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
		else
		{
			$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_locstate='$txtstatesl' and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_supflag=0 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
		}
	}
	else
	{
		if($txt11 != "TDF")
		{
			if($txtpp !="Export Buyer")
			{
				if($txtlocationsl !="ALL")
				{
						$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_location='$txtlocationsl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_locstate='$txtstatesl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype!='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
		else
		{
			if($txtpp !="Export Buyer")
			{
				if($txtlocationsl !="ALL")
				{
						$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_location='$txtlocationsl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
				else
				{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_locstate='$txtstatesl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
				}
			}
			else
			{
					$sql_arr_home=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$row_22['orderm_party']."' and orderm_country='$txtcountrysl' and orderm_party_type='$txtpp'  and order_trtype='Order TDF' and orderm_date <= '$tdate' and orderm_tflag=1 and orderm_cancelflag=0 and orderm_supflag=0 and orderm_dispatchflag!=1 $aa1 order by orderm_date asc ") or die(mysqli_error($link));
			}
		}
	}
	
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
/*}*/
	$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser where p_id='".$row_22['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
		$variet=$row3['business_name'];
	//$variet1=$row3['pid'];

if($tot_arr_home > 0)
{ 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="849" style="border-collapse:collapse">
<tr height="25" >  
    <td align="left" class="subheading" style="color:#303918;" colspan="3">Party Name: <?php echo $variet;?></td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="69" align="center" valign="middle" class="tblheading">Order No. </td>
			<td width="57" align="center" valign="middle" class="tblheading">Order Date </td>
			<td width="116"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="138"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="95"  align="center" valign="middle" class="tblheading">UPS</td>
			<td width="40"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="74" align="center" valign="middle" class="tblheading">NoP</td>
			<td width="57" align="center" valign="middle" class="tblheading">Total Qty </td>
			<?php 
			if($reptyp1=="hold")
	    	{	
			?>	
			<td width="58" align="center" valign="middle" class="tblheading">Status</td>
			<?php
			}
			?>
</tr>

<?php
$srno=1; 

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orderm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
		
		$status=""; $statussub=""; $status1="";
			if($reptyp1=="hold")
	    	{	
				if($row_arr_home['orderm_holdflag']!=0)
				$status1=$row_arr_home['orderm_holdtype'];	
			}
			else
			{
			$status1="";
			}

		
		
	$loc1="";
	 $arrival_id=$row_arr_home['orderm_id'];
	if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['orderm_porderno'];
		}
		else
		{
		$loc1=$row_arr_home['orderm_porderno'];
		}
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' $aa order by order_sub_crop") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
			 $s_id=$sql_tbl_sub['orderm_id'];
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
     $crop=""; $variety="";  $stage=""; $got=""; $sstatus=""; $up="";$qt="";$sstatus="";

		
		if($reptyp1=="hold")
	    	{	
				if($row_tbl_sub['order_sub_hold_flag']!=0)
				$statussub=$row_tbl_sub['order_sub_hold_type'];	
			}
			else
			{
			$statussub="";
			}

		
		$variet=$row_dept4['popularname'];
		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['order_sub_crop'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['order_sub_crop'];
		}
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crop'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$cro=$row_dept5['cropname'];
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['order_sub_variety'];
		}
		else
		{
		$variety=$row_tbl_sub['order_sub_variety'];	
		}
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$variety' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$variet=$row_dept4['popularname'];
		
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['order_sub_totbal_qty'];
		}
		else
		{
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		}
		/*if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
		}
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['order_sub_totbal_qty'];
		}
		else
		{
		$stage=$row_tbl_sub['order_sub_totbal_qty'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$per=$row_tbl_sub['pper'];
		}*/
		


$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$arrival_id."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.$up1."<br/>";
	else
	$up=$up1."<br/>";

	$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";
if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_sloc['order_sub_sub_nop'];
		}
		else
		{
		$sstatus=$row_sloc['order_sub_sub_nop'];
		}
			if($sstatus==0){
	 
	 $sstatus="";
	 }
	 //$row_tbl_sub['arrsub_id'];
	 }
	 
	 if($status1=="")
	 $status=$statussub;
	 else
	 $status=$status1;
if($stage > 0)	 
{	 
	if($srno%2!=0)
{

	
?>
	  

<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="116" align="center" valign="middle" class="tblheading"><?php echo $cro?></td>
    <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variet?></td>
    <td width="95" align="center" valign="middle" class="tblheading"><?php echo $up?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
    <td width="74" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<?php 
	if($reptyp1=="hold")
	{	
	?>	
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $status;?></td>
	<?php
	}
	?>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $loc1;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
	<td width="116" align="center" valign="middle" class="tblheading"><?php echo $cro?></td>
    <td width="138" align="center" valign="middle" class="tblheading"><?php echo $variet?></td>
    <td width="95" align="center" valign="middle" class="tblheading"><?php echo $up?></td>
    <td width="40" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
    <td width="74" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
    <td width="57" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
	<?php 
	if($reptyp1=="hold")
	{	
	?>	
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $status;?></td>
	<?php
	}
	?>
</tr>
<?php
}$srno=$srno+1;
}
}
}
//}

?>
</table><br />

<?php
}
}
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td height="19" colspan="10" align="center" class="subheading">No Records found for selected Period</td>
  </tr>
  </table>

<?php
}
}
}

?>
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_pen.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint('<?php echo $sdate?>','<?php echo $txtptyp?>','<?php echo $txtptype?>','<?php echo $txt11?>','<?php echo $txtpartycat1?>','<?php echo $fillpartyname1?>','<?php echo $partyname?>','<?php echo $txtpp?>','<?php echo $txtstatesl?>','<?php echo $txtlocationsl?>','<?php echo $txtcountrysl?>','<?php echo $txtparty?>','<?php echo $reptyp1?>')" style="cursor:pointer" border="0" />
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
