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
	
	if($role!="QCS")
	{
		echo '<script language="JavaScript" type="text/JavaScript">';
		echo "alert('Cannot Authorise the Transaction. Reason: You are not Logged in with Authorization Login.');";
		//echo "window.location='../login.php' ";
		echo '</script>';
	}
	
	if(isset($_REQUEST['p_id']))
	{
		$pid = $_REQUEST['p_id'];
	}

	if(isset($_POST['frm_action'])=='submit')
	{	
		$pid=trim($_POST['pid']);
		$txtstage=trim($_POST['txtstage']);
		$nlotyear=trim($_POST['nlotyear']);
		$leduration=trim($_POST['leduration']);
		$leupto=trim($_POST['leupto']);
		$lottype=trim($_POST['lottype']);
		$explotno=trim($_POST['explotno']);
		
		
		$hdate13=split("-",$leupto);
		$ledate=$hdate13[2]."-".$hdate13[1]."-".$hdate13[0];
		
		$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id=$pid")or die(mysqli_error($link));
    	$row=mysqli_fetch_array($sql1);
		$nooflots=$row['blendm_nolots'];
		$plantcoden=$row['plantcode'];
		//exit;
		if($txtstage=="Raw")
		{ $cd="R";}
		else if($txtstage=="Condition")
		{ $cd="C";}
		else
		{ $cd="R";}
		if(date("Y")==$year1)$yer2=$year1;
		if(date("Y")==$year2)$yer2=$year2;
		$sql_lgenyr=mysqli_query($link,"select * from tbl_lgenyear where lgenyear='".$yer2."'") or die(mysqli_error($link));
		$row_lgenyr=mysqli_fetch_array($sql_lgenyr);
		$yer=$row_lgenyr['lgenyearcode'];
		if($yer=="")$yer=$yearid_id;
		
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcoden' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$tp1=$row_cls['code'];
		
		$sql_lotm=mysqli_query($link,"SELECT MAX(lotmgen_lot) FROM tbl_lotmgen  where plantcode='$plantcoden' and lotmgen_yearcode='$yer'  ORDER BY lotmgen_yearcode DESC") or die(mysqli_error($link));
		$tot_lotm=mysqli_num_rows($sql_lotm);
		$tm_code=0;
		if($tot_lotm > 0)
		{
			$row_lotm=mysqli_fetch_array($sql_lotm);
			$tm_code=$row_lotm['0'];
			if($tm_code > 0)
			$lot_code=$tm_code+1;
			else
			$lot_code=90000;
		}
		else
		{
			$lot_code=90000;
		}
		
		$sql_sub=mysqli_query($link,"select distinct blends_group from tbl_blends where blendm_id='$pid' and blends_group>0 group by blends_group order by blends_group asc") or die(mysqli_error($link));
		while($row_sub=mysqli_fetch_array($sql_sub))
		{
			if($lottype=="Regular")
			{
				$lotnonew=$tp1.$yer.$lot_code."/00000/00".$cd;
				$lotnoornew=$tp1.$yer.$lot_code."/00000/00";
				
				
				
				$sqlmain="update tbl_blends set blends_newlot='$lotnonew', blends_orlot='$lotnoornew', blends_arryear='$nlotyear' where blendm_id='$pid' and blends_group='".$row_sub['blends_group']."' ";
				$a123=mysqli_query($link,$sqlmain) or die(mysqli_error($link));
				
				$sql_sub_upd="Insert into tbl_lotmgen (lotmgen_lot, lotmgen_lotno, lotmgen_orlot, lotmgen_yearcode, lotmgen_yearid, lotmgen_logid, lotmgen_wyearcode, plantcode) values ('$lot_code', '$lotnonew', '$lotnoornew', '$yer', '$yer2', '$logid', '$yearid_id', '$plantcoden')";
				$z12345=mysqli_query($link,$sql_sub_upd) or die(mysqli_error($link));
					
				$lot_code=$lot_code+1;
			}
		}
		
		$sql_sub=mysqli_query($link,"select * from tbl_blends where blendm_id='$pid' and blends_delflg>0 group by blends_group order by blends_group asc") or die(mysqli_error($link));
		$tot_sub=mysqli_num_rows($sql_sub);
		if($tot_sub==$nooflots)
		{
			$sql_s="update tbl_blends set blends_newlot='', blends_orlot='', blends_arryear='' where blendm_id='$pid'";
			$a123456=mysqli_query($link,$sql_s) or die(mysqli_error($link));
		}
		else
		{
			$sql_s="update tbl_lotmgen_expsub set lmes_blendflg=1 where lmes_lotno='$explotno'";
			$a123456=mysqli_query($link,$sql_s) or die(mysqli_error($link));
		}
		
		//exit;
		$dt=date("Y-m-d"); 
		$sql_main="update tbl_blendm set blendm_vflg=1, blendm_aflg=1, blendm_vdate='$dt' where blendm_id='$pid'";
		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		//exit;
		$sqlisstbl=mysqli_query($link,"select * from tbl_lemain where le_lotno='".$lotnonew."'") or die(mysqli_error($link)); 
		if($totisstbl=mysqli_num_rows($sqlisstbl)>0)
		{
			$rowisstbl=mysqli_fetch_array($sqlisstbl);
			$sqlsubsub1="UPDATE tbl_lemain SET le_duration='$leduration', le_upto='$ledate'  where le_lotno='$lotnonew' and le_stage='$txtstage'";
			mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
		}
		else
		{
			$sqlsubsub1="insert into tbl_lemain (le_lotno, le_stage, le_duration, le_upto) values( '$lotnonew' ,'$txtstage', '$leduration','$ledate' )";
			mysqli_query($link,$sqlsubsub1) or die(mysqli_error($link));
		}
		
		$sqlsubsub13="insert into tbl_learchive (lea_lotno, lea_stage, lea_duration, lea_upto, lea_date, lea_module, lea_logid) values( '$lotnonew' ,'$txtstage', '$leduration','$ledate', '$dt', 'QC Manager', '$logid' )";
		mysqli_query($link,$sqlsubsub13) or die(mysqli_error($link));
		?>
		<script>
		if(confirm("Do you wish to set soft release status for Blended Lots?")==true)
		{
			window.location='Lot_blend_SR.php?p_id=<?php echo $pid?>';	
		}
		else
		{
			window.location='home_merger.php';	
		}
		</script>
		<?php
		
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC Manager - Transction - Lot Blending - Preview</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="lotmerger.js"></script>
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

function openslocpopprint()
{

var pid=document.frmaddDept.pid.value;
winHandle=window.open('issue_merger_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
//alert('submit');
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	else if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	document.frmaddDept.submit();
	return true;	 
	}
	else
	{
	return false;
	}
}
function showledur(led)
{
	//alert(sdt);alert(led);
	var sdt=document.frmaddDept.sdate.value;
	var ledr=document.frmaddDept.leduration.value;
	if(ledr==0 || ledr=="")
	{
		alert("Invalid LE Duration");
		document.frmaddDept.leupto.value='';
	}
	else
	{
		showUser(ledr,'ledet','getledet',sdt,'','','');
	}
}
	
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" 

bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" 

align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" 

cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction - Lot Blending - Preview</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_blendm where blendm_id=$pid")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);
	$trid=$pid; 
	$drole=$row['blendm_logid'];
	$tdate=$row['blendm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input name="code" type="hidden" value="<?php echo $code;?>" />
	<input name="tid" type="hidden" value="<?php echo $tid;?>" />
	<input name="pid" type="hidden" value="<?php echo $pid;?>" />
	<input name="txtdate" type="hidden" value="<?php echo $tdate;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Blending</td>
</tr>
 

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TLB".$row['blendm_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Blending Request Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['blendm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);

$explotno='';
$sql_indent_sub6=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid'") or die(mysqli_error($link));
$row_indent_sub6=mysqli_fetch_array($sql_indent_sub6);
$explotno=$row_indent_sub6['blends_newlot'];
?>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $noticia_class['cropname'];?></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia_item['popularname'];?></td>
</tr>

<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['blendm_stage'];?><input type="hidden" name="txtstage" value="<?php echo $row['blendm_stage'];?>" /></td>
<td align="right"  valign="middle" class="tblheading">No. of Lots to be Blended&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['blendm_nolots'];?></td>
</tr>
<!--<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">New Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['blendm_newlot'];?></td>
</tr>-->
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Lot Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['blendm_lottype'];?><input type="hidden" name="lottype" value="<?php echo $row['blendm_lottype'];?>" /></td>

<td align="right" valign="middle" class="tblheading">Export Lot&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="lotnshow" >&nbsp;<?php if($row['blendm_lottype']=="Export"){echo $explotno;}?><input type="hidden" name="explotno" value="<?php echo $explotno;?>" /></td>

</tr>
</table>
</br>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <td  align="center" valign="middle" class="tblheading" >Blending Lots</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="17" rowspan="2"  align="center" valign="middle" class="smalltblheading">#</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
		<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
        <td width="64" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
		<td width="83" rowspan="2"  align="center" valign="middle" class="smalltblheading">SLOC</td>
		<td colspan="6"  align="center" valign="middle" class="smalltblheading">Quality Status</td>
		<td width="73" rowspan="2"  align="center" valign="middle" class="smalltblheading">Arrival Type</td>
		<td width="111" rowspan="2"  align="center" valign="middle" class="smalltblheading">Production Location</td>
		<td width="73" rowspan="2"  align="center" valign="middle" class="smalltblheading">Date of Harvest</td>
		<td width="73" rowspan="2"  align="center" valign="middle" class="smalltblheading">LE Duration &amp; Date</td>
		<td width="92" rowspan="2"  align="center" valign="middle" class="smalltblheading">Status</td>
	</tr>
	<tr class="tblsubtitle">
	  <td width="35"  align="center" valign="middle" class="smalltblheading">QC</td>
	  <td width="60"  align="center" valign="middle" class="smalltblheading">DoT</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">Germ %</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">GOT</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">DoGT</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">GOT Grade</td>
	</tr>
<?php
$grs=""; $drs=""; $grpflg=0; $delflg=0; $gflg=0; $nlotyrcode=''; $yrlist='';
$sql_sub=mysqli_query($link,"select distinct blends_group from tbl_blends where blendm_id='$trid' and blends_group>0 group by blends_group order by blends_group asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	if($grs!="")
		$grs=$grs.",".$row_sub['blends_group'];
	else
		$grs=$row_sub['blends_group'];	
	$sql_sub23=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and blends_group='".$row_sub['blends_group']."' order by blends_group asc") or die(mysqli_error($link));	
	if($tot_sub23=mysqli_num_rows($sql_sub23) == 1)$gflg++;
}
$sql_sub=mysqli_query($link,"select distinct blends_delflg from tbl_blends where blendm_id='$trid' and blends_delflg>0 group by blends_delflg order by blends_delflg asc") or die(mysqli_error($link));
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$drs=$row_sub['blends_delflg'];	
}


$sqleindentsub=mysqli_query($link,"select Max(blends_qty), blends_lotno from tbl_blends where blendm_id='$trid' and blends_group!=0 and blends_delflg=0") or die(mysqli_error($link));
$totrows=mysqli_num_rows($sqleindentsub);
$roweindentsub=mysqli_fetch_array($sqleindentsub);
//echo $roweindentsub['blends_lotno'];
$zzz5=str_split($roweindentsub['blends_lotno']);

$sql_yr=mysqli_query($link,"Select * from tblyears where ycode='".$zzz5[1]."'") or die(mysqli_error($link));
$row_yr=mysqli_fetch_array($sql_yr);

$nlotyrcode=$row_yr['years'];
$sr=1; $itmdchk=0; 
$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' order by blends_group asc, blends_lotno asc") or die(mysqli_error($link));
$tot_rows=mysqli_num_rows($sql_eindent_sub);
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0)$itmdchk++;

