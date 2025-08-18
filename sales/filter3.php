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

	date_default_timezone_set('Asia/Calcutta');
	//echo date("d-m-Y h:i:s A");
	if(isset($_REQUEST['txtcrop']))
	{
		$txtcrop = $_REQUEST['txtcrop'];	 
	}
	if(isset($_REQUEST['txtvariety']))
	{
		$txtvariety = $_REQUEST['txtvariety'];	 
	}
	if(isset($_REQUEST['txtqcsts']))
	{
		$txtqcsts = $_REQUEST['txtqcsts'];	 
	}
	if(isset($_REQUEST['txtupsdc']))
	{
		$txtupsdc = $_REQUEST['txtupsdc'];	 
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		echo "<script>window.location='home_revalidate.php'</script>";
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging -Transaction - Pack Seed Re-Printing - Home</title>
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

/*function openslocpopprint(tid)
{
winHandle=window.open('fpdngrn.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}*/
function openpackdetails(tid)
{
winHandle=window.open('packdetails_home.php?itmid='+tid,'WelCome','top=170,left=180,width=920,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

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
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/sales_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">


		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" style="border-bottom:solid; border-bottom-color:#a8a09e" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - Pack Seed Re-Printing</td>
	    </tr></table></td>
	   
	  </tr>
	  </table></td></tr>
      <td align="center" colspan="4" >
	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="10">	 </td><td>

<?php
		$txtcrop = $_REQUEST['txtcrop'];	 
		$txtvariety = $_REQUEST['txtvariety'];	 
		$txtqcsts = $_REQUEST['txtqcsts'];	 
		$txtupsdc = $_REQUEST['txtupsdc'];	 

$sq="select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_rettype='P2P' and salesrs_qc!='Fail' and salesrs_rvflg=0 and salesrs_crop='$txtcrop' and salesrs_variety='$txtvariety' ";

if($txtupsdc!="ALL")
$sq.=" and salesrs_ups='$txtupsdc' ";

if($txtqcsts!="ALL")
$sq.=" and salesrs_qc='$txtqcsts' ";

$sq.=" order by salesrs_dovfy";		
$sql_arr_home=mysqli_query($link,$sq) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$txtvariety."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$crop=$noticia['cropname'];
$variety=$noticia_item['popularname'];	
?>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="8" align="center" class="tblheading">Pack Seed Re-Printing - Pending List</td>
</tr>
<tr class="Light" height="20">
  <td width="60" align="right" class="smalltblheading">Crop:</td>
  <td width="115" align="left" class="smalltbltext">&nbsp;<?php echo $crop ?></td>
  <td width="70" align="right" class="smalltblheading">Variety:</td>
  <td width="209" align="left" class="smalltbltext">&nbsp;<?php echo $variety ?></td>
  <td width="72" align="right" class="smalltblheading">UPS:</td>
  <td width="109" align="left" class="smalltbltext">&nbsp;<?php echo $txtupsdc ?></td>
  <td width="110" align="right" class="smalltblheading">QC Status:</td>
  <td width="105" align="left" class="smalltbltext">&nbsp;<?php echo $txtqcsts ?></td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="19" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="64" align="center" valign="middle" class="smalltblheading">DoSRV</td>
	<td width="93" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="115" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="115" align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td width="80" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">NoP</td>
	<td width="65" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">QC Status</td>
	<td width="88" align="center" valign="middle" class="smalltblheading">DoT</td>
	<td width="175" align="center" valign="middle" class="smalltblheading">SLOC</td>
	<td width="80" align="center" valign="middle" class="smalltblheading">Re-Validate</td>
</tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_tbl_sub['salesrs_dovfy'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_tbl_sub['salesr_logid'];
	$arrival_id=$row_tbl_sub['salesrs_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=0; $got=""; $qc=""; $phsrn=""; $nlotno=""; $ups="";
	/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where salesr_id='".$arrival_id."' and salesrs_rettype='P2P'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))*/
	{
		$slups=0; $slqty=0;
		
		$slups=$row_tbl_sub['salesrs_nob']; 
		$slqty=$row_tbl_sub['salesrs_qty'];
		
		$aq=explode(".",$slqty);
		if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}
		
		$an=explode(".",$slups);
		if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}
		
		$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
		$noticia = mysqli_fetch_array($quer3);
		
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
		$noticia_item = mysqli_fetch_array($quer4);
		
		$crop=$noticia['cropname'];
		$variety=$noticia_item['popularname'];	
		$ups=$row_tbl_sub['salesrs_ups'];	
		
		$lotno=$row_tbl_sub['salesrs_newlot'];	

$sql_arrival=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$arrival_id."'") or die(mysqli_error($link));
$row_arrival=mysqli_fetch_array($sql_arrival);

$dot="";
if($row_arrival['salesrs_dot']!="")
{
$dt=explode("-",$row_arrival['salesrs_dot']);
$dot=$dt[2]."-".$dt[1]."-".$dt[0];
}
if($dot=="00-00-0000" || $dot=="--")$dot="";
$dgt=explode("-",$row_arrival['salesrs_dogt']);
$dogt=$dgt[2]."-".$dgt[1]."-".$dgt[0];
$got=$row_arrival['salesrs_got']." ".$row_arrival['salesrs_got1'];
$qc=$row_arrival['salesrs_qc'];
//echo $row_arrival['salesrs_typ'];




$nop="";$qty=""; $wareh=""; $binn=""; $subbinn=""; $sloc=""; 

$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
$tot1=mysqli_num_rows($sq1);
if($tot1 > 0)
{
	$row1=mysqli_fetch_array($sq1);
	$nop=$row1['salesrss_nob'];
	$qty=$row1['salesrss_qty'];
	
	$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row1['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars'];
		
	$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row1['salesrss_bin']."' and whid='".$row1['salesrss_wh']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
		
	$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row1['salesrss_subbin']."' and binid='".$row1['salesrss_bin']."' and whid='".$row1['salesrss_wh']."'") or die(mysqli_error($link));
	$row_subbinn=mysqli_fetch_array($sql_subbinn);
	$subbinn=$row_subbinn['sname'];


}
else if($row_arrival['salesrs_typ']=="vernew")
{
	$sq1=mysqli_query($link,"Select * from tbl_salesrvsub_sub2 where plantcode='$plantcode' AND salesrs_id='".$row_arrival['salesrs_id']."'") or die(mysqli_error($link));
	$tot1=mysqli_num_rows($sq1);
	if($tot1 > 0)
	{
		$row1=mysqli_fetch_array($sq1);
		$nop=$row1['salesrss_nob'];
		$qty=$row1['salesrss_qty'];
		
		$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row1['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars'];
			
		$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row1['salesrss_bin']."' and whid='".$row1['salesrss_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname'];
			
		$sql_subbinn=mysqli_query($link,"select sname from tblsrsubbin where plantcode='$plantcode' AND sid='".$row1['salesrss_subbin']."' and binid='".$row1['salesrss_bin']."' and whid='".$row1['salesrss_wh']."'") or die(mysqli_error($link));
		$row_subbinn=mysqli_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
	}
	else
	{
		$nop=$row_arrival['salesrs_nobdc'];
		$qty=$row_arrival['salesrs_qtydc'];
		
		$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_arrival['salesrs_wh']."' order by perticulars") or die(mysqli_error($link));
		$row_whouse=mysqli_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars'];
			
		$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_arrival['salesrs_bin']."' and whid='".$row_arrival['salesrs_wh']."'") or die(mysqli_error($link));
		$row_binn=mysqli_fetch_array($sql_binn);
		$binn=$row_binn['binname'];
		$subbinn="";
	}
}
else
{
	$nop=$row_arrival['salesrs_nobdc'];
	$qty=$row_arrival['salesrs_qtydc'];
	
	$sql_whouse=mysqli_query($link,"select perticulars from tblsrwarehouse where plantcode='$plantcode' AND whid='".$row_arrival['salesrs_wh']."' order by perticulars") or die(mysqli_error($link));
	$row_whouse=mysqli_fetch_array($sql_whouse);
	$wareh=$row_whouse['perticulars'];
			
	$sql_binn=mysqli_query($link,"select binname from tblsrbin where plantcode='$plantcode' AND binid='".$row_arrival['salesrs_bin']."' and whid='".$row_arrival['salesrs_wh']."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
	$subbinn="";
}

$aq=explode(".",$nop);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$nop;}
		
$an=explode(".",$qty);
if($an[1]==000){$acn=$an[0];}else{$acn=$qty;}
		
$bags=$ac;
$qty=$acn;


if($sloc!="")
	$sloc=$sloc."<br />".$wareh."/".$binn."/".$subbinn." | ".$bags." | ".$qty;
else
	$sloc=$wareh."/".$binn."/".$subbinn." | ".$bags." | ".$qty;
if($qc=="UT" || $qc=="RT")$dot="";	
if($qty > 0)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php if($qc=="OK") { ?><a href="add_srrevalidate.php?pid=<?php echo $arrival_id?>">Re-Validate</a><?php } else {?>Re-Validate<?php } ?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $ups;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qc;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $dot; ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php if($qc=="OK") { ?><a href="add_srrevalidate.php?pid=<?php echo $arrival_id?>">Re-Validate</a><?php } else {?>Re-Validate<?php } ?></td>
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
<tr  height="25"><td colspan="10" align="center" class="subheading">No Records found.</td></tr>
<?php
}
?>
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="filter1.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
</table>

</td>
<td width="10"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
		  
		  
<!-- actual page end  -->	
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
