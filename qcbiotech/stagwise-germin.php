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
	
		
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
		$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['txtitem'];
		if(isset($_POST['frm_action'])=='submit')
		{
		 /*$dept=trim($_POST['department']);
		$monthf=trim($_POST['monthf']);
		$montht=trim($_POST['montht']);
		
		echo "<script>window.location='deptcomposite1.php?dept=$dept&monthf=$monthf&montht=$montht'</script>";	*/
		}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Report - Discard Report</title><link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
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
var cls=document.frmaddDepartment.txtclass.value;
var ite=document.frmaddDepartment.txtitem.value;
var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_discard.php?sdate='+sdate+'&txtclss='+cls+'&txtitem='+ite+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
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
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <?php
/*$quer2=mysqli_query($link,"SELECT DISTINCT dept_name,dept_id FROM tbldept where dept_id='$dept'"); 
$row_dept=mysqli_fetch_array($quer2);
	
		$sql_month=mysqli_query($link,"select * from tblmonth where month_act_id='$monthf'")or die("Error:".mysqli_error($link));
		$row_month=mysqli_fetch_array($sql_month);
		$a=$row_month['month_id'];
		//$month_year1=$row_month['month_year'];	
		
		
		$sql_month=mysqli_query($link,"select * from tblmonth where month_act_id='$montht'")or die("Error:".mysqli_error($link));
		$row_month=mysqli_fetch_array($sql_month);
		$b=$row_month['month_id'];
		//$month_year2=$row_month['month_year'];	*/
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25">Stage Wise Test Germination Sheet </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	   <input name="txtclass" value="<?php echo $cid;?>" type="hidden"> 
	    <input name="txtitem" value="<?php echo $itemid;?>" type="hidden">  
		 <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['txtitem'];
	$mtype = $_REQUEST['ret'];
	$sloc = $_REQUEST['chk'];
	
	
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
	 	 
	 if($_GET['txtclass'] != 'ALL')
	 {
	$ss = "select classification from tbl_classification where classification_id=".$_GET['txtclass'];
	 		$rr = mysqli_query($link,$ss) or die(mysqli_error($link));	 
			$ros = mysqli_fetch_array($rr);
			$cls = $ros['classification'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }





//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblempclaims  where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month between $monthf and $montht group by dept_id"),0); 
 	 
	 $sql = "select * from tbl_stldg_damage where stld_trdate <= '$edate' and stld_trdate >= '$sdate' and stld_trtype ='Discard' and stld_trsubtype ='MD' ";
	/* $sql = "select * from tbl_stldg_damage where stld_trdate <= '2009-08-29' and stld_trdate >= '2009-04-01' and stld_trtype ='Discard' and stld_trsubtype ='DD' and stld_trclassid =91 and stld_tritemid =7 order by stld_trdate DESC";*/
	if(!is_numeric($cid))
	 {
	 $sql.="";
	 }
	 else
	 {
	 $sql.=" and stld_trclassid =".$cid;
	 }
	 
	 if(!is_numeric($itemid))
	 {
	 $sql.="";
	 }
	 else
	 {
	 $sql.=" and stld_tritemid =".$itemid;
	 }
	 	 
	 $sql.=" order by stld_trdate DESC";
//echo $sql;
	 $rs = mysqli_query($link,$sql) or die(mysqli_error($link));	  
	 //echo $t=mysqli_num_rows($rs);	  
	 ?>
	  
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Stage WiseTest Germination Sheet </td>
  </tr>
   </table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#d21704" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td align="center" valign="middle" class="tblheading" colspan="5"> Arrival </td>
			<td align="center" valign="middle" class="tblheading" colspan="5">Processing</td>
			<td align="center" valign="middle" class="tblheading" colspan="5">Packing</td>
			<td width="50" colspan="1" align="center" valign="middle" class="tblheading"> S </td>
			<td width="38" colspan="1" align="center" valign="middle" class="tblheading">R</td>
			<td width="74" colspan="1" align="center" valign="middle" class="tblheading">S</td>
			<td width="74" colspan="1" align="center" valign="middle" class="tblheading">T</td>
			</tr>
<?php 
$srno=1;
while($row=mysqli_fetch_array($rs))
	{
	$id=$row['stld_trid'];
	$itemid=$row['stld_tritemid'];
	$cls=$row['stld_trclassid'];
	$stlg_trdate=$row['stld_trdate'];
	$stlg_trups=$row['stld_trups'];
	$stlg_trqty=$row['stld_trqty'];
	$stld_trpartyid=$row['stld_trpartyid'];
	
	
			$s = "select stores_item,uom from tbl_stores where items_id='".$itemid."'";
	 		$r = mysqli_query($link,$s) or die(mysqli_error($link));	 
			$ro = mysqli_fetch_array($r);
			$stores_item = $ro['stores_item'];
			$uom = $ro['uom'];
			
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
		
		
		$quer3=mysqli_query($link,"SELECT * FROM tbl_discard where tid='".$id."'"); 
 		$noticia = mysqli_fetch_array($quer3);
 		$p_name=$noticia['party_name'];
 		


if ($srno%2 != 0)
	{	

?>

<tr class="Light" height="25">
			<td width="74" align="center" valign="middle" class="tblheading">G</td>
			<td width="74" align="center" valign="middle" class="tblheading">GOT</td>
			<td width="74" align="center" valign="middle" class="tblheading">M</td>
			
			<td width="38" align="center" valign="middle" class="tblheading">PP</td>
			<td width="38" align="center" valign="middle" class="tblheading">DNA</td>
			<td width="38" align="center" valign="middle" class="tblheading">G</td>
			<td width="53" align="center" valign="middle" class="tblheading">GOT</td>
			<td width="27" align="center" valign="middle" class="tblheading">M</td>
			<td width="62" align="center" valign="middle" class="tblheading">PP</td>
			<td width="62" align="center" valign="middle" class="tblheading">DNA</td>
			<td width="54" align="center" valign="middle" class="tblheading">G</td>
			<td width="31" align="center" valign="middle" class="tblheading">GOT</td>
			<td width="21" align="center" valign="middle" class="tblheading">M</td>
			<td width="42" align="center" valign="middle" class="tblheading">PP</td>
			<td width="42" align="center" valign="middle" class="tblheading">DNA</td>
			<td width="42" align="center" valign="middle" class="tblheading">G</td>
			<td align="center" valign="middle" class="tblheading">GOt</td>
			<td align="center" valign="middle" class="tblheading">M</td>
			<td align="center" valign="middle" class="tblheading">PP</td>
						</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $p_name;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trups;?></td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
				</tr>
<?php
}

$srno=$srno+1;
 }
?>
</table>			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="discardreport.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
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
