<?php
	ob_start();session_start();
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
	
	if(isset($_REQUEST['itmid']))
	{
		$itmid = $_REQUEST['itmid'];
	}
	/*if(isset($_REQUEST['txtpp']))
	{
		$txtpp = $_REQUEST['txtpp'];
	}*/
	if(isset($_POST['frm_action'])=='submit')
	{
		$itmid = $_REQUEST['itmid'];
		$txtrefno = $_REQUEST['txtrefno'];
		
		$dt=date("Y-m-d");
		$sql_arrhome=mysqli_query($link,"select * from tbl_densitydata where density_id='$itmid'") or die(mysqli_error($link));
		$tot_arrhome = mysqli_num_rows($sql_arrhome);
		$row_arrhome=mysqli_fetch_array($sql_arrhome);
		$clotno=$row_arrhome['density_orlot']."C";
		
		$sqlck2=mysqli_query($link,"select * from tbl_qctest where lotno='".$clotno."' order by tid asc") or die(mysqli_error($link));
		$rowck2=mysqli_fetch_array($sqlck2);
		$sap=$rowck2['sampleno'];
		$yrid=$rowck2['yearid'];
		$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
		$row_param=mysqli_fetch_array($sql_param);
		
		$tp1=$row_param['code'];
		$samplenum=$tp1.$yrid.sprintf("%000006d",$sap);
	
		$sql_sub_sub1222="update tbl_densitydata set density_consampleno='".$samplenum."', density_clotno='".$clotno."', density_conwtdate='".$dt."', density_consampwt='".$txtrefno."', density_conwtflg=1 where density_id='$itmid' ";
		//exit;
		
		$qq222=mysqli_query($link,$sql_sub_sub1222) or die(mysqli_error($link));
		
		echo "<script>window.opener.location.href = window.opener.location.href;
							   self.close();</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction-Qc Sampling slip</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
@font-face {
    font-family: 'qr_font_tfbregular';
    src: url('../css/qrfont-webfont.woff2') format('woff2'),
         url('../css/qrfont-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}
h1 {
font-family: 'qr_font_tfbregular', Arial, sans-serif;
font-weight:normal;
font-style:normal;
}
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
<script type="text/javascript">
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;
	
	return true;
}
function isNumberKey1(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;
	
	return true;
}
function mySubmit()
{ 
	if(document.from.txtrefno.value=="")
	{
		alert("Please Enter Condition Density Data.");
		//document.from.txtgemp.focus();
		return false;
	}
	if(document.from.txtrefno.value!="")
	{
		if(parseFloat(document.from.txtrefno.value)>999.999)
		{
			alert("Please Enter Correct Condition Density Data.");
			//document.from.txtgemp.focus();
			return false;
		}
	}
} 
</script>

<br />
<br />

 <form id="mainform" name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"    > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="Hidden" name="itmid" value="<?php echo $itmid?>" />
<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
    <td>
	<table  align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="16">
        <td colspan="4"  align="center" class="tblheading">Condition Density Data Update</td>
      </tr>
      <?php
$sql_arr_home=mysqli_query($link,"select * from tbl_densitydata where density_id='$itmid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{ 
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	//$qc1=$row_arr_home['sampleno'];

	$lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $orlot=""; $totnob=0; $totqty=0; $cont=0;

	$lotno=$row_arr_home['density_lotno'];
	$orlot=$row_arr_home['density_orlot'];
	$rawsampwt=$row_arr_home['density_rawsampwt'];

	$trdate=$row_arr_home['density_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['density_variety']."' and actstatus='Active'"); 
	$row=mysqli_fetch_array($quer3);
	$tt=$row['popularname'];
	$tot=mysqli_num_rows($quer3);	
	if($tot==0)
	{
		$vv=$row_arr_home['density_variety'];
	}
	else
	{
		$vv=$tt;
	}
	 

$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['density_crop']."'"); 
$row31=mysqli_fetch_array($quer3);
$samplenumber=$row_arr_home['density_sampleno'];

?>
      <tr class="Light" height="16">
        <td width="27%" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td width="23%" align="left"  valign="middle" class="smalltblheading"   >&nbsp;<?php echo $row31['cropname'];?></td>
        <td width="25%" align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td width="25%" align="left"  valign="middle" class="smalltblheading"  >&nbsp;<?php echo $vv;?></td>
      </tr>
      <tr class="Light" height="16">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading"  >&nbsp;<?php echo $lotno?></td>
        <td align="right"  valign="middle" class="smalltblheading">Sample No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading"  >&nbsp;<?php echo $samplenumber;?></td>
		   </tr>
		<tr class="Dark" height="16">
        <td align="right"  valign="middle" class="smalltblheading">Raw Density Weight&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading"  >&nbsp;<?php echo $rawsampwt;?></td>
		<td align="right"  valign="middle" class="smalltblheading">Condition Density Weight&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading"  >&nbsp;<input name="txtrefno" type="text" size="20" class="tbltext" tabindex="0" maxlength="20" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		</tr>	   
    
<?php
}
}

?>	
</table></td>
  </tr>
</table>

<br/>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="600">
<tr >
<td align="center" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>