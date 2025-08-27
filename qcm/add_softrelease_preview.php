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
	
	$tid=$_REQUEST['tid'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		$sql_srmain=mysqli_query($link,"Select * from tbl_softr where softr_id='".$tid."'") or die(mysqli_error($link));
		$tot_srmain=mysqli_num_rows($sql_srmain);
		$row_srmain=mysqli_fetch_array($sql_srmain);	
		
		$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE softr_id='".$tid."'") or die(mysqli_error($link));
		$tot_srsub=mysqli_num_rows($sql_srsub);
		while($row_srsub=mysqli_fetch_array($sql_srsub))
		{
			$type = $row_srsub['softrsub_srtyp'];	 
			$lotno = $row_srsub['softrsub_lotno'];	
			
			$slqty=0;
			$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where  orlot='".$lotno."'  and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_qc!='OK'") or die(mysqli_error($link));
			$zz=mysqli_num_rows($sql_issue);
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$lotno."'  and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_qc!='OK'") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_qc!='OK'") or die(mysqli_error($link)); 
				$xxz=mysqli_num_rows($sql_issuetbl);
				//if($xxz==0)$flg=1;
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					$slqty=$slqty+$row_issuetbl['lotldg_balqty'];
				}
			}
			if($slqty>0)
			{
				$sql_lotldg="update tbl_lot_ldg set lotldg_srtyp='".$type."', lotldg_srflg='1' where orlot='".$lotno."'";
				$zz=mysqli_query($link,$sql_lotldg)or die(mysqli_error($link));
			}
	
			$slqty=0;
			$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where orlot='".$lotno."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_qc!='OK'") or die(mysqli_error($link));
			$zz=mysqli_num_rows($sql_issue);
			while($row_issue=mysqli_fetch_array($sql_issue))
			{ 
				$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$lotno."'  and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_qc!='OK'") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_qc!='OK'") or die(mysqli_error($link)); 
				$xxz=mysqli_num_rows($sql_issuetbl);
				while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
				{ 
					$slqty=$slqty+$row_issuetbl['balqty'];
				}
			}
			
			if($slqty>0)
			{
				$sql_lotldg="update tbl_lot_ldg_pack set lotldg_srtyp='".$type."', lotldg_srflg='1' where orlot='".$lotno."'";
				$zz=mysqli_query($link,$sql_lotldg)or die(mysqli_error($link));
			}
		}
		
		$sql_code="SELECT MAX(softr_code) FROM tbl_softr  where yearcode='$yearid_id'  ORDER BY softr_code DESC";
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

		$sql_srmain="Update tbl_softr set softr_code='$code', softr_tflg='1' where softr_id='".$tid."'";
		$xxxx=mysqli_query($link,$sql_srmain) or die(mysqli_error($link));

		echo "<script>window.location='select_softrelease_op.php?p_id=$tid'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Manager - Transaction - Soft Release</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="softr.js"></script>
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

