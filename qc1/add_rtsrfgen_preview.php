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
	
	$txtlot=trim($_REQUEST['lotno']);
	$txtlot1=trim($_REQUEST['lotarr']);
	
	if(isset($_POST['frm_action'])=='submit')
	{
	 	$txtlot=trim($_POST['txtlot']);
		$txtlot1=trim($_POST['txtlot1']);
		
		$sql_years=mysqli_query($link,"SELECT ycode, baryrcode FROM tblyears WHERE years_flg = 1 ") or die(mysqli_error($link));
		$row_years=mysqli_fetch_array($sql_years); 
		$ycode=$row_years['ycode'];
		$baryrcode=$row_years['baryrcode'];

		$sql_srf=mysqli_query($link,"select max(srf_tcode) from tbl_qcsrf_rt order by srf_tcode desc") or die(mysqli_error($link));
		$row_srf=mysqli_fetch_array($sql_srf); 
		$srf_tcode=$row_srf[0];
		$srf_tcode=$srf_tcode+1;
		$srfno="SRF-RT-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
		$srfseries='new';
		$dt=date("Y-m-d");
		
		$lotn24=explode(",",$txtlot1);
		foreach($lotn24 as $lotn)
		{
			if($lotn<>"")
			{
				$nwlotn=str_split($lotn);
	 			$nwlotno=$nwlotn[0].$nwlotn[1].$nwlotn[2].$nwlotn[3].$nwlotn[4].$nwlotn[5].$nwlotn[6].$nwlotn[7].$nwlotn[8].$nwlotn[9].$nwlotn[10].$nwlotn[11].$nwlotn[12].$nwlotn[13].$nwlotn[14].$nwlotn[15];
		
				$sql_m=mysqli_query($link,"select qcg_id, qcg_lotno, qcg_sampleno from tbl_qcgdata where qcg_retult='RT' and qcg_lotno='$lotn' and qcg_germpdt>='2023-04-01' and qcg_srfflg=0 ") or die(mysqli_error($link));
				$tot_m=mysqli_num_rows($sql_m);
				$row_m=mysqli_fetch_array($sql_m);
				
				$qcgid=$row_m['qcg_id'];
				$val=$row_m['qcg_lotno'];
				$sampleno=$row_m['qcg_sampleno'];
				$smpn=str_split($sampleno);
				$pcod=$smpn[0];
				$ycod=$smpn[1];
				$smpno=$smpn[2].$smpn[3].$smpn[4].$smpn[5].$smpn[6].$smpn[7];
				//$smpno=Int($smpno);
				
				$sql_qc=mysqli_query($link,"select max(tid) from tbl_qctest where lotno='$lotn' and qcstatus='RT' and yearid='$ycod' and sampleno='$smpno' order by tid desc") or die(mysqli_error($link));
				$row_qc=mysqli_fetch_array($sql_qc); 
				$qcid=$row_qc[0];
				
				$sql_sub_sub="insert into tbl_qcsrf_rt (srf_date, srf_tcode, srf_code, srf_srfno, srf_tid, srf_lotno, srf_orlot, srf_sampleno, srf_logid, srf_yrcode, srf_year) values('$dt', '$srf_tcode', '$srf_tcode', '$srfno', '$qcid', '$lotn', '$nwlotno', '$sampleno', '$logid', '$ycode', '$baryrcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				//echo "<br />";
				
				$sql_sub_sub2="update tbl_qcgdata set qcg_srfflg=1, qcg_docsrefno='$srfno' where  qcg_id='$qcgid' ";
				mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));
				//echo "<br />";
				
				$sql_sub_sub3="update tbl_qctest set qcrefno='$srfno' where tid='$qcid'  ";
				mysqli_query($link,$sql_sub_sub3) or die(mysqli_error($link));
				
				//echo "<br />";
			}
		}
		//exit;	
		echo "<script>window.location='home_rtsrf.php'</script>";	
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction - Condition Density Data Update</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="qcsample.js"></script>
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



function modetchk(classval)
{
	//alert(classval);
	//document.getElementById('lotdetails').innerHTML='';
	showUser(classval,'vitem','item','','','','','');
	//document.frmaddDepartment.txtlot1.value==""
				//document.frmaddDepartment.txt11.selectedIndex=0;
	}
function modetchk1(classval)
{
	//alert(classval);
	//document.getElementById('lotdetails').innerHTML='';
	//var crop=document.frmaddDepartment.txtcrop.value;
	//showUser(classval,'lotdetails','showlotlist',crop,'','','','');
	//document.frmaddDepartment.txtlot1.value==""
	//document.frmaddDepartment.txt11.selectedIndex=0;
}
function openslocpop()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		 alert("Please Select Crop.");
		 //document.frmaddDepartment.txt1.focus();
	}
	else
	{
		//var itm="Raw Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		//var stage=document.frmaddDepartment.txtstage.value;
		winHandle=window.open('getuser_rawdensity_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=150,left=160,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	//setTimeout("showrec()",1000);
}

function showrec()
{
var lotno=document.frmaddDepartment.txtlot1.value;
showUser(lotno,'lotdetails','lotdetails','','','','','');
} 

function editrec(edtrecid, trid)
{
//alert(trid);
showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
} 

function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','');
	}
	else
	{
		return false;
	}
}


