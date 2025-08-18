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
	
	$sdate=$_REQUEST['sdate'];
	
	$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arr_role='".$logid."' and  arrtrflag=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
	$arrival_id=$row_tbl['arrival_id'];	
	
	$s_sub="delete from tbl_gotqc where arrival_id='".$arrival_id."'";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));
	
	/**/
	
}

	$s_sub="delete from tbl_gotqc where arr_role='".$logid."'  and arrtrflag=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	
		
	if(isset($_POST['frm_action'])=='submit')
	{
		$btnval=$_POST['btnval'];
		$qcs=trim($_POST['foccode']);
	//exit;
		if($btnval==0)
		{
			$nid="";
			$p=explode(",",$qcs);
			foreach($p as $val)
			{
				if($val <> "")
				{
					$sql_chk=mysqli_query($link,"select * from tbl_gottest where gottest_tid='$val'") or die(mysqli_error($link));
					$tot_chk=mysqli_num_rows($sql_chk);
					$row_chk=mysqli_fetch_array($sql_chk);
					
					$oltn=$row_chk['gottest_oldlot'];
					$smpn=$row_chk['gottest_sampleno'];
					$yrd=$row_chk['gottest_yearid'];
					if($yrd!="")
					$sql_chk2=mysqli_query($link,"select gottest_tid from tbl_gottest where gottest_sampleno='$smpn' and yearid='$yrd' and gottest_oldlot='$oltn'") or die(mysqli_error($link));
					else
					$sql_chk2=mysqli_query($link,"select gottest_tid from tbl_gottest where gottest_sampleno='$smpn' and gottest_oldlot='$oltn'") or die(mysqli_error($link));
					$tot_chk2=mysqli_num_rows($sql_chk2);
					while($row_chk2=mysqli_fetch_array($sql_chk2))
					{
						if($nid!="")
						$nid=$nid.",".$row_chk2['gottest_tid'];
						else
						$nid=$row_chk2['gottest_tid'];
					}
				}
			}
			//echo $nid;
			//exit;
			echo "<script>window.location='add_new_request _tr.php?foccode=$nid'</script>";
		}
		else
		{
			$tid=$_POST['dtid'];
			$sql_in1="update tbl_gottest set gottest_gotsampdflg=2 where gottest_tid='$tid'";	
			$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			echo "<script>window.location='home_sampling2.php'</script>";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GOT- Transaction - GOT Sample Dispatch</title>
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

function openslocpopprint1(tid)
{
winHandle=window.open('getuser_status1.php?tid='+tid,'WelCome','top=170,left=180,width=520,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}


function openslocpopprint(tid)
{
//var itm=document.frmaddDept.tid.value;
winHandle=window.open('getuser_status.php?tid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
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

function deleterec(btval, tid)
{
	if(!confirm("Do you wish to Remove this Sample Number from Dispatch List?")==true)
	{
		document.frmaddDept.btnval.value=2;
		document.frmaddDept.dtid.value="";
		return false;
	}
	else
	{
		document.frmaddDept.btnval.value=btval;
		document.frmaddDept.dtid.value=tid;
		return true;
	}
}	
function mySubmit()
{	
//alert(document.frmaddDept.btnval.value);
if(document.frmaddDept.btnval.value==0)
{			
	document.frmaddDept.foccode.value ="";
	document.frmaddDept.dtid.value="";
	if(document.frmaddDept.srno.value > 2)
	{
	//alert(document.frmaddDept.srno.value);
		for (var i = 0; i < document.frmaddDept.foc.length; i++) 
		{          
		 //alert(document.frmaddDept.foc.length);
		  if(document.frmaddDept.foc[i].checked == true)
			{ 
				if(document.frmaddDept.foccode.value=="")
				{
				document.frmaddDept.foccode.value=document.frmaddDept.foc[i].value;
				}
				else
				{
				document.frmaddDept.foccode.value = document.frmaddDept.foccode.value +','+document.frmaddDept.foc[i].value;
				}
			}
			
		}
		
	}
	else
	{
		if(document.frmaddDept.foc.checked == true)
		{
			if(document.frmaddDept.foccode.value =="")
			{
				document.frmaddDept.foccode.value=document.frmaddDept.foc.value;
			}
			else
			{
				document.frmaddDept.foccode.value = document.frmaddDept.foccode.value +','+document.frmaddDept.foc.value;
			}
		}
	}
	if(document.frmaddDept.foccode.value =="")
	{
				alert("Please select option")
				return false;
	}
	//alert(document.frmaddDept.foccode.value);
return true;
}
if(document.frmaddDept.btnval.value==2)
	{
	return false;
	}
	else
	{
	return true;
	}
}
function selectall()
{
//alert(document.frmaddDept.foc.value);
	if(document.frmaddDept.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDept.foc.length; i++)
		{          
			document.frmaddDept.foc[i].checked = true;
		}
	}	
	else
	{
		document.frmaddDept.foc.checked = true;
	}
}

function unselectall()
{
	if(document.frmaddDept.srno.value > 2)
	{
		for (var i = 0; i < document.frmaddDept.foc.length; i++) 
		{          
			document.frmaddDept.foc[i].checked = false;
			document.frmaddDept.foccode.value ="";
		}
	}
	else
	{
		document.frmaddDept.foc.checked = false;
		document.frmaddDept.foccode.value ="";
	}	
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/qty_quality.php");?></td>
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
	      <td width="860" height="25">&nbsp;Transaction - GOT Sample Dispatch </td>
	    </tr></table></td>
	  <td width="80" height="25" align="right" class="submenufont" >
	 <!-- <table border="3" align="right" bordercolor="#d21704" bordercolordark="#d21704" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_new_request _tr.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>
</table>--></td>
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="aaa" value="<?php echo $tot_variety?>" type="hidden"> 
	  <input name="btnval" value="0" type="hidden"> 
	  <input name="dtid" value="" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php

$sdate=$_REQUEST['sdate'];
$t=split("-", $sdate);
$sdate=$t[2]."-".$t[1]."-".$t[0];
//echo "select distinct gottest_sampleno from tbl_gottest where gottest_aflg=0 and gottest_bflg=1 and gottest_cflg=0 and gottest_gotflg=0 and gottest_gotsampdflg=0 and gottest_got='UT' and gottest_srdate='$sdate' order by gottest_spdate asc, gottest_sampleno asc <br />";

 $sql_arr_home2=mysqli_query($link,"select distinct gottest_sampleno from tbl_gottest where gottest_aflg=0 and gottest_bflg=1 and gottest_cflg=0 and gottest_gotflg=0 and gottest_gotsampdflg=0 and gottest_got='UT' and gottest_srdate='$sdate' order by gottest_spdate asc, gottest_sampleno asc") or die(mysqli_error($link));
 $tot_arr_home2=mysqli_num_rows($sql_arr_home2);
 if($tot_arr_home2 > 0)
{
?>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr height="15"> <!--<td align="middle" class="tblheading">GOT Sample Dispatch </td>--><td colspan="6" align="right" class="tblheading">&nbsp;<a style="text-decoration:underline; color:#0000FF; cursor:pointer" onclick="selectall();">Check ALL</a>
|&nbsp;&nbsp;<a style="text-decoration:underline; color:#0000FF; cursor:pointer " onclick="unselectall();">Clear ALL</a>&nbsp;</td></tr></table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="25" height="19"align="center" valign="middle" class="tblheading">#</td>
			   <td width="77" align="center" valign="middle" class="tblheading">DOSR</td>
			    <td width="77" align="center" valign="middle" class="tblheading">DOSC</td>
			   <td width="134" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="158" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="119" align="center" valign="middle" class="tblheading">Lot No.</td> 
			  <td width="59" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="63" align="center" valign="middle" class="tblheading">QC Status </td>
			    <td width="74" align="center" valign="middle" class="tblheading">GOT Status</td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
              <td width="55" align="center" valign="middle" class="tblheading">Dispatch</td>
             <!-- <td width="49" align="center" valign="middle" class="tblheading">Delete</td>-->
            </tr>
<?php
$srno=1;  $cnt=1;
if($tot_arr_home2 > 0)
{
while($row_arr_home2=mysqli_fetch_array($sql_arr_home2))
{
$sql_arr_home3=mysqli_query($link,"select distinct gottest_lotno from tbl_gottest where gottest_sampleno='".$row_arr_home2['gottest_sampleno']."' and gottest_aflg=0 and gottest_bflg=1 and gottest_cflg=0 and gottest_gotflg=0 and gottest_gotsampdflg=0 and gottest_got='UT'  order by gottest_spdate asc, gottest_sampleno asc") or die(mysqli_error($link));
$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
{
$sql_arr_home4=mysqli_query($link,"select max(gottest_tid) from tbl_gottest where gottest_lotno='".$row_arr_home3['gottest_lotno']."' and gottest_sampleno='".$row_arr_home2['gottest_sampleno']."' and gottest_aflg=0 and gottest_bflg=1 and gottest_cflg=0 and gottest_gotflg=0 and gottest_gotsampdflg=0 and gottest_got='UT'  order by gottest_spdate asc, gottest_sampleno asc") or die(mysqli_error($link));
$row_arr_home4=mysqli_fetch_array($sql_arr_home4);

$sql_arr_home=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$row_arr_home3['gottest_lotno']."' and gottest_sampleno='".$row_arr_home2['gottest_sampleno']."' and gottest_tid='".$row_arr_home4[0]."' and gottest_aflg=0 and gottest_bflg=1 and gottest_cflg=0 and gottest_gotflg=0 and gottest_gotsampdflg=0 and gottest_got='UT'  order by gottest_spdate asc, gottest_sampleno asc") or die(mysqli_error($link));
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['gottest_srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_arr_home['gottest_spdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;		
	
	$lrole=$row_arr_home['logid'];
	$arrival_id=$row_arr_home['gottest_tid'];
	$qc1=$row_arr_home['gottest_sampleno'];
	
	$ltnno=$row_arr_home['gottest_oldlot'];
	
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
			
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_arr_home['gottest_lotno'];
		}
		else
		{
		$lotno=$row_arr_home['gottest_lotno'];
		}
		//$pp='T';
		$stage=$row_arr_home['gottest_trstage'];

	$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name from tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * from tblcrop  where cropid='".$row_arr_home['gottest_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);

$tot=0;
	$quer3=mysqli_query($link,"SELECT * from tblvariety where varietyid ='".$row_arr_home['gottest_variety']."' "); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0 )
	 {
	 $vv=$row31['cropname']."-Coded";
	 }
	 else
	 {
	  $vv=$tt;
	  }


	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."' order by lotldg_id desc") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot11=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$pp=$row_tbl['lotldg_qc'];	
$got=$row_tbl['lotldg_got1'];	

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	
	
	$fg=0;
	$qc1=$row_arr_home['gottest_sampleno'];
	$yriid=$row_arr_home['yearid'];
	$sq=mysqli_query($link,"select gottest_sampleno,gottest_trstage from tbl_gottest where gottest_sampleno='$qc1' and yearid='$yriid'") or die(mysqli_error($link));
	$toto=mysqli_num_rows($sq);
	if($toto>1)
	{
		if($row_arr_home['gottest_trstage']=="Condition" || $row_arr_home['gottest_trstage']=="Pack" || $row_arr_home['gottest_trstage']=="")$fg=1;
	}

 $row_arr_home['gottest_variety'];
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
//if($fg==0)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="25" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="134" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="119" align="center" valign="middle" class="tblheading"><?php echo $ltnno?></td>
		 	<td width="59" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		    <td align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
		    <td width="85" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
         <td width="55" align="center" valign="middle" class="tblheading"> <input type="checkbox" name="foc" value="<?php echo $arrival_id?>" /></td>
         <!--<td width="49" align="center" valign="middle" class="tblheading"><input name="image" type="image" style="display:inline;cursor:pointer;" onclick="deleterec('1','<?php echo $row_arr_home['gottest_tid'];?>');" src="../images/delete.png" alt="Abort Value" border="0"/></td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="25" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="77" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="134" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="119" align="center" valign="middle" class="tblheading"><?php echo $ltnno?></td>
		  <td align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td align="center" valign="middle" class="tblheading"><?php echo $got;?></td>
		  <td width="85" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
	
      <td width="55" align="center" valign="middle" class="tblheading"> <input type="checkbox" name="foc" value="<?php echo $arrival_id?>" /></td>
     <!-- <td width="49" align="center" valign="middle" class="tblheading"><input name="image" type="image" style="display:inline;cursor:pointer;" onclick="deleterec('1','<?php echo $row_arr_home['gottest_tid'];?>');" src="../images/delete.png" alt="Abort Value" border="0"/></td>-->
</tr>
<?php
}
$srno=$srno+1;
}
}
}
}
}
?>
          </table>
	  
		  </br>
		 <table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="select1.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();"><input type="hidden" name="chk" value="" /><input type="hidden" name="foccode1" value="" /><input type="hidden" name="foccode" value="" /> <input type="hidden" name="srno" value="<?php echo $srno;?>" /><input type="hidden" name="tt" value="" />&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
else
{
?>	
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="select1.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;<!--<input name="Submit" type="image" src="../images/post.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">--><input type="hidden" name="chk" value="" /><input type="hidden" name="foccode1" value="" /><input type="hidden" name="foccode" value="" /> <input type="hidden" name="srno" value="<?php echo $srno;?>" /><input type="hidden" name="tt" value="" />&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
?>	
<!---->

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