$subid=$row_eindent_sub['blends_id'];

$ltno=$row_eindent_sub['blends_lotno'];
$zzz=str_split($ltno);
$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];

$olot2=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12];

if($row_eindent_sub['blends_group']>0 && $row_eindent_sub['blends_delflg']==0)
{
	$sql_yr2=mysqli_query($link,"Select * from tblyears where ycode='".$zzz[1]."'") or die(mysqli_error($link));
	$row_yr2=mysqli_fetch_array($sql_yr2);
	
	if($yrlist!="")
	$yrlist=$yrlist.",".$row_yr2['years'];
	else
	$yrlist=$row_yr2['years'];
}

$ploc=""; $pdate="";
$sql_rr=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$noticia_class['cropname']."' and lotvariety='".$noticia_item['popularname']."' and SUBSTRING(orlot,1,13)='$olot2' order by orlot asc") or die(mysqli_error($link));
$tot_rr=mysqli_num_rows($sql_rr);
if($tot_rr > 0)
{
	$row_rr=mysqli_fetch_array($sql_rr);
	$ploc=$row_rr['ploc'];
	if($row_rr['lotstate']!="")
	$ploc=$ploc.", ".$row_rr['lotstate'];
	$rpdate=$row_rr['harvestdate'];
	$rpyear=substr($rpdate,0,4);
	$rpmonth=substr($rpdate,5,2);
	$rpday=substr($rpdate,8,2);
	$pdate=$rpday."-".$rpmonth."-".$rpyear;
	
	if($pdate=="00-00-0000" || $pdate=="--")$pdate="";	
}

