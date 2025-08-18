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

if(isset($_REQUEST['p_id'])) { $pid = $_REQUEST['p_id']; }
if(isset($_REQUEST['remarks'])) { $remarks=trim($_REQUEST['remarks']); }	
if(isset($_GET['txt11'])) { $txt11 = $_GET['txt11']; }
if(isset($_GET['txtslflchk'])) { $txtslflchk = $_GET['txtslflchk']; }
if(isset($_GET['txtptyp'])) { $txtptyp = $_GET['txtptyp']; }
if(isset($_GET['txtconchk'])) { $txtconchk = $_GET['txtconchk']; }
if(isset($_GET['txtupschk'])) { $txtupschk = $_GET['txtupschk']; }
if(isset($_GET['txtordno'])) { $txtordno= $_GET['txtordno']; }
if(isset($_GET['txtporf'])) { $txtporf = $_GET['txtporf']; }
if(isset($_GET['txtparty'])) { $txtparty = $_GET['txtparty']; }
if(isset($_GET['txtparty1'])) { $txtparty1 = $_GET['txtparty1']; }
if(isset($_GET['txtadd1'])) { $txtadd1= $_GET['txtadd1']; }
if(isset($_GET['txtcity1'])) { $txtcity1 = $_GET['txtcity1']; }
if(isset($_GET['txtstate1'])) { $txtstate1 = $_GET['txtstate1']; }
if(isset($_GET['txtpin1'])) { $txtpin1 = $_GET['txtpin1']; }
if(isset($_GET['pstd1'])) { $pstd1 = $_GET['pstd1']; }
if(isset($_GET['pphno1'])) { $pphno1 = $_GET['pphno1']; }
if(isset($_GET['txtcontact1'])) { $txtcontact1 = $_GET['txtcontact1']; }
if(isset($_GET['txttin'])) { $txttin = $_GET['txttin']; }
if(isset($_GET['txtpan'])) { $txtccst = $_GET['txtpan']; }
if(isset($_GET['txtparty2'])) { $txtparty2 = $_GET['txtparty2']; }
if(isset($_GET['txtadd2'])) { $txtadd2= $_GET['txtadd2']; }
if(isset($_GET['txtcity2'])) { $txtcity2 = $_GET['txtcity2']; }
if(isset($_GET['txtstate2'])) { $txtstate2 = $_GET['txtstate2']; }
if(isset($_GET['txtpin2'])) { $txtpin2 = $_GET['txtpin2']; }
if(isset($_GET['pstd2'])) { $pstd2 = $_GET['pstd2']; }
if(isset($_GET['pphno2'])) { $pphno2 = $_GET['pphno2']; }
if(isset($_GET['txtcontact2'])) { $txtcontact2 = $_GET['txtcontact2']; }
if(isset($_GET['txttin2'])) { $txtctin2 = $_GET['txttin2']; }
if(isset($_GET['txtpan2'])) { $txtccst2 = $_GET['txtpan2']; }
if(isset($_GET['txtorderplby'])) { $txtorderplby= $_GET['txtorderplby']; }
if(isset($_GET['txttname'])) { $txttname= $_GET['txttname']; }
if(isset($_GET['txtlrn'])) { $txtlrn= $_GET['txtlrn']; }
if(isset($_GET['txtvn'])) { $txtvn = $_GET['txtvn']; }
if(isset($_GET['txt13'])) { $txt13= $_GET['txt13']; }
if(isset($_GET['txtcname'])) { $txtcname = $_GET['txtcname']; }
if(isset($_GET['txtdc'])) { $txtdc= $_GET['txtdc']; }
if(isset($_GET['txtpname'])) { $txtpname = $_GET['txtpname']; }
if(isset($_REQUEST['txtpp'])) { $party = $_REQUEST['txtpp']; }
if(isset($_GET['txtstatesl'])) { $txtstatesl= $_GET['txtstatesl']; }
if(isset($_GET['txtlocationsl'])) { $txtlocationsl= $_GET['txtlocationsl']; }
if(isset($_GET['txtcountrysl'])) { $txtcountrysl= $_GET['txtcountrysl']; }
//echo $party;
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

$sql_main="update tbl_orderm set orderm_porderno='$txtordno', orderm_partyrefno='$txtporf', orderm_partyselect='$txtslflchk', orderm_party_type='$txtptyp', orderm_party='$txtparty', orderm_partyname='$txtparty1', orderm_partyaddress='$txtadd1', orderm_partycity='$txtcity1', orderm_partystate='$txtstate1', orderm_partypin='$txtpin1', orderm_partyphstd='$pstd1', orderm_partyphno='$pphno1', orderm_partymobile='$txtcontact1', orderm_partytin='$txttin', orderm_partypan='$txtccst', orderm_consigneeapp='$txtconchk', orderm_consigneename='$txtparty2', orderm_conadd='$txtadd2', orderm_concity='$txtcity2', orderm_conpin='$txtpin2', orderm_constate='$txtstate2', orderm_conphonestd='$pstd2', orderm_conphoneno='$pphno2', orderm_conmobile='$txtcontact2', orderm_contin='$txtctin2', orderm_conpan='$txtccst2', orderm_placedby='$txtorderplby', orderm_tmode='$txt11', orderm_trname='$txttname', orderm_lrno='$txtlrn', orderm_vehno='$txtvn', orderm_paymode='$txt13', orderm_cname='$txtcname',  orderm_docno='$txtdc', orderm_pname='$txtpname', remarks='$remarks' ,orderm_party_type='$party', orderm_locstate='$txtstatesl', orderm_location='$txtlocationsl', orderm_country='$txtcountrysl' where orderm_id='$pid'";

