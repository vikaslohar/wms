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

	if(isset($_REQUEST['sbinval']))
	{
		$sbinval = $_REQUEST['sbinval'];
	}
	if(isset($_REQUEST['txtpsrn']))
	{
		$txtpsrn = $_REQUEST['txtpsrn'];
	}
	if(isset($_REQUEST['crop']))
	{
		$crop = $_REQUEST['crop'];
	}
	if(isset($_REQUEST['variety']))
	{
		$variety = $_REQUEST['variety'];
	}
	if(isset($_REQUEST['upsval']))
	{
		$upsval = $_REQUEST['upsval'];
	}
	if(isset($_REQUEST['trid']))
	{
		$trid = $_REQUEST['trid'];
	}
	if(isset($_REQUEST['slocssyncs']))
	{
		$slocssyncs = $_REQUEST['slocssyncs'];
	}
	if(isset($_REQUEST['onop']))
	{
		$onop = $_REQUEST['onop'];
	}
	if(isset($_REQUEST['oqty']))
	{
		$oqty = $_REQUEST['oqty'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
		//$barcode=trim($_POST['barcode']);
		$postval=trim($_POST['postval']);
		if($postval=="submittrn")
		{
			$sqlm=mysqli_query($link,"Select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn'") or die(mysqli_error($link));
			while($rowm=mysqli_fetch_array($sqlm))
			{
				$ttrid=$rowm['btsl_id'];
				$sql_btsls="update tbl_srbtslsub set btslsub_lnkflg=1 where btsl_id='$ttrid' and btslsub_lnkflg=2";
				$xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link));
			}	
			?>
				<script>window.opener.showverifysc('<?php echo $_REQUEST['txtpsrn'];?>','<?php echo $_REQUEST['crop'];?>','<?php echo $_REQUEST['variety'];?>','<?php echo $_REQUEST['upsval'];?>','<?php echo $_REQUEST['onop'];?>','<?php echo $_REQUEST['oqty'];?>');window.close();</script>
			<?php
		}
		else if($postval=="canceltrn")
		{
			$sqlm=mysqli_query($link,"Select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn'") or die(mysqli_error($link));
			while($rowm=mysqli_fetch_array($sqlm))
			{
				$ttrid=$rowm['btsl_id'];
				$sqls=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_lnkflg=2 and btsl_id='$ttrid'") or die(mysqli_error($link));
				if($tots=mysqli_num_rows($sqls)>0)
				{
					while($rows=mysqli_fetch_array($sqls))
					{
						$suid=$rows['btslsub_id'];
						$sql_btslss="update tbl_srbtslsub_sub2 set btslss_lotno='NULL', btslss_ups='NULL', btslss_qtympt='NULL', btslss_nopmpt='NULL', btslss_qcstatus='NULL', btslss_dot='NULL', btslss_gottype='NULL', btslss_gotstatus='NULL', btslss_dogt='NULL', btslss_gemp='NULL', btslss_moist='NULL', btslss_pp='NULL', btslss_dop='NULL', btslss_dov='NULL' where btsl_id='$ttrid' and btslsub_id='$suid'";
						$xcxcs=mysqli_query($link,$sql_btslss) or die(mysqli_error($link));
					}
				}	
				$sql_btsls="update tbl_srbtslsub set btslsub_lnkflg=0 where btsl_id='$ttrid' and btslsub_lnkflg=2";
				$xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link));
			}	
			?>
				<script>window.opener.showverifysc('<?php echo $_REQUEST['txtpsrn'];?>','<?php echo $_REQUEST['crop'];?>','<?php echo $_REQUEST['variety'];?>','<?php echo $_REQUEST['upsval'];?>','<?php echo $_REQUEST['onop'];?>','<?php echo $_REQUEST['oqty'];?>');window.close();</script>
			<?php
		}
		else
		{
			?>
				<script>window.opener.showverifysc('<?php echo $_REQUEST['txtpsrn'];?>','<?php echo $_REQUEST['crop'];?>','<?php echo $_REQUEST['variety'];?>','<?php echo $_REQUEST['upsval'];?>','<?php echo $_REQUEST['onop'];?>','<?php echo $_REQUEST['oqty'];?>');window.close();</script>
			<?php
		}
		exit;
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packing Slip</title>
<link href="../include/vnrtrac_sales.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-1.3.2.js"></script>
<script type="text/javascript" src="jquery.shiftcheckbox.js"></script>
<script src="recalllotup.js"></script>
<script src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->


<script language='javascript'>

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
function imgOnClick(dt, xind, yind)
{
	 popUpCalendar(document.from.sdate,dt,document.from.sdate, "dd-mmm-yyyy", xind, yind);
}
	