$sql_is3=mysqli_query($link,"select lotldg_trtype from tbl_lot_ldg where  lotldg_crop='".$row['blendm_crop']."' and SUBSTRING(lotldg_lotno, 1,13)='".$olot2."' and lotldg_variety='".$row['blendm_variety']."' order by lotldg_id asc") or die(mysqli_error($link));
$row_is3=mysqli_fetch_array($sql_is3);
$trtype=$row_is3['lotldg_trtype'];

$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $dogt="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row['blendm_variety']."'  group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$row['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row['blendm_variety']."'  order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' and lotldg_balqty > 0 order by lotldg_id asc") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_istbl);
	if($t > 0)
	{
		while($row_issuetbl=mysqli_fetch_array($sql_istbl))
		{ 
			$qc=$row_issuetbl['lotldg_qc']; 
			$germ=$row_issuetbl['lotldg_gemp']; 
			$got1=split(" ",$row_issuetbl['lotldg_got1']);
			$got2=$row_issuetbl['lotldg_got']; 
			$got=$got1[0]." ".$got2;
			
			$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
			$totnob=$totnob+$row_issuetbl['lotldg_balbags'];		
			
			$rdate=$row_issuetbl['lotldg_qctestdate'];
			$ryear=substr($rdate,0,4);
			$rmonth=substr($rdate,5,2);
			$rday=substr($rdate,8,2);
			$dot=$rday."-".$rmonth."-".$ryear;
			
			$rgdate=$row_issuetbl['lotldg_gottestdate'];
			$rgyear=substr($rgdate,0,4);
			$rgmonth=substr($rgdate,5,2);
			$rgday=substr($rgdate,8,2);
			$dogt=$rgday."-".$rgmonth."-".$rgyear;
						
			if($dot=="00-00-0000" || $dot=="--")$dot="";	
			if($dogt=="00-00-0000" || $dogt=="--")$dogt="";	
			if($qc=="RT" || $qc=="UT")$dot="";
			if($got2=="RT" || $got2=="UT")$dogt="";
			if($germ<=0)$germ="";

			$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars']."/";
					
			$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname']."/";
						
			$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
						
			$slups=$row_issuetbl['lotldg_balbags'];
			$slqty=$row_issuetbl['lotldg_balqty'];
						 
			if($sloc!="")
				$sloc="<br />".$sloc.$wareh.$binn.$subbinn;
			else
				$sloc=$wareh.$binn.$subbinn;
			$cont++;
		}	
	}
}