$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));


	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
		$sql_code="SELECT MAX(orderm_trcode) FROM tbl_orderm where plantcode='$plantcode' and order_trtype='Order TDF' and yearcode='$ycode' ORDER BY orderm_trcode DESC";
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
		
		$sql_code12="SELECT MAX(orderm_ncode) FROM tbl_orderm where plantcode='$plantcode' and order_trtype='Order TDF' and yearcode='$ycode' ORDER BY orderm_ncode DESC";
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
		$orderno="OD".$ncode."/".$ycode."/".$logid;
	$sql_main="update tbl_orderm set orderm_porderno='$orderno', orderm_tflag=1, orderm_trcode=$code, orderm_ncode='$ncode' where orderm_id = '$pid'";
	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		echo "<script>window.location='select_trial_op.php?p_id=$pid'</script>";	
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order- Trial/Demo/Free-Preview</title>
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
winHandle=window.open('order_trial_view.php?itmid='+itm+'&remarks='+remarks,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Order - Trial/Demo/Free</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
<?php 
$tid=$pid;
 
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and logid='".$logid."' and order_trtype='Order TDF' and orderm_id='".$tid."'") or die(mysqli_error($link));
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
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['orderm_code']?>" />

		</br>


<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="6" align="center" class="tblheading">Order - Trial/Demo/Free Preview </td>
  </tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
  <tr class="Dark" height="30">
    <td width="188" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
    <td width="219"  align="left" valign="middle" class="tbltext">&nbsp;
        <?php echo "TOD".$row_tbl['orderm_code']."/".$ycode."/".$lgnid;?></td>
    <td width="240" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
    <td align="left" width="293" valign="middle" class="tbltext" colspan="3">&nbsp;
        <?php echo $tdate;?></td>
  </tr>
  <?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$partytype="";$partytyp=""; $partyname=""; $partyadd="";
	if($row_tbl['orderm_partyselect']=="selectp") {	$partytype="Select"; } else { $partytype="Fill"; }
	
	if($partytype == "Select")
	{
	
	$partytyp=$row_tbl['orderm_party_type'];
	$partyname=$row3['business_name']; 
	$city="";$pin1="";
	if($row3['city']!="")
	$city=", ".$row3['city'];
	$pin1="";
	if($row3['pin']!="")
	 if ($row3['pin'] >0 ){ 
	 $pin1=" - ".$row3['pin'];}
	//$partyadd=$row3['address'].$city." ".$pin1.", ".$row3['state'];
	//$partyadd=$row3['address'].$city.", ".$row3['state'].$pin1; 
	if($row3['mob']!="" && $row3['mob']!=0){$mbno="Mob no.-".$row3['mob'];}if($row3['phone']!=""){$phno="Phone no. ".$row3['std']."-".$row3['phone'];}
	
	$partyadd=$row3['address'].$city.", ".$row3['state'].$pin1.", ".$phno.", ".$mbno; 
	}
	else
	{
	$partytyp=""; $phno=""; $mbno=""; 
	$partyname=$row_tbl['orderm_partyname'];
	$city="";
	if($row_tbl['orderm_partycity']!="")
	$city=",".$row_tbl['orderm_partycity'];
	
	if($row_tbl['orderm_partyphno']!="")
	$phno="Phone no. ".$row_tbl['orderm_partyphstd']."-".$row_tbl['orderm_partyphno'];
	
	if($row_tbl['orderm_partymobile']!="")
	$mbno="Mob no. ".$row_tbl['orderm_partymobile'];
	
	$pin="";
	if ($row_tbl['orderm_partypin'] >0 ){ 
	$pin=" - ".$row_tbl['orderm_partypin'];}
	$partyadd=$row_tbl['orderm_partyaddress'].$city.$pin.", ".$row_tbl['orderm_partystate'].", ".$phno.", ".$mbno; 
	}
	
?>
  <tr class="Light" height="30">
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;Order No.&nbsp;</td>
    <td align="left" width="219" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_porderno'];?></td>
    <td align="right" width="240" valign="middle" class="tblheading">&nbsp;Party Order Ref. No.&nbsp;</td>
    <td align="left" width="293" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_partyrefno'];?></td>
  </tr>
  <tr class="Dark" height="30">
    <td align="right"  valign="middle" class="tblheading" >Party&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;
        <?php echo $partytype;?></td>
    <td align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;
        <?php echo $partytyp;?></td>
  </tr>
  <?php
$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$row_tbl['orderm_location']."' order by productionlocation")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
if($partytype == "Select")
{
if($row_tbl['orderm_party_type']!="Export Buyer")
{	
?>
  <tr class="Dark" height="30">
    <td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_locstate'];?></td>
    <td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
    <td align="left" valign="middle" class="tbltext">&nbsp;
        <?php echo $noticia['productionlocation'];?></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Dark" height="30">
    <td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;
        <?php echo $row_tbl['orderm_country'];?></td>
  </tr>
  <?php
}
}
?>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="6">&nbsp;<?php echo $partyname;?></td>
       
  </tr>
  <tr class="Dark" height="30">
    <td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div style="padding-left:4px"><?php echo $partyadd;?></div></td>

  </tr>
  <?php