function imgOnClick1(dt, xind, yind)
{
	 popUpCalendar(document.from.edate,dt,document.from.edate, "dd-mmm-yyyy", xind, yind);
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
function pform()
{
	dt1=getDateObject(document.from.date.value,"-");
	dt2=getDateObject(document.from.dogt.value,"-");
	dt3=getDateObject(document.from.dot.value,"-");
	dt4=getDateObject(document.from.dop.value,"-");
	dt5=getDateObject(document.from.dov.value,"-");
	var fl=0;	
	var val1=document.from.pcodeo.value;
	var val2=document.from.ycodeeo.value;
	var val3=document.from.txtlot2o.value;
	var val4=document.from.stcodeo.value;
	var val6=document.from.stcode2o.value;
	
	if(val1=="" || val2=="" || val3=="" || val4=="" || val6=="")
	{
		alert("Please enter Lot Number");
		//document.from.txtvariety.focus();
		fl=1;
		return false;
	}
		
	if(document.from.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.from.txtcrop.focus();
		fl=1;
		return false;
	}
	if(document.from.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.from.txtvariety.focus();
		fl=1;
		return false;
	}
	
	if(document.from.txtupsdc.value=="")
	{
		alert("Please select UPS");
		document.from.txtupsdc.focus();
		fl=1;
		return false;
	}
	/*if(document.from.txtwtmp.value=="")
	{
		alert("Please enter NoP");
		document.from.txtwtmp.focus();
		fl=1;
		return false;
	}
	if(document.from.txtmptnop.value=="")
	{
		alert("Please enter Quantity");
		document.from.txtmptnop.focus();
		fl=1;
		return false;
	}*/
	if(document.from.txtnopdc.value=="")
	{
		alert("Please enter Good NoP");
		document.from.txtnopdc.focus();
		fl=1;
		return false;
	}
	if(document.from.txtqtydc.value=="")
	{
		alert("Please enter Good Quantity");
		document.from.txtqtydc.focus();
		fl=1;
		return false;
	}
	if(document.from.txtqcstatus.value=="")
	{
		alert("QC Status cannot be blank");
		document.from.txtqcstatus.focus();
		fl=1;
		return false;
	}
	if(document.from.txtqcstatus.value=="OK" && document.from.dot.value=="")
	{
		alert("Please Select DoT");
		//document.from.txtgotstatus.focus();
		fl=1;
		return false;
	}
	if(document.from.dot.value!="")
	{
		if(dt3 > dt1)
		{
			alert("Please select Valid DoT.");
			fl=1;
			return false;
		}
	}
	if(document.from.txtgerm.value=="")
	{
		alert("Germination % cannot be blank");
		document.from.txtgerm.focus();
		fl=1;
		return false;
	}
	if(document.from.txtmoist.value=="")
	{
		alert("Moisture % cannot be blank");
		document.from.txtmoist.focus();
		fl=1;
		return false;
	}
	if(document.from.txtpp.value=="")
	{
		alert("PP cannot be blank");
		document.from.txtpp.focus();
		fl=1;
		return false;
	}
	if(document.from.txtgotstatus.value=="")
	{
		alert("GOT Status cannot be Blank");
		document.from.txtgotstatus.focus();
		fl=1;
		return false;
	}
	if(document.from.txtgotstatus.value=="OK" && document.from.dogt.value=="")
	{
		alert("Please Select DoGT");
		//document.from.txtgotstatus.focus();
		fl=1;
		return false;
	}
	if(document.from.dogt.value!="")
	{
		if(dt2 > dt1)
		{
			alert("Please select Valid DoGT.");
			fl=1;
			return false;
		}
	}
	if(document.from.dop.value=="")
	{
		alert("DoP cannot be Blank");
		document.from.dop.focus();
		fl=1;
		return false;
	}
	if(document.from.dop.value!="")
	{
		if(dt4 > dt1)
		{
			alert("Please select Valid DoP.");
			fl=1;
			return false;
		}
	}
	if(document.from.dov.value=="")
	{
		alert("DoV cannot be Blank");
		document.from.dov.focus();
		fl=1;
		return false;
	}
	document.from.foccode.value="";
	var brcnt=0;
	if(document.from.srrno.value>1)
	{
		for (var i = 0; i < document.from.fetbarc.length; i++) 
		{          
			if(document.from.fetbarc[i].checked==true)
			{ 
				if(document.from.foccode.value =="")
				{
					document.from.foccode.value=document.from.fetbarc[i].value;
				}
				else
				{
					document.from.foccode.value = document.from.foccode.value +','+document.from.fetbarc[i].value;
				}
				brcnt++;
			}
		}
	}
	else
	{
		if(document.from.fetbarc.checked==true)
		{
			if(document.from.foccode.value =="")
			{
				document.from.foccode.value=document.from.fetbarc.value;
			}
			else
			{
				document.from.foccode.value = document.from.foccode.value +','+document.from.fetbarc.value;
			}
			brcnt++;
		}
	}
	if(document.from.foccode.value=="")
	{
		alert("Please select Barcode(s) to Link");
		fl=1;
	}
	
	//alert(brcnt);
	var xnop=parseInt(document.from.txtmptnop.value)*parseInt(brcnt);
	var xqty=parseFloat(document.from.txtwtmp.value)*parseFloat(brcnt);
	if(document.from.txtmptnop.value!="")
	{
		if(parseInt(document.from.txtnopdc.value)!=parseInt(xnop))
		{
			alert("Total NoP in select Barcode is not Matching with entered NoP");
			fl=1;
		}
	}
	if(document.from.txtwtmp.value!="")
	{
		if(document.from.txtqtydc.value=="")
		{
			alert("Total Qty in select Barcode is not Matching with entered Qty");
			fl=1;
		}
	}
	if(fl==1)
	{
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		alert(a);
		showUser(a,'barcstsloc','mformsmcbarcsl','','','','','');
	}	
}
function mySubmit()
{
	if(document.from.postval.value=="submittrn")
	{
	if(document.from.postitmid.value=="0")
	{
		alert("You have not updated any Lot Number");
		return false;
	}
	
	return true;
	}
}

function post_value(postval)
{
	document.from.postval.value=postval;
}
function gotchk(qcsrval)
{
	if(document.from.txtpp.value=="")
	{
		alert("Please select PP");
		document.from.txtgstat.value="";
		document.from.txtpp.focus();
		return false;
	}
}
function qtchk(qcsrval)
{
	if(document.from.txtgstat.value=="")
	{
		alert("Please select GOT Type");
		document.from.txtgotstatus.value;
		document.from.txtgstat.focus();
		return false;
	}
	else
	{
		document.from.txtgotstatus.value=qcsrval;
	}
}

function upchk(npval)
{
	var f=0;
	if(document.from.stcodeo.value=="")
	{
		alert("Please enter Lot Number");
		document.from.txtnopdc.value="";
		document.from.stcodeo.focus();
		f=1;
		return false;
	}
	if(document.from.txtupsdc.value=="")
	{
		alert("Please enter UPS");
		document.from.txtnopdc.value="";
		document.from.txtupsdc.focus();
		f=1;
		return false;
	}
		
	if(npval<0)
	{
		alert("Invalid NoP");
		document.from.txtnopdc.value="";
		document.from.txtnopdc.focus();
		f=1;
		return false;
	}
	if(f!=0)
	{
		return false;
	}
	else
	{
		
	}
}

function nopschk(qtval)
{
	var f=0;
	if(document.from.txtnopdc.value=="")
	{
		alert("Please enter NoP");
		document.from.txtqtydc.value="";
		document.from.txtnopdc.focus();
		f=1;
		return false;
	}
	
	if(qtval<0)
	{
		alert("Invalid Qty");
		document.from.txtqtydc.value="";
		document.from.txtqtydc.focus();
		f=1;
		return false;
	}
	if(f!=0)
	{
		return false;
	}
	else
	{
		
	}
}
function ycodchko(ycodval)
{
	if(document.from.pcodeo.value=="")
	{
		alert("Please Select Plant Code");
		document.from.ycodeeo.value="";
		document.getElementById('ycodeeo').SelectedIndex=0;
		document.from.txtlot2o.value="";
		document.from.stcodeo.value="";
		return false;
	}
}

function lot2chko(lotchval)
{
	if(document.from.ycodeeo.value=="")
	{
		alert("Invalid Lot Number");
		document.from.txtlot2o.value="";
		document.from.stcodeo.value="";
		return false;
	}
	
}

function stchko()
{
	if(document.from.txtlot2o.value=="")
	{
		alert("Invalid Lot Number");
		document.from.stcodeo.focus()
		document.from.stcodeo.value="";
		return false;
	}
	if(document.from.stcodeo.value.length < 5)
	{
		alert("Invalid Lot Number");
		document.from.stcodeo.focus()
		document.from.stcodeo.value="";
		return false;
	}
	
}

function qtychk()
{
	if(document.from.txtqtydc.value=="")
	{
		alert("Please enter Qty");
		document.from.txtqcstatus.value="";
		document.from.txtqcstatus.SelectedIndex=0;
		document.from.txtqtydc.focus;
		return false;
	}
}

function qcchk()
{
	if(document.from.txtqcstatus.value=="")
	{
		alert("Please select QC Status");
		document.from.txtgerm.value="";
		document.from.txtqcstatus.focus;
		return false;
	}
}

function germpchk()
{
	if(document.from.txtgerm.value=="")
	{
		alert("Please enter Germination %");
		document.from.txtmoist.value="";
		document.from.txtgerm.focus;
		return false;
	}
}

function moistchk()
{
	if(document.from.txtmoist.value=="")
	{
		alert("Please enter Moisture %");
		document.from.txtpp.value="";
		document.from.txtmoist.focus;
		return false;
	}
}

function calshochk(calidval)
{
	if(calidval=="dot")
	{
		if(document.from.txtqcstatus.value=="")
		{
			alert("Please select QC Status");
			document.from.txtqcstatus.focus;
			return false;
		}
		if(document.from.txtqcstatus.value=="OK" || document.from.txtqcstatus.value=="Fail")
		{
			showCalendar(calidval);
		}
	}
	if(calidval=="dogt")
	{
		if(document.from.txtgotstatus.value=="")
		{
			alert("Please select GOT Status");
			return false;
		}
		if(document.from.txtgotstatus.value=="OK" || document.from.txtgotstatus.value=="Fail")
		{
			showCalendar(calidval);
		}
	}
	if(calidval=="dop")
	{
		if(document.from.txtgotstatus.value=="")
		{
			alert("Please select GOT Status");
			return false;
		}
		else
		{
			showCalendar(calidval);
		}
	}
	if(calidval=="dov")
	{
		if(document.from.dop.value=="")
		{
			alert("Please select DoP");
			return false;
		}
		else
		{
			showCalendar(calidval);
		}
	}
}
function onlodfocus()
{
	document.from.pcodeo.focus();
}
</script>
</head>
<body topmargin="0" onLoad="onlodfocus()" >

<table width="650" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  	<form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();">
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="crop" value="<?php echo $crop;?>" />
	<input type="hidden" name="variety" value="<?php echo $variety;?>" />
	<input type="hidden" name="txtpsrn" value="<?php echo $txtpsrn;?>" />
	<input type="hidden" name="lotno" value="<?php echo $lotno;?>" />
	<input type="hidden" name="maintrid" value="<?php echo $trid?>" />
	<input type="hidden" name="onop" value="<?php echo $onop?>" />
	<input type="hidden" name="oqty" value="<?php echo $oqty?>" />
	<input type="hidden" name="date" value="<?php echo date("d-m-Y");?>" />
<div id="barcstsloc">
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="tblheading" colspan="14">SLOC - Un-Identified Barcodes</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td width="217" align="center" valign="middle" class="tblheading">Lot No.</td>
<td width="149" align="center" valign="middle" class="tblheading">WH</td>
<td width="121" align="center" valign="middle" class="tblheading">Bin</td>
<td width="119" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="182" align="center" valign="middle" class="tblheading">Master Packs</td>
</tr>
<?php
	$abc=""; $abcdef="";
	$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode' AND bar_lotno='".$lotno."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'") or die(mysqli_error($link));
	$tot_barcode2=mysqli_num_rows($sql_barcode2);
	if($tot_barcode2 > 0)
	{
		while($row_barcode2=mysqli_fetch_array($sql_barcode2))
		{
			$bc=$row_barcode2['bar_barcodes'];
			if($abc!="")
			$abc=$abc.","."'$bc'";
			else
			$abc="'$bc'";
			if($abcdef!="")
			$abcdef=$abcdef.",".$bc;
			else
			$abcdef=$bc;
		}
	}
	//echo $abc;
	$sql_btsls=mysqli_query($link,"select distinct(btsl_id) from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn' order by btsl_id asc") or die(mysqli_error($link));
	while($row_btsls=mysqli_fetch_array($sql_btsls))
	{
		if($barlotslist!="")
			$barlotslist=$barlotslist.",".$row_btsls['btsl_id'];
		else
			$barlotslist=$row_btsls['btsl_id'];
	}
	//echo $barlotslist;
	$sbn1=""; $sbn2=""; $barcds="";
	if($barlotslist!="")
	{
		$sql_tbl_barsub2=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1 and btsl_id IN ($barlotslist) and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar2=mysqli_num_rows($sql_tbl_barsub2);
		while($rowbarcsub2=mysqli_fetch_array($sql_tbl_barsub2))
		{
			/*$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				if($sbn1!="")
				$sbn1=$sbn1.",".$row_btslm['btslss_subbin'];
				else
				$sbn1=$row_btslm['btslss_subbin'];
			}*/
			$sql_btslm2=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			$trt=mysqli_num_rows($sql_btslm2);
			while($row_btslm2=mysqli_fetch_array($sql_btslm2))
			{
				if($sbn1!="")
				 $sbn1=$sbn1.",".$row_btslm2['btslss_subbin'];
				else
				 $sbn1=$row_btslm2['btslss_subbin'];
				 
				$bc=$rowbarcsub2['btslsub_barcode'];
				if($barcds!="")
				$barcds=$barcds.","."'$bc'";
				else
				$barcds="'$bc'";
			}
		}
	}
	$lotno='';
	if($barcds!="")
	{
		$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' AND mpmain_barcode IN($barcds)") or die(mysqli_error($link));
		if($tot_mpm=mysqli_num_rows($sql_mpm)>0)
		{
		$row_mpm=mysqli_fetch_array($sql_mpm);
		$lotno=$row_mpm['mpmain_lotno'];
		}
	}
	$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
	$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
	while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
	{ 
		if($sbn2!="")
		$sbn2=$sbn2.",".$row_tbl_subsub3['subbinid'];
		else
		$sbn2=$row_tbl_subsub3['subbinid'];
	}
	
	//echo $sbn1;
	$as=explode(",",$sbn1);
	$df=explode(",",$sbn2);
	$nm=array_merge($as,$df);
	$nm1=array_unique($nm);
	//print_r($nm1);
$xyz=explode(",",$abc);	
$conts=count($xyz);	

?>
<?php
$sno3=0; $totnompbarlink=0; $aval1=array(); $tcnt=0; $postitmid=0;//$a=$lotno; 
foreach($nm1 as $sbinval)
{
if($sbinval<>"")
{ 
$totnompbar=0;
$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
	$nob=0; $qty=0; $qty1=0;
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_tbl_subsub3['subbinid']."' and binid='".$row_tbl_subsub3['binid']."' and whid='".$row_tbl_subsub3['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nop1=0; $tcnt++;
		$ups=$row_issuetbl['packtype'];
		$wtinmp=$row_issuetbl['wtinmp'];
		$upspacktype=$row_issuetbl['packtype'];
		$packtp=explode(" ",$upspacktype);
		$packtyp=$packtp[0]; 
		if($packtp[1]=="Gms")
		{ 
			$ptp=(1000/$packtp[0]);
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
		//if($nop1<$row_issuetbl['balnop'])
		$nop1=$row_issuetbl['balnop'];
		//$nob=$nop1;
		$nob=$nop1; 
		$qty=$row_issuetbl['balnomp'];
		$qty1=$row_issuetbl['balqty'];
	}
}

if($tcnt==0)
{
	$sql_sel2="select * from tblups where CONCAT(ups,' ',wt)='".$upsize."' order by uom Asc";
	$res2=mysqli_query($link,$sql_sel2) or die (mysqli_error($link));
	$row122=mysqli_fetch_array($res2);
	$upsize=$row122['uid'];
	
	$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
	$totvariety=mysqli_num_rows($sqlvsriety);
	$rowvariety=mysqli_fetch_array($sqlvsriety);
	
	$p1_array=explode(",",$rowvariety['gm']);
	$p1_array2=explode(",",$rowvariety['wtmp']);
	$p1_array3=explode(",",$rowvariety['mptnop']);
	$p1=array();
	for($i=0; $i<count($p1_array); $i++)
	{
		if($p1_array[$i]==$upsize)
		{
			$sql_sel="select * from tblups where uid='".$upsize."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			$wtinmp=$p1_array2[$i];
			if($row12['wt']=="Gms")
			{ 
				$ptp=(1000/$row12['ups']);
			}
			else
			{
				$ptp=$row12['ups'];
			}
		}
	}
}
	$nobcd="";
	$sqlsubbinn=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$sbinval."'") or die(mysqli_error($link));
	$rowsubbinn=mysqli_fetch_array($sqlsubbinn);
	$wid=$rowsubbinn['whid'];
	$bid=$rowsubbinn['binid'];	
	
	$stbar=0;
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg!=0 and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  (btslss_lotno!='' || btslss_lotno!='NULL') order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				$brcod=$rowbarcsub['btslsub_barcode'];
				if($nobcd!="")
				$nobcd=$nobcd.",".$brcod;
				else
				$nobcd=$brcod;
				array_push($aval1,$brcod);
				$stbar++;
				$lotno=$row_btslm['btslss_lotno'];
			}
		}
	$totnompbar=$totnompbar+$stbar;
	}
	$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	
