<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
		
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	/*if(isset($_REQUEST['orgid']))
	{
	 $id = $_REQUEST['orgid'];
	}*/
		//$cid = $_REQUEST['txtclass'];
		$location = $_REQUEST['txtclass'];
		//$loc = $_REQUEST['txtloc'];
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant-Report -Organiser Wise Report</title>
<link href="../../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
var loc=document.frmaddDepartment.txtclass.value;
//var ite=document.frmaddDepartment.itemid.value;
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_organiser2.php?sdate='+sdate+'&txtclass='+loc+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../../include/arr_plant1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <?php
   //select DISTINCT lotorganiser from tbllotimp  order by lotimpid Asc"
$quer2=mysqli_query($link,"SELECT  organiser FROM tblarrival_sub where organiser='$loc' and plantcode='$plantcode'"); 
$row_dept=mysqli_fetch_array($quer2);	
		/*$sql_month=mysqli_query($link,"select * from tblmonth where month_act_id='$monthf'")or die("Error:".mysqli_error($link));
		$row_month=mysqli_fetch_array($sql_month);
		$a=$row_month['month_id'];
		//$month_year1=$row_month['month_year'];	
		
		
		$sql_month=mysqli_query($link,"select * from tblmonth where month_act_id='$montht'")or die("Error:".mysqli_error($link));
		$row_month=mysqli_fetch_array($sql_month);
		$b=$row_month['month_id'];*/
		//$month_year2=$row_month['month_year'];	
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Organiser Wise Arrivals Report </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	   <input name="txtclass" value="<?php echo $location;?>" type="hidden"> 
	    <input name="itemid" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	/*$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['itemid'];*/
	$loc = $_REQUEST['txtclass'];	
	
	$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
		
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where arrival_type='Fresh Seed with PDN' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 and plantcode='$plantcode' order by arrival_date asc ") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
	?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	
 <tr height="25" >
  
   <td align="left" class="subheading" style="color:#303918; ">Period From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td> 
   <td align="right" class="subheading" style="color:#303918; ">Organiser: <?php echo $location;?> </td>
  	</tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#2e81c1" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="18" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			<td width="59" align="center" valign="middle" class="tblheading" rowspan="2" >Date of Arrival </td>
			<td width="72"  align="center" valign="middle" class="tblheading" rowspan="2" >Crop</td>
			<td width="78" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
				<td width="45" align="center" valign="middle" class="tblheading" rowspan="2"> Stage</td>
				<td width="61" align="center" valign="middle" class="tblheading" rowspan="2">FRN No.</td>
			<td width="94"  align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
			<td width="47"  align="center" valign="middle" class="tblheading"rowspan="2" >NoB</td>
			<td width="50"  align="center" valign="middle" class="tblheading"rowspan="2" >Qty</td>
		 <td colspan="2" align="center" valign="middle" class="tblheading" >Preliminary QC</td>
			<!--<td width="90"  align="center" valign="middle" class="tblheading"rowspan="2" > Moisture % </td>-->
			<td width="56" align="center" valign="middle" class="tblheading" rowspan="2">GOT Status</td>
			<td width="62" rowspan="2" align="center" valign="middle" class="tblheading">Prod. Loc.</td>
				<td width="71" rowspan="2" align="center" valign="middle" class="tblheading">Prod. Personnel</td>
			<td width="93" align="center" valign="middle" class="tblheading"rowspan="2" >Farmer </td>
			  <td width="28" align="center" valign="middle" class="tblheading" rowspan="2">Plot No.</td>
         <!-- <td width="58" align="center" valign="middle" class="tblheading">Login</td>-->
</tr>
<tr class="tblsubtitle">
			  <td width="46" align="center" valign="middle" class="tblheading">PP</td>
			  <td width="36" align="center" valign="middle" class="tblheading">Moist %</td>
			  </tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	//echo $location;
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and organiser='$location' and plantcode='$plantcode'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	if($subtbltot > 0)
	{
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
	
	$per="";$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $moist=""; $org="";$org1="";$vchk=""; $loc="";$trdate1="";$vchk1="";
	
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	if($trdate1!="")
		{
		$trdate1=$trdate1."<br>".$trdate;
		}
		else
		{
		$trdate1=$trdate;
		}
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
		}
		if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$moist=$row_tbl_sub['moisture'];
		}
		if($org!="")
		{
		$org=$org."<br>".$row_tbl_sub['farmer'];
		}
		else
		{
		$org=$row_tbl_sub['farmer'];
		}
		if($org1!="")
		{
		$org1=$org1."<br>".$row_tbl_sub['plotno'];
		}
		else
		{
		$org1=$row_tbl_sub['plotno'];
		}
		
		if($row_tbl_sub['vchk'] =="Acceptable") { $vchk1="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $vchk1="NAcc";}
		
		if($vchk!="")
		{
		$vchk=$vchk."<br>".$vchk1;
		}
		else
		{
		$vchk=$vchk1;
		}
		
		if($loc!="")
		{
		$loc=$loc."<br>".$row_tbl_sub['ploc'];
		}
		else
		{
		$loc=$row_tbl_sub['ploc'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_tbl_sub['pper'];
		}
		else
		{
		$per=$row_tbl_sub['pper'];
		}
		$stnno="FRN"."/".$yearid_id."/".$row_tbl_sub['ncode'];
	
if($srno%2!=0)
{
?>			  

<tr class="Light" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $stnno;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
		    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $vchk;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $loc;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $org;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $org1;?></td>
           <!--/* <td align="center" valign="middle" class="tblheading"><?php echo $login;?></td>*/
</tr>-->
<?php
}
else
{
?>
<tr class="Dark" height="25">
<td align="center" valign="middle" class="smalltbltext"><?php echo $srno?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate1;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $stage;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $stnno;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
		    <td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $vchk;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $moist;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $loc;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $per;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $org;?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $org1;?></td>
		       <!-- <td align="center" valign="middle" class="tblheading"><?php echo $login;?></td>-->
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
else
{
?>
<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="16">Record not found</td>
</tr>
<?php
}
?>
</table>			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_organiser.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../../images/istratlogo.gif"  align="left"/><img src="../../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