function openprintpopup()
{
var tid=document.frmaddDepartment.txtid.value;
winHandle=window.open('print_softrelease.php?itmid='+tid,'WelCome','top=20,left=50,width=850,height=750,scrollbars=yes');
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

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Soft Release</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="lotlist" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $tid?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="srtlist" value="0" />
		
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable">
<?php
$sql_srmain=mysqli_query($link,"Select * from tbl_softr where softr_id='".$tid."'") or die(mysqli_error($link));
$tot_srmain=mysqli_num_rows($sql_srmain);
$row_srmain=mysqli_fetch_array($sql_srmain);

	$tdate=$row_srmain['softr_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Soft Release - Preview</td>
</tr>

<tr class="Dark" height="30">
<td width="120" align="right" valign="middle" class="tblheading">Transaction Id&nbsp;</td>
<td width="242"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TSF".$row_srmain['softr_tcode']."/".$yearid_id."/".$lgnid;?></td>
<td width="106" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="272" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

 <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_srmain['softr_crop']."' order by cropname Asc")or die(mysqli_error($link));
$noticia = mysqli_fetch_array($quer3);
?>
<td width="120" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="242" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia['cropname'];?></td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_srmain['softr_variety']."' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link)); 
$noticia4 = mysqli_fetch_array($quer4);
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia4['popularname'];?></td>
  </tr>
<?php
/*
?>  
  <tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading" colspan="2">Display List Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="2">&nbsp;<?php if($row_srmain['softr_typ']=="sllot"){ echo "Complete Lot List";} else { echo "Sub Bin wise Lot List";}?></td>
</tr>
<?php
if($row_srmain['softr_typ']=="slbin")
{
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where whid='".$row_srmain['softr_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);

$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where binid='".$row_srmain['softr_bin']."'") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);

$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where sid='".$row_srmain['softr_subbin']."' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
$slocdetails=$noticia_whd1['perticulars']."/".$noticia_bing1['binname']."/".$noticia_subbing1['sname'];
?>
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading" colspan="2">SLOC Details&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2">&nbsp;<?php echo $slocdetails;?></td>
</tr>
<?php
}
*/
?>
</table>

<br />
<div id="postingsubtable"></div>
<?php
	$crop = $row_srmain['softr_crop'];	 
	$variety = $row_srmain['softr_variety'];	 
	$type = $row_srmain['softr_typ'];	 
	$wh = $row_srmain['softr_wh'];	 
	$bin = $row_srmain['softr_bin'];	 
	$subbin = $row_srmain['softr_subbin'];	 

if($type=="sllot")	
{
$sql="SELECT distinct orlot FROM tbl_lot_ldg WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT')";
$sql2="SELECT distinct orlot FROM tbl_lot_ldg_pack WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT')";
}
else
{
$sql="SELECT distinct orlot FROM tbl_lot_ldg WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and lotldg_whid='".$wh."' and lotldg_binid='".$bin."' and lotldg_subbinid='".$subbin."' and lotldg_srflg='0' and lotldg_qc!='NUT' and lotldg_qc!='Fail' and lotldg_got!='Fail' and (lotldg_qc='UT' OR lotldg_qc='RT')";
$sql2="SELECT distinct orlot FROM tbl_lot_ldg_pack WHERE lotldg_crop='".$crop."' and lotldg_variety='".$variety."' and whid='".$wh."' and binid='".$bin."' and subbinid='".$subbin."' and lotldg_srflg='0' and lotldg_qc!='NUT' and lotldg_qc!='Fail' and lotldg_got!='Fail' and (lotldg_qc='UT' OR lotldg_qc='RT')";
}
$sql_qc=mysqli_query($link,$sql)or die(mysqli_error($link));
$sql_qc22=mysqli_query($link,$sql2)or die(mysqli_error($link));
$tt=mysqli_num_rows($sql_qc);
while($row_arr_home=mysqli_fetch_array($sql_qc))
{
	if($olt!="")
	$olt=$olt.",".$row_arr_home['orlot'];
	else
	$olt=$row_arr_home['orlot'];
}
while($row_arr_home22=mysqli_fetch_array($sql_qc22))
{
	if($olt!="")
	$olt=$olt.",".$row_arr_home22['orlot'];
	else
	$olt=$row_arr_home22['orlot'];
}
$countrec=0;

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="30">
	<td width="18" align="center" valign="middle" class="tblheading">#</td>
	<td width="96" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="51" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="66" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="70" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="57" align="center" valign="middle" class="tblheading">Moist %</td>
	<td width="56" align="center" valign="middle" class="tblheading">Germ %</td>
	<td width="75" align="center" valign="middle" class="tblheading">GOT Status</td>
	<td width="195" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="87" align="center" valign="middle" class="tblheading">Soft Release</td>
</tr>
<?php
$srno=1;
$p_olt=explode(",",$olt);
//echo count($p_olt);
foreach($p_olt as $orlt)
{
if($orlt<>"")
{
$flg=0;
$totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; $stage="";	$sloc="";

/*$sql_qct=mysqli_query($link,"select * from tbl_qctest where oldlot='".$row_arr_home['orlot']."' and bflg=1 order by tid desc") or die(mysqli_error($link));
$tot_qct=mysqli_num_rows($sql_qct);
if($tot_qct==0)
{
$flg=1;
}*/
//echo $flg;
$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where  orlot='".$orlt."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT')") or die(mysqli_error($link));
$zz=mysqli_num_rows($sql_issue);
//if($zz==0)$flg=1;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$orlt."'  and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT')") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
if($xxz=mysqli_num_rows($sql_issuetbl)>0)
{
//if($xxz==0)$flg=1;
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	//$tgotchk=explode(" ", $row_arr_home['lotldg_got1']); 
	if($row_issuetbl['lotldg_balqty'] > 0)
	{
		//if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
		//{$flg=1;}
		if($tgot[0]=="GOT-R")
		{
			if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
			{$flg=1;}
			//if(($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT") && ($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT"))
			//{$flg=1;}
		}
	}
	//echo $tgot[0];
	if($totgemp==0)$totgemp="";
	if($txtdot=="")
	{
		$rdate=$row_issuetbl['lotldg_qctestdate'];
		$ryear=substr($rdate,0,4);
		$rmonth=substr($rdate,5,2);
		$rday=substr($rdate,8,2);
		$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";

 $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+$row_issuetbl['lotldg_balbags'];
$slqty=$slqty+$row_issuetbl['lotldg_balqty'];
 
/*if($stage!="")
$stage=$stage."<br/>".$row_issuetbl['lotldg_sstage'];
else*/
if($slqty>0)
{
$stage=$row_issuetbl['lotldg_sstage'];

if($sloc!="")
$sloc=$sloc."<br/>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
}
}
}
//echo $flg;
if($totqty>0 && $totnob==0)$totnob=1;

$sql_issue=mysqli_query($link,"select distinct subbinid, binid, whid from tbl_lot_ldg_pack where orlot='".$orlt."' and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT')") or die(mysqli_error($link));
if($zz=mysqli_num_rows($sql_issue)>0)
{
//if($zz==0)$flg=1;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$txtdot=""; 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and orlot='".$orlt."'  and lotldg_srflg='0' and lotldg_qc!='Fail' and lotldg_got!='Fail' and lotldg_qc!='NUT' and (lotldg_qc='UT' OR lotldg_qc='RT')") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
 $xxz=mysqli_num_rows($sql_issuetbl);
//if($xxz==0)$flg=1;
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$row_issuetbl['balqty']; 
	$totnob=$totnob+0; 

	$totqc=$row_issuetbl['lotldg_qc']; 
	$tgot=explode(" ", $row_issuetbl['lotldg_got1']); 
	$totgot=$tgot[0]." ".$row_issuetbl['lotldg_got'];
	$totmost=$row_issuetbl['lotldg_moisture']; 
	$totgemp=$row_issuetbl['lotldg_gemp']; 
	$totsst=$row_issuetbl['lotldg_sstatus']; 
	//$tgotchk=explode(" ", $row_arr_home['lotldg_got1']); 
	if($row_issuetbl['balqty'] > 0)
	{
		//if($row_issuetbl['lotldg_got']=="Fail" || $row_issuetbl['lotldg_qc']=="Fail")
		//{$flg=1;}
		if($tgot[0]=="GOT-R")
		{
			if($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT")
			{$flg=1;}
			//if(($row_issuetbl['lotldg_got']=="UT" || $row_issuetbl['lotldg_got']=="RT") && ($row_issuetbl['lotldg_qc']=="UT" || $row_issuetbl['lotldg_qc']=="RT"))
			//{$flg=1;}
		}
	}
	//echo $tgot[0];
	if($totgemp==0)$totgemp="";
	if($txtdot=="")
	{
	$rdate=$row_issuetbl['lotldg_qctestdate'];
	$ryear=substr($rdate,0,4);
	$rmonth=substr($rdate,5,2);
	$rday=substr($rdate,8,2);
	$txtdot=$rday."-".$rmonth."-".$ryear;
	}
	if($txtdot=="00-00-0000" || $txtdot=="--")
	$txtdot="";

 $wareh=""; $binn=""; $subbinn=""; $slups=0; $slqty=0;	

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$slups=$slups+0;
$slqty=$row_issuetbl['balqty'];
 
/*if($stage!="")
$stage=$stage."<br/>".$row_issuetbl['lotldg_sstage'];
else*/
if($slqty>0)
{
$stage=$row_issuetbl['lotldg_sstage'];

if($sloc!="")
$sloc=$sloc."<br/>".$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
else
$sloc=$wareh.$binn.$subbinn." | ".$slups." | ".$slqty;
}
}
}
}
if($totqty<0)$totqty=0;
if($totqty==0)$flg++;
if($flg==0)
{
$sql_srsub=mysqli_query($link,"SELECT * FROM tbl_softr_sub WHERE softr_id='".$tid."' and softrsub_lotno='".$orlt."'") or die(mysqli_error($link));
$tot_srsub=mysqli_num_rows($sql_srsub);
if($tot_srsub > 0)
{
$row_srsub=mysqli_fetch_array($sql_srsub);
$countrec++;
if($srno%2!=0)
{
?>
<tr class="Light" height="30">
	<td width="18" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="96" align="center" valign="middle" class="tblheading"><?php echo $orlt;?></td>
	<td width="51" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="66" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="195" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="87" align="center" valign="middle" class="tblheading"><?php echo ucwords($row_srsub['softrsub_srtyp']);?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="30">
	<td width="18" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="96" align="center" valign="middle" class="tblheading"><?php echo $orlt;?></td>
	<td width="51" align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="66" align="center" valign="middle" class="tblheading"><?php echo $totqc;?></td>
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $txtdot;?></td>
	<td width="57" align="center" valign="middle" class="tblheading"><?php echo $totmost;?></td>
	<td width="56" align="center" valign="middle" class="tblheading"><?php echo $totgemp;?></td>
	<td width="75" align="center" valign="middle" class="tblheading"><?php echo $totgot;?></td>
	<td width="195" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td width="87" align="center" valign="middle" class="tblheading"><?php echo ucwords($row_srsub['softrsub_srtyp']);?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
<?php
if($countrec==0)
{
?>
<tr class="Light" height="30">
	<td align="center" valign="middle" class="tblheading" colspan="11">Record not fount</td>
</tr>
<?php
}
?>
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
</table>
</div>
<br />

<table cellpadding="5" cellspacing="5" border="0" width="850" align="center">
<tr >
<td align="center" colspan="3"><a href="edit_softrelease.php?tid=<?php echo $tid;?>"><img src="../images/edit.gif" border="0"  style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/printpreview.gif" border="0"  style="display:inline;cursor:pointer;" onclick="openprintpopup();"/>&nbsp;<input type="image" src="../images/finalsubmit.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
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

  