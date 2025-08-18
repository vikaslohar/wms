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
	
	if(isset($_REQUEST['p_id'])) { $p_id = $_REQUEST['p_id']; }
	if(isset($_REQUEST['remarks'])) { $remarks=trim($_REQUEST['remarks']); }
	if(isset($_REQUEST['txtconchk'])) { $txtconchk=trim($_REQUEST['txtconchk']); }
	if(isset($_REQUEST['txtupschk'])) { $txtupschk=trim($_REQUEST['txtupschk']); }
	if(isset($_REQUEST['txtordno'])) { $txtordno=trim($_REQUEST['txtordno']); }
	if(isset($_REQUEST['txtporf'])) { $txtporf=trim($_REQUEST['txtporf']); }
	if(isset($_REQUEST['txtstfp'])) { $txtstfp=trim($_REQUEST['txtstfp']); }
	if(isset($_REQUEST['txt12'])) { $txt12 = $_REQUEST['txt12']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	if(isset($_REQUEST['txtadd'])) { $txtadd=trim($_REQUEST['txtadd']); }
	if(isset($_REQUEST['txtcity'])) { $txtcity=trim($_REQUEST['txtcity']); }
	if(isset($_REQUEST['txtstate'])) { $txtstate = $_REQUEST['txtstate']; }
	if(isset($_REQUEST['txtpin'])) { $txtpin = $_REQUEST['txtpin']; }
	if(isset($_REQUEST['pstd'])) { $pstd=trim($_REQUEST['pstd']); }
	if(isset($_REQUEST['pphno'])) { $pphno=trim($_REQUEST['pphno']); }
	if(isset($_REQUEST['txtcontact'])) { $txtcontact = $_REQUEST['txtcontact']; }
	if(isset($_REQUEST['txtctin'])) { $txtctin=trim($_REQUEST['txtctin']); }
	if(isset($_REQUEST['txtccst'])) { $txtccst=trim($_REQUEST['txtccst']); }
	if(isset($_REQUEST['txtorderplby'])) { $txtorderplby=trim($_REQUEST['txtorderplby']); }
	if(isset($_REQUEST['txt11'])) { $txt11=trim($_REQUEST['txt11']); }
	if(isset($_REQUEST['txttname'])) { $txttname = $_REQUEST['txttname']; }
	if(isset($_REQUEST['txtlrn'])) { $txtlrn = $_REQUEST['txtlrn']; }
	if(isset($_REQUEST['txtvn'])) { $txtvn = $_REQUEST['txtvn']; }
	if(isset($_REQUEST['txt13'])) { $txt13 = $_REQUEST['txt13']; }
	if(isset($_REQUEST['txtcname'])) { $txtcname = $_REQUEST['txtcname']; }
	if(isset($_REQUEST['txtdc'])) { $txtdc = $_REQUEST['txtdc']; }
	if(isset($_REQUEST['txtdcno'])) { $txtdcno = $_REQUEST['txtdcno']; }
	if(isset($_REQUEST['txtpname'])) { $txtpname = $_REQUEST['txtpname']; }
	if(isset($_REQUEST['txtpp'])) { $party = $_REQUEST['txtpp']; }
	if(isset($_GET['txtstatesl'])) { $txtstatesl= $_GET['txtstatesl']; }
	if(isset($_GET['txtlocationsl'])) { $txtlocationsl= $_GET['txtlocationsl']; }
	
	if($party=="CandF")
	{
	$party="C&F";
	}
	if($party=="C")
	{
	$party="C&F";
	}
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];
	
