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
	
		
		$crop = $_REQUEST['txtcrop'];
		$variety = $_REQUEST['txtvariety'];
	
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales Return-Report-Opening Stock Report</title>
<link href="../include/main_sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
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
var itemid=document.frmaddDepartment.txtcrop.value;
var vv=document.frmaddDepartment.txtvariety.value;
winHandle=window.open('report_sropening2.php?&txtcrop='+itemid+'&txtvariety='+vv,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
  <tr><td>
<?php
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
		
	$crp="ALL"; $ver="ALL";
	$qry="select Distinct salesrs_crop from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_stage='Condition'";
	if($crop!="ALL")
	{	
	$qry.=" and salesrs_crop='$crop' ";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	}
	if($variety!="ALL")
	{	
	$qry.=" and salesrs_variety='$variety' ";
		$sql_var=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."' ") or die(mysqli_error($link));
		$row_var=mysqli_fetch_array($sql_var);
		$ver=$row_var['popularname'];
	}
	
	$qry.=" group by salesrs_crop order by salesrs_crop asc";
	
	$sql_arr_home1=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home1);
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" style="border-bottom:solid; border-bottom-color:#a8a09e" >
	    <tr >
	      <td width="813" height="25">&nbsp;Sales Return - Opening Stock Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="970" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; " colspan="6">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>-->
	<tr height="25" >
	 <td align="left" class="subheading" style="color:#303918; ">Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?></td>
  	</tr>
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#a8a09e" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
            <td width="24" align="center" valign="middle" class="tblheading">#</td>
			<td width="66" align="center" valign="middle" class="tblheading">Date</td>
			<td width="85"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="127"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="115"  align="center" valign="middle" class="tblheading">Old Lot No.</td>
			<td width="110" align="center" valign="middle" class="tblheading">New Lot No.</td>
			<td width="45"  align="center" valign="middle" class="tblheading">NoB</td>
			<td width="55" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="40" align="center" valign="middle" class="tblheading">QC Status</td>
			<td width="65" align="center" valign="middle" class="tblheading">DoT</td>
			<td width="40" align="center" valign="middle" class="tblheading">Moist. %</td>
			<td width="40" align="center" valign="middle" class="tblheading">Germ. %</td>
			<td width="130" align="center" valign="middle" class="tblheading">SLOC</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home1=mysqli_fetch_array($sql_arr_home1))
{
	
	if($variety!="ALL")
	{
		$sql_arr_home=mysqli_query($link,"select distinct salesrs_variety from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$variety."' ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct salesrs_variety from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."'") or die(mysqli_error($link));
	}	

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

$sql_arr_home2=mysqli_query($link,"select *  from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_crop='".$row_arr_home1['salesrs_crop']."' and salesrs_variety='".$row_arr_home['salesrs_variety']."' ") or die(mysqli_error($link));

while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{	
	$crop1=""; $variety1="";
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr_home1['salesrs_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr_home['salesrs_variety']."' ") or die(mysqli_error($link));
	$rowvv=mysqli_fetch_array($sql_variety);
	$crop1=$row31['cropname'];
	$variety1=$rowvv['popularname'];
	
	$sql_osrmain=mysqli_query($link,"select * from tbl_salesr where plantcode='$plantcode' AND salesr_id='".$row_arr_home2['salesr_id']."'") or die(mysqli_error($link));
	$row_osrmain=mysqli_fetch_array($sql_osrmain);
	
	$dtd=explode("-", $row_osrmain['salesr_date']);
	$trdate=$dtd[2]."-".$dtd[1]."-".$dtd[0];
 	
	$dtd2=explode("-", $row_arr_home2['salesrs_dot']);
	$dot=$dtd2[2]."-".$dtd2[1]."-".$dtd2[0];
	
	$slnob=$row_arr_home2['salesrs_nob']; 
	$slqty=$row_arr_home2['salesrs_qty'];
	
	$diq=explode(".",$slqty);
	if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}
	
	$din=explode(".",$slnob);
	if($din[1]==000){$difn=$din[0];}else{$difn=$slnob;}
	
	$slocs="";
	$sql_salesvr_subsub=mysqli_query($link,"select * from tbl_salesrsub_sub where plantcode='$plantcode' AND salesrs_id ='".$row_arr_home2['salesrs_id']."'") or die(mysqli_error($link));
	while($row_salesvr_subsub=mysqli_fetch_array($sql_salesvr_subsub))
	{
	
		$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_salesvr_subsub['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";
		
		$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";
		
		$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_salesvr_subsub['salesrss_subbin']."' and binid='".$row_salesvr_subsub['salesrss_bin']."' and whid='".$row_salesvr_subsub['salesrss_wh']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		$sln=$row_salesvr_subsub['salesrss_nob']; 
		$slq=$row_salesvr_subsub['salesrss_qty'];
		
		$sloc=$wareh.$binn.$subbinn."  ".$sln." | ".$slq;
		
		if($slocs!="")
		$slocs=$slocs."<br/>".$sloc;
		else
		$slocs=$sloc;
	}
	
	
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_oldlot']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_newlot']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_moist']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_gemp']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="66" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_oldlot']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_newlot']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_moist']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_arr_home2['salesrs_gemp']?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
          </table>			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_sropening.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
  <input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td ></td>
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
