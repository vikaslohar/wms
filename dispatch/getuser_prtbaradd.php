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
  
	if(isset($_GET['tp']))
	{ 
		$dnobarc = $_GET['tp'];	 
	}
	if(isset($_GET['ltno']))
	{
		$dltno = $_GET['ltno'];	 
	}
	if(isset($_GET['dtrid']))
	{
		$dtrid = $_GET['dtrid'];	 
	}
	if(isset($_GET['eups']))
	{
		$deups = $_GET['eups'];	 
	}
	
	$dtid=$dtrid;
	
if(isset($_POST['frm_action'])=='submit')
{
	//exit;
   	$txt14=trim($_POST['txt14']);
	$totnobarcs=trim($_POST['totnobarcs']);
	//echo $totbarcs=trim($_POST['totbarcs']);
	if($txt14==1)
	{
	?>
		<script>
		opener.document.frmaddDepartment.nbarallval.value=<?php echo $totnobarcs?>;
		//opener.document.frmaddDepartment.nbarallnos.value=<?php echo $totbarcs?>;
		self.close();
		</script>
	<?php
	}
	else
	{
		$sq60=mysqli_query($link,"Select * from tbl_dallocbarc_temp where plantcode='".$plantcode."' and  plantcode='".$plantcode."' and  dalloc_id='$dtrid' and barc_lotno='$dltno' and barc_logid='$logid' and barc_yearcode='$yearid_id'") or die(mysqli_error($link));
		while($ro60=mysqli_fetch_array($sq60))
		{
			$barc=$ro60['barc_barcode'];
			$s_sub="delete from tbl_dallocbarc_temp where barc_barcode='".$barc."'";
			mysqli_query($link,$s_sub) or die(mysqli_error($link));
			
			$sqlb1="update tbl_mpmain set mpmain_alflg=0 where mpmain_barcode='".$barc."'";
			$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));
		}
		echo "<script>
		opener.document.frmaddDepartment.nbarallval.value=0;
		self.close();
		</script>";	
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch - Allocation - Barcode Scanning</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<script src="dispallocate.js"></script>
<script language="javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}

