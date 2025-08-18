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
	
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	//$logid="OP1";
	//$lgnid="OP1";
	//$tp="Trading";	
	if(isset($_REQUEST['cropid']))
	{
   $pid = $_REQUEST['cropid'];
	}
/*		
	$sql_code="SELECT MAX(arr_code) FROM tblarrival where yearcode='$yearid_id'and arrival_type='Stocktransfer' ORDER BY arr_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
		}
		else
		{
			$code=1;
		}
		
		$sql_code1="SELECT MAX(ncode) FROM tblarrival where yearcode='$yearid_id' and arrival_type='Stocktransfer' ORDER BY ncode DESC";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
			{
				$row_code1=mysqli_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode=$t_code1+1;
				$ncode=sprintf("%004d",$ncode);
		}
		else
		{
			$ncode=sprintf("%004d",0001);
		}
		
	$sql_main="update tblarrival set arrtrflag=1, arr_code=$code, ncode='$ncode' where arrival_id = '$pid'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));

*/
	

	if(isset($_POST['frm_action'])=='submit')
	{
	
			/*$printopt=$_POST['fet1'];
		
			if($printopt == "1" )
			{
				echo "<script>window.location='STRN_note.php?p_id=$pid'</script>";	
			}
			else if($printopt =="2")
			{
				echo "<script>window.location='home_bincard_print.php?p_id=$pid&tp=Stocktransfer'</script>";	
			}
			else
			{
				echo "Please Select Output Type.";	
			}*/
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw - QC Sampling - Select output</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
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

<script language="JavaScript">
function mySubmit()
{ 
	if(document.frmaddDepartment.fet1.value == "")
{
alert("Please select Output Type");
return false;
}
	return true;	 
}
function test1(fet11)
{
if (fet11!="")
{
document.frmaddDepartment.fet1.value=fet11;
}
}	


function openslocpopprint()
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('grn.php?p_id='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

//}

function openslocpopprint1()
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('oltonln.php?p_id='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
//}


function openprintsubbin(subid, bid, wid, lid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

function openprintbin(bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('bin_sloc_details_print.php?bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); bin_sloc_details_print
}
</script>

<body>


<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
<!-- actual page start--->	
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction: QC sampling - Output Selection </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
   <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
 <br />
 <?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_psw_main where plantcode='$plantcode' and arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
 $arrival_id=$row_tbl['arrival_id'];
 
$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	

?> 
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr height="25">
  <td colspan="4" align="center" class="Mainheading">Transaction Outputs</td>
</tr>
</table>

<br />


<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
  <?php
 $tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_psw_main where plantcode='$plantcode' and arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_psw where plantcode='$plantcode' and arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	


 

	
?>
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">#</td>
	<td width="14%" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="14%" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="7%" align="center" valign="middle" class="tblheading">Lot No. </td>
	<td width="14%" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="14%" align="center" valign="middle" class="tblheading">NoMP</td>
    <td width="17%" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="15%" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="15%" align="center" valign="middle" class="tblheading">QC Test </td>
</tr>			  
  <?php
 
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);

 $totqty=0; $totnob=0; $totnomp=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; 	$sloc=""; 
	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and  lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
 $row_issue1[0];
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
$nop1=0;
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=($packtp[0]/1000);
}
else
{
	$ptp=$packtp[0];
}
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}

	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$nop1; 
	$totnomp=$totnomp+$row_issuetbl['balnomp']; 

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sups=$sups+$row_issuetbl['balnomp'];
 $sqty=$sqty+$row_issuetbl['balqty'];

if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$nop1." | ".$sups." | ".$sqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$nop1." | ".$sups." | ".$sqty."<br/>";$tp1=12;

}


}
		
	 $pp="";
	 if($row_tbl_sub['pp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['pp'];
}
else
{
$pp=$row_tbl_sub['pp'];
}
}
if($row_tbl_sub['gemp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['gemp'];
}
else
{
$pp=$row_tbl_sub['gemp'];
}
}
if($row_tbl_sub['got']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['got'];
}
else
{
$pp=$row_tbl_sub['got'];
}
}
if($row_tbl_sub['moist']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['moist'];
}
else
{
$pp=$row_tbl_sub['moist'];
}
}	

?>
  <tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $vv;?></td>
	<td width="105" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	<!--<td align="center" valign="middle" class="tblheading"><?php echo $upssize?></td>-->
	<td align="center" valign="middle" class="tblheading"><?php echo $totnob?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnomp?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="227" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
	
        </tr>
  <?php
}


else
{
?>
   <tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $vv;?></td>
	<td width="105" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	<!--<td align="center" valign="middle" class="tblheading"><?php echo $upssize?></td>-->
	<td align="center" valign="middle" class="tblheading"><?php echo $totnob?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnomp?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	<td width="227" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
	
        </tr>
  <?php
}
$srno++;
}
}

?>
</table>
<table align="center" width="314" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_qc.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;&nbsp;</td>	
</tr>
</table>
</form></td><td width="30"></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table><!-- actual page end--->			  
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