function mySubmit()
{ 
return true;	 
}

function clk(cval)
{
//alert(document.frmaddDepartment.txt1.checked);
	if(document.frmaddDepartment.txt1.checked==true) 
	{
		document.frmaddDepartment.chk1.value=document.frmaddDepartment.txt1.value;
	}
	else
	{
		document.frmaddDepartment.chk1.value="";
	}
	
	if(document.frmaddDepartment.txt12.checked==true)
	{
		document.frmaddDepartment.chk2.value=document.frmaddDepartment.txt12.value;
	}
	else
	{
		document.frmaddDepartment.chk2.value="";
	}
	
	if(document.frmaddDepartment.txt14.checked==true)
	{
		document.frmaddDepartment.chk3.value=document.frmaddDepartment.txt14.value;
	}
	else
	{
		document.frmaddDepartment.chk3.value="";
	}
	
	if(document.frmaddDepartment.txt16.checked==true)
	{
		document.frmaddDepartment.chk4.value=document.frmaddDepartment.txt16.value;
	}
	else
	{
		document.frmaddDepartment.chk4.value="";
	}
}
function optsl(optval)
{
//document.frmaddDepartment.txtstage.value=optval;
}


function chkall()
{
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
	{          
		document.frmaddDepartment.fet[i].checked=true;
	} 
}

/*function clall()
{
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
	{          
		document.frmaddDepartment.fet[i].checked=false;
	} 
}*/

function clall(clval, srn)
{
	var x=0;
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
	{          
		if(x<=20)
		{
			if(document.frmaddDepartment.fet[i].checked==true)
			{
				x++;
			}
		}
		else
		{
			document.frmaddDepartment.fet[i].checked=false;
		}
	} 
	if(x<=20)
	{
		document.frmaddDepartment.totlotssel.value=x;
	}
}
/*
function mySubmit()
{ 
var f=0;
	if(document.frmaddDepartment.txtlot.value=="")
	{
		alert("SRF Number cannot be blank");
		document.frmaddDepartment.txtlot.focus();
		f=1;
		return false;
	}
	
	document.frmaddDepartment.txtlot1.value="";
	if(document.frmaddDepartment.srn.value > 1)
	{
		if(document.frmaddDepartment.srn.value <= 2)
		{
			if(document.frmaddDepartment.fet.checked == true)
			{  
				if(document.frmaddDepartment.txtlot1.value =="")
				{
					document.frmaddDepartment.txtlot1.value=document.frmaddDepartment.fet.value;
				}
				else
				{
					document.frmaddDepartment.txtlot1.value = document.frmaddDepartment.txtlot1.value +','+document.frmaddDepartment.fet.value;
				}
			}
		}
		else
		{ 
			for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
			{          
				if(document.frmaddDepartment.fet[i].checked == true)
				{ 
					if(document.frmaddDepartment.txtlot1.value =="")
					{
						document.frmaddDepartment.txtlot1.value=document.frmaddDepartment.fet[i].value;
					}
					else
					{
						document.frmaddDepartment.txtlot1.value = document.frmaddDepartment.txtlot1.value +','+document.frmaddDepartment.fet[i].value;
					}
				}
			}
		}
	}
	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		//document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	alert(document.frmaddDepartment.txtlot1.value);
	if(f==1)
	{
		return false;
	}
	else
	{	
		return true;
	}	 
}
*/
	
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SRF for RT Lots</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input type="hidden" name="txtlot1" value="<?php echo $txtlot1?>" />
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		
		</br>
<?php
$tid=0; $subtid=0;
$lotn=explode(",",$txtlot1);
$totno=count($lotn);

$sql_years=mysqli_query($link,"SELECT ycode, baryrcode FROM tblyears WHERE years_flg = 1 ") or die(mysqli_error($link));
$row_years=mysqli_fetch_array($sql_years); 
$ycode=$row_years['ycode'];
$baryrcode=$row_years['baryrcode'];

$sql_srf=mysqli_query($link,"select max(srf_tcode) from tbl_qcsrf_rt  order by srf_tcode desc") or die(mysqli_error($link));
$row_srf=mysqli_fetch_array($sql_srf); 
$srf_tcode=$row_srf[0];
$srf_tcode=$srf_tcode+1;
$srfno="SRF-".$plantcode.$baryrcode."-".sprintf("%000005d",$srf_tcode);
$srfseries='new';

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">SRF for RT Lots Update</td>
</tr>
         <tr class="Light" height="30" id="vitem">
          <td width="180" align="right"  valign="middle" class="tblheading">SRF Number &nbsp;</td>
           <td align="left" width="241" valign="middle" class="tbltext" style="border-color:#d21704" >&nbsp;<input name="txtlot" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $txtlot;?>" readonly="true" style="background-color:#CCCCCC"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<!--<a href="Javascript:void(0);" onclick="openslocpop();">New SRF</a>--></td>
		   
		  <td width="160" align="right"  valign="middle" class="smalltblheading">Total Lots Selected&nbsp;</td>
        <td width="259" align="left"  valign="middle" class="smalltblheading"  >&nbsp;<input name="totlotssel" type="text" size="5" class="tbltext" value='<?php echo $totno;?>' readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="4" align="center" class="tblheading">List of Lots</td>
