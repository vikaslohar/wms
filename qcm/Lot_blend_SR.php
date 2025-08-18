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
	
	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}

	if(isset($_POST['frm_action'])=='submit')
	{
		$foccode=trim($_POST['foccode']);
		$crop = $_POST['txtcrop'];	 
		$variety= $_POST['txtvariety'];
		$srtyp= $_POST['srtyp'];
		$tdate=date("Y-m-d");
		
		//exit;
		if($foccode!="")
		{
			$sql_code="SELECT MAX(softr_tcode) FROM tbl_softr  where yearcode='$yearid_id'  ORDER BY softr_tcode DESC";
			$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
			
			if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$txtid=$t_code+1;
			}
			else
			{
				$txtid=1;
			}
		
			$sql_srmain="Insert into tbl_softr (softr_tcode, softr_date, softr_crop, softr_variety, softr_typ, softr_wh, softr_bin, softr_subbin, yearcode) values('$txtid', '$tdate', '$crop', '$variety', 'sllot', '', '', '', '$yearid_id')";
			if(mysqli_query($link,$sql_srmain) or die(mysqli_error($link)))
			{
				$id=mysqli_insert_id($link);
				$lot1=explode(",", $foccode);
				
				for($i=0; $i<count($lot1); $i++)
				{
					if($lot1[$i]<>"")
					{
						$zzz=str_split($lot1[$i]);
						$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];
	
						$sql_srsub="Insert into tbl_softr_sub (softr_id, softrsub_lotno, softrsub_srtyp, softrsub_srflg) values('$id', '$olot', '$srtyp', '1')";
						$ss=mysqli_query($link,$sql_srsub) or die(mysqli_error($link));
						
						$sql_lotldg="update tbl_lot_ldg set lotldg_srtyp='$srtyp', lotldg_srflg='1' where orlot='".$olot."'";
						$zz=mysqli_query($link,$sql_lotldg)or die(mysqli_error($link));
					}
				}
			}
			$sql_code="SELECT MAX(softr_code) FROM tbl_softr  where yearcode='$yearid_id'  ORDER BY softr_code DESC";
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
	
			$sql_srmain="Update tbl_softr set softr_code='$code', softr_tflg='1' where softr_id='".$id."'";
			$xxxx=mysqli_query($link,$sql_srmain) or die(mysqli_error($link));
		}
		echo"<script>window.location='home_merger.php'</script>";	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality Manager - Transction - Lot Blending - SR Updation</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="issue.js"></script>
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
	var f=0; var j=0;
	document.frmaddDept.foccode.value="";
	if(document.frmaddDept.sr.value > 0)
	{
		if(document.frmaddDept.sr.value <= 2)
		{
			if(document.frmaddDept.srfet.checked == true)
			{  j++;
				if(document.frmaddDept.foccode.value =="")
				{
					document.frmaddDept.foccode.value=document.frmaddDept.srfet.value;
				}
				else
				{
					document.frmaddDept.foccode.value = document.frmaddDept.foccode.value +','+document.frmaddDept.srfet.value;
				}
			}
		}
		else
		{ 
			for (var i = 0; i < document.frmaddDept.srfet.length; i++) 
			{          
				if(document.frmaddDept.srfet[i].checked == true)
				{ j++;
					if(document.frmaddDept.foccode.value =="")
					{
					document.frmaddDept.foccode.value=document.frmaddDept.srfet[i].value;
					}
					else
					{
					document.frmaddDept.foccode.value = document.frmaddDept.foccode.value +','+document.frmaddDept.srfet[i].value;
					}
				}
			}
		}
	}
	
	//alert(j);
	if(document.frmaddDept.foccode.value=="")
	{
		if(confirm('You have not selected Lots to set Soft Release Status?\nDo You wish to Submit it?')==false)
		{
			f=1;
			return false;
		}
	}
	if(document.frmaddDept.foccode.value!="" && document.frmaddDept.srtyp.value=="")
	{
		alert("Please Select SR Type.");
		f=1;
		return false;
	}
	//alert(f);
	if(f==0)
	{
		return true;
	}
	else
	{
		return false;
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
          <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction - Lot Blending - SR Updation</td>
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
<td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Blending</td>
</tr>

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "LB".$row['blendm_code']."/".$yearid_id."/".$lgnid;?></td>

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
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden" name="txtcrop" value="<?php echo $row['blendm_crop'];?>" /></td>
<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" name="txtvariety" value="<?php echo $row['blendm_variety'];?>" /></td>
</tr>

<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['blendm_stage'];?></td>
<td align="right"  valign="middle" class="tblheading">No. of Lots to be Blended&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row['blendm_nolots'];?></td>
</tr>
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Lot Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['blendm_lottype'];?></td>

<td align="right" valign="middle" class="tblheading">Export Lot&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="lotnshow" >&nbsp;<?php if($row['blendm_lottype']=="Export"){echo $explotno;}?></td>

</tr>
</table>
</br>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="25">
    <td  align="center" valign="middle" class="tblheading" >Blending Details</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

	<tr class="tblsubtitle">
		<td width="17" rowspan="2"  align="center" valign="middle" class="smalltblheading">#</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Lot No.</td>
		<td width="35" rowspan="2" align="center" valign="middle" class="smalltblheading">NoB</td>
        <td width="64" rowspan="2" align="center" valign="middle" class="smalltblheading">Qty</td>
		<td width="83" rowspan="2"  align="center" valign="middle" class="smalltblheading">SLOC</td>
		<td colspan="5"  align="center" valign="middle" class="smalltblheading">Quality Status</td>
		<td width="102" rowspan="2"  align="center" valign="middle" class="smalltblheading">Blended Lot No.</td>
		<td width="45" rowspan="2"  align="center" valign="middle" class="smalltblheading">Total NoB</td>
		<td width="65" rowspan="2"  align="center" valign="middle" class="smalltblheading">Total Qty</td>
		<td width="110" rowspan="2"  align="center" valign="middle" class="smalltblheading">Soft Release</td>
	</tr>
	<tr class="tblsubtitle">
	  <td width="35"  align="center" valign="middle" class="smalltblheading">QC</td>
	  <td width="60"  align="center" valign="middle" class="smalltblheading">DoT</td>
	  <td width="47"  align="center" valign="middle" class="smalltblheading">Germ %</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">GOT</td>
	  <td width="64"  align="center" valign="middle" class="smalltblheading">DoGT</td>
	</tr>
<?php
$nolots=0;
$sql12=mysqli_query($link,"select * from tbl_blendm where blendm_id=$trid")or die(mysqli_error($link));
$row2=mysqli_fetch_array($sql12);
	
$classqry2=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row2['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class2=mysqli_fetch_array($classqry2);

$itemqry2=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row2['blendm_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item2=mysqli_fetch_array($itemqry2);



$grs=""; $drs=""; $grpflg=0; $delflg=0; $gflg=0;
$sql_sub=mysqli_query($link,"select distinct blends_group from tbl_blends where blendm_id='$trid' and blends_group>0 and blends_delflg=0 group by blends_group order by blends_group asc") or die(mysqli_error($link));
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

//echo $grs;
$sr=1; $itmdchk=0; 
$gs=explode(",",$grs); 
foreach($gs as $val)
{ 
if($val<>"")
{

$sdsd="";
if($row2['blendm_bflg']!=0) $sdsd=" and lotldg_trtype='Blending' ";

$lotnos=""; $qcss=""; $gotss=""; $dots=""; $gempss=""; $dgots=""; $artps=""; $plocss=""; $dohss=""; $statuses=""; $stss=""; $nlotno=""; $norlot=""; $slocss=""; $nobss=""; $qtyss=""; $tnob=0; $tqty=0; $slocss2=""; 

$sql_eindent_sub=mysqli_query($link,"select * from tbl_blends where blendm_id='$trid' and blends_group='$val' order by blends_group asc, blends_lotno asc") or die(mysqli_error($link));
$tot_rows=mysqli_num_rows($sql_eindent_sub);
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
if($row_eindent_sub['blends_group']==0 && $row_eindent_sub['blends_delflg']==0)$itmdchk++;

$subid=$row_eindent_sub['blends_id'];

$ltno=$row_eindent_sub['blends_lotno'];
$zzz=str_split($ltno);
$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];

$olot2=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12];

$ploc=""; $pdate="";
$sql_rr=mysqli_query($link,"select * from tblarrival_sub where lotcrop='".$noticia_class2['cropname']."' and lotvariety='".$noticia_item2['popularname']."' and SUBSTRING(orlot,1,13)='$olot2' order by orlot asc") or die(mysqli_error($link));
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

$sql_is3=mysqli_query($link,"select lotldg_trtype from tbl_lot_ldg where  lotldg_crop='".$row2['blendm_crop']."' and SUBSTRING(lotldg_lotno, 1,13)='".$olot2."' and lotldg_variety='".$row2['blendm_variety']."' order by lotldg_id asc") or die(mysqli_error($link));
$row_is3=mysqli_fetch_array($sql_is3);
$trtype=$row_is3['lotldg_trtype'];

$totnob=0; $totqty=0; $sloc="";  $qc=""; $dot=""; $germ=""; $dogt="";
$sql_is=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where lotldg_crop='".$row2['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row2['blendm_variety']."'  $sdsd group by lotldg_subbinid order by lotldg_id asc") or die(mysqli_error($link));
		
while($row_is=mysqli_fetch_array($sql_is))
{ 
	$slups=0; $slqty=0; $wareh=""; $binn=""; $subbinn="";
	$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_is['lotldg_subbinid']."' and lotldg_binid='".$row_is['lotldg_binid']."' and lotldg_crop='".$row2['blendm_crop']."' and lotldg_lotno='".$ltno."' and lotldg_variety='".$row2['blendm_variety']."'  $sdsd order by lotldg_id desc ") or die(mysqli_error($link));
	$row_is1=mysqli_fetch_array($sql_is1); 
				
	$sql_istbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_is1[0]."'  order by lotldg_id asc") or die(mysqli_error($link)); 
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
			
			if($row2['blendm_bflg']!=0)
			{
				$bgs=$row_issuetbl['lotldg_trbags'];
				$qts=$row_issuetbl['lotldg_trqty']; 
			}
			else
			{
				$bgs=$row_issuetbl['lotldg_balbags'];
				$qts=$row_issuetbl['lotldg_balqty']; 
			}
			$totqty=$totqty+$qts; 
			$totnob=$totnob+$bgs;		
			
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
						
			$slups=$bgs;
			$slqty=$qts;
						 
			if($sloc!="")
				$sloc=$sloc."<br />".$wareh.$binn.$subbinn;
			else
				$sloc=$wareh.$binn.$subbinn;
			$cont++;
		}	
	}
}

