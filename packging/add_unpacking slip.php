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
	
	$foccode=$_REQUEST['foccode'];
	$barstype=$_REQUEST['barstype'];
		
	if(isset($_POST['frm_action'])=='submit')
	{
		exit;
	    $p_id=trim($_POST['maintrid']);
		
		echo "<script>window.location='add_unpacking slip.php'</script>";	
			
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Unpackaging</title>
<link href="../include/main_pack.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
</head>
<script src="unpackingslip.js"></script>
<script src="../include/validation.js"></script>
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
<script language="javascript" type="text/javascript">

function mySubmit()
{
if(document.frmaddDepartment.txtbarcode.value=="")
{
	alert("Barcode cannot be blank");
	document.frmaddDepartment.txtbarcode.focus();
	return false;
}
//showUser(wh1val,'bing1','wh','bing1','','','',''); 
}

</script>

<body >

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_pack.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/process_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#1dbe03" style="border-bottom:solid; border-bottom-color:#1dbe03" >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Unpackaging
	    </tr></table></td>
	  </tr>
	  </table></td></tr>

	  <td align="center" colspan="4" >

	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden">
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php

$ebar=array();
$fcd=explode(",",$foccode);
foreach($fcd as $a)
{
if($a<>"")
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
    <td align="center" valign="middle" class="tblheading" >Barcode:&nbsp;&nbsp;<font color="#0000FF"><?php echo $a?></font></td>
  </tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse">	
  <tr class="tblsubtitle" height="25">
  	<td width="160" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="190" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="136" align="center" valign="middle" class="smalltblheading" >Lot No.</td>
    <td width="113" align="center" valign="middle" class="smalltblheading">UPS</td>
	<td width="114" align="center" valign="middle" class="smalltblheading" >Total NoP</td>
	<td width="123" align="center" valign="middle" class="smalltblheading" >Total Qty</td>
  </tr>
<?php
$sql_bar=mysqli_query($link,"Select * from tbl_barcodes where plantcode='$plantcode' and bar_barcode='$a' and bar_dispflg=0 and bar_unpackflg=0") or die(mysqli_error($link));
$tot_bar=mysqli_num_rows($sql_bar);	
$row_bar=mysqli_fetch_array($sql_bar);
	$lotqry=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row_bar['bar_lotno']."' and balqty > 0") or die(mysqli_error($link));
	$tot_row=mysqli_num_rows($lotqry);

if($tot_row > 0)
{
	$nob=0; $qty=0; $softstatus=""; $qc=""; $qcdot=""; $qcdot1=""; $qcdot2=""; $qcdttype=""; $ups="";
 	while($row_issue=mysqli_fetch_array($lotqry))
 	{ 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_bar['bar_lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{
$nop1=0; $ptp1=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=(1000/$packtp[0]);
	$ptp1=($packtp[0]/1000);
}
else
{
	$ptp=$packtp[0];
	$ptp1=$packtp[0];
}
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}
if($nop1<$row_issuetbl['balnop'])$nop1=$row_issuetbl['balnop'];
//$nob=$nop1;
$nob=$nob+$nop1; 
$extqty=$extqty+$row_issuetbl['balqty'];
$extnob=$extqty*$ptp;
$qty=$nob*$ptp1;

$sqlcrop=mysqli_query($link,"Select * from tblcrop where cropid='".$row_issuetbl['lotldg_crop']."'") or die(mysqli_error($link));
$totcrop=mysqli_num_rows($sqlcrop);
$rowcrop=mysqli_fetch_array($sqlcrop);

$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$totvariety=mysqli_num_rows($sqlvsriety);
$rowvariety=mysqli_fetch_array($sqlvsriety);
$sno=1; $srnonew=0; $uom="";
//echo $rowvariety['varietyid'];
$p1_array=explode(",",$rowvariety['gm']);
$p1_array2=explode(",",$rowvariety['wtmp']);
$p1_array3=explode(",",$rowvariety['mptnop']);
foreach($p1_array as $val1)
{
	if($val1<>"")
	{
		$sql_sel="select * from tblups where uid='".$val1."' and wt='".$packtp[1]."' and ups='".$packtp[0]."' order by uom Asc";
		$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
		if($row1234=mysqli_num_rows($res)>0)
		{
			$row12=mysqli_fetch_array($res);
			$uom=$row12['uom'];
			$wtmp=$p1_array2[$srnonew];
			$mptnop=$p1_array3[$srnonew];
		}
	}
	$srnonew++;
}	
$lotno=$row_bar['bar_lotno'];
/*array_push($ebar,$lotno);
$samelt=count(array_keys($ebar, $lotno));*/

$qc=$row_issuetbl['lotldg_qc'];
if($qc=="OK")
{
$trdate=$row_issuetbl['lotldg_qctestdate'];
$trdate=explode("-",$trdate);
$qcdot1=$trdate[2]."-".$trdate[1]."-".$trdate[0];
$qcdttype="DOT";
}
else
{
	$zz=str_split($lotno);
 	$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15].$zz[16];

	if($row_issuetbl['lotldg_srflg']==1)
	{
		$sql_softr_sub=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub=mysqli_num_rows($sql_softr_sub);
		if($tot_softr_sub > 0)
		{
		$row_softr_sub=mysqli_fetch_array($sql_softr_sub);
		//echo $row_softr_sub[0];
		$sql_softr=mysqli_query($link,"Select * from tbl_softr where plantcode='$plantcode' and softr_id='".$row_softr_sub[0]."'") or die(mysqli_error($link));
		$tot_softr=mysqli_num_rows($sql_softr);
		$row_softr=mysqli_fetch_array($sql_softr);
		if($tot_softr > 0)
		{
		$trdate=$row_softr['softr_date'];
		$trdate=explode("-",$trdate);
		$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
		}
		
		$sql_softr_sub2=mysqli_query($link,"Select max(softr_id) from tbl_softr_sub2 where plantcode='$plantcode' and softrsub_lotno='".$ltno."'") or die(mysqli_error($link));
		$tot_softr_sub2=mysqli_num_rows($sql_softr_sub2);
		if($tot_softr_sub2 > 0)
		{
		$row_softr_sub2=mysqli_fetch_array($sql_softr_sub2);
		//echo $row_softr_sub2[0];
		$sql_softr2=mysqli_query($link,"Select * from tbl_softr2 where plantcode='$plantcode' and softr_id='".$row_softr_sub2[0]."'") or die(mysqli_error($link));
		$tot_softr2=mysqli_num_rows($sql_softr2);
		$row_softr2=mysqli_fetch_array($sql_softr2);
		if($tot_softr2 > 0)
		{
		$trdate=$row_softr2['softr_date'];
		$trdate=explode("-",$trdate);
		$qcdot2=$trdate[2]."-".$trdate[1]."-".$trdate[0];
		}
		}
	}
	$qcdttype="DOSF";
}
if($row_issuetbl['lotldg_srflg']==1)$softstatus=$row_issuetbl['lotldg_srtyp'];
}
}
if($qcdot1=="0000-00-00" || $qcdot1=="--" || $qcdot1=="- -")$qcdot1="";
if($qcdot2=="0000-00-00" || $qcdot2=="--" || $qcdot2=="- -")$qcdot2="";