$sno3=$sno3+1;
	
//if($slocssyncs=="slocssyn")
{
?>
<tr class="light" height="25">
  <td align="center"  valign="middle" class="smalltbltext"><?php if($lotno==""){ ?><?php } else { echo $lotno; $postitmid++; }?><input type="hidden" name="txtlotno<?php echo $sno3?>" value="<?php echo $lotno?>" /></td>
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='$wid' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" id="txtwhg<?php echo $sno3;?>" name="txtwhg<?php echo $sno3;?>" value="<?php echo $noticia_whd1['whid'];?>" /></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$wid."' and binid='$bid' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>

<td align="center"  valign="middle" class="smalltbltext" id="bingn1"><?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtbing<?php echo $sno3;?>" id="txtbing<?php echo $sno3;?>" value="<?php echo $noticia_bing1['binid'];?>"  /></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND binid='".$bid."' and sid='$sbinval' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	

<td align="center"  valign="middle" class="smalltbltext" id="sbingn1"><?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtsubbg<?php echo $sno3;?>" id="txtsubbg<?php echo $sno3;?>" value="<?php echo $noticia_subbing1['sid'];?>"   /></td>


<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php if($totnompbar>0) { ?><a href="Javascript:void(0);" onClick="showbarc('<?php echo $nobcd;?>');"><?php echo $totnompbar;?></a><?php } else { echo $totnompbar; }?><input type="hidden" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $totnompbar;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)"   /></td>
</tr>
<?php
}
}
}
?>