</tr>
</table>		   
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td width="30" align="center" valign="middle" class="tblheading">#</td>
<td width="60" align="center" valign="middle" class="tblheading">Sample No.</td>
<td width="146" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="76" align="center" valign="middle" class="tblheading">Stage</td>
<td width="76" align="center" valign="middle" class="tblheading">QC Status</td>
<td width="107" align="center" valign="middle" class="tblheading">DoT</td>
<td width="107" align="center" valign="middle" class="tblheading">Last Germ %</td>
<td width="118" align="center" valign="middle" class="tblheading">NoB</td>
<td width="100" align="center" valign="middle" class="tblheading">Qty</td>
<td width="100" align="center" valign="middle" class="tblheading">SLOC</td>
</tr>

<?php
$srn=1; $totalups=0; $totalqty=0; $cnt=0;

$sql_m=mysqli_query($link,"select qcg_lotno, qcg_sampleno, qcg_crop, qcg_variety, qcg_germp from tbl_qcgdata where qcg_retult='RT' and qcg_germpdt>='2023-08-01' ") or die(mysqli_error($link));
$tot_m=mysqli_num_rows($sql_m);
if($tot_m > 0)
{
while($row_m=mysqli_fetch_array($sql_m))
{
$val=$row_m['qcg_lotno'];
$a=$row_m['qcg_crop'];
$b=$row_m['qcg_variety'];
$lastgermp=$row_m['qcg_germp'];
$sampleno=$row_m['qcg_sampleno'];
if(in_array($val, $lotn))
{
$vflg=0;
$rtotalups=0; $rtotalqty=0; $qc=""; $got=""; $blends_sstatus=""; $slocs=""; $sstage='';
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$a."' and lotldg_variety='".$b."' and lotldg_lotno='".$val."'") or die(mysqli_error($link));
$trtr=mysqli_num_rows($sql_issue);
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$b."'  and lotldg_lotno='".$val."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 

$qc=$row_issuetbl['lotldg_qc']; 
$got123=explode(" ",$row_issuetbl['lotldg_got1']); 
$got=$got123[0]." ".$row_issuetbl['lotldg_got']; 
$rtotalups=$rtotalups+$row_issuetbl['lotldg_balbags'];
$rtotalqty=$rtotalqty+$row_issuetbl['lotldg_balqty'];
$sstage=$row_issuetbl['lotldg_sstage']; 


$trdate=$row_issuetbl['lotldg_qctestdate'];
$tryear=substr($trdate,0,4);
$trmonth=substr($trdate,5,2);
$trday=substr($trdate,8,2);
$dot=$trday."-".$trmonth."-".$tryear;
if($trdate=="00-00-0000" || $trdate=="--")$trdate="";
if($dot=="00-00-0000" || $dot=="--")$dot="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


}
}
$trdate240=date("Y-m-d");
$flg=0;
/*if($dotage!="" && $dotage=="30")
{
	$dt=30;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else if($dotage!="" && $dotage=="45")
{
	$dt=45;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else if($dotage!="" && $dotage=="90")
{
	$dt=90;
	if($trdate!="")
	{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=1; $i<$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); } 
		}
		else
		$dt2="";
	}
	//echo $dt2;
	if($dt2!="")
	{
		if($trdate>=$dt2)$flg++;
	}
}
else
{
}*/
//echo $trdate."  =  ".$trdate240."<br />";	
if($trdate!="")
{
$diff = abs(strtotime($trdate240) - strtotime($trdate));
$days = floor($diff / (60*60*24));
$days=$days;
}
else
{
$days="";
}

/*if($days <= $dotage)
{
$vflg++;
}*/
if($flg>0)
{
//$vflg++;
}

if($qc!="RT")
{
$vflg++;
}

if($rtotalqty<=0)
{
$vflg++;
}

if($vflg==0)
{
$cnt++;
$totalups=$totalups+$rtotalups;
$totalqty=$totalqty+$rtotalqty;
if($srn%2!=0)
{
?>  
  <tr class="Light" height="30">
<td align="center" valign="middle" class="tblheading"><?php echo $srn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sampleno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $val;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $dot;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $lastgermp;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?><</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
<?php
}
else
{
?>
  <tr class="Light" height="30">
<td align="center" valign="middle" class="tblheading"><?php echo $srn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sampleno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $val;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sstage;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $qc;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $dot;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $lastgermp;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?><</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
<?php
}
$srn++;
}
}
}
}
?>

<input type="hidden" name="srn" value="<?php echo $srn;?>" /> 
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_rtsrf.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  