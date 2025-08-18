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
	
	/*$eurl = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
	$sql_tbl=mysqli_query($link,"select * from tbl_qctest where aflg=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['tid'];	
}*/
		
	if(isset($_POST['frm_action'])=='submit')
	{
		$flagcode=trim($_POST['flagcode']); //echo "<br />";
		$foccode=trim($_POST['foccode']); //echo "<br />";
		$foccode1=trim($_POST['foccode1']); //echo "<br />";
		$foccode2=trim($_POST['foccode2']); //echo "<br />";
		$foccode3=trim($_POST['foccode3']); //echo "<br />";
		$foccode4=trim($_POST['foccode4']); //echo "<br />";
		//exit;	
		echo "<script>window.location='home_qcdatamgp_preview.php?oflagcode=$flagcode&ofoccode=$foccode&ofoccode1=$foccode1&ofoccode2=$foccode2&ofoccode3=$foccode3&ofoccode4=$foccode4'</script>";
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - QC Data Verification and Result Update</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<!--<script src="sampdata.js"></script>
<script src="searchqcdata.js"></script>-->
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

function openslocpopprint1(tid)
{
winHandle=window.open('getuser_status1.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function isNumberKey1(evt)
{
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
}

function openslocpopprint(tid)
{
	var cnt=0;
	document.frmaddDept.flagcode.value ="";
	if(document.frmaddDept.srno.value>2)
	{
		for (var i = 0; i < document.frmaddDept.prchk.length; i++) 
		{          
			if(document.frmaddDept.prchk[i].checked == true)
			{
				if(document.frmaddDept.flagcode.value =="")
				{
					document.frmaddDept.flagcode.value=document.frmaddDept.prchk[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.flagcode.value = document.frmaddDept.flagcode.value +','+document.frmaddDept.prchk[i].value;
					cnt++;
				}
			}
		}
	}
	else
	{
		if(document.frmaddDept.prchk.checked == true)
		{
			if(document.frmaddDept.flagcode.value =="")
			{
				document.frmaddDept.flagcode.value=document.frmaddDept.prchk.value;
				cnt++;
			}
			else
			{
				document.frmaddDept.flagcode.value = document.frmaddDept.flagcode.value +','+document.frmaddDept.prchk.value;
				cnt++;
			}
		}
	}
	
	if(cnt > 0)
	{
		var itm=document.frmaddDept.flagcode.value;
		winHandle=window.open('getuser_sts_sl.php?tid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
		}
	else
	{
		alert("Select Sample(s) No. To Print");
		return false;
	}
}

function openst(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('filter.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}
function imgOnClick(dt, xind, yind)
{
	popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
}

function imgOnClick1(dt, xind, yind)
{
	popUpCalendar(document.frmaddDept.edate,dt,document.frmaddDept.edate, "dd-mmm-yyyy", xind, yind);
}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 	
function mySubmit()
{	
	var cnt=0;
	document.frmaddDept.flagcode.value ="";
	document.frmaddDept.foccode.value ="";
	document.frmaddDept.foccode1.value ="";
	document.frmaddDept.foccode2.value ="";
	document.frmaddDept.foccode3.value ="";
	document.frmaddDept.foccode4.value ="";
	//alert(document.frmaddDept.srno.value);
	if(document.frmaddDept.srno.value>2)
	{
		for (var i = 0; i < document.frmaddDept.germpsel.length; i++) 
		{          
			if(document.frmaddDept.germpsel[i].checked == true)
			{
				if(document.frmaddDept.flagcode.value =="")
				{
					document.frmaddDept.flagcode.value=document.frmaddDept.germpsel[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.flagcode.value = document.frmaddDept.flagcode.value +','+document.frmaddDept.germpsel[i].value;
					cnt++;
				}
				
				if(document.frmaddDept.foccode.value =="")
				{
					document.frmaddDept.foccode.value=document.frmaddDept.germptesttype[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.foccode.value = document.frmaddDept.foccode.value +','+document.frmaddDept.germptesttype[i].value;
					cnt++;
				}
				
				if(document.frmaddDept.foccode1.value =="")
				{
					document.frmaddDept.foccode1.value=document.frmaddDept.germpercentage[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.foccode1.value = document.frmaddDept.foccode1.value +','+document.frmaddDept.germpercentage[i].value;
					cnt++;
				}
				
				if(document.frmaddDept.foccode2.value =="")
				{
					document.frmaddDept.foccode2.value=document.frmaddDept.leduration[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.foccode2.value = document.frmaddDept.foccode2.value +','+document.frmaddDept.leduration[i].value;
					cnt++;
				}
				
				if(document.frmaddDept.foccode3.value =="")
				{
					document.frmaddDept.foccode3.value=document.frmaddDept.germptestresult[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.foccode3.value = document.frmaddDept.foccode3.value +','+document.frmaddDept.germptestresult[i].value;
					cnt++;
				}
				
				if(document.frmaddDept.foccode4.value =="")
				{
					document.frmaddDept.foccode4.value=document.frmaddDept.qcdocrefno[i].value;
					cnt++;
				}
				else
				{
					document.frmaddDept.foccode4.value = document.frmaddDept.foccode4.value +','+document.frmaddDept.qcdocrefno[i].value;
					cnt++;
				}
			
				/*alert(i);
				alert(document.frmaddDept.flagcode.value);
				alert(document.frmaddDept.foccode.value);
				alert(document.frmaddDept.foccode1.value);
				alert(document.frmaddDept.foccode2.value);
				alert(document.frmaddDept.foccode3.value);*/
			}
			
		}
				
				
	}
	else
	{
		if(document.frmaddDept.germpsel.checked == true)
		{
			if(document.frmaddDept.flagcode.value =="")
			{
				document.frmaddDept.flagcode.value=document.frmaddDept.germpsel.value;
				cnt++;
			}
			else
			{
				document.frmaddDept.flagcode.value = document.frmaddDept.flagcode.value +','+document.frmaddDept.germpsel.value;
				cnt++;
			}
			if(document.frmaddDept.foccode.value =="")
			{
				document.frmaddDept.foccode.value=document.frmaddDept.germptesttype[i].value;
				cnt++;
			}
			else
			{
				document.frmaddDept.foccode.value = document.frmaddDept.foccode.value +','+document.frmaddDept.germptesttype[i].value;
				cnt++;
			}
			
			if(document.frmaddDept.foccode1.value =="")
			{
				document.frmaddDept.foccode1.value=document.frmaddDept.germpercentage.value;
				cnt++;
			}
			else
			{
				document.frmaddDept.foccode1.value = document.frmaddDept.foccode1.value +','+document.frmaddDept.germpercentage.value;
				cnt++;
			}
			
			if(document.frmaddDept.foccode2.value =="")
			{
				document.frmaddDept.foccode2.value=document.frmaddDept.leduration.value;
				cnt++;
			}
			else
			{
				document.frmaddDept.foccode2.value = document.frmaddDept.foccode2.value +','+document.frmaddDept.leduration.value;
				cnt++;
			}
			
			if(document.frmaddDept.foccode3.value =="")
			{
				document.frmaddDept.foccode3.value=document.frmaddDept.germptestresult.value;
				cnt++;
			}
			else
			{
				document.frmaddDept.foccode3.value = document.frmaddDept.foccode3.value +','+document.frmaddDept.germptestresult.value;
				cnt++;
			}
			
			if(document.frmaddDept.foccode4.value =="")
			{
				document.frmaddDept.foccode4.value=document.frmaddDept.qcdocrefno.value;
				cnt++;
			}
			else
			{
				document.frmaddDept.foccode4.value = document.frmaddDept.foccode4.value +','+document.frmaddDept.qcdocrefno.value;
				cnt++;
			}
			
		}
	}
	
	if(cnt > 0)
	{
		return true;
	}
	else
	{
		alert("Select Sample(s) No. To Update");
		return false;
	}

}

function setgermpval(ttval,srno)
{
	//alert(ttval);
	if(ttval=="SGT")
	{
		document.getElementById("germpercentage_"+srno).value=document.getElementById("sgtgermp_"+srno).value;
	}
	if(ttval=="FGT")
	{
		document.getElementById("germpercentage_"+srno).value=document.getElementById("fgtgermp_"+srno).value;
	}
		document.getElementById("germptesttype_"+srno).value=ttval;
}

function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}
function searchlotname(searchval)
{
	//if(searchval.length==7)
	searchUser(searchval,"searchresult","lotserch",'','','','','','','','','','');
}

function openmoistdata(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('getuser_moistdatavfy.php?tid='+tid,'WelCome','top=10,left=180,width=820,height=600,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

function openppdata(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('getuser_ppdatavfy.php?tid='+tid,'WelCome','top=10,left=180,width=820,height=600,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

function opengermpdata(tid)
{
//var itm=document.frmaddDepartment.tid.value;
winHandle=window.open('getuser_germpdatavfy.php?tid='+tid,'WelCome','top=10,left=180,width=820,height=600,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}
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
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - QC Data Verification and Result Update</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="flagcode" value="" />
	  <input type="hidden" name="foccode" value="" />
	  <input type="hidden" name="foccode1" value="" />
	  <input type="hidden" name="foccode2" value="" />
	  <input type="hidden" name="foccode3" value="" />
	  <input type="hidden" name="foccode4" value="" />
	   <input type="hidden" name="eurl" value="<?php echo $eurl;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="0" width="970" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td align="center" colspan="12" class="tblheading">QC Data Verification and Result Pending List</td>
  <!-- <td width="171" align="left" class="tblheading">&nbsp;Search Lot No.&nbsp;<input type="text" class="smalltbltext" size="7" maxlength="7" name="lsearch" id="lsearch" onkeyup="searchlotname(this.value)" style="background-color:#FFFFFF; border-color:#378b8b" placeholder="DP12345" />&nbsp;</td>
 <td width="98" align="right" class="tblheading"><a href="home_qcdata_filter.php">Search Options</a>&nbsp;&nbsp;&nbsp;</td>-->
</tr>
<tr height="3"></tr>
</table>
<div id="searchresult" name="searchresult">



<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#d21704" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="19" height="22"align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
	<td width="84" align="center" valign="middle" class="smalltblheading" rowspan="2">Crop</td>
	<td width="115" align="center" valign="middle" class="smalltblheading" rowspan="2">Variety</td>
	<td width="101" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No.</td>
	<td width="39" align="center" valign="middle" class="smalltblheading" rowspan="2">Qty</td>
	<td width="39" align="center" valign="middle" class="smalltblheading" rowspan="2">GKD</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="4">SGT Data</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="3">FGT Data</td>
	<td width="58" align="center" valign="middle" class="smalltblheading" rowspan="2">Select</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">Germ. %</td>
	<td width="50" align="center" valign="middle" class="smalltblheading" rowspan="2">LE</td>
	<td width="80" align="center" valign="middle" class="smalltblheading" rowspan="2">QC Result</td>
	<td width="60" align="center" valign="middle" class="smalltblheading" rowspan="2">QC Doc Ref No.</td>
</tr>
<tr class="tblsubtitle" height="20">
<td width="39" align="center" valign="middle" class="smalltblheading">Normal</td>
<td width="54" align="center" valign="middle" class="smalltblheading">Abnormal</td>
<td align="center" valign="middle" class="smalltblheading">Hard / FUG</td>
<td align="center" valign="middle" class="smalltblheading">Dead</td>
<td align="center" valign="middle" class="smalltblheading">Normal</td>
<td align="center" valign="middle" class="smalltblheading">Abnormal</td>
<td align="center" valign="middle" class="smalltblheading">Dead</td>
<td align="center" valign="middle" class="smalltblheading">Select</td>
<td align="center" valign="middle" class="smalltblheading">%</td>
</tr>
<?php
$srno=1; $sel=1;
$sql_arr_home=mysqli_query($link,"select distinct sampleno from tbl_qctest where bflg=1 and spdate IS NOT NULL and spdate!='0000-00-00' and qcflg=0 and state!='T' order by  spdate ASC, tid desc ") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home > 0)
{
while($row_arr_home24=mysqli_fetch_array($sql_arr_home))
{
	
	$flg=0;
	
	$sql_arr_home2=mysqli_query($link,"select max(tid) from tbl_qctest where bflg=1 and qcflg=0 and state!='T' and sampleno='".$row_arr_home24['sampleno']."' order by spdate ASC, tid desc") or die(mysqli_error($link));
	$row_arr_home2=mysqli_fetch_array($sql_arr_home2);
	
	$sql_arr_home24=mysqli_query($link,"select * from tbl_qctest where bflg=1 and qcflg=0 and state!='T' and sampleno='".$row_arr_home24['sampleno']."' and tid='".$row_arr_home2[0]."' order by spdate ASC, tid desc") or die(mysqli_error($link));
	while($row_arr_home=mysqli_fetch_array($sql_arr_home24))
	{
	$moistflg=0; $ppflg=0; $germflg=0; $resultflg=0; $moistpercentages=''; $ppresult='';
	
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	
	$tp1=$row_param['code'];
	$sampno=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$row_arr_home24['sampleno']);
	$qcg_sgtnormalavg=0; $qcg_sgtabnormalavg=0; $qcg_sgthardfugavg=0; $qcg_sgtdeadavg=0; $qcg_vignormalavg=0; $qcg_vigabnormalavg=0; $qcg_vigdeadavg=0; $qcg_testtype=''; $qcg_docsrefno=''; $qcg_setupdt='';
	if($row_arr_home['state']!="G")
	{
		$sql_mdata=mysqli_query($link,"select * from tbl_qcmdata where qcm_sampno='".$sampno."' ") or die(mysqli_error($link));
		while($row_mdata=mysqli_fetch_array($sql_mdata))
		{
			if($row_mdata['qcm_moistflg']==1)
				{$moistflg=1; $moistpercentages=number_format((float)$row_mdata['qcm_moistper'], 2, '.', '');}
			if($row_mdata['qcm_moistflg']==2)
				{$moistflg=2;}
			if($row_mdata['qcm_moistflg']==0)
				{$moistflg=3;}
		}
		
		$sql_pdata=mysqli_query($link,"select * from tbl_qcpdata where qcp_sampleno='".$sampno."' ") or die(mysqli_error($link));
		while($row_pdata=mysqli_fetch_array($sql_pdata))
		{
			if($row_pdata['qcp_ppdataflg']==1)
				{$ppflg=1; if($row_pdata['qcp_ppresult']=="Acceptable"){$ppresult="Acc";} else if($row_pdata['qcp_ppresult']=="Not Acceptable"){$ppresult="NAcc";}else {$ppresult="";}}
			if($row_pdata['qcp_ppdataflg']==2)
				{$ppflg=2;}
			if($row_pdata['qcp_ppdataflg']==0)
				{$ppflg=3;}
		}
		
		$sql_gdata=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' ") or die(mysqli_error($link));
		while($row_gdata=mysqli_fetch_array($sql_gdata))
		{
			if($row_gdata['qcg_germpflg']==1)
				{$germflg=1; }
			if($row_gdata['qcg_germpflg']==2)
				{$germflg=2;}
			if($row_gdata['qcg_germpflg']==0)
				{$germflg=3;}
			$qcg_sgtnormalavg=$row_gdata['qcg_sgtnormalavg']; 
			$qcg_sgtabnormalavg=$row_gdata['qcg_sgtabnormalavg']; 
			$qcg_sgthardfugavg=$row_gdata['qcg_sgthardfugavg']; 
			$qcg_sgtdeadavg=$row_gdata['qcg_sgtdeadavg']; 
			$qcg_vignormalavg=$row_gdata['qcg_vignormalavg']; 
			$qcg_vigabnormalavg=$row_gdata['qcg_vigabnormalavg']; 
			$qcg_vigdeadavg=$row_gdata['qcg_vigdeadavg']; 
			$qcg_testtype=$row_gdata['qcg_testtype']; 
			$qcg_docsrefno=$row_gdata['qcg_docsrefno'];	
			$qcg_setupdt=$row_gdata['qcg_setupdt'];	
		}
		
		if($moistflg==1 && $ppflg==1 && $germflg>0) {$resultflg=1;}
	}
	else
	{
		$sql_gdata=mysqli_query($link,"select * from tbl_qcgdata where qcg_sampleno='".$sampno."' ") or die(mysqli_error($link));
		while($row_gdata=mysqli_fetch_array($sql_gdata))
		{
			if($row_gdata['qcg_germpflg']==1)
				{$germflg=1; }
			if($row_gdata['qcg_germpflg']==2)
				{$germflg=2;}
			if($row_gdata['qcg_germpflg']==0)
				{$germflg=3;}
			$qcg_sgtnormalavg=$row_gdata['qcg_sgtnormalavg']; 
			$qcg_sgtabnormalavg=$row_gdata['qcg_sgtabnormalavg']; 
			$qcg_sgthardfugavg=$row_gdata['qcg_sgthardfugavg']; 
			$qcg_sgtdeadavg=$row_gdata['qcg_sgtdeadavg']; 
			$qcg_vignormalavg=$row_gdata['qcg_vignormalavg']; 
			$qcg_vigabnormalavg=$row_gdata['qcg_vigabnormalavg']; 
			$qcg_vigdeadavg=$row_gdata['qcg_vigdeadavg']; 
			$qcg_testtype=$row_gdata['qcg_testtype']; 
			$qcg_docsrefno=$row_gdata['qcg_docsrefno'];
			$qcg_setupdt=$row_gdata['qcg_setupdt'];	
		}
		if($germflg>0) {$resultflg=1;}
	}	
	//echo $moistflg."  -  ".$ppflg."  -  ".$germflg."<br/>";
	$setupdt=='';
	if($qcg_setupdt!='' && $qcg_setupdt!='0000-00-00' && $qcg_setupdt!='--' && $qcg_setupdt!='- -')
	{
		$setupdt=$qcg_setupdt;
	}
	if($moistflg>0 || $ppflg>0 || $germflg>0) 
	{
	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$crop=""; $variety=""; $lotno="";  $bags=0; $qty=0; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['oldlot'];
		}
		else
		{
		$lotno=$row_tbl_sub1['oldlot'];
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub1['qcstatus'];
		}
		else
		{
		$qc=$row_tbl_sub1['qcstatus'];
		}
	
		$trdate=$row_arr_home['srdate'];
		$tryear=substr($trdate,0,4);
		$trmonth=substr($trdate,5,2);
		$trday=substr($trdate,8,2);
		$trdate=$trday."-".$trmonth."-".$tryear;	
		
		$trdate1=$row_arr_home['spdate'];
		$tryear1=substr($trdate1,0,4);
		$trmonth1=substr($trdate1,5,2);
		$trday1=substr($trdate1,8,2);
		$trdate1=$trday1."-".$trmonth1."-".$tryear1;
		
	
		$lrole=$row_arr_home['arr_role'];
		$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
		$row3=mysqli_fetch_array($quer3);
		
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
		$rowvv=mysqli_fetch_array($quer3);
		$tt=$rowvv['popularname'];
		$leduration=$rowvv['leduration'];
		$tot=mysqli_num_rows($quer3);	
		if($tot==0)
		{
		 $vv=$row_arr_home['variety'];
		}
		else
		{
		  $vv=$tt;
		}
		  
		$stage=$row_tbl_sub1['trstage'];
		$pp=$row_tbl_sub1['state'];	
		$lotn=$row_tbl_sub1['lotno'];
			 
		$nob=0; $qty=0; $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $slocs2="";
		if($stage!="Pack")
		{
			$sql_qc_sub=mysqli_query($link,"SELECT distinct(lotldg_subbinid), lotldg_binid, lotldg_whid FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."'");
			$tt_sub=mysqli_num_rows($sql_qc_sub);
			while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
			{
			
				$sql_qc=mysqli_query($link,"SELECT max(lotldg_id) FROM tbl_lot_ldg WHERE lotldg_lotno='".$lotn."' and lotldg_subbinid='".$row_qc_sub['lotldg_subbinid']."'");
				$tt=mysqli_num_rows($sql_qc);
				while($row_qc=mysqli_fetch_array($sql_qc))
				{
				
					$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_qc[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
					$zz=mysqli_num_rows($sql_month);
					while ($row_month=mysqli_fetch_array($sql_month))
					{
					
					/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
					
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
					
					
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];*/
					
					$slups=$row_month['lotldg_balbags'];
					$slqty=$row_month['lotldg_balqty'];
					
					$aq1=explode(".",$slups);
					if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					$slups=$ac1;
					$slqty=$acn1;
					
					$nob=$nob+$slups;
					$qty=$qty+$slqty;
					}
				}
			}
		}
		else
		{
			$sql_qc_sub=mysqli_query($link,"SELECT distinct(subbinid), binid, whid FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."'");
			$tt_sub=mysqli_num_rows($sql_qc_sub);
			while($row_qc_sub=mysqli_fetch_array($sql_qc_sub))
			{
			
				$sql_qc=mysqli_query($link,"SELECT max(lotdgp_id) FROM tbl_lot_ldg_pack WHERE lotno='".$lotn."' and subbinid='".$row_qc_sub['subbinid']."'");
				$tt=mysqli_num_rows($sql_qc);
				while($row_qc=mysqli_fetch_array($sql_qc))
				{
				
					$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_qc[0]."' and balqty > 0")or die(mysqli_error($link));
					$zz=mysqli_num_rows($sql_month);
					while ($row_month=mysqli_fetch_array($sql_month))
					{
					
					/*$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_whouse=mysqli_fetch_array($sql_whouse);
					$wareh=$row_whouse['perticulars']."/";
					
					$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_binn=mysqli_fetch_array($sql_binn);
					$binn=$row_binn['binname']."/";
					
					
					$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_month['lotldg_subbinid']."' and binid='".$row_month['lotldg_binid']."' and whid='".$row_month['lotldg_whid']."'") or die(mysqli_error($link));
					$row_subbinn=mysqli_fetch_array($sql_subbinn);
					$subbinn=$row_subbinn['sname'];*/
					
					//$slups=$row_month['lotldg_balbags'];
					$slqty=$row_month['balqty'];
					
					$aq1=explode(".",$slups);
					if($aq1[1]==000){$ac1=$aq1[0];}else{$ac1=$slups;}
					
					$an1=explode(".",$slqty);
					if($an1[1]==000){$acn1=$an1[0];}else{$acn1=$slqty;}
					$slups=$ac1;
					$slqty=$acn1;
					
					$nob=$nob+$slups;
					$qty=$qty+$slqty;
					}
				}
			}
		}
	
		$aq=explode(".",$nob);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$nob;}
		
		$an=explode(".",$qty);
		if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
	
	
			
	
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
		$row31=mysqli_fetch_array($quer3);
	
		$tdate=$row_arr_home['testdate'];
		if($qc=="UT" && $tdate!='NULL')
		$flg++;
	}
if($germflg==2)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="19" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="84" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="101" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $setupdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtabnormalavg;?></td> 
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgthardfugavg;?></td> 
	<td width="27" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdeadavg?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignormalavg?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigabnormalavg?></td>
	<td width="27" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdeadavg?></td>
	
	<td align="center" valign="middle" class="smalltbltext">&nbsp;<?php if($germflg==1){echo "Verified";}else if($germflg==2){?><a href="Javascript:void(0);" onclick="opengermpdata('<?php echo $arrival_id?>')">Review</a><?php } else if($germflg==3){echo "In-Progress";} else {echo "YTS";}?><?php if($germflg==2){if(($pp=="P/M/G" || $pp=="P/M/G/T") && $moistflg==1 && $ppflg==1){ ?><input type="checkbox" name="germpsel" id="germpsel_<?php echo $sel;?>" value="<?php echo $arrival_id?>" /><?php } else if($pp=="G"){?><input type="checkbox" name="germpsel" id="germpsel_<?php echo $sel;?>" value="<?php echo $arrival_id?>" /><?php }else {?><input type="checkbox" name="germpsel" id="germpsel_<?php echo $sel;?>" value="<?php echo $arrival_id?>" disabled="disabled" /><?php }} else {echo "";}?></td>
	
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php if($qcg_testtype=="Both Germination Test"){?><input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="SGT" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />SGT&nbsp;<input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="FGT" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />FGT<input type="hidden" name="germptesttype" id="germptesttype_<?php echo $srno;?>" value="" /><?php } else if($qcg_testtype=="Standard Germination Test"){?><input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="SGT" checked="checked" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />SGT&nbsp;<input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="FGT" disabled="disabled" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />FGT<input type="hidden" name="germptesttype" id="germptesttype_<?php echo $srno;?>" value="SGT" /><?php } else {?><input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="SGT" onclick="setgermpval(this.value,'<?php echo $srno;?>')" disabled="disabled" />SGT&nbsp;<input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="FGT" checked="checked" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />FGT<input type="hidden" name="germptesttype" id="germptesttype_<?php echo $srno;?>" value="FGT" /><?php } ?></td>
	  
	<td width="58" align="center" valign="middle" class="smalltbltext"><input type="text" name="germpercentage" id="germpercentage_<?php echo $srno;?>" value="<?php if($qcg_testtype=="Standard Germination Test"){ echo $qcg_sgtnormalavg;} else if($qcg_testtype=="Field Germination Test"){ echo $qcg_vignormalavg;} else { echo "";}?>" readonly="true" style="background-color:#CCCCCC" size="1" /> <input type="hidden" name="sgtgermp" id="sgtgermp_<?php echo $srno;?>" value="<?php echo $qcg_sgtnormalavg;?>" /> <input type="hidden" name="fgtgermp" id="fgtgermp_<?php echo $srno;?>" value="<?php echo $qcg_vignormalavg;?>" /> </td>
	
	<td align="center" valign="middle" class="smalltbltext"><select name="leduration" id="leduration_<?php echo $srno;?>" class="tbltext" tabindex="0" style="width:40px;"   > 
 <option value="">Sel</option>
  <?php for($i=36; $i>=1; $i--) {?>
 <option value="<?php echo $i;?>" <?php if($leduration==$i)echo "Selected";?>><?php echo $i;?></option>
 <?php } ?>
 </select></td>
 
	
	<td width="80" align="center" valign="middle" class="smalltbltext"><select name="germptestresult" class="smalltbltext" style="size:70px;">
	<option selected="selected" value="">Sel</option>
	<option value="OK">OK</option>
	<option value="Fail">Fail</option>
	<option value="RT">RT</option>
	<option value="BL">BL</option>
	</select></td>
	<td width="60" align="center" valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" name="qcdocrefno" id="qcdocrefno_<?php echo $srno;?>" value="<?php echo $qcg_docsrefno;?>" size="4" /></td>
	
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="19" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="84" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="101" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $acn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $setupdt;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtnormalavg;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtabnormalavg;?></td> 
	<td width="30" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgthardfugavg;?></td> 
	<td width="27" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_sgtdeadavg?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vignormalavg?></td>
	<td width="54" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigabnormalavg?></td>
	<td width="27" align="center" valign="middle" class="smalltbltext"><?php echo $qcg_vigdeadavg?></td>
	
	<td align="center" valign="middle" class="smalltbltext">&nbsp;<?php if($germflg==1){echo "Verified";}else if($germflg==2){?><a href="Javascript:void(0);" onclick="opengermpdata('<?php echo $arrival_id?>')">Review</a><?php } else if($germflg==3){echo "In-Progress";} else {echo "YTS";}?><?php if($germflg==2){if(($pp=="P/M/G" || $pp=="P/M/G/T") && $moistflg==1 && $ppflg==1){ ?><input type="checkbox" name="germpsel" id="germpsel_<?php echo $sel;?>" value="<?php echo $arrival_id?>" /><?php } else if($pp=="G"){?><input type="checkbox" name="germpsel" id="germpsel_<?php echo $sel;?>" value="<?php echo $arrival_id?>" /><?php }else {?><input type="checkbox" name="germpsel" id="germpsel_<?php echo $sel;?>" value="<?php echo $arrival_id?>" disabled="disabled" /><?php }} else {echo "";}?></td>
	
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php if($qcg_testtype=="Both Germination Test"){?><input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="SGT" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />SGT&nbsp;<input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="FGT" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />FGT<input type="hidden" name="germptesttype" id="germptesttype_<?php echo $srno;?>" value="" /><?php } else if($qcg_testtype=="Standard Germination Test"){?><input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="SGT" checked="checked" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />SGT&nbsp;<input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="FGT" disabled="disabled" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />FGT<input type="hidden" name="germptesttype" id="germptesttype_<?php echo $srno;?>" value="SGT" /><?php } else {?><input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="SGT" onclick="setgermpval(this.value,'<?php echo $srno;?>')" disabled="disabled" />SGT&nbsp;<input type="radio" name="testtype<?php echo $srno;?>" id="testtype_<?php echo $srno;?>" value="FGT" checked="checked" onclick="setgermpval(this.value,'<?php echo $srno;?>')" />FGT<input type="hidden" name="germptesttype" id="germptesttype_<?php echo $srno;?>" value="FGT" /><?php } ?></td>
	  
	<td width="58" align="center" valign="middle" class="smalltbltext"><input type="text" name="germpercentage" id="germpercentage_<?php echo $srno;?>" value="<?php if($qcg_testtype=="Standard Germination Test"){ echo $qcg_sgtnormalavg;} else if($qcg_testtype=="Field Germination Test"){ echo $qcg_vignormalavg;} else { echo "";}?>" readonly="true" style="background-color:#CCCCCC" size="1" /> <input type="hidden" name="sgtgermp" id="sgtgermp_<?php echo $srno;?>" value="<?php echo $qcg_sgtnormalavg;?>" /> <input type="hidden" name="fgtgermp" id="fgtgermp_<?php echo $srno;?>" value="<?php echo $qcg_vignormalavg;?>" /> </td>
	
	 <td align="center" valign="middle" class="smalltbltext"><select name="leduration" id="leduration_<?php echo $srno;?>" class="tbltext" tabindex="0" style="width:40px;"   > 
 <option value="">Sel</option>
  <?php for($i=36; $i>=1; $i--) {?>
 <option value="<?php echo $i;?>" <?php if($leduration==$i)echo "Selected";?>><?php echo $i;?></option>
 <?php } ?>
 </select></td>
  
	
	<td width="80" align="center" valign="middle" class="smalltbltext"><select name="germptestresult" class="tbldtext" style="size:70px;">
	<option selected="selected" value="">Sel</option>
	<option value="OK">OK</option>
	<option value="Fail">Fail</option>
	<option value="RT">RT</option>
	<option value="BL">BL</option>
	</select></td>
	<td width="60" align="center" valign="middle" class="smalltbltext"><input type="text" class="smalltbltext" name="qcdocrefno" id="qcdocrefno_<?php echo $srno;?>" value="<?php echo $qcg_docsrefno;?>" size="4" /> </td>
</tr>
<?php
}
$srno=$srno+1;$cont++;
}
}
}
}
}
?><input type="hidden" name="srno" value="<?php echo $srno;?>" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="950">
    <tr >
      <td align="right" colspan="3"><input name="image" type="image" style="display:inline;cursor:pointer;" onclick="mySubmit();" src="../images/preview.gif" alt="Submit Value" border="0"/></td>
    </tr>
  </table>
</div>
		  

</td>
<td width="30"></td>
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
