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
	
	$eurl = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

//	$sql_tbl=mysqli_query($link,"select * from tbl_qctest where aflg=0") or die(mysqli_error($link));
//while($row_tbl=mysqli_fetch_array($sql_tbl))
//{
//	$arrival_id=$row_tbl['tid'];	
//}
//            
	             $reptyp=trim($_REQUEST['reptyp']);
				 $txt=trim($_REQUEST['txt']);
				 $txtlot=trim($_REQUEST['txtlot']);
				echo $txtlo=trim($_REQUEST['txtlo']);
				 $txtlot1=trim($_REQUEST['txtlot1']);
				 $txtlot2=trim($_REQUEST['txtlot2']);
			     //$txtlot3=trim($_REQUEST['txtlot3']);
				 $pcode=trim($_REQUEST['pcode']);
				 $txtcrop=trim($_REQUEST['txtcrop']);
				 $txtvariety=trim($_REQUEST['txtvariety']);
				 //$txtstage=trim($_REQUEST['txtstage']);
				 $stcode=trim($_REQUEST['stcode']);
			     $ycode=trim($_REQUEST['ycodee']);
				 $txtlot4=trim($_REQUEST['txtlot4']);
				 $stcode2=trim($_REQUEST['stcode2']);
				 
	$lotno=$pcode.$ycode.$txtlot2."/".$stcode."/".$stcode2;	

	if(isset($_POST['frm_action'])=='submit')
	{
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GOT- Transaction -Sampling</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="samp.js"></script>
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

/*function openslocpopprint1(tid)
{
winHandle=window.open('getuser_status1.php?tid='+tid,'WelCome','top=170,left=180,width=520,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}*/


function openslocpopprint(tid)
{
winHandle=window.open('getuser_got1.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
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
function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_got.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - GOT Result update</td>
	    </tr></table></td>
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
		
	 $sampl=$txtlo;  
if($reptyp=="lotno")
{ 
 $sql_arr_home=mysqli_query($link,"select * from tbl_gottest where  gottest_oldlot='$lotno' and gottest_gotflg=0 and gottest_gotsampdflg=1 and (gottest_got='UT' or gottest_got='RT') group by gottest_lotno,gottest_spdate order by gottest_tid asc, gottest_spdate ASC") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
}
else if($reptyp=="sno")
{ 
	$sql_arr_home=mysqli_query($link,"select * from tbl_gottest where gottest_sampleno='".$sampl."' and gottest_gotflg=0 and gottest_gotsampdflg=1 and (gottest_got='UT' or gottest_got='RT') group by gottest_lotno,gottest_spdate order by gottest_tid asc, gottest_spdate ASC") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);
}
else 
{
$sql_arr_home=mysqli_query($link,"select * from tbl_gottest where gottest_crop='".$txtcrop."' and gottest_variety='".$txtvariety."' and  gottest_gotflg=0 and gottest_gotsampdflg=1 and (gottest_got='UT' or gottest_got='RT') group by gottest_lotno,gottest_spdate order by gottest_tid asc, gottest_spdate ASC") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
}
if($tot_arr_home >0) {  
?>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="2" align="center" class="tblheading">GOT Search Pending  List </td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

           <tr class="tblsubtitle" height="20">
				<td width="22"align="center" valign="middle" class="tblheading">#</td>
				<!--	   <td width="89" align="center" valign="middle" class="tblheading">DOSR</td>-->
				<td width="126" align="center" valign="middle" class="tblheading">Crop</td>
				<td width="155" align="center" valign="middle" class="tblheading">Variety</td>
				<td width="110" align="center" valign="middle" class="tblheading">Lot No.</td>
				<td width="43" align="center" valign="middle" class="tblheading">Stage</td>
				<td width="51" align="center" valign="middle" class="tblheading">QC Status</td>
				<td width="77" align="center" valign="middle" class="tblheading">DOSR</td>
				<td width="77" align="center" valign="middle" class="tblheading">DOSC</td>
				<td width="70" align="center" valign="middle" class="tblheading">DOSD</td>
				<td width="70" align="center" valign="middle" class="tblheading">GOT Status</td>
				<td align="center" valign="middle" class="tblheading">Sample No. </td>
				<td width="63" align="center" valign="middle" class="tblheading">GOT Data</td>
				<td width="71" align="center" valign="middle" class="tblheading">GOT Result</td>
				<td width="67" align="center" valign="middle" class="tblheading">Progress Status</td>
              </tr>
<?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$lrole=$row_arr_home['gottest_arrrole'];
	$arrival_id=$row_arr_home['gottest_tid'];
	$qc1=$row_arr_home['gottest_sampleno'];
	$yriid=$row_arr_home['gottest_yearid'];
	
	
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	
$got=$row_arr_home['gottest_gotstatus'];
if($got=="") $got="UT";
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['gottest_crop'];
		}
		else
		{
		$crop=$row_arr_home['gottest_crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['gottest_variety'];
		}
		else
		{
		$variety=$row_arr_home['gottest_variety'];	
		}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['gottest_lotno'];
		}
		else
		{
		$lotno=$row_arr_home['gottest_lotno'];
		}
	
	
	$trdate=$row_arr_home['gottest_srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$tdate1=$row_arr_home['gottest_spdate'];
	$tyear=substr($tdate1,0,4);
	$tmonth=substr($tdate1,5,2);
	$tday=substr($tdate1,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	
		
	$tdatee=$row_arr_home['gottest_dosdate'];
	$tyear=substr($tdatee,0,4);
	$tmonth=substr($tdatee,5,2);
	$tday=substr($tdatee,8,2);
	$tdatee=$tday."-".$tmonth."-".$tyear; 
	
	$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	
$tot=0;
	$quer3=mysqli_query($link,"SELECT * from tblvariety where varietyid ='".$row_arr_home['gottest_variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0 )
	 {
	 $vv=$row_arr_home['gottest_variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	  //echo "SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'";
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);


	  //$pp=$row_tbl_sub1['state'];	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot1=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
 $pp=$row_tbl['lotldg_qc'];	
 
$aq=explode(".",$row_tbl['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
$gg=explode(" ", $row_tbl['lotldg_got1']);
$got22=$row_arr_home['gotstatus'];
if($got22=="") $got22="UT";
$got=$gg[0]." ".$got22;

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
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
$vart=$row31['cropname']."-"."Coded";
$vart1=$row31['cropname']."-"."Unidentified";
$trid=$row_arr_home['gottest_tid'];
$sampno=$tp1.$row_arr_home['gottest_yearid'].sprintf("%000006d",$qc1);

$resflg=0; $resflg1=0; $insituflg=0; $interraflg=0;

$sql_resflg=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$trid."' order by gottests_id asc") or die(mysqli_error($link));
while($row_resflg=mysqli_fetch_array($sql_resflg))
{
	if($row_resflg['gottests_type']=="IN-SITU")
	{
		$insituflg++;
	}
	if($row_result['gottests_type']=="IN-TERRA")
	{
		$interraflg++;
	}
}
//echo "select * from tbl_gottestsub where gottest_tid='".$trid."' order by gottests_id asc";
$sql_result=mysqli_query($link,"select * from tbl_gottestsub where gottest_tid='".$trid."' order by gottests_id asc") or die(mysqli_error($link));
$tot_result=mysqli_num_rows($sql_result);
while($row_result=mysqli_fetch_array($sql_result))
{
	if($row_result['gottests_type']=="IN-SITU")
	{
	//echo "select * from tbl_gottestsub_sub where gottests_id='".$row_result['gottests_id']."' order by gottests_id asc";
		$sql_results=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$row_result['gottests_id']."' order by gottests_id asc") or die(mysqli_error($link));
		while($row_results=mysqli_fetch_array($sql_results))
		{
			if($row_results['gottestss_completeflg']==0 && $row_results['gottestss_abortflg']==0) 
			{
					$resflg1++;
			}
		}
	}
	if($insituflg==0)
	{
		if($row_result['gottests_type']=="IN-TERRA")
		{
		//echo "select * from tbl_gottestsub_sub where gottests_id='".$row_result['gottests_id']."' order by gottests_id asc";
			$sql_results=mysqli_query($link,"select * from tbl_gottestsub_sub where gottests_id='".$row_result['gottests_id']."' order by gottests_id asc") or die(mysqli_error($link));
			while($row_results=mysqli_fetch_array($sql_results))
			{
				if($row_results['gottestss_abortflg']==0) 
				{
				$sql_resultss=mysqli_query($link,"select * from tbl_gottestsub_sub3 where gottests_id='".$row_results['gottests_id']."' order by gottests_id asc") or die(mysqli_error($link));
				$row_resultss=mysqli_num_rows($sql_resultss);
				
				$sql_resultss1=mysqli_query($link,"select * from tbl_gottestsub_sub4 where gottests_id='".$row_results['gottests_id']."' order by gottests_id asc") or die(mysqli_error($link));
				$row_resultss1=mysqli_num_rows($sql_resultss1);
					if($row_resultss==0 && $row_resultss1==0)
					{
						$resflg++;
					}
				}
			}
		}
	}
}
if($srno%2!=0)
{
?>			  
<tr class="Light">
        <td width="20" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="118" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>  
	<td width="71" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	<td width="69" align="center" valign="middle" class="smalltbltext"><?php echo $tdate1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tdatee;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td width="65" align="center" valign="middle" class="smalltbltext"><?php echo $sampno;?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="add_got_data1.php?tid=<?php echo $row_arr_home['gottest_tid'];?>" >Update</a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['gottest_resultflg']>0 && $resflg==0 && $resflg1==0){?><a href="got_result_update.php?tid=<?php echo $row_arr_home['gottest_tid'];?>" >Update</a><?php }?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php if($tot_result>0){?><a href="got_info1.php?tid=<?php echo $row_arr_home['gottest_tid'];?>" >View</a><?php }?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
        <td width="20" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td width="70" align="center" valign="middle" class="smalltbltext"><?php echo $row31['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $vv;?></td>
	<td width="118" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pp;?></td>  
	<td width="71" align="center" valign="middle" class="smalltbltext"><?php echo $trdate?></td>
	
	<td width="69" align="center" valign="middle" class="smalltbltext"><?php echo $tdate1;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tdatee;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $got;?></td>
	<td width="65" align="center" valign="middle" class="smalltbltext"><?php echo $sampno;?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="add_got_data1.php?tid=<?php echo $row_arr_home['gottest_tid'];?>" >Update</a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['gottest_resultflg']>0 && $resflg==0 && $resflg1==0){?><a href="got_result_update.php?tid=<?php echo $row_arr_home['gottest_tid'];?>" >Update</a><?php }?></td>
	
	<td align="center" valign="middle" class="smalltbltext"><?php if($tot_result>0){?><a href="got_info1.php?tid=<?php echo $row_arr_home['gottest_tid'];?>" >View</a><?php }?></td>
</tr>
<?php
}
$srno=$srno+1;
}
//}
//}
?>
</table>
<?php
}
else
{
?>
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found.</td></tr>
  </table>
<?php
}
?>       
		  </br>
		<table width="850" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center"><a href="got_filter1.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;
                      <input type="hidden" name="txtinv" />
                      <input type="hidden" name="flagcode" value=""/>
                      <input type="hidden" name="flagcode1" value=""/></td>
                  </tr>
              </table>


</td>
<td width="30"></td>
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
