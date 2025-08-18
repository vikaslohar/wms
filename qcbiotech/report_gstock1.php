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
	$rettyp = $_REQUEST['rettyp'];	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	
		if(isset($_POST['frm_action'])=='submit')
		{
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality-Report -Under GOT report</title>
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
var crop=document.frmaddDepartment.crop.value; 
var variety=document.frmaddDepartment.variety.value; 
var sdate=document.frmaddDepartment.sdate.value; 
var edate=document.frmaddDepartment.edate.value; 
var rettyp=document.frmaddDepartment.rettyp.value; 
winHandle=window.open('report_gstock2.php?txtcrop='+crop+'&txtvariety='+variety+'&sdate='+sdate+'&edate='+edate+'&rettyp='+rettyp,'WelCome','top=20,left=80,width=780,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/qty_gotbio.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">&nbsp;Guard Sample Stock  Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		 <input name="crop" value="<?php echo $crop;?>" type="hidden"> 
	 	 <input name="variety" value="<?php echo $variety;?>" type="hidden"> 
		 <input name="sdate" value="<?php echo $_REQUEST['sdate'];?>" type="hidden"> 
	 	 <input name="edate" value="<?php echo $_REQUEST['edate'];?>" type="hidden"> 
		 <input name="rettyp" value="<?php echo $_REQUEST['rettyp'];?>" type="hidden">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$rettyp = $_REQUEST['rettyp'];	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	
	$sdt1=split("-",$sdate);
	$sdt2=split("-",$edate);
	$sdate=$sdt1[2]."-".$sdt1[1]."-".$sdt1[0];
	$edate=$sdt2[2]."-".$sdt2[1]."-".$sdt2[0];
//echo $rettyp;
	
	
$ver="ALL";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	if($variety!="ALL")
	{	
		$ver=$variety;
	}
	
if($rettyp=="periodical")
{
	if($variety!="ALL")
	{
		$qry="select * from tbl_gsample where gsdate>='$sdate' and gsdate<='$edate' and  gscrop='$crp' and gsvariety='$ver' and gsdisflg=0 order by gsdate asc ";
	}
	else 
	{
		$qry="select * from tbl_gsample where gsdate>='$sdate' and gsdate<='$edate' and  gscrop='$crp' and gsdisflg=0 order by gsdate asc ";
	}
}
else
{
	if($variety!="ALL")
	{
		$qry="select * from tbl_gsample where gsdate<='$sdate' and  gscrop='$crp' and gsvariety='$ver' and gsdisflg=0 order by gsdate asc ";
	}
	else 
	{
		$qry="select * from tbl_gsample where gsdate<='$sdate' and  gscrop='$crp' and gsdisflg=0 order by gsdate asc ";
	}
}
//echo $qry;
		$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) {
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
<?php 
if($rettyp=="periodical")
{
?>
<tr height="25">
    <td align="center" class="subheading" style="color:#303918;" colspan="2">Periodical Crop Variety wise</td>
</tr>
<tr height="25">	
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Period From:: <?php echo $_REQUEST['sdate'];?>&nbsp;&nbsp;To: <?php echo $_REQUEST['edate'];?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
    <td align="center" class="subheading" style="color:#303918;" colspan="2">As on Date Crop Variety wise</td>
</tr>
<tr height="25">	
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Date: <?php echo $_REQUEST['sdate'];?></td>
</tr>
<?php
}
?>
  	<tr height="25">
    <td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;&nbsp;</td>
  	</tr>
	
</table>
    <?php
 //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);  
?>
    <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="3%"align="center" valign="middle" class="tblheading">#</td>
			   <td width="14%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="17%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Lot No.</td>
			   <td width="7%" align="center" valign="middle" class="tblheading">SLOC</td>
			   <td width="10%" align="center" valign="middle" class="tblheading">DOA</td>
               <td width="10%" align="center" valign="middle" class="tblheading">GSRP</td>
               <td width="10%" align="center" valign="middle" class="tblheading">GSRP Mat. Date</td>
            </tr>
<?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['gsdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
$arrival_id=$row_arr_home['gsid'];
	$qc1=$row_arr_home['sampleno'];

	
		$lotno=$row_arr_home['lotno'];
	
	$quer333=mysqli_query($link,"SELECT * FROM tblvariety where popularname ='".$row_arr_home['gsvariety']."' "); 
	$row333=mysqli_fetch_array($quer333);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer333);	
	 if($tot > 0)
	 {
	 $vv=$row333['gsdis'];
	 }
	 else
	 {
	  $vv=0;
	  }
	 $tt=$row_arr_home['gsvariety'];

$wh=""; $binn=""; $slocs="";
$wh1=$row_arr_home['gswh']."/";
$binn1=$row_arr_home['gsbin'];

$quer3=mysqli_query($link,"SELECT * FROM tblbin  where binid='".$binn1."'"); 
	$row31=mysqli_fetch_array($quer3);
	  $binn=$row31['binname'];
	
	$quer4=mysqli_query($link,"SELECT * from tblwarehouse where whid ='".$wh1."'"); 
	$row=mysqli_fetch_array($quer4);
	  $wh=$row['perticulars']."/";
$slocs=$wh.$binn."<br/>";

if($vv!=0)
{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt=$vv;
		
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y)); }
		
	
	$trdate1=$dt1;
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
}
else
{
$vv="";
$trdate1="";
}		
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="105" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="105" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found</td></tr>
 </table>       
<?php
}
?>
  
			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_gstock.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