<input type="hidden" name="sno3" value="<?php echo $sno3;?>" />
</table>
<br />	
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="3%" align="center" valign="middle" class="tblheading">Update Lot Details</td>
</tr>	
</table>
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr height="15">
<td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
$row_month=mysqli_fetch_array($quer6);
$a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<tr class="Light" height="25" >
<td width="100" align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left" width="694" valign="middle" class="smalltbltext" colspan="5">&nbsp;<select class="smalltbltext" name="pcodeo" style="width:40px;">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onChange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onKeyPress="return isNumberKey(event)" onChange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onKeyPress="return isNumberKey(event)"  value="" onChange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="00" onChange="stchko2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
</table>
<?php

$quer6=mysqli_query($link,"SELECT * FROM tbl_parameters where code='$l' order by code asc");
$to=mysqli_num_rows($quer6);
	
$val=0; $val1=0; $sflg=0;
$sql_month=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$a."' and packtype='".$upsval."'")or die("Error:".mysqli_error($link));
$row_month=mysqli_num_rows($sql_month);
$rowmonth=mysqli_fetch_array($sql_month);

$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$rowmonth['lotldg_crop']."' order by cropname Asc");
$noticia33 = mysqli_fetch_array($quer33);
		
$quer43=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$rowmonth['lotldg_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item43 = mysqli_fetch_array($quer43);


$sql_month1=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesrs_newlot='".$a."' and salesr_id='".$trid."'")or die("Error:".mysqli_error($link));
$row_month1=mysqli_num_rows($sql_month1);

if($to==0 || $row_month==0)$sflg++;
if($row_month==0 && $to > 0)$val++;
if($row_month1 > 0)$val++;
if($row_month>0)
{
if($crop!=$noticia33['cropid'])$val1++;
if($variety!=$noticia_item43['varietyid'])$val1++;
}
if($val1>0)$val++;
if($val==0)
{

$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$trid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];
$ltnn=sprintf("%00005d",$row_tbl['salesr_tslrno']);
$tid=$arrival_id;



$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesr_id='".$trid."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
//$tid=$row_tbl_sub['salesr_id'];
//$subtid=$row_tbl_sub['salesr_id'];


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crop."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$variety."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

	$wtmp="";$mptnop=""; $srnonew=0;
	$p1_array=explode(",",$noticia_item['gm']);
	$p1_array2=explode(",",$noticia_item['wtmp']);
	$p1_array3=explode(",",$noticia_item['mptnop']);
	$p1=array();
	foreach($p1_array as $val1)
	{
		if($val1<>"")
		{
			$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			if($ups==$row_tbl_sub['salesrs_ups'])
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
			$srnonew++;
		}
	}
	
	$packtp=explode(" ",$row_tbl_sub['salesrs_ups']);
	$packtyp=$packtp[0]; 
	$ptp=""; $ptp1="";
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


?>
<table align="center" width="800" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="25">
<td width="99" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="190" align="left"  valign="middle" class="tbltext" id="vcrop" >&nbsp;<?php echo $noticia['cropname'];?>
  <input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $row_tbl_sub['salesrs_crop'];?>" /></td>
	<td width="80" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="150" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?>
      <input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $row_tbl_sub['salesrs_variety'];?>" /></td>
<!--<td align="right"  valign="middle" class="tblheading">UPS Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_upstype']!="" || $row_tbl_sub['salesrs_upstype']!="NULL") { ?><input type="hidden" name="txtupstyp" value="<?php echo $row_tbl_sub['salesrs_upstype'];?>" /><?php echo $row_tbl_sub['salesrs_upstype'];?> <?php } else {?><input type="radio" name="upstype" value="Standard" onclick="upstypchk(this.value)" checked="checked"  />&nbsp;Standard&nbsp;&nbsp;<input type="radio" name="upstype" value="Non-Standard" onclick="upstypchk(this.value)"  />&nbsp;Non-Standard<input type="hidden" name="txtupstyp" value="Standard" /><?php } ?>&nbsp;</td>		-->	


<input type="hidden" name="itmdchk" value="" />
	

<?php
$sql_month=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by varietyid")or die(mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$toup=explode(",",$row_month['gm']);
	
?>

<td width="50" align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="217" align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row_tbl_sub['salesrs_ups']!="" && $row_tbl_sub['salesrs_ups']!="--Select UPS-") {?>
  <input name="txtupsdc" type="text" size="15" class="tbltext" tabindex=""  onkeypress="return isNumberKey2400(event)"   readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['salesrs_ups'];?>"   /><?php } else { ?><?php if($row_tbl_sub['salesrs_upstype']!="Standard"){?><input type="text" class="tbltext" name="txtupsdc" id="txtupsdc" size="15" maxlength="15" onChange="verchk(this.value);" value="" /><?php } else { ?><select class="tbltext" name="txtupsdc" id="txtupsdc" style="width:100px;" onChange="verchk(this.value);" >
<option value="" selected>--Select UPS-</option>
	<?php foreach($toup as $val) { if($val<>"") { 
	$sql_var=mysqli_query($link,"select * from tblups where uid='".$val."' order by uom") or die(mysqli_error($link));
	$row_var=mysqli_fetch_array($sql_var);
	$upst=$row_var['ups']." ".$row_var['wt']; ?>
		<option <?php if($row_tbl_sub['salesrs_ups']==$upst) echo "selected";?> value="<?php echo $upst;?>" />   
		<?php echo $upst;?>
	<?php }} ?></select><?php } }?>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>	
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Wt. in MP&nbsp;</td>
<td width="190" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtwtmp" type="text" size="10" class="tbltext" tabindex="" maxlength="5" value="<?php echo $wtmp;?>" onKeyPress="return isNumberKey(event)"  readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="80" align="right"  valign="middle" class="tblheading">NoP in MP&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtmptnop" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onKeyPress="return isNumberKey1(event)" readonly="true" style="background-color:#CCCCCC" value="<?php echo $mptnop;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="20">
<td align="center"  valign="middle" class="tblheading" colspan="6">Quantity Details</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">NoP&nbsp;</td>
<td width="190" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtnopdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onKeyPress="return isNumberKey(event)" onChange="upchk(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td width="80" align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onKeyPress="return isNumberKey1(event)" onChange="nopschk(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="20">
<td align="center"  valign="middle" class="tblheading" colspan="6">Quality Details</td>
</tr>
<?php
if($sflg==0)
{
?>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtqcstatus" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_qc'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_qctestdate'];?>"  />&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_gemp'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_moisture'];?>" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtpp" class="tbltext" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_vchk'];?>" />&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="txtgotstatus"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $rowmonth['lotldg_got'];?>" />&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgstat" value="<?php $gt=explode(" ",$rowmonth['lotldg_got1']); echo $gt[0];?>" /></td>
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dogt" id="dogt" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_gottestdate'];?>"  /></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" value="<?php echo $rowmonth['lotldg_dop'];?>" />
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC" value="<?php echo $rowmonth['lotldg_valupto'];?>"  /></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<select name="txtqcstatus" class="tbltext" style="size:70px" onChange="qtychk();">
<option value="" selected="selected">--Select--</option>
<option value="OK">OK</option>
<option value="Fail">Fail</option>
<option value="UT">UT</option>
<option value="RT">RT</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right" valign="middle" class="tblheading" >DoT&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dot" id="dot" value="" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="calshochk('dot');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >Germination %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" name="txtgerm" class="tbltext" size="3" maxlength="3" value="" onKeyPress="return isNumberKey(event)" onChange="qcchk();"  />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >Moisture %&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="txtmoist" class="tbltext" size="5" maxlength="5" value=""  onKeyPress="return isNumberKey1(event)" onChange="germpchk();" />&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select name="txtpp" class="tbltext" style="size:80px" onChange="moistchk();"  >
 <option value="" selected="selected">-Select-</option>
 <option value="Acceptable">Acceptable</option> 
 <option value="Not-Acceptable">Not-Acceptable</option> 
 </select>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >GOT Type&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<select class="tbltext" name="txtgstat" style="width:80px;" onChange="gotchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="GOT-R" >GOT-R</option>
	<option value="GOT-NR" >GOT-NR</option>
	</select>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading" >GOT Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="tbltext" name="qcsreq" style="width:80px;" onChange="qtchk(this.value)">
<option value="" selected>--Select--</option>
	<option value="OK" >OK</option>
	<option value="UT" >UT</option>
	</select>&nbsp;<font color="#FF0000">*</font><input type="hidden" name="txtgotstatus" value="" /></td>	
 <td align="right"  valign="middle" class="tblheading" >DoGT&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input type="text" name="dogt" id="dogt" value="" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="calshochk('dogt');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >DoP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" id="gotsts">&nbsp;<input type="text" class="tbltext" name="dop" id="dop"  readonly="true" style="background-color:#CCCCCC" size="15" maxlength="15" />&nbsp;<a href="javascript:void(0)" onClick="calshochk('dop');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>
&nbsp;<font color="#FF0000">*</font></td>
 <td align="right"  valign="middle" class="tblheading" >DoV&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;<input type="text" name="dov" id="dov" value="" size="15" maxlength="15" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<a href="javascript:void(0)" onClick="calshochk('dov');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000">*</font></td>
</tr>
<?php
}
?>
</table>
<?php
}
else
{
?>
<table align="center" width="800" cellpadding="0" cellspacing="0" border="1" bordercolor="#a8a09e" style="border-collapse:collapse">
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;Cannot show Lot Details.</td>
</tr>
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;Reasons: 1. Lot not present in System(for current Plant application login)</td>
</tr>
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Lot not Packed(for current Plant application login)</td>
</tr>
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. Crop/Variety mismatch for selected Lot with the verifying record</td>
</tr>
<tr class="Light" height="20">
<td align="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. Lot already received in this Transaction</td>
</tr>
</table>
<?php
}
?><br />	
<div id="showcvdet">
<table align="center" border="1" width="200" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="tblheading" colspan="2">Select&nbsp;Barcode(s) to Link</td>
</tr>
<!--<tr class="Dark" height="20">
<td width="40%" align="right" valign="middle" class="tblheading">CA&nbsp;&nbsp;|&nbsp;&nbsp;CL&nbsp;</td>
<td width="60%" align="left" valign="middle" class="tblheading">&nbsp;Barcode(s)</td>
</tr>-->
<?php
$srrno=0;
$sql_tbl_bar2=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
while($row_tbl_bar2=mysqli_fetch_array($sql_tbl_bar2))
{
$sql_tbl_barsub23=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and  btsl_id='".$row_tbl_bar2['btsl_id']."' and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
$subtbltotbar23=mysqli_num_rows($sql_tbl_barsub23);
while($rowbarcsub23=mysqli_fetch_array($sql_tbl_barsub23))
{
	$sql_btslm2=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub23['btslsub_id']."' and  (btslss_lotno!='' || btslss_lotno!='NULL') order by btslsub_id asc") or die(mysqli_error($link));
	$row_btslm2=mysqli_num_rows($sql_btslm2);
	if($row_btslm2==0)
	{
		$brcod2=$rowbarcsub23['btslsub_barcode'];
		if($xyz1!="")
			$xyz1=$xyz1.",".$brcod2;
		else
			$xyz1=$brcod2;
	}
}
}
$xyz=explode(",",$xyz1);
foreach($xyz as $sbinval23)
{
if($sbinval23<>"")
{ $srrno++;
?>
<tr class="light" height="22">
<td width="40%" align="right" valign="middle" class="tblheading"><input type="checkbox" name="fetbarc" class="input shiftCheckbox" id="fet" value="<?php echo $sbinval23;?>"   /></td>
<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $sbinval23;?></td>
</tr>
<?php
}
}
?>
<input type="hidden" name="foccode" value="" /><input type="hidden" name="srrno" value="<?php echo $srrno;?>" />
</table><br />
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="tblheading" colspan="6">SLOC</td>
</tr>
<?php

	$abc=""; $abcdef="";
	$sql_barcode2=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where plantcode='$plantcode' AND bar_lotno='".$lotno."' and bar_logid='".$logid."' and bar_psrn='".$txtpsrn."'") or die(mysqli_error($link));
	$tot_barcode2=mysqli_num_rows($sql_barcode2);
	if($tot_barcode2 > 0)
	{
		while($row_barcode2=mysqli_fetch_array($sql_barcode2))
		{
			$bc=$row_barcode2['bar_barcodes'];
			if($abc!="")
			$abc=$abc.","."'$bc'";
			else
			$abc="'$bc'";
			if($abcdef!="")
			$abcdef=$abcdef.",".$bc;
			else
			$abcdef=$bc;
		}
	}
	//echo $abc;
	$sql_btsls=mysqli_query($link,"select distinct(btsl_id) from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='$txtpsrn' order by btsl_id asc") or die(mysqli_error($link));
	while($row_btsls=mysqli_fetch_array($sql_btsls))
	{
		if($barlotslist!="")
			$barlotslist=$barlotslist.",".$row_btsls['btsl_id'];
		else
			$barlotslist=$row_btsls['btsl_id'];
	}
	//echo $barlotslist;
	$sbn1=""; $sbn2="";
	if($barlotslist!="")
	{
		$sql_tbl_barsub2=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_crop='$crop' and btslsub_variety='$variety' and btsl_id IN ($barlotslist) and btslsub_lnkflg=1 and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar2=mysqli_num_rows($sql_tbl_barsub2);
		while($rowbarcsub2=mysqli_fetch_array($sql_tbl_barsub2))
		{
			/*$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				if($sbn1!="")
				$sbn1=$sbn1.",".$row_btslm['btslss_subbin'];
				else
				$sbn1=$row_btslm['btslss_subbin'];
			}*/
			$sql_btslm2=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub2['btslsub_id']."' order by btslsub_id asc") or die(mysqli_error($link));
			$trt=mysqli_num_rows($sql_btslm2);
			while($row_btslm2=mysqli_fetch_array($sql_btslm2))
			{
				if($sbn1!="")
				 $sbn1=$sbn1.",".$row_btslm2['btslss_subbin'];
				else
				 $sbn1=$row_btslm2['btslss_subbin'];
			}
		}
	}
	
	$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
	$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
	while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
	{ 
		if($sbn2!="")
		$sbn2=$sbn2.",".$row_tbl_subsub3['subbinid'];
		else
		$sbn2=$row_tbl_subsub3['subbinid'];
	}
	
	//echo $sbn1;
	$as=explode(",",$sbn1);
	$df=explode(",",$sbn2);
	$nm=array_merge($as,$df);
	$nm1=array_unique($nm);
	//print_r($nm1);
