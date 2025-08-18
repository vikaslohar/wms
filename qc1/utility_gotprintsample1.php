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
	
	 $cid = $_REQUEST['txtcrop']; 
	 $itemid = $_REQUEST['txtvariety']; 
	 $txtlot1 = $_REQUEST['txtlot1']; 
	 $txtlot2 = $_REQUEST['txtlot2']; 
	 $txtpp = $_REQUEST['txtpp']; 
	//exit;
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
	}
	

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Supervisor - Utility - GOT Sample Printing</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="dailrep.js"></script>
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
<SCRIPT language="JavaScript">


function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
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
	if(document.frmaddDepartment.txtcrop.value == "")
	{
		alert("Please select Crop");
		return false;
	}
	else if(document.frmaddDepartment.txtvariety.value == "")
	{
		alert("Please Select Variety");
		return false;
	}
	else if(document.frmaddDepartment.txtlot1.value == "")
	{
		alert("Please Select Lot Number(s)");
		return false;
	}
	else
	{
		//alert("submit");
		document.frmaddDepartment.submit();
	}
}
function modetchk(classval)
{	
	showUser(classval,'vitem','itemutility','','','','','');
}

function modetchk2(classval)
{	
	if(document.frmaddDepartment.txtcrop.value == "")
	{
		alert("Please select Crop");
		return false;
	}
}
function modetchk5(classval)
{	
	if(document.frmaddDepartment.txtvariety.value == "")
	{
		alert("Please Variety");
		return false;
	}
}
function printfilesave(crop,samplenumber,txtpp)
{
	//alert(crop);
	if(samplenumber!="")
	{
		winHandle=window.open('getuser_gotprint.php?crop='+crop+'&samplenumber='+samplenumber+'&txtpp='+txtpp,'WelCome','top=10,left=10,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="5000" align="center"  class="midbgline">
		  <!-- actual page start--->	

  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="30"class="Mainheading"  >Sample Printing</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
          <tr height="7">
            <td height="7"></td>
          </tr>
          <tr>
            <td width="30"></td>
            <td><table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
                <tr class="tblsubtitle" height="25">
                  <td colspan="6" align="center" class="tblheading">Sample Printing</td>
                </tr>
                 <tr class="Light" height="25">
				 <td align="center"  valign="middle" class="tblheading" >#</td>
				 <td align="left"  valign="middle" class="tblheading" >&nbsp;Crop</td>
				 <td align="left"  valign="middle" class="tblheading" >&nbsp;Variety</td>
				 <td align="left"  valign="middle" class="tblheading" >&nbsp;Lot Number</td>
				 <td align="left"  valign="middle" class="tblheading" >&nbsp;Sample Number</td>
				 <td align="center"  valign="middle" class="tblheading" >Print</td>
				 </tr>
<?php
$itm=explode(",",$txtlot2);$srno=1;
$cont=0;$cnt=0;$v1=array();
foreach($itm as $tid)
{
if($tid <> "")
{
$sql_arr_home=mysqli_query($link,"select * from tbl_gottest where gottest_tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{ 

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$qc1=$row_arr_home['gottest_sampleno'];

	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $orlot=""; $totnob=0; $totqty=0; $cont=0;

	
	
	$lotno=$row_arr_home['gottest_lotno'];
	$orlot=$row_arr_home['gottest_oldlot'];
	$stage=$row_arr_home['gottest_trstage'];

	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
	$row_param=mysqli_fetch_array($sql_param);
	
	$tp1=$row_arr_home['plantcode'];
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	$crop=$row31['cropname'];
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['gottest_variety']."' and actstatus='Active'"); 
	$row=mysqli_fetch_array($quer3);
	$tt=$row['popularname'];
	$tot=mysqli_num_rows($quer3);	
	if($tot==0)
	{
		$variety=$row_arr_home['gottest_variety'];
	}
	else
	{
		$variety=$tt;
	}
	$samplenumber=$tp1.$row_arr_home['yearid'].sprintf("%000006d",$qc1);
	
if($srno%2!=0)
{	
?>
	<tr class="Light" height="25">
		 <td align="center"  valign="middle" class="tblheading" ><?php echo $srno;?></td>
		 <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $crop;?></td>
		 <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $variety;?></td>
		 <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $lotno;?></td>
		 <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $samplenumber;?></td>
		 <td align="center"  valign="middle" class="tblheading" ><a href="Javascript:void(0);" onclick="printfilesave('<?php echo $crop;?>','<?php echo $samplenumber;?>','<?php echo $txtpp;?>')"><img src="../images/Print.gif" border="0" /></a></td>
	</tr>
<?php
}
else
{
?>
	<tr class="Light" height="25">
		 <td align="center"  valign="middle" class="tblheading" ><?php echo $srno;?></td>
		 <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $crop;?></td>
		 <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $variety;?></td>
		 <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $lotno;?></td>
		 <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $samplenumber;?></td>
		 <td align="center"  valign="middle" class="tblheading" ><a href="Javascript:void(0);" onclick="printfilesave('<?php echo $crop;?>','<?php echo $samplenumber;?>','<?php echo $txtpp;?>')"><img src="../images/Print.gif" border="0" /></a></td>
	</tr>
<?php
}
}
}
}
}
?>				 				 
              </table>
                </td>
            <td ></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
	    <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	  </form>	  </td>
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