function chkbarcode(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtdelbarcod";
	document.getElementById(txtbarcode).value=mltval;
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		if(document.frmaddDepartment.totbarcs.value!="")
		{
			var totbarcs=document.frmaddDepartment.totbarcs.value.split(",");
			var x=0;
			for(var i=0; i<totbarcs.length; i++)
			{
				if(totbarcs[i]==document.getElementById(txtbarcode).value)
				{
					x++;
				}
			}
			if(x==0)
			{
				alert("Barcode "+mltval+" cannot be Deleted/Unloaded.\n\nReason: Barcode not Loaded in this Transaction");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
	}
	if(flg==0)
	{
		if(confirm("Do You want to Unallocate/Delete this barcode "+mltval)==true)
		{
			var trid=document.frmaddDepartment.maintrid.value;
			var ver=document.frmaddDepartment.txtevariety.value;
			var ups=document.frmaddDepartment.txteups.value;
			var mchksel=document.frmaddDepartment.txtelotno.value;
			var upstyp='';
			showUser(mltval,'mbarpostingtable','bardetupdate',trid,ver,ups,mchksel,upstyp)
		}
		/*var trid=document.frmaddDepartment.maintrid.value;
		var ver=document.frmaddDepartment.txtevariety.value;
		var ups=document.frmaddDepartment.txteups.value;
		var mchksel=document.frmaddDepartment.txtelotno.value;
		var upstyp='';
		showUser(mltval,'mbarpostingtable','bardet',trid,subtrid,subsubtrid,mchksel,upstyp)
		showUser(bardet,'barchk','barchk1',mltval,trid,ver,ups,mchksel,upstyp)
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showdmode('+mltval+')', 800);*/
		
	}
}

/*function showdmode(mltval)
{
	if(confirm("Do You want to Unload/Delete this barcode "+mltval)==true)
	{
		var trid=document.frmaddDepartment.maintrid.value;
		var ver=document.frmaddDepartment.txtevariety.value;
		var ups=document.frmaddDepartment.txteups.value;
		var mchksel=document.frmaddDepartment.txtelotno.value;
		var upstyp='';
		showUser(mltval,'mbarpostingtable','bardetupdate',trid,subtrid,subsubtrid,mchksel,upstyp)
	}
	else
	{
		document.frmaddDepartment.delbarcode.value="";
		document.frmaddDepartment.barcode.focus();
		document.getElementById('txtbarcod').focus();
	}
}*/

function chkbarcode1(mltval)
{
	var flg=0;
	/*if(document.frmaddDepartment.mchksel.value==0 || document.frmaddDepartment.mchksel.value=="")
	{
		var txtbarcode="txtbarcod";
		alert("Please Select Order Item first.");
		document.getElementById(txtbarcode).focus();
		document.getElementById(txtbarcode).value=".";
		document.getElementById(txtbarcode).value="";
		flg=1;
		return false;
	}
	else if(document.frmaddDepartment.txtnomp.value==0 || document.frmaddDepartment.txtnomp.value=="")
	{
		var txtbarcode="txtbarcod";
		alert("To Load NoMP cannot be Blank OR ZERO.");
		document.frmaddDepartment.txtnomp.focus();
		document.getElementById(txtbarcode).value=".";
		document.getElementById(txtbarcode).value="";
		flg=1;
		return false;
	}
	else if(document.frmaddDepartment.txttlonomp.value==0 || document.frmaddDepartment.txttlonomp.value=="")
	{
		var txtbarcode="txtbarcod";
		alert("Loading Completed for Selected Line Item.\n\n Clik on Next to select new Line Item in Pending Order(s) in Progress\n\nOR\n\nIncrease the value in To Load NoMP");
		document.frmaddDepartment.txtnomp.focus();
		document.getElementById(txtbarcode).value=".";
		document.getElementById(txtbarcode).value="";
		flg=1;
		return false;
	}
	else*/
	{
		if(parseInt(document.frmaddDepartment.totnobarcs.value)>=parseInt(document.frmaddDepartment.totenomp.value))
		{
			alert("Cannot Allocate Barcode. Total No. of required Barcodes has been Allocated.");
			fl=1;
			return false;
		}	
		mltval=mltval.toUpperCase();
		var txtbarcode="txtbarcod";
		document.getElementById(txtbarcode).value=mltval;
		if(mltval.length < 11)
		{
			alert("Invalid Barcode. Barcode cannot be less than 11 digit");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		else
		{
			var z=mltval.split("");
			var a=z[0];
			var b=z[1];
			if(isChar_o(a)==false)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
			if(isChar_o(b)==false)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
			for(var i=2; i<z.length; i++)
			{
				if(isChar_o(z[i])==true)
				{
					alert("Invalid Barcode");
					document.getElementById(txtbarcode).value="";
					document.getElementById(txtbarcode).focus();
					flg=1;
					return false;
				}
			}
			if(document.frmaddDepartment.totbarcs.value!="")
			{
				var totbarcs=document.frmaddDepartment.totbarcs.value.split(",");
				var x=0;
				for(var i=0; i<totbarcs.length; i++)
				{
					if(totbarcs[i]==document.getElementById(txtbarcode).value)
					{
						x++;
					}
				}
				if(x>0)
				{
					alert("Duplicate Barcode.");
					document.getElementById(txtbarcode).value="";
					document.getElementById(txtbarcode).focus();
					flg=1;
					return false;
				}
			}
		}
		if(flg==0)
		{
			var bardet='';
			var trid=document.frmaddDepartment.maintrid.value;
			var ver=document.frmaddDepartment.txtevariety.value;
			var ups=document.frmaddDepartment.txteups.value;
			var mchksel=document.frmaddDepartment.txtelotno.value;
			var upstyp='';
			showUser(bardet,'barchk','barchk1',mltval,trid,ver,ups,mchksel,upstyp)
			mltval="'"+mltval+"'";
			//alert(mltval);
			setTimeout('showpmode('+mltval+')', 1000);
			
		}
	}
}

function showpmode(mltval)
{
	var bardet='';
	var trid=document.frmaddDepartment.maintrid.value;
	var ver=document.frmaddDepartment.txtevariety.value;
	var ups=document.frmaddDepartment.txteups.value;
	var mchksel=document.frmaddDepartment.txtelotno.value;
	var upstyp='';
	var brflg=document.frmaddDepartment.brflg.value;
	var upstyp='';
	if(document.frmaddDepartment.brchflg.value==0)
	{
		showUser(bardet,'barchk','barchk1',mltval,trid,ver,ups,mchksel,upstyp)
		mltval="'"+mltval+"'";
		//alert(mltval);
		setTimeout('showpmode('+mltval+')', 1500);
	}
	else
	{
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==0)
		{
			pform();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
		else
		{
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==1)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode not present in System");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==2)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Dispatched");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==3)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Loaded in current OR other Operator's Transaction");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==4)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Variety not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==5)
			{
				alert("Barcode cannot be Allocated.\n\nReason: UPS not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==6)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Lot's current QC/GOT Status is FAIL");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==7)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Lot's current QC/GOT Status is UT and Soft Release is not activated");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==8)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==9)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Barcode is already Unpackaged");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==10)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Lot is under Reserve Status");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==11)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Allocated");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==12)
			{
				alert("Barcode cannot be Allocated. Reason: Lot no. not matching with selected Barcode");
			}
			
			//pform();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
	}
}

