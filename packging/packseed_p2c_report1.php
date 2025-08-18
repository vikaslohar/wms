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

	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	if($crop=="")$crop="ALL";
	if($variety=="")$variety="ALL";
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$crop = $_POST['txtcrop'];
		$veriety = $_POST['txtvariety'];
		echo "<script>window.location='crop_ver_sr_report1.php?txtcrop=$crop&txtvariety=$veriety'</script>";*/	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Report - Pack Seeds P2C Report</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->


</head>
<script src="srcrrep.js"></script>
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
function openprint()
{
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
winHandle=window.open('packseed_p2c_report_preview.php?&txtcrop='+itemid+'&txtvariety='+vv,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Report - Pack Seed Report As on Date <?php echo date("d-m-Y");?></td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php
	$sd=explode("-",$sdate);
	$ed=explode("-",$edate);
	$sdt=$sd[2]."-".sprintf("%02d",$sd[1])."-".sprintf("%02d",$sd[0]);
	$edt=$ed[2]."-".sprintf("%02d",$ed[1])."-".sprintf("%02d",$ed[0]);
		
	$crp="ALL"; $ver="ALL";
	$qry="select * from tbl_psunpp2c where unp_date>='".$sdt."' and unp_date<='".$edt."'";

	if($crop!="ALL")
	{	
	$qry.=" and unp_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.=" and unp_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" order by unp_date desc";

	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
 	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
	
	$crop1=$crop;
	$variety1=$variety;
?> 
	  
	  <td align="center" colspan="4" >

<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
<input name="txtvariety" value="<?php echo $variety1?>" type="hidden"> 
<input name="txtcrop" value="<?php echo $crop1;?>" type="hidden">  
	 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>


<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td align="center" class="tblheading">Pack Seed Report As on Date <?php echo date("d-m-Y");?></td>
</tr>
</table>
<?php
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#1dbe03" style="border-collapse:collapse">
<tr height="25" >
<td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $ver;?>&nbsp;&nbsp;|&nbsp;&nbsp;To: <?php echo $sdate;?>&nbsp;&nbsp;|&nbsp;&nbsp;From: <?php echo $edate;?></td>
</tr>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 

<tr class="tblsubtitle" height="25">
	<td width="28" align="Center" class="tblheading">#</td>
	<td width="119" align="Center" class="tblheading">Date</td>
	<td width="150" align="Center" class="tblheading">Lot No.</td>
	<td width="150" align="Center" class="tblheading">New Generated Lot</td>	
	<td width="96" align="Center" class="tblheading">Bulk Qty Size</td>
	<td width="65" align="Center" class="tblheading">Qty</td>
	<td width="74" align="Center" class="tblheading">NoB</td>
	<td width="119" align="Center" class="tblheading">Bin Details</td>
	<!--<td width="129" align="Center" class="tblheading">Remarks</td>-->
</tr>
<?php
$srno=1; $totrepqty=0;
if($tot_arr_home > 0)
{
	
	while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
	{
		$bqtys=""; $qty=""; $nob=""; $remark=""; $bindet=""; 
		$sql_qty=mysqli_query($link,"select * from tbl_psunpp2c_sub2 where plantcode='$plantcode' and unp_id='".$row_arr_home1['unp_id']."'") or die(mysqli_error($link));
		$tot_qty=mysqli_num_rows($sql_qty);
		while($row_qty=mysqli_fetch_array($sql_qty))
		{
			
			$qty=$row_qty['unp_qty'];
			$nob=$row_qty['unp_nop'];
			/*$bindet='WH-'.$row_qty['unp_wh'].'/'.$row_qty['unp_bin'].'/'.$row_qty['unp_sbin'];
			$remark=$row_qty['unp_qty'];*/
			$bqtys=$row_arr_home1['unp_ups'];
			$sql_wh=mysqli_query($link,"select * from tbl_warehouse where plantcode='$plantcode' and whid='".$row_qty['unp_wh']."'") or die(mysqli_error($link));
			$tot_wh=mysqli_num_rows($sql_wh);
			$row_wh=mysqli_fetch_array($sql_wh);
			//$wh=$row_wh['perticulars'];
			$sql_bin=mysqli_query($link,"select * from tbl_bin where plantcode='$plantcode' and binid='".$row_qty['unp_bin']."'") or die(mysqli_error($link));
			$row_bin=mysqli_fetch_array($sql_bin);
			$tot_bin=mysqli_num_rows($sql_bin);
			//$bin=$row_bin['binname'];
			$sql_sbin=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' and sid='".$row_qty['unp_sbin']."'") or die(mysqli_error($link));
			$row_sbin=mysqli_fetch_array($sql_sbin);
			$tot_sbin=mysqli_num_rows($sql_sbin);
			//$sbin=$row_sbin['sname'];
			
		}
		if($srno%2 != 0)
		{
			?>	
			<tr height="25">
				<td width="28" align="Center" class="tbltext"><?php echo $srno;?></td>
				<td width="119" align="Center" class="tbltext"><?php echo $row_arr_home1['unp_date'];?></td>	
				<td width="150" align="Center" class="tbltext"><?php echo $row_arr_home1['unp_lotno'];?></td>
				<td width="150" align="Center" class="tbltext"><?php echo $row_arr_home1['unp_newlotno'];?></td>	
				<td width="96" align="Center" class="tbltext"><?php echo $bqtys;?></td>
				<td width="65" align="Center" class="tbltext"><?php echo $qty;?></td>
				<td width="74" align="Center" class="tbltext"><?php echo $nob;?></td>
				<td width="119" align="Center" class="tbltext"><?php echo $row_wh['perticulars'].'/'.$row_bin['binname'].'/'.$row_sbin['sname'];?></td>
				<!--<td width="129" align="Center" class="tbltext"><?php echo $remark;?></td>-->
			</tr>
			<?php
		}
		else
		{
			?>
			<tr height="25">
				<td width="28" align="Center" class="tbltext"><?php echo $srno;?></td>
				<td width="119" align="Center" class="tbltext"><?php echo $row_arr_home1['unp_date'];?></td>	
				<td width="150" align="Center" class="tbltext"><?php echo $row_arr_home1['unp_lotno'];?></td>
				<td width="150" align="Center" class="tbltext"><?php echo $row_arr_home1['unp_newlotno'];?></td>	
				<td width="96" align="Center" class="tbltext"><?php echo $bqtys;?></td>
				<td width="65" align="Center" class="tbltext"><?php echo $qty;?></td>
				<td width="74" align="Center" class="tbltext"><?php echo $nob;?></td>
				<td width="119" align="Center" class="tbltext"><?php echo $row_wh['perticulars'].'/'.$row_bin['binname'].'/'.$row_sbin['sname'];?></td>
				<!--<td width="129" align="Center" class="tbltext"><?php echo $remark;?></td>-->
			</tr>
			<?php
		}
		$srno=$srno+1;
		$totrepqty=$totrepqty+$qty;
	}
?>
<tr class="Dark">
			<td align="right" valign="middle" class="tblheading" colspan="5">Total&nbsp;</td>
         	<td align="center" valign="middle" class="tblheading"><?php echo $totrepqty;?></td>
			<td align="center" valign="middle" class="tblheading" colspan="8">&nbsp;</td>
</tr>
</table>			
<br />
<?php
}
?>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="packseed_p2c_report.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;"  /></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /></td>
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
</html>

  