if($trtype=="Fresh Seed with PDN")$trtype="Fresh Seed";

if($row_eindent_sub['blends_group']>0)$grpflg++;
if($row_eindent_sub['blends_delflg']>0)$delflg++;

$leupto=''; $dt='';	$dp1='';		

$sql_spc=mysqli_query($link,"select * from tbl_lemain where le_lotno='".$row_eindent_sub['blends_lotno']."'") or die(mysqli_error($link));
$row_spc=mysqli_fetch_array($sql_spc);
$xx=mysqli_num_rows($sql_spc);

if($xx == 0)
{	
	
	$dt=$noticia_item['leduration'];

	if($pdate!="")
	{
		$trdate2=explode("-",$pdate);
		$m=$trdate2[1];
		$de=$trdate2[0];
		$y=$trdate2[2];
		
		if($dt!="" && $dt>0)
		{
			for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
		}
		else
		{$dp1="";}
	}
	else
	{$dp1="";}
}
else
{
	$dt=$row_spc['le_duration'];
	$dp2=$row_spc['le_upto'];
	$dp1=$dp[2]."-".$dp[1]."-".$dp[0];
}	
$leupto=$dp1;


$gotgrade='';
$qry_tbl_gotgrade=mysqli_query($link,"select * from tbl_gotgrade where gotgrade_lotno='".$row_eindent_sub['lotldg_lotno']."'") or die(mysqli_error($link));
$tot_tbl_gotgrade=mysqli_num_rows($qry_tbl_gotgrade);	
$row_tbl_gotgrade=mysqli_fetch_array($qry_tbl_gotgrade);	
$gotgrade=$row_tbl_gotgrade['gotgrade_finalgrade'];