function pform()
{	
	var fl=0;	
	if(parseInt(document.frmaddDepartment.totnobarcs.value)>=parseInt(document.frmaddDepartment.totenomp.value))
	{
		alert("Cannot Allocate Barcode. Total No. of required Barcodes has been Allocated.");
		fl=1;
		return false;
	}	
	
	if(fl==1)
	{
		return false;
	}
	else
	{
		
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==0)
		{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'mbarpostingtable','mformbar','','','','','');
			document.frmaddDepartment.barcode.focus();
			setTimeout('barfocus()',400);
			document.getElementById('txtbarcod').focus();
			document.getElementById('txtbarcod').focus();
		}
		else
		{
			return false;
		}
	}  
}

function barfocus()
{
	if(document.getElementById('txtbarcod').value=="done" || document.getElementById('txtbarcod').value=="")
	{
		document.getElementById('txtbarcod').focus(); 
		document.getElementById('txtbarcod').scrollIntoView();
		document.getElementById('txtbarcod').value="";
	}
}
function onloadfocus()
{
	document.getElementById('txtbarcod').focus();
}
function barc_calcel(bval)
{
	document.frmaddDepartment.txt14.value=bval;
	document.frmaddDepartment.submit();
	return true;
}

function mySubmit()
{
	if(document.frmaddDepartment.totenomp.value!=document.frmaddDepartment.totnobarcs.value)
	{
		alert("Total No. of required Barcodes has not been Allocated.");
		return false;
	}
	else
	{
		document.frmaddDepartment.submit();
		return true;
	}
}

</script>
<body onLoad="onloadfocus()">

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr>
<td align="center">
<?php
$alt=$dltno.",";
$altn=explode(",",$alt);
$xt=0; $nlt="";
foreach($altn as $atn)
{ if($atn<>""){$xt++; if($nlt!="")$nlt=$nlt.","."'$atn'";else $nlt="'$atn'";}}
//echo $nlt;