if($qcdttype=="DOT")$qcdot=$qcdot1;
else if($qcdttype=="DOSF")$qcdot=$qcdot2;
else
$qcdot="";
$dp1="";$dp2="";$dp3="";
if($qcdot!="")
{
	$trdate2=explode("-",$qcdot);
	$m=$trdate2[1];
	$de=$trdate2[0];
	$y=$trdate2[2];
	
	$trdt3=date('Y-m-d',mktime(0,0,0,$m,($de-1),$y));
	$trdate2=explode("-",$trdt3);
	$m=$trdate2[1];
	$de=$trdate2[2];
	$y=$trdate2[0];
	
	$dt=3;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp1="";}
	
	$dt=6;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp2=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp2="";}
	
	$dt=9;
	if($dt!="")
	{
		for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp3=$de."-".$dp[1]."-".$dp[0];} 
	}
	else
	{$dp3="";}
}

$mpno=floor($qty/$wtmp);


$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $qtyns=0; $nompns=0; $nopns=0; $qtynl=0; $nompnl=0; $nopnl=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_balqty > 0 and mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=explode(",", $row_mps['mpmain_crop']);
		$verarr=explode(",", $row_mps['mpmain_variety']);
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=explode(",", $row_mps['mpmain_upssize']);
		$noparr=explode(",", $row_mps['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nops=$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtys=$ptp*$nops; $nomps=$ct; 
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_balqty > 0 and mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=explode(",", $row_mpl['mpmain_crop']);
		$verarr=explode(",", $row_mpl['mpmain_variety']);
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=explode(",", $row_mpl['mpmain_upssize']);
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopl=$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtyl=$ptp*$nopl; $nompl=$ct; 
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_balqty > 0 and mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
if($tot_mpm > 0)
{
	while($row_mpm=mysqli_fetch_array($sql_mpm))
	{
		$crparr=explode(",", $row_mpm['mpmain_crop']);
		$verarr=explode(",", $row_mpm['mpmain_variety']);
		$lotarr=explode(",", $row_mpm['mpmain_lotno']);
		$upsarr=explode(",", $row_mpm['mpmain_upssize']);
		$noparr=explode(",", $row_mpm['mpmain_lotnop']);
		
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopm=$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtym=$ptp*$nopm; $nompm=$ct; 
	}
}
$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_balqty > 0 and mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=explode(",", $row_mpns['mpmain_crop']);
		$verarr=explode(",", $row_mpns['mpmain_variety']);
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=explode(",", $row_mpns['mpmain_upssize']);
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopns=$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtyns=$ptp*$nopns; $nompns=$ct; 
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_balqty > 0 and mpmain_barcode='$a'") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=explode(",", $row_mpnl['mpmain_crop']);
		$verarr=explode(",", $row_mpnl['mpmain_variety']);
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=explode(",", $row_mpnl['mpmain_upssize']);
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($a==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopnl=$noparr[$i];
				$ct++;
			}
		}
		$up=explode(" ", $ups);
		if($up[1]=="Gms")
		{
			$ptp=$up[0]/1000;
		}
		else
		{
			$ptp=$up[0];
		}
		$qtynl=$ptp*$nopnl; $nompnl=$ct; 
	}
}

$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
//if($samelt==1)
{
?>


<tr class="Light" height="25">
	<td width="160" align="center" valign="middle" class="smalltblheading"><?php echo $rowcrop['cropname'];?></td>
	<td width="190" align="center" valign="middle" class="smalltblheading"><?php echo $rowvariety['popularname'];?></td>
	<td width="136" align="center" valign="middle" class="smalltblheading"><?php echo $lotno;?></td>
	<td width="113" align="center" valign="middle" class="smalltblheading"><?php echo $ups;?></td>
	<td width="114" align="center" valign="middle" class="smalltblheading"><?php echo $totextpouches;?></td>
	<td width="123" align="center" valign="middle" class="smalltblheading"><?php echo $qtys;?></td>
</tr>

<?php
}
}

?>
</table>
<br />
<?php
}
}
?>  
<div id="postingtable" style="display:block"></div>
<!--<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>-->
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_unpacking.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="0" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>


</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
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

  