$qry_tbl_gottest=mysqli_query($link,"select * from tbl_gottest where gottest_lotno='".$row_eindent_sub['lotldg_lotno']."'") or die(mysqli_error($link));
$tot_tbl_gottest=mysqli_num_rows($qry_tbl_gottest);	
$row_tbl_gottest=mysqli_fetch_array($qry_tbl_gottest);	
if($row_tbl_gottest['grade']!='' && $row_tbl_gottest['grade']!=NULL && $row_tbl_gottest['grade']!='NULL')
{$gotgrade=$row_tbl_gottest['grade'];}
			
if($sr%2!=0)
{
?>		  
	<tr <? $zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") {echo "bgcolor='#EE9A4D'";} else if($mlot>=90000 && $llot!="00000") {if($trtype=="Merger")$trtype="SR Merger";echo "bgcolor='#FFE5B4'"; }else ""?> height="20" class="smalltbltext">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $germ?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dogt?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotgrade?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $trtype?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $pdate?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $leupto;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Open";  $gs=explode(",",$grs); foreach($gs as $val){ if($val<>""){  if($row_eindent_sub['blends_group']==$val) echo "Group ".$val; } } if($row_eindent_sub['blends_delflg']>0) echo "Deleted"; ?></td>
		
	</tr>

<?php
}
else
{
?>
	<tr <? $zz=str_split($row_eindent_sub['blends_lotno']);
$mlot=$zz[2].$zz[3].$zz[4].$zz[5].$zz[6];
$llot=$zz[8].$zz[9].$zz[10].$zz[11].$zz[12];
if($mlot>=90000 && $llot=="00000") {echo "bgcolor='#EE9A4D'";} else if($mlot>=90000 && $llot!="00000"){if($trtype=="Merger")$trtype="SR Merger";echo "bgcolor='#FFE5B4'"; } else ""?> height="20" class="smalltbltext">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ltno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sloc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dot?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $germ?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dogt?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotgrade?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $trtype?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $ploc?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $pdate?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $leupto;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0) echo "Open";  $gs=explode(",",$grs); foreach($gs as $val){ if($val<>""){  if($row_eindent_sub['blends_group']==$val) echo "Group ".$val; } } if($row_eindent_sub['blends_delflg']>0) echo "Deleted"; ?></td>
		</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
<input type="hidden" name="sr" value="<?php echo $sr;?>" />	
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
<input type="hidden" name="gflg" value="<?php echo $gflg;?>" />
</table>