if($trtype=="Fresh Seed with PDN")$trtype="Fresh Seed";

if($row_eindent_sub['blends_group']>0)$grpflg++;
if($row_eindent_sub['blends_delflg']>0)$delflg++;

$stss2=0;
$stss="Group ".$row_eindent_sub['blends_group'];
$stss2=$row_eindent_sub['blends_delflg'];
$nlotno=$row_eindent_sub['blends_newlot'];
$norlot=$row_eindent_sub['blends_orlot'];

if($lotnos!="") $lotnos=$lotnos."<br />".$ltno; else $lotnos=$ltno;
if($qcss!="") $qcss=$qcss."<br />".$qc; else $qcss=$qc;
if($gotss!="") $gotss=$gotss."<br />".$got; else $gotss=$got;
if($dots!="") $dots=$dots."<br />".$dot; else $dots=$dot;
if($gempss!="") $gempss=$gempss."<br />".$germ; else $gempss=$germ;
if($dgots!="") $dgots=$dgots."<br />".$dogt; else $dgots=$dogt;
if($artps!="") $artps=$artps."<br />".$trtype; else $artps=$trtype;
if($plocss!="") $plocss=$plocss."<br />".$ploc; else $plocss=$ploc;
if($dohss!="") $dohss=$dohss."<br />".$pdate; else $dohss=$pdate;
if($slocss!="") $slocss=$sloc; else $slocss=$sloc;
if($nobss!="") $nobss=$nobss."<br />".$totnob; else $nobss=$totnob;
if($qtyss!="") $qtyss=$qtyss."<br />".$totqty; else $qtyss=$totqty;

