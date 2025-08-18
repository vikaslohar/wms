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
	
	$sql_tbl=mysqli_query($link,"select * from tbl_qctest where aflg=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['tid'];	
}
		
	if(isset($_POST['frm_action'])=='submit')
	{
				//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_trading1.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction -Sampling</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="samp.js"></script>
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
winHandle=window.open('getuser_status1.php?tid='+tid,'WelCome','top=170,left=180,width=550,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function selectall()
{
//alert(document.frmaddDept.foc.value);
	if(document.frmaddDept.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDept.prchk.length; i++)
		{          
			document.frmaddDept.prchk[i].checked = true;
		}
	}	
	else
	{
		document.frmaddDept.prchk.checked = true;
	}
}

function unselectall()
{
	if(document.frmaddDept.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDept.prchk.length; i++) 
		{          
			document.frmaddDept.prchk[i].checked = false;
			document.frmaddDept.flagcode.value ="";
		}
	}
	else
	{
		document.frmaddDept.prchk.checked = false;
		document.frmaddDept.flagcode.value ="";
	}	
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
		winHandle=window.open('getuser_status_sl.php?tid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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

function openslocpopprint2()
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
		winHandle=window.open('getuser_status2.php?tid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
		}
	else
	{
		alert("Select Sample(s) No. To Update");
		return false;
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
	dt1=getDateObject(document.frmaddDept.sdate.value,"-");
	dt2=getDateObject(document.frmaddDept.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
return true;
}
function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - Pending Request </td>
	    </tr></table></td>
	 
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="hidden" name="flagcode" value="" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
 $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where aflg=0 and bflg=0 and cflg=0 group by sampleno order by sampleno asc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);  
?>
<table align="center" border="0" width="943" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td align="middle" class="tblheading">QC Pending  List </td><td width="45" align="right" class="tblheading"><a style="text-decoration:underline; color:#0000FF; cursor:pointer" onclick="selectall();">CA</a>&nbsp;|&nbsp;<a style="text-decoration:underline; color:#0000FF; cursor:pointer " onclick="unselectall();">CL</a></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="24" height="19"align="center" valign="middle" class="smalltblheading">#</td>
			   <td width="63" align="center" valign="middle" class="smalltblheading">DOSR</td>
			   <td width="90" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="125" align="center" valign="middle" class="smalltblheading">Variety</td>
              <td width="103" align="center" valign="middle" class="smalltblheading">Lot No.</td> 
			  <td width="54" align="center" valign="middle" class="smalltblheading">Total Qty</td>
			  <td width="300" align="center" valign="middle" class="smalltblheading">Stage, NoB/Qty, SLOC</td>
              <td width="42" align="center" valign="middle" class="smalltblheading">QC Tests </td>
			  <td width="31" align="center" valign="middle" class="smalltblheading">Opr Code</td>
			    <td align="center" valign="middle" class="smalltblheading">Sample No. </td>
              <td width="38" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="openslocpopprint();">Print</a><br />
<a href="Javascript:void(0);" onclick="openslocpopprint2();">Update</a></td>
              </tr>
<?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
			
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$crop=""; $variety=""; $lotno=""; $stage=""; $got=""; $qc=""; 
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{			
	
	$lotno=$row_tbl_sub1['oldlot'];
	
	$lrole=$row_arr_home['arr_role'];
	
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer31=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer31);
	
	$quer32=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$row=mysqli_fetch_array($quer32);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer32);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
$details="";$totqty=0;


$sql_tblsub1=mysqli_query($link,"select distinct lotldg_sstage from tbl_lot_ldg where orlot='".$lotno."' order by orlot") or die(mysqli_error($link));
$t_tblsub1=mysqli_num_rows($sql_tblsub1);
while($rowtbl22=mysqli_fetch_array($sql_tblsub1))
{

$bags=0; $qty=0; $slocs="";
$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where orlot='".$lotno."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."' group by lotldg_subbinid, lotldg_variety, orlot order by lotldg_subbinid") or die(mysqli_error($link));
	$t=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl22=mysqli_fetch_array($sql_tbl_sub1))
{$ac=0; $acn=0; $gd=""; $slups=0;$slqty=0;
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl22['lotldg_subbinid']."' and orlot='".$lotno."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));
$total_tbl=mysqli_num_rows($sql1);

while($row_tbl=mysqli_fetch_array($sql1))
{	
//$lotldg_trid=$row_tbl['lotldg_trid'];
$ac=0; $acn=0;
$aq=explode(".",$row_tbl['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; 

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['lotldg_subbinid']."' and binid='".$row_tbl['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$slups+$row_tbl['lotldg_balbags'];
 
$an24=explode(".",$row_tbl['lotldg_balqty']);
if($an24[1]==000){$acn24=$an[0];}else{$acn24=$row_tbl['lotldg_balqty'];}
$slqty=$slqty+$acn24;

if($slocs!="")
$slocs=$slocs.", ".$wareh.$binn.$subbinn." | ".$ac." | ".$acn;
else
$slocs=$wareh.$binn.$subbinn." | ".$ac." | ".$acn;	
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
		$bags=$bags+$ac;
		$qty=$qty+$acn;
$totqty=$totqty+$qty;
}
}
$stage=$row_tbl_sub1['logid'];
$pp=$row_tbl_sub1['state'];	

$ddss=$rowtbl22['lotldg_sstage'];
$val=$row_tbl_sub1['trstage']; 
$ddss="<b>".$rowtbl22['lotldg_sstage']."</b>";
	
if($qty > 0)	
{
if($details!="")
$details=$details.$ddss;
else
$details=$ddss; 

	$details=$details.", ".$bags." | ".$qty.", ".$slocs."<br/>";
}
}



//if($details=="" && $totqty==0)
{
$sql_tblsub1=mysqli_query($link,"select distinct lotldg_sstage from tbl_lot_ldg_pack where orlot='".$lotno."' order by orlot") or die(mysqli_error($link));
$t_tblsub1=mysqli_num_rows($sql_tblsub1);
while($rowtbl22=mysqli_fetch_array($sql_tblsub1))
{
$bags=0; $qty=0; $slocs="";
$sql_tbl_sub1=mysqli_query($link,"select distinct subbinid, lotldg_variety, lotldg_crop, whid, binid from tbl_lot_ldg_pack where orlot='".$lotno."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."' group by subbinid, lotldg_variety, orlot order by subbinid") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_tbl_sub1);
while($row_tbl22=mysqli_fetch_array($sql_tbl_sub1))
{$ac=0; $acn=0; $gd=""; $slups=0;$slqty=0;
$sql_tbl1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where subbinid='".$row_tbl22['subbinid']."' and orlot='".$lotno."' and lotldg_sstage='".$rowtbl22['lotldg_sstage']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg_pack where lotdgp_id='".$row_tbl1[0]."' and balqty > 0")or die(mysqli_error($link));
$total_tbl=mysqli_num_rows($sql1);

while($row_tbl=mysqli_fetch_array($sql1))
{	
//$lotldg_trid=$row_tbl['lotldg_trid'];
$ac=0; $acn=0;
$aq=explode(".",$row_tbl['balnop']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['balnop'];}

$an=explode(".",$row_tbl['balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['balqty'];}

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; 

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl['whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl['binid']."' and whid='".$row_tbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl['subbinid']."' and binid='".$row_tbl['binid']."' and whid='".$row_tbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$slups=$slups+$row_tbl['balnop'];
 
$an24=explode(".",$row_tbl['balqty']);
if($an24[1]==000){$acn24=$an[0];}else{$acn24=$row_tbl['balqty'];}
$slqty=$slqty+$acn24;

if($slocs!="")
$slocs=$slocs.", ".$wareh.$binn.$subbinn." | ".$ac." | ".$acn;
else
$slocs=$wareh.$binn.$subbinn." | ".$ac." | ".$acn;	
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
		$bags=$bags+$ac;
		$qty=$qty+$acn;
$totqty=$totqty+$qty;
}
}
$stage=$row_tbl_sub1['logid'];
$pp=$row_tbl_sub1['state'];	

$ddss=$rowtbl22['lotldg_sstage'];
$val=$row_tbl_sub1['trstage']; 
$ddss="<b>".$rowtbl22['lotldg_sstage']."</b>";

if($qty > 0)	
{
if($details!="")
$details=$details.$ddss;
else
$details=$ddss; 

	$details=$details.", ".$bags." | ".$qty.", ".$slocs."<br/>";
}
}
}


}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="24" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="63" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="103" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>  
	<td width="300" align="center" valign="middle" class="smalltbltext"><?php echo $details;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>
	<td width="31" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="openslocpopprint1('<?php echo $row_arr_home['tid'];?>');"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="prchk" value="<?php echo $row_arr_home['tid'];?>"></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td width="24" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="63" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="103" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>  
	<td width="300" align="center" valign="middle" class="smalltbltext"><?php echo $details;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>
	<td width="31" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td width="56" align="center" valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="openslocpopprint1('<?php echo $row_arr_home['tid'];?>');"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="prchk" value="<?php echo $row_arr_home['tid'];?>"></td>
</tr>
<?php
}
$srno=$srno+1;
}
?>
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
</table>
<?php
 }
?>
		  </br>
		 <!--<table align="center" width="700" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
</table>-->


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
