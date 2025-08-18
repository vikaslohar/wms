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
	
	$cid = $_REQUEST['txtcrop'];
	$itemid = $_REQUEST['txtvariety'];	
    $sdate=date("d-m-Y");
	
		if(isset($_POST['frm_action'])=='submit')
		{
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality-Report -Under Got report</title>
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

var txtcrop=document.frmaddDepartment.txtcrop.value; 
var txtvariety=document.frmaddDepartment.txtvariety.value; 
//var cid=document.frmaddDepartment.itemid.value;
//alert(ite)
//var ite=document.frmaddDepartment.txtitem.value;
winHandle=window.open('report_got2.php?txtcrop='+txtcrop+'&txtvariety='+txtvariety,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>
<body>
<table width="1003" height="750" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Report - Pending GOT Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txtcrop" value="<?php echo $cid;?>" type="hidden"> 
	 <input name="txtvariety" value="<?php echo $itemid;?>" type="hidden"> 
	 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
$sql="select distinct sampleno from tbl_qctest where gotflg=0 and (got='UT' or got='RT') and plantcode='$plantcode'";
if($cid!="ALL")
{	
$sql.=" and crop='".$cid."'";
}
if($itemid!="ALL")
{	
$sql.=" and variety='".$itemid."'";
}
$sql.=" order by dosdate asc, oldlot asc ";
//echo $sql;
$sql_arr_home=mysqli_query($link,$sql) or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

if($cid!="ALL")
{	
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$cid."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$crop=$row_class['cropname'];	
}
else
{
	$crop=$cid;	
}
		
	if($itemid!="ALL")
	{
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$itemid'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$tot_var=mysqli_num_rows($quer4);
		if($tot_var > 0)
		{	
			$variet=$row_dept4['popularname'];
		}
		else 
		{
			$variet=$itemid;
		} 
	}
	else
	{
		$variet="ALL";
	}
?>
	 	 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918;" colspan="2">As on Date: <?php echo date("d-m-Y");?> </td>
  	</tr>
  <tr height="25" >
    <td align="left" class="subheading" style="color:#303918;" width="50%">&nbsp;&nbsp;Crop: <?php echo $crop;?></td>
	 <td align="right" class="subheading" style="color:#303918;">Variety: <?php echo $variet;?>&nbsp;&nbsp;</td>
  	</tr>
	
</table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="21" align="center" valign="middle" class="tblheading">#</td>
			<td width="97"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="182"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="135"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="57"  align="center" valign="middle" class="tblheading">NoB</td>
			<td width="63"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="70"  align="center" valign="middle" class="tblheading">DOSR</td>
			<td width="72"  align="center" valign="middle" class="tblheading">DOSC</td>
			<td width="77" align="center" valign="middle" class="tblheading">DOSD</td>
			<td width="66" align="center" valign="middle" class="tblheading" >Location</td>
			<td width="57" align="center" valign="middle" class="tblheading" >Mode</td>
            </tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{
$sqlmax2="select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and plantcode='$plantcode'";
if($cid!="ALL")
{
$sqlmax2.=" and crop='".$cid."'";
}
if($itemid!="ALL")
{	
$sqlmax2.=" and variety='".$itemid."'";
}
$sql_max2=mysqli_query($link,$sqlmax2) or die(mysqli_error($link));
$tot_max2=mysqli_num_rows($sql_max2);
while($row_arr_home3=mysqli_fetch_array($sql_max2))
{
$sql_max=mysqli_query($link,"select * from tbl_qctest where tid='".$row_arr_home3[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_max=mysqli_num_rows($sql_max);
while($row_arr_home=mysqli_fetch_array($sql_max))
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
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	
	$sql_tbl_sub1=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_variety, lotldg_crop, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row_arr_home['lotno']."' and plantcode='$plantcode' group by lotldg_subbinid, lotldg_variety, lotldg_lotno order by lotldg_subbinid") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl_sub1);
	$T=mysqli_num_rows($sql_tbl_sub1);
	
	$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and lotldg_lotno='".$row_arr_home['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
$slups=0; $slqty=0; $sstage="";
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$slups=$slups+$row_tbl_sub['lotldg_balbags'];
$slqty=$slqty+$row_tbl_sub['lotldg_balqty'];
$sstage=$row_tbl_sub['lotldg_sstage'];
}
//echo $slups;
$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}

$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per=""; $qcresult="";

$sql_dtchk=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=1 and plantcode='$plantcode' order by arrival_id asc") or die(mysqli_error($link));
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
				}
			}	
		}
	}		
		if($qcresult!="")
		{
		$qcresult=$qcresult."<br>".$row_arr_home['qcstatus'];
		// $row_tbl_sub['lotcrop'];
		}
		else
		{
		 $qcresult=$row_arr_home['qcstatus'];
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['oldlot'];
		}
		else
		{
		$lotno=$row_arr_home['oldlot'];
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
		$qc=$qc."<br>".$row_arr_home['pp'];
		}
		else
		{
		$qc=$row_arr_home['pp'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_arr_home['moist'];
		}
		else
		{
		$got=$row_arr_home['moist'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['gemp'];
		}
		else
		{
		$stage=$row_arr_home['gemp'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_arr_home['pper'];
		}
		else
		{
		$per=$row_arr_home['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['ploc'];
		}
		else
		{
		$loc1=$row_arr_home['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_arr_home['sstatus'];
		}
		else
		{
		$sstatus=$row_arr_home['sstatus'];
		}
	
	
	
	//$lrole=$row_arr_home['arr_role'];
	/*$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	*/
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['variety']."'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$tot_var=mysqli_num_rows($quer4);
		if($tot_var > 0)
		{	
			$variety=$row_dept4['popularname'];
		}
		else 
		{
			$variety=$row_arr_home['variety'];
		} 
	if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="97" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="182" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		 <td width="135" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="63" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
          <td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
         <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $address?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $tmode;?></td>
         </tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
		 <td width="97" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="182" align="center" valign="middle" class="tblheading"><?php echo $variety?></td>
		 <td width="135" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="63" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
          <td width="70" align="center" valign="middle" class="tblheading"><?php echo $trdate?></td>
         <td width="72" align="center" valign="middle" class="tblheading"><?php echo $trdate1?></td>
         <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate2;?></td>
         <td width="66" align="center" valign="middle" class="tblheading"><?php echo $address?></td>
         <td width="57" align="center" valign="middle" class="tblheading"><?php echo $tmode;?></td>
         </tr
>
<?php
}
$srno=$srno+1;
}
}
}
}
?>
</table>			
<table width="750" align="center" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="report_got.php"><img src="../../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<img src="../../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />
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
