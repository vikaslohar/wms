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

	if(isset($_POST['frm_action'])=='Submit')
	{
		$pcode = trim($_POST['pcode']);	 
		$ycodee= trim($_POST['ycodee']);	
		$txtlot2= trim($_POST['txtlot2']);	
		$stcode = trim($_POST['stcode']);	
		$stcode2 = trim($_POST['stcode2']); 

		$chr="R";	
	 	$txtlot1=$pcode.$ycodee.$txtlot2."/".$stcode."/".$stcode2.$chr;

		echo "<script>window.location='utility1.php?txtlot1=$txtlot1'</script>";	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RSW- Utility Lot Biography</title>
<link href="../include/main_rsw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk1.js"></script>
<script src="../include/validation.js"></script>
 <SCRIPT language="JavaScript">
 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode
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
function slocshow()
{
	if(document.frmaddDepartment.txtlot2.value=="")
	{
		alert("Invalid Lot Number");
		//document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="00000";
		return false;
	}
}

function ycodchk()
{
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="00000";
}

function lot2chk()
{
	if(document.frmaddDepartment.ycodee.value=="")
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot2.value="";
		document.frmaddDepartment.stcode.value="00000";
		return false;
	}
	else
	{
		document.frmaddDepartment.stcode.value="00000";
	}
}

function mySubmit()
{
	val2=document.frmaddDepartment.ycodee.value;
	val5=document.frmaddDepartment.txtlot2.value;
	val6=document.frmaddDepartment.stcode.value;
	val7=document.frmaddDepartment.pcode.value;
	val8=document.frmaddDepartment.stcode2.value;
	if(val7=="")
	{
		alert("Please Select Plant code");
		f=1;
		return false;
	}
	if(val2=="")
	{
		alert("Please Select Year Code");
		f=1;
		return false;
	}	
	if(val5=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val5.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	}
	if(val6=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val6.length < 5)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	} 
	if(val8=="")
	{
		alert("Please Enter Lot No.");
		f=1;
		return false;
	}
	if(val8.length < 2)
	{
		alert("Invalid Lot No.");
		f=1;
		return false;
	} 
}
</script>


<body>

<!-- actual page start--->	
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="600"  style="border-collapse:collapse">
<br />

<tr>
<td>
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	 
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Lot Biography </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
</table>
			
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#F1B01E" style="border-collapse:collapse">
		   <tr class="Light" height="25">
		  <td width="188"  align="right"  valign="middle" class="tblheading">&nbsp;Lot Number&nbsp; </td><?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters WHERE plantcode='$plantcode' order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
                                   
           <td colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
    <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00"  />
	   <b>R</b>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>

</table>
  
<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"><input type="hidden" name="typ" value="" /></td>
</tr>
</table>
</form> 
</td>
</tr>
</table>
		  
