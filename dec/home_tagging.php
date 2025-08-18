<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
	//$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	
	$m=mysqli_query($link,"DELETE FROM tblspctmp ") or Die(mysqli_error($link));
		
	if(isset($_POST['frm_action'])=='submit')
	{
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
		//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
		/*echo "<script>window.location='add_tagging_lot_list.php?sdate=$sdate1&edate=$edate1'</script>";*/
		header('Location: add_tagging_lot_list.php?sdate='.$sdate1.'&edate='.$edate1);
		}
		else
		{
		/*echo "<script>window.location='home_tagging.php'</script>";*/
		header('Location: add_tagging_lot_list.php');
		}
	}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Decode- Transaction - Home Decode File Import</title>
<link href="../include/main_dec.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
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
function ck()
{
document.getElementById("dsp").style.display="block";
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
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr>
          <td valign="top"><?php require_once("../include/arr_adm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dec_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/dec_rupee1.gif" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25"><table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" style="border-bottom:solid; border-bottom-color:#7a9931" >
        <tr >
          <td width="820" height="25">&nbsp;Transaction - Decode File Import</td>
        </tr>
	    </table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_tagging_lot.php" style="text-decoration:none; color:#000000">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#000000">Add </a><?php } ?></td>
</tr>
</table></td>
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
		  <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
	$sql_arr_home=mysqli_query($link,"select max(spdecdate),spdecid from tblspdec where spdectype='DE' ") or die(mysqli_error($link));
	$tot_arr_home=mysqli_fetch_array($sql_arr_home);
	//echo $tot_arr_home[1];
	
	$sql_tbl=mysqli_query($link,"select * from tblspdec where spdecdate='".$tot_arr_home[0]."'  order by spdecid asc") or die(mysqli_error($link));
	//echo $row_tbl=mysqli_num_rows($sql_tbl);	
	$dt=date("d-m-Y");
?>


<!--- Table Place Holder --->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#7a9931"
 style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="3%"align="center" valign="middle" class="tblheading">#</td>
			  <td width="9%" align="center" valign="middle" class="tblheading">Date</td>
			  <td align="center" valign="middle" class="tblheading">SP Code-Female</td>
              <td width="13%" align="center" valign="middle" class="tblheading">SP Code-Male</td>
			  <td width="22%" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
              <td width="33%" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
			  <td align="center" valign="middle" class="tblheading">Import Status</td>
              </tr>
<?php
	$trdate=$tot_arr_home[0];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$row_arr_home=mysqli_fetch_array($sql_tbl);
	$arrival_id=$row_arr_home['spdecid'];
	
$srno=1; $crop=""; $variety=""; $spcf=""; $spcm="";

$sql_tbl_sub=mysqli_query($link,"select * from tblspcodes where spdecid='".$arrival_id."' ") or die(mysqli_error($link));
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['crop']."'"); 
	$row3=mysqli_fetch_array($quer3);

	$quer4=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['variety']."'  and vertype='PV'"); 
	$row4=mysqli_fetch_array($quer4);

if($crop!="")
$crop=$crop."<br>&nbsp;".$row3['cropname'];
else
$crop=$row3['cropname'];

if($variety!="")
$variety=$variety."<br>&nbsp;".$row4['popularname'];
else
$variety=$row4['popularname'];

if($spcf!="")
$spcf=$spcf."<br>".$row_tbl_sub['spcodef'];
else
$spcf=$row_tbl_sub['spcodef'];

if($spcm!="")
$spcm=$spcm."<br>".$row_tbl_sub['spcodem'];
else
$spcm=$row_tbl_sub['spcodem'];

}	
?>			  
<tr class="Light">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $spcf;?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $spcm;?></td>
		 <td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $crop;?></td>
		 <td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $variety;?></td>
		 <td width="7%" align="center" valign="middle" class="tblheading">IMP-Yes</td>
		 
</tr>
<!--<tr class="Dark" height="25">
<td valign="middle" align="right" colspan="10" width="750" ><input type="image" src="../images/next.gif" border="0" style="display:inline;cursor:pointer;" name="submit" onclick="return mySubmit();" />&nbsp;&nbsp;</td>
</tr>-->

          </table>
		  <!--<table align="center" width="750" cellpadding="5" cellspacing="5" border="0"  >
<tr >
<td valign="middle" align="right" colspan="10" width="750" ><input type="image" src="../images/next.gif" border="0" style="display:inline;cursor:pointer;" name="submit" onclick="return mySubmit();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
		  <br/>
<table  align="center" border="0" cellspacing="0" cellpadding="0" width="750" >
<tr  height="20" class="tblheading">
  <td colspan="6" align="left" >&nbsp;<font color="#000000" size="+1">Rules</font></td>
</tr>
</table>
<table  align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#7a9931"
 style="border-collapse:collapse" >
<tr  height="10">

<td width="664"  align="left" valign="middle" class="smalltblheading">&nbsp;1.&nbsp;Import file need to carry data in required format.</td>
</tr>
<tr  height="10">

<td width="664"  align="left" valign="middle" class="smalltblheading">&nbsp;2.&nbsp;Data not in due format will not be imported.</td>
</tr>
<tr  height="10">

<td width="664"  align="left" valign="middle" class="smalltblheading">&nbsp;3.&nbsp;Already existing data with similar SP Code-Female and SP Code-Male combination will not be imported.</td>
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
