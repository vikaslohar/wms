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

	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
	 $pid=trim($_POST['txtitem']);
		 
	$sql_arr=mysqli_query($link,"select * from tbl_opspa where opspa_id='".$pid."'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	//$partyid=$row_arr['party_id'];
		$trdate=$row_arr['opspa_date'];
	
	
	$sql_arrsub=mysqli_query($link,"select * from tbl_opspa_sub where opspa_id='".$pid."'") or die(mysqli_error($link));
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		$crop=$row_arrsub['crop'];
		$variety=$row_arrsub['variety'];
		$orlot=$row_arrsub['orlot'];
		$lotno=$row_arrsub['lotno'];
		
		$sql_crop=mysqli_query($link,"select * from tblcrop where cropname='$crop'") or die(mysqli_error($link));
		$row_crop=mysqli_fetch_array($sql_crop);
		$classid=$row_crop['cropid'];

		$sql_veriety=mysqli_query($link,"select * from tblvariety where popularname='".$variety."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
		$row_variety=mysqli_fetch_array($sql_veriety);
		$itemid=$row_variety['varietyid'];				
		
		$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_variety='".$itemid."' and lotldg_crop='".$classid."' and orlot='".$orlot."'") or die(mysqli_error($link));
		$row_issue1=mysqli_fetch_array($sql_issue1); 
		$tot_issue1=mysqli_num_rows($sql_issue1);
			
		$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
		$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
						
		$sstage=$row_arrsub['sstage'];
		$sstatus=$row_issuetbl['lotldg_sstatus'];
		$moist=$row_issuetbl['lotldg_moisture'];
		$gemp=$row_issuetbl['lotldg_gemp'];
		$vchk=$row_issuetbl['lotldg_vchk'];
		$got1=$row_issuetbl['lotldg_got1'];
		$qc=$row_issuetbl['lotldg_qc'];
		
		$gotstatus=$row_issuetbl['lotldg_got'];
		$qctestdate=$row_issuetbl['lotldg_qctestdate'];
		$gottestdate=$row_issuetbl['lotldg_gottestdate'];
		$gs=$row_issuetbl['lotldg_gs'];
		$resverstatus=$row_issuetbl['lotldg_resverstatus'];
		$revcomment=$row_issuetbl['lotldg_revcomment'];
		
		
		$sql_arrsub_sub=mysqli_query($link,"select * from tbl_opspasub_sub where opspa_id='".$pid."' and opspasub_id='".$row_arrsub['opspasub_id']."'") or die(mysqli_error($link));
		while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
		{
			$whid=$row_arrsub_sub['whid'];
			$binid=$row_arrsub_sub['binid'];
			$subbinid=$row_arrsub_sub['subbinid'];
			$nob=$row_arrsub_sub['nob'];
			$qty=$row_arrsub_sub['qty'];
			$opups=0;
			$opqty=0;
			$balups=$nob;
			$balqty=$qty;
			if($balqty<=0){$balqty=0; $balups=0;}
				
		$sql_ins_main="insert into tbl_lot_ldg (yearcode,lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_lotno, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty, lotldg_sstage, lotldg_sstatus, lotldg_moisture, lotldg_gemp, lotldg_vchk, lotldg_got1, lotldg_qc, lotldg_got, lotldg_qctestdate, lotldg_gottestdate, orlot, lotldg_gs, lotldg_resverstatus, lotldg_revcomment) values('$yearid_id','Opening Stock', '$pid', '$trdate', '$lotno', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$nob', '$qty', '$balups', '$balqty', '$sstage', '$sstatus', '$moist', '$gemp', '$vchk', '$got1', '$qc', '$gotstatus', '$qctestdate', '$gottestdate', '$orlot', '$gs', '$resverstatus', '$revcomment')";
		//exit;
		mysqli_query($link,$sql_ins_main) or die(mysqli_error($link));
		
		$sql_sunid=mysqli_query($link,"select * from tbl_subbin where sid='$subbinid' and status='Empty'") or die(mysqli_error($link));
		$tot_subid=mysqli_num_rows($sql_sunid);	
		if($tot_subid > 0)
		{
		$sql_itm="update tbl_subbin set status='$sstage' where sid='$subbinid'";
		mysqli_query($link,$sql_itm) or die(mysqli_error($link));
		}
	
		}
	}
}		
	$sql_code="SELECT MAX(opspa_code) FROM tbl_opspa where yearcode='$yearid_id' ORDER BY opspa_code DESC";
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
		
	$sql_code1="SELECT MAX(ncode) FROM tbl_opspa ORDER BY ncode DESC";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
		{
			$row_code1=mysqli_fetch_row($res_code1);
			$t_code1=$row_code1['0'];
			$ncode=$t_code1+1;
			//$ncode=sprintf("%004d",$ncode);
		}
		else
		{
			$ncode=1;
		}
	$sql_main="update tbl_opspa set opspa_tflg=1, opspa_code=$code, ncode='$ncode' where opspa_id='$pid'";
	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	echo "<script>window.location='home_optrn2.php'</script>";	
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival -Transaction - Opening Stock - Preview</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
</head>
<script src="farrival1.js"></script>
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
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
var remarks=document.frmaddDepartment.remarks.value
winHandle=window.open('op_details_print2.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}



function mySubmit()
{ 
	if(document.frmaddDepartment.date.value=="00-00-0000" || document.frmaddDepartment.date.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
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

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_arrival.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#F1B01E" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Opening Stock - Condition Seed (Lots-listed in application) - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_opspa where arr_role='".$logid."' and opspa_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['opspa_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_opspa_sub where opspa_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

	$tdate=$row_tbl['opspa_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?> 
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Opening Stock - Condition Seed (Lots-listed in application)</td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TOP".$row_tbl['opspa_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="101" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="259" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
    <?php
$sql_tbl=mysqli_query($link,"select * from tbl_opspa where arr_role='".$logid."' and opspa_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['opspa_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_opspa_sub where opspa_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
				<td width="32" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			    <td width="104" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
			    <td width="117" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
				<td width="70" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
				<td width="56" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
				<td width="53" rowspan="2" align="center" valign="middle" class="tblheading">Arrival Qty</td>
				<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">Raw Seed Qty</td>
				<td width="71" rowspan="2" align="center" valign="middle" class="tblheading">Difference Qty</td>
				<td colspan="2" align="center" valign="middle" class="tblheading">Condition Seed</td>
				<td width="95" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
                <td width="66" rowspan="2" align="center" valign="middle" class="tblheading">Difference in Seed Stock</td>
			    </tr>
<tr class="tblsubtitle" height="20">
  <td width="60" align="center" valign="middle" class="tblheading">NoB</td>
  <td width="47" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
  <?php
$srno=1; $itmdchk="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.",".$row_tbl_sub['orlot'];
	}
	else
	{
		$itmdchk=$row_tbl_sub['orlot'];
	}


$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_sloc=mysqli_query($link,"select * from tbl_opspasub_sub where opspa_id='".$arrival_id."' and opspasub_id='".$row_tbl_sub['opspasub_id']."' order by opspasubsub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['nob']; 
$slqty=$slqty+$row_sloc['qty'];
}
$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slups);
if($din[1]==000){$difn=$din[0];}else{$difn=$slups;}


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['crop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['variety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['arrival_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['rsw_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_nob'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_qty'];?></td>
	<td width="95" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_seed_stock'];?></td>
    </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['crop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['variety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['arrival_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['rsw_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_qty'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_nob'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['conseed_qty'];?></td>
	<td width="95" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['diff_seed_stock'];?></td>
    </tr>
  <?php
}
$srno++;
}
}

?>
</table>

<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_op_arrival2.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  