$sql_main="update tbl_orderm set orderm_porderno='$txtordno', orderm_partyrefno='$txtporf', orderm_party='$txtstfp', orderm_consigneeapp='$txtconchk', orderm_consigneename='$txtparty', orderm_conadd='$txtadd', orderm_concity='$txtcity', orderm_conpin='$txtpin', orderm_constate='$txtstate', orderm_conphonestd='$pstd', orderm_conphoneno='$pphno', orderm_conmobile='$txtcontact', orderm_contin='$txtctin', orderm_concst='$txtccst', orderm_placedby='$txtorderplby', orderm_tmode='$txt11', orderm_trname='$txttname', orderm_lrno='$txtlrn', orderm_vehno='$txtvn', orderm_paymode='$txt13', orderm_cname='$txtcname', orderm_docno='$txtdc', orderm_pname='$txtpname',  remarks='$remarks', orderm_party_type='$party', orderm_locstate='$txtstatesl', orderm_location='$txtlocationsl' where orderm_id='$p_id'";
$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));


	
	if(isset($_POST['frm_action'])=='submit')
	{
		 $pid=trim($_POST['txtitem']);
		
		$sql_code="SELECT MAX(orderm_trcode) FROM tbl_orderm where plantcode='$plantcode' and order_trtype='Order Stock' and yearcode='$ycode' ORDER BY orderm_trcode DESC";
		$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
		}
		else
		{
			$code=1;
		}
		
		$sql_code12="SELECT MAX(orderm_ncode) FROM tbl_orderm where plantcode='$plantcode' and order_trtype='Order Stock' and yearcode='$ycode' ORDER BY orderm_ncode DESC";
		$res_code12=mysqli_query($link,$sql_code12)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code12) > 0)
		{
				$row_code12=mysqli_fetch_row($res_code12);
				$t_code12=$row_code12['0'];
				$ncode=$t_code12+1;
		}
		else
		{
			$ncode=1;
		}
		$orderno="OT".$ncode."/".$ycode."/".$logid;
	$sql_main="update tbl_orderm set orderm_porderno='$orderno', orderm_tflag=1, orderm_trcode=$code, orderm_ncode='$ncode' where orderm_id = '$pid'";
	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));

		echo "<script>window.location='select_orderstock_op.php?p_id=$pid'</script>";	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Transaction - Order Stock - Transfer- Preview</title>
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

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}
function openslocpopprint()
{
if(document.mainform.txtitem.value!="")
{
var itm=document.mainform.txtitem.value;
var remarks=document.mainform.remarks.value
winHandle=window.open('order_stock_view.php?itmid='+itm+'&remarks='+remarks,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.mainform.txtitem.focus();
}
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Order-Stock Transfer</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
<?php 
 $tid=$p_id;

$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and logid='".$logid."' and order_trtype='Order Stock' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>	  
<form name="mainform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $p_id?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['orderm_code']?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" class="tblheading">Order - Stock Transfer Preview </td>
  </tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
  <tr class="Light" height="30">
    <td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
    <td width="196"  align="left" valign="middle" class="tbltext">&nbsp;
        <?php echo "TOS".$row_tbl['orderm_code']."/".$ycode."/".$lgnid;?></td>
    <td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
    <td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;
        <?php echo $tdate;?></td>
  </tr>
  <?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
  <tr class="Dark" height="30">
    <td align="right" width="173" valign="middle" class="tblheading">&nbsp;Order No.&nbsp;</td>
    <td align="left" width="196" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_porderno'];?></td>
    <td align="right" width="207" valign="middle" class="tblheading">&nbsp;Party Order Ref. No.&nbsp;</td>
    <td align="left" width="264" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_partyrefno'];?></td>
  </tr>
  <?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$row_tbl['orderm_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
  <tr class="Light" height="30">
    <td align="right" width="196" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left" width="216" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_locstate'];?></td>
    <td align="right" width="231" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
    <td align="left" width="297" valign="middle" class="tbltext">&nbsp;
        <?php echo $noticia['productionlocation'];?></td>
  </tr>
  <tr class="Dark" height="30">
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;
        <?php echo $row_tbl['orderm_party_type'];?></td>
  </tr>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading" >Stock Transfer  To&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;
        <?php echo $row3['business_name'];?></td>
  </tr>
  <tr class="Dark" height="30">
    <td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address'];?><?php if($row3['city']!=""){ echo " ".$row3['city'];}?> ,<?php echo $row3['state'];?><?php if($row3['pin']!=0 && $row3['pin']!=""){echo ", Pin no.-".$row3['pin'];}?><?php if($row3['mob']!="" && $row3['mob']!=0){echo ", Mob no.-".$row3['mob'];}?><?php if($row3['phone']!=""){echo ", Phone no. ".$row3['std']."-".$row3['phone'];}?><?php if($row3['tin']!=""){echo ", Tin no.-".$row3['tin'];}?><?php echo ".";?>&nbsp;</td>
        
  </tr>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading">Consignee Applicable&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"  colspan="5">&nbsp;<?php echo $row_tbl['orderm_consigneeapp'];?></td>
  </tr>
     
  <?php 
if($row_tbl['orderm_consigneeapp']=="Yes")
{
if($row_tbl['orderm_conpin']!="")
	 if ($row_tbl['orderm_conpin'] >0 ){ 
	 $pin="-".$row_tbl['orderm_conpin'];} ?>
  <tr class="Dark" height="30">
    <td align="right" width="173" valign="middle" class="tblheading">&nbsp;Consignee Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;
        <?php echo $row_tbl['orderm_consigneename'];?></td>
  </tr>
  <tr class="Light" height="25">
    <td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
  <td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div style="padding-left:4px"><?php echo $row_tbl['orderm_conadd'];?>,&nbsp;<?php echo $row_tbl['orderm_concity'];?><?php echo $pin;?>&nbsp;<?php if($row_tbl['orderm_constate']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_constate'];}?><?php if($row_tbl['orderm_country']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_country'];}?>&nbsp;<?php if($row_tbl['orderm_conphoneno']!=""){?>&nbsp;Phone:<?php echo $row_tbl['orderm_conphonestd']."-".$row_tbl['orderm_conphoneno'];}?> <?php if($row_tbl['orderm_conmobile']!=""){?>Mobile:<?php echo $row_tbl['orderm_conmobile'];}?></div></td>
     
  </tr>
  <tr class="Dark" height="30">
    <td align="right" width="173" valign="middle" class="tblheading">&nbsp;TIN&nbsp;</td>
    <td align="left" width="196" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_contin'];?></td>
    <td align="right" width="207" valign="middle" class="tblheading">&nbsp;CST&nbsp;</td>
    <td align="left" width="264" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_concst'];?></td>
  </tr>
  <?php
}
?>
  <tr class="Light" height="30">
    <td align="right" width="173" valign="middle" class="tblheading">&nbsp;Order Placed By&nbsp;</td>
    <td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_placedby'];?></td>
  </tr>
  <tr class="Dark" height="25">
    <td height="35" align="right"  valign="middle" class="tblheading">&nbsp;Preferred Mode of Dispatch&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;
        <?php echo $row_tbl['orderm_tmode'];?></td>
    <?php
if($row_tbl['orderm_tmode'] == "Transport")
{
?>
    <td align="right" width="196" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;
        <?php echo $row_tbl['orderm_trname'];?></td>
    <?php
}
else if($row_tbl['orderm_tmode'] == "Courier")
{
?>
    <td align="right" width="196" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;
        <?php echo $row_tbl['orderm_cname'];?></td>
    <?php
}
else 
{
?>
    <td align="right" width="196" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
    <td align="left" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_pname'];?></td>
  </tr>
  <?php
}
?>
</table>
  <br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="2%" align="center" valign="middle" class="tblheading">#</td>
		<td width="10%" align="center" valign="middle" class="tblheading">&nbsp;Crop</td>
        <td width="5%" align="center" valign="middle" class="tblheading">Variety Type</td>
        <td width="12%" align="center" valign="middle" class="tblheading">&nbsp;Variety</td>
		<td width="11%" align="center" valign="middle" class="tblheading">&nbsp;PV Variety</td>
		<td width="3%" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="7%" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="7%" align="center" valign="middle" class="tblheading">Total Qty (Kgs.)</td>
		<td width="6%" align="center" valign="middle" class="tblheading">SMC Qty (Kgs.)</td>
		<td width="6%" align="center" valign="middle" class="tblheading">L.Qty (Kgs.)</td>
        <td width="6%" align="center" valign="middle" class="tblheading">PT</td>
        <td width="4%" align="center" valign="middle" class="tblheading">Std MP</td>
        <td width="4%" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="5%" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="4%" align="center" valign="middle" class="tblheading">NoMP</td>
</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1=""; $grtqty=0; $grsmqty=0; $grlqty=0; $getmp=""; $grtnop=0; $grtnowb=0; $getnomp=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];

$sql_pvveriety=mysqli_query($link,"select * from tblvariety where varietyid='".$p_1['pvverid']."' and actstatus='Active'") or die(mysqli_error($link));
$p_12=mysqli_fetch_array($sql_pvveriety);
$pvvariety=$p_12['popularname'];
		
$up=""; $qt=""; $qt1="";$zz="";$np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt=""; $vtype=""; $smcqty=""; $lqty="";
$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
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

if($smcqty!="")
$smcqty=$smcqty."<br />".$row_sloc['order_sub_subqty'];
else
$smcqty=$row_sloc['order_sub_subqty'];
 
if($lqty!="") 
$lqty=$lqty."<br />".$row_sloc['order_sub_sublqty'];
else
$lqty=$row_sloc['order_sub_sublqty'];

if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";

$grtqty=$grtqty+$qt1; 
$grsmqty=$grsmqty+$row_sloc['order_sub_subqty'];
$grlqty=$grlqty+$row_sloc['order_sub_sublqty'];
$grtnop=$grtnop+$row_sloc['order_sub_sub_nop'];
$grtnowb=$grtnowb+$nowb;
$getnomp=$getnomp+$nomp;

}
if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}
$vtype=$row_tbl_sub['order_sub_variety_typ'];