<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
  <tr height="10"><td></td></tr>
  <tr height="20">

    <td width="647"  align="center" valign="middle" class="tblheading" >Blended Lot Arrival Year&nbsp;&nbsp;<select name="nlotyear" style="width:50px" >
		<?php
		
		$yrlist1=explode(",", $yrlist);
		$yrlist2=array_unique($yrlist1);
		foreach($yrlist2 as $nyrc)
		{
			if($nyrc<>"")
			{
			?> 
				<option value="<?php echo $nyrc;?>" <?php if($nlotyrcode==$nyrc){ echo "selected"; } ?> ><?php echo $nyrc;?></option>
			<?php
			}
		}
		?>
		</select>
		</td>
    <td width="30"  align="right" valign="middle" bgcolor="#EE9A4D" class="tblheading" >&nbsp;</td>
    <td width="80"  align="left" valign="middle" class="tblheading" >&nbsp;Blended Lot</td>
    <td width="15"  align="right" valign="middle" class="tblheading" >&nbsp;</td>
    <td width="30"  align="right" valign="middle" bgcolor="#FFE5B4" class="tblheading" >&nbsp;</td>
    <td width="148"  align="left" valign="middle" class="tblheading" >&nbsp;Sales Return Blended Lot</td>
  </tr>
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" /><input type="hidden" name="sdate" value="<?php echo date("d-m-Y"); ?>"  />
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<?php
$leupto=''; $dt='';	$dp1='';		
$pdate=date("d-m-Y");
$sql_spc=mysqli_query($link,"select * from tbl_lemain where le_lotno='".$row_eindent_sub['blends_lotno']."'") or die(mysqli_error($link));
$row_spc=mysqli_fetch_array($sql_spc);
$xx=mysqli_num_rows($sql_spc);
if($xx == 0)
{	
	$dt=$noticia_item['leduration'];

	if($pdate!="")
	{
		$trdate2=explode("-",$pdate);
		$m=$trdate2[1];
		$de=$trdate2[0];
		$y=$trdate2[2];
		
		if($dt!="" && $dt>0)
		{
			for($i=0; $i<=$dt; $i++) { $dp=explode("-",date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y))); $dp1=$dp[2]."-".$dp[1]."-".$dp[0];} 
		}
		else
		{$dp1="";}
	}
	else
	{$dp1="";}
}
else
{
	$dt=$row_spc['le_duration'];
	$dp2=$row_spc['le_upto'];
	$dp1=$dp[2]."-".$dp[1]."-".$dp[0];
}	
$leupto=$dp1;

?>
<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">Life Expectancy (LE) Duration&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  >&nbsp;<select name="leduration" class="tbltext" tabindex="0" style="width:40px;" onChange="showledur(this.value)"  > 
 <option value="">Select</option>
 <?php for($i=1; $i<36; $i++) {?>
 <option value="<?php echo $i;?>"><?php echo $i;?></option>
 <?php } ?>
 </select>&nbsp;Months</td>
 <td align="right"  valign="middle" class="tblheading">Life Expectancy (LE)&nbsp;</td>
  <td align="left"  valign="middle" class="tbltext" id="ledet" >&nbsp;<input type="text" name="leupto" id="leupto" class="tbltext" tabindex="0" readonly="true" value="<?php echo $leupto;?>" size="10" style="background-color:#CCCCCC" />&nbsp;&nbsp;From Authorization Date</td>
</tr></table>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="119" align="right"  valign="middle" class="smalltblheading">&nbsp;Requester Remarks&nbsp;</td>
<td width="825" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row['blendm_remarks'];?></td>
</tr></table><br />

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="119" align="right"  valign="middle" class="smalltblheading">&nbsp;QCM Remarks&nbsp;</td>
<td width="825" align="left"  valign="middle" class="smalltbltext">&nbsp;<?php echo $row['blendm_qcremarks'];?></td>
</tr></table>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_lotmerger.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onClick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onClick="mySubmit();"><img src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex=""  /></a>&nbsp;&nbsp;</td>
</tr>
</table></td><td width="30"></td>
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
