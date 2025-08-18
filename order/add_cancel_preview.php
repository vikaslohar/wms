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
	
	if(isset($_REQUEST['txtparty']))
	{
   $party = $_REQUEST['txtparty'];
	}
	
	if(isset($_REQUEST['txttype']))
	{
	 $aa = $_REQUEST['txttype'];
	}
	if(isset($_REQUEST['txtid'])) { $candate = $_REQUEST['txtid']; }
	if(isset($_REQUEST['candate'])) { $candate = $_REQUEST['candate']; }
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	if($party=="" && $txtpp!="")$party=$txtpp;
		$tdate=$candate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
/*echo $sql_main="update tbl_orderm set order_trtype='$type'  where orderm_id = '$party'";
$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));*/


	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
	$party=$_REQUEST['txtparty'];
	 
	$sql_arr=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$party."' and orderm_cancelflag=2") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
		$partyid=$row_arr['orderm_id'];
		
		$sql_code="SELECT MAX(order_cancode) FROM tbl_orderm where plantcode='$plantcode' and yearcode='$ycode'  ORDER BY order_cancode DESC";
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
		
		 $sql_in1="update tbl_orderm set orderm_cancelflag=1, order_candate='".$tdate."', order_cancode='".$code."' where orderm_id='".$partyid."'";	
		$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
	}
	
		echo "<script>window.location='select_cancel_op.php?txtparty=$party&txttype=$aa&txtpp=$txtpp&txtptype=$txtptype&txtcountrysl=$txtcountrysl&txtlocationsl=$txtlocationsl&txtstatesl=$txtstatesl&txttype=$aa'</script>";	
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orderl- Transaction - Order Cancel - Preview</title>
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
function openslocpop(party)
{
winHandle=window.open('order_cancel_view.php?itmid='+party,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocpop1(val1,val2,val3,val4)
{
winHandle=window.open('cancel_view.php?itmid='+val1+'&txttype='+val2+'&txtpp='+val3+'&txtptype='+val4,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Order-Cancel</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form name="mainform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtparty" value="<?php echo $party?>" />
		<input type="hidden" name="txttype" value="<?php echo $aa?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		<input type="hidden" name="dcdate" value="<?php echo $tdate1?>" />
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['arrival_code']?>" />

		</br>

<?php 
 $tid=$pid;
?>
<?php
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$party."' and orderm_cancelflag!=0 and orderm_dispatchflag!=1 and orderm_holdflag=0") or die(mysqli_error($link));
$row_tbl1=mysqli_fetch_array($sql_tbl);
$total_tbl=mysqli_num_rows($sql_tbl);			
$tid=$row_tbl1['orderm_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_dispatch_flag=0 and order_sub_hold_flag=0 and orderm_id='".$tid."'") or die(mysqli_error($link));
  $total_tbl1=mysqli_num_rows($sql_tbl_sub);
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading"> Order - Cancel Preview </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Dark" height="30">
	<td width="223" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
	<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $candate;?></td>
	<td width="180" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="236"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$txtid."/".$ycode."/".$lgnid?></td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$party."'"); 
	$row3=mysqli_fetch_array($quer3);
	
?>
<tr class="Light" height="30">
<?php if($aa!="TDF") {?>
	<td align="right"  valign="middle" class="tblheading" >Order Type&nbsp;</td>
    <td width="201" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $aa;?></td>
    <td width="180" align="right"  valign="middle" class="tblheading" >Party Type&nbsp;</td>
    <td width="236" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $txtpp;?></td>
<?php } else {?>
	<td align="right"  valign="middle" class="tblheading" >Order Type&nbsp;</td>
    <td width="201" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $aa;?></td>
<?php } ?>	
</tr>
<?php
if($txtpp!="Export Buyer")
{	
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
$noticia3 = mysqli_fetch_array($sql_month3);
// $noticia3['productionlocation'];
?>	
<?php if($aa!="TDF") {?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $txtstatesl;?></td>
<td align="right" valign="middle" class="tblheading">&nbsp;Location&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $noticia3['productionlocation'];?></td>
</tr>
<?php } ?>	
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry where country='".$row_tbl1['orderm_country']."' order by country")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($sql_month);
?>
<tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="8">&nbsp;<?php echo $row_tbl1['orderm_country'];?></td>
</tr>
<?php
}
?>
 <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"colspan="6">&nbsp;<?php echo $row3['business_name'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address'];?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?><?php if($row3['pin']!=0 && $row3['pin']!=""){echo ", Pin no.-".$row3['pin'];}?><?php if($row3['mob']!="" && $row3['mob']!=0){echo ", Mob no.-".$row3['mob'];}?><?php if($row3['phone']!=""){echo ", Phone no. ".$row3['std']."-".$row3['phone'];}?><?php if($row3['tin']!=""){echo ", Tin no.-".$row3['tin'];}?><?php echo ".";?>&nbsp;</td>
</tr>

</table>
<br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="6" align="right" class="tblheading">  Selected  Records  &nbsp;&nbsp;</td></tr>

<?php
  
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$party'and  orderm_cancelflag=2") or die(mysqli_error($link));


?>
  <tr class="tblsubtitle" height="20">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Order Date </td>
                 <td width="58" align="center" valign="middle" class="tblheading">Order No.</td>
			 <td width="75" align="center" valign="middle" class="tblheading">View Order</td>
			  <!-- <td width="43" align="center" valign="middle" class="tblheading">&nbsp;</td>
            <td width="48" align="center" valign="middle" class="tblheading">Party Name</td>-->
	</tr>
  <?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl=mysqli_fetch_array($sql_tbl))
{

 $arrival_id=$row_tbl['orderm_id'];
 
  $row_tbl['orderm_ncode'];
	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	if($srno%2!=0)
{

?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;<input name="fln" type="hidden" size="52" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
    <td width="75" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;<input name="fln" type="hidden" size="52" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
   <td width="75" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
		 <?php
}

$srno++;
}
}

//}

?>
 </table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_cancel.php?candate=<?php echo $candate;?>&txtparty=<?php echo $party;?>&txttype=<?php echo $aa;?>&txtpp=<?php echo $txtpp?>&txtptype=<?php echo $txtptype?>&txtstatesl=<?php echo $txtstatesl;?>&txtlocationsl=<?php echo $txtlocationsl;?>&txtcountrysl=<?php echo $txtcountrysl?>&txtid=<?php echo $txtid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpop1('<?php echo $party;?>','<?php echo $aa;?>','<?php echo $txtpp?>','<?php echo $txtptype?>&txtstatesl=<?php echo $txtstatesl;?>&txtlocationsl=<?php echo $txtlocationsl;?>');"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