/*$grtqty=$grtqty+$qt; 
$grsmqty=$grsmqty+$smcqty;
$grlqty=$grlqty+$lqty;
$grtnop=$grtnop+$np;
$grtnowb=$grtnowb+$nowbp;
$getnomp=$getnomp+$nompp;*/

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
		<td width="10%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $crop;?></td>
        <td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $vtype;?></td>
        <td width="12%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $variety;?></td>
		<td width="11%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $pvvariety;?></td>
		<td width="3%" align="center" valign="middle" class="smalltblheading"><?php echo $up1;?></td>
		<td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
        <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $smcqty;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $lqty;?></td>
        <td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $ptp;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $stdptv;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $np;?></td>
		<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $nowbp;?></td>
		<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $nompp;?></td>
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
		<td width="10%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $crop;?></td>
        <td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $vtype;?></td>
        <td width="12%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $variety;?></td>
		<td width="11%" align="center" valign="middle" class="smalltblheading">&nbsp;<?php echo $pvvariety;?></td>
		<td width="3%" align="center" valign="middle" class="smalltblheading"><?php echo $up1;?></td>
		<td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $up;?></td>
        <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $qt;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $smcqty;?></td>
		<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $lqty;?></td>
        <td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $ptp;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $stdptv;?></td>
        <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $np;?></td>
		<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $nowbp;?></td>
		<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $nompp;?></td>
</tr>		
<?php
}
$srno++;
}
}

?>
<tr class="Light" height="20">
    <td width="2%" align="right" valign="middle" class="smalltblheading" colspan="7">Grand Total&nbsp;</td>
    <td width="7%" align="center" valign="middle" class="smalltblheading"><?php echo $grtqty;?></td>
	<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $grsmqty;?></td>
	<td width="6%" align="center" valign="middle" class="smalltblheading"><?php echo $grlqty;?></td>
    <td width="6%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
    <td width="4%" align="center" valign="middle" class="smalltblheading">&nbsp;</td>
    <td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $grtnop;?></td>
	<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $grtnowb;?></td>
	<td width="4%" align="center" valign="middle" class="smalltblheading"><?php echo $getnomp;?></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="Dark" height="30">
<td width="65" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="879" colspan="20" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $remarks;?></td>
</tr>
</table> 
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_order_stock.php?p_id=<?php echo $p_id;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
</body>