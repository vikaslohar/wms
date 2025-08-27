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
	
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality-Report GOT Sample Dispatch Report</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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

</script>
<SCRIPT language="JavaScript">

function openprint()
{

var sdate=document.frmaddDepartment.sdate.value; 
var edate=document.frmaddDepartment.edate.value; 
var loc=document.frmaddDepartment.txtcrop.value;
var itemid=document.frmaddDepartment.txtvariety.value;
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('gotsmpdispreport2.php?sdate='+sdate+'&cid='+loc+'&itemid='+itemid+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcs.php"); ?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>

   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="30">&nbsp;GOT Sample Dispatch Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
<?php 
	
	$sdate = $_REQUEST['sdate'];
 	$edate = $_REQUEST['edate'];
	$itemid = $_REQUEST['cid'];
	$vv = $_REQUEST['itemid'];
?>	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
	   <input name="txtvariety" value="<?php echo $vv;?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php	
	
		$ddate1=explode("-",$sdate);
		$sdate=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
		
		$pdate1=explode("-",$edate);
		$edate=$pdate1[2]."-".$pdate1[1]."-".$pdate1[0];
		
	
	
	 	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$itemid."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		$crop=$row_class['cropname'];	 

	if($itemid=="ALL" && $vv=="ALL")
	{	
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where dosdate<='$edate' and dosdate>='$sdate' and  gotsmpdflg=1 order by dosdate asc ") or die(mysqli_error($link));
	}
	else if($itemid!="ALL" && $vv=="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where dosdate<='$edate' and dosdate>='$sdate' and crop='".$itemid."' and  gotsmpdflg=1 order by dosdate asc ") or die(mysqli_error($link));
	}
	else if($itemid!="ALL" && $vv!="ALL")
	{
	$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where dosdate<='$edate' and dosdate>='$sdate' and crop='".$itemid."' and variety='$vv' and  gotsmpdflg=1 order by dosdate asc ") or die(mysqli_error($link));
	}
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

	if($itemid=="ALL")
	{
		$crop="ALL";
	}
	else
	{
		$quer2=mysqli_query($link,"SELECT  cropname,cropid FROM tblcrop where cropid='$itemid'"); 
		$row_dept=mysqli_fetch_array($quer2);
		$crop=$row_dept['cropname'];
	}
	if($vv=="ALL")
	{
		$variet="ALL";
	}
	else
	{
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$vv."' "); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$vv;
	 }
	 else
	 {
	  $vv=$tt;
	  }
	}
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  	<tr height="25" >
    <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crop;?></td>
	<td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $vv;?></td>
  	</tr>
	</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="21" align="center" valign="middle" class="tblheading">#</td>
			<td width="98"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="184"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="102"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="81"  align="center" valign="middle" class="tblheading">Sample No.</td>
			<td width="70"  align="center" valign="middle" class="tblheading">DOSR</td>
			<td width="72"  align="center" valign="middle" class="tblheading">DOSC</td>
			<td width="77" align="center" valign="middle" class="tblheading">DOSD</td>
			<td width="66" align="center" valign="middle" class="tblheading" >Location</td>
			<td width="57" align="center" valign="middle" class="tblheading" >Mode</td>
			<td width="57" align="center" valign="middle" class="tblheading" >GSDN No.</td>
</tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
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
	
	$trdate2=$row_arr_home['dosdate'];
	$tryear2=substr($trdate2,0,4);
	$trmonth2=substr($trdate2,5,2);
	$trday2=substr($trdate2,8,2);
	$trdate2=$trday2."-".$trmonth2."-".$tryear2;
				


	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//echo $row_arr_home['tid'];
	$gsdnid="";
	$sql_dtchk=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=1 order by arrival_id asc") or die(mysqli_error($link));
	$tot_dtchk=mysqli_num_rows($sql_dtchk);
	while($row_dtchk=mysqli_fetch_array($sql_dtchk))
	{
		$lid=explode(",",$row_dtchk['lotno']);
		foreach($lid as $fid)
		{
			if($fid <> "" && $fid!=0)
			{
				if($fid==$row_arr_home['tid'])
				{
				$gsdnid="GSD"."/".$row_dtchk['year_code']."/".$row_dtchk['gsdn'];
				
				if($row_dtchk['pid']=="Yes")
				{
					$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_dtchk['party_id']."'"); 
					$row3=mysqli_fetch_array($quer3);
					$address=$row3['city'];
				}
				else
				{
					$address=$row_dtchk['city'];
				}
				
				$tmode=$row_dtchk['tmode'];
				
				$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
				$row_param=mysqli_fetch_array($sql_param);

				$tp1=$row_param['code'];
				$qc1=$row_arr_home['sampleno'];

if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
		 <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="98" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="184" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		 <td width="102" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['oldlot'];?></td>
         <td width="81" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
         <td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
         <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $address?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $tmode;?></td>
		 <td width="57" align="center" valign="middle" class="tblheading"><?php echo $gsdnid;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
		 <td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="98" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="184" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		 <td width="102" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['oldlot'];?></td>
         <td width="81" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
         <td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
         <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $address?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $tmode;?></td>
		 <td width="57" align="center" valign="middle" class="tblheading"><?php echo $gsdnid;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
}
else
{
?>
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
<?php
}
?>
  </table>			
<table width="950" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="gotsmpdispreport.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td width="30" ></td>
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
