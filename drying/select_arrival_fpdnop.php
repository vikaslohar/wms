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
	
	$tp="Fresh Seed with PDN";	
	if(isset($_REQUEST['p_id']))
	{
		$pid = $_REQUEST['p_id'];
	}
	if(isset($_REQUEST['lots']))
	{
		$lots = $_REQUEST['lots'];
	}
	else
	{
		$lots="";
	}

	if(isset($_POST['frm_action'])=='submit')
	{
		$pid=trim($_POST['txtitem']);
		$foccode=trim($_POST['foccode']);
		$lots=trim($_POST['lots']);
		
		$foccode1=explode(",",$foccode); 
		if($foccode!="")
		{
			$sql_arrsub=mysqli_query($link,"select * from tbl_dryarrival_sub where  plantcode='".$plantcode."' and   lotno='".$foccode1[0]."' and batchflg=0 and dryflg=0 ") or die(mysqli_error($link));
			$row_arrsub=mysqli_fetch_array($sql_arrsub);
				
			$crop=$row_arrsub['lotcrop'];
			$variety=$row_arrsub['lotvariety'];
			$sql_code="SELECT MAX(arr_code) FROM tbl_cobdrying where plantcode='".$plantcode."'  ORDER BY arr_code DESC";
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
			
			
			$sqltblsub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$pid."'") or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sqltblsub);
			$rowtblsub=mysqli_fetch_array($sqltblsub);
						
			$cd="R";
			if(date("Y")==$year1)$yer2=$year1;
			if(date("Y")==$year2)$yer2=$year2;
			$sql_lgenyr=mysqli_query($link,"select * from tbl_lgenyear where lgenyear='".$yer2."'") or die(mysqli_error($link));
			$row_lgenyr=mysqli_fetch_array($sql_lgenyr);
			$yer=$row_lgenyr['lgenyearcode'];
			if($yer=="")$yer=$yearid_id;
			
			$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
			$row_cls=mysqli_fetch_array($quer_cn);
			$tp1=$row_cls['code'];
			
			$sql_lotm=mysqli_query($link,"SELECT MAX(lotcobgen_lot) FROM tbl_lotcobgen  where plantcode='".$plantcode."' and   lotcobgen_yearcode='$yer'  ORDER BY lotcobgen_yearcode DESC") or die(mysqli_error($link));
			$tot_lotm=mysqli_num_rows($sql_lotm);
			$tm_code=0;
			if($tot_lotm > 0)
			{
				$row_lotm=mysqli_fetch_array($sql_lotm);
				$tm_code=$row_lotm['0'];
				if($tm_code > 0 )
				$lot_code=$tm_code+1;
				else
				$lot_code="80001";
			}
			else
			{
				$lot_code="80001";
			}
			$lot_code=sprintf("%00005d",$lot_code);
			if($rowtblsub['batchlot']=="")
			{
				$lotnonew=$tp1.$yer.$lot_code."/00000/00".$cd;
				$lotnoornew=$tp1.$yer.$lot_code."/00000/00";
			}
			else
			{
				$lotnonew=$rowtblsub['newlono'];
				$lotnoornew=$rowtblsub['norlot'];
			}
			if($lotnonew=="")
			{
				$lotnonew=$tp1.$yer.$lot_code."/00000/00".$cd;
				$lotnoornew=$tp1.$yer.$lot_code."/00000/00";
			}
			
			$sqlsub="insert into tbl_lotcobgen (lotcobgen_lot, lotcobgen_lotno, lotcobgen_orlot, lotcobgen_yearcode, lotcobgen_yearid, lotcobgen_logid, lotcobgen_wyearcode, plantcode) values('$lot_code', '$lotnonew', '$lotnoornew', '$yer', '$yer2', '$logid', '$yer', '$plantcode')";
			$zaxa=mysqli_query($link,$sqlsub) or die(mysqli_error($link));
			
			$sql_sub_sub="insert into tbl_cobdrying (arr_code, crop, variety, stage, logid, plantcode) values('$code', '$crop', '$variety', 'Raw', '$logid', '$plantcode')";
			if(mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link)))
			{
				$mainid=mysqli_insert_id($link);
			}
			
			
			$ct=0;
			foreach($foccode1 as $ltnn)
			{
				if($ltnn<>"")
				{
					$sqlarrsub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   lotno='".$ltnn."' and batchflg=0 and dryflg=0 ") or die(mysqli_error($link));
					$rowarrsub=mysqli_fetch_array($sqlarrsub);
					$txtdisptot=$rowarrsub['act1'];
					$txtqtytot=$rowarrsub['act'];
					
					$sql_sub="insert into tbl_cobdryingsub (lotno, trid, onob, oqty, sstage, drytyp, newlono, norlot,plantcode) values ('$ltnn', '$mainid', '$txtdisptot', '$txtqtytot', 'Raw', 'batch', '$lotnonew', '$lotnoornew','$plantcode')";
					if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
					{
						$sqltblarsub24="update tbl_dryarrival_sub set batchflg='1', batchlot='$lotnonew', batchorlot='$lotnoornew' where lotno='".$ltnn."' and batchflg=0 and dryflg=0 ";	
						$asdf=mysqli_query($link,$sqltblarsub24) or die(mysqli_error($link));
						$ct++;
					}
				}
			}
			if($ct>0)
			{
				$sqltblar_sub24="update tbl_cobdrying set arrflg='2' where trid='".$mainid."'";	
				$asdf=mysqli_query($link,$sqltblar_sub24) or die(mysqli_error($link));
			}
			
		}
		//exit;	
		echo "<script>window.location='select_arrival_fpdnop.php?p_id=$pid&lots=$lots'</script>";		
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying - Transction-Select output</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
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
{ //alert(document.frmaddDepartment.batlotlst.length);
	document.frmaddDepartment.foccode.value='';
	if(document.frmaddDepartment.srn.value > 2)
	{
		for (var i = 0; i < document.frmaddDepartment.batlotlst.length; i++) 
		{          
			// alert(document.frmaddDepartment.batlotlst[i].value);
			if(document.frmaddDepartment.batlotlst[i].checked == true)
			{
				if(document.frmaddDepartment.foccode.value =="")
				{
					document.frmaddDepartment.foccode.value=document.frmaddDepartment.batlotlst[i].value;
					//document.frmaddDepartment.foccode1.value=document.frmaddDepartment.batlotlst[i].value;
				}
				else
				{
					document.frmaddDepartment.foccode.value = document.frmaddDepartment.foccode.value +','+document.frmaddDepartment.batlotlst[i].value;
					//document.frmaddDepartment.foccode1.value = document.frmaddDepartment.foccode1.value +'\n'+document.frmaddDepartment.batlotlst[i].value;
				}
			}
		}
	}
	else
	{
		alert("You must select more than one Lot to create Batch");
		return false;
	}
	//alert(document.frmaddDepartment.foccode.value);
	if(document.frmaddDepartment.foccode.value=="")
	{
		alert("You must select Lot to create Batch");
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


function openslocpopprint(val1, val2)
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('fpdngrn.php?itmid='+itm+'&typval='+val1+'&typ='+val2,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function openslocpopprint1(subid)
{
//alert(subid);
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('fpdnphsrn.php?itmid='+itm+'&subid='+subid+'&tp='+tp,'WelCome','top=20, left=50, width=850, height=850, scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//}
}


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

function addmorelots(tid)
{
	var lots=document.frmaddDepartment.lots.value;
	winHandle=window.open('addlotsbatch.php?tid='+tid+'&lots='+lots,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); bin_sloc_details_print
}

function selectall()
{
	if(document.frmaddDepartment.srn.value > 1)
	{
		//alert(document.frmaddDepartment.srn.value);
		if(document.frmaddDepartment.srn.value > 2)
		{
			for (var i = 0; i < document.frmaddDepartment.batlotlst.length; i++)
			{          
				document.frmaddDepartment.batlotlst[i].checked = true;
			}
		}	
		else
		{
			document.frmaddDepartment.batlotlst.checked = true;
		}
	}
}

function unselectall()
{
	if(document.frmaddDepartment.srn.value > 1)
	{
		if(document.frmaddDepartment.srn.value > 2)
		{
			for (var i = 0; i < document.frmaddDepartment.batlotlst.length; i++) 
			{          
				document.frmaddDepartment.batlotlst[i].checked = false;
				document.frmaddDepartment.foccode.value ="";
			}
		}
		else
		{
			document.frmaddDepartment.batlotlst.checked = false;
			document.frmaddDepartment.foccode.value ="";
		}
	}	
}

</script>

<body>


<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_drying.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
<!-- actual page start--->	
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction: Fresh Seed Arrival with PDN - Output Selection </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden">
   <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
 <input type="hidden" name="lots" value="<?php echo $lots?>" />
 <input type="hidden" name="foccode" value="" />
 <br />

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr height="25">
  <td colspan="4" align="center" class="Mainheading">Batch Preparation</td>
</tr>
</table>
<?php

$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$rowarrsub=mysqli_fetch_array($sql_tbl_sub);
$crop=$rowarrsub['lotcrop'];
//$variety=$row_arrsub['lotvariety'];
		
$vrnew=$crop."-"."Coded";
$sql_tbl_arsub=mysqli_query($link,"select distinct lotno from tbl_dryarrival_sub where  plantcode='".$plantcode."'  and arrival_id='".$arrival_id."' and got='GOT-R' and lotvariety!='$vrnew'") or die(mysqli_error($link));
$arsubtbltot=mysqli_num_rows($sql_tbl_arsub);

$sql_tbl_arsub1=mysqli_query($link,"select distinct lotno from tbl_dryarrival_sub where  plantcode='".$plantcode."'  and arrival_id='".$arrival_id."' and lotvariety='$vrnew'") or die(mysqli_error($link));
$arsubtbltot1=mysqli_num_rows($sql_tbl_arsub1);

$sql_tbl_arsub2=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' and (sstatus='D' or sstatus='D/F' or sstatus='D/Q' or sstatus='D/F/Q')") or die(mysqli_error($link));
$arsubtbltot2=mysqli_num_rows($sql_tbl_arsub2);
?>
<table align="center" border="1" width="250" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading">&nbsp;Non-Drying Batch Lots List</td>
</tr> 
<?php
while($row_tbl_arsub=mysqli_fetch_array($sql_tbl_arsub))
{
?>
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_arsub['lotno'];?></td>
</tr>
<?php
}
?>
<?php
while($row_tbl_arsub1=mysqli_fetch_array($sql_tbl_arsub1))
{
?>
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl_arsub1['lotno'];?></td>
</tr>
<?php
}
?>
</table><br />

<table align="center" border="1" width="500" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;Drying Batch Pending Lots List</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="25">
    <td width="36" align="center" class="tblheading" valign="middle">#</td>
	<td width="238" align="center" class="tblheading" valign="middle">Lot Number</td>
    <td width="79" align="center" class="tblheading" valign="middle">NoB</td>
    <td width="78" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="57" align="center" class="tblheading" valign="middle"><a href="Javascript:void(0);" onclick="selectall();">CA</a> / <a href="Javascript:void(0);" onclick="unselectall();">CL</a></td>
</tr>
<?php
$srn=1; $ver="";
$sql_arrsub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' and lotvariety!='$vrnew' and got!='GOT-R' and batchflg=0 and dryflg=0 ") or die(mysqli_error($link));
$tot_arrsub=mysqli_num_rows($sql_arrsub);
if($tot_arrsub>0)
{
while($row_arrsub=mysqli_fetch_array($sql_arrsub))
{
if($ver=="")$ver=$row_arrsub['lotvariety'];

if($ver==$row_arrsub['lotvariety'])
{
?>	
<tr class="Light" height="25">
    <td width="36" align="center" class="tbltext" valign="middle"><?php echo $srn;?></td>
	<td width="238" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['lotno'];?></td>
    <td width="79" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['act1'];?></td>
    <td width="78" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['act'];?></td>
	<td width="57" align="center" class="tbltext" valign="middle"><input type="checkbox" name="batlotlst"  value="<?php echo $row_arrsub['lotno'];?>" /></td>
</tr>
<?php
$srn++;
}
}
if($lots!="")
$lots=$lots.",";
$lotnos=explode(",", $lots);
foreach($lotnos as $ltno)
{
if($ltno<>"")
{
//echo $ltno;
$sql_arrsub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   lotno='".$ltno."'") or die(mysqli_error($link));
if($tot_arrsub=mysqli_num_rows($sql_arrsub)>0)
{
while($row_arrsub=mysqli_fetch_array($sql_arrsub))
{
?>	
<tr class="Light" height="25">
    <td width="36" align="center" class="tbltext" valign="middle"><?php echo $srn;?></td>
	<td width="238" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['lotno'];?></td>
    <td width="79" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['act1'];?></td>
    <td width="78" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['act'];?></td>
	<td width="57" align="center" class="tbltext" valign="middle"><input type="checkbox" name="batlotlst"  value="<?php echo $row_arrsub['lotno'];?>" /></td>
</tr>
<?php
$srn++;
}
}
}
}
?>
<tr class="Light" height="25">
    <td align="right" class="tbltext" valign="middle" colspan="5"><a href="Javascript:void(0);" onclick="addmorelots(<?php echo $tid;?>)">Add More Lots&nbsp;</a></td>
</tr>
<?php
}
else
{
?>	
<tr class="Light" height="25">
    <td align="center" class="tbltext" valign="middle" colspan="5">No Lots found for Drying Batch Creation</td>
</tr>
<?php
}
?>
<input type="hidden" name="srn" value="<?php echo $srn;?>" />
</table><br />
<table align="center" border="1" width="500" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;Drying Batch Pending Lots List</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="25">
    <td width="36" align="center" class="tblheading" valign="middle">#</td>
	<td width="238" align="center" class="tblheading" valign="middle">Lot Number</td>
    <td width="79" align="center" class="tblheading" valign="middle">NoB</td>
    <td width="78" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="57" align="center" class="tblheading" valign="middle">Batch Lot No.</td>
</tr>
<?php
$srn2=1; $ver="";
$sql_arrsub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' and batchflg=1 and dryflg=0 ") or die(mysqli_error($link));
$tot_arrsub=mysqli_num_rows($sql_arrsub);
if($tot_arrsub>0)
{
while($row_arrsub=mysqli_fetch_array($sql_arrsub))
{
if($row_arrsub['batchlot']!="")
{
?>	
<tr class="Light" height="25">
    <td width="36" align="center" class="tbltext" valign="middle"><?php echo $srn2;?></td>
	<td width="238" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['lotno'];?></td>
    <td width="79" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['act1'];?></td>
    <td width="78" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['act'];?></td>
	<td width="57" align="center" class="tbltext" valign="middle"><?php echo $row_arrsub['batchlot'];?></td>
</tr>
<?php
$srn2++;
}
}
}
else
{
?>	
<tr class="Light" height="25">
    <td align="center" class="tbltext" valign="middle" colspan="5">No Batch found</td>
</tr>
<?php
}
?>
<input type="hidden" name="srn2" value="<?php echo $srn2;?>" />
</table>	
	



<table align="center" width="314" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_freshpdn.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;&nbsp;<input type="image" src="../images/batch.gif" border="0" style="display:inline;cursor:Pointer;" onclick="return mySubmit()"  /></td>	
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