if($xt>1)
$sql_lot2=mysqli_query($link,"Select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno IN ($nlt) and packtype='$deups' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
else
$sql_lot2=mysqli_query($link,"Select MAX(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='$dltno' and packtype='$deups' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
$tot_lot2=mysqli_num_rows($sql_lot2);
$row_lot2=mysqli_fetch_array($sql_lot2);

$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1  and lotldg_rvflg=0 and lotldg_dispflg!=1 and lotldg_spremflg=0") or die(mysqli_error($link));
$tot_lot=mysqli_num_rows($sql_lot);
$row_lot=mysqli_fetch_array($sql_lot);
$row_lot['lotldg_variety'];
?>  
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"  >  
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="txt14" value="1" type="hidden"> 
	<input type="hidden" name="maintrid" value="<?php echo $dtrid?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input type="hidden" name="txtevariety" value="<?php echo $row_lot['lotldg_variety']?>" />
	<input type="hidden" name="txteups" value="<?php echo $deups?>" />
	<input type="hidden" name="totenomp" value="<?php echo $dnobarc?>" />
	<input type="hidden" name="txtelotno" value="<?php echo $dltno?>" />
<div id="mbarpostingtable" style="display:block">
<?php
if($dnobarc!="")
{
?>	
<div id="barupdetails" >
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Latest Barcode View</td>
</tr>
<tr class="Light" height="25">
	<!--<td width="20" align="center" class="smalltblheading">#</td>-->
	<td width="96" align="center" class="smalltblheading">Barcode</td>
	<td width="96" align="center" class="smalltblheading">Crop</td>
	<td width="130" align="center" class="smalltblheading">Variety</td>
	<td width="89" align="center" class="smalltblheading">UPS</td>
	<td width="102" align="center" class="smalltblheading">Lot No.</td>
	<!--<td width="40" align="center" class="smalltblheading">NoMP</td>-->
	<td width="67" align="center" class="smalltblheading">QC Status</td>
	<td width="90" align="center" class="smalltblheading">DoT</td>
	<td width="90" align="center" class="smalltblheading">DoV</td>
	<td width="80" align="center" class="smalltblheading">Net Weight</td>
	<td width="88" align="center" class="smalltblheading">Gross Weight</td>
	<!--<td width="119" align="center" class="smalltblheading">SLOC</td>
	<td colspan="2" align="center" class="smalltblheading">Allocate</td>-->
</tr>
<?php 
$sno=1; $barcode=""; $foccod="";
$sq6=mysqli_query($link,"Select * from tbl_dallocbarc_temp where plantcode='".$plantcode."' and  dalloc_id='$dtid' and barc_lotno='$dltno' and barc_logid='$logid' and barc_yearcode='$yearid_id'") or die(mysqli_error($link));
$to6=mysqli_num_rows($sq6);
if($to6 > 0)
{
while($ro6=mysqli_fetch_array($sq6))
{
	$packtype2=$ro6['barc_packtype']; 
	$barcode=$ro6['barc_barcode']; 
	$grwts2=$ro6['barc_grosswt']; 
	$nqty6=$ro6['barc_wtmp'];
	
	if($foccod!="")
	$foccod=$foccod.",".$barcode;
	else
	$foccod=$barcode;
	
	if($packtype2=="PACKSMC" || $packtype2=="PACKNMC")
	{
		$crps=""; $vers=""; $dov=""; $dot=""; $qc=""; $upss2="";
		$lot6=$ro6['barc_lotno']; 
		$crps2=$ro6['barc_crop']; 
		$vers2=$ro6['barc_variety']; 
		$upss2=$ro6['barc_ups']; 
		$dovs2=$ro6['barc_dov']; 
		$qcss2=$ro6['barc_qc']; 
		$dots2=$ro6['barc_dot'];
		 
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps2'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$crps=$row_dept5['cropname'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers2' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vers=$row_dept4['popularname'];
			
		$tdate=$dovs2;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dov=$tday."-".$tmonth."-".$tyear;
		
		$tdate=$dots2;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dot=$tday."-".$tmonth."-".$tyear;
	}
	else if($packtype2=="PACKLMC" || $packtype2=="PACKNLC")
	{
		$crps=""; $vers=""; $dov=""; $dot=""; $qc=""; $upss2=""; 
		$crps2=$ro6['barc_crop']; 
		$vers2=$ro6['barc_variety']; 
		$upss2=$ro6['barc_ups'];
		
		$lot60=$ro6['barc_lotno']; 
		$dovs2=$ro6['barc_dov']; 
		$qcss2=$ro6['barc_qc']; 
		$dots2=$ro6['barc_dot'];
		
		$lotno="";
		$lotn=explode(",",$lot60);
		$dovs24=explode(",",$dovs2);
		$qcss24=explode(",",$qcss2);
		$qcss2=implode("<br/>",$qcss24);
		$dots24=explode(",",$dots2);
		foreach($lotn as $ltn)
		{
			if($ltn<>"")
			{
				if($lotno!="")
					$lotno=$lotno."<br/>".$ltn;
				else
					$lotno=$ltn;
			}
		}
		$lot6=$lotno;
		$ltnp=explode(",",$row_barcode1['mpmain_lotnop']);
		foreach($ltnp as $ltnop)
		{
			if($ltnop<>"")
			{
				$xc=explode(" ",$row_barcode1['mpmain_upssize']);
				if($xc[1]=="Gms")
				{
					$ptp=$xc[0]/1000;
				}
				else
				{
					$ptp=$xc[0];
				}
				$qt=$ptp*$ltnop;
				
				if($qty!="")
					$qty=$qty."<br/>".$qt;
				else
					$qty=$qt;
			}
		}
		


		 
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps2'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$crps=$row_dept5['cropname'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers2' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vers=$row_dept4['popularname'];
		
		foreach($dovs24 as $dov24)
		{
			if($dov24<>"")
			{	
				$tdate=$dov24;
				$tyear=substr($tdate,0,4);
				$tmonth=substr($tdate,5,2);
				$tday=substr($tdate,8,2);
				$dov2=$tday."-".$tmonth."-".$tyear;
				
				if($dov!="")
				$dov=$dov."<br/>".$dov2;
				else
				$dov=$dov2;
				
			}
		}	
		foreach($dots24 as $dot24)
		{
			if($dot24<>"")
			{	
				$tdate=$dot24;
				$tyear=substr($tdate,0,4);
				$tmonth=substr($tdate,5,2);
				$tday=substr($tdate,8,2);
				$dot2=$tday."-".$tmonth."-".$tyear;
				
				if($dot!="")
				$dot=$dot."<br/>".$dot2;
				else
				$dot=$dot2;
			}
		}	
	}
	else if($packtype2=="PACKMMC")
	{
		$lot6=$ro6['barc_lotno']; 
		$crps2=$ro6['barc_crop']; 
		$vers2=$ro6['barc_variety']; 
		$upss2=$ro6['barc_ups']; 
		$dovs2=$ro6['barc_dov']; 
		$qcss2=$ro6['barc_qc']; 
		$dots2=$ro6['barc_dot']; 
		$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps2'"); 
		$row_dept5=mysqli_fetch_array($quer5);
		$crps=$row_dept5['cropname'];
		$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers2' and actstatus='Active'"); 
		$row_dept4=mysqli_fetch_array($quer4);
		$vers=$row_dept4['popularname'];
			
		$tdate=$dovs2;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dov2=$tday."-".$tmonth."-".$tyear;
		
		$tdate=$dots2;
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$dot2=$tday."-".$tmonth."-".$tyear;
	}
	else
	{
	
	}
	
?>
<tr class="Dark" height="30">
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $crps;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $vers?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $upss2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lot6?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcss2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nqty6;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grwts2;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php
$sno++;
}
}
else
{
$sqlbarc1=mysqli_query($link,"Select * from tbl_mpmain where mpmain_barcode='".$barcode."'") or die(mysqli_error($link));
$totbarc1=mysqli_num_rows($sqlbarc1);
$rowbarc1=mysqli_fetch_array($sqlbarc1);
if($totbarc1>0)
{
	$sqlbarcode=mysqli_query($link,"Select bar_grosswt from tbl_barcodes where bar_barcode='".$barcode."'") or die(mysqli_error($link));
	$totbarcode=mysqli_num_rows($sqlbarcode);
	$rowbarcode=mysqli_fetch_array($sqlbarcode);
	$grwts2=$rowbarcode['bar_grosswt'];
	
	$lotno=$rowbarc1['mpmain_lotno'];
	$vr1=$rowbarc1['mpmain_variety'];
	$ui1=$rowbarc1['mpmain_upssize'];
	$nqty6=$rowbarc1['mpmain_wtmp'];
	
	
	$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where lotno='$lotno' and packtype='$ui1' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
	$tot_lot2=mysqli_num_rows($sql_lot2);
	$row_lot2=mysqli_fetch_array($sql_lot2);
	
	$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1") or die(mysqli_error($link));
	$tot_lot=mysqli_num_rows($sql_lot);
	$row_lot=mysqli_fetch_array($sql_lot);
	
	$qcss2=$row_lot['lotldg_qc'];
	$vers=$row_lot['lotldg_variety'];
	$crps=$row_lot['lotldg_crop'];
	
	$quer5=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$crps'"); 
	$row_dept5=mysqli_fetch_array($quer5);
	$cps2=$row_dept5['cropname'];
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$vers' and actstatus='Active'"); 
	$row_dept4=mysqli_fetch_array($quer4);
	$vts2=$row_dept4['popularname'];
			
	$tdate=$row_lot['lotldg_valupto'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dov2=$tday."-".$tmonth."-".$tyear;
	
	$tdate=$row_lot['lotldg_qctestdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$dot2=$tday."-".$tmonth."-".$tyear;
?>
<tr class="Dark" height="30">
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sno;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $barcode;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $cps2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $vts2?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $ui1?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $nob;?></td>-->
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $qcss2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dot2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $dov2;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $nqty6;?></td>
	<td align="center"  valign="middle" class="smalltbltext"><?php echo $grwts2;?></td>
	<!--<td align="center"  valign="middle" class="smalltbltext"><?php echo $sloc;?></td>-->
</tr>
<?php	
}
}

if($brflg!=0)
{
	if($brflg==1)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Barcode not present in System";
	if($brflg==2)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Barcode already Dispatched";
	if($brflg==3)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Barcode already Loaded in current OR other Operator's Transaction";
	if($brflg==4)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Variety not matching with Selected Line Item in Consolidated Pending Orders";
	if($brflg==5)
	$msgs="Barcode $barcode cannot be Allocated. Reason: UPS not matching with Selected Line Item in Consolidated Pending Orders";
	if($brflg==6)
	$msgs="Barcode $barcode cannot be Allocated. Reason: This Lot's current QC/GOT Status is FAIL";
	if($brflg==7)
	$msgs="Barcode $barcode cannot be Allocated. Reason: This Lot's current QC/GOT Status is UT and Soft Release is not activated";
	if($brflg==8)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date";
	if($brflg==9)
	$msgs="Barcode $barcode cannot be Allocated. Reason: This Barcode is already Unpackaged";
	if($brflg==10)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Lot is under Reserve Status";
	if($brflg==11)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Barcode already Allocated";
	if($brflg==12)
	$msgs="Barcode $barcode cannot be Allocated. Reason: Lot no. not matching with selected Barcode";
	
?>
<tr class="Dark" height="30">
	<td align="center"  valign="middle" class="tblheading" colspan="10"><font color="#FF0000"><?php echo $msgs;?></font></td>
</tr>
<?php
}
?>
<input type="hidden" name="totbarcs" id="totbarcs" value="<?php echo $foccod;?>" /><input type="hidden" name="totnobarcs" id="totnobarcs" value="<?php echo $to6;?>" />
</table>
</div>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Enter Barcode for Loading</td></tr>
<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Scan Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" tabindex="0" value="" /></td></tr>
</table><br />
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center"  valign="middle" class="tblheading" colspan="4">Delete Barcode during In-Progress Loading (Unloading)</td> </tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Delete Barcode&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="delbarcode" id="txtdelbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode(this.value)" tabindex="1" />&nbsp;<font color="#FF0000">*  Deleted Barcode will be stored back to its original SLOC Bin</font></td></tr>
</table><br />
</div>

<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/cancel.gif" border="0" onClick="barc_calcel('2')" target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/submit.gif" border="0"style="display:inline;cursor:Pointer;" onClick="return mySubmit();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php	
}
else
{
?>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr class="tblsubtitle">
<td align="center" class="tblheading" colspan="3">For Bin Shifting you need Master Packs (Barcodes), which you have not selected/entered.</td>
</tr>
<tr >
<td align="right" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" class="butn" style="cursor:pointer" /></td>
</tr>
</table>
<?php	
}
?>
</form>
</td> 
</tr>
</table>
</body>
</html>