$tnob=$tnob+$totnob;
$tqty=$tqty+$totqty;
}	
$sq_sub=mysqli_query($link,"Select * from tbl_blendss where blendm_id='$trid' and blendss_newlot='$nlotno'") or die(mysqli_error($link));
while($ro_sub=mysqli_fetch_array($sq_sub))
{ 
$sql_whouse2=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$ro_sub['blendss_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse2=mysqli_fetch_array($sql_whouse2);
$wareh2=$row_whouse2['perticulars']."/";
					
$sql_binn2=mysqli_query($link,"select binname from tbl_bin where binid='".$ro_sub['blendss_binid']."' and whid='".$ro_sub['blendss_whid']."'") or die(mysqli_error($link));
$row_binn2=mysqli_fetch_array($sql_binn2);
$binn2=$row_binn2['binname']."/";
					
$sql_subbinn2=mysqli_query($link,"select sname from tbl_subbin where sid='".$ro_sub['blendss_subbinid']."' and binid='".$ro_sub['blendss_binid']."' and whid='".$ro_sub['blendss_whid']."'") or die(mysqli_error($link));
$row_subbinn2=mysqli_fetch_array($sql_subbinn2);
$subbinn2=$row_subbinn2['sname'];
					 
if($slocss2!="")
	$slocss2="<br />".$slocss2.$wareh2.$binn2.$subbinn2;
else
	$slocss2=$wareh2.$binn2.$subbinn2;
}				
$nolots++;				
//echo $nolots;		
if($sr%2!=0)
{
?>		  
	<tr height="20" class="light">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $lotnos?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nobss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qtyss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qcss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gempss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dgots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nlotno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="srfet" id="srfet<?php echo$sr;?>" value="<?php echo $nlotno?>" /></td>
	</tr>

<?php
}
else
{
?>
	<tr height="20" class="light">
		<td align="center" valign="middle" class="smalltbltext"><?php echo $sr;?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $lotnos?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nobss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qtyss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $slocss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $qcss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gempss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $gotss?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $dgots?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $nlotno?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tnob?></td>
		<td align="center" valign="middle" class="smalltbltext"><?php echo $tqty?></td>
		<td align="center" valign="middle" class="smalltbltext"><input type="checkbox" name="srfet" id="srfet<?php echo$sr;?>" value="<?php echo $nlotno?>" /></td>
</tr>
<?php 
}
$sr=$sr+1;	
//}
}
}
?>	
<tr height="20" class="light">
<td align="right" valign="middle" class="smalltbltext" colspan="12">&nbsp;</td>
<td align="center" valign="middle" class="smalltblheading">SR Type</td>
<td align="center" valign="middle" class="smalltbltext"><select class="tbltext" id="srtyp" name="srtyp" style="width:80px;" >
<option value="" selected>--Select--</option>
<option value="pack">Pack</option>
<option value="dispatch">Dispatch</option>
</select>&nbsp;<font color="#FF0000"> *</font></td>
</tr>
<input type="hidden" name="sr" value="<?php echo $sr;?>" />	
<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
<input type="hidden" name="gflg" value="<?php echo $gflg;?>" />
</table>

<input type="hidden" name="foccode" value="" />
<input type="hidden" name="nolots" value="<?php echo $nolots;?>" />
<input type="hidden" name="trid" value="<?php echo $trid?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtrid?>" />
<br />
<div id="subdiv" style="display:block"></div>
</div>
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
<td valign="top" align="right"><a href="home_merger.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
