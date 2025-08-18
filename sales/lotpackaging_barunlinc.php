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

	if(isset($_REQUEST['lotno']))
	{
		$lotno = $_REQUEST['lotno'];
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
	if(isset($_REQUEST['otqty']))
	{
		$otqty = $_REQUEST['otqty'];
	}
	if(isset($_REQUEST['otnop']))
	{
		$otnop = $_REQUEST['otnop'];
	}
	if(isset($_REQUEST['subid']))
	{
		$subid = $_REQUEST['subid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$barcode=trim($_POST['barcode']);
		$postval=trim($_POST['postval']);
		if($postval=="submittrn")
		{
			$sql_btslm2="update tbl_srbtslsub set btslsub_lnkflg=0 where btslsub_barcode='$barcode'";
			$xcvb=mysqli_query($link,$sql_btslm2) or die(mysqli_error($link));
			?>
				<script>window.opener.showverifysc('<?php echo $txtpsrn;?>','<?php echo $_REQUEST['crop'];?>','<?php echo $_REQUEST['variety'];?>','<?php echo $_REQUEST['upsval'];?>','<?php echo $otnop;?>','<?php echo $otqty;?>','<?php echo $_REQUEST['subid'];?>');window.close();</script>
			<?php
		}
		else if($postval=="canceltrn")
		{
			?>
				<script>window.opener.showverifysc('<?php echo $txtpsrn;?>','<?php echo $_REQUEST['crop'];?>','<?php echo $_REQUEST['variety'];?>','<?php echo $_REQUEST['upsval'];?>','<?php echo $otnop;?>','<?php echo $otqty;?>','<?php echo $_REQUEST['subid'];?>');window.close();</script>
			<?php
		}
		else
		{
			
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
<script src="btosloc1.js"></script>
<script src="../include/validation.js"></script>
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

function mySubmit()
{
	if(document.from.postval.value=="submittrn")
	{
		if(document.from.barcode.value=="")
		{
			alert("Please enter Barcodes first");
			return false;
		}
		if(confirm("You are Unlinking Barcode "+document.from.barcode.value+"\n\nDo You want to Un-Link?")==true)
		{
			return true;
		}
		else
		{
			return false
		}
	}
	else
	{
		return true
	}
}
function chkbarcode1(mltval)
{
	var flg=0;
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
		var pcode=document.from.plantcodes.value.split(",");
		var ycode=document.from.yearcodes.value.split(",");
		var x=0
		var y=0;
		for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
	}
	if(flg==0)
	{
		return true;
	}
	else 
	{
		return false;
	}
}
function post_value(postval)
{
	document.from.postval.value=postval;
}
</script>
</head>
<body topmargin="0" >
<table width="950" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  	<form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();">
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="crop" value="<?php echo $crop;?>" />
	<input type="hidden" name="variety" value="<?php echo $variety;?>" />
	<input type="hidden" name="txtpsrn" value="<?php echo $txtpsrn;?>" />
	<input type="hidden" name="lotno" value="<?php echo $lotno;?>" />
	<input type="hidden" name="slocssyncs" value="<?php echo $slocssyncs;?>" />
	<input type="hidden" name="maintrid" value="<?php echo $trid?>" />
	<input type="hidden" name="upsval" value="<?php echo $upsval;?>" />
	<input type="hidden" name="subid" value="<?php echo $subid;?>" />
<div id="barcstsloc">
<?php
$conts=0;
$plantcodes=""; $yearcodes="";
	$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
	while($noticia = mysqli_fetch_array($quer4)) 
	{
		if($yearcodes!="")
			$yearcodes=$yearcodes.",".$noticia['ycode'];
		else
			$yearcodes=$noticia['ycode'];
	}
	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	$row_month=mysqli_fetch_array($quer6);
	$plantcodes=$row_month['code'];
	$pltcode=$row_month['code'];
	$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
	while($noticia2 = mysqli_fetch_array($quer5)) 
	{
		if($plantcodes!="")
			$plantcodes=$plantcodes.",".$noticia2['stcode'];
		else
			$plantcodes=$noticia2['stcode'];
	}
?>
	
	<input type="hidden" name="conts" value="<?php echo $conts?>">
	<input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	<input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" /> 
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Enter Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" /></td>
</tr>
</table><br />	
<div id="showcvdet"></div>
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/cancel.gif" alt="Cancel Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="post_value('canceltrn');">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="post_value('submittrn');">&nbsp;&nbsp;<input type="hidden" name="postval" value="" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