if($partytype != "Select")
{
?>
  <tr class="Dark" height="30">
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;TIN&nbsp;</td>
    <td align="left" width="219" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_partytin'];?></td>
    <td align="right" width="240" valign="middle" class="tblheading">PAN&nbsp;</td>
    <td align="left" width="293" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_partypan'];?></td>
  </tr>
  <?php
}
?>
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading">Consignee Applicable&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"  colspan="5">&nbsp;
        <?php if($row_tbl['orderm_consigneeapp']=="Yes1"){ echo "Yes";} else{ echo "No";}?></td>
  </tr>
  <?php 
if($row_tbl['orderm_consigneeapp']=="Yes1")
{
?>
  <tr class="Dark" height="30">
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;Consignee Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;
        <?php echo $row_tbl['orderm_consigneename'];?></td>
  </tr>
  <tr class="Light" height="25">
    <td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div style="padding-left:4px"><?php echo $row_tbl['orderm_conadd'];?><?php if($row_tbl['orderm_concity']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_concity'];}?><?php if($row_tbl['orderm_conpin']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_conpin'];}?> <?php if($row_tbl['orderm_constate']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_constate'];}?><?php if($row_tbl['orderm_country']!=""){?>,&nbsp;<?php echo $row_tbl['orderm_country'];}?>
      <?php if($row_tbl['orderm_conphoneno']!=""){?>,&nbsp;Phone:<?php echo $row_tbl['orderm_conphonestd']."-".$row_tbl['orderm_conphoneno'];}?><?php if($row_tbl['orderm_conmobile']!=""){?>Mobile:<?php echo $row_tbl['orderm_conmobile'];}?></div></td>
      
      
   
  </tr>
  <?php
if($row_tbl['orderm_party_type']!="Export Buyer")
{
?>
  <tr class="Dark" height="30">
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;TIN&nbsp;</td>
    <td align="left" width="219" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_contin'];?></td>
    <td align="right" width="240" valign="middle" class="tblheading">&nbsp;PAN&nbsp;</td>
    <td align="left" width="293" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_conpan'];?></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Dark" height="30">
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;UDF 1&nbsp;</td>
    <td align="left" width="219" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_contin'];?></td>
    <td align="right" width="240" valign="middle" class="tblheading">&nbsp;UDF 2&nbsp;</td>
    <td align="left" width="293" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_conpan'];?></td>
  </tr>
  <?php
}
?>
  <?php
}
?>
  <tr class="Light" height="30">
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;Order Placed By&nbsp;</td>
    <td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_placedby'];?></td>
  </tr>
  <tr class="Dark" height="25">
    <td height="35" align="right"  valign="middle" class="tblheading">&nbsp;Preferred Mode of Dispatch&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_tmode'];?></td>
    <?php
if($row_tbl['orderm_tmode'] == "Transport")
{
?>
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;
        <?php echo $row_tbl['orderm_trname'];?></td>
    <?php
}
else if($row_tbl['orderm_tmode'] == "Courier")
{
?>
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" >&nbsp;
        <?php echo $row_tbl['orderm_cname'];?></td>
    <?php
}
else 
{
?>
    <td align="right" width="188" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
    <td align="left" valign="middle" class="tbltext">&nbsp;
        <?php echo $row_tbl['orderm_pname'];?></td>
    <?php
}
?>
  </tr>
</table>
  <br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
 $sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="141" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
        <td width="74" align="center" valign="middle" class="tblheading">Variety Type</td>
        <td width="242" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
		<td width="45" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="83" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="34" align="center" valign="middle" class="tblheading">NoP</td>
		</tr>
  <?php
$srno=1;$itmdchk="";$itmdchk1="";
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
		
$up=""; $up1=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt=""; $zz="";
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
if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="141" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
        <td width="74" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['order_sub_variety_typ'];?></td>
        <td width="242" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="83" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="34" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		<td width="141" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
        <td width="74" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['order_sub_variety_typ'];?></td>
        <td width="242" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="83" align="center" valign="middle" class="tblheading"><?php echo $qt;?></td>
		<td width="34" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		</tr>		
<?php
}
$srno++;
}
}

?>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr class="Dark" height="30">
<td width="66" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="878" colspan="20" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $remarks;?></td>
</tr>
</table>  
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_order_trial.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