$xyz=explode(",",$abc);	
$conts=count($xyz);	
?>
<tr class="tblsubtitle" height="20">
<td width="78" align="center" valign="middle" class="tblheading">Select</td>
<td width="165" align="center" valign="middle" class="tblheading">WH</td>
<td width="165" align="center" valign="middle" class="tblheading">Bin</td>
<td width="165" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="196" align="center" valign="middle" class="tblheading">Comments</td>
<td width="165" align="center" valign="middle" class="tblheading">Master Packs</td>
<!--<td width="162" align="center" valign="middle" class="tblheading">Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Pouches</td>
<td width="205" align="center" valign="middle" class="tblheading">Total Qty Kgs.</td>-->
</tr>
<?php
$sno3=0; $totnompbarlink=0; $aval1=array(); $tcnt=0; //$a=$lotno; 
foreach($nm1 as $sbinval)
{
if($sbinval<>"")
{ 
$totnompbar=0;
$sql_tbl_subsub3=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotno='".$lotno."'  and balqty > 0") or die(mysqli_error($link));
$rowsubsub3=mysqli_num_rows($sql_tbl_subsub3);
while($row_tbl_subsub3=mysqli_fetch_array($sql_tbl_subsub3))
{ 
	$nob=0; $qty=0; $qty1=0;
	$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' AND subbinid='".$row_tbl_subsub3['subbinid']."' and binid='".$row_tbl_subsub3['binid']."' and whid='".$row_tbl_subsub3['whid']."' and lotno='".$lotno."' ") or die(mysqli_error($link));
	$row_issue1=mysqli_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' AND lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 
	
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$nop1=0; $tcnt++;
		$ups=$row_issuetbl['packtype'];
		$wtinmp=$row_issuetbl['wtinmp'];
		$upspacktype=$row_issuetbl['packtype'];
		$packtp=explode(" ",$upspacktype);
		$packtyp=$packtp[0]; 
		if($packtp[1]=="Gms")
		{ 
			$ptp=(1000/$packtp[0]);
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
		//if($nop1<$row_issuetbl['balnop'])
		$nop1=$row_issuetbl['balnop'];
		//$nob=$nop1;
		$nob=$nop1; 
		$qty=$row_issuetbl['balnomp'];
		$qty1=$row_issuetbl['balqty'];
	}
}

if($tcnt==0)
{
	$sql_sel2="select * from tblups where CONCAT(ups,' ',wt)='".$upsize."' order by uom Asc";
	$res2=mysqli_query($link,$sql_sel2) or die (mysqli_error($link));
	$row122=mysqli_fetch_array($res2);
	$upsize=$row122['uid'];
	
	$sqlvsriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$variety."' and actstatus='Active'") or die(mysqli_error($link));
	$totvariety=mysqli_num_rows($sqlvsriety);
	$rowvariety=mysqli_fetch_array($sqlvsriety);
	
	$p1_array=explode(",",$rowvariety['gm']);
	$p1_array2=explode(",",$rowvariety['wtmp']);
	$p1_array3=explode(",",$rowvariety['mptnop']);
	$p1=array();
	for($i=0; $i<count($p1_array); $i++)
	{
		if($p1_array[$i]==$upsize)
		{
			$sql_sel="select * from tblups where uid='".$upsize."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			$wtinmp=$p1_array2[$i];
			if($row12['wt']=="Gms")
			{ 
				$ptp=(1000/$row12['ups']);
			}
			else
			{
				$ptp=$row12['ups'];
			}
		}
	}
}
	$nobcd="";
	$sqlsubbinn=mysqli_query($link,"select * from tbl_subbin where plantcode='$plantcode' AND sid='".$sbinval."'") or die(mysqli_error($link));
	$rowsubbinn=mysqli_fetch_array($sqlsubbinn);
	$wid=$rowsubbinn['whid'];
	$bid=$rowsubbinn['binid'];	
	$stbar=0;
	$sql_tbl_bar=mysqli_query($link,"select * from tbl_srbtslmain where plantcode='$plantcode' AND btsl_trrefno='".$txtpsrn."'") or die(mysqli_error($link));
	while($row_tbl_bar=mysqli_fetch_array($sql_tbl_bar))
	{
		$sql_tbl_barsub=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='".$row_tbl_bar['btsl_id']."' and btslsub_crop='$crop' and btslsub_variety='$variety' and btslsub_lnkflg=1 and btslsub_bctype='Un-Identified'") or die(mysqli_error($link));
		$subtbltotbar=mysqli_num_rows($sql_tbl_barsub);
		while($rowbarcsub=mysqli_fetch_array($sql_tbl_barsub))
		{
			$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslsub_id='".$rowbarcsub['btslsub_id']."' and  btslss_lotno='$lotno' order by btslsub_id asc") or die(mysqli_error($link));
			while($row_btslm=mysqli_fetch_array($sql_btslm))
			{
				$brcod=$rowbarcsub['btslsub_barcode'];
				if($nobcd!="")
				$nobcd=$nobcd.",".$brcod;
				else
				$nobcd=$brcod;
				array_push($aval1,$brcod);
				$stbar++;
			}
		}
	$totnompbar=$totnompbar+$stbar;
	}
	$totnompbar=$totnompbar+$qty;
	$tqtybar=$wtinmp*$totnompbar;
	$totpchbar=$tqtybar*$ptp;
	$totnompbarlink=$totnompbarlink+$totnompbar;
	$a1=explode(",",$abcdef);
	$ardiff=implode(",",array_diff($a1,$aval1));
	
$sno3=$sno3+1;	
//if($subtbltotbar > 0)	
{
?>
<tr class="light" height="25">
<td align="center"  valign="middle" class="smalltbltext"><input type="radio" name="slslc" id="slslc<?php echo $sno3?>" value="<?php echo $sno3?>" checked="checked" /></td>
  <?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='$wid' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" class="smalltbltext" id="txtwhg<?php echo $sno3;?>" name="txtwhg<?php echo $sno3;?>" value="<?php echo $noticia_whd1['whid'];?>" /></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' AND whid='".$wid."' and binid='$bid' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_bing1['binname'];?><input type="hidden" class="smalltbltext" name="txtbing<?php echo $sno3;?>" id="txtbing<?php echo $sno3;?>" value="<?php echo $noticia_bing1['binid'];?>"  /></td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' AND binid='".$bid."' and sid='$sbinval' order by sname") or die(mysqli_error($link));
$noticia_subbing1 = mysqli_fetch_array($subbind1_query);
?>	

<td align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_subbing1['sname'];?><input type="hidden" class="smalltbltext" name="txtsubbg<?php echo $sno3;?>" id="txtsubbg<?php echo $sno3;?>" value="<?php echo $noticia_subbing1['sid'];?>"   /></td>

<td valign="middle">
<div id="slocr<?php echo $sno3;?>">
<table align="center" height="25" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >		
	<tr>
 		<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input type="hidden" name="existview<?php echo $sno3?>" id="existview<?php echo $sno3?>" class="tbltext" value="Allowed" /><input type="hidden" name="trflg<?php echo $sno3?>" id="trflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tpflg<?php echo $sno3?>" id="tpflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tflg<?php echo $sno3?>" id="tflg<?php echo $sno3?>" value="0" /><input type="hidden" name="tpmflg<?php echo $sno3?>" id="tpmflg<?php echo $sno3?>" value="0" /></td>
 	</tr>
</table>
</div> 
</td> 
<td align="center" valign="middle" class="tbltext" title="<?php echo $nobcd;?>"><?php echo $totnompbar;?><input type="hidden" class="tbltext" name="nopmpcs_<?php echo $sno3;?>" id="nopmpcs_<?php echo $sno3;?>" value="<?php echo $totnompbar;?>" size="9"  onchange="pacsbinchk(this.value,<?php echo $sno3;?>)"   /></td>
<!--<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noppchs_<?php echo $sno3;?>" id="noppchs_<?php echo $sno3;?>" value="" size="9"  onchange="pacpchchk(this.value,<?php echo $sno3;?>)"  /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptpchs_<?php echo $sno3;?>" id="noptpchs_<?php echo $sno3;?>" value="<?php echo $totpchbar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="noptqtys_<?php echo $sno3;?>" id="noptqtys_<?php echo $sno3;?>" value="<?php echo $tqtybar;?>" size="9" readonly="true" style="background-color:#CCCCCC" /></td>-->
</tr>
<?php
}
}
}
?>

<input type="hidden" name="sno3" value="<?php echo $sno3;?>" /><input type="hidden" name="slocseldet" value="<?php echo $sno3;?>" /><input type="hidden" name="sbincont" value="<?php echo $sbincont;?>" /><input type="hidden" name="postitmid" value="<?php echo $postitmid;?>" />
</table>
<?php if($conts>0) { ?>
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php } ?>
</div>
</div>
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/cancel.gif" alt="Cancel Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="post_value('canceltrn');">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="post_value('submittrn');">&nbsp;&nbsp;<input type="hidden" name="postval" value="" